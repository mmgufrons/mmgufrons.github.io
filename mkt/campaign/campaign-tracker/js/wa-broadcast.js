/**
 * wa-broadcast.js — WA Broadcast tool (adaptasi dari tools/wa/index.html)
 * Diintegrasikan ke tab 'WA Broadcast' campaign-tracker.
 * Storage: template pesan -> Firebase (campaign-smsrm, via api/firebase_proxy.php),
 * kontak/grup -> localStorage browser. Kontak untuk broadcast harian dibawa masuk
 * lewat WABroadcast.loadFromLeads() dari tab Master Leads (tombol 'Broadcast WA').
 */

function toast(msg){ showToast(msg, 'info'); }

// ---------- State ----------
let currentList = null;      // {name, headers, rows, colNomor, colNama}
let currentTemplate = '';
let sentStatus = {};         // index -> bool, per current list
let selectedRows = {};       // index -> bool, kontak mana yang dicentang untuk dikirimi
let contactFilterText = '';  // teks pencarian nama/nomor di tab Kirim

// ---------- Tabs ----------
const tabButtons = document.querySelectorAll('.tab-btn');
tabButtons.forEach(btn=>{
  btn.addEventListener('click', ()=>{
    if(btn.disabled) return;
    tabButtons.forEach(b=>b.classList.remove('active'));
    btn.classList.add('active');
    ['kontak','pesan','kirim'].forEach(t=>{
      document.getElementById('tab-'+t).style.display = (t===btn.dataset.tab) ? 'block' : 'none';
    });
    if(btn.dataset.tab === 'kirim') renderSendTable();
    if(btn.dataset.tab === 'pesan') renderPlaceholders();
  });
});
function goTab(name){
  document.querySelector(`.tab-btn[data-tab="${name}"]`).click();
}

// ---------- Storage helpers ----------
// Template pesan (dipakai bersama/lintas anggota tim & device) disimpan ke Firebase
// yang sama dipakai campaign-tracker (lewat proxy PHP, supaya secret tidak terekspos).
// Kontak/grup/kumpulan kontak cukup localStorage (data kerja lokal per-browser, bukan
// data yang perlu disinkronkan tim — sumber kebenaran kontak untuk broadcast harian
// tetap leads yang ada di campaign-tracker, dibawa masuk lewat tombol "Broadcast WA").
const WA_PROXY_URL = 'api/firebase_proxy.php';
const LOCAL_PREFIX = 'wa_broadcast:';

function storageReady(){ return true; } // localStorage + fetch selalu tersedia di browser modern

async function fbFetch(path, options){
  const res = await fetch(WA_PROXY_URL + '?path=' + encodeURIComponent(path), options);
  if(!res.ok) throw new Error('Firebase proxy error ' + res.status);
  return res.json();
}

async function storeSet(key, value){
  if(key.startsWith('template:')){
    const slug = key.replace(/^template:/, '');
    try{ await fbFetch('wa_templates/' + slug, {method:'PUT', headers:{'Content-Type':'application/json'}, body:value}); return true; }
    catch(e){ console.error('set template failed', e); toast('Gagal menyimpan template ke server'); return null; }
  }
  try{ localStorage.setItem(LOCAL_PREFIX + key, value); return true; }
  catch(e){ console.error('set failed', key, e); toast('Gagal menyimpan data: ' + (e && e.message ? e.message : 'coba lagi')); return null; }
}
async function storeGet(key){
  if(key.startsWith('template:')){
    const slug = key.replace(/^template:/, '');
    try{ const data = await fbFetch('wa_templates/' + slug); return data ? {value: JSON.stringify(data)} : null; }
    catch(e){ return null; }
  }
  const v = localStorage.getItem(LOCAL_PREFIX + key);
  return v !== null ? {value: v} : null;
}
async function storeDelete(key){
  if(key.startsWith('template:')){
    const slug = key.replace(/^template:/, '');
    try{ await fbFetch('wa_templates/' + slug, {method:'DELETE'}); return true; }
    catch(e){ return null; }
  }
  localStorage.removeItem(LOCAL_PREFIX + key);
  return true;
}
async function storeList(prefix){
  if(prefix === 'template:'){
    try{
      const data = await fbFetch('wa_templates');
      return {keys: data ? Object.keys(data).map(k=>'template:'+k) : []};
    }catch(e){ return {keys:[]}; }
  }
  const keys = [];
  for(let i=0;i<localStorage.length;i++){
    const k = localStorage.key(i);
    if(k && k.startsWith(LOCAL_PREFIX + prefix)) keys.push(k.slice(LOCAL_PREFIX.length));
  }
  return {keys};
}
// Storage keys tidak boleh mengandung spasi, garis miring, atau tanda kutip —
// tapi nama daftar/grup/template yang diketik user boleh. Jadi nama asli disimpan
// di dalam payload (data.name), sedangkan key penyimpanan memakai versi "aman".
function slugifyKey(name){
  // Termasuk hindari karakter yang tidak valid untuk key Firebase (. # $ [ ])
  // karena slug ini juga dipakai sebagai path node 'wa_templates/<slug>'.
  return String(name).trim().replace(/[\s\/\\'".#$\[\]]+/g, '_').slice(0, 150) || 'tanpa_nama';
}

// ---------- Mode toggle (Unggah File / Input Manual) ----------
const modeFileBtn = document.getElementById('modeFileBtn');
const modeManualBtn = document.getElementById('modeManualBtn');
modeFileBtn.addEventListener('click', ()=>setKontakMode('file'));
modeManualBtn.addEventListener('click', ()=>setKontakMode('manual'));
function setKontakMode(mode){
  modeFileBtn.classList.toggle('active', mode==='file');
  modeManualBtn.classList.toggle('active', mode==='manual');
  document.getElementById('filePanel').style.display = mode==='file' ? 'block' : 'none';
  document.getElementById('mappingPanel').style.display = 'none';
  document.getElementById('manualPanel').style.display = mode==='manual' ? 'block' : 'none';
  document.getElementById('poolPanel').style.display = mode==='manual' ? 'block' : 'none';
  if(mode==='manual'){ renderManualExtraInputs(contactPool.headers); renderPoolTable(); }
}

// ---------- App data (kumpulan kontak, grup/daftar, template) ----------
// Sumber kebenaran data ada di variabel-variabel ini (in-memory). Kontak/grup
// disinkronkan ke localStorage browser ini; template pesan disinkronkan ke server
// (Firebase, lewat proxy PHP) supaya bisa dipakai bersama anggota tim lain.
// Data ini juga bisa disimpan/dimuat lewat file JSON (lihat tombol Unduh/Muat Data
// di tab Daftar Kontak) untuk pindah ke komputer lain.
let contactPool = { headers: ['Nama','Nomor WA'], rows: [] };
let poolSelected = {}; // index -> bool, dipilih untuk dijadikan grup
let allGroups = {};    // key (mis. "kontak:pelanggan_juli") -> {name, headers, rows, colNomor, colNama}
let allTemplates = {}; // key (mis. "template:promo_juli") -> {name, text, attachment}

async function loadFromStorageIfAvailable(){
  if(!storageReady()) return;
  const poolRes = await storeGet('pool');
  if(poolRes){ try{ contactPool = JSON.parse(poolRes.value); }catch(e){} }
  const listRes = await storeList('kontak:');
  for(const key of (listRes && listRes.keys ? listRes.keys : [])){
    const res = await storeGet(key);
    if(!res) continue;
    try{ allGroups[key] = JSON.parse(res.value); }catch(e){}
  }
  const tRes = await storeList('template:');
  for(const key of (tRes && tRes.keys ? tRes.keys : [])){
    const res = await storeGet(key);
    if(!res) continue;
    try{ allTemplates[key] = JSON.parse(res.value); }catch(e){ allTemplates[key] = { text: res.value, attachment: null }; }
  }
}

document.getElementById('applyExtraColsBtn').addEventListener('click', ()=>{
  const extra = document.getElementById('manualExtraCols').value
    .split(',').map(s=>s.trim()).filter(Boolean);
  contactPool.headers = ['Nama','Nomor WA', ...extra];
  renderManualExtraInputs(contactPool.headers);
  renderPoolTable();
  toast('Kolom diterapkan');
});

// Renders extra input fields (beyond Nama/Nomor WA) based on the pool's header list
function renderManualExtraInputs(headers){
  const extras = headers.filter(h => h !== 'Nama' && h !== 'Nomor WA');
  const box = document.getElementById('manualExtraInputs');
  box.innerHTML = extras.map(h=>`
    <div>
      <label class="field-label">${escHtml(h)}</label>
      <input type="text" class="manual-extra-field" data-col="${escAttr(h)}" placeholder="${escHtml(h)}">
    </div>`).join('');
}

document.getElementById('manualAddBtn').addEventListener('click', async ()=>{
  const nama = document.getElementById('manualNama').value.trim();
  const nomor = document.getElementById('manualNomor').value.trim();
  if(!nama || !nomor){ toast('Isi nama dan nomor WA dulu'); return; }
  const row = { 'Nama': nama, 'Nomor WA': nomor };
  document.getElementById('manualExtraInputs').querySelectorAll('.manual-extra-field').forEach(inp=>{
    row[inp.dataset.col] = inp.value.trim();
  });
  contactPool.rows.push(row);
  await storeSet('pool', JSON.stringify(contactPool));
  renderPoolTable();
  toast('Kontak ditambahkan ke kumpulan ('+contactPool.rows.length+' total)');
  document.getElementById('manualNama').value = '';
  document.getElementById('manualNomor').value = '';
  document.getElementById('manualExtraInputs').querySelectorAll('.manual-extra-field').forEach(inp=>inp.value='');
  document.getElementById('manualNama').focus();
});

function renderPoolTable(){
  const table = document.getElementById('poolTable');
  const empty = document.getElementById('emptyPool');
  const label = document.getElementById('poolCountLabel');
  label.textContent = contactPool.rows.length ? '(' + contactPool.rows.length + ' kontak)' : '';
  if(!contactPool.rows.length){
    table.innerHTML = '';
    empty.style.display = 'block';
    updatePoolSelectCount();
    return;
  }
  empty.style.display = 'none';
  const cols = contactPool.headers;
  let html = '<thead><tr><th class="chk-col"><input type="checkbox" id="poolSelectAllChk"></th>' +
    cols.map(c=>`<th>${escHtml(c)}</th>`).join('') + '<th></th></tr></thead><tbody>';
  contactPool.rows.forEach((r,i)=>{
    const checked = !!poolSelected[i];
    html += `<tr><td class="chk-col"><input type="checkbox" class="pool-chk" data-i="${i}" ${checked?'checked':''}></td>` +
      cols.map(c=>`<td>${escHtml(r[c]||'')}</td>`).join('') +
      `<td><button class="del-row-btn" data-i="${i}">hapus</button></td></tr>`;
  });
  html += '</tbody>';
  table.innerHTML = html;
  table.querySelectorAll('.pool-chk').forEach(chk=>{
    chk.addEventListener('change', ()=>{
      poolSelected[chk.dataset.i] = chk.checked;
      updatePoolSelectCount();
    });
  });
  const selAllChk = document.getElementById('poolSelectAllChk');
  selAllChk.checked = contactPool.rows.length>0 && contactPool.rows.every((_,i)=>poolSelected[i]);
  selAllChk.addEventListener('change', ()=>{
    contactPool.rows.forEach((_,i)=>{ poolSelected[i] = selAllChk.checked; });
    renderPoolTable();
  });
  table.querySelectorAll('.del-row-btn').forEach(btn=>{
    btn.addEventListener('click', async ()=>{
      const i = Number(btn.dataset.i);
      contactPool.rows.splice(i, 1);
      const newSel = {};
      Object.keys(poolSelected).forEach(k=>{
        const idx = Number(k);
        if(idx < i) newSel[idx] = poolSelected[k];
        else if(idx > i) newSel[idx-1] = poolSelected[k];
      });
      poolSelected = newSel;
      await storeSet('pool', JSON.stringify(contactPool));
      renderPoolTable();
      toast('Kontak dihapus dari kumpulan');
    });
  });
  updatePoolSelectCount();
}

function updatePoolSelectCount(){
  const el = document.getElementById('poolSelectCount');
  if(!el) return;
  const selected = contactPool.rows.filter((_,i)=>poolSelected[i]).length;
  el.textContent = selected + ' dari ' + contactPool.rows.length + ' dipilih';
}

document.getElementById('poolSelectAllBtn').addEventListener('click', ()=>{
  contactPool.rows.forEach((_,i)=>{ poolSelected[i] = true; });
  renderPoolTable();
});
document.getElementById('poolSelectNoneBtn').addEventListener('click', ()=>{
  poolSelected = {};
  renderPoolTable();
});

document.getElementById('createGroupBtn').addEventListener('click', async ()=>{
  const name = document.getElementById('groupNameInput').value.trim();
  if(!name){ toast('Beri nama grup ini dulu'); return; }
  const chosen = contactPool.rows.filter((_,i)=>poolSelected[i]);
  if(!chosen.length){ toast('Pilih minimal satu kontak dari kumpulan di atas'); return; }
  const key = 'kontak:'+slugifyKey(name);
  const payload = { name, headers: contactPool.headers, rows: chosen.map(r=>({...r})), colNomor: 'Nomor WA', colNama: 'Nama' };
  allGroups[key] = payload;
  storeSet(key, JSON.stringify(payload)); // sinkronisasi opsional, tidak diblokir kalau gagal
  toast('Grup "'+name+'" dibuat ('+chosen.length+' kontak)');
  document.getElementById('groupNameInput').value = '';
  renderSavedLists();
  selectList(name, payload);
});

// ---------- Lampiran (attachment) ----------
let currentAttachment = null; // {name, type, size, dataUrl, tooBig}
const ATTACH_LIMIT = 3.5 * 1024 * 1024; // ~3.5MB, aman untuk penyimpanan base64

function formatBytes(bytes){
  if(bytes < 1024) return bytes + ' B';
  if(bytes < 1024*1024) return (bytes/1024).toFixed(1) + ' KB';
  return (bytes/(1024*1024)).toFixed(2) + ' MB';
}

const attachDropzone = document.getElementById('attachDropzone');
const attachInput = document.getElementById('attachInput');
attachDropzone.addEventListener('click', ()=>attachInput.click());
attachDropzone.addEventListener('dragover', e=>{e.preventDefault(); attachDropzone.classList.add('drag');});
attachDropzone.addEventListener('dragleave', ()=>attachDropzone.classList.remove('drag'));
attachDropzone.addEventListener('drop', e=>{
  e.preventDefault(); attachDropzone.classList.remove('drag');
  if(e.dataTransfer.files.length) handleAttachFile(e.dataTransfer.files[0]);
});
attachInput.addEventListener('change', e=>{
  if(e.target.files.length) handleAttachFile(e.target.files[0]);
});

function handleAttachFile(file){
  const reader = new FileReader();
  reader.onload = (e)=>{
    currentAttachment = {
      name: file.name,
      type: file.type || 'application/octet-stream',
      size: file.size,
      dataUrl: e.target.result,
      tooBig: file.size > ATTACH_LIMIT
    };
    renderAttachPreview();
    if(currentAttachment.tooBig){
      toast('File terlalu besar untuk disimpan, tapi tetap bisa dipakai sekarang');
    }
  };
  reader.readAsDataURL(file);
}

function attachKindIcon(type){
  if(type.startsWith('image/')) return null; // handled separately
  if(type.startsWith('video/')) return null;
  if(type.startsWith('audio/')) return '🎵';
  if(type.includes('pdf')) return '📕';
  if(type.includes('word') || type.includes('doc')) return '📄';
  if(type.includes('sheet') || type.includes('excel') || type.includes('csv')) return '📊';
  if(type.includes('zip') || type.includes('rar')) return '🗜️';
  return '📁';
}

function buildAttachCardHtml(att, {showRemove}){
  let mediaHtml;
  if(att.type.startsWith('image/')){
    mediaHtml = `<img src="${att.dataUrl}" alt="lampiran">`;
  } else if(att.type.startsWith('video/')){
    mediaHtml = `<video src="${att.dataUrl}" muted></video>`;
  } else {
    mediaHtml = `<div class="file-icon">${attachKindIcon(att.type)}</div>`;
  }
  const audioPlayer = att.type.startsWith('audio/') ? `<audio controls src="${att.dataUrl}"></audio>` : '';
  return `
    <div class="attach-card">
      ${mediaHtml}
      <div class="info">
        <div class="fname">${escHtml(att.name)}</div>
        <div class="fmeta">${escHtml(att.type)} · ${formatBytes(att.size)}</div>
        ${att.tooBig ? '<div class="fwarn">Terlalu besar untuk tersimpan permanen (maks ~3.5MB) — hanya berlaku untuk sesi ini</div>' : ''}
        ${audioPlayer}
      </div>
      <div class="actions">
        <a class="btn btn-ghost" style="padding:7px 12px;font-size:12.5px;" href="${att.dataUrl}" download="${escAttr(att.name)}">Unduh</a>
        ${showRemove ? '<button class="btn btn-danger" id="removeAttachBtn">Hapus</button>' : ''}
      </div>
    </div>`;
}

function renderAttachPreview(){
  const box = document.getElementById('attachPreview');
  if(!currentAttachment){ box.style.display='none'; box.innerHTML=''; return; }
  box.style.display = 'block';
  box.innerHTML = buildAttachCardHtml(currentAttachment, {showRemove:true});
  document.getElementById('removeAttachBtn').addEventListener('click', ()=>{
    currentAttachment = null;
    attachInput.value = '';
    renderAttachPreview();
  });
}


// ---------- File upload / parsing ----------
const dropzone = document.getElementById('dropzone');
const fileInput = document.getElementById('fileInput');
dropzone.addEventListener('click', ()=>fileInput.click());
dropzone.addEventListener('dragover', e=>{e.preventDefault(); dropzone.classList.add('drag');});
dropzone.addEventListener('dragleave', ()=>dropzone.classList.remove('drag'));
dropzone.addEventListener('drop', e=>{
  e.preventDefault(); dropzone.classList.remove('drag');
  if(e.dataTransfer.files.length) handleFile(e.dataTransfer.files[0]);
});
fileInput.addEventListener('change', e=>{
  if(e.target.files.length) handleFile(e.target.files[0]);
});

let parsedHeaders = [];
let parsedRows = [];

function handleFile(file){
  const reader = new FileReader();
  reader.onload = (e)=>{
    try{
      const data = new Uint8Array(e.target.result);
      const wb = XLSX.read(data, {type:'array'});
      const sheet = wb.Sheets[wb.SheetNames[0]];
      const json = XLSX.utils.sheet_to_json(sheet, {defval:''});
      if(!json.length){ toast('File kosong atau tidak terbaca'); return; }
      parsedHeaders = Object.keys(json[0]);
      parsedRows = json;
      showMapping(file.name);
    }catch(err){
      console.error(err);
      toast('Gagal membaca file. Pastikan formatnya benar.');
    }
  };
  reader.readAsArrayBuffer(file);
}

function showMapping(filename){
  document.getElementById('mappingPanel').style.display = 'block';
  const colNomorSel = document.getElementById('colNomor');
  const colNamaSel = document.getElementById('colNama');
  colNomorSel.innerHTML = parsedHeaders.map(h=>`<option value="${escAttr(h)}">${escHtml(h)}</option>`).join('');
  colNamaSel.innerHTML = parsedHeaders.map(h=>`<option value="${escAttr(h)}">${escHtml(h)}</option>`).join('');
  // guess columns
  const guessNomor = parsedHeaders.find(h=>/wa|whats?app|hp|telp|phone|nomor|no\.?$/i.test(h)) || parsedHeaders[0];
  const guessNama = parsedHeaders.find(h=>/nama|name/i.test(h)) || parsedHeaders[0];
  colNomorSel.value = guessNomor;
  colNamaSel.value = guessNama;

  renderPreviewTable();
  colNomorSel.onchange = renderPreviewTable;
  colNamaSel.onchange = renderPreviewTable;

  const base = filename.replace(/\.[^.]+$/, '');
  document.getElementById('listName').value = base;
}

function renderPreviewTable(){
  const cols = parsedHeaders.slice(0, 5);
  const t = document.getElementById('previewTable');
  let html = '<thead><tr>' + cols.map(c=>`<th>${escHtml(c)}</th>`).join('') + (parsedHeaders.length>5?'<th>…</th>':'') + '</tr></thead><tbody>';
  parsedRows.slice(0,5).forEach(r=>{
    html += '<tr>' + cols.map(c=>`<td>${escHtml(String(r[c]))}</td>`).join('') + (parsedHeaders.length>5?'<td>…</td>':'') + '</tr>';
  });
  html += '</tbody>';
  t.innerHTML = html;
}

document.getElementById('saveListBtn').addEventListener('click', async ()=>{
  const name = document.getElementById('listName').value.trim();
  if(!name){ toast('Beri nama daftar ini dulu'); return; }
  const colNomor = document.getElementById('colNomor').value;
  const colNama = document.getElementById('colNama').value;
  const key = 'kontak:'+slugifyKey(name);
  const payload = { name, headers: parsedHeaders, rows: parsedRows, colNomor, colNama };
  allGroups[key] = payload;
  storeSet(key, JSON.stringify(payload)); // sinkronisasi opsional, tidak diblokir kalau gagal
  toast('Daftar "'+name+'" tersimpan');
  document.getElementById('mappingPanel').style.display = 'none';
  fileInput.value = '';
  renderSavedLists();
  selectList(name, payload);
});

// ---------- Saved contact lists (grup) ----------
function renderSavedLists(){
  const container = document.getElementById('savedLists');
  const empty = document.getElementById('emptyLists');
  const keys = Object.keys(allGroups);
  if(!keys.length){
    container.innerHTML = '';
    empty.style.display = 'block';
    return;
  }
  empty.style.display = 'none';
  container.innerHTML = '';
  for(const key of keys){
    const data = allGroups[key];
    if(!data) continue;
    const item = document.createElement('div');
    item.className = 'saved-item' + (currentList && currentList.name===data.name ? ' active-item' : '');
    item.innerHTML = `
      <div class="meta">
        <div class="name">${escHtml(data.name)}</div>
        <div class="count">${data.rows.length} kontak · nomor: ${escHtml(data.colNomor)} · nama: ${escHtml(data.colNama)}</div>
      </div>
      <div class="actions">
        <button class="btn btn-ghost" data-act="use" style="padding:7px 12px;font-size:13px;">Gunakan</button>
        <button class="btn btn-danger" data-act="del">Hapus</button>
      </div>`;
    item.querySelector('[data-act="use"]').addEventListener('click', ()=>{
      selectList(data.name, data);
      toast('Daftar "'+data.name+'" dipilih');
      goTab('pesan');
    });
    item.querySelector('[data-act="del"]').addEventListener('click', ()=>{
      if(!confirm('Hapus daftar "'+data.name+'"?')) return;
      delete allGroups[key];
      storeDelete(key); // sinkronisasi opsional
      if(currentList && currentList.name === data.name){ currentList = null; updateKirimTabState(); }
      renderSavedLists();
      toast('Daftar dihapus');
    });
    container.appendChild(item);
  }
}

function selectList(name, data){
  currentList = data;
  sentStatus = {};
  selectedRows = {};
  data.rows.forEach((_,i)=>{ selectedRows[i] = true; }); // default: semua tercentang, tapi bisa dikosongkan lalu pilih manual
  contactFilterText = '';
  const filterInput = document.getElementById('contactFilter');
  if(filterInput) filterInput.value = '';
  updateKirimTabState();
  renderPlaceholders();
  document.getElementById('kirimListName').textContent = name;
  renderActiveListPanel();
}

// Panel "kontak aktif saat ini" di tab 01 (Daftar Kontak) — menampilkan langsung
// daftar kontak yang sedang dipakai (termasuk yang dibawa dari Master Leads lewat
// tombol "Broadcast WA"), lengkap dengan cara menyimpannya jadi grup permanen kalau
// kontak itu belum tersimpan (grup yang dimuat dari "Gunakan" tidak perlu disimpan lagi).
const ACTIVE_LIST_PREVIEW_MAX = 50;

function renderActiveListPanel(){
  const panel = document.getElementById('activeListPanel');
  if(!panel) return;
  if(!currentList){
    panel.style.display = 'none';
    return;
  }
  panel.style.display = 'block';

  const isSavedGroup = Object.keys(allGroups).some(k => allGroups[k] && allGroups[k].name === currentList.name);
  document.getElementById('activeListMeta').innerHTML = isSavedGroup
    ? `<b>"${escHtml(currentList.name)}"</b> — ${currentList.rows.length} kontak. Grup ini sudah tersimpan permanen, langsung bisa dipakai di tab Tulis Pesan &amp; Kirim.`
    : `<b>"${escHtml(currentList.name)}"</b> — ${currentList.rows.length} kontak siap dipakai di tab Tulis Pesan &amp; Kirim. Belum disimpan permanen — kalau mau dipakai lagi lain kali, beri nama lalu klik simpan di bawah.`;

  document.getElementById('activeListSaveRow').style.display = isSavedGroup ? 'none' : 'flex';
  const nameInput = document.getElementById('activeListGroupName');
  if(!isSavedGroup && !nameInput.value) nameInput.value = currentList.name;

  const cols = currentList.headers;
  const rows = currentList.rows.slice(0, ACTIVE_LIST_PREVIEW_MAX);
  let html = '<thead><tr>' + cols.map(c=>`<th>${escHtml(c)}</th>`).join('') + '</tr></thead><tbody>';
  rows.forEach(r=>{
    html += '<tr>' + cols.map(c=>`<td>${escHtml(r[c]||'')}</td>`).join('') + '</tr>';
  });
  html += '</tbody>';
  document.getElementById('activeListTable').innerHTML = html;

  if(currentList.rows.length > ACTIVE_LIST_PREVIEW_MAX){
    document.getElementById('activeListTable').insertAdjacentHTML('afterend',
      `<p class="sub" id="activeListTruncNote" style="margin-top:6px;">Menampilkan ${ACTIVE_LIST_PREVIEW_MAX} dari ${currentList.rows.length} kontak. Daftar lengkap tetap dipakai saat kirim, ini cuma pratinjau.</p>`);
  } else {
    document.getElementById('activeListTruncNote')?.remove();
  }
}

document.getElementById('activeListSaveBtn').addEventListener('click', async ()=>{
  const name = document.getElementById('activeListGroupName').value.trim();
  if(!name){ toast('Beri nama grup ini dulu'); return; }
  if(!currentList){ toast('Belum ada kontak aktif untuk disimpan'); return; }
  const key = 'kontak:'+slugifyKey(name);
  const payload = { name, headers: currentList.headers, rows: currentList.rows.map(r=>({...r})),
                     colNomor: currentList.colNomor, colNama: currentList.colNama };
  allGroups[key] = payload;
  await storeSet(key, JSON.stringify(payload));
  toast('Grup "'+name+'" tersimpan permanen ('+payload.rows.length+' kontak)');
  renderSavedLists();
  selectList(name, payload); // currentList sekarang jadi grup yang baru tersimpan
});

function updateKirimTabState(){
  document.getElementById('tabKirimBtn').disabled = !currentList;
}

// ---------- Message templates ----------
document.getElementById('saveTemplateBtn').addEventListener('click', async ()=>{
  const name = document.getElementById('templateName').value.trim();
  const text = document.getElementById('messageBox').value.trim();
  if(!name){ toast('Beri nama template ini dulu'); return; }
  if(!text){ toast('Isi pesan masih kosong'); return; }
  let attachToSave = null;
  if(currentAttachment && !currentAttachment.tooBig){
    attachToSave = currentAttachment;
  }
  const key = 'template:'+slugifyKey(name);
  const payload = { name, text, attachment: attachToSave };
  allTemplates[key] = payload;
  storeSet(key, JSON.stringify(payload)); // sinkronisasi opsional
  let msg = 'Template "'+name+'" tersimpan';
  if(currentAttachment && currentAttachment.tooBig) msg += ' (lampiran tidak ikut tersimpan karena terlalu besar)';
  toast(msg);
  renderSavedTemplates();
});

function renderSavedTemplates(){
  const container = document.getElementById('savedTemplates');
  const empty = document.getElementById('emptyTemplates');
  const keys = Object.keys(allTemplates);
  if(!keys.length){ container.innerHTML=''; empty.style.display='block'; return; }
  empty.style.display = 'none';
  container.innerHTML = '';
  for(const key of keys){
    const data = allTemplates[key];
    if(!data) continue;
    const name = data.name || key.replace(/^template:/, '').replace(/_/g, ' ');
    const item = document.createElement('div');
    item.className = 'saved-item';
    const attachTag = data.attachment ? ' <span class="chip" style="cursor:default;">📎 '+escHtml(data.attachment.name)+'</span>' : '';
    item.innerHTML = `
      <div class="meta">
        <div class="name">${escHtml(name)}</div>
        <div class="count">${escHtml(data.text.slice(0,60))}${data.text.length>60?'…':''}${attachTag}</div>
      </div>
      <div class="actions">
        <button class="btn btn-ghost" data-act="use" style="padding:7px 12px;font-size:13px;">Pakai</button>
        <button class="btn btn-danger" data-act="del">Hapus</button>
      </div>`;
    item.querySelector('[data-act="use"]').addEventListener('click', ()=>{
      document.getElementById('messageBox').value = data.text;
      document.getElementById('templateName').value = name;
      currentAttachment = data.attachment || null;
      renderAttachPreview();
      toast('Template "'+name+'" dimuat');
    });
    item.querySelector('[data-act="del"]').addEventListener('click', ()=>{
      if(!confirm('Hapus template "'+name+'"?')) return;
      delete allTemplates[key];
      storeDelete(key); // sinkronisasi opsional
      renderSavedTemplates();
      toast('Template dihapus');
    });
    container.appendChild(item);
  }
}


function renderPlaceholders(){
  const warn = document.getElementById('noListWarn');
  const chipsBox = document.getElementById('placeholderChips');
  if(!currentList){
    warn.style.display = 'block';
    chipsBox.innerHTML = '';
    document.getElementById('pesanSub').textContent = 'Gunakan placeholder untuk personalisasi otomatis per kontak.';
    return;
  }
  warn.style.display = 'none';
  document.getElementById('pesanSub').textContent = 'Klik placeholder untuk menambahkannya ke pesan. Diisi otomatis dari daftar "'+currentList.name+'".';
  chipsBox.innerHTML = currentList.headers.map(h=>`<span class="chip" data-h="${escAttr(h)}">{{${escHtml(h)}}}</span>`).join('');
  chipsBox.querySelectorAll('.chip').forEach(c=>{
    c.addEventListener('click', ()=>{
      const box = document.getElementById('messageBox');
      const insert = '{{'+c.dataset.h+'}}';
      const pos = box.selectionStart || box.value.length;
      box.value = box.value.slice(0,pos) + insert + box.value.slice(pos);
      box.focus();
    });
  });
}

// ---------- Phone normalization ----------
function normalizePhone(raw){
  let s = String(raw).replace(/[^\d+]/g, '');
  s = s.replace(/^\+/, '');
  if(s.startsWith('0')) s = '62' + s.slice(1);
  else if(!s.startsWith('62')) s = '62' + s;
  return s;
}

function fillTemplate(template, row){
  return template.replace(/\{\{(.+?)\}\}/g, (m, key)=>{
    key = key.trim();
    return (row[key] !== undefined && row[key] !== '') ? String(row[key]) : '';
  });
}

// ---------- Send tab ----------
const WA_TARGET = 'kirimWaTab'; // nama window tetap sama supaya link berikutnya membuka ULANG tab yang sama, bukan tab baru

function getRowInfo(i){
  const row = currentList.rows[i];
  const template = document.getElementById('messageBox').value;
  const phone = normalizePhone(row[currentList.colNomor]);
  const name = row[currentList.colNama] || '(tanpa nama)';
  const msg = fillTemplate(template, row);
  const link = 'https://web.whatsapp.com/send?phone=' + phone + '&text=' + encodeURIComponent(msg);
  return {phone, name, msg, link};
}

function openInWaTab(link){
  window.open(link, WA_TARGET);
}

function renderKirimAttachment(){
  const banner = document.getElementById('kirimAttachBanner');
  const box = document.getElementById('kirimAttachPreview');
  if(!currentAttachment){
    banner.style.display = 'none';
    box.style.display = 'none';
    box.innerHTML = '';
    return;
  }
  banner.style.display = 'block';
  box.style.display = 'block';
  box.innerHTML = buildAttachCardHtml(currentAttachment, {showRemove:false});
}

function matchesFilter(info){
  if(!contactFilterText) return true;
  const q = contactFilterText.toLowerCase();
  return String(info.name).toLowerCase().includes(q) || info.phone.includes(q);
}

function renderSendTable(){
  renderKirimAttachment();
  const table = document.getElementById('sendTable');
  if(!currentList){
    table.innerHTML = '<tbody><tr><td>Belum ada daftar kontak dipilih.</td></tr></tbody>';
    updateProgress();
    updateSelectCount();
    return;
  }
  document.getElementById('kirimListName').textContent = currentList.name;
  let html = '<thead><tr><th class="chk-col"><input type="checkbox" id="selectAllChk" title="Pilih/kosongkan semua baris yang tampil"></th><th>Nama</th><th>Nomor</th><th>Pratinjau pesan</th><th>Aksi</th></tr></thead><tbody>';
  let anyVisible = false;
  currentList.rows.forEach((row, i)=>{
    const info = getRowInfo(i);
    if(!matchesFilter(info)) return;
    anyVisible = true;
    const isSent = !!sentStatus[i];
    const isChecked = !!selectedRows[i];
    html += `<tr class="${isChecked?'':'row-unselected'}">
      <td class="chk-col"><input type="checkbox" class="row-chk" data-i="${i}" ${isChecked?'checked':''}></td>
      <td>${escHtml(String(info.name))}</td>
      <td style="font-family:'IBM Plex Mono',monospace;">${escHtml(info.phone)}</td>
      <td style="max-width:280px;color:var(--muted);">${escHtml(info.msg).slice(0,90)}${info.msg.length>90?'…':''}</td>
      <td><button class="btn-send ${isSent?'sent':''}" data-i="${i}" data-link="${escAttr(info.link)}">${isSent?'✓ Terkirim':'Kirim'}</button></td>
    </tr>`;
  });
  if(!anyVisible){
    html += '<tr><td colspan="5" style="color:var(--muted);text-align:center;padding:18px;">Tidak ada kontak yang cocok dengan pencarian.</td></tr>';
  }
  html += '</tbody>';
  table.innerHTML = html;
  table.querySelectorAll('.btn-send').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      openInWaTab(btn.dataset.link);
      const i = btn.dataset.i;
      sentStatus[i] = true;
      btn.classList.add('sent');
      btn.textContent = '✓ Terkirim';
      updateProgress();
    });
  });
  table.querySelectorAll('.row-chk').forEach(chk=>{
    chk.addEventListener('change', ()=>{
      const i = chk.dataset.i;
      selectedRows[i] = chk.checked;
      chk.closest('tr').classList.toggle('row-unselected', !chk.checked);
      updateSelectCount();
    });
  });
  const selectAllChk = document.getElementById('selectAllChk');
  if(selectAllChk){
    const visibleIdx = currentList.rows.map((_,i)=>i).filter(i=>matchesFilter(getRowInfo(i)));
    selectAllChk.checked = visibleIdx.length>0 && visibleIdx.every(i=>selectedRows[i]);
    selectAllChk.addEventListener('change', ()=>{
      visibleIdx.forEach(i=>{ selectedRows[i] = selectAllChk.checked; });
      renderSendTable();
    });
  }
  updateProgress();
  updateSelectCount();
}

function updateSelectCount(){
  const el = document.getElementById('selectCount');
  if(!el) return;
  if(!currentList){ el.textContent = '0 dipilih'; return; }
  const total = currentList.rows.length;
  const selected = currentList.rows.filter((_,i)=>selectedRows[i]).length;
  el.textContent = selected + ' dari ' + total + ' kontak dipilih';
}

document.getElementById('selectAllBtn').addEventListener('click', ()=>{
  if(!currentList){ toast('Pilih daftar kontak dulu'); return; }
  currentList.rows.forEach((_,i)=>{ selectedRows[i] = true; });
  renderSendTable();
});
document.getElementById('selectNoneBtn').addEventListener('click', ()=>{
  if(!currentList){ toast('Pilih daftar kontak dulu'); return; }
  currentList.rows.forEach((_,i)=>{ selectedRows[i] = false; });
  renderSendTable();
});
document.getElementById('contactFilter').addEventListener('input', (e)=>{
  contactFilterText = e.target.value.trim();
  renderSendTable();
});

function updateProgress(){
  const total = currentList ? currentList.rows.map((_,i)=>i).filter(i=>selectedRows[i]).length : 0;
  const sent = currentList ? currentList.rows.map((_,i)=>i).filter(i=>selectedRows[i] && sentStatus[i]).length : 0;
  const pct = total ? Math.round((sent/total)*100) : 0;
  document.getElementById('progressFill').style.width = pct + '%';
  document.getElementById('progressText').textContent = sent + ' dari ' + total + ' terkirim (dari kontak yang dipilih)';
}

document.getElementById('messageBox').addEventListener('input', ()=>{
  if(document.getElementById('tab-kirim').style.display === 'block') renderSendTable();
});

// ---------- Kirim Otomatis (satu tab, berjeda) ----------
let autoQueue = [];
let autoPos = 0;
let autoTimer = null;
let autoCountdown = 0;
const autoStartBtn = document.getElementById('autoStartBtn');
const autoStopBtn = document.getElementById('autoStopBtn');
const autoStatus = document.getElementById('autoStatus');

autoStartBtn.addEventListener('click', ()=>{
  if(!currentList){ toast('Pilih daftar kontak dulu'); return; }
  autoQueue = currentList.rows.map((_,i)=>i).filter(i=>selectedRows[i] && !sentStatus[i]);
  if(!autoQueue.length){ toast('Tidak ada kontak terpilih yang belum dikirim. Centang kontak di tabel dulu.'); return; }
  autoPos = 0;
  document.getElementById('popupHint').style.display = 'block';
  autoStartBtn.style.display = 'none';
  autoStopBtn.style.display = 'inline-flex';
  fireNextAuto(true); // kirim kontak pertama langsung
});

function fireNextAuto(immediate){
  clearInterval(autoTimer);
  if(autoPos >= autoQueue.length){
    stopAuto('Selesai — semua kontak sudah dikirim ke tab WhatsApp.');
    return;
  }
  const delaySec = immediate ? 0 : Number(document.getElementById('autoDelay').value);
  autoCountdown = delaySec;
  const runNow = ()=>{
    const i = autoQueue[autoPos];
    const info = getRowInfo(i);
    openInWaTab(info.link);
    sentStatus[i] = true;
    renderSendTable();
    autoPos++;
    autoStatus.textContent = 'Terkirim ke tab WhatsApp (' + autoPos + '/' + autoQueue.length + '). Menyiapkan kontak berikutnya…';
    const nextDelay = Number(document.getElementById('autoDelay').value);
    autoCountdown = nextDelay;
    autoTimer = setInterval(()=>{
      autoCountdown--;
      if(autoPos >= autoQueue.length){
        stopAuto('Selesai — semua kontak sudah dikirim ke tab WhatsApp.');
        return;
      }
      if(autoCountdown <= 0){
        fireNextAuto(true);
      } else {
        autoStatus.textContent = 'Lanjut ke kontak berikutnya (' + (autoPos+1) + '/' + autoQueue.length + ') dalam ' + autoCountdown + ' detik…';
      }
    }, 1000);
  };
  if(immediate) runNow();
}

function stopAuto(msg){
  clearInterval(autoTimer);
  autoTimer = null;
  autoStartBtn.style.display = 'inline-flex';
  autoStopBtn.style.display = 'none';
  autoStatus.textContent = msg || '';
}

autoStopBtn.addEventListener('click', ()=>stopAuto('Dihentikan. Kamu bisa lanjutkan kapan saja.'));

// ---------- Mode Berurutan ----------
let seqQueue = [];
let seqPos = 0;

document.getElementById('sequentialModeBtn').addEventListener('click', ()=>{
  if(!currentList){ toast('Pilih daftar kontak dulu'); return; }
  seqQueue = currentList.rows.map((_,i)=>i).filter(i=>selectedRows[i] && !sentStatus[i]);
  seqPos = 0;
  if(!seqQueue.length){ toast('Tidak ada kontak terpilih yang belum dikirim. Centang kontak di tabel dulu.'); return; }
  document.getElementById('popupHint').style.display = 'block';
  document.getElementById('seqCard').style.display = 'block';
  renderSeqCard();
});

function renderSeqCard(){
  if(seqPos >= seqQueue.length){
    document.getElementById('seqCard').style.display = 'none';
    toast('Mode berurutan selesai');
    return;
  }
  const i = seqQueue[seqPos];
  const info = getRowInfo(i);
  document.getElementById('seqCount').textContent = 'Kontak ' + (seqPos+1) + ' dari ' + seqQueue.length;
  document.getElementById('seqName').textContent = info.name;
  document.getElementById('seqPhone').textContent = info.phone;
  document.getElementById('seqMsg').textContent = info.msg;
  document.getElementById('seqCard').dataset.currentIndex = i;
}

document.getElementById('seqSendBtn').addEventListener('click', ()=>{
  const i = Number(document.getElementById('seqCard').dataset.currentIndex);
  const info = getRowInfo(i);
  openInWaTab(info.link);
  sentStatus[i] = true;
  renderSendTable();
  seqPos++;
  renderSeqCard();
});
document.getElementById('seqSkipBtn').addEventListener('click', ()=>{
  seqPos++;
  renderSeqCard();
});
document.getElementById('seqCloseBtn').addEventListener('click', ()=>{
  document.getElementById('seqCard').style.display = 'none';
});

// ---------- Utils ----------
function escHtml(s){
  return String(s).replace(/[&<>"']/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}
function escAttr(s){ return escHtml(s); }

// ---------- Impor / Ekspor data (JSON, untuk pemakaian standalone) ----------
function exportAllData(){
  const payload = {
    exportedAt: new Date().toISOString(),
    pool: contactPool,
    groups: allGroups,
    templates: allTemplates
  };
  const blob = new Blob([JSON.stringify(payload, null, 2)], {type:'application/json'});
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'kirim-wa-data.json';
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
  toast('Data diunduh sebagai file JSON');
}

function importAllData(jsonText){
  let data;
  try{ data = JSON.parse(jsonText); }
  catch(e){ toast('File JSON tidak valid: ' + e.message); return; }

  if(data.pool && Array.isArray(data.pool.rows)){
    contactPool = {
      headers: Array.isArray(data.pool.headers) ? data.pool.headers : ['Nama','Nomor WA'],
      rows: data.pool.rows
    };
    storeSet('pool', JSON.stringify(contactPool));
  }
  let groupCount = 0;
  if(data.groups && typeof data.groups === 'object'){
    Object.keys(data.groups).forEach(k=>{
      const g = data.groups[k];
      if(!g || !g.name || !Array.isArray(g.rows)) return;
      const key = k.startsWith('kontak:') ? k : 'kontak:'+slugifyKey(g.name);
      allGroups[key] = g;
      storeSet(key, JSON.stringify(g));
      groupCount++;
    });
  }
  let templateCount = 0;
  if(data.templates && typeof data.templates === 'object'){
    Object.keys(data.templates).forEach(k=>{
      const t = data.templates[k];
      if(!t || !t.name || typeof t.text !== 'string') return;
      const key = k.startsWith('template:') ? k : 'template:'+slugifyKey(t.name);
      allTemplates[key] = t;
      storeSet(key, JSON.stringify(t));
      templateCount++;
    });
  }

  poolSelected = {};
  renderManualExtraInputs(contactPool.headers);
  renderPoolTable();
  renderSavedLists();
  renderSavedTemplates();
  toast('Data dimuat: ' + contactPool.rows.length + ' kontak, ' + groupCount + ' grup, ' + templateCount + ' template');
}

document.getElementById('exportJsonBtn').addEventListener('click', exportAllData);
document.getElementById('importJsonBtn').addEventListener('click', ()=>{
  document.getElementById('importJsonInput').click();
});
document.getElementById('importJsonInput').addEventListener('change', (e)=>{
  const file = e.target.files[0];
  if(!file) return;
  const reader = new FileReader();
  reader.onload = ()=> importAllData(reader.result);
  reader.onerror = ()=> toast('Gagal membaca file JSON');
  reader.readAsText(file);
  e.target.value = '';
});

// ---------- Init ----------
async function init(){
  updateKirimTabState();
  await loadFromStorageIfAvailable();
  if(!contactPool.headers) contactPool.headers = ['Nama','Nomor WA'];
  if(!contactPool.rows) contactPool.rows = [];
  renderSavedLists();
  renderSavedTemplates();
  renderManualExtraInputs(contactPool.headers);
  renderPoolTable();
  const statusEl = document.getElementById('storageStatus');
  statusEl.textContent = '✓ tersimpan otomatis';
  statusEl.title = 'Kontak & grup tersimpan di browser ini (localStorage). Template pesan tersinkron ke server, bisa dipakai anggota tim lain juga.';
}
init();

// ---------- Jembatan dari tab Master Leads ("Broadcast WA") ----------
// Dipanggil dari js/app.js saat user pilih leads lalu klik tombol "Broadcast WA".
// Kontak yang dibawa masuk bersifat sementara (tidak disimpan sebagai grup baru),
// karena sumber kebenarannya tetap data leads di tracker, bukan salinan di sini.
window.WABroadcast = {
  loadFromLeads(rows, name){
    if(!rows || !rows.length){
      toast('Tidak ada kontak dengan nomor WA yang valid pada baris terpilih.');
      return false;
    }
    const payload = {
      name: name || ('Broadcast ' + new Date().toLocaleString('id-ID')),
      headers: Object.keys(rows[0]),
      rows: rows,
      colNomor: 'Nomor WA',
      colNama: 'Nama'
    };
    selectList(payload.name, payload);
    goTab('pesan');
    toast(rows.length + ' kontak dimuat dari Master Leads ke WA Broadcast');
    return true;
  }
};

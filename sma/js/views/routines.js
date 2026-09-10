/* ============================================================
   PT SMA Enterprise OS CLOUD v10.3
   js/views/routines.js — Automation & Routines View
   ============================================================ */

// ── Drag state ────────────────────────────────────────────────
let dragItemData = null;

function renderRoutinesView(c) {
    const dayNames = ['Ming', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

    const section = (title, list, type, color) => `
    <div class="bg-[#202020] rounded-xl border border-[#2f2f2f] p-5 h-full flex flex-col shadow-md">
        <h4 class="text-[10px] font-bold ${color} uppercase mb-4 flex items-center gap-2 border-b border-[#333] pb-2">
            <i class="fa-solid fa-repeat"></i> ${title}
        </h4>
        <div class="flex-1 overflow-y-auto pr-1">
            ${list.map((r, idx) => `
            <div draggable="true"
                ondragstart="dragStart(event, '${type}', ${idx})"
                ondragover="dragOver(event)"
                ondrop="dropRoutine(event, '${type}', ${idx})"
                onclick="editRoutine('${type}', '${r.id}')"
                class="bg-[#252526] p-3 rounded-lg border border-[#3f3f3f] flex justify-between items-center group hover:border-purple-500 transition shadow-sm cursor-grab active:cursor-grabbing mb-2">
                <div class="truncate pr-2 pointer-events-none">
                    ${r.day  ? `<span class="text-[9px] bg-blue-900 text-blue-300 px-1.5 py-0.5 rounded font-bold mr-2">${dayNames[r.day]}</span>` : ''}
                    ${r.date ? `<span class="text-[9px] bg-orange-900 text-orange-300 px-1.5 py-0.5 rounded font-bold mr-2">Tgl ${r.date}</span>` : ''}
                    ${r.startTime && r.endTime ? `<span class="text-[9px] bg-slate-800 text-slate-300 px-1.5 py-0.5 rounded font-bold mr-2"><i class="fa-regular fa-clock mr-1"></i>${r.startTime} - ${r.endTime}</span>` : ''}
                    ${r.delegatedBy ? `<span class="text-[9px] bg-orange-900/30 text-orange-400 border border-orange-500/30 px-1.5 py-0.5 rounded font-bold mr-2 whitespace-nowrap"><i class="fa-solid fa-share-nodes mr-1"></i>Dari: ${r.delegatedByName || 'Atasan'}</span>` : ''}
                    <span class="text-xs font-bold text-gray-200">${r.title}</span>
                </div>
                <div class="flex gap-2 items-center">
                    <button onclick="moveRoutine('${type}', '${r.id}', -1); event.stopPropagation()"
                        class="text-gray-500 hover:text-white px-1 transition"><i class="fa-solid fa-chevron-up"></i></button>
                    <button onclick="moveRoutine('${type}', '${r.id}', 1); event.stopPropagation()"
                        class="text-gray-500 hover:text-white px-1 transition"><i class="fa-solid fa-chevron-down"></i></button>
                </div>
            </div>`).join('')}
        </div>
        <button onclick="openRoutineModal('${type}')"
            class="w-full mt-4 py-3 border border-dashed border-gray-600 rounded-lg text-[10px] text-gray-400 hover:text-white hover:border-white transition uppercase font-bold tracking-widest bg-[#1a1a1a]">
            + Tambah Baru
        </button>
    </div>`;

    c.innerHTML = `
    <div class="mb-4 flex justify-between items-center">
        <p class="text-xs text-gray-400">Atur pekerjaan yang berulang otomatis. Rutinitas tidak akan muncul di hari libur.</p>
        <button onclick="document.getElementById('holidayModal').classList.remove('hidden'); renderHolidays();"
            class="bg-red-900/30 text-red-400 border border-red-900 px-4 py-2 rounded-lg text-[10px] font-bold uppercase transition hover:bg-red-900/50">
            <i class="fa-solid fa-calendar-xmark mr-1"></i> Set Hari Libur
        </button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-full pb-10 w-full animate-fadein">
        ${section('HARIAN',        routines.daily,   'daily',   'text-blue-400')}
        ${section('MINGGUAN (HARI TERTENTU)',    routines.weekly,  'weekly',  'text-purple-400')}
        ${section('BULANAN (TGL TERTENTU)',      routines.monthly, 'monthly', 'text-orange-400')}
    </div>
    <div class="mt-4 text-center md:text-right pb-10">
        <button onclick="forceRecoverRoutines()"
            class="text-gray-600 hover:text-blue-400 text-[10px] underline italic transition">
            Data lama hilang? Pulihkan dari memori lokal
        </button>
    </div>`;
}

// --- DRAG AND DROP ROUTINE LOGIC (FIXED FOR MODULAR) ---
window.dragItemData = null;

window.dragStart = function(e, type, index) { 
    window.dragItemData = { type: type, index: index }; 
    e.dataTransfer.effectAllowed = 'move'; 
    setTimeout(() => e.target.classList.add('opacity-50'), 0); 
};

window.dragOver = function(e) { 
    e.preventDefault(); 
    e.dataTransfer.dropEffect = 'move'; 
};

window.dropRoutine = function(e, dropType, dropIndex) {
    e.preventDefault();
    if (!window.dragItemData || window.dragItemData.type !== dropType || window.dragItemData.index === dropIndex) { 
        if(typeof refreshActiveView === 'function') refreshActiveView(); 
        return; 
    }
    const list = routines[dropType];
    const itemToMove = list.splice(window.dragItemData.index, 1)[0];
    list.splice(dropIndex, 0, itemToMove);
    db.ref('routines/' + currentUser.uid).set(routines); // Save to cloud
};

// ── Reorder with arrows ────────────────────────────────────────
function moveRoutine(type, id, dir) {
    const list = routines[type];
    const idx  = list.findIndex(r => r.id == id);
    if (idx < 0) return;
    const newIdx = idx + dir;
    if (newIdx < 0 || newIdx >= list.length) return;
    const [item] = list.splice(idx, 1);
    list.splice(newIdx, 0, item);
    db.ref('routines/' + currentUser.uid).set(routines);
}

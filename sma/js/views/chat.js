/* PT SMA Enterprise OS CLOUD v10.3.9 - js/views/chat.js - Grup Chat per Divisi */
var _chatCurrentDept=null,_chatListener=null,_chatScope='mine',_chatUnread={},_chatLastSeen={};
(function(){try{_chatLastSeen=JSON.parse(localStorage.getItem('chat_lastseen')||'{}')}catch(e){}})();
function _chatSaveLastSeen(){try{localStorage.setItem('chat_lastseen',JSON.stringify(_chatLastSeen))}catch(e){}}

function _chatGetAllowedDepts(){
    if(!currentUser)return[];
    var role=currentUser.role,myDept=currentUser.department,allDepts=[];
    Object.values(allUsers).forEach(function(u){if(u.department&&allDepts.indexOf(u.department)<0)allDepts.push(u.department);});
    allDepts.sort();
    if(role==='SuperAdmin'||role==='Direktur'||role==='Executive')return allDepts;
    if(role==='Supervisor'){var w=currentUser.watchDepartment||myDept,d=[];[myDept,w].forEach(function(x){if(x&&d.indexOf(x)<0)d.push(x);});return d.sort();}
    return[myDept].filter(Boolean);
}
function _chatCanSeeAll(){var r=currentUser?currentUser.role:'';return r==='SuperAdmin'||r==='Direktur'||r==='Executive';}

function renderGroupChatView(c){
    var ad=_chatGetAllowedDepts(),myDept=currentUser?currentUser.department:'',canAll=_chatCanSeeAll();
    if(!_chatCurrentDept||ad.indexOf(_chatCurrentDept)<0)_chatCurrentDept=myDept||(ad[0]||null);
    var stHtml='';
    if(canAll){
        stHtml='<div class="flex gap-2 mb-3 border-b border-[#333] pb-3">'
            +'<button onclick="_chatScope=\'mine\';renderGroupChatView(document.getElementById(\'grupChatContainer\'))" class="px-4 py-1.5 rounded-lg text-[11px] font-bold transition '+(_chatScope==='mine'?'bg-emerald-600 text-white':'text-gray-400 hover:text-white hover:bg-[#2a2a2a]')+'">&#127970; Divisi Saya</button>'
            +'<button onclick="_chatScope=\'all\';renderGroupChatView(document.getElementById(\'grupChatContainer\'))" class="px-4 py-1.5 rounded-lg text-[11px] font-bold transition '+(_chatScope==='all'?'bg-emerald-600 text-white':'text-gray-400 hover:text-white hover:bg-[#2a2a2a]')+'">&#127760; Semua Divisi</button>'
            +'</div>';
    }
    var vis=(canAll&&_chatScope==='mine')?[myDept].filter(Boolean):ad;
    var dlHtml = '';
    if (vis.length > 1) {
        dlHtml = '<select onchange="_chatCurrentDept=this.value; _chatRenderWindow()" class="w-full bg-[#252525] text-white text-xs border border-[#3f3f3f] rounded-lg p-2 mb-2 outline-none">';
        vis.forEach(function(dept) {
            var mc = Object.values(allUsers).filter(function(u){return u.department===dept;}).length;
            var act = _chatCurrentDept===dept;
            var unr = _chatUnread[dept]||0;
            var safe = dept.replace(/\\/g,'\\\\').replace(/'/g,"\\'");
            var label = dept + ' (' + mc + ' org)' + (unr > 0 ? ' ['+unr+' pesan baru]' : '');
            dlHtml += '<option value="'+safe+'" '+(act?'selected':'')+'>'+label+'</option>';
        });
        dlHtml += '</select>';
    }

    c.innerHTML = '<div class="flex flex-col h-full w-full">'
        + '<div class="px-3 pt-3 pb-1 border-b border-[#2f2f2f] shrink-0">'
        + stHtml
        + dlHtml
        + '</div>'
        + '<div id="chatWindow" class="flex-1 flex flex-col bg-[#1a1a1a] overflow-hidden"><div class="flex items-center justify-center h-full text-gray-600 text-sm italic">Memuat...</div></div>'
        + '</div>';
    if(_chatCurrentDept)setTimeout(_chatRenderWindow,50);
}

function _chatRenderWindow(){
    var dept=_chatCurrentDept;if(!dept)return;
    var win=document.getElementById('chatWindow');if(!win)return;
    if(_chatListener){try{db.ref('group_chats/'+_chatSafeKey(dept)).off('value',_chatListener);}catch(e){}_chatListener=null;}
    win.innerHTML='<div class="flex items-center gap-2 p-2 border-b border-[#2a2a2a] shrink-0 bg-[#202020]">'
        +'<div class="w-7 h-7 rounded-full bg-emerald-900/40 border border-emerald-600/30 flex items-center justify-center text-emerald-400 font-bold text-xs">'+(dept.charAt(0)||'?')+'</div>'
        +'<div><p class="text-white font-bold text-xs">'+dept+'</p><p class="text-[9px] text-emerald-500">Real-time Grup</p></div></div>'
        +'<div id="chatMessages" class="flex-1 overflow-y-auto p-3 space-y-3 bg-[#151515]"></div>'
        +'<div class="p-2 border-t border-[#2a2a2a] shrink-0 bg-[#202020]">'
        +'<div class="flex gap-2 items-end">'
        +'<label class="cursor-pointer text-gray-500 hover:text-emerald-400 transition self-center" title="Lampiran"><i class="fa-solid fa-paperclip"></i><input type="file" id="chatFileInput" class="hidden" onchange="_chatUploadFile()"></label>'
        +'<div id="chatInputWrap" class="flex-1 bg-[#252525] rounded border border-[#3f3f3f] px-2 py-1.5 min-h-[32px] max-h-[80px] overflow-y-auto text-xs text-gray-200 outline-none" contenteditable="true" placeholder="Ketik pesan..." onkeydown="_chatKeyDown(event)"></div>'
        +'<button onclick="_chatSend()" class="shrink-0 w-8 h-8 bg-emerald-600 hover:bg-emerald-500 rounded flex items-center justify-center text-white transition shadow text-xs"><i class="fa-solid fa-paper-plane"></i></button>'
        +'</div><p class="text-[8px] text-gray-600 mt-1 pl-1">Enter = kirim &bull; Shift+Enter = baris baru</p></div>';
    _chatLastSeen[dept]=Date.now();_chatSaveLastSeen();_chatUnread[dept]=0;_updateGroupChatBadge();
    var msgRef=db.ref('group_chats/'+_chatSafeKey(dept)).orderByChild('timestamp').limitToLast(100);
    _chatListener=function(snap){var msgs=[];snap.forEach(function(ch){msgs.push(ch.val());});_chatRenderMessages(msgs,dept);};
    msgRef.on('value',_chatListener);
}

function _chatRenderMessages(msgs,dept){
    var el=document.getElementById('chatMessages');if(!el)return;
    var myUid=currentUser?currentUser.uid:'';
    el.innerHTML=msgs.length===0
        ?'<div class="text-center py-12"><i class="fa-solid fa-comment-dots text-4xl text-gray-700 mb-3 block"></i><p class="text-gray-500 text-sm">Belum ada pesan di grup ini</p><p class="text-gray-600 text-[10px] mt-1">Jadilah yang pertama menyapa! &#128075;</p></div>'
        :msgs.map(function(m){
            var isMe=m.uid===myUid;
            var time=m.timestamp?new Date(m.timestamp).toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit'}):'';
            var dateStr=m.timestamp?new Date(m.timestamp).toLocaleDateString('id-ID',{day:'numeric',month:'short'}):'';
            var bc=isMe?'ml-auto bg-emerald-700/70 border-emerald-600/40 text-white rounded-tl-2xl rounded-bl-2xl rounded-br-sm':'mr-auto bg-[#252525] border-[#333] text-gray-200 rounded-tr-2xl rounded-br-2xl rounded-bl-sm';
            var ah='';
            if(m.attachment){
                if(m.attachment.type&&m.attachment.type.startsWith('image/'))
                    ah='<a href="'+m.attachment.url+'" target="_blank" class="block mt-2"><img src="'+m.attachment.url+'" class="max-w-[200px] rounded-xl border border-white/10" alt="lampiran"></a>';
                else
                    ah='<a href="'+m.attachment.url+'" target="_blank" class="flex items-center gap-2 mt-2 bg-black/20 px-3 py-2 rounded-lg text-[11px] hover:bg-black/30 transition"><i class="fa-solid fa-file"></i> '+(m.attachment.name||'Lampiran')+'</a>';
            }
            return '<div class="flex flex-col '+(isMe?'items-end':'items-start')+'">'
                +(!isMe?'<p class="text-[9px] font-bold text-emerald-400 mb-1 ml-1">'+(m.name||'Anonim')+'</p>':'')
                +'<div class="max-w-[75%] px-4 py-2.5 rounded-2xl border '+bc+' text-sm leading-relaxed shadow-sm">'
                +'<p>'+_chatEscape(m.message||'')+'</p>'+ah
                +'<p class="text-[8px] opacity-50 mt-1 text-right">'+dateStr+' '+time+'</p></div></div>';
        }).join('');
    el.scrollTop=el.scrollHeight;
    if(msgs.length>0&&dept===_chatCurrentDept){var last=msgs[msgs.length-1];if(last.timestamp){_chatLastSeen[dept]=last.timestamp;_chatSaveLastSeen();}}
}

function _chatSend(){
    var dept=_chatCurrentDept;if(!dept||!currentUser)return;
    var inp=document.getElementById('chatInputWrap');if(!inp)return;
    var text=inp.innerText.trim();if(!text)return;
    db.ref('group_chats/'+_chatSafeKey(dept)).push({uid:currentUser.uid,name:currentUser.name||currentUser.email,message:text,timestamp:Date.now()});
    inp.innerHTML='';inp.focus();
}

function _chatUploadFile(){
    var fi=document.getElementById('chatFileInput');if(!fi||!fi.files[0])return;
    var file=fi.files[0],dept=_chatCurrentDept;if(!dept||!currentUser)return;
    var formData = new FormData();
    formData.append('file', file);
    showToast('Mengunggah lampiran...', 'info');

    fetch('api/upload.php', {
        method: 'POST',
        body: formData
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        if (data.success) {
            db.ref('group_chats/'+_chatSafeKey(dept)).push({
                uid: currentUser.uid,
                name: currentUser.name || currentUser.email,
                message: '',
                attachment: { url: data.url, name: data.name, type: data.type },
                timestamp: Date.now()
            });
            showToast('Lampiran berhasil dikirim!', 'success');
        } else {
            showToast('Gagal: ' + data.message, 'error');
        }
        fi.value = '';
    })
    .catch(function(e) {
        showToast('Gagal mengunggah: ' + e.message, 'error');
        fi.value = '';
    });
}

function _chatKeyDown(e){if(e.key==='Enter'&&!e.shiftKey){e.preventDefault();_chatSend();}}
function _chatSafeKey(d){return d.replace(/[.#$/[\]]/g,'_');}
function _chatEscape(s){return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');}

function _updateGroupChatBadge(){
    var b=document.getElementById('groupchat-badge');if(!b)return;
    var t=Object.values(_chatUnread).reduce(function(a,x){return a+x;},0);
    if(t>0){b.textContent=t>99?'99+':t;b.classList.remove('hidden');}else{b.classList.add('hidden');}
}

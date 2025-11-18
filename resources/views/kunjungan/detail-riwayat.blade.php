<!-- resources/views/kunjungan/detail-riwayat.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Riwayat – SAKTI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,Arial,Roboto; background:#fafbfd; color:#10282b; padding-bottom:92px;}
        .wrap{max-width:680px;margin:0 auto;padding:12px}
        header{display:flex;align-items:center;justify-content:space-between;padding:8px 4px 12px;border-bottom:1px solid rgba(0,0,0,0.06);background:#fff;position:sticky;top:0;z-index:30}
        header h1{font-size:18px;font-weight:700}
        .card{background:#fff;border-radius:8px;padding:12px;margin-top:12px;box-shadow:0 8px 24px rgba(12,30,34,0.04)}
        .label{font-weight:700;margin-bottom:6px;color:#163033}
        .input, .value{background:#f1f4f5;padding:10px;border-radius:6px;color:#163033;border:1px solid transparent}
        .input[contenteditable]{min-height:38px;padding:8px;border-radius:6px;background:#fff;border:1px solid #e6eaeb}
        .row{margin-bottom:12px;display:block}
        .two{display:flex;gap:8px}
        .two .col{flex:1}
        input[type="text"], input[type="datetime-local"] , input[type="date"], textarea, select {
            width:100%; padding:8px; border-radius:6px; border:1px solid #dfe6e6; background:#fff; color:#163033;
        }
        textarea{min-height:80px}
        .btn-save, .btn-temp { background:#2f9e71; color:#fff; border:0; padding:10px 14px; border-radius:8px; font-weight:700; cursor:pointer }
        .btn-temp { background:#1e88e5; }
        .btn-warning { background:#edba00; color:#fff; border:0; padding:10px 14px; border-radius:8px; font-weight:700; cursor:pointer }
        .btn-warning { background:#edba00; }
        .prod-note { font-size:13px;color:#6b7f85;margin-top:6px }
        /* Produk kotak */
        .produk-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:8px; margin-top:6px; }
        .prod-box { border:1px solid #e6e9eb; border-radius:8px; padding:10px; min-height:46px; display:flex; align-items:center; justify-content:space-between; background:#fafbfd; cursor:pointer; user-select:none }
        .prod-box .name { font-weight:600; color:#163033 }
        .prod-box .tick { width:26px;height:26px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:14px;color:#fff;background:#2f9e71; visibility:hidden }
        .prod-box.selected { border-color:#2f9e71; background:linear-gradient(180deg, rgba(47,158,113,0.06), #fff) }
        .prod-box.selected .tick { visibility:visible }
        .small-note{font-size:13px;color:#6b7a7a;margin-top:6px}
        .empty { text-align:center;color:#6b7f85;padding:28px 12px;border-radius:8px;background:#fff;box-shadow:0 8px 20px rgba(12,30,34,0.03) }
        .toast{position:fixed;left:50%;transform:translateX(-50%);bottom:22px;background:#263238;color:#fff;padding:10px 16px;border-radius:8px;display:none;z-index:200;box-shadow:0 6px 20px rgba(0,0,0,0.28)}
        @media (max-width:720px){ .two { flex-direction:column } .produk-grid { grid-template-columns:1fr } .wrap{padding:10px} }
    </style>
</head>
<body>
    <div class="wrap">
        <header>
            <h1>Detail Riwayat (Editable)</h1>
            <div>
                <a href="javascript:history.back()" title="Kembali" style="color:#2f5b68;text-decoration:none"><i class="fa-solid fa-arrow-left"></i></a>
            </div>
        </header>

        <div class="card" id="detailCard" aria-live="polite">
            <!-- form editable -->
            <div class="row">
                <div class="label">Nama Nasabah</div>
                <input id="inputNama" type="text" placeholder="Nama nasabah">
            </div>

            <div class="row">
                <div class="label">Alamat Lengkap</div>
                <textarea id="inputAlamat" placeholder="Alamat lengkap"></textarea>
            </div>

            <div class="row two">
                <div class="col">
                    <div class="label">Tanggal Kunjungan</div>
                    <input id="inputTanggal" type="datetime-local">
                </div>
                <div class="col">
                    <div class="label">Status Kunjungan</div>
                    <select id="inputStatus">
                        <option value="FOLLOW-UP">FOLLOW-UP</option>
                        <option value="PROGRES">PROGRES</option>
                        <option value="CLOSING">CLOSING</option>
                        <option value="TDK MINAT">TDK MINAT</option>
                    </select>
                </div>
            </div>

            <div class="row two">
                <div class="col">
                    <div class="label">Nomor Rekening</div>
                    <input id="inputRek" type="text" placeholder="Nomor rekening">
                </div>
                <div class="col">
                    <div class="label">Nomor CIF</div>
                    <input id="inputCif" type="text" placeholder="Nomor CIF">
                </div>
            </div>

            <div class="row">
                <div class="label">Titik Koordinat</div>
                <div style="display:flex;gap:8px">
                    <input id="inputKoord" type="text" placeholder="-6.200000,106.816696">
                    <button class="btn-warning" onclick="cekPeta()">Cek Peta</button>
                </div>
            </div>

            <div class="row">
                <div class="label">Produk yang Ditawarkan</div>
                <div class="prod-note">Klik kotak untuk memilih produk</div>

                <div class="produk-grid" id="produkGrid">
                    <!-- boxes will be generated by JS -->
                </div>
            </div>

            <div class="row">
                <div class="label">Buat Pengingat Follow-up</div>
                <div style="display:flex;gap:8px;align-items:center;">
                    <input id="inputReminder" type="datetime-local" style="flex:1">
                    <button id="btnSaveReminder" class="btn-temp">Simpan Pengingat</button>
                </div>
                <div class="small-note">Pengingat disimpan ke local. Tombol di bawah menyimpan seluruh data kunjungan.</div>
                <div id="reminderInfo" style="margin-top:6px;color:#2f5b68"></div>
            </div>

            <div style="display:flex;gap:8px;margin-top:10px;justify-content:flex-end">

                <button id="btnSaveLocal" class="btn-save">Simpan Permanen (local)</button>
                <a href="/riwayat-kunjungan" class="btn-temp" role="button">Kembali</a>
            </div>
        </div>
    </div>

    <div class="toast" id="toast">Tersimpan</div>

    <!-- expose server-side data to JS if available -->
    @if(isset($kunjungan))
    <script>window.__KUNJUNGAN = @json($kunjungan);</script>
    @endif

    <script>
    (function(){
        // konfigurasi produk (urut sesuai permintaan, tampil 2 kolom)
        const PRODUK = ['MTB','MTR','GIRO','Depositoo','Prioritas','Tab Now','MDS','Tab Reguler','EDC','IVM'];

        // elemen
        const elNama = document.getElementById('inputNama');
        const elAlamat = document.getElementById('inputAlamat');
        const elTanggal = document.getElementById('inputTanggal');
        const elRek = document.getElementById('inputRek');
        const elCif = document.getElementById('inputCif');
        const elKoord = document.getElementById('inputKoord');
        const elStatus = document.getElementById('inputStatus');
        const produkGrid = document.getElementById('produkGrid');
        const elReminder = document.getElementById('inputReminder');
        const reminderInfo = document.getElementById('reminderInfo');
        const btnSaveTemp = document.getElementById('btnSaveTemp');
        const btnSaveLocal = document.getElementById('btnSaveLocal');
        const btnSaveReminder = document.getElementById('btnSaveReminder');
        const toast = document.getElementById('toast');

        // id kunjungan: ambil dari server (window.__KUNJUNGAN.id) atau dari URL
        let kunjunganId = (window.__KUNJUNGAN && (window.__KUNJUNGAN.id || window.__KUNJUNGAN._id || window.__KUNJUNGAN.kode)) || null;
        if(!kunjunganId){
            // ambil last path segment
            try {
                const p = window.location.pathname.split('/').filter(Boolean);
                kunjunganId = p.length ? p[p.length-1] : 'temp';
            } catch(e){ kunjunganId = 'temp'; }
        }

        // build produk grid
        const selectedProducts = new Set();
        function buildProdukGrid(selectedList){
            produkGrid.innerHTML = '';
            PRODUK.forEach(name => {
                const box = document.createElement('div');
                box.className = 'prod-box';
                box.dataset.prod = name;
                box.innerHTML = `<span class="name">${name}</span><span class="tick"><i class="fa-solid fa-check"></i></span>`;
                if(selectedList && selectedList.map(x=>String(x).toLowerCase()).includes(name.toLowerCase())) {
                    box.classList.add('selected');
                    selectedProducts.add(name);
                }
                box.addEventListener('click', () => {
                    box.classList.toggle('selected');
                    if(box.classList.contains('selected')) selectedProducts.add(name);
                    else selectedProducts.delete(name);
                });
                produkGrid.appendChild(box);
            });
        }

        // helper storage keys
        const KEY_LIST = 'riwayat_kunjungan'; // array of objects (localStorage)
        const KEY_SELECTED = 'selected_riwayat'; // currently selected object (sessionStorage for quick redirect)
        const KEY_REMINDER_PREFIX = 'reminder_kunjungan_';

        // load initial data priority: 1) window.__KUNJUNGAN 2) sessionStorage.selected_riwayat 3) localStorage.riwayat_kunjungan by id
        function loadInitial(){
            let data = null;
            if(window.__KUNJUNGAN){
                data = window.__KUNJUNGAN;
            } else {
                const sessionRaw = sessionStorage.getItem(KEY_SELECTED);
                if(sessionRaw){
                    try{ data = JSON.parse(sessionRaw); } catch(e){ data = null; }
                }
            }
            if(!data && kunjunganId){
                try {
                    const rawList = localStorage.getItem(KEY_LIST);
                    if(rawList){
                        const arr = JSON.parse(rawList);
                        if(Array.isArray(arr)){
                            const found = arr.find(x => String(x.id) === String(kunjunganId) || String(x._id) === String(kunjunganId) || String(x.kode) === String(kunjunganId) || String(x.uuid) === String(kunjunganId));
                            if(found) data = found;
                        }
                    }
                } catch(e){}
            }

            // kalau ada data, isi form
            if(data){
                elNama.value = data.namaNasabah || data.nama || '';
                elAlamat.value = data.alamat || data.lokasi || '';
                // tanggal handling: bisa berupa ISO atau tanggal biasa
                if(data.tanggal) {
                    const t = normalizeToLocalDatetimeInput(data.tanggal);
                    if(t) elTanggal.value = t;
                } else if(data.created_at) {
                    const t = normalizeToLocalDatetimeInput(data.created_at);
                    if(t) elTanggal.value = t;
                }
                elRek.value = data.no_rekening || data.noRek || '';
                elCif.value = data.no_cif || data.cif || '';
                elKoord.value = data.koordinat || data.titik || '';
                elStatus.value = (data.status || data.statusKunjungan || '').toUpperCase() || 'FOLLOW-UP';

                // produk
                let prodList = [];
                if(Array.isArray(data.produk)) prodList = data.produk.map(p => typeof p === 'string' ? p : (p.nama||''));
                else if(typeof data.produk === 'string') prodList = data.produk.split(/[;,|]+/).map(x=>x.trim()).filter(Boolean);

                buildProdukGrid(prodList);

                // reminder
                let rem = data.reminder || data.reminder_datetime || data.reminder_at || '';
                if(typeof rem === 'object' && rem.datetime) rem = rem.datetime;
                if(rem) {
                    const t = normalizeToLocalDatetimeInput(rem);
                    if(t) elReminder.value = t;
                    reminderInfo.innerText = t ? `Pengingat: ${displayFromLocalDatetime(t)}` : '';
                } else {
                    // check localStorage reminder by id
                    const key = KEY_REMINDER_PREFIX + kunjunganId;
                    const raw = localStorage.getItem(key);
                    if(raw) {
                        try {
                            const obj = JSON.parse(raw);
                            if(obj && obj.datetime) {
                                elReminder.value = obj.datetime;
                                reminderInfo.innerText = `Pengingat: ${displayFromLocalDatetime(obj.datetime)}`;
                            }
                        } catch(e){}
                    }
                }
                return;
            }

            // kalau tidak ada data apapun, build empty produk grid
            buildProdukGrid([]);
        }

        // normalize various datetime strings into input value "YYYY-MM-DDTHH:mm"
        function normalizeToLocalDatetimeInput(v){
            if(!v) return '';
            // if already in format "YYYY-MM-DDTHH:MM"
            if(/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}/.test(v)) return v.slice(0,16);
            const d = new Date(v);
            if(isNaN(d)) return '';
            const pad = n=>String(n).padStart(2,'0');
            return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())}T${pad(d.getHours())}:${pad(d.getMinutes())}`;
        }

        function displayFromLocalDatetime(v){
            if(!v) return '';
            try {
                const d = new Date(v);
                if(isNaN(d)) return v;
                const pad = n=>String(n).padStart(2,'0');
                return `${pad(d.getDate())}/${pad(d.getMonth()+1)}/${d.getFullYear()} ${pad(d.getHours())}:${pad(d.getMinutes())}`;
            } catch(e){ return v; }
        }

        // Save current form into localStorage array and sessionStorage selected
        function gatherFormData(){
            const obj = {};
            obj.id = kunjunganId || ('temp-' + Date.now());
            obj.namaNasabah = elNama.value.trim();
            obj.alamat = elAlamat.value.trim();
            obj.tanggal = elTanggal.value ? elTanggal.value : '';
            obj.no_rekening = elRek.value.trim();
            obj.no_cif = elCif.value.trim();
            obj.koordinat = elKoord.value.trim();
            obj.status = elStatus.value || '';
            obj.produk = Array.from(selectedProducts);
            obj.reminder = elReminder.value || '';
            obj.saved_at = new Date().toISOString();
            return obj;
        }

        function saveToLocal(tempOnly = true){
            try{
                // read current list
                let list = [];
                const raw = localStorage.getItem(KEY_LIST);
                if(raw) {
                    try { list = JSON.parse(raw) || []; } catch(e){ list = []; }
                }
                const obj = gatherFormData();

                // replace existing by id
                const idx = list.findIndex(x => String(x.id) === String(obj.id) || String(x._id) === String(obj.id));
                if(idx >= 0) list[idx] = obj;
                else list.push(obj);

                // write back
                localStorage.setItem(KEY_LIST, JSON.stringify(list));
                // also set selected_riwayat in sessionStorage for immediate use
                try { sessionStorage.setItem(KEY_SELECTED, JSON.stringify(obj)); } catch(e){}

                // store reminder separately for quick lookup
                if(obj.reminder) localStorage.setItem(KEY_REMINDER_PREFIX + obj.id, JSON.stringify({ datetime: obj.reminder, saved_at: new Date().toISOString() }));

                showToast('Data disimpan lokal');

                return true;
            } catch(e){
                console.error(e);
                showToast('Gagal menyimpan');
                return false;
            }
        }

        // Save permanently (for our case same as saveToLocal but we show different message)
        function savePermanent(){
            const ok = saveToLocal(false);
            if(ok) showToast('Data tersimpan (localStorage)');
        }

        // save reminder quick button
        btnSaveReminder.addEventListener('click', function(e){
            e.preventDefault();
            const v = elReminder.value;
            if(!v){ showToast('Pilih tanggal & waktu pengingat'); return; }
            const key = KEY_REMINDER_PREFIX + (kunjunganId || ('temp-' + Date.now()));
            try {
                localStorage.setItem(key, JSON.stringify({ datetime: v, saved_at: new Date().toISOString() }));
                reminderInfo.innerText = `Pengingat: ${displayFromLocalDatetime(v)}`;
                showToast('Pengingat tersimpan');
            } catch(e){ console.error(e); showToast('Gagal menyimpan pengingat'); }
        });

        // cek peta
        window.cekPeta = function(){
            const c = elKoord.value.trim();
            if(!c){ alert('Koordinat kosong'); return; }
            const parts = c.replace(/\s+/g,'').split(/[ ,]+/);
            if(parts.length < 2){ alert('Format koordinat tidak valid'); return; }
            const url = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(parts[0]+','+parts[1])}`;
            window.open(url, '_blank');
        };

        // attach save buttons
        btnSaveTemp.addEventListener('click', function(e){
            e.preventDefault();
            saveToLocal(true);
        });
        btnSaveLocal.addEventListener('click', function(e){
            e.preventDefault();
            savePermanent();
        });

        // show toast
        function showToast(msg){
            toast.textContent = msg;
            toast.style.display = 'block';
            toast.style.opacity = '1';
            setTimeout(()=>{ toast.style.opacity = '0'; setTimeout(()=>toast.style.display='none',250) },1700);
        }

        // init
        loadInitial();

        // ensure changes in form update selectedProducts if user changes programmatically (not necessary but helpful)
        // e.g. if user types product names later, they won't be included — product selection only via boxes.

        // when page unload, optionally persist current edited values to sessionStorage so reopening page (same tab) keeps edits
        window.addEventListener('beforeunload', function(){
            try {
                const temp = gatherFormData();
                sessionStorage.setItem(KEY_SELECTED, JSON.stringify(temp));
            } catch(e){}
        });

    })();
    </script>
</body>
</html>

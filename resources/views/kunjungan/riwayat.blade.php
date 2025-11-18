<!-- resources/views/kunjungan/riwayat.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Riwayat Kunjungan – SAKTI</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,Roboto,Arial; background:#fafbfd; color:#10282b; padding-bottom:92px;}
        .wrap{max-width:520px;margin:0 auto;padding:12px 12px 20px 12px}

        header{display:flex;align-items:center;justify-content:space-between;padding:8px 4px 12px;border-bottom:1px solid rgba(0,0,0,0.06);background:#fff;position:sticky;top:0;z-index:30}
        header h1{font-size:18px;font-weight:700}
        .profile-icon img{width:36px;height:36px;border-radius:50%;object-fit:cover}

        .search-row{display:flex;gap:8px;margin-top:12px}
        .search-input{flex:1;display:flex;align-items:center;background:#f1f4f5;padding:8px 12px;border-radius:10px;box-shadow:0 6px 14px rgba(16,38,40,0.03)}
        .search-input input{border:0;background:transparent;outline:none;width:100%;font-size:14px}
        .filter-btn{display:block;margin-top:12px;background:#2f5b68;color:#fff;padding:10px;border-radius:8px;text-align:left;box-shadow:0 6px 14px rgba(47,91,104,0.12);border:0;width:100%}

        .list{margin-top:12px;display:flex;flex-direction:column;gap:12px}
        .card{
            background:#fff;border-radius:8px;padding:12px;box-shadow:0 8px 22px rgba(12,30,34,0.04);
            display:flex;gap:12px;align-items:flex-start;cursor:pointer;transition:transform .12s ease,box-shadow .12s ease;
            outline:none;
        }
        .card:focus, .card:hover { transform:translateY(-4px); box-shadow:0 12px 28px rgba(12,30,34,0.08); }

        .avatar{
            width:44px;height:44px;border-radius:8px;background:#eef3f4;display:flex;align-items:center;justify-content:center;color:#2f5b68;font-size:18px;flex-shrink:0
        }
        .card-body{flex:1}
        .card-title{font-weight:700;margin-bottom:6px;color:#163033;display:flex;align-items:center;justify-content:space-between;gap:8px}
        .card-meta{font-size:13px;color:#496163;margin-bottom:6px;display:flex;flex-direction:column;gap:6px}
        .card-meta .meta-row{display:flex;gap:8px;align-items:center}
        .meta-row i{color:#6a7f84}
        .badge { padding:6px 10px;border-radius:6px;color:#fff;font-weight:700;font-size:12px; }
        .badge.closing{background:#2f9e71}
        .badge.tdkminat{background:#e74c3c}
        .badge.followup{background:#f39c12}
        .badge.progres{background:#0ea5a0}

        .produk-multiple { margin-top: 4px; }
        .produk-item { background: #f8f9fa; border-radius: 6px; padding: 8px; margin-bottom: 6px; border-left: 3px solid #2f5b68; }
        .produk-item-name { font-weight: 600; color: #21393b; margin-bottom: 4px; }

        .empty { text-align:center;color:#6b7f85;padding:28px 12px;border-radius:8px;background:#fff;box-shadow:0 8px 20px rgba(12,30,34,0.03) }

        /* modal generic */
        .modal-backdrop {
            position:fixed; inset:0; background: rgba(0,0,0,0.35);
            display:none; align-items:center; justify-content:center; z-index:1100;
        }
        .modal {
            width:320px; background:#fff; padding:14px; border-radius:12px; box-shadow:0 8px 30px rgba(0,0,0,0.18);
        }
        .modal h3 { margin:0 0 8px 0; font-size:16px; color:#163033; text-align:center; }
        .modal .list { margin:8px 0 0 0; max-height:320px; overflow:auto; display:flex; flex-direction:column; gap:8px; }
        .modal .item {
            padding:10px 12px; border-radius:10px; background:#f1f4f5; cursor:pointer; font-weight:700; text-align:center;
        }
        .modal .item:hover { transform:translateY(-2px); box-shadow:0 6px 18px rgba(0,0,0,0.06); }

        /* time modal specific */
        .time-grid { display:flex; flex-wrap:wrap; gap:8px; justify-content:center; margin-top:8px; }
        .time-chip {
            padding:10px 12px; background:#f1f4f5; border-radius:12px; cursor:pointer; font-weight:700;
        }
        .time-chip.selected { background:#274a63; color:#fff; }

        /* small helper for clickable elements inside card */
        .no-propagate { display:inline-block; }

        @media(min-width:640px){ .wrap{padding:18px; margin-top:12px} .modal{width:380px} }
    </style>
</head>
<body>
    <div class="wrap">
        <header>
            <h1>Riwayat Kunjungan</h1>
            <div class="profile-icon" title="Profil">
                <a href="/profil"><img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="User"></a>
            </div>
        </header>

        <div class="search-row">
            <div class="search-input">
                <i class="fa-solid fa-search" style="margin-right:8px;color:#6b7f85"></i>
                <input id="searchInput" type="search" placeholder="Cari">
            </div>
            <button id="btnFilterToggle" class="filter-btn" style="flex:0 0 48%;">
                <i class="fa-solid fa-sliders" style="margin-right:8px"></i>
                <span id="filterLabel">Filter: Semua</span>
            </button>
        </div>

        <div id="listContainer" class="list" aria-live="polite" style="margin-top:12px">
            <!-- cards akan dirender disini -->
        </div>
    </div>

    @include('layouts.footer')

    <!-- Modal backdrop (reused) -->
    <div id="modalBackdrop" class="modal-backdrop" aria-hidden="true">
        <!-- Filter mode chooser -->
        <div id="modalFilterMode" class="modal" role="dialog" aria-modal="true" style="display:none;">
            <h3>Pilih Mode Filter</h3>
            <div class="list" style="margin-top:12px;">
                <div class="item" data-mode="time">By time</div>
                <div class="item" data-mode="product">By product</div>
                <div class="item" data-mode="kawasan">By kawasan</div>
                <div class="item" data-mode="clear" style="background:#ffecec;color:#c0392b">Clear filter</div>
            </div>
        </div>

        <!-- Time picker modal -->
        <div id="modalTime" class="modal" role="dialog" aria-modal="true" style="display:none;">
            <h3>Pilih Bulan</h3>
            <div class="time-grid" id="timeGrid">
                <!-- chips akan di-generate -->
            </div>
            <div style="display:flex;gap:8px;margin-top:12px;">
                <button id="timeOk" class="item" style="flex:1;background:#274a63;color:#fff">OK</button>
                <button id="timeCancel" class="item" style="flex:1;background:#f1f4f5">Batal</button>
            </div>
        </div>

        <!-- Product picker modal -->
        <div id="modalProduct" class="modal" role="dialog" aria-modal="true" style="display:none;">
            <h3>Pilih Produk</h3>
            <div class="list" id="productList" style="margin-top:8px;">
                <!-- diisi dinamis -->
            </div>
            <div style="margin-top:10px;display:flex;gap:8px;">
                <button id="productClear" class="item" style="flex:1;background:#ffecec;color:#c0392b">Hapus Filter</button>
                <button id="productClose" class="item" style="flex:1;background:#f1f4f5">Tutup</button>
            </div>
        </div>

        <!-- Kawasan picker modal -->
        <div id="modalKawasan" class="modal" role="dialog" aria-modal="true" style="display:none;">
            <h3>Pilih Kawasan</h3>
            <div class="list" id="kawasanList" style="margin-top:8px;">
                <!-- diisi dinamis -->
            </div>
            <div style="margin-top:10px;display:flex;gap:8px;">
                <button id="kawasanClear" class="item" style="flex:1;background:#ffecec;color:#c0392b">Hapus Filter</button>
                <button id="kawasanClose" class="item" style="flex:1;background:#f1f4f5">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        /* === util & data loader === */
        function formatDate(iso) {
            try {
                const d = new Date(iso);
                const dd = String(d.getDate()).padStart(2,'0');
                const mm = String(d.getMonth()+1).padStart(2,'0');
                const yyyy = d.getFullYear();
                const hh = String(d.getHours()).padStart(2,'0');
                const min = String(d.getMinutes()).padStart(2,'0');
                return dd + '/' + mm + '/' + yyyy + ', ' + hh + ':' + min;
            } catch (e) { return iso; }
        }
        function escapeHtml(s){ if(!s) return ''; return s.toString().replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'",'&#039;'); }
        function loadRiwayat() {
            const raw = sessionStorage.getItem('riwayat_kunjungan');
            if (!raw) return [];
            try { const arr = JSON.parse(raw); return Array.isArray(arr) ? arr : []; } catch (err) { console.warn('Failed parse riwayat_kunjungan:', err); return []; }
        }

        /* badge helper (pastikan PROGRES muncul kalau status kosong) */
        function getBadgeHtml(status) {
            if (!status) status = 'PROGRES';
            const s = status.toString().toUpperCase();
            let cls = 'progres', label = s;
            if (s.includes('CLOS')) { cls = 'closing'; label = 'CLOSING'; }
            else if (s.includes('TDK') || s.includes('TIDAK')) { cls = 'tdkminat'; label = 'TDK MINAT'; }
            else if (s.includes('FOLL') || s.includes('FOLLOW')) { cls = 'followup'; label = 'FOLLOW-UP'; }
            else if (s.includes('PROG')) { cls = 'progres'; label = 'PROGRES'; }
            return `<span class="badge ${cls}">${label}</span>`;
        }

        /* === navigasi ke detail === */
        function openDetail(id) {
            if (!id) return;
            // simpan selected item di sessionStorage agar halaman detail bisa fallback jika backend belum mengirim data
            const all = loadRiwayat();
            const found = all.find(x => (x.id && String(x.id) === String(id)) || (x._id && String(x._id) === String(id)) || (x.kode && String(x.kode) === String(id)));
            if (found) {
                try { sessionStorage.setItem('selected_riwayat', JSON.stringify(found)); } catch(e) { /* ignore */ }
            }
            // redirect ke route show (sesuaikan route Anda)
            window.location.href = '/kunjungan/' + encodeURIComponent(id);
        }

        // jangan trigger klik kartu saat menekan tombol dalam kartu
        function stopPropagationFor(el) {
            if(!el) return;
            el.addEventListener('click', function(e){ e.stopPropagation(); });
        }

        /* === filter state & dom refs === */
        let filterState = { mode:'', timeMonth:'', product:'', kawasan:'' };
        const listContainer = document.getElementById('listContainer');
        const searchInput = document.getElementById('searchInput');
        const filterLabel = document.getElementById('filterLabel');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalFilterMode = document.getElementById('modalFilterMode');
        const modalTime = document.getElementById('modalTime');
        const modalProduct = document.getElementById('modalProduct');
        const modalKawasan = document.getElementById('modalKawasan');

        function renderProdukList(produkData) {
            let html = '';
            if (Array.isArray(produkData)) {
                produkData.forEach(product => {
                    // support cases where product may be {nama, status} or just string
                    if (typeof product === 'object') {
                        const name = product.nama || product.name || '';
                        const status = product.status || product.statusProduk || 'PROGRES';
                        const badgeHtml = getBadgeHtml(status);
                        html += `<div class="meta-row" style="align-items:flex-start;margin:4px 0;">
                                    <i class="fa-solid fa-box-archive" style="margin-top:2px"></i>
                                    <div style="display:flex;flex-direction:column;">
                                        <div style="font-weight:600">${escapeHtml(name)}</div>
                                        <div style="margin-top:6px">${badgeHtml}</div>
                                    </div>
                                 </div>`;
                    } else if (typeof product === 'string') {
                        // string mungkin "Nama - STATUS"
                        let pname = product;
                        let pstatus = 'PROGRES';
                        if (product.indexOf(' - ') !== -1) {
                            const parts = product.split(' - ');
                            pname = parts[0].trim();
                            pstatus = parts[1].trim();
                        }
                        html += `<div class="meta-row" style="align-items:center;margin:4px 0;">
                                    <i class="fa-solid fa-box-archive"></i>
                                    <div style="display:flex;justify-content:space-between;gap:8px;width:100%;">
                                        <div style="font-weight:600">${escapeHtml(pname)}</div>
                                        <div>${getBadgeHtml(pstatus)}</div>
                                    </div>
                                 </div>`;
                    }
                });
            } else if (typeof produkData === 'string') {
                html += `<div class="meta-row"><i class="fa-solid fa-box-archive"></i> <div>Produk: ${escapeHtml(produkData)}</div></div>`;
            }
            return html;
        }

        /* render list with filters */
        function renderList() {
            listContainer.innerHTML = '';
            const all = loadRiwayat();

            // build sets for product/kawasan modals
            const productsSet = new Set();
            const kawasanSet = new Set();
            all.forEach(it => {
                if (Array.isArray(it.produk)) {
                    it.produk.forEach(p => {
                        if (typeof p === 'string') {
                            productsSet.add(p.split(' - ')[0].trim());
                        } else if (p.nama) productsSet.add(p.nama);
                    });
                } else if (typeof it.produk === 'string' && it.produk.trim() !== '') {
                    productsSet.add(it.produk.split(' - ')[0].trim());
                }
                if (it.kawasan) kawasanSet.add(it.kawasan);
            });

            populateProductList(Array.from(productsSet));
            populateKawasanList(Array.from(kawasanSet));
            populateTimeGrid();

            const q = (searchInput.value || '').trim().toLowerCase();
            const filtered = all.filter(item => {
                // mode filters
                if (filterState.mode === 'time' && filterState.timeMonth) {
                    const ts = new Date(item.timestamp || item.tanggal || item.createdAt || '');
                    if (isNaN(ts.getTime())) return false;
                    const mm = String(ts.getMonth()+1).padStart(2,'0');
                    if (mm !== filterState.timeMonth) return false;
                }
                if (filterState.mode === 'product' && filterState.product) {
                    if (!item.produk) return false;
                    let has = false;
                    if (Array.isArray(item.produk)) {
                        has = item.produk.some(p => (p.nama === filterState.product) || (typeof p === 'string' && p.startsWith(filterState.product)));
                    } else if (typeof item.produk === 'string') {
                        has = item.produk.startsWith(filterState.product);
                    }
                    if (!has) return false;
                }
                if (filterState.mode === 'kawasan' && filterState.kawasan) {
                    if (!item.kawasan || item.kawasan !== filterState.kawasan) return false;
                }

                if (!q) return true;
                const hay = ((item.namaNasabah||'') + ' ' + (item.produk||'') + ' ' + (item.kawasan||'') + ' ' + (item.lokasi||'') ).toLowerCase();
                return hay.indexOf(q) !== -1;
            });

            if (!filtered.length) {
                listContainer.innerHTML = `<div class="empty">
                    Belum ada riwayat saat ini.<br><small style="color:#6b7f85">Coba tambahkan kunjungan baru atau ubah filter/pencarian.</small>
                </div>`;
                return;
            }

            filtered.forEach(item => {
                const id = item.id || item._id || item.kode || item.uuid || ('auto-' + Math.random().toString(36).slice(2,9));
                const name = item.namaNasabah || item.nama || 'Nama Nasabah';
                const lokasi = item.kawasan || item.lokasi || 'Lokasi Kunjungan';
                const tanggal = formatDate(item.timestamp || item.tanggal || new Date().toISOString());

                const initial = String(name || '').trim().charAt(0).toUpperCase() || 'N';
                const fotoThumb = item.foto ? `<img src="${item.foto}" alt="foto" style="width:100%;border-radius:6px;margin-top:8px;max-height:160px;object-fit:cover">` : '';

                // produk rendering (adaptif)
                const produkHtml = item.produk ? renderProdukList(item.produk) : '';

                // status search order: prefer statusKunjungan > statusProduk > fallback 'PROGRES'
                const statusVal = item.statusKunjungan || item.statusProduk || (item.produk && (typeof item.produk === 'string' ? (item.produk.split(' - ')[1] || 'PROGRES') : 'PROGRES')) || 'PROGRES';
                const badgeHtml = getBadgeHtml(statusVal);

                const card = document.createElement('div');
                card.className = 'card';
                card.setAttribute('role','article');
                card.setAttribute('tabindex','0');
                card.dataset.id = id;

                // klik kartu -> buka detail
                card.addEventListener('click', function(){ openDetail(id); });
                card.addEventListener('keydown', function(e){ if(e.key === 'Enter') openDetail(id); });

                card.innerHTML = `
                    <div class="avatar">${initial}</div>
                    <div class="card-body">
                        <div class="card-title">
                            <div>${escapeHtml(name)}</div>
                            <div class="no-propagate">${badgeHtml}</div>
                        </div>
                        <div class="card-meta">
                            <div class="meta-row"><i class="fa-solid fa-location-dot"></i> <div>${escapeHtml(lokasi)}</div></div>
                            <div class="meta-row"><i class="fa-regular fa-calendar"></i> <div>${escapeHtml(tanggal)}</div></div>
                            ${produkHtml}
                            ${fotoThumb}
                        </div>
                    </div>
                `;
                listContainer.appendChild(card);

                // jika ada elemen yang perlu stopPropagation (mis. foto atau tombol), tambahkan di sini
                const imgs = card.querySelectorAll('img');
                imgs.forEach(i => stopPropagationFor(i));
            });
        }

        // ---------- MODAL HANDLERS ----------
        function openModal(which) {
            modalFilterMode.style.display = 'none';
            modalTime.style.display = 'none';
            modalProduct.style.display = 'none';
            modalKawasan.style.display = 'none';
            modalBackdrop.style.display = 'flex';
            modalBackdrop.setAttribute('aria-hidden','false');

            if (which === 'mode') modalFilterMode.style.display = 'block';
            if (which === 'time') modalTime.style.display = 'block';
            if (which === 'product') modalProduct.style.display = 'block';
            if (which === 'kawasan') modalKawasan.style.display = 'block';
        }
        function closeModal() {
            modalBackdrop.style.display = 'none';
            modalBackdrop.setAttribute('aria-hidden','true');
            modalFilterMode.style.display = modalTime.style.display = modalProduct.style.display = modalKawasan.style.display = 'none';
        }
        modalBackdrop.addEventListener('click', (e) => { if (e.target === modalBackdrop) closeModal(); });

        document.getElementById('btnFilterToggle').addEventListener('click', () => { openModal('mode'); });

        modalFilterMode.querySelectorAll('.item').forEach(it => {
            it.addEventListener('click', function(){
                const mode = this.getAttribute('data-mode');
                if (mode === 'clear') {
                    filterState = {mode:'', timeMonth:'', product:'', kawasan:''};
                    filterLabel.textContent = 'Filter: Semua';
                    closeModal();
                    renderList();
                    return;
                }
                closeModal();
                if (mode === 'time') setTimeout(()=>openModal('time'), 120);
                if (mode === 'product') setTimeout(()=>openModal('product'), 120);
                if (mode === 'kawasan') setTimeout(()=>openModal('kawasan'), 120);
            });
        });

        // ---------- TIME GRID ----------
        const months = [
            {v:'01',t:'Januari'},{v:'02',t:'Februari'},{v:'03',t:'Maret'},
            {v:'04',t:'April'},{v:'05',t:'Mei'},{v:'06',t:'Juni'},
            {v:'07',t:'Juli'},{v:'08',t:'Agustus'},{v:'09',t:'September'},
            {v:'10',t:'Oktober'},{v:'11',t:'November'},{v:'12',t:'Desember'}
        ];
        function populateTimeGrid() {
            const grid = document.getElementById('timeGrid');
            if (!grid) return;
            grid.innerHTML = '';
            months.forEach(m => {
                const el = document.createElement('div');
                el.className = 'time-chip' + (filterState.timeMonth === m.v ? ' selected' : '');
                el.textContent = m.t;
                el.dataset.month = m.v;
                el.addEventListener('click', () => {
                    if (filterState.timeMonth === m.v) filterState.timeMonth = '';
                    else filterState.timeMonth = m.v;
                    populateTimeGrid();
                });
                grid.appendChild(el);
            });
        }
        document.getElementById('timeOk').addEventListener('click', () => {
            if (filterState.timeMonth) {
                filterState.mode = 'time';
                const label = months.find(x => x.v === filterState.timeMonth)?.t || '';
                filterLabel.textContent = 'Filter: Time — ' + label;
            } else {
                filterState.mode = '';
                filterState.timeMonth = '';
                filterLabel.textContent = 'Filter: Semua';
            }
            closeModal();
            renderList();
        });
        document.getElementById('timeCancel').addEventListener('click', () => { closeModal(); });

        // ---------- PRODUCT MODAL ----------
        function populateProductList(products) {
            const list = document.getElementById('productList');
            if (!list) return;
            list.innerHTML = '';
            const allData = loadRiwayat();
            // build unique product names more robustly
            const productNames = new Set();
            allData.forEach(item => {
                if (Array.isArray(item.produk)) {
                    item.produk.forEach(p => {
                        if (typeof p === 'string') productNames.add(p.split(' - ')[0].trim());
                        else if (p.nama) productNames.add(p.nama);
                    });
                } else if (typeof item.produk === 'string' && item.produk.trim() !== '') {
                    productNames.add(item.produk.split(' - ')[0].trim());
                }
            });
            const uniqueProducts = Array.from(productNames).sort();
            if (!uniqueProducts.length) {
                list.innerHTML = `<div class="item" style="background:#fff;color:#6b7f85;border:1px dashed #e0e6e6">Tidak ada produk di data</div>`;
                return;
            }
            const allBtn = document.createElement('div'); allBtn.className='item'; allBtn.textContent='Semua Produk';
            allBtn.addEventListener('click', ()=>{ filterState.mode=''; filterState.product=''; filterLabel.textContent='Filter: Semua'; closeModal(); renderList(); });
            list.appendChild(allBtn);
            uniqueProducts.forEach(productName => {
                const el = document.createElement('div'); el.className='item'; el.textContent=productName;
                el.addEventListener('click', ()=>{ filterState.mode='product'; filterState.product=productName; filterLabel.textContent='Filter: Product — ' + productName; closeModal(); renderList(); });
                list.appendChild(el);
            });
        }
        document.getElementById('productClose').addEventListener('click', () => closeModal());
        document.getElementById('productClear').addEventListener('click', () => {
            filterState.mode=''; filterState.product=''; filterLabel.textContent='Filter: Semua'; closeModal(); renderList();
        });

        // ---------- KAWASAN MODAL ----------
        function populateKawasanList(kawasans) {
            const list = document.getElementById('kawasanList');
            if (!list) return;
            list.innerHTML = '';
            if (!kawasans.length) {
                list.innerHTML = `<div class="item" style="background:#fff;color:#6b7f85;border:1px dashed #e0e6e6">Tidak ada kawasan di data</div>`;
                return;
            }
            const allBtn = document.createElement('div'); allBtn.className='item'; allBtn.textContent='Semua Kawasan';
            allBtn.addEventListener('click', ()=>{ filterState.mode=''; filterState.kawasan=''; filterLabel.textContent='Filter: Semua'; closeModal(); renderList(); });
            list.appendChild(allBtn);
            kawasans.forEach(k => {
                const el = document.createElement('div'); el.className='item'; el.textContent=k;
                el.addEventListener('click', ()=>{ filterState.mode='kawasan'; filterState.kawasan=k; filterLabel.textContent='Filter: Kawasan — ' + k; closeModal(); renderList(); });
                list.appendChild(el);
            });
        }
        document.getElementById('kawasanClose').addEventListener('click', () => closeModal());
        document.getElementById('kawasanClear').addEventListener('click', () => {
            filterState.mode=''; filterState.kawasan=''; filterLabel.textContent='Filter: Semua'; closeModal(); renderList();
        });

        // ---------- Search / events ----------
        searchInput.addEventListener('input', renderList);

        // keyboard escape to close modal
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

        // initialize
        (function init(){ populateTimeGrid(); renderList(); })();
    </script>
</body>
</html>

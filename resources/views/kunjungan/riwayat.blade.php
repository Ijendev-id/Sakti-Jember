<!-- resources/views/kunjungan/riwayat.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Riwayat Kunjungan – SAKTI</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <!-- SweetAlert2 (optional jika butuh alert) -->
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
            background:#fff;border-radius:8px;padding:12px;box-shadow:0 8px 22px rgba(12,30,34,0.04);display:flex;gap:12px;align-items:flex-start;
        }
        .avatar{
            width:44px;height:44px;border-radius:8px;background:#eef3f4;display:flex;align-items:center;justify-content:center;color:#2f5b68;font-size:18px
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

        @media(min-width:640px){ .wrap{padding:18px; margin-top:12px} .modal{width:380px} }
    </style>
</head>
<body>
    <div class="wrap">
        <header>
            <h1>Riwayat Kunjungan</h1>
            <div class="profile-icon" title="Profil">
                <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="User">
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

    {{-- include footer --}}
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
        // util
        function formatDate(iso) {
            try {
                const d = new Date(iso);
                const dd = String(d.getDate()).padStart(2,'0');
                const mm = String(d.getMonth()+1).padStart(2,'0');
                const yyyy = d.getFullYear();
                return dd + '-' + mm + '-' + yyyy;
            } catch (e) { return iso; }
        }
        function escapeHtml(s){ if(!s) return ''; return s.toString().replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'",'&#039;'); }

        // storage reader
        function loadRiwayat() {
            const raw = sessionStorage.getItem('riwayat_kunjungan');
            if (!raw) return [];
            try { const arr = JSON.parse(raw); return Array.isArray(arr) ? arr : []; } catch (err) { console.warn('Failed parse riwayat_kunjungan:', err); return []; }
        }

        // badge helper
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

        // filter state
        let filterState = {
            mode: '', // '', 'time', 'product', 'kawasan'
            timeMonth: '', // '01'..'12'
            product: '',
            kawasan: ''
        };

        // DOM refs
        const listContainer = document.getElementById('listContainer');
        const searchInput = document.getElementById('searchInput');
        const filterLabel = document.getElementById('filterLabel');
        const modalBackdrop = document.getElementById('modalBackdrop');
        const modalFilterMode = document.getElementById('modalFilterMode');
        const modalTime = document.getElementById('modalTime');
        const modalProduct = document.getElementById('modalProduct');
        const modalKawasan = document.getElementById('modalKawasan');

        // render list with applied filters
        function renderList() {
            listContainer.innerHTML = '';
            const all = loadRiwayat();

            // build unique product/kawasan arrays for modals
            const productsSet = new Set();
            const kawasanSet = new Set();
            all.forEach(it => {
                if (it.produk) productsSet.add(it.produk);
                if (it.kawasan) kawasanSet.add(it.kawasan);
            });

            // filters
            const q = searchInput.value.trim().toLowerCase();
            const filtered = all.filter(item => {
                // apply mode filter
                if (filterState.mode === 'time' && filterState.timeMonth) {
                    const ts = new Date(item.timestamp || item.tanggal || item.createdAt || '');
                    if (isNaN(ts.getTime())) return false;
                    const mm = String(ts.getMonth()+1).padStart(2,'0');
                    if (mm !== filterState.timeMonth) return false;
                }
                if (filterState.mode === 'product' && filterState.product) {
                    if (!item.produk || item.produk !== filterState.product) return false;
                }
                if (filterState.mode === 'kawasan' && filterState.kawasan) {
                    if (!item.kawasan || item.kawasan !== filterState.kawasan) return false;
                }

                if (!q) return true;
                const hay = ((item.namaNasabah||'') + ' ' + (item.produk||'') + ' ' + (item.detail||'') + ' ' + (item.kawasan||'')).toLowerCase();
                return hay.indexOf(q) !== -1;
            });

            // update product/kawasan modal lists (dynamic)
            populateProductList(Array.from(productsSet));
            populateKawasanList(Array.from(kawasanSet));
            populateTimeGrid(); // always regenerate time chips

            if (!filtered.length) {
                listContainer.innerHTML = `<div class="empty">
                    Belum ada riwayat saat ini.<br><small style="color:#6b7f85">Coba tambahkan kunjungan baru atau ubah filter/pencarian.</small>
                </div>`;
                return;
            }

            filtered.forEach(item => {
                const name = item.namaNasabah || item.nama || 'Nama Nasabah';
                const lokasi = item.kawasan || item.lokasi || 'Lokasi Kunjungan';
                const tanggal = formatDate(item.timestamp || item.tanggal || new Date().toISOString());
                const produk = item.produk || '';
                const badgeHtml = getBadgeHtml(item.status);

                const initial = String(name || '').trim().charAt(0).toUpperCase() || 'N';
                const fotoThumb = item.foto ? `<img src="${item.foto}" alt="foto" style="width:100%;border-radius:6px;margin-top:8px;max-height:160px;object-fit:cover">` : '';

                const cardHtml = `
                    <div class="card" role="article" tabindex="0">
                        <div class="avatar">${initial}</div>
                        <div class="card-body">
                            <div class="card-title">
                                <div>${escapeHtml(name)}</div>
                                <div>${badgeHtml}</div>
                            </div>
                            <div class="card-meta">
                                <div class="meta-row"><i class="fa-solid fa-location-dot"></i> <div>${escapeHtml(lokasi)}</div></div>
                                <div class="meta-row"><i class="fa-regular fa-calendar"></i> <div>Tanggal: ${escapeHtml(tanggal)}</div></div>
                                ${produk ? `<div class="meta-row"><i class="fa-solid fa-box-archive"></i> <div>Produk: ${escapeHtml(produk)}</div></div>` : ''}
                                ${fotoThumb}
                            </div>
                        </div>
                    </div>
                `;
                listContainer.insertAdjacentHTML('beforeend', cardHtml);
            });
        }

        // ---------- MODAL HANDLERS ----------
        function openModal(which) {
            // hide all inner modals first
            modalFilterMode.style.display = 'none';
            modalTime.style.display = 'none';
            modalProduct.style.display = 'none';
            modalKawasan.style.display = 'none';
            modalBackdrop.style.display = 'flex';
            modalBackdrop.setAttribute('aria-hidden','false');

            if (which === 'mode') modalFilterMode.style.display = 'block';
            if (which === 'time') {
                modalTime.style.display = 'block';
            }
            if (which === 'product') modalProduct.style.display = 'block';
            if (which === 'kawasan') modalKawasan.style.display = 'block';
        }
        function closeModal() {
            modalBackdrop.style.display = 'none';
            modalBackdrop.setAttribute('aria-hidden','true');
            modalFilterMode.style.display = modalTime.style.display = modalProduct.style.display = modalKawasan.style.display = 'none';
        }

        // clicking backdrop closes
        modalBackdrop.addEventListener('click', (e) => {
            if (e.target === modalBackdrop) closeModal();
        });

        // show filter mode chooser
        document.getElementById('btnFilterToggle').addEventListener('click', () => {
            openModal('mode');
        });

        // modalFilterMode selections
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
                // open the corresponding picker modal
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
                    // toggle
                    if (filterState.timeMonth === m.v) {
                        filterState.timeMonth = '';
                    } else {
                        filterState.timeMonth = m.v;
                    }
                    // update selection styles
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
                // if no month chosen, clear time filter
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
            if (!products.length) {
                list.innerHTML = `<div class="item" style="background:#fff;color:#6b7f85;border:1px dashed #e0e6e6">Tidak ada produk di data</div>`;
                return;
            }
            // add 'All' option at top
            const allBtn = document.createElement('div');
            allBtn.className = 'item';
            allBtn.textContent = 'Semua Produk';
            allBtn.addEventListener('click', () => {
                filterState.mode = '';
                filterState.product = '';
                filterLabel.textContent = 'Filter: Semua';
                closeModal();
                renderList();
            });
            list.appendChild(allBtn);

            products.forEach(p => {
                const el = document.createElement('div');
                el.className = 'item';
                el.textContent = p;
                el.addEventListener('click', () => {
                    filterState.mode = 'product';
                    filterState.product = p;
                    filterLabel.textContent = 'Filter: Product — ' + p;
                    closeModal();
                    renderList();
                });
                list.appendChild(el);
            });
        }
        document.getElementById('productClose').addEventListener('click', () => closeModal());
        document.getElementById('productClear').addEventListener('click', () => {
            filterState.mode = '';
            filterState.product = '';
            filterLabel.textContent = 'Filter: Semua';
            closeModal(); renderList();
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
            const allBtn = document.createElement('div');
            allBtn.className = 'item';
            allBtn.textContent = 'Semua Kawasan';
            allBtn.addEventListener('click', () => {
                filterState.mode = '';
                filterState.kawasan = '';
                filterLabel.textContent = 'Filter: Semua';
                closeModal();
                renderList();
            });
            list.appendChild(allBtn);

            kawasans.forEach(k => {
                const el = document.createElement('div');
                el.className = 'item';
                el.textContent = k;
                el.addEventListener('click', () => {
                    filterState.mode = 'kawasan';
                    filterState.kawasan = k;
                    filterLabel.textContent = 'Filter: Kawasan — ' + k;
                    closeModal();
                    renderList();
                });
                list.appendChild(el);
            });
        }
        document.getElementById('kawasanClose').addEventListener('click', () => closeModal());
        document.getElementById('kawasanClear').addEventListener('click', () => {
            filterState.mode = '';
            filterState.kawasan = '';
            filterLabel.textContent = 'Filter: Semua';
            closeModal(); renderList();
        });

        // ---------- Search / events ----------
        searchInput.addEventListener('input', renderList);

        // keyboard escape to close modal
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        // initialize time grid and initial render
        (function init(){
            populateTimeGrid();
            renderList();
        })();
    </script>
</body>
</html>

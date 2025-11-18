<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mulai Kunjungan Baru – SAKTI</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:Inter,Roboto,Arial; background:#fafbfd; color:#0f2b2f; padding-bottom:100px;}
        .wrap{max-width:520px;margin:0 auto;padding:12px;}
        header{background:#fff;padding:10px 12px;border-bottom:1px solid rgba(0,0,0,0.06);position:sticky;top:0;z-index:20}
        header h1{font-size:18px;font-weight:600}
        .card{background:#fff;border-radius:8px;padding:12px;margin-top:12px;box-shadow:0 8px 20px rgba(12,30,34,0.06)}
        .section-title{color:#21393b;font-weight:600;margin-bottom:8px}
        .field{background:#f1f4f5;border-radius:6px;padding:12px;margin-bottom:12px;box-shadow:0 6px 12px rgba(16,38,40,0.03)}
        .field input[type="text"], .field textarea, .field select{width:100%;border:0;background:transparent;font-size:14px;outline:none;}
        .label-small{font-size:13px;color:#425a5b;margin-bottom:6px}
        textarea{min-height:120px;resize:vertical}
        .btn-row{display:flex;gap:12px;margin-top:10px}
        .btn{flex:1;padding:12px;border-radius:8px;border:0;font-weight:700;cursor:pointer}
        .btn-cancel{background:#cfcfcf;color:#1f2325}
        .btn-submit{background:#2f5b68;color:#fff}
        .upload-preview{display:block;margin-top:8px;border-radius:8px;max-width:100%;height:auto;box-shadow:0 6px 18px rgba(0,0,0,0.06)}
        .small-note{font-size:12px;color:#5b6d6f;margin-top:6px}
        .icon-left{display:inline-flex;align-items:center;gap:8px}
        @media(min-width:640px){ .wrap{padding:20px} header h1{font-size:20px}}

        /* Produk button & card */
        .produk-btn { display:flex;align-items:center;justify-content:space-between;padding:18px;border-radius:8px;background:#fff;box-shadow:0 6px 14px rgba(0,0,0,0.06);cursor:pointer;margin-bottom:14px; }
        .produk-btn .left{display:flex;align-items:center;gap:12px}
        .produk-btn .left .icon{width:44px;height:44px;border-radius:8px;background:#2f5b68;color:#fff;display:flex;align-items:center;justify-content:center;font-size:18px}
        .produk-btn .title{font-size:18px;font-weight:700;color:#21393b}
        .produk-card{ background:#fff;border-radius:8px;padding:18px;box-shadow:0 6px 18px rgba(0,0,0,0.06);margin-bottom:12px;display:flex;align-items:center;justify-content:space-between; }
        .produk-card .left{font-size:18px;font-weight:700;color:#21393b}
        .produk-card .badge{ background:#27a1ff;color:#07304a;padding:10px 28px;border-radius:12px;font-weight:700;box-shadow:0 4px 8px rgba(39,161,255,0.18); }
        .produk-indicator { width:16px;height:16px;border-radius:50%;background:#274a63; }
        .produk-indicator.hidden { display:none; }

        .produk-list { margin-top: 8px; }
        .produk-item { display: flex; justify-content: space-between; align-items: center; padding: 10px; background: #f8f9fa; border-radius: 6px; margin-bottom: 8px; }
        .produk-item-info { flex: 1; }
        .produk-item-name { font-weight: 600; color: #21393b; }
        .produk-item-status { font-size: 12px; color: #6b7b7d; }
        .produk-item-remove { background: #e74c3c; color: white; border: none; border-radius: 4px; padding: 4px 8px; cursor: pointer; font-size: 12px; }
        .produk-count { background: #e74c3c; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; }

        /* thumbnails */
        .thumb {
            width:72px;
            height:72px;
            object-fit:cover;
            border-radius:6px;
            box-shadow:0 6px 12px rgba(16,38,40,0.06);
            border:2px solid rgba(0,0,0,0.03);
            cursor:pointer;
        }
        .thumb.selected { outline:3px solid rgba(47,91,104,0.12); }
    </style>
</head>
<body>
    <div class="wrap">
        <header><h1>Mulai Kunjungan Baru</h1></header>
        <div class="card">
            <div class="section-title">Informasi Awal</div>
            <label class="label-small">Nama Nasabah</label>
            <div class="field">
                <input id="namaNasabah" type="text" placeholder="Nama Nasabah">
            </div>
            <label class="label-small">Nama Perusahaan (Opsional)</label>
            <div class="field">
                <input id="namaPerusahaan" type="text" placeholder="Nama Perusahaan (Opsional)">
            </div>
            <label class="label-small">Produk yang Ditawarkan</label>
            <div id="produkButton" class="produk-btn" role="button" aria-label="Pilih produk">
                <div class="left">
                    <div class="icon"><i class="fa-solid fa-bag-shopping"></i></div>
                    <div>
                        <div class="title">Produk yang Ditawarkan</div>
                        <div id="produkSubtitle" style="font-size:13px;color:#6b7b7d;margin-top:4px">Pilih produk...</div>
                    </div>
                </div>
                <div id="produkCount" class="produk-count" style="display:none">0</div>
            </div>

            <div id="produkListWrapper" class="produk-list" style="display:none"></div>

            <div style="height:6px"></div>
            <label class="label-small">Detail Kunjungan</label>
            <div class="field">
                {{-- <textarea id="detailKunjungan" placeholder="Tuliskan catatan/temuan selama kunjungan..."></textarea> --}}
                <input id="detailKunjungan" type="text" placeholder="Tuliskan catatan/temuan selama kunjungan..">
            </div>

            <!-- Unggah Foto (dengan Kamera + Galeri multiple) -->
            <label class="label-small">Unggah Foto Kunjungan Kawasan</label>
            <div class="field">
                <div style="display:flex;align-items:center;gap:8px;">
                    <!-- Tombol Ambil Foto (kamera) -->
                    <div id="btnAmbilFoto" style="cursor:pointer;display:flex;align-items:center;gap:8px;">
                        <i class="fa-solid fa-camera" style="font-size:18px;color:#2f5b68"></i>
                        <span style="color:#2f5b68;font-weight:700">Ambil Foto</span>
                    </div>

                    <!-- Tombol Upload Galeri -->
                    <div id="btnUploadGallery" style="cursor:pointer;display:flex;align-items:center;gap:8px;">
                        <i class="fa-solid fa-image" style="font-size:18px;color:#2f5b68"></i>
                        <span style="color:#2f5b68;font-weight:700">Galeri</span>
                    </div>

                    <!-- Hidden inputs -->
                    <input id="fotoInput" type="file" accept="image/*" style="display:none">
                    <!-- galleryInput mendukung multiple -->
                    <input id="galleryInput" type="file" accept="image/*" multiple style="display:none">
                </div>

                <!-- Preview utama dan thumbnails -->
                <div id="previewWrapper" style="margin-top:8px;display:none">
                    <img id="fotoPreview" class="upload-preview" alt="Preview Foto"/>
                    <div id="thumbsWrapper" style="display:flex;gap:8px;margin-top:8px;flex-wrap:wrap"></div>
                    <div class="small-note">Preview foto akan disimpan sementara bersama data kunjungan. Foto pertama akan digunakan sebagai foto utama — klik thumbnail untuk mengganti foto utama.</div>
                </div>
            </div>

            <div class="btn-row">
                <button id="btnBack" class="btn btn-cancel" type="button">Kembali</button>
                <button id="btnSend" class="btn btn-submit" type="button">Kirim</button>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        // ROUTE placeholders (Blade will render these)
        const OPSI_ROUTE = "{{ route('kunjungan.opsi') }}";
        const KAMERA_ROUTE = "{{ route('kunjungan.kamera') }}";
        const RIWAYAT_URL = "{{ route('riwayat.kunjungan') }}";

        // --- Session management helpers ---
        function clearAllDrafts() {
            sessionStorage.removeItem('form_kunjungan');
            sessionStorage.removeItem('foto_kunjungan'); // main single image (camera compatibility)
            sessionStorage.removeItem('foto_kunjungan_gallery'); // array of images from gallery
            sessionStorage.removeItem('produk_dipilih');
            sessionStorage.removeItem('status_produk');
            sessionStorage.removeItem('form_kunjungan_partial');
        }

        (function decideClearOnOpen() {
            const flag = sessionStorage.getItem('coming_back_from');
            if (!flag) {
                clearAllDrafts();
            } else {
                sessionStorage.removeItem('coming_back_from');
            }
        })();

        // DOM elements (produk code preserved)
        const produkBtn = document.getElementById('produkButton');
        const produkSubtitle = document.getElementById('produkSubtitle');
        const produkCount = document.getElementById('produkCount');
        const produkListWrapper = document.getElementById('produkListWrapper');
        const btnAmbilFoto = document.getElementById('btnAmbilFoto');
        const fotoInput = document.getElementById('fotoInput');
        const galleryInput = document.getElementById('galleryInput');
        const btnUploadGallery = document.getElementById('btnUploadGallery');
        const previewWrapper = document.getElementById('previewWrapper');
        const fotoPreview = document.getElementById('fotoPreview');
        const thumbsWrapper = document.getElementById('thumbsWrapper');
        const btnBack = document.getElementById('btnBack');
        const btnSend = document.getElementById('btnSend');

        let fotoDataUrl = null;            // single main image dataURL (for backward compatibility)
        let galleryDataUrls = [];         // array of dataURLs from gallery (multiple)

        // Product selection helpers (same as before)
        function getSelectedProducts() {
            const stored = sessionStorage.getItem('produk_dipilih');
            if (!stored) return [];
            try { return JSON.parse(stored); } catch (e) { return []; }
        }
        function saveSelectedProducts(products) {
            sessionStorage.setItem('produk_dipilih', JSON.stringify(products));
        }
        function renderSelectedProducts() {
            const products = getSelectedProducts();
            if (products.length > 0) {
                produkSubtitle.textContent = `${products.length} produk dipilih`;
                produkCount.textContent = products.length;
                produkCount.style.display = 'flex';
                produkListWrapper.style.display = 'block';
                produkListWrapper.innerHTML = '';
                products.forEach((product, index) => {
                    const productItem = document.createElement('div');
                    productItem.className = 'produk-item';
                    productItem.innerHTML = `
                        <div class="produk-item-info">
                            <div class="produk-item-name">${escapeHtml(product.nama)}</div>
                            <div class="produk-item-status">Status: ${escapeHtml(product.status)}</div>
                        </div>
                        <button class="produk-item-remove" data-index="${index}">Hapus</button>
                    `;
                    produkListWrapper.appendChild(productItem);
                });
                document.querySelectorAll('.produk-item-remove').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = parseInt(this.getAttribute('data-index'));
                        removeProduct(index);
                    });
                });
            } else {
                produkSubtitle.textContent = 'Pilih produk...';
                produkCount.style.display = 'none';
                produkListWrapper.style.display = 'none';
            }
        }
        function removeProduct(index) {
            const products = getSelectedProducts();
            products.splice(index, 1);
            saveSelectedProducts(products);
            renderSelectedProducts();
        }

        // Save partial form and navigate (same)
        function simpanPartialAndGo(url, from) {
            const partial = {
                namaNasabah: document.getElementById('namaNasabah').value || '',
                namaPerusahaan: document.getElementById('namaPerusahaan').value || ''
            };
            sessionStorage.setItem('form_kunjungan_partial', JSON.stringify(partial));
            sessionStorage.setItem('coming_back_from', from);
            window.location.href = url;
        }
        produkBtn.addEventListener('click', () => simpanPartialAndGo(OPSI_ROUTE, 'opsi'));

        // CAMERA button -> go to kamera route (ke handphone camera handler)
        if (btnAmbilFoto) btnAmbilFoto.addEventListener('click', () => simpanPartialAndGo(KAMERA_ROUTE, 'camera'));

        // GALERI button -> trigger gallery input
        if (btnUploadGallery) btnUploadGallery.addEventListener('click', () => {
            galleryInput.click();
        });

        // FOTO input (single) - for potential direct file selection
        fotoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                fotoDataUrl = ev.target.result;
                // store single image for camera compatibility
                sessionStorage.setItem('foto_kunjungan', fotoDataUrl);
                // clear gallery store (we prioritize gallery if present)
                sessionStorage.removeItem('foto_kunjungan_gallery');
                galleryDataUrls = [];
                thumbsWrapper.innerHTML = '';
                fotoPreview.src = fotoDataUrl;
                thumbsWrapper.innerHTML = `<img src="${fotoDataUrl}" class="thumb selected" />`;
                previewWrapper.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        // GALLERY input (multiple)
        galleryInput.addEventListener('change', async (e) => {
            const files = Array.from(e.target.files || []);
            if (files.length === 0) return;

            galleryDataUrls = [];
            thumbsWrapper.innerHTML = '';

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (!file.type.startsWith('image/')) continue;
                try {
                    const dataUrl = await readFileAsDataURL(file);
                    galleryDataUrls.push(dataUrl);
                } catch (err) {
                    console.warn('Gagal membaca file', err);
                }
            }

            // Save gallery array and also set the main foto_kunjungan to first item for compatibility
            if (galleryDataUrls.length > 0) {
                fotoDataUrl = galleryDataUrls[0];
                sessionStorage.setItem('foto_kunjungan', fotoDataUrl);
                sessionStorage.setItem('foto_kunjungan_gallery', JSON.stringify(galleryDataUrls));
                fotoPreview.src = fotoDataUrl;
                previewWrapper.style.display = 'block';
            }

            // render thumbnails
            galleryDataUrls.forEach((d, idx) => {
                const img = document.createElement('img');
                img.src = d;
                img.className = 'thumb' + (idx === 0 ? ' selected' : '');
                img.title = `Foto ${idx+1}`;
                img.addEventListener('click', () => {
                    fotoDataUrl = d;
                    sessionStorage.setItem('foto_kunjungan', fotoDataUrl);
                    fotoPreview.src = d;
                    thumbsWrapper.querySelectorAll('img').forEach(x => x.classList.remove('selected'));
                    img.classList.add('selected');
                });
                thumbsWrapper.appendChild(img);
            });
        });

        function readFileAsDataURL(file) {
            return new Promise((resolve, reject) => {
                const r = new FileReader();
                r.onload = () => resolve(r.result);
                r.onerror = () => reject(new Error('File read error'));
                r.readAsDataURL(file);
            });
        }

        // Load partials and existing session images on DOMContentLoaded
        document.addEventListener('DOMContentLoaded', () => {
            const partial = sessionStorage.getItem('form_kunjungan_partial');
            if (partial) {
                try {
                    const d = JSON.parse(partial);
                    if (d.namaNasabah) document.getElementById('namaNasabah').value = d.namaNasabah;
                    if (d.namaPerusahaan) document.getElementById('namaPerusahaan').value = d.namaPerusahaan;
                } catch (err) { console.warn('parse partial failed', err); }
                sessionStorage.removeItem('form_kunjungan_partial');
            }

            renderSelectedProducts();

            // load gallery array if any
            const galleryFromStorage = sessionStorage.getItem('foto_kunjungan_gallery');
            if (galleryFromStorage) {
                try {
                    galleryDataUrls = JSON.parse(galleryFromStorage) || [];
                } catch (err) {
                    galleryDataUrls = [];
                }
            }

            // load single/main image (camera compatibility)
            const fotoFromCamera = sessionStorage.getItem('foto_kunjungan');
            if (galleryDataUrls.length > 0) {
                // render gallery thumbs
                thumbsWrapper.innerHTML = '';
                galleryDataUrls.forEach((d, idx) => {
                    const img = document.createElement('img');
                    img.src = d;
                    img.className = 'thumb' + (idx === 0 ? ' selected' : '');
                    img.title = `Foto ${idx+1}`;
                    img.addEventListener('click', () => {
                        fotoDataUrl = d;
                        sessionStorage.setItem('foto_kunjungan', fotoDataUrl);
                        fotoPreview.src = d;
                        thumbsWrapper.querySelectorAll('img').forEach(x => x.classList.remove('selected'));
                        img.classList.add('selected');
                    });
                    thumbsWrapper.appendChild(img);
                });
                fotoDataUrl = galleryDataUrls[0];
                fotoPreview.src = fotoDataUrl;
                previewWrapper.style.display = 'block';
            } else if (fotoFromCamera) {
                fotoDataUrl = fotoFromCamera;
                fotoPreview.src = fotoDataUrl;
                previewWrapper.style.display = 'block';
                thumbsWrapper.innerHTML = `<img src="${fotoDataUrl}" class="thumb selected" />`;
            }
        });

        // also refresh when tab becomes visible
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible') {
                renderSelectedProducts();
                const galleryFromStorage = sessionStorage.getItem('foto_kunjungan_gallery');
                if (galleryFromStorage) {
                    try {
                        galleryDataUrls = JSON.parse(galleryFromStorage) || [];
                    } catch (err) {
                        galleryDataUrls = [];
                    }
                }
                const fotoFromCamera = sessionStorage.getItem('foto_kunjungan');
                if (galleryDataUrls.length > 0) {
                    thumbsWrapper.innerHTML = '';
                    galleryDataUrls.forEach((d, idx) => {
                        const img = document.createElement('img');
                        img.src = d;
                        img.className = 'thumb' + (idx === 0 ? ' selected' : '');
                        img.title = `Foto ${idx+1}`;
                        img.addEventListener('click', () => {
                            fotoDataUrl = d;
                            sessionStorage.setItem('foto_kunjungan', fotoDataUrl);
                            fotoPreview.src = d;
                            thumbsWrapper.querySelectorAll('img').forEach(x => x.classList.remove('selected'));
                            img.classList.add('selected');
                        });
                        thumbsWrapper.appendChild(img);
                    });
                    fotoDataUrl = galleryDataUrls[0];
                    fotoPreview.src = fotoDataUrl;
                    previewWrapper.style.display = 'block';
                } else if (fotoFromCamera) {
                    fotoDataUrl = fotoFromCamera;
                    fotoPreview.src = fotoDataUrl;
                    previewWrapper.style.display = 'block';
                    if (thumbsWrapper.children.length === 0) {
                        thumbsWrapper.innerHTML = `<img src="${fotoDataUrl}" class="thumb selected" />`;
                    }
                }
            }
        });

        btnBack.addEventListener('click', () => window.history.back());

        // Riwayat helpers
        function loadRiwayat() {
            const raw = sessionStorage.getItem('riwayat_kunjungan');
            if (!raw) return [];
            try { const arr = JSON.parse(raw); return Array.isArray(arr) ? arr : []; } catch(e){ return []; }
        }
        function saveRiwayat(arr) { sessionStorage.setItem('riwayat_kunjungan', JSON.stringify(arr)); }

        // Send handler: store entire gallery array if present, otherwise single foto (as array to keep format consistent)
        btnSend.addEventListener('click', () => {
            const namaNasabah = document.getElementById('namaNasabah').value.trim();
            const namaPerusahaan = document.getElementById('namaPerusahaan').value.trim();
            const products = getSelectedProducts();
            const detail = document.getElementById('detailKunjungan').value.trim();
            const kawasan = sessionStorage.getItem('kawasan_terpilih') || '';

            if (!namaNasabah) {
                Swal.fire({icon:'warning', title:'Mohon isi Nama Nasabah'});
                return;
            }
            if (products.length === 0) {
                Swal.fire({icon:'warning', title:'Mohon pilih minimal 1 Produk yang Ditawarkan'});
                return;
            }

            // Format products for display
            const produkText = products.map(p => `${p.nama} - ${p.status}`).join(', ');

            Swal.fire({
                title: 'Konfirmasi Kirim',
                html: `<p>Anda akan menyimpan kunjungan untuk <b>${escapeHtml(namaNasabah)}</b> (${escapeHtml(kawasan)})</p>
                       <p><b>Produk:</b> ${escapeHtml(produkText)}</p>
                       <p>Lanjutkan?</p>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then(res => {
                if (res.isConfirmed) {
                    const now = new Date();

                    // Determine foto array to store
                    let fotoToStore = null;
                    // prefer gallery array if exists
                    if (galleryDataUrls.length > 0) {
                        fotoToStore = galleryDataUrls.slice(); // copy
                    } else if (fotoDataUrl) {
                        fotoToStore = [fotoDataUrl];
                    } else {
                        fotoToStore = null;
                    }

                    const entry = {
                        id: 'k-' + now.getTime(),
                        namaNasabah,
                        namaPerusahaan,
                        produk: products, // array of products
                        produkText: produkText, // For display purposes
                        detail,
                        kawasan,
                        foto: fotoToStore, // array or null
                        timestamp: now.toISOString()
                    };
                    const arr = loadRiwayat();
                    arr.unshift(entry);
                    saveRiwayat(arr);

                    // Clear session storage relevant keys
                    sessionStorage.removeItem('form_kunjungan');
                    sessionStorage.removeItem('foto_kunjungan');
                    sessionStorage.removeItem('foto_kunjungan_gallery');
                    sessionStorage.removeItem('produk_dipilih');

                    Swal.fire({
                        icon:'success',
                        title:'Tersimpan',
                        text:'Data kunjungan disimpan sementara.',
                        timer:1200,
                        showConfirmButton:false
                    }).then(() => window.location.href = RIWAYAT_URL);

                    // fallback redirect
                    setTimeout(() => { window.location.href = RIWAYAT_URL; }, 1500);
                }
            });
        });

        // small util for escaping
        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe.replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'","&#039;");
        }
    </script>
</body>
</html>

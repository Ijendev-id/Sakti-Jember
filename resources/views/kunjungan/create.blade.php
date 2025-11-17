<!-- resources/views/kunjungan/create.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mulai Kunjungan Baru – SAKTI</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Font Awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        /* Basic mobile friendly styling */
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

            <!-- Produk button -->
            <div id="produkButton" class="produk-btn" role="button" aria-label="Pilih produk">
                <div class="left">
                    <div class="icon"><i class="fa-solid fa-bag-shopping"></i></div>
                    <div>
                        <div class="title">Produk yang Ditawarkan</div>
                        <div id="produkSubtitle" style="font-size:13px;color:#6b7b7d;margin-top:4px">Pilih produk...</div>
                    </div>
                </div>
                <div id="produkIndicator" class="produk-indicator hidden" aria-hidden="true"></div>
            </div>

            <!-- Jika produk sudah dipilih, tampilkan kartu produk di bawah button -->
            <div id="pickedProductWrapper" style="display:none;">
                <div id="pickedProduct" class="produk-card">
                    <div class="left" id="pickedProductName">Nama Produk</div>
                    <div class="badge" id="pickedProductStatus">Status</div>
                </div>
            </div>

            <div style="height:6px"></div>

            <label class="label-small">Detail Kunjungan</label>
            <div class="field">
                <textarea id="detailKunjungan" placeholder="Tuliskan catatan/temuan selama kunjungan..."></textarea>
            </div>

            <label class="label-small">Unggah Foto Kunjungan Kawasan</label>
            <div class="field">
                <div style="display:flex;align-items:center;gap:8px;">
                    <div id="btnAmbilFoto" style="cursor:pointer;display:flex;align-items:center;gap:8px;">
                        <i class="fa-solid fa-camera" style="font-size:18px;color:#2f5b68"></i>
                        <span style="color:#2f5b68;font-weight:700">Ambil Foto</span>
                    </div>

                    <input id="fotoInput" type="file" accept="image/*" style="display:none">
                </div>
                <div id="previewWrapper" style="margin-top:8px;display:none">
                    <img id="fotoPreview" class="upload-preview" alt="Preview Foto"/>
                    <div class="small-note">Preview foto akan disimpan sementara bersama data kunjungan.</div>
                </div>
            </div>

            <div class="btn-row">
                <button id="btnBack" class="btn btn-cancel" type="button">Kembali</button>
                <button id="btnSend" class="btn btn-submit" type="button">Kirim</button>
            </div>
        </div>
    </div>

    {{-- include modular footer --}}
    @include('layouts.footer')

    <script>
        /**
         * New logic:
         * - When navigating FROM Create -> Kamera/Opsi, we set coming_back_from = 'camera' or 'opsi'
         * - On Create load, if coming_back_from exists, DO NOT clear drafts (we are returning)
         * - If coming_back_from does NOT exist, clear ALL drafts (fresh open)
         * - After handling, remove the coming_back_from flag
         */

        const OPSI_ROUTE = "{{ route('kunjungan.opsi') }}";
        const KAMERA_ROUTE = "{{ route('kunjungan.kamera') }}";
        const RIWAYAT_URL = "{{ route('riwayat.kunjungan') }}";

        // helper: clear all drafts (full clear)
        function clearAllDrafts() {
            sessionStorage.removeItem('form_kunjungan');
            sessionStorage.removeItem('foto_kunjungan');
            sessionStorage.removeItem('produk_dipilih');
            sessionStorage.removeItem('status_produk');
            sessionStorage.removeItem('form_kunjungan_partial');
        }

        // Decide clear behavior on load
        (function decideClearOnOpen() {
            const flag = sessionStorage.getItem('coming_back_from'); // 'camera' | 'opsi' or null
            if (!flag) {
                // fresh open -> full clear
                clearAllDrafts();
            } else {
                // returning from camera/opsi -> keep relevant draft (dont clear)
                // remove the flag so next open is considered fresh
                sessionStorage.removeItem('coming_back_from');
            }
        })();

        // Elements
        const produkBtn = document.getElementById('produkButton');
        const produkSubtitle = document.getElementById('produkSubtitle');
        const produkIndicator = document.getElementById('produkIndicator');
        const pickedWrapper = document.getElementById('pickedProductWrapper');
        const pickedName = document.getElementById('pickedProductName');
        const pickedStatus = document.getElementById('pickedProductStatus');

        const btnAmbilFoto = document.getElementById('btnAmbilFoto');
        const fotoInput = document.getElementById('fotoInput');
        const previewWrapper = document.getElementById('previewWrapper');
        const fotoPreview = document.getElementById('fotoPreview');

        const btnBack = document.getElementById('btnBack');
        const btnSend = document.getElementById('btnSend');

        let fotoDataUrl = null;

        // Render product if exists
        function renderSelectedProduct() {
            const p = sessionStorage.getItem('produk_dipilih');
            const s = sessionStorage.getItem('status_produk');
            if (p && p.trim() !== '' && s && s.trim() !== '') {
                produkSubtitle.textContent = `${p} - ${s}`;
                pickedName.textContent = p;
                pickedStatus.textContent = s;
                pickedWrapper.style.display = 'block';
                produkIndicator.classList.remove('hidden');
            } else {
                produkSubtitle.textContent = 'Pilih produk...';
                pickedWrapper.style.display = 'none';
                produkIndicator.classList.add('hidden');
            }
        }

        // Save partial and navigate, but also set coming_back flag so create won't clear on return
        function simpanPartialAndGo(url, from) {
            const partial = {
                namaNasabah: document.getElementById('namaNasabah').value || '',
                namaPerusahaan: document.getElementById('namaPerusahaan').value || ''
            };
            sessionStorage.setItem('form_kunjungan_partial', JSON.stringify(partial));
            // set flag so Create knows we're coming back
            sessionStorage.setItem('coming_back_from', from); // 'camera' | 'opsi'
            window.location.href = url;
        }

        produkBtn.addEventListener('click', () => simpanPartialAndGo(OPSI_ROUTE, 'opsi'));
        if (btnAmbilFoto) btnAmbilFoto.addEventListener('click', () => simpanPartialAndGo(KAMERA_ROUTE, 'camera'));

        fotoInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(ev) {
                fotoDataUrl = ev.target.result;
                fotoPreview.src = fotoDataUrl;
                previewWrapper.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        document.addEventListener('DOMContentLoaded', () => {
            // restore partial (if user returned from opsi/kamera)
            const partial = sessionStorage.getItem('form_kunjungan_partial');
            if (partial) {
                try {
                    const d = JSON.parse(partial);
                    if (d.namaNasabah) document.getElementById('namaNasabah').value = d.namaNasabah;
                    if (d.namaPerusahaan) document.getElementById('namaPerusahaan').value = d.namaPerusahaan;
                } catch (err) { console.warn('parse partial failed', err); }
                // keep partial for this navigation; optionally remove
                sessionStorage.removeItem('form_kunjungan_partial');
            }

            // render product if opsi set it (we didn't clear when returning)
            renderSelectedProduct();

            // restore foto if camera page set it
            const fotoFromCamera = sessionStorage.getItem('foto_kunjungan');
            if (fotoFromCamera) {
                fotoDataUrl = fotoFromCamera;
                fotoPreview.src = fotoFromCamera;
                previewWrapper.style.display = 'block';
            }
        });

        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'visible') {
                renderSelectedProduct();
                const fotoFromCamera = sessionStorage.getItem('foto_kunjungan');
                if (fotoFromCamera) {
                    fotoDataUrl = fotoFromCamera;
                    fotoPreview.src = fotoFromCamera;
                    previewWrapper.style.display = 'block';
                }
            }
        });

        btnBack.addEventListener('click', () => window.history.back());

        // riwayat helpers
        function loadRiwayat() {
            const raw = sessionStorage.getItem('riwayat_kunjungan');
            if (!raw) return [];
            try { const arr = JSON.parse(raw); return Array.isArray(arr) ? arr : []; } catch(e){ return []; }
        }
        function saveRiwayat(arr) { sessionStorage.setItem('riwayat_kunjungan', JSON.stringify(arr)); }

        btnSend.addEventListener('click', () => {
            const namaNasabah = document.getElementById('namaNasabah').value.trim();
            const namaPerusahaan = document.getElementById('namaPerusahaan').value.trim();
            const p = sessionStorage.getItem('produk_dipilih');
            const s = sessionStorage.getItem('status_produk');
            const produk = (p && s) ? (p + ' - ' + s) : '';
            const detail = document.getElementById('detailKunjungan').value.trim();
            const kawasan = sessionStorage.getItem('kawasan_terpilih') || '';

            if (!namaNasabah) { Swal.fire({icon:'warning', title:'Mohon isi Nama Nasabah'}); return; }
            if (!produk) { Swal.fire({icon:'warning', title:'Mohon pilih Produk yang Ditawarkan'}); return; }

            Swal.fire({
                title: 'Konfirmasi Kirim',
                html: `<p>Anda akan menyimpan kunjungan untuk <b>${escapeHtml(namaNasabah)}</b> (${escapeHtml(kawasan)})</p><p>Lanjutkan?</p>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then(res => {
                if (res.isConfirmed) {
                    const now = new Date();
                    const entry = {
                        id: 'k-' + now.getTime(),
                        namaNasabah, namaPerusahaan, produk: produk, detail, kawasan,
                        foto: fotoDataUrl || null,
                        timestamp: now.toISOString()
                    };
                    const arr = loadRiwayat();
                    arr.unshift(entry);
                    saveRiwayat(arr);

                    // remove only form & foto draft after submit; keep product selection (or change as needed)
                    sessionStorage.removeItem('form_kunjungan');
                    sessionStorage.removeItem('foto_kunjungan');

                    Swal.fire({ icon:'success', title:'Tersimpan', text:'Data kunjungan disimpan sementara.', timer:1200, showConfirmButton:false })
                        .then(() => window.location.href = RIWAYAT_URL);

                    setTimeout(() => { window.location.href = RIWAYAT_URL; }, 1500);
                }
            });
        });

        function escapeHtml(unsafe) {
            if (!unsafe) return '';
            return unsafe.replaceAll('&','&amp;').replaceAll('<','&lt;').replaceAll('>','&gt;').replaceAll('"','&quot;').replaceAll("'","&#039;");
        }
    </script>
</body>
</html>

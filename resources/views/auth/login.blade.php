<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login SAKTI</title>
    <link rel="stylesheet" href="{{ asset('/asset/css/login.css') }}" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Tambahan CSS untuk popup kawasan agar mirip gambar */
        :root{
            --bg: #204a56; /* warna background kartu */
            --pill: #e6e6e6; /* warna tombol pill */
            --pill-text: #2b2b2b;
        }

        /* basic page centering jika login.css tidak menangani */
        body {
            font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: #f7f9fb;
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 420px;
            margin: 56px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            padding: 28px;
        }

        .title { text-align:center; margin: 0 0 8px 0; font-size:22px; }
        .logo-wrapper { text-align:center; margin-bottom: 12px; }
        .logo { width:64px; height:64px; object-fit:contain; display:inline-block; }
        .app-name { margin:0; }
        .subtitle, .tagline { margin:0; font-size:12px; color:#666; }

        .login-box { margin-top:16px; }
        .form-group { margin-bottom:12px; }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width:100%;
            padding:12px 14px;
            border-radius:8px;
            border:1px solid #d6d6d6;
            box-sizing:border-box;
            font-size:15px;
        }

        .select-display {
            display:flex;
            gap:8px;
            align-items:center;
        }
        .kawasan-choose {
            flex:1;
            padding:10px 12px;
            border-radius:8px;
            border:1px solid #d6d6d6;
            background:#fff;
            cursor:pointer;
        }
        .btn-login {
            width:100%;
            padding:12px;
            border-radius:8px;
            background:#2b6b7a;
            color:white;
            border:none;
            font-weight:700;
            cursor:pointer;
            font-size:15px;
        }
        .forgot { display:block; text-align:center; margin-top:10px; color:#4b6b7a; text-decoration:none; }

        /* Modal kawasan */
        .modal-backdrop {
            position:fixed;
            inset:0;
            background: rgba(0,0,0,0.35);
            display:none;
            align-items:center;
            justify-content:center;
            z-index:1100;
        }
        .kawasan-modal {
            width:320px;
            background: var(--bg);
            padding:18px;
            border-radius:14px;
            border:6px solid rgba(0,0,0,0);
            box-shadow: 0 8px 30px rgba(0,0,0,0.25);
        }
        .kawasan-list { display:flex; flex-direction:column; gap:12px; }
        .kawasan-item {
            background: var(--pill);
            padding:14px 12px;
            border-radius:16px;
            text-align:center;
            font-weight:700;
            font-size:20px;
            color: var(--pill-text);
            cursor:pointer;
            user-select:none;
        }
        .kawasan-header {
            text-align:center;
            color:#e9f2f3;
            margin-bottom:8px;
            font-weight:700;
            font-size:16px;
        }

        /* small screen adjustments */
        @media (max-width:380px){
            .kawasan-modal { width: 90%; }
        }
    </style>
</head>

<body>
    <div class="container">

        <h1 class="title">Selamat Datang</h1>

        <div class="logo-wrapper">
            <img src="/asset/img/logo.png" class="logo" alt="Logo SAKTI" />
            <h2 class="app-name">SAKTI</h2>
            <p class="subtitle">(Sistem Analitik Kawasan Terintegrasi)</p>
            <p class="tagline">Satu Peta, Satu Data, Satu Arah</p>
        </div>

        <form id="loginForm" class="login-box" onsubmit="return false;">
            <div class="form-group">
                <input id="pegawaiId" type="text" placeholder="ID Pegawai" />
            </div>

            <div class="form-group">
                <input id="password" type="password" placeholder="Password" />
            </div>

            <!-- ganti select menjadi tombol yang memunculkan popup -->
            <div class="form-group select-display">
                <div id="selectedKawasanDisplay" class="kawasan-choose" tabindex="0">
                    Pilih Kawasan
                </div>
            </div>

            <!-- hidden input untuk menyimpan kawasan yang dipilih -->
            <input type="hidden" id="selectedKawasan" value="" />

            <button type="button" id="loginButton" class="btn-login">LOGIN</button>
        </form>

        <a href="#" class="forgot">Lupa Password?</a>
    </div>

    <!-- Modal Kawasan -->
    <div id="modalBackdrop" class="modal-backdrop" aria-hidden="true">
        <div class="kawasan-modal" role="dialog" aria-modal="true" aria-label="Pilih Kawasan">
            <div class="kawasan-header">Pilih Kawasan</div>
            <div class="kawasan-list">
                <div class="kawasan-item" data-value="Kawasan Senin">Kawasan Senin</div>
                <div class="kawasan-item" data-value="Kawasan Selasa">Kawasan Selasa</div>
                <div class="kawasan-item" data-value="Kawasan Rabu">Kawasan Rabu</div>
                <div class="kawasan-item" data-value="Kawasan Kamis">Kawasan Kamis</div>
                <div class="kawasan-item" data-value="Kawasan Jumat">Kawasan Jumat</div>
            </div>
        </div>
    </div>

    <script>
        // Konstanta credential (frontend-only, sesuai permintaan)
        const VALID_ID = "14300";
        const VALID_PASSWORD = "Jemberalon2";

        // Elemen
        const loginButton = document.getElementById('loginButton');
        const pegawaiId = document.getElementById('pegawaiId');
        const password = document.getElementById('password');
        const selectedKawasanInput = document.getElementById('selectedKawasan');
        const selectedKawasanDisplay = document.getElementById('selectedKawasanDisplay');

        // Modal elemen
        const modalBackdrop = document.getElementById('modalBackdrop');
        const kawasanItems = document.querySelectorAll('.kawasan-item');

        // buka modal ketika klik display
        selectedKawasanDisplay.addEventListener('click', openKawasanModal);
        selectedKawasanDisplay.addEventListener('keydown', (e) => { if(e.key === 'Enter' || e.key === ' ') openKawasanModal(); });

        function openKawasanModal(){
            modalBackdrop.style.display = 'flex';
            modalBackdrop.setAttribute('aria-hidden', 'false');
        }

        // close modal ketika klik di luar modal (backdrop)
        modalBackdrop.addEventListener('click', function(e){
            if(e.target === modalBackdrop){
                closeKawasanModal();
            }
        });

        // pilih kawasan
        kawasanItems.forEach(item => {
            item.addEventListener('click', function(){
                const value = this.getAttribute('data-value');
                selectedKawasanInput.value = value;
                selectedKawasanDisplay.textContent = value;
                closeKawasanModal();
            });
        });

        function closeKawasanModal(){
            modalBackdrop.style.display = 'none';
            modalBackdrop.setAttribute('aria-hidden', 'true');
        }

        // fungsi helper untuk menampilkan alert sukses/gagal via SweetAlert2
        function showSuccessAndRedirect(kawasan) {
            // simpan kawasan sementara di sessionStorage
            try {
                sessionStorage.setItem('kawasan_terpilih', kawasan);
            } catch (err) {
                // jika storage tidak tersedia, tetap lanjut tanpa crash
                console.warn('sessionStorage tidak tersedia:', err);
            }

            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil',
                text: 'Selamat datang. Mengarahkan ke dashboard...',
                timer: 1300,
                showConfirmButton: false
            }).then(() => {
                // Arahkan ke halaman dashboard (sesuaikan route jika berbeda)
                window.location.href = '/dashboard';
            });

            // fallback redirect jika promise tidak terpenuhi (mis. timer)
            setTimeout(() => { window.location.href = '/dashboard'; }, 1800);
        }

        function showError(msg) {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: msg
            });
        }

        // Login button event
        loginButton.addEventListener('click', function() {
            const idVal = pegawaiId.value.trim();
            const pwdVal = password.value;
            const kawasanVal = selectedKawasanInput.value;

            // cek input kosong
            if (!idVal || !pwdVal) {
                showError('Mohon isi ID Pegawai dan Password.');
                return;
            }

            // cek kawasan terpilih
            if (!kawasanVal) {
                showError('Silakan pilih kawasan terlebih dahulu.');
                return;
            }

            // verifikasi (frontend-only)
            if (idVal === VALID_ID && pwdVal === VALID_PASSWORD) {
                // sukses
                showSuccessAndRedirect(kawasanVal);
            } else {
                // gagal
                showError('ID Pegawai atau Password tidak sesuai.');
            }
        });

        // optional: tekan Enter pada password akan memicu klik login
        password.addEventListener('keydown', function(e){
            if (e.key === 'Enter') {
                loginButton.click();
            }
        });

        // Accessibility: close modal dengan Escape
        document.addEventListener('keydown', function(e){
            if (e.key === 'Escape') {
                if (modalBackdrop.style.display === 'flex') {
                    closeKawasanModal();
                }
            }
        });
    </script>
</body>

</html>

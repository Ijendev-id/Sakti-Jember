<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda – SAKTI</title>

    <!-- Font Awesome (icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <!-- Optional: Google Font (sesuaikan jika ingin) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600;700&display=swap" rel="stylesheet">

    <style>
        /* Reset & dasar */
        * { box-sizing: border-box; margin:0; padding:0; }
        html,body { height:100%; }
        body {
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: #f6f8fa;
            color: #132a2f;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            padding-bottom: 92px; /* ruang footer */
        }
        .wrap { max-width:420px; margin:0 auto; }

        /* Header */
        .header {
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:12px 16px;
            background:#fff;
            border-bottom:1px solid rgba(0,0,0,0.06);
            position:sticky;
            top:0;
            z-index:50;
        }
        .header strong { font-size:16px; }
        .profile-icon img { width:36px; height:36px; border-radius:50%; object-fit:cover; }

        /* area utama */
        .main {
            padding: 18px 18px 0 18px;
            display:flex;
            flex-direction:column;
            align-items:center;
            gap: 14px;
        }

        /* Logo & judul tengah */
        .brand {
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:6px;
            margin-top:6px;
        }
        .brand .logo {
            width:76px;
            height:76px;
            border-radius:50%;
            object-fit:cover;
            background: #fff;
            padding:8px;
            box-shadow: 0 6px 18px rgba(20,37,43,0.06);
        }
        .brand h1 {
            font-size:22px;
            margin-top:4px;
            letter-spacing:0.6px;
        }
        .brand p { font-size:12px; color:#6b7f85; margin-top:-2px; }

        /* titik kecil hijau */
        .status-dot {
            width:8px;
            height:8px;
            background:#00a86b;
            border-radius:50%;
            margin-top:4px;
        }

        /* Tombol besar (kartu) */
        .cta-card {
            width:100%;
            max-width:360px;
            background:#2f5b68;
            color:#fff;
            border-radius:14px;
            padding:18px 18px;
            display:flex;
            align-items:center;
            gap:16px;
            box-shadow: 0 10px 28px rgba(47,91,104,0.12);
            text-decoration:none;
        }
        .cta-card .icon {
            width:56px;
            height:56px;
            border-radius:12px;
            background: rgba(255,255,255,0.08);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:26px;
        }
        .cta-card .label {
            font-weight:700;
            font-size:18px;
        }

        /* Judul seksion ringkasan */
        .section-title {
            width:100%;
            margin-top:8px;
            margin-bottom:6px;
            font-weight:600;
            font-size:16px;
            color:#173435;
            padding-left:6px;
        }

        /* grid kartu aktivitas */
        .grid {
            width:100%;
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:12px;
            margin-top:2px;
        }
        .stat-card {
            background:#e8f0f2;
            border-radius:12px;
            padding:14px;
            display:flex;
            flex-direction:column;
            align-items:flex-start;
            box-shadow: 0 8px 20px rgba(20,37,43,0.06);
            min-height:110px;
            position:relative;
            overflow:visible;
        }
        .stat-top {
            display:flex;
            align-items:center;
            gap:12px;
        }
        .stat-icon {
            width:44px;
            height:44px;
            border-radius:10px;
            background:#2f5b68;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:20px;
            color:#fff;
        }
        .stat-text p { font-size:13px; color:#163033; margin-bottom:6px; }
        .stat-text b { font-size:18px; color:#163033; }

        /* Tampilan mobile bottom spacing */
        .spacer { height:14px; }

        /* responsive */
        @media (min-width:640px) {
            .wrap { max-width:640px; }
            .brand h1 { font-size:24px; }
            .cta-card .label { font-size:20px; }
            .stat-card { min-height:120px; }
        }
    </style>
</head>

<body>
    <div class="wrap">
        <header class="header">
            <div><strong>Beranda</strong></div>
            <div class="profile-icon" title="Profil">
                <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="User">
            </div>
        </header>

        <main class="main" role="main" aria-labelledby="home-title">
            <section class="brand" aria-hidden="false">
                <img src="/asset/img/logo.png" alt="SAKTI Logo" class="logo">
                <h1>SAKTI</h1>
                <p>(Sistem Analitik Kawasan Terintegrasi)</p>

                <!-- titik status hijau kecil -->
                <div class="status-dot" aria-hidden="true"></div>
            </section>

            <!-- tombol besar -->
            <a href="{{ route('kunjungan.create') }}" class="cta-card" id="btnMulai" aria-label="Mulai Kunjungan Baru">
                <div class="icon">
                    <!-- icon map marker -->
                    <i class="fa-solid fa-map-pin"></i>
                </div>
                <div class="label">Mulai Kunjungan Baru</div>
            </a>

            <div class="spacer"></div>

            <div class="section-title">Ringkasan Aktivitas Anda</div>

            <div class="grid" role="list">
                <div class="stat-card" role="listitem" tabindex="0" aria-label="Kunjungan Hari Ini">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-user-plus"></i></div>
                        <div class="stat-text">
                            <p>Kunjungan Hari Ini</p>
                            <b id="kunjunganCount">4</b>
                        </div>
                    </div>
                </div>

                <div class="stat-card" role="listitem" tabindex="0" aria-label="Tindak Lanjut Pending">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                        <div class="stat-text">
                            <p>Tindak Lanjut Pending</p>
                            <b id="pendingCount">3</b>
                        </div>
                    </div>
                </div>
            </div>

            <div style="height:40px;"></div>
        </main>
    </div>

    {{-- footer nav (mobile) --}}
    @include('layouts.footer')

    <script>
        // Isi nama kawasan dari sessionStorage (sama seperti sebelumnya)
        const kawasan = sessionStorage.getItem('kawasan_terpilih');
        if (kawasan && kawasan.trim() !== '') {
            // kalau Anda ingin menampilkan nama di header/brand, tambahkan elemen dan set textContent
            // contoh: document.querySelector('.brand p').textContent = kawasan;
        }

        // data stat (saat ini statik; ganti dengan fetch/ajax bila perlu)
        document.getElementById('kunjunganCount').textContent = '4';
        document.getElementById('pendingCount').textContent = '3';

        // klik CTA
        document.getElementById('btnMulai').addEventListener('click', function(e) {
            // default anchor akan redirect; di sini mencegah default agar route blade bisa dipakai saat development
            // hapus e.preventDefault() jika ingin langsung menggunakan href
            // e.preventDefault();
            // window.location.href = '/kunjungan/create';
        });
    </script>
</body>

</html>

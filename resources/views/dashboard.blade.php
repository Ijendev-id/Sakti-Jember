<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda – SAKTI</title>

    <!-- Font Awesome (icon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        /* Reset kecil */
        * { box-sizing: border-box; margin:0; padding:0; }
        html,body { height:100%; }

        body{
            font-family: "Inter", "Segoe UI", Roboto, Arial, sans-serif;
            background: #f5f7fa;
            color: #14252b;
            -webkit-font-smoothing:antialiased;
            -moz-osx-font-smoothing:grayscale;
            padding-bottom: 84px; /* ruang untuk footer nav */
        }

        /* Header */
        .header {
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:12px 16px;
            background: #fff;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            position:sticky;
            top:0;
            z-index:50;
        }
        .header-left h2 {
            font-weight:600;
            font-size:16px;
        }
        .header-right .profile-icon img {
            width:36px;
            height:36px;
            border-radius:50%;
            object-fit:cover;
        }

        /* Logo section */
        .logo-section {
            display:flex;
            align-items:center;
            gap:12px;
            padding:18px 18px 8px 18px;
            background: transparent;
        }
        .logo-img {
            width:64px;
            height:64px;
            object-fit:contain;
            border-radius:8px;
        }
        .logo-text h1 {
            font-size:20px;
            margin-bottom:4px;
            letter-spacing:0.6px;
        }
        .logo-text p {
            margin:0;
            font-size:12px;
            color:#526162;
        }
        .kawasan-name {
            margin-top:6px;
            font-size:13px;
            color:#2b6b7a;
            padding-left:92px; /* agar muncul di bawah teks, sejajar */
        }

        /* Button besar */
        .btn-section {
            padding: 16px;
        }
        .btn-kunjungan {
            display:flex;
            align-items:center;
            gap:14px;
            background:#2f5b68;
            color:#fff;
            text-decoration:none;
            padding:18px;
            border-radius:12px;
            box-shadow: 0 6px 18px rgba(47,91,104,0.15);
        }
        .btn-kunjungan img {
            width:44px;
            height:44px;
            background: rgba(255,255,255,0.08);
            padding:8px;
            border-radius:10px;
        }
        .btn-kunjungan span {
            font-weight:700;
            font-size:16px;
        }

        /* Aktivitas */
        .aktivitas-section {
            padding: 12px 16px 80px 16px;
        }
        .aktivitas-section h2 {
            margin-bottom:12px;
            font-size:16px;
            color:#1c373f;
        }

        .aktivitas-grid {
            display:grid;
            grid-template-columns: 1fr 1fr;
            gap:12px;
        }

        .card-aktivitas {
            background: #e7eef1;
            border-radius:10px;
            padding:12px;
            display:flex;
            gap:12px;
            align-items:center;
            box-shadow: 0 6px 16px rgba(20,37,43,0.06);
            min-height:86px;
        }
        .card-icon {
            width:48px;
            height:48px;
            object-fit:cover;
            border-radius:8px;
            background:#2f5b68;
            display:inline-block;
            padding:8px;
        }
        .card-text p {
            font-size:14px;
            color:#163033;
        }
        .card-text b { font-size:18px; display:block; margin-top:6px; color:#163033; }

        /* Footer nav - mobile style */
        .footer-nav {
            position:fixed;
            left:0;
            bottom:0;
            width:100%;
            background:#fff;
            border-top:1px solid rgba(0,0,0,0.06);
            display:flex;
            justify-content:space-around;
            padding:8px 0;
            z-index:60;
            box-shadow: 0 -4px 18px rgba(0,0,0,0.04);
        }
        .footer-nav a {
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:4px;
            text-decoration:none;
            color:#6b7f85;
            font-size:12px;
        }
        .footer-nav a i { font-size:18px; }

        /* responsive tweaks */
        @media (min-width:640px) {
            .container-wide { max-width:640px; margin:0 auto; }
            .logo-text h1 { font-size:24px; }
            .btn-kunjungan span { font-size:18px; }
            .aktivitas-grid { gap:16px; }
        }

        /* small screen improvements */
        @media (max-width:360px) {
            .logo-text h1 { font-size:18px; }
            .kawasan-name { padding-left:84px; font-size:12px; }
            .card-text b { font-size:16px; }
        }
    </style>
</head>

<body>
    <div class="container-wide">
        <header class="header">
            <div class="header-left">
                <!-- <h2>Beranda</h2> -->
                <strong>Beranda</strong>
            </div>
            <div class="header-right">
                <div class="profile-icon" title="Profil">
                    <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="User">
                </div>
            </div>
        </header>

        <section class="logo-section">
            <img src="/asset/img/logo.png" class="logo-img" alt="SAKTI Logo">
            <div class="logo-text">
                <h1>SAKTI</h1>
                <p>(Sistem Analitik Kawasan Terintegrasi)</p>

                <!-- Nama kawasan akan diisi via JS -->
                <div id="kawasanTerpilih" class="kawasan-name">— Kawasan belum dipilih —</div>
            </div>
        </section>

        <section class="btn-section">
            <a class="btn-kunjungan" href="{{ route('kunjungan.create') }}" id="btnMulai">
                <img src="https://cdn-icons-png.flaticon.com/512/854/854929.png" alt="icon">
                <span>Mulai Kunjungan Baru</span>
            </a>
        </section>

        <section class="aktivitas-section">
            <h2>Ringkasan Aktivitas Anda</h2>

            <div class="aktivitas-grid">

                <div class="card-aktivitas" role="button" tabindex="0" aria-label="Kunjungan Hari Ini">
                    <img src="https://cdn-icons-png.flaticon.com/512/2942/2942664.png" class="card-icon" alt="kunjungan">
                    <div class="card-text">
                        <p>Kunjungan Hari Ini</p>
                        <b id="kunjunganCount">4</b>
                    </div>
                </div>

                <div class="card-aktivitas" role="button" tabindex="0" aria-label="Tindak Lanjut Pending">
                    <img src="https://cdn-icons-png.flaticon.com/512/2910/2910797.png" class="card-icon" alt="tindak">
                    <div class="card-text">
                        <p>Tindak Lanjut Pending</p>
                        <b id="pendingCount">3</b>
                    </div>
                </div>

            </div>

        </section>
    </div>

    {{-- include footer modular --}}
    @include('layouts.footer')

    <script>
        // Ambil nama kawasan dari sessionStorage (disimpan saat login)
        const kawasanEl = document.getElementById('kawasanTerpilih');
        const kawasan = sessionStorage.getItem('kawasan_terpilih');

        if (kawasan && kawasan.trim() !== '') {
            kawasanEl.textContent = kawasan;
        } else {
            kawasanEl.textContent = '— Kawasan belum dipilih —';
        }

        // contoh: kalau mau ambil jumlah dinamis, Anda bisa ganti dari fetch/ajax
        // untuk sekarang kita pakai static values (sesuaikan bila perlu)
        document.getElementById('kunjunganCount').textContent = '4';
        document.getElementById('pendingCount').textContent = '3';

        // tombol mulai kunjungan: arahkan ke halaman form kunjungan atau aksi lain
        document.getElementById('btnMulai').addEventListener('click', function(e){
            e.preventDefault();
            // contoh redirect ke halaman pembuatan kunjungan baru
            // ganti '/kunjungan/create' sesuai route aplikasi Anda
            window.location.href = '/kunjungan/create';
        });
    </script>
</body>

</html>

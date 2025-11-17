<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Inter, Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 0;
            color: #1a2e35;
        }

        .wrap {
            max-width: 520px;
            margin: 0 auto;
            padding: 15px;
        }

         header{display:flex;align-items:center;justify-content:space-between;padding:8px 4px 12px;border-bottom:1px solid rgba(0,0,0,0.06);background:#fff;position:sticky;top:0;z-index:30}
        header h1{font-size:18px;font-weight:700}
        .profile-icon img{width:36px;height:36px;border-radius:50%;object-fit:cover}

        header h1 {
            font-size: 19px;
            font-weight: 700;
            margin-left: 5px;
        }

        .section-title {
            margin-top: 22px;
            margin-bottom: 10px;
            font-size: 13px;
            font-weight: 700;
            color: #6b7f85;
            text-transform: uppercase;
        }

        .setting-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
        }

        .setting-item {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
        }

        .setting-item:last-child {
            border-bottom: none;
        }

        .setting-icon {
            width: 34px;
            height: 34px;
            background: #eef3f5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 14px;
            font-size: 17px;
            color: #2f5b68;
        }

        .setting-text {
            flex: 1;
            font-size: 15px;
            font-weight: 600;
            color: #1f2d30;
        }

        .arrow {
            color: #9aa7ac;
            font-size: 16px;
        }

        hr.separator {
            border: 0;
            border-top: 1px solid #e4e7eb;
            margin: 25px 0 15px;
        }
    </style>
</head>

<body>

    <div class="wrap">

        <header>
    <h1>Riwayat Kunjungan</h1>
    <a href="/profil" class="profile-icon" title="Profil">
        <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="User">
    </a>
</header>

        <!-- PENGATURAN AKSES & DATA -->
        <div class="section-title">Pengaturan Akses & Data</div>
        <div class="setting-card">

            <div class="setting-item">
                <div class="setting-icon"><i class="fa-solid fa-database"></i></div>
                <div class="setting-text">Mode Offline Cache</div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>

            <div class="setting-item">
                <div class="setting-icon"><i class="fa-solid fa-bell"></i></div>
                <div class="setting-text">Kelola Notifikasi</div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>

            <div class="setting-item">
                <div class="setting-icon"><i class="fa-solid fa-trash"></i></div>
                <div class="setting-text">Bersihkan Cache</div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>

        </div>

        <hr class="separator">

        <!-- KEAMANAN AKUN -->
        <div class="section-title">Keamanan Akun</div>
        <div class="setting-card">

            <div class="setting-item">
                <div class="setting-icon"><i class="fa-solid fa-lock"></i></div>
                <div class="setting-text">Ganti Password</div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>

            <div class="setting-item">
                <div class="setting-icon"><i class="fa-solid fa-fingerprint"></i></div>
                <div class="setting-text">Login Biometrik</div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>

        </div>

        <hr class="separator">

        <!-- BANTUAN & LEGAL -->
        <div class="section-title">Bantuan & Legal</div>
        <div class="setting-card">

            <div class="setting-item">
                <div class="setting-icon"><i class="fa-solid fa-circle-question"></i></div>
                <div class="setting-text">Bantuan & FAQ</div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>

            <div class="setting-item">
                <div class="setting-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                <div class="setting-text">Syarat & Ketentuan</div>
                <i class="fa-solid fa-chevron-right arrow"></i>
            </div>

        </div>
        <br>
        <br>
        <br>

        @include('layouts.footer')

    </div>

</body>
</html>

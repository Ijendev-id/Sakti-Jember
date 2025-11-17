<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil Pengguna</title>

    <!-- Font & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root{
            --bg:#fafafa;
            --card-bg:#ffffff;
            --muted:#7a7a7a;
            --accent:#9fc7ff;
            --btn-bg:#2f5970;
            --text:#1a2e35;
        }

        /* Global */
        html,body{height:100%; margin:0; padding:0; background:var(--bg); font-family: Inter, Arial, sans-serif; color:var(--text); -webkit-font-smoothing:antialiased}
        .wrap{max-width:420px; margin:0 auto; padding:12px;}

        /* Topbar like screenshot */
        header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:10px 8px;
            border-bottom:4px solid #e9e9e9;
            background:#fff;
            position:sticky;
            top:0;
            z-index:20;
        }
        .brand { display:flex; align-items:center; gap:10px; }
        .brand img{ width:34px; height:34px; }
        .brand .title{ font-weight:700; letter-spacing:1px; font-size:18px;}
        .edit-icon{ color:#666; width:36px; height:36px; display:flex; align-items:center; justify-content:center; }

        /* Card container */
        .card {
            background:var(--card-bg);
            margin:18px 8px;
            padding:24px 18px 30px;
            border-radius:6px;
            box-shadow: 0 0 0 6px rgba(0,0,0,0.02);
            border:1px solid #e6e6e6;
        }

        .section-title{
            font-family: Georgia, 'Times New Roman', serif;
            font-size:20px;
            color:#333;
            margin:0 0 18px 4px;
            font-weight:700;
        }

        /* Avatar block */
        .avatar-wrap{ text-align:center; margin-bottom:12px; }
        .avatar-bg{
            width:120px;
            height:120px;
            border-radius:999px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            background:var(--accent);
            box-shadow:0 2px 0 rgba(0,0,0,0.02);
        }
        .avatar-bg img{ width:84px; height:84px; border-radius:999px; object-fit:cover; }

        .name{ margin-top:10px; font-weight:700; text-align:center; font-size:16px; }
        .subtitle{ text-align:center; color:var(--muted); font-size:13px; margin-top:4px; }

        /* info fields */
        .info-row{ margin:12px 0; }
        .info-label{ font-size:13px; font-weight:700; margin-bottom:6px; color:#333; }
        .info-box{
            background:#f3f3f3;
            padding:10px 12px;
            border-radius:6px;
            box-shadow: 0 3px 0 rgba(0,0,0,0.03);
            font-size:14px;
            color:#111;
        }

        /* button */
        .btn-primary{
            display:block;
            width:230px;
            margin:20px auto 0;
            padding:10px 14px;
            background:var(--btn-bg);
            color:#fff;
            text-align:center;
            text-decoration:none;
            border-radius:8px;
            font-weight:600;
            box-shadow:0 2px 0 rgba(0,0,0,0.06);
        }

        /* responsive */
        @media(min-width:900px){
            .wrap{ padding-top:28px;}
        }
    </style>
</head>

<body>
    <div class="wrap">
        <header>
            <div class="brand">
                <img src="{{ asset('asset/img/logo.png') }}" alt="logo">
                <div class="title">SAKTI</div>
            </div>

            <!-- Edit icon (arah ke halaman edit profil) -->
            <a href="/profil/edit" class="edit-icon" title="Edit Profil">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 21v-3.75L16.81 3.44a2 2 0 0 1 2.83 0l.92.92a2 2 0 0 1 0 2.83L6.75 21H3z" stroke="#444" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </header>

        <div class="card">
            <div class="section-title">Profil Pengguna</div>

            <div class="avatar-wrap">
                <div class="avatar-bg">
                    @if(!empty($user->photo_url))
                        <img src="{{ $user->photo_url }}" alt="avatar">
                    @else
                        <img src="{{ asset('asset/img/cepi.png') }}" alt="avatar">
                    @endif
                </div>

                <div class="name">{{ $user->name ?? 'Cepi' }}</div>
                <div class="subtitle">{{ $user->role ?? 'Customer Service Officer' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-box">{{ $user->email ?? 'Cepi@bankmandiri.co.id' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Nomor Telepon</div>
                <div class="info-box">{{ $user->phone ?? '+6285607140570' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">ID Pegawai</div>
                <div class="info-box">{{ $user->employee_id ?? '14300' }}</div>
            </div>

            <div class="info-row">
                <div class="info-label">Unit Kerja</div>
                <div class="info-box">{{ $user->unit ?? 'Jember' }}</div>
            </div>

            <a href="/dashboard" class="btn-primary">Kembali ke Halaman Utama</a>
        </div>
    </div>
</body>

</html>

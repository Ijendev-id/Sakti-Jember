<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profil</title>

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
            --danger:#d9534f;
        }

        html,body{height:100%; margin:0; padding:0; background:var(--bg); font-family: Inter, Arial, sans-serif; color:var(--text); -webkit-font-smoothing:antialiased}
        .wrap{max-width:420px; margin:0 auto; padding:12px;}

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

        .card {
            background:var(--card-bg);
            margin:18px 8px;
            padding:18px 18px 26px;
            border-radius:6px;
            box-shadow: 0 0 0 6px rgba(0,0,0,0.02);
            border:1px solid #e6e6e6;
        }

        .section-title{
            font-family: Georgia, 'Times New Roman', serif;
            font-size:20px;
            color:#333;
            margin:0 0 12px 4px;
            font-weight:700;
        }

        .avatar-wrap{ text-align:center; margin-bottom:12px; }
        .avatar-bg{
            width:100px;
            height:100px;
            border-radius:999px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            background:var(--accent);
            box-shadow:0 2px 0 rgba(0,0,0,0.02);
            overflow:hidden;
        }
        .avatar-bg img{ width:100%; height:100%; object-fit:cover; }

        form .row{ margin:10px 0; }
        label{ display:block; font-size:13px; font-weight:700; margin-bottom:6px; color:#333; }
        input[type="text"], input[type="email"], input[type="tel"], select {
            width:100%;
            padding:10px 12px;
            border-radius:6px;
            border:1px solid #e0e0e0;
            background:#f7f7f7;
            font-size:14px;
            box-shadow: inset 0 2px 0 rgba(0,0,0,0.02);
        }

        .form-actions{ display:flex; gap:12px; justify-content:center; margin-top:16px; }
        .btn {
            padding:10px 14px;
            border-radius:8px;
            text-decoration:none;
            font-weight:600;
            cursor:pointer;
            border:0;
        }
        .btn-save{ background:var(--btn-bg); color:#fff; }
        .btn-cancel{ background:#fff; color:var(--text); border:1px solid #ddd; }

        /* toast */
        .toast {
            position:fixed;
            left:50%;
            transform:translateX(-50%);
            bottom:28px;
            background: #2f5970;
            color:#fff;
            padding:12px 18px;
            border-radius:8px;
            box-shadow:0 6px 24px rgba(47,89,112,0.18);
            display:none;
            z-index:999;
            font-weight:600;
        }

        .small-note{ font-size:12px; color:var(--muted); margin-top:6px; text-align:center; }
    </style>
</head>

<body>
    <div class="wrap">
        <header>
            <div class="brand">
                <img src="{{ asset('asset/img/logo.png') }}" alt="logo">
                <div class="title">SAKTI</div>
            </div>

            <a href="/profil" class="edit-icon" title="Lihat Profil">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 21v-3.75L16.81 3.44a2 2 0 0 1 2.83 0l.92.92a2 2 0 0 1 0 2.83L6.75 21H3z" stroke="#444" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </header>

        <div class="card">
            <div class="section-title">Edit Profil (Sementara)</div>

            <div class="avatar-wrap">
                <div class="avatar-bg" id="avatarPreview">
                    <img id="avatarImg" src="{{ $user->photo_url ?? asset('asset/img/cepi.png') }}" alt="avatar">
                </div>
                <div class="small-note">Upload gambar akan disimpan sementara di browser (preview saja)</div>
            </div>

            <form id="profileForm">
                <!-- NOTE: gunakan name sesuai kebutuhan -->
                <div class="row">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" placeholder="Nama Lengkap">
                </div>

                <div class="row">
                    <label for="role">Jabatan / Role</label>
                    <input type="text" id="role" name="role" placeholder="Customer Service Officer">
                </div>

                <div class="row">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="email@domain.com">
                </div>

                <div class="row">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" name="phone" placeholder="+628...">
                </div>

                <div class="row">
                    <label for="employee_id">ID Pegawai</label>
                    <input type="text" id="employee_id" name="employee_id" placeholder="14300">
                </div>

                <div class="row">
                    <label for="unit">Unit Kerja</label>
                    <input type="text" id="unit" name="unit" placeholder="KC JAA">
                </div>

                <div class="row">
                    <label for="photo">Ganti Foto (opsional)</label>
                    <input type="file" id="photo" accept="image/*">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-cancel" id="btnCancel" onclick="location.href='/profil'">Batal</button>
                    <button type="submit" class="btn btn-save" id="btnSave">Simpan</button>
                </div>

                <div class="small-note">Perubahan disimpan secara **sementara** di browser (localStorage). Tidak terkirim ke server.</div>
            </form>
        </div>
    </div>

    <div class="toast" id="toast">Perubahan berhasil disimpan</div>

    <script>
        // Field references
        const fields = ['name','role','email','phone','employee_id','unit'];
        const form = document.getElementById('profileForm');
        const toast = document.getElementById('toast');
        const photoInput = document.getElementById('photo');
        const avatarImg = document.getElementById('avatarImg');

        // Helper: get from localStorage or from server-provided blade variables
        function loadInitial() {
            const saved = localStorage.getItem('profile_temp');
            let data = saved ? JSON.parse(saved) : null;

            // Server-provided defaults via Blade (will be printed into HTML)
            const server = {
                name: {!! json_encode($user->name ?? '') !!},
                role: {!! json_encode($user->role ?? '') !!},
                email: {!! json_encode($user->email ?? '') !!},
                phone: {!! json_encode($user->phone ?? '') !!},
                employee_id: {!! json_encode($user->employee_id ?? '') !!},
                unit: {!! json_encode($user->unit ?? '') !!},
                photo_url: {!! json_encode($user->photo_url ?? '') !!}
            };

            // Use saved first, else server values
            const source = data || server;

            fields.forEach(f => {
                const el = document.getElementById(f);
                if (el) el.value = source[f] || '';
            });

            // photo preview
            if (data && data.photoData) {
                avatarImg.src = data.photoData;
            } else if (server.photo_url) {
                avatarImg.src = server.photo_url;
            }
        }

        // Save to localStorage
        function saveTemp(data) {
            localStorage.setItem('profile_temp', JSON.stringify(data));
        }

        // Toast helper
        function showToast(text = 'Perubahan berhasil disimpan') {
            toast.textContent = text;
            toast.style.display = 'block';
            setTimeout(() => {
                toast.style.opacity = 1;
            }, 10);
            setTimeout(() => {
                toast.style.opacity = 0;
                setTimeout(() => toast.style.display = 'none', 400);
            }, 2200);
        }

        // On form submit -> save data to localStorage and show notification
        form.addEventListener('submit', function(e){
            e.preventDefault();

            const data = {};
            fields.forEach(f => {
                data[f] = document.getElementById(f).value.trim();
            });

            // include photo preview data if present
            if (avatarImg && avatarImg.src) data.photoData = avatarImg.src;

            saveTemp(data);
            showToast('Perubahan berhasil disimpan (sementara)');
        });

        // Photo input preview (saved as dataURL in localStorage)
        photoInput.addEventListener('change', function(e){
            const file = e.target.files[0];
            if (!file) return;
            if (!file.type.startsWith('image/')) return alert('Silakan pilih file gambar.');

            const reader = new FileReader();
            reader.onload = function(ev){
                avatarImg.src = ev.target.result;
            };
            reader.readAsDataURL(file);
        });

        // Load initial values on page load
        document.addEventListener('DOMContentLoaded', loadInitial);
    </script>
</body>

</html>

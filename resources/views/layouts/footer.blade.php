<!-- resources/views/layouts/footer.blade.php -->
<footer class="SAKTI-footer" role="navigation" aria-label="Navigasi bawah">
    <style>
        /* Footer styles self-contained: akan bekerja di semua halaman */
        .SAKTI-footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background: #ffffff;
            border-top: 1px solid rgba(0,0,0,0.06);
            display: flex;
            justify-content: space-around;
            padding: 8px 6px;
            z-index: 9999;
            box-shadow: 0 -4px 18px rgba(0,0,0,0.04);
            font-family: Inter, Roboto, Arial, sans-serif;
        }
        .SAKTI-footer a {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            color: #6b7f85;
            font-size: 11.5px;
            padding: 4px 6px;
            width: 20%;
            max-width: 96px;
        }
        .SAKTI-footer a i {
            font-size: 18px;
            line-height: 1;
        }
        .SAKTI-footer a .label {
            display: block;
            font-weight: 600;
            letter-spacing: 0.2px;
        }

        /* active state */
        .SAKTI-footer a.active {
            color: #2f5b68;
        }
        .SAKTI-footer a.active i {
            transform: translateY(-2px);
        }

        /* small screens tweak */
        @media(min-width:640px){
            .SAKTI-footer { max-width:640px; left:50%; transform:translateX(-50%); border-radius:12px 12px 0 0; }
            .SAKTI-footer a { font-size:12px; }
        }
    </style>

    <a href="{{ url('/dashboard') }}" data-path="/dashboard" title="Beranda">
        <i class="fa-solid fa-house"></i>
        <span class="label">Beranda</span>
    </a>

    <a href="{{ route('riwayat.kunjungan') ?? url('/riwayat') }}" data-path="/riwayat-kunjungan" title="Riwayat">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <span class="label">Riwayat</span>
    </a>

    <a href="{{ route('peta.index') ?? url('/peta') }}" data-path="/peta" title="Peta">
        <i class="fa-solid fa-map-location-dot"></i>
        <span class="label">Peta</span>
    </a>

    <a href="{{ url('/pengaturan') }}" data-path="/pengaturan" title="Pengaturan">
        <i class="fa-solid fa-gear"></i>
        <span class="label">Pengaturan</span>
    </a>

    <script>
        // tandai menu aktif berdasarkan pathname
        (function markActive(){
            try {
                const path = window.location.pathname.replace(/\/+$/,'') || '/';
                const links = document.querySelectorAll('.SAKTI-footer a');

                links.forEach(a => {
                    const target = a.getAttribute('data-path') || a.getAttribute('href') || '';
                    // cocokan by exact path atau startsWith (buat route like /riwayat-kunjungan/123)
                    if (target && (path === target || path.startsWith(target))) {
                        a.classList.add('active');
                    }
                });

                // fallback: jika tidak ada active, pilih beranda
                if (!document.querySelector('.SAKTI-footer a.active')) {
                    const home = document.querySelector('.SAKTI-footer a[data-path="/dashboard"]');
                    if (home) home.classList.add('active');
                }
            } catch (e) {
                console.warn('Footer active script error', e);
            }
        })();
    </script>
</footer>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Kawasan – SAKTI</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            padding-bottom: 40px;
            background: #f5f7fa;
        }

        .wrapper {
            max-width: 520px;
            margin: 18px auto;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            position: relative;
            padding-bottom: 15px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            background: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-right .profile-icon img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .card {
            background: white;
            padding: 10px;
            margin: 12px;
            border-radius: 10px;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.06);
        }

        .card-total {
            width: 210px;
            margin-left: 0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.08);
        }

        .card-total-top {
            background: #A6EA8A;
            padding: 12px 0;
            display: flex;
            justify-content: center;
            gap: 18px;
        }

        .card-total-top img {
            width: 32px;
            opacity: 0.9;
        }

        .card-total-body {
            background: white;
            padding: 12px;
            text-align: left;
        }

        .card-total-body strong {
            font-size: 15px;
        }

        .total-number {
            color: orange;
            font-size: 28px;
            font-weight: bold;
        }

        #map {
            width: 100%;
            height: 250px;
            border-radius: 10px;
        }

        .team-report i {
            color: green;
            margin-right: 7px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .logo-text {
            text-align: left;
        }

        .logo-subtitle {
            text-align: center;
            width: 100%;
            margin-top: 5px;
        }

        /* KARTU KECIL (grid) */
        .small-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 8px;
        }

        .small-card {
            background: #f8f9fb;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            display: flex;
            flex-direction: column;
            align-items: stretch;
            min-height: 110px;
        }

        .small-card .card-head {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .small-card .card-head .icon {
            width: 36px;
            height: 36px;
            border-radius: 6px;
            background: #e9eef6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .small-card .title {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        .stat {
            height: 26px;
            line-height: 26px;
            padding: 0 8px;
            border-radius: 4px;
            color: #fff;
            font-weight: 600;
            font-size: 13px;
            text-align: center;
            margin-top: 4px;
            box-shadow: inset 0 -2px 0 rgba(0,0,0,0.06);
        }

        .stat.green {
            background: #2fa84f;
        }

        .stat.orange {
            background: #f59c2a;
        }

        .small-card .meta {
            margin-top: auto;
            display: flex;
            gap: 8px;
            justify-content: space-between;
            align-items: center;
        }

        .small-card .meta .badge {
            font-size: 12px;
            color: #666;
        }

        /* tombol bawah grid */
        .btn-action {
            display: block;
            width: calc(100% - 24px);
            margin: 12px auto 4px auto;
            padding: 10px 14px;
            border-radius: 8px;
            text-align: center;
            background: #1e88e5;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(30,136,229,0.18);
        }

        .btn-action .fa-upload {
            margin-right: 8px;
        }

        /* responsive kecil */
        @media (max-width: 420px) {
            .small-cards {
                grid-template-columns: 1fr;
            }

            .card {
                margin: 10px 8px;
            }

            .btn-action {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">

        <div class="header">
            <div class="header-left">
                <strong>Peta Kawasan</strong>
            </div>
            <div class="header-right">
                <div class="profile-icon" title="Profil">
                    <a href="/profil"><img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="User"></a>
                </div>
            </div>
        </div>

        <div class="card" style="text-align:center;">
            <div class="logo-container">
                <img src="/asset/img/logo.png" width="60" alt="">
                <div class="logo-text">
                    <h2 style="margin:0;">SAKTI</h2>
                </div>
            </div>
            <div class="logo-subtitle">
                <small>(Sistem Analitik Kawasan Terintegrasi)</small>
            </div>
        </div>

        <div class="card">
            <div class="card-total">
                <div class="card-total-top">
                    <img src="/asset/img/node1.png" alt="">
                    <img src="/asset/img/node2.png" alt="">
                </div>

                <div class="card-total-body">
                    <strong>Total Kunjungan:</strong><br>
                    <span class="total-number">154</span>
                </div>
            </div>
        </div>

        <div class="card">
            <h4 style="margin-bottom:10px;">Peta Sebaran Kunjungan</h4>
            <div id="map"></div>
        </div>

        <div class="card team-report">
            <h4>Rapor Performa Tim</h4>
            <p>
                <img src="/asset/img/1.jpg" alt="Kawasan Senin" width="20" height="20">
                Kawasan Senin: 10 kunjungan
            </p>
            <p>
                <img src="/asset/img/1.jpg" alt="Kawasan Selasa" width="20" height="20">
                Kawasan Selasa: 7 kunjungan
            </p>
            <p>
                <img src="/asset/img/1.jpg" alt="Kawasan Rabu" width="20" height="20">
                Kawasan Rabu: 8 kunjungan
            </p>
            <p>
                <img src="/asset/img/1.jpg" alt="Kawasan Kamis" width="20" height="20">
                Kawasan Kamis: 9 kunjungan
            </p>

            <br>
            <br>

             <!-- tombol tindakan -->
            <a href="#" class="btn-action" id="uploadBtn"><i class=""></i> Perolehan Produk Bulan Ini</a>
            <!-- END: kecil-kartu dan tombol -->

            <!-- START: kecil-kartu dan tombol di bawah Kawasan Kamis -->
            <div class="small-cards" style="margin-top:8px;">


                <!-- contoh kartu 1 -->
                <div class="small-card">
                    <div class="card-head">
                        <div class="icon"><i class="fa-solid fa-credit-card"></i></div>
                        <div class="title">CC</div>
                    </div>
                    <div class="stat green">Closing: 5</div>
                    <div class="stat orange">Follow-up: 3</div>
                    <div class="meta">

                    </div>
                </div>

                <!-- kartu 2 -->
                <div class="small-card">
                    <div class="card-head">
                        <div class="icon"><i class="fa-solid fa-dollar-sign"></i></div>
                        <div class="title">KSM</div>
                    </div>
                    <div class="stat green">Closing: 5</div>
                    <div class="stat orange">Follow-up: 3</div>
                    <div class="meta">

                    </div>
                </div>

                <!-- kartu 3 -->
                <div class="small-card">
                    <div class="card-head">
                        <div class="icon"><i class="fa-solid fa-house"></i></div>
                        <div class="title">KPR</div>
                    </div>
                    <div class="stat green">Closing: 5</div>
                    <div class="stat orange">Follow-up: 3</div>
                    <div class="meta">

                    </div>
                </div>

                <!-- kartu 4 -->
                <div class="small-card">
                    <div class="card-head">
                        <div class="icon"><i class="fa-solid fa-gears"></i></div>
                        <div class="title">Tab Reg</div>
                    </div>
                    <div class="stat green">Closing: 5</div>
                    <div class="stat orange">Follow-up: 3</div>
                    <div class="meta">

                    </div>
                </div>

                <!-- kartu 5 (opsional) -->
                <div class="small-card">
                    <div class="card-head">
                        <div class="icon"><i class="fa-solid fa-globe"></i></div>
                        <div class="title">Tab Bis</div>
                    </div>
                    <div class="stat green">Closing: 2</div>
                    <div class="stat orange">Follow-up: 1</div>
                    <div class="meta">

                    </div>
                </div>

                <!-- kartu 6 (opsional) -->
                <div class="small-card">
                    <div class="card-head">
                        <div class="icon"><i class="fa-solid fa-clipboard-list"></i></div>
                        <div class="title">Tab Now</div>
                    </div>
                    <div class="stat green">Closing: 3</div>
                    <div class="stat orange">Follow-up: 2</div>
                    <div class="meta">

                    </div>
                </div>

                <div class="small-card">
                    <div class="card-head">
                        <div class="icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                        <div class="title">Deposito</div>
                    </div>
                    <div class="stat green">Closing: 3</div>
                    <div class="stat orange">Follow-up: 2</div>
                    <div class="meta">

                    </div>
                </div>

                <div class="small-card">
                    <div class="card-head">
                        <div class="icon"><i class="fa-solid fa-money-bill"></i></div>
                        <div class="title">MDS</div>
                    </div>
                    <div class="stat green">Closing: 3</div>
                    <div class="stat orange">Follow-up: 2</div>
                    <div class="meta">

                    </div>
                </div>
            </div>

        </div>

    </div>

    @include('layouts.footer')

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        //open banyuwangi
        var map = L.map('map').setView([-8.1740391, 113.6975711], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        L.marker([-8.1740391, 113.6975711])
            .addTo(map)
            .bindPopup("Lokasi Jember")
            .openPopup();

        // contoh event tombol
        document.getElementById('uploadBtn').addEventListener('click', function (e) {
            e.preventDefault();
            // ganti dengan aksi nyata: buka modal, arahkan ke route upload, dll.
            alert('Saat ini masih terbatas pada demo saja.');
        });
    </script>

</body>

</html>

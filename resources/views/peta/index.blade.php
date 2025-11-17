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
        }

        .wrapper {
            max-width: 520px;
            margin: auto;
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            position: relative;
            padding-bottom: 15px;
        }

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
        
        .header-right .profile-icon img {
            width:36px;
            height:36px;
            border-radius:50%;
            object-fit:cover;
        }

        .card {
            background: white;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1);
        }

        .card-total {
            width: 210px;
            margin: left;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.18);
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
                    <img src="https://cdn-icons-png.flaticon.com/512/1144/1144760.png" alt="User">
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
                    <img src="/asset/img/node1.png">
                    <img src="/asset/img/node2.png">
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
        </div>

    </div>

    @include('layouts.footer')

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        //open banyuwangi
        var map = L.map('map').setView([-8.2196, 114.3691], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        L.marker([-8.2196, 114.3691])
            .addTo(map)
            .bindPopup("Lokasi Banyuwangi")
            .openPopup();
    </script>

</body>

</html>
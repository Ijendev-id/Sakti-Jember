<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Ditawarkan</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #f5f5f5;">

    <div style="max-width: 520px; margin: auto; padding: 20px; background: #fff;">
        <div style="background: #f1f1f1; padding: 15px; border-radius: 5px; text-align: left; margin-bottom: 20px;">
            <h2 style="font-size: 20px; font-weight: 600; margin: 0;">Produk yang Ditawarkan</h2>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="pilihProduk('Mandiri Tabungan Bisnis')">Mandiri Tabungan Bisnis</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="pilihProduk('Giro')">Giro</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="pilihProduk('GMM / Tabungan Online')">GMM / Tabungan Online</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="pilihProduk('Tabungan Reguler')">Tabungan Reguler</div>

            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="pilihProduk('Mandiri Tabungan Rencana')">Mandiri Tabungan Rencana</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #f8b6b6;" onclick="pilihProduk('Deposito')">Deposito</div>

            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #eac2ff;" onclick="pilihProduk('Prioritas')">Prioritas</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #f8b6b6;" onclick="pilihProduk('Mandiri Deposito Swab')">Mandiri Deposito Swab</div>

            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #b5f5bf;" onclick="pilihProduk('Electronic Data Capture (EDC)')">Electronic Data Capture (EDC)</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #b5f5bf;" onclick="pilihProduk('Livin Merchant (LVM)')">Livin Merchant (LVM)</div>

            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #fff9a8;" onclick="pilihProduk('Payroll')">Payroll</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="pilihProduk('Kredit Usaha Rakyat (KUR)')">Kredit Usaha Rakyat (KUR)</div>            

            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="pilihProduk('Kredit Usaha Mikro (KUM)')">Kredit Usaha Mikro (KUM)</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="pilihProduk('Kredit Serba Mandiri (KSM)')">Kredit Serba Mandiri (KSM)</div>
            
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="pilihProduk('Kredit Kepemilikan Rumah (KPR)')">Kredit Kepemilikan Rumah (KPR)</div>
            <div style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="pilihProduk('Kartu Kredit (KK)')">Kartu Kredit (KK)</div>
        </div>

        <div style="display: flex; justify-content: left; gap: 10px; margin-top: 20px;">
            <button style="padding: 12px 20px; border: none; font-size: 15px; border-radius: 8px; cursor: pointer; background: #cfcfcf;" onclick="window.history.back()">Kembali</button>
        </div>
    </div>

    <div id="popup" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); justify-content: center; align-items: center;">
        <div style="background: #636363; padding: 20px; width: 40%; border-radius: 15px; text-align: center;">
            <h3 style="color: white; margin-top: 0;">Pilih Status</h3>

            <button style="width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; background: #add9f4;" onclick="pilihStatus('Closing')">Closing</button>
            <button style="width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; background: #b5f5bf;" onclick="pilihStatus('On Progress')">On Progress</button>
            <button style="width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; background: #fff9a8;" onclick="pilihStatus('Follow Up')">Follow Up</button>
            <button style="width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; background: #f8b6b6;" onclick="pilihStatus('Tidak Berminat')">Tidak Berminat</button>

            <button style="margin-top: 15px; padding: 10px; width: 100%; background: #ccc; border: none; border-radius: 10px; font-weight: 600;" onclick="closePopup()">Tutup</button>
        </div>
    </div>

    <script>
        let produkDipilih = null;

        function pilihProduk(namaProduk) {
            produkDipilih = namaProduk;
            openPopup();
        }

        function pilihStatus(status) {
            if (!produkDipilih) return;

            // simpan sementara untuk halaman temanmu
            sessionStorage.setItem('produk_dipilih', produkDipilih);
            sessionStorage.setItem('status_produk', status);

            // kembali ke halaman kunjungan temanmu
            window.history.back();
        }

        function openPopup() {
            document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Ditawarkan</title>
    <style>
        .selected {
            border: 3px solid #2f5b68 !important;
            background: #d4edda !important;
        }
        .selection-count {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #2f5b68;
            color: white;
            padding: 10px 15px;
            border-radius: 20px;
            font-weight: bold;
            z-index: 100;
        }
    </style>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #f5f5f5;">

    <div id="selectionCount" class="selection-count" style="display: none;">0 produk dipilih</div>

    <div style="max-width: 520px; margin: auto; padding: 20px; background: #fff;">
        <div style="background: #f1f1f1; padding: 15px; border-radius: 5px; text-align: left; margin-bottom: 20px;">
            <h2 style="font-size: 20px; font-weight: 600; margin: 0;">Produk yang Ditawarkan</h2>
            <p style="margin: 5px 0 0 0; font-size: 14px; color: #666;">Pilih satu atau lebih produk</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
            <div id="Mandiri Tabungan Bisnis" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="toggleProduk('Mandiri Tabungan Bisnis')">Mandiri Tabungan Bisnis</div>
            <div id="Giro" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="toggleProduk('Giro')">Giro</div>
            <div id="GMM / Tabungan Online" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="toggleProduk('GMM / Tabungan Online')">GMM / Tabungan Online</div>
            <div id="Tabungan Reguler" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="toggleProduk('Tabungan Reguler')">Tabungan Reguler</div>

            <div id="Mandiri Tabungan Rencana" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #add9f4;" onclick="toggleProduk('Mandiri Tabungan Rencana')">Mandiri Tabungan Rencana</div>
            <div id="Deposito" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #f8b6b6;" onclick="toggleProduk('Deposito')">Deposito</div>

            <div id="Prioritas" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #eac2ff;" onclick="toggleProduk('Prioritas')">Prioritas</div>
            <div id="Mandiri Deposito Swab" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #f8b6b6;" onclick="toggleProduk('Mandiri Deposito Swab')">Mandiri Deposito Swab</div>

            <div id="Electronic Data Capture (EDC)" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #b5f5bf;" onclick="toggleProduk('Electronic Data Capture (EDC)')">Electronic Data Capture (EDC)</div>
            <div id="Livin Merchant (LVM)" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #b5f5bf;" onclick="toggleProduk('Livin Merchant (LVM)')">Livin Merchant (LVM)</div>

            <div id="Payroll" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #fff9a8;" onclick="toggleProduk('Payroll')">Payroll</div>
            <div id="Kredit Usaha Rakyat (KUR)" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="toggleProduk('Kredit Usaha Rakyat (KUR)')">Kredit Usaha Rakyat (KUR)</div>            

            <div id="Kredit Usaha Mikro (KUM)" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="toggleProduk('Kredit Usaha Mikro (KUM)')">Kredit Usaha Mikro (KUM)</div>
            <div id="Kredit Serba Mandiri (KSM)" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="toggleProduk('Kredit Serba Mandiri (KSM)')">Kredit Serba Mandiri (KSM)</div>
            
            <div id="Kredit Kepemilikan Rumah (KPR)" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="toggleProduk('Kredit Kepemilikan Rumah (KPR)')">Kredit Kepemilikan Rumah (KPR)</div>
            <div id="Kartu Kredit (KK)" style="padding: 15px; border-radius: 10px; text-align: center; font-weight: 600; font-size: 14px; cursor: pointer; background: #ffcc73;" onclick="toggleProduk('Kartu Kredit (KK)')">Kartu Kredit (KK)</div>
        </div>

        <div style="display: flex; justify-content: space-between; gap: 10px; margin-top: 20px;">
            <button style="padding: 12px 20px; border: none; font-size: 15px; border-radius: 8px; cursor: pointer; background: #cfcfcf;" onclick="window.history.back()">Kembali</button>
            <button id="btnSimpan" style="padding: 12px 20px; border: none; font-size: 15px; border-radius: 8px; cursor: pointer; background: #2f5b68; color: white;" onclick="simpanProduk()">Simpan Produk</button>
        </div>
    </div>

    <div id="popup" style="display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.4); justify-content: center; align-items: center;">
        <div style="background: #636363; padding: 20px; width: 40%; border-radius: 15px; text-align: center;">
            <h3 style="color: white; margin-top: 0;">Pilih Status untuk <span id="popupProductName"></span></h3>

            <button style="width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; background: #add9f4;" onclick="pilihStatus('Closing')">Closing</button>
            <button style="width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; background: #b5f5bf;" onclick="pilihStatus('On Progress')">On Progress</button>
            <button style="width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; background: #fff9a8;" onclick="pilihStatus('Follow Up')">Follow Up</button>
            <button style="width: 100%; padding: 12px; margin-top: 10px; border: none; border-radius: 12px; font-size: 15px; font-weight: 600; cursor: pointer; background: #f8b6b6;" onclick="pilihStatus('Tidak Berminat')">Tidak Berminat</button>

            <button style="margin-top: 15px; padding: 10px; width: 100%; background: #ccc; border: none; border-radius: 10px; font-weight: 600;" onclick="closePopup()">Tutup</button>
        </div>
    </div>

    <script>
        let selectedProducts = [];
        let currentProduct = null;

        function loadSelectedProducts() {
            const stored = sessionStorage.getItem('produk_dipilih');
            if (stored) {
                try {
                    selectedProducts = JSON.parse(stored);
                    updateSelectionDisplay();
                    highlightSelectedProducts();
                } catch (e) {
                    selectedProducts = [];
                }
            }
        }

        function toggleProduk(namaProduk) {
            currentProduct = namaProduk;
            
            const existingProduct = selectedProducts.find(p => p.nama === namaProduk);
            if (existingProduct) {        
                selectedProducts = selectedProducts.filter(p => p.nama !== namaProduk);
                document.getElementById(namaProduk).classList.remove('selected');
            } else {
                openPopup(namaProduk);
            }
            
            updateSelectionDisplay();
        }

        function openPopup(namaProduk) {
            document.getElementById('popupProductName').textContent = namaProduk;
            document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            currentProduct = null;
        }

        function pilihStatus(status) {
            if (!currentProduct) return;

            selectedProducts.push({
                nama: currentProduct,
                status: status
            });

            document.getElementById(currentProduct).classList.add('selected');
            
            closePopup();
            updateSelectionDisplay();
        }

        function updateSelectionDisplay() {
            const countElement = document.getElementById('selectionCount');
            const simpanButton = document.getElementById('btnSimpan');
            
            if (selectedProducts.length > 0) {
                countElement.style.display = 'block';
                countElement.textContent = `${selectedProducts.length} produk dipilih`;
                simpanButton.disabled = false;
                simpanButton.style.opacity = '1';
            } else {
                countElement.style.display = 'none';
                simpanButton.disabled = true;
                simpanButton.style.opacity = '0.6';
            }
        }

        function highlightSelectedProducts() {
            selectedProducts.forEach(product => {
                const element = document.getElementById(product.nama);
                if (element) {
                    element.classList.add('selected');
                }
            });
        }

        function simpanProduk() {
            sessionStorage.setItem('produk_dipilih', JSON.stringify(selectedProducts));
            window.history.back();
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadSelectedProducts();
        });
    </script>

</body>
</html>
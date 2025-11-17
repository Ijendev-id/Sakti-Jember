<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Foto Kunjungan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 520px;
            background-color: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c4661;
        }

        .upload-box {
            background: #e5e5e5;
            padding: 25px 15px;
            border-radius: 12px;
            text-align: center;
        }

        #cameraIcon {
            font-size: 90px;
            color: #2c4661;
            margin-bottom: 10px;
        }

        #cameraPreview {
            width: 100%;
            border-radius: 12px;
            display: none;
        }

        #photoResult {
            width: 100%;
            border-radius: 12px;
            display: none;
            margin-bottom: 15px;
        }

        .upload-text-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .upload-desc {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .btn-row {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .btn {
            background: #2c4661;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            flex: 1;
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background: #1e3247;
        }

        .btn-back {
            margin-top: 40px;
            background: #dcdcdc;
            padding: 10px 25px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background: #c8c8c8;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">Unggah Foto Kunjungan Kawasan</div>

        <div class="upload-box">
            <video id="cameraPreview" autoplay playsinline></video>

            <img id="photoResult">

            <div id="cameraIcon">📷</div>

            <div class="upload-text-title">Ambil / Unggah Foto Baru</div>
            <div class="upload-desc">Gunakan Kamera untuk Mengambil Foto Lapangan</div>

            <div class="btn-row">
                <button class="btn" id="btnStart">Mulai Kamera</button>
                <button class="btn" id="btnCapture" style="display:none;">Ambil Foto</button>
                <button class="btn" id="btnRetake" style="display:none;">Ulangi</button>
                <button class="btn" id="btnSend" style="display:none;">Kirim</button>
            </div>
        </div>

        <button class="btn-back">Kembali</button>
    </div>

    <script>
        const cameraPreview = document.getElementById("cameraPreview");
        const photoResult = document.getElementById("photoResult");
        const btnStart = document.getElementById("btnStart");
        const btnCapture = document.getElementById("btnCapture");
        const btnRetake = document.getElementById("btnRetake");
        const btnSend = document.getElementById("btnSend");
        const cameraIcon = document.getElementById("cameraIcon");

        let stream;

        btnStart.onclick = async () => {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "environment"
                    }
                });

                cameraPreview.srcObject = stream;
                cameraPreview.style.display = "block";

                cameraIcon.style.display = "none";
                btnStart.style.display = "none";
                btnCapture.style.display = "block";
            } catch (error) {
                alert("Tidak dapat mengakses kamera: " + error.message);
            }
        };

        btnCapture.onclick = () => {
            const canvas = document.createElement("canvas");
            canvas.width = cameraPreview.videoWidth;
            canvas.height = cameraPreview.videoHeight;

            const context = canvas.getContext("2d");
            context.drawImage(cameraPreview, 0, 0, canvas.width, canvas.height);

            const imageData = canvas.toDataURL("image/jpeg");
            photoResult.src = imageData;
            photoResult.style.display = "block";

            cameraPreview.style.display = "none";
            btnCapture.style.display = "none";
            btnRetake.style.display = "block";
            btnSend.style.display = "block";

            stream.getTracks().forEach(track => track.stop());
        };

        btnRetake.onclick = () => {
            photoResult.style.display = "none";
            btnRetake.style.display = "none";
            btnSend.style.display = "none";

            btnStart.click();
        };

        btnSend.onclick = () => {
            const fotoData = photoResult.src;
            sessionStorage.setItem('foto_kunjungan', fotoData);

            window.location.href = "{{ route('kunjungan.create') }}";
        };

    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Buku Tamu</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f9f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }
        .container-form {
            max-width: 500px;
            padding: 30px 25px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #ff4d67;
            color: white;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            margin-bottom: 25px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        h3 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
            color: #666;
        }
        .form-label {
            font-weight: bold;
        }
        .form-select:hover, 
        .form-control:hover {
            border-color: #ff4d67;
            box-shadow: 0 0 5px rgba(255, 77, 103, 0.5);
        }
        .btn-submit {
            background-color: #ff4d67;
            color: white;
            font-size: 16px;
            padding: 10px;
            border-radius: 8px;
        }
        .btn-submit:hover {
            background-color: #ff6f85;
        }
    </style>
</head>
<body>

    <div class="container container-form">
        <div class="header">
            Beranda - DPMPTSP
        </div>
        <h3>Sistem Informasi Buku Tamu (SIBUTA) </h3>
        <p>Ini adalah buku tamu pada DPMPTSP SUMUT</p>

        <form>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama anda" required>
            </div>

            <div class="mb-3">
                <label for="nohp" class="form-label">No Hp</label>
                <input type="text" class="form-control" id="nohp" placeholder="Masukkan no hp anda" required>
            </div>

            <div class="mb-3">
                <label for="pekerjaan" class="form-label">Pekerjaan Anda</label>
                <select class="form-select" id="pekerjaan" required>
                    <option selected disabled>--- Pilih Pekerjaan Anda ---</option>
                    <option value="PNS">PNS</option>
                    <option value="Swasta">Swasta</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="instansi" class="form-label">Asal Instansi</label>
                <select class="form-select" id="instansi" required>
                    <option selected disabled>--- Pilih Instansi Anda ---</option>
                    <option value="Instansi 1">Instansi 1</option>
                    <option value="Instansi 2">Instansi 2</option>
                    <option value="Instansi 3">Instansi 3</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="keperluan" class="form-label">Keperluan</label>
                <select class="form-select" id="keperluan" required>
                    <option selected disabled>--- Pilih Keperluan Anda ---</option>
                    <option value="Keperluan 1">Keperluan 1</option>
                    <option value="Keperluan 2">Keperluan 2</option>
                    <option value="Keperluan 3">Keperluan 3</option>
                </select>
            </div>

            <button type="submit" class="btn btn-submit w-100">Kirim</button>
        </form>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

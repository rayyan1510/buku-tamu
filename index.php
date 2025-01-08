<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Buku Tamu</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Tombol Kembali ke Beranda -->
    <a href="#" class="btn-back mb-3">Kembali ke Beranda</a>

    <div class="container container-form mt-3">
        <h3>Sistem Informasi Buku Tamu</h3>
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
                <label for="pekerjaan" class="form-label" id="pekerjaan_anda">Pekerjaan Anda</label>
                <select class="form-select" id="pekerjaan" required>
                    <option selected disabled>--- Pilih Pekerjaan Anda ---</option>
                    <option value="PNS">PNS</option>
                    <option value="Swasta">Non PNS</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="instansi" class="form-label asal_instansi">Asal Instansi</label>
                <select class="form-select" id="instansi" required>
                    <option selected disabled>--- Pilih Instansi Anda ---</option>
                    <option value="Instansi 1">Instansi 1</option>
                    <option value="Instansi 2">Instansi 2</option>
                    <option value="Instansi 3">Instansi 3</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="keperluan" class="form-label keperluan">Keperluan</label>
                <select class="form-select" id="keperluan" required>
                    <option selected disabled>--- Pilih Keperluan Anda ---</option>
                    <option value="Keperluan 1">Keperluan 1</option>
                    <option value="Keperluan 2">Keperluan 2</option>
                    <option value="Keperluan 3">Keperluan 3</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Kirim</button>
        </form>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script JS -->
    <script src="script.js"></script>
</body>

</html>
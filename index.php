<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Buku Tamu</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">

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
                    <option value="Pekerjaan_lainnya">Lainnya</option>
                </select>
            </div>

            <div class="mb-3" id="additionalInput2" style="display: none;">
                <label for="additionalInfo2" class="form-label">Detail Pekerjaan</label>
                <select class="form-select" id="additionalInfo2">
                    <option selected disabled>--- Pilih Detail Pekerjaan Anda ---</option>
                    <option value="Kementerian">Kementerian/ Lembaga Pemerintah Non Kementerian</option>
                    <option value="OPD">OPD Provinsi SUMUT</option>
                    <option value="OPD_lain">OPD Provinsi Lain</option>
                    <option value="OPD_kabupaten">OPD Kabupaten/Kota</option>
                </select>
            </div>

            <div class="mb-3" id="additionalInput" style="display: none;">
                <label for="additionalInfo" class="form-label">Detail Pekerjaan</label>
                <input type="text" class="form-control" id="additionalInfo" placeholder="Masukkan detail pekerjaan...">
            </div>


            <div class="mb-3">
                <label for="keperluan" class="form-label" id="keperluan_anda">Keperluan Anda</label>
                <select class="form-select" id="keperluan" required>
                    <option selected disabled>--- Pilih Keperluan Anda ---</option>
                    <option value="Kunjungan_dinas">Kunjungan Dinas</option>
                    <option value="Kunjungan_non_dinas">Kunjungan Non Dinas</option>
                    <option value="Konsultasi">Konsultasi</option>
                    <option value="Permohonan_informasi_PPID">Permohonan Informasi PPID</option>
                    <option value="Permohonan_informasi_PB">Permohonan Informasi PB/PB UMKU</option>
                    <option value="Pengurusan_PB_UMKU">Pengurusan PB/PB UMKU</option>
                    <option value="Pengaduan_masyarakat">Pengaduan Masyarakat</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="mb-3" id="keperluanInput" style="display: none;">
                <label for="keperluanDetail" class="form-label">Detail Keperluan</label>
                <input type="text" class="form-control" id="keperluanDetail" placeholder="Masukkan detail keperluan anda...">
            </div>

            <button type="submit" class="btn-submit">Kirim</button>
        </form>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script JS -->
    <script src="./assets/js/script.js"></script>
</body>

</html>
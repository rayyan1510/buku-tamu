<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Buku Tamu</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Tombol Kembali ke Beranda -->
    <a href="#" class="btn-back mb-3">Kembali ke Beranda</a>

    <div class="container container-form mt-3">
        <h3>Sistem Informasi Buku Tamu</h3>
        <p>Ini adalah buku tamu pada DPMPTSP SUMUT</p>

        <form action="./proses_simpan.php" method="POST">
            <!-- Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama anda" aria-labelledby="Masukkan nama Anda" required>
            </div>
            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label for="nohp" class="form-label">No Hp</label>
                <input type="tel" class="form-control" id="nohp" placeholder="Masukkan no hp anda" required>
            </div>

            <!-- Pekerjaan -->
            <div class="mb-3">
                <label for="pekerjaanAnda" class="form-label">Pekerjaan Anda</label>
                <select class="form-select" id="pekerjaanAnda" name="pekerjaanAnda" aria-label="Pekerjaan Anda" required>
                    <option selected disabled>--- Pilih Pekerjaan Anda ---</option>
                    <option value="PNS">PNS</option>
                    <option value="Swasta">Non PNS</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="mb-3" id="detailPekerjaanSpesifik" style="display: none;">
                <!-- Detail Pekerjaan Spesifik-->
                <label for="detailPekerjaanSpesifik" class="form-label">Detail Pekerjaan</label>
                <input type="text" class="form-control" id="detailPekerjaanSpesifik" placeholder="Masukkan detail pekerjaan anda...">
            </div>

            <div class="mb-3" id="detailPekerjaan" style="display: none;">
                <!-- Detail Pekerjaan -->
                <label for="detailPekerjaan" class="form-label">Detail Pekerjaan</label>
                <select class="form-select" id="detailPekerjaanSelect" name="detailPekerjaan" aria-label="Detail Pekerjaan" required>
                    <option selected disabled>--- Pilih Detail Pekerjaan Anda ---</option>
                    <option value="Kementerian">Kementerian/ Lembaga Pemerintah Non Kementerian</option>
                    <option value="OPD">OPD Provinsi SUMUT</option>
                    <option value="OPD_lain">OPD Provinsi Lain</option>
                    <option value="OPD_kabupaten">OPD Kabupaten/Kota</option>
                </select>
            </div>


            <!-- Keperluan -->
            <div class="mb-3">
                <label for="keperluan" class="form-label" id="keperluan">Keperluan Anda</label>
                <select class="form-select" id="keperluan" name="keperluan" aria-label="Keperluan Anda" required>
                    <option selected disabled>--- Pilih Keperluan Anda ---</option>
                    <option value="Kunjungan-dinas">Kunjungan Dinas</option>
                    <option value="Kunjungan-non-dinas">Kunjungan Non Dinas</option>
                    <option value="Konsultasi">Konsultasi</option>
                    <option value="Permohonan-informasi-PPID">Permohonan Informasi PPID</option>
                    <option value="Permohonan-informasi-PB">Permohonan Informasi PB/PB UMKU</option>
                    <option value="Pengurusan-PB-UMKU">Pengurusan PB/PB UMKU</option>
                    <option value="Pengaduan_masyarakat">Pengaduan Masyarakat</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Keperluan lebih lanjut -->
            <div class="mb-3" id="keperluanInput" style="display: none;">
                <label for="keperluanDetail" class="form-label">Detail Keperluan</label>
                <input type="text" class="form-control" id="keperluanDetail" placeholder="Masukkan detail keperluan anda...">
            </div>

            <button type="submit" class="btn-submit">Kirim</button>
        </form>
    </div>

    <!-- Script JS -->
    <script src="assets/js/script.js"></script>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
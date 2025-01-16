<?php


// include penyimpan
require_once 'connection.php';

// $post = mysqli_real_escape_string($conn, $_POST);


// var_dump($_POST);


// cek jika ada di set $_post
if (isset($_POST) == true) {

    $nama_tamu = $_POST['nama_tamu'];
    $no_hp = $_POST['no_hp'];
    // pekerjaan (PNS, NON PNS, MAHASISWA, LAINNYA)
    $jenis_tamu = $_POST['pekerjaan'];

    // pekerjaan pns secara mendetail dari form select
    // $detailPekerjaan = $_POST['detailPekerjaan'];

    // pekerjaan spesifik di input manual
    $detailPekerjaanSpesifik = $_POST['detailPekerjaanSpesifik'];


    // variable nampung jenis tamu
    $pekerjaan = '';

    // cek jika PNS maka gabungkan dengan detailPekerjaan select
    if ($jenis_tamu === 'PNS' or $jenis_tamu === 'pns') {
        // $pekerjaan = $jenis_tamu . ' ' . $detailPekerjaan;
        $pekerjaan = $jenis_tamu;
    }
    if ($jenis_tamu === 'Lainnya' or $jenis_tamu === 'lainnya') {
        $pekerjaan = $jenis_tamu . ' ' . $detailPekerjaanSpesifik;
    } else {
        $pekerjaan = $jenis_tamu;
    }

    // cek keperluan
    $keperluan = $_POST['keperluan'];

    $keperluanInput = $_POST['keperluanInput'];

    $tujuan = '';

    // jika keperluan lainnya custom $keperluan
    if ($keperluan === 'Lainnya') {
        # code...
        $tujuan = $keperluan . ' ' . $keperluanInput;
    } else {
        # code...
        $tujuan = $keperluan;
    }

    // echo $tujuan;

    // Mulai transaksi
    mysqli_begin_transaction($koneksi);

    try {
        // 1. Insert ke table 'tamu' menggunakan prepared statment
        $queryInsertTamu = "INSERT INTO tamu (nama_tamu, no_hp, keperluan, jenis_tamu)  VALUES (?, ?, ?, ?)";
        $stmtTamu = mysqli_prepare($koneksi, $queryInsertTamu);
        mysqli_stmt_bind_param(
            $stmtTamu,
            "ssss",
            $nama_tamu,
            $no_hp,
            $tujuan,
            $jenis_tamu
        );
        mysqli_stmt_execute($stmtTamu);

        // Ambil ID tamu yang baru saja dimasukkan
        $id_tamu = mysqli_insert_id($koneksi);

        // 2. Insert ke tabel `kunjungan` menggunakan prepared statement
        $queryInsertKunjungan = "INSERT INTO kunjungan (tanggal_kunjungan, id_tamu) 
                             VALUES (CURDATE(), ?)";
        $stmtKunjungan = mysqli_prepare($koneksi, $queryInsertKunjungan);
        mysqli_stmt_bind_param($stmtKunjungan, "i", $id_tamu);
        mysqli_stmt_execute($stmtKunjungan);

        // Commit transaksi
        mysqli_commit($koneksi);

        echo "<script>
                window.alert('data tamu kamu berhasil ditambahkan');
                window.location.href = 'index.php';
            </script>";
    } catch (Exception $e) {
        // Rollback jika terjadi error
        mysqli_rollback($koneksi);
        echo "Gagal menyimpan data: " . $e->getMessage();
        // echo "<script>
        // window.alert('Gagal menambahkan data tamu. Silakan coba lagi.');
        // window.location.href = 'index.php';
        // </script>";
    }

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmtTamu);
    mysqli_stmt_close($stmtKunjungan);
    mysqli_close($koneksi);
} else {
    echo "<script>
                window.alert('kamu blm menginputkan data tamu. Silakan coba lagi.');
                window.location.href = 'index.php';
            </script>";
}

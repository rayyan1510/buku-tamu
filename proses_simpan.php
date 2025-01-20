<?php
// include koneksi
require_once 'connection.php';

// session start
session_start();

// cek jika ada di set $_post
if (isset($_POST) == true) {

    $nik = htmlspecialchars($_POST['nik_tamu']);
    $nama_tamu = $_POST['nama_tamu'];
    $no_hp = $_POST['no_hp'];

    // pekerjaan (PNS, NON PNS, MAHASISWA, LAINNYA)
    $jenis_tamu = $_POST['pekerjaan'];

    // tampung perkerjaan
    $pekerjaan;

    // cek jika ada pekerjaan berupa pns dan
    // cek jika ada $_POST['detailPekerjaan'] untuk pns sudah di kirim?
    if (isset($_POST['detailPekerjaan']) == true) {
        $detailPekerjaan = $_POST['detailPekerjaan'];

        // cek jika pekerjaan berupa PNS maka gabungkan dengan form select detailPekerjaan dari PNS
        if ($jenis_tamu == 'PNS' or $jenis_tamu == 'pns') {
            $pekerjaan = $jenis_tamu . ' ' . $detailPekerjaan;
        } else {
            // jika bukan pns maka set default menjadi pekerjaan selain pns (NON PNS, MAHASISWA, LAINNYA) tanpa di ikuti detailPekerjaan PNS
            $pekerjaan = $jenis_tamu;
            // echo $pekerjaan;
        }
    } else {
        // jika tidak ada maka
        $pekerjaan = $jenis_tamu;
        // echo '$_post tidak dikirim';
    }


    // pekerjaan spesifik di input manual
    $detailPekerjaanSpesifik = $_POST['detailPekerjaanSpesifik'];

    // cek jika pekerjaan 'Lainnya'
    if ($jenis_tamu === 'Lainnya' or $jenis_tamu === 'lainnya') {
        // masukkan pekerjaan 'Lainnya' dan tambahkan detail pekerjaan spesifik yang diinputkan oleh user
        $pekerjaan = $jenis_tamu . ' ' . $detailPekerjaanSpesifik;
    }


    // cek keperluan
    $keperluan  = $_POST['keperluan'];

    $keperluanInput = $_POST['keperluanInput'];


    // jika keperluan lainnya + $keperluanInput
    if ($keperluan === 'Lainnya') {
        # code...
        $tujuan = $keperluan . ' ' . $keperluanInput;
    } else {
        # code...
        $tujuan = $keperluan;
    }

    // Mulai transaksi
    mysqli_begin_transaction($koneksi);

    try {
        // 1. Insert ke table 'tamu' menggunakan prepared statment
        $queryInsertTamu = "INSERT INTO tamu (nik, nama_tamu, no_hp, keperluan, jenis_tamu)  VALUES (?, ?, ?, ?, ?)";
        $stmtTamu = mysqli_prepare($koneksi, $queryInsertTamu);
        mysqli_stmt_bind_param(
            $stmtTamu,
            "sssss",
            $nik,
            $nama_tamu,
            $no_hp,
            $tujuan,
            $pekerjaan
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


        // buat session untuk menampilkan pesan sukses
        $_SESSION['success_message'] = "Data tamu berhasil ditambahkan!";

        // echo "<script>
        //         Swal.fire({
        //             title: 'Berhasil!',
        //             text: 'Data tamu berhasil ditambahkan.',
        //             icon: 'success',
        //             confirmButtonText: 'OK'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 window.location.href = 'index.php';
        //             }
        //         });
        //       </script>";
    } catch (Exception $e) {
        // Rollback jika terjadi error
        mysqli_rollback($koneksi);

        // buat session untuk menampilkan pesan yang gagal
        $_SESSION['error_message'] = "Gagal menyimpan data tamu. Silakan coba lagi.";



        // echo "Gagal menyimpan data: " . $e->getMessage();

        // echo "<script>
        //         Swal.fire({
        //             title: 'Gagal!',
        //             text: 'Gagal menyimpan data tamu. Silakan coba lagi.',
        //             icon: 'error',
        //             confirmButtonText: 'OK'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 window.location.href = 'index.php';
        //             }
        //         });
        //       </script>";
    }

    // Tutup statement dan koneksi
    mysqli_stmt_close($stmtTamu);
    mysqli_stmt_close($stmtKunjungan);
    mysqli_close($koneksi);

    // redirect ke form buku tamu
    header("Location: index.php");
    exit();
}

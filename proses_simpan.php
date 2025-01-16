<?php

include 'connection.php';

var_dump($_POST);


// cek jika ada di set $_post
if (isset($_POST) == true) {

    $nama_tamu = $_POST['nama'];
    $no_telp = $_POST['nohp'];
    $pekerjaan = $_POST['pekerjaan'];
    // $detailPekerjaan = isset($_POST['detailPekerjaan']) ? $_POST['detailPekerjaan'] : null;
    // $detailPekerjaanSpesifik = isset($_POST['detailPekerjaanSpesifik']) ? $_POST['detailPekerjaanSpesifik'] : null;
    $keperluan = $_POST['keperluan'];
    // $keperluanInput = isset($_POST['keperluanInput']) ? $_POST['keperluanInput'] : null;

    // Prepare and bind
    $stmt = $koneksi->prepare("INSERT INTO tbl_tamu (nama_tamu, nomor_hp, jenis_tamu, keperluan_tamu) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("", $nama_tamu, $no_telp, $pekerjaan, $keperluan);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}

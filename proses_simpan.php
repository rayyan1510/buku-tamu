<?php
// Include the database connection file
include 'connection.php';

var_dump($_POST);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nama_tamu = $_POST['nama_tamu'];
    $no_telp = $_POST['no_telp'];
    $pekerjaan = $_POST['pekerjaan'];
    $detailPekerjaan = isset($_POST['detailPekerjaan']) ? $_POST['detailPekerjaan'] : null;
    $detailPekerjaanSpesifik = isset($_POST['detailPekerjaanSpesifik']) ? $_POST['detailPekerjaanSpesifik'] : null;
    $keperluan = $_POST['keperluan'];
    $keperluanInput = isset($_POST['keperluanInput']) ? $_POST['keperluanInput'] : null;

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $koneksi->prepare("INSERT INTO buku_tamu (nama_tamu, no_telp, pekerjaan, detail_pekerjaan, detail_pekerjaan_spesifik, keperluan, keperluan_detail) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    // Bind parameters
    $stmt->bind_param("", $nama_tamu, $no_telp, $pekerjaan, $detailPekerjaan, $detailPekerjaanSpesifik, $keperluan, $keperluanInput);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $koneksi->close();
} else {
    echo "Invalid request method.";
}
?>
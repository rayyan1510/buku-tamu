<?php
session_start();
include './connection.php';

// Validasi session dan hak akses (sesuaikan dengan kebutuhan)
if (!isset($_SESSION['nama_jabatan'])) {
    header('Location: login_admin.php');
    exit;
}

// Pastikan parameter id ada dan valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'ID Pegawai tidak valid!'
    ];
    header("Location: table-pegawai.php");
    exit;
}

$id_pegawai = $_GET['id'];

try {
    // Mulai transaksi untuk konsistensi data
    mysqli_begin_transaction($koneksi);

    // 1. Hapus data dari tabel asn (jika ada)
    $stmt_delete_asn = $koneksi->prepare("DELETE FROM asn WHERE id_pegawai = ?");
    $stmt_delete_asn->bind_param("i", $id_pegawai);
    $stmt_delete_asn->execute();
    $stmt_delete_asn->close();

    // 2. Hapus data dari tabel tbl_pegawai
    $stmt_delete_pegawai = $koneksi->prepare("DELETE FROM tbl_pegawai WHERE id_pegawai = ?");
    $stmt_delete_pegawai->bind_param("i", $id_pegawai);
    $stmt_delete_pegawai->execute();

    // Validasi apakah data terhapus
    if ($stmt_delete_pegawai->affected_rows === 0) {
        throw new Exception("Data pegawai tidak ditemukan!");
    }
    $stmt_delete_pegawai->close();

    // Commit transaksi
    mysqli_commit($koneksi);

    $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Data pegawai berhasil dihapus!'
    ];
} catch (Exception $e) {
    // Rollback transaksi jika error
    mysqli_rollback($koneksi);

    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Gagal menghapus data: ' . $e->getMessage()
    ];
}

header("Location: table-pegawai.php");
exit;

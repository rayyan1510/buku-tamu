<?php
session_start();

// Hubungkan ke database
include './connection.php';


// if (!isset($_SESSION['jabatan'])) {
//     header('Location: login_admin.php');
//     exit;
// } else {
//     // header('Location: table-tamu.php');
// }



if (isset($_GET['id'])) {
    $id_login = intval($_GET['id']); // Konversi ke integer untuk keamanan

    try {
        // Query delete
        $query = "DELETE FROM tbl_login WHERE id_login = $id_login";

        if (mysqli_query($koneksi, $query)) {
            $_SESSION['alert'] = [
                'type' => 'success',
                'message' => 'Data berhasil dihapus!'
            ];
        } else {
            throw new Exception("Gagal menghapus data: " . mysqli_error($koneksi));
        }
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'error',
            'message' => $e->getMessage()
        ];
    }

    header("Location: table-login.php");
    exit();
} else {
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'ID tidak valid!'
    ];
    header("Location: table-login.php");
    exit();
}

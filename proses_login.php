<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Hash password menggunakan MD5
    $password_hashed =
        password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Hash password


    // Query untuk cek username dan password
    $stmt = $koneksi->prepare("SELECT * FROM view_akun_pengguna WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();


        // Verify the password using password_verify()
        if (password_verify($password, $user['password'])) {
            // Simpan data ke session
            $_SESSION['id_login'] = $user['id_login'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama']     = $user['nama_pegawai'];
            $_SESSION['nama_jabatan']  = $user['nama_jabatan'];
            $_SESSION['login'] = true;


            // Redirect berdasarkan jabatan
            switch ($user['nama_jabatan']) {
                case 'Kepala Dinas Penanaman Modal dan PTSP':
                    header("Location: dashboard.php");
                    break;
                case 'Sekretaris':
                    header("Location: dashboard.php");
                    break;
                case 'Kepala Sub Bagian Umum dan Kepegawaian':
                    header("Location: dashboard.php");
                    break;
                case 'Front Office':
                    header("Location: dashboard.php");
                    break;
                case 'Front Office (OSS)':
                    header("Location: dashboard.php");
                    break;
                case 'Satpam':
                    header("Location: dashboard.php");
                    break;
                case 'Admin':
                    header("Location: dashboard.php");
                    break;
                    // default:
                    //     header("Location: login.php?error=Unknown Role");
                    //     break;
            }
            exit;
        } else {
            // Set error message
            $_SESSION['message'] = [
                'icon' => 'error',
                'title' => 'Login Gagal',
                'text' => 'Password yang Anda masukkan salah.'
            ];
            header("Location: login_admin.php");
            exit;
        }
    } else {
        // Set error message
        $_SESSION['message'] = [
            'icon' => 'error',
            'title' => 'Login Gagal',
            'text' => 'Username tidak ditemukan.'
        ];
        header("Location: login_admin.php");
        exit;
    }
} else {
    // Set error message
    $_SESSION['message'] = [
        'icon' => 'error',
        'title' => 'Login Gagal',
        'text' => 'Silakan isi username dan password.'
    ];
    header("Location: login_admin.php");
    exit;
}

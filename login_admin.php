<?php 
session_start();

// If the user is already logged in, redirect to dashboard
if (isset($_SESSION['session_username']) && $_SESSION['session_username'] != '') {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Form</title>
    <link rel="stylesheet" href="./assets/css/login_admin.css">
</head>

<body>
    <div class="container">
        <div class="left-section">
            <img src="assets/img/logopmptsp.png" alt="Logo">
            <h2>Sistem Informasi Buku Tamu</h2>
            <p>Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</p>
            <p>Sumatera Utara</p>
        </div>
        <div class="right-section">
            <h3>Silakan Login Disini!</h3>
            <form method="POST" action="login_admin.php">
                <div class="form-group">
                    <input type="text" name="username" placeholder="Enter Username..." required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group remember-me">
                    <input type="checkbox" id="rememberMe" name="remember">
                    <label for="rememberMe">Remember Me</label>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>

    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('connection.php');
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password using MD5 (same as in database)
    $hashedPassword = md5($password);

    // Query untuk mengecek login
    $stmt = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifikasi password MD5
        if ($hashedPassword == $row['password']) {
            $_SESSION['session_username'] = $username;
            $_SESSION['session_jabatan'] = $row['jabatan'];

            if (isset($_POST['remember'])) {
                setcookie('cookie_username', $username, time() + (86400 * 30), "/");
                setcookie('cookie_password', $password, time() + (86400 * 30), "/");
            }

            header("Location: dashboard.php");
            exit();
        } else {
            echo "<div class='error-message'>Invalid username or password.</div>";
        }
    } else {
        echo "<div class='error-message'>Invalid username or password.</div>";
    }
}
?>

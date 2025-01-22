<<<<<<< Updated upstream
<?php 
session_start();

// Menghapus session username dan password
$_SESSION['session_username'] = "";
$_SESSION['session_password'] = "";
session_unset();  // Menghapus semua session
session_destroy();  // Menghancurkan session

// Menghapus cookies jika ada
$cookie_name = "cookie_username";
$cookie_value = "";
$time = time() - 3600;  // Menetapkan waktu kadaluarsa cookie satu jam yang lalu
=======
<?php
// Mulai sesi
session_start();

// Hapus session
$_SESSION['session_username'] = "";
$_SESSION['session_password'] = "";
session_destroy();

// Hapus cookie
$cookie_name = "cookie_username";
$cookie_value = "";
$time = time() - (60 * 60); // Set waktu expired cookie
>>>>>>> Stashed changes
setcookie($cookie_name, $cookie_value, $time, "/");

$cookie_name = "cookie_password";
setcookie($cookie_name, $cookie_value, $time, "/");

// Redirect ke halaman login
header("Location: login_admin.php");
<<<<<<< Updated upstream
exit;
=======
exit();
>>>>>>> Stashed changes
?>

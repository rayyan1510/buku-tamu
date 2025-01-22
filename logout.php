<<<<<<< Updated upstream
<<<<<<< Updated upstream
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
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
setcookie($cookie_name, $cookie_value, $time, "/");

$cookie_name = "cookie_password";
setcookie($cookie_name, $cookie_value, $time, "/");

// Redirect ke halaman login
header("Location: login_admin.php");
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
exit;
=======
exit();
>>>>>>> Stashed changes
=======
exit();
>>>>>>> Stashed changes
=======
exit();
>>>>>>> Stashed changes
?>

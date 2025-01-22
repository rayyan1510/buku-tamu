<?php 
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
session_start();

// If the user is already logged in, redirect to dashboard
if (isset($_SESSION['session_username']) && $_SESSION['session_username'] != '') {
    header("Location: dashboard.php");
    exit();
}
?>

=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
include('connection.php');
session_start();

//atur koneksi ke database
$host_db    = "localhost";
$user_db    = "root";
$pass_db    = "";
$nama_db    = "buku_tamu";
$koneksi    = mysqli_connect($host_db,$user_db,$pass_db,$nama_db);
//atur variabel
$err        = "";
$username   = "";
$remember   = "";

if(isset($_COOKIE['cookie_username'])){
    $cookie_username = $_COOKIE['cookie_username'];
    $cookie_password = $_COOKIE['cookie_password'];

    $sql1 = "select * from login where username = '$cookie_username'";
    $q1   = mysqli_query($koneksi,$sql1);
    $r1   = mysqli_fetch_array($q1);
    if($r1['password'] == $cookie_password){
        $_SESSION['session_username'] = $cookie_username;
        $_SESSION['session_password'] = $cookie_password;
    }
}

if(isset($_SESSION['session_username'])){
    header("location:dashboard.php");
    exit();
}

if(isset($_POST['login'])){
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $ingataku   = $_POST['remember'];

    if($username == '' or $password == ''){
        $err .= "<li>Silakan masukkan username dan juga password.</li>";
    }else{
        $sql1 = "select * from login where username = '$username'";
        $q1   = mysqli_query($koneksi,$sql1);
        $r1   = mysqli_fetch_array($q1);

        if($r1['username'] == ''){
            $err .= "<li>Username <b>$username</b> tidak tersedia.</li>";
        }elseif($r1['password'] != md5($password)){
            $err .= "<li>Password yang dimasukkan tidak sesuai.</li>";
        }       
        
        if(empty($err)){
            $_SESSION['session_username'] = $username; //server
            $_SESSION['session_password'] = md5($password);

            if($ingataku == 1){
                $cookie_name = "cookie_username";
                $cookie_value = $username;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");

                $cookie_name = "cookie_password";
                $cookie_value = md5($password);
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name,$cookie_value,$cookie_time,"/");
            }
            header("location:dashboard.php");
        }
    }
}

?>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
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
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
 <form action="dashboard.php" method="POST">
    <div class="form-group">
        <input id="login-username" type="text" class="form-control" name="username" value="<?php echo $username ?>" placeholder="username">                                         
    </div>
    <div class="form-group">
        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
    </div>
    <div class="form-group remember-me">
        <input type="checkbox" id="rememberMe" name="remember" value="1" <?php if($remember == '1') echo "checked"?>> 
        <label for="rememberMe">Remember Me</label>
    </div>
    <button type="submit" name="login" class="btn btn-success btn-login">Login</button>
</form>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        </div>
    </div>

<<<<<<< Updated upstream
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
=======
</html>






<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes

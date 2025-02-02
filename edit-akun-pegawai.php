<?php
session_start();

// Hubungkan ke database
include './connection.php';


if (!isset($_SESSION['nama_jabatan'])) {
    header('Location: login_admin.php');
    exit;
}



// jika update
if (isset($_POST['submit'])) {
    $id_login = intval($_GET['id']); // Ambil ID dari parameter URL
    $username = mysqli_real_escape_string($koneksi, $_POST['Username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $id_pegawai = mysqli_real_escape_string($koneksi, $_POST['id_pegawai']);

    // Enkripsi password jika diisi
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $password_update = ", password = '$hashed_password'";
    } else {
        $password_update = "";
    }

    // Query update
    $query = "UPDATE tbl_login SET 
                username = '$username',
                id_pegawai = '$id_pegawai'
                $password_update
              WHERE id_login = '$id_login'";

    if (mysqli_query($koneksi, $query)) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Data berhasil diupdate!'
        ];
    } else {
        $_SESSION['alert'] = [
            'type' => 'error',
            'message' => 'Gagal update data: ' . mysqli_error($koneksi)
        ];
    }

    header("Location: table-login.php");
    exit();
}

// menampilkan data pegawai
// Ambil data yang akan diedit
$id_login = $_GET['id'];
$query = "SELECT * FROM tbl_login WHERE id_login = '$id_login'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

// Ambil data pegawai untuk dropdown
$query_pegawai = "SELECT * FROM tbl_pegawai";
$result_pegawai = mysqli_query($koneksi, $query_pegawai);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siap Layani - Table Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/summernote/summernote-bs4.min.css">
    <!-- link sweetalert -->
    <link rel="stylesheet" href="./assets/vendor/node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="./assets/vendor/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <!-- JS chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include_once './assets/komponen/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include_once './assets/komponen/sidebar.php';
        ?>
        <!-- Sidebar -->


        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Akun Pengguna</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Akun Pengguna</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Data Akun Pengguna</h3>
                                </div>

                                <!-- form start -->
                                <form method="post">
                                    <div class="card-body">
                                        <input type="hidden" name="id_login" value="<?= $data['id_login'] ?>">

                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="name" class="form-control" id="username" name="Username" value="<?= htmlspecialchars($data['username']) ?>" placeholder="Masukkan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="pegawai">Nama Pegawai</label>
                                            <select class="form-control select2" name="id_pegawai" id="pegawai" data-placeholder="Pilih Nama Pegawai" required>

                                                <?php
                                                if ($result_pegawai->num_rows > 0) {
                                                    while ($row = $result_pegawai->fetch_assoc()) {
                                                        $selected = ($row['id_pegawai'] == $data['id_pegawai']) ? 'selected' : '';
                                                        echo "<option value='{$row['id_pegawai']}' $selected>{$row['nama_pegawai']}</option>";
                                                    }
                                                } else {
                                                    echo '<option value="" selected disabled>Data Pegawai Belum Ada</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <a href="./table-login.php" class="btn btn-secondary color-palette">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content -->

    </div>

    <!-- jQuery -->
    <script src="./assets/vendor/admin-lte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="./assets/vendor/admin-lte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="./assets/vendor/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="./assets/vendor/admin-lte/plugins/select2/js/select2.full.min.js"></script>
    <!-- ChartJS -->
    <script src="./assets/vendor/admin-lte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="./assets/vendor/admin-lte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="./assets/vendor/admin-lte/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="./assets/vendor/admin-lte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="./assets/vendor/admin-lte/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="./assets/vendor/admin-lte/plugins/moment/moment.min.js"></script>
    <script src="./assets/vendor/admin-lte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="./assets/vendor/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="./assets/vendor/admin-lte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="./assets/vendor/admin-lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./assets/vendor/admin-lte/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="./assets/vendor/admin-lte/dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="./assets/vendor/admin-lte/dist/js/pages/dashboard.js"></script>

    <script>
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        });
    </script>
</body>

</html>
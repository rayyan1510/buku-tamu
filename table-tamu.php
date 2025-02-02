<?php
// Hubungkan ke database
include './connection.php';

session_start();

if (!isset($_SESSION['nama_jabatan'])) {
    header('Location: login_admin.php');
    exit;
}


// Ambil parameter GET untuk filter
$periode = $_GET['periode'] ?? 'all';
$bulan = $_GET['bulan'] ?? 'all';
$tahun = $_GET['tahun'] ?? 'all';

// // Bangun query dengan kondisi dinamis
// $query = "
//     SELECT tamu.id_tamu, tamu.nomor_identitas, tamu.nama_tamu, tamu.no_hp, tamu.jenis_tamu AS instansi, tamu.keperluan, kunjungan.tanggal_kunjungan 
//     FROM tamu
//     JOIN kunjungan ON tamu.id_tamu = kunjungan.id_tamu
// ";

$conditions = [];
if ($periode == 'harian') {
    $conditions[] = "DATE(kunjungan.tanggal_kunjungan) = CURDATE()";
} elseif ($periode == 'mingguan') {
    $conditions[] = "YEARWEEK(kunjungan.tanggal_kunjungan, 1) = YEARWEEK(CURDATE(), 1)";
} elseif ($periode == 'bulanan') {
    if ($bulan != 'all') {
        $conditions[] = "MONTH(kunjungan.tanggal_kunjungan) = $bulan";
    }
    if ($tahun != 'all') {
        $conditions[] = "YEAR(kunjungan.tanggal_kunjungan) = $tahun";
    }
} elseif ($periode == 'tahunan') {
    if ($tahun != 'all') {
        $conditions[] = "YEAR(kunjungan.tanggal_kunjungan) = $tahun";
    }
}

// if (!empty($conditions)) {
//     $query .= " WHERE " . implode(" AND ", $conditions);
// }

// Eksekusi query
// $result = $koneksi->query($query);
// if (!$result) {
//     die("Query gagal: " . $koneksi->error);
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siap Layani</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./assets/vendor/admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
    <!-- JS chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include_once './assets/komponen/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once './assets/komponen/sidebar.php'; ?>
        <!-- Sidebar -->


        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Selamat Datang</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
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
                                    <h3 class="card-title">Data Tamu</h3>
                                </div>
                                <div class="card-body">


                                    <!-- Tabel Data Tamu -->
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nomor Identitas</th>
                                                <th>Nama Tamu</th>
                                                <th>Nomor HP</th>
                                                <th>Instansi</th>
                                                <th>Keperluan</th>
                                                <th>Tanggal & Jam</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
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
</body>

</html>
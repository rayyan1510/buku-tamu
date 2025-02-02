<?php
session_start();

// Hubungkan ke database
include './connection.php';


if (!isset($_SESSION['nama_jabatan'])) {
    header('Location: login_admin.php');
    exit;
}
//     // header('Location: table-tamu.php');
// }

// menampilkan data data pegawai
$query = "SELECT * FROM view_honorer";
$result = mysqli_query($koneksi, $query);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sibook - Sistem Informasi Buku Tamu</title>

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
        <?php include_once './assets/komponen/sidebar.php'; ?>
        <!-- Sidebar -->


        <!-- Main Content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Honorer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Honorer</li>
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
                                    <h3 class="card-title">Data Honorer</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-1.5 mr-2">
                                            <a href="./tambah-pegawai.php" class="btn btn-success color-palette">
                                                <i class="fas fa-plus-square"></i> Tambah Data
                                            </a>
                                        </div>
                                        <div class="col-1.5 mr-2">
                                            <a href="./table-asn.php" class="btn bg-navy color-palette">
                                                <i class="fas fa-eye"></i> Lihat Data Honorer
                                            </a>
                                        </div>
                                        <div class="col-1.5 mr-2">
                                            <a href="./table-honorer.php" class="btn bg-lightblue color-palette">
                                                <i class="fas fa-eye"></i> Lihat Data Honorer
                                            </a>
                                        </div>
                                    </div>

                                    <script>
                                        function confirmDelete() {
                                            // Menggunakan confirm bawaan browser
                                            return confirm('Apakah Anda yakin ingin menghapus data ini?');

                                            // Atau menggunakan SweetAlert (lebih recommended)
                                            /*
                                            event.preventDefault();
                                            const url = event.currentTarget.href;
                                            Swal.fire({
                                                title: 'Hapus Data?',
                                                text: "Data yang dihapus tidak bisa dikembalikan!",
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonColor: '#d33',
                                                cancelButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya, Hapus!'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = url;
                                                }
                                            })
                                            */
                                        }
                                    </script>

                                    <!-- Tabel Data Tamu -->
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Honorer</th>
                                                <th>Status</th>
                                                <th>Jabatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= htmlspecialchars($row['nama_pegawai']) ?></td>
                                                        <td>
                                                            <span class="badge <?= $row['status'] == 'ASN' ? 'badge-success' : 'badge-info' ?>">
                                                                <?= htmlspecialchars($row['status']) ?>
                                                            </span>
                                                        </td>
                                                        <td><?= htmlspecialchars($row['nama_jabatan']) ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="./edit-data-pegawai.php?id=<?= $row['id_pegawai'] ?>"
                                                                    class="btn btn-sm btn-warning"
                                                                    title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <div class="pr-2"></div>
                                                                <a href="./hapus-data-pegawai.php?id=<?= $row['id_pegawai'] ?>"
                                                                    class="btn btn-sm btn-danger"
                                                                    title="Hapus"
                                                                    onclick="return confirmDelete(event)">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan='5' class='text-center'>Tidak ada data ditemukan</td>
                                                </tr>
                                            <?php } ?>

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
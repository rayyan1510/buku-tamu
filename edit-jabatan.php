<?php
session_start();

// Hubungkan ke database
include './connection.php';

if (!isset($_SESSION['nama_jabatan'])) {
    header('Location: login_admin.php');
    exit;
}

// Ambil data yang akan diedit
$id_jabatan = $_GET['id'];
$query = "SELECT * FROM tbl_jabatan WHERE id_jabatan = '$id_jabatan'";
$result = mysqli_query($koneksi, $query);

if ($result->num_rows === 0) {
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Data jabatan tidak ditemukan!'
    ];
    header("Location: table-jabatan.php");
    exit;
}

$data = mysqli_fetch_assoc($result);


// Proses form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jabatan = htmlspecialchars(trim($_POST['jabatan']));

    try {
        // Validasi input
        if (empty($jabatan)) {
            throw new Exception("Nama jabatan wajib diisi!");
        }

        // Cek duplikat jabatan (kecuali untuk data yang sedang diedit)
        $stmt_check = $koneksi->prepare("SELECT id_jabatan FROM tbl_jabatan WHERE jabatan = ? AND id_jabatan != ?");
        $stmt_check->bind_param("si", $jabatan, $id_jabatan);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            throw new Exception("Jabatan '{$jabatan}' sudah ada dalam database!");
        }

        // Update data jabatan
        $stmt = $koneksi->prepare("UPDATE tbl_jabatan SET jabatan = ? WHERE id_jabatan = ?");
        $stmt->bind_param("si", $jabatan, $id_jabatan);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("Tidak ada perubahan data!");
        }

        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Jabatan berhasil diperbarui!'
        ];

        header("Location: table-jabatan.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['alert'] = [
            'type' => 'error',
            'message' => $e->getMessage()
        ];
        $_SESSION['old_input'] = $_POST; // Simpan input
        header("Location: edit-jabatan.php?id=" . $id_jabatan);
        exit;
    }
}



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
        <?php
        include_once './assets/komponen/navbar.php';
        ?>
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
                            <h1 class="m-0">Data Jabatan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Jabatan</li>
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
                                    <h3 class="card-title">Edit Data Jabatan</h3>
                                </div>

                                <!-- form start -->
                                <form method="post">
                                    <div class="card-body">
                                        <input type="hidden" name="id_jabatan" value="<?= $data['id_jabatan'] ?>">

                                        <div class="form-group">
                                            <label for="jabatan">Nama Jabatan</label>
                                            <input type="text"
                                                class="form-control"
                                                id="jabatan"
                                                name="jabatan"
                                                placeholder="Contoh: Kepala Dinas"
                                                required
                                                value="<?= htmlspecialchars($data['jabatan']) ?>">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <a href="./table-jabatan.php" class="btn btn-secondary color-palette">
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

    <?php if (isset($_SESSION['alert'])): ?>
        <script>
            Swal.fire({
                icon: '<?= $_SESSION['alert']['type'] ?>',
                title: '<?= $_SESSION['alert']['type'] === 'error' ? 'Error!' : 'Sukses!' ?>',
                text: '<?= addslashes($_SESSION['alert']['message']) ?>'
            })
        </script>
        <?php unset($_SESSION['alert']); ?>
    <?php endif; ?>

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


</body>

</html>
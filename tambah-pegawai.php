<?php
session_start();

// Hubungkan ke database
include './connection.php';

if (!isset($_SESSION['nama_jabatan'])) {
    header('Location: login_admin.php');
    exit;
}

// menampilkan data pegawai
$query = "SELECT * FROM tbl_jabatan";
$result = mysqli_query($koneksi, $query);

if (isset($_POST['submit'])) {
    # jalankan proses insert

    // Ambil data dari form
    $nama_pegawai = trim($_POST['nama_pegawai']);
    $status = $_POST['status'];
    $id_jabatan = $_POST['id_jabatan'];
    $nip = $_POST['nip'] ?? null;

    // Cek apakah pegawai sudah ada berdasarkan nama
    $cek_pegawai = $koneksi->prepare("SELECT id_pegawai FROM tbl_pegawai WHERE nama_pegawai = ?");
    $cek_pegawai->bind_param("s", $nama_pegawai);
    $cek_pegawai->execute();
    $cek_pegawai->store_result();

    if ($cek_pegawai->num_rows > 0) {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Gagal!',
            'message' => 'Pegawai dengan nama yang sama sudah ada.'
        ];
        header("Location: tambah-pegawai.php");
        exit();
    }

    // Simpan data pegawai ke tabel tbl_pegawai
    $stmt = $koneksi->prepare("INSERT INTO tbl_pegawai (nama_pegawai, status, id_jabatan) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama_pegawai, $status, $id_jabatan);

    if ($stmt->execute()) {
        $id_pegawai = $stmt->insert_id; // Ambil ID pegawai yang baru disimpan

        // Jika status adalah "ASN", simpan ke tabel asn
        if ($status === "ASN") {
            // Cek apakah NIP sudah ada
            $cek_nip = $koneksi->prepare("SELECT id_asn FROM asn WHERE nip = ?");
            $cek_nip->bind_param("s", $nip);
            $cek_nip->execute();
            $cek_nip->store_result();

            if ($cek_nip->num_rows > 0) {
                $_SESSION['alert'] = [
                    'type' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'NIP sudah terdaftar.'
                ];
                header("Location: tambah-pegawai.php");
                exit();
            }

            // Simpan ke tabel asn
            $stmt_asn = $koneksi->prepare("INSERT INTO asn (id_pegawai, nip) VALUES (?, ?)");
            $stmt_asn->bind_param("is", $id_pegawai, $nip);
            if (!$stmt_asn->execute()) {
                $_SESSION['alert'] = [
                    'type' => 'error',
                    'title' => 'Gagal!',
                    'message' => 'Gagal menyimpan data ASN.'
                ];
                header("Location: tambah-pegawai.php");
                exit();
            }
        }

        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Berhasil!',
            'message' => 'Data pegawai berhasil disimpan.'
        ];
        header("Location: table-pegawai.php");
        exit();
    } else {
        $_SESSION['alert'] = [
            'type' => 'error',
            'title' => 'Gagal!',
            'message' => 'Terjadi kesalahan saat menyimpan data pegawai.'
        ];
        header("Location: tambah-pegawai.php");
        exit();
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
                            <h1 class="m-0">Data Pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Data Pegawai</li>
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
                                    <h3 class="card-title">Tambah Data Pegawai</h3>
                                </div>

                                <!-- form start -->
                                <form method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="nama_pegawai">Nama Pegawai</label>
                                            <input type="name" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan Nama Pegawai" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status Pegawai</label>
                                            <select class="form-control" name="status" placeholder="Pilih Status Pegawai" id="status" required>
                                                <option selected disabled>Pilih status pegawai</option>
                                                <option value="ASN">ASN</option>
                                                <option value="Outsourcing">Outsourcing</option>
                                            </select>
                                        </div>

                                        <div id="dynamic-fields"></div>

                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <select class="form-control select2" name="id_jabatan" id="jabatan" data-placeholder="Pilih Jabatan" required>
                                                <?php
                                                if ($result->num_rows > 0) { ?>
                                                    <option selected disabled="disabled">Pilih Jabatan</option>
                                                    <?php
                                                    while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                        <option value="<?= $row['id_jabatan']; ?>"><?= $row['jabatan']; ?></option>
                                                    <?php }
                                                } else { ?>
                                                    <option selected disabled="disabled">Data Jabatan Belum Ada</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <a href="./table-pegawai.php" class="btn btn-secondary color-palette">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> Submit</button>
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

    <script>
        // Fungsi untuk menangani notifikasi dari session
        <?php if (isset($_SESSION['alert'])): ?>
            Swal.fire({
                icon: '<?= $_SESSION['alert']['type'] ?>',
                title: '<?= $_SESSION['alert']['title'] ?>',
                text: '<?= $_SESSION['alert']['message'] ?>',
                confirmButtonColor: '#3085d6'
            });
            <?php unset($_SESSION['alert']); ?>
        <?php endif; ?>
    </script>

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
            $('.select2').select2();

            const dynamicFields = $('#dynamic-fields');

            $('#status').change(function() {
                dynamicFields.empty(); // Hapus semua field dynamic

                if ($(this).val() === 'ASN') {
                    // Membuat elemen NIP
                    const nipGroup = $('<div>').addClass('form-group');
                    nipGroup.append(
                        $('<label>').attr('for', 'nip').text('NIP'),
                        $('<input>').addClass('form-control')
                        .attr({
                            type: 'text',
                            id: 'nip',
                            name: 'nip',
                            placeholder: 'Masukkan NIP',
                            required: true
                        })
                    );

                    dynamicFields.append(nipGroup);
                }
            }).trigger('change'); // Trigger perubahan awal
        });
    </script>
</body>

</html>
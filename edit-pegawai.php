<?php
session_start();

// Hubungkan ke database
include './connection.php';

if (!isset($_SESSION['nama_jabatan'])) {
    header('Location: login_admin.php');
    exit;
}

// jika tombol submit di tekan
if (isset($_POST['submit'])) {
    // Ambil dan sanitasi input
    $id_pegawai = $_POST['id_pegawai'];
    $nama_pegawai = htmlspecialchars($_POST['nama_pegawai']);
    $status = $_POST['status'];
    $id_jabatan = $_POST['id_jabatan'];
    $nip = isset($_POST['nip']) ? htmlspecialchars($_POST['nip']) : null;

    try {
        // Validasi 1: Cek NIP untuk ASN
        if ($status === 'ASN') {
            if (empty($nip)) {
                throw new Exception("NIP wajib diisi untuk status ASN!");
            }

            // Cek duplikat NIP dengan prepared statement
            $stmt = $koneksi->prepare("SELECT * FROM asn 
                                      WHERE nip = ? 
                                      AND id_pegawai != ?");
            $stmt->bind_param("si", $nip, $id_pegawai);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                throw new Exception("NIP sudah terdaftar untuk pegawai ASN lain!");
            }
            $stmt->close();
        }

        // Validasi 2: Cek nama pegawai (opsional)
        $stmt = $koneksi->prepare("SELECT * FROM tbl_pegawai 
                                  WHERE nama_pegawai = ? 
                                  AND id_pegawai != ?");
        $stmt->bind_param("si", $nama_pegawai, $id_pegawai);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            throw new Exception("Nama pegawai sudah digunakan!");
        }
        $stmt->close();

        // Update data pegawai dengan prepared statement
        $stmt = $koneksi->prepare("UPDATE tbl_pegawai 
                                  SET nama_pegawai = ?, 
                                      status = ?, 
                                      id_jabatan = ? 
                                  WHERE id_pegawai = ?");
        $stmt->bind_param("ssii", $nama_pegawai, $status, $id_jabatan, $id_pegawai);
        $stmt->execute();

        // Pastikan ada baris yang terupdate
        if ($stmt->affected_rows === 0) {
            throw new Exception("Tidak ada perubahan data atau ID pegawai tidak ditemukan!");
        }
        $stmt->close();

        // Handle data ASN
        if ($status === 'ASN') {
            // Cek apakah data ASN sudah ada
            $stmt = $koneksi->prepare("SELECT id_asn FROM asn WHERE id_pegawai = ?");
            $stmt->bind_param("i", $id_pegawai);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $query = "UPDATE asn SET nip = ? WHERE id_pegawai = ?";
            } else {
                $query = "INSERT INTO asn (nip, id_pegawai) VALUES (?, ?)";
            }
            $stmt->close();

            // Eksekusi update/insert
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("si", $nip, $id_pegawai);
            $stmt->execute();

            if ($stmt->affected_rows < 0) {
                throw new Exception("Gagal menyimpan NIP!");
            }
            $stmt->close();
        } else {
            // Hapus data ASN jika status diubah ke non-ASN
            $stmt = $koneksi->prepare("DELETE FROM asn WHERE id_pegawai = ?");
            $stmt->bind_param("i", $id_pegawai);
            $stmt->execute();
            $stmt->close();
        }

        // Redirect dengan pesan sukses
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Data pegawai berhasil diperbarui!'
        ];
        header("Location: table-pegawai.php");
        exit;
    } catch (Exception $e) {
        // Redirect kembali ke form edit dengan pesan error
        $_SESSION['alert'] = [
            'type' => 'error',
            'message' => $e->getMessage()
        ];
        header("Location: edit-pegawai.php?id=" . $id_pegawai);
        exit;
    }
}

// Ambil data yang akan diedit
$id_pegawai = $_GET['id'];
$query = "SELECT p.*, j.jabatan, a.nip 
          FROM tbl_pegawai p 
          LEFT JOIN tbl_jabatan j ON p.id_jabatan = j.id_jabatan 
          LEFT JOIN asn a ON p.id_pegawai = a.id_pegawai 
          WHERE p.id_pegawai = '$id_pegawai'
";
// $query = "SELECT * FROM view_pegawai WHERE id_pegawai = '$id_pegawai'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);


// menampilkan data pegawai
$query = "SELECT * FROM tbl_jabatan";
$result_jabatan = mysqli_query($koneksi, $query);


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
                                    <h3 class="card-title">Edit Data Pegawai</h3>
                                </div>
                                <?php
                                if (isset($_SESSION['alert'])) {
                                    $alert = $_SESSION['alert'];
                                    unset($_SESSION['alert']);
                                    echo "<script>
                                        Swal.fire({
                                            icon: '{$alert['type']}',
                                            title: '{$alert['type']}',
                                            text: '{$alert['message']}'
                                        });
                                    </script>";
                                }
                                ?>

                                <!-- form start -->
                                <form method="post">
                                    <div class="card-body">
                                        <!-- Di dalam form -->
                                        <input type="hidden" name="id_pegawai" value="<?= $data['id_pegawai'] ?>">

                                        <div class="form-group">
                                            <label for="nama_pegawai">Nama Pegawai</label>
                                            <input type="name" class="form-control" id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan Nama Pegawai" value="<?= $data['nama_pegawai'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status Pegawai</label>
                                            <select class="form-control" name="status" placeholder="Pilih Status Pegawai" id="status" required>

                                                <option disabled>Pilih status pegawai</option>
                                                <option value="ASN" <?= ($data['status'] == 'ASN') ? 'selected' : '' ?>>ASN</option>
                                                <option value="Outsourcing" <?= ($data['status'] == 'Outsourcing') ? 'selected' : '' ?>>Outsourcing</option>
                                            </select>
                                        </div>

                                        <div id="dynamic-fields">
                                            <?php if ($data['status'] === 'ASN' && !empty($data['nip'])): ?>
                                                <div class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <input type="text" class="form-control" id="nip" name="nip"
                                                        placeholder="Masukkan NIP"
                                                        value="<?= $data['nip'] ?>" required>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="jabatan">Jabatan</label>
                                            <select class="form-control select2" name="id_jabatan" id="jabatan" data-placeholder="Pilih Jabatan" required>
                                                <?php
                                                if ($result_jabatan->num_rows > 0) { ?>
                                                    <option disabled="disabled">Pilih Jabatan</option>
                                                    <?php
                                                    while ($row = $result_jabatan->fetch_assoc()) {
                                                    ?>
                                                        <option value="<?= $row['id_jabatan']; ?>" <?= ($data['id_jabatan'] == $row['id_jabatan']) ? 'selected' : '' ?>><?= $row['jabatan']; ?></option>
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
            $('.select2').select2();

            const dynamicFields = $('#dynamic-fields');

            $('#status').change(function() {
                dynamicFields.empty(); // Hapus semua field dynamic

                if ($(this).val() === 'ASN') {
                    // Mengecek apakah ada di set nip dari ASN
                    const nipValue = '<?= isset($data['nip']) ? $data['nip'] : "" ?>';

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
                            value: nipValue, // Tambahkan nilai awal
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
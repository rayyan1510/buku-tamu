        <aside class="main-sidebar sidebar-dark-primary">
            <!-- Brand Logo -->
            <a href="./dashboard.php" class="brand-link">
                <img src="./assets/img/sibook.png" alt="Logo Sibook" class="brand-image"
                    style="">
                <span class="brand-text font-weight-light">Sibook</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="./assets/vendor/admin-lte/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <p class="d-block text-white">Selamat Datang</p>
                        <a href="#" class="d-block"><?= ucwords($_SESSION['nama']); ?></a>
                    </div>
                </div>

                <?php
                $jabatan = $_SESSION['nama_jabatan'] ?? ''; // Ambil jabatan dari session, default kosong jika belum login
                ?>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="./dashboard.php" class="nav-link active ">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">General</li>

                        <!-- Data Keperluan Tamu (Akses: 'Kepala Dinas Penanaman Modal dan PTSP', 'Sekretaris', 'Kepala Sub Bagian Umum dan Kepegawaian', 'Front Office', 'Front Office (OSS)', 'Satpam', 'Admin' ) -->
                        <?php if (in_array($jabatan, ['Kepala Dinas Penanaman Modal dan PTSP', 'Sekretaris', 'Kepala Sub Bagian Umum dan Kepegawaian', 'Front Office', 'Front Office (OSS)', 'Satpam', 'Admin'])): ?>
                            <!-- LINK TAMU -->
                            <li class="nav-item">
                                <a href="./table-tamu.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-circle"></i>
                                    <p>Daftar Tamu</p>
                                </a>
                            </li>
                            <!-- END LINK TAMU -->

                            <!-- LINK Keperluan -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-luggage-cart"></i>
                                    <p>
                                        Data Keperluan Tamu
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-user-tie"></i>
                                            <p>ASN</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-store"></i>
                                            <p>Pelaku Usaha</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END LINK Keperluan -->
                        <?php endif; ?>

                        <?php if (in_array($jabatan, ['Kepala Dinas Penanaman Modal dan PTSP', 'Sekretaris', 'Kepala Sub Bagian Umum dan Kepegawaian', 'Front Office', 'Front Office (OSS)', 'Satpam', 'Admin'])): ?>
                            <!-- LINK Pekerjaan -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <p>
                                        Data Pekerjaan Tamu
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-user-tie"></i>
                                            <p>ASN</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="nav-icon fas fa-store"></i>
                                            <p>Pelaku Usaha</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END LINK Pekerjaan -->
                        <?php endif; ?>

                        <?php if (in_array($jabatan, ['Admin'])): ?>
                            <li class="nav-header">Pengaturan Form</li>
                            <!-- Setting Form Pekerjaan -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Form Pekerjaan
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Form List Pekerjaan</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-user-tie nav-icon"></i>
                                            <p>Form Detail ASN</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End Setting Form Pekerjaan -->

                            <!-- End Setting Form Keperluan -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Form Keperluan
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-clipboard-list nav-icon"></i>
                                            <p>Form List Keperluan</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- End Setting Form Keperluan -->
                        <?php endif; ?>


                        <?php if (in_array($jabatan, ['Admin'])): ?>
                            <!-- LINK Akun Pengguna -->
                            <li class="nav-header">Pengguna</li>
                            <li class="nav-item">
                                <a href="./table-login.php" class="nav-link">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Data Akun Pengguna</p>
                                </a>
                            </li>
                            <!-- END LINK Akun Pengguna -->
                        <?php endif; ?>

                        <?php if (in_array($jabatan, ['Kepala Dinas Penanaman Modal dan PTSP', 'Sekretaris', 'Kepala Sub Bagian Umum dan Kepegawaian', 'Admin'])): ?>
                            <!-- LINK Data Pegawai -->
                            <li class="nav-item">
                                <a href="./table-pegawai.php" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Data Pegawai
                                    </p>
                                </a>
                            </li>
                            <!-- END LINK Data Pegawai -->

                            <!-- LINK Data Jabatan Pegawai -->
                            <li class="nav-item">
                                <a href="./table-jabatan.php" class="nav-link">
                                    <i class="nav-icon fas fa-id-badge"></i>
                                    <p>
                                        Data Jabatan Pegawai
                                    </p>
                                </a>
                            </li>
                            <!-- END LINK Data Jabatan Pegawai -->
                        <?php endif; ?>

                        <?php if (in_array($jabatan, ['Kepala Dinas Penanaman Modal dan PTSP', 'Sekretaris', 'Kepala Sub Bagian Umum dan Kepegawaian', 'Front Office', 'Front Office (OSS)', 'Admin'])): ?>
                            <li class="nav-header">LAPORAN</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
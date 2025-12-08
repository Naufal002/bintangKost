<?php
session_start();
include '../proses/koneksi.php';

// Cek Admin (Opsional)
// if ($_SESSION['role'] != 'admin') { header("Location: ../index.php"); exit; }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Data Keluhan</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

       <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-building"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin <sup>BintangKost</sup></div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="dashboard-admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Kelola Kost
            </div>

            <li class="nav-item">
                <a class="nav-link" href="data_kamar.php">
                    <i class="fas fa-fw fa-bed"></i>
                    <span>Data Kamar</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="data_pesanan.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Pesanan</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="keluhan_admin.php">
                    <i class="fas fa-fw fa-mail-bulk"></i>
                    <span>keluhan penyewa</span></a>
            </li>


            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Lainnya
            </div>

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    <span>Kembali ke Menu Utama</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>


        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>
                    <h1 class="h3 mb-0 text-gray-800 ml-2">Kotak Keluhan Penghuni</h1>
                </nav>

                <div class="container-fluid">
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Daftar Laporan Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Pelapor</th> <th>Judul Masalah</th>
                                            <th>Deskripsi</th>
                                            <th>Bukti Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        // LOGIKA PENGAMBILAN NAMA:
                                        // Kita pakai JOIN untuk mencocokkan 'id_user' di tabel keluhan
                                        // dengan 'id_user' di tabel login_user.
                                        // Jadi otomatis ketahuan siapa yang kirim laporan ini.
                                        
                                        $query = "SELECT 
                                                    k.*, 
                                                    u.nama AS nama_pelapor 
                                                  FROM keluhan k
                                                  JOIN login_user u ON k.id_user = u.id_user
                                                  ORDER BY k.id_keluhan DESC";

                                        $result = mysqli_query($koneksi, $query);
                                        $no = 1;

                                        while ($row = mysqli_fetch_assoc($result)) :
                                        ?>

                                        <tr>
                                            <td><?= $no++; ?></td>
                                            
                                            <td class="font-weight-bold text-dark">
                                                <?= $row['nama_pelapor']; ?>
                                            </td>

                                            <td><?= $row['judul_laporan']; ?></td>

                                            <td>
                                                <small><?= substr($row['deskripsi'], 0, 50); ?>...</small>
                                                <a href="#" data-toggle="modal" data-target="#modalDetail<?= $row['id_keluhan']; ?>">Lihat Full</a>
                                            </td>

                                            <td>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalBukti<?= $row['id_keluhan']; ?>">
                                                    <i class="fas fa-image"></i> Cek Foto
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modalBukti<?= $row['id_keluhan']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Bukti: <?= $row['judul_laporan']; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="../images/keluhan/<?= $row['bukti']; ?>" class="img-fluid rounded" alt="Bukti Laporan">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modalDetail<?= $row['id_keluhan']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Keluhan</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><strong>Pelapor:</strong> <?= $row['nama_pelapor']; ?></p>
                                                        <p><strong>Isi Laporan:</strong></p>
                                                        <div class="alert alert-secondary">
                                                            <?= $row['deskripsi']; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php endwhile; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; BintangKost 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>



    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Yakin mau keluar?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Pilih "Logout" di bawah jika kamu ingin mengakhiri sesi ini.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                                    
                            <a class="btn btn-primary" href="../proses/logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../js/demo/datatables-demo.js"></script>

</body>
</html>
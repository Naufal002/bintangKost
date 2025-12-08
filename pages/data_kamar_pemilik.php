<?php
session_start();
// Pastikan path koneksi benar. Sesuaikan dengan posisi file koneksi.php kamu
include '../proses/koneksi.php'; 

// Cek session login (Opsional, aktifkan jika sudah ada login)
// if(!isset($_SESSION['status']) || $_SESSION['role'] != 'pemilik'){
//     header("location:../login.php");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pemilik - Data Kamar</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_pemilik.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Owner <sup>BintangKost</sup></div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="dashboard-pemilik.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Laporan & Data</div>

            <li class="nav-item active">
                <a class="nav-link" href="data_kamar_pemilik.php">
                    <i class="fas fa-fw fa-hotel"></i>
                    <span>Data Kamar</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data_pesanan_pemilik.php">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Laporan Pesanan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="keluhan_pemilik.php">
                    <i class="fas fa-fw fa-mail-bulk"></i>
                    <span>keluhan penyewa</span></a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Lainnya</div>

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-arrow-left"></i>
                    <span>Kembali ke Website</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Pemilik Kost</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manajemen Aset Kamar</h1>
                        
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Seluruh Kamar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Kamar</th>
                                            <th>Kategori (Harga)</th>
                                            <th>Harga Sewa</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query data kamar
                                        $query = mysqli_query($koneksi, "SELECT * FROM data_kamar ORDER BY id_kamar DESC");
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($query)) :
                                            // Menentukan badge warna status
                                            $badge_color = ($row['ketersediaan'] == 'Tersedia' || $row['ketersediaan'] == 'sedia') ? 'success' : 'danger';
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no++; ?></td>
                                            <td class="text-center">
                                                <img src="../images/upload/<?= $row['gambar']; ?>" width="80" height="80" style="object-fit: cover; border-radius: 5px;">
                                            </td>
                                            <td>
                                                <b><?= $row['nama_kamar']; ?></b><br>
                                                <small class="text-muted"><?= substr($row['fasilitas'], 0, 50); ?>...</small>
                                            </td>
                                            <td><?= $row['kategori']; ?></td>
                                            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                            <td class="text-center">
                                                <span class="badge badge-<?= $badge_color; ?>">
                                                    <?= $row['ketersediaan']; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                <!-- modal logout -->
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
                 <!-- modal logout -->




                </div>
                </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; BintangKost 2024</span>
                    </div>
                </div>
            </footer>

        </div>
        </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>
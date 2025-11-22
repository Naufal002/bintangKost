<?php
session_start();
include '../proses/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pemilik - Data Kamar</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper">

    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-user-tie"></i></div>
            <div class="sidebar-brand-text mx-3">Pemilik Kost</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item">
            <a class="nav-link" href="dashboard-pemilik.html"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="data_kamar_pemilik.php"><i class="fas fa-fw fa-bed"></i><span>Data Kamar</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="data_pesanan_pemilik.php"><i class="fas fa-fw fa-file-invoice-dollar"></i><span>Laporan Pesanan</span></a>
        </li>
        <hr class="sidebar-divider">
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <h1 class="h3 mb-0 text-gray-800">Data Aset Kamar</h1>
            </nav>

            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark">Daftar Seluruh Kamar</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama Kamar</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM data_kamar");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) :
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                            <img src="../images/<?= $row['gambar']; ?>" width="80" style="border-radius:5px;">
                                        </td>
                                        <td><?= $row['nama_kamar']; ?></td>
                                        <td><?= $row['kategori']; ?></td>
                                        <td>Rp <?= number_format($row['harga']); ?></td>
                                        <td>
                                            <?php if($row['ketersediaan'] == 'Tersedia'): ?>
                                                <span class="badge badge-success">Tersedia</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Penuh</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
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

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../js/demo/datatables-demo.js"></script>

</body>
</html>
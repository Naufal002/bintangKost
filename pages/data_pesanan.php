<?php
session_start();
include '../proses/koneksi.php';

// Cek apakah admin sudah login (Opsional, tapi disarankan)
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
//     header("Location: ../index.php");
//     exit;
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

    <title>Admin - Data Pesanan</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bookmark"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin <sup>BintangKost</sup></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="dashboard-admin.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="data_kamar.html">
                    <i class="fas fa-fw fa-hotel"></i>
                    <span>Data Kamar</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="data_pesanan.php">
                    <i class="fas fa-fw fa-book-reader"></i>
                    <span>Data Pesanan</span></a>
            </li>
            <hr class="sidebar-divider">
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Manajemen Pesanan Masuk</h1>
                    <p class="mb-4">Kelola pesanan masuk, konfirmasi pembayaran, dan update status sewa.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Tabel Data Pesanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kamar</th>
                                            <th>Penyewa</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        // QUERY JOIN: Gabungkan tabel sewa & kamar
                                        // Kita ambil nama_lengkap & bukti_bayar dari tabel pengajuan_sewa (ps)
                                        $query = "SELECT 
                                                    ps.id_sewa, 
                                                    ps.tanggal_pengajuan, 
                                                    ps.status,
                                                    ps.nama_lengkap, 
                                                    ps.bukti_bayar,
                                                    k.nama_kamar 
                                                  FROM pengajuan_sewa ps
                                                  JOIN data_kamar k ON ps.id_kamar = k.id_kamar
                                                  ORDER BY ps.tanggal_pengajuan DESC";

                                        $result = mysqli_query($koneksi, $query);
                                        $no = 1;

                                        while ($row = mysqli_fetch_assoc($result)) :
                                        ?>

                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row['nama_kamar']; ?></td>
                                                <td><?= $row['nama_lengkap']; ?></td>
                                                <td><?= date('d-m-Y', strtotime($row['tanggal_pengajuan'])); ?></td>

                                                <td>
                                                    <?php
                                                    if ($row['status'] == 'Menunggu Konfirmasi') {
                                                        echo '<span class="badge badge-warning">Menunggu ACC</span>';
                                                    } elseif ($row['status'] == 'Disetujui') {
                                                        echo '<span class="badge badge-success">Disetujui (Tunggu Bayar)</span>';
                                                    } elseif ($row['status'] == 'Ditolak') {
                                                        echo '<span class="badge badge-danger">Ditolak</span>';
                                                    } elseif ($row['status'] == 'Menunggu Verifikasi') {
                                                        echo '<span class="badge badge-info">Cek Pembayaran</span>';
                                                    } elseif ($row['status'] == 'Lunas') {
                                                        echo '<span class="badge badge-primary">Lunas / Aktif</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php if ($row['status'] == 'Menunggu Konfirmasi') : ?>
                                                        <a href="../proses/proses_status.php?id=<?= $row['id_sewa'] ?>&aksi=terima" class="btn btn-success btn-sm" onclick="return confirm('ACC pesanan ini?')">
                                                            ACC
                                                        </a>
                                                        <a href="../proses/proses_status.php?id=<?= $row['id_sewa'] ?>&aksi=tolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pesanan ini?')">
                                                            Tolak
                                                        </a>

                                                    <?php elseif ($row['status'] == 'Menunggu Verifikasi') : ?>
                                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalBukti<?= $row['id_sewa'] ?>">
                                                            <i class="fas fa-eye"></i> Cek Bukti
                                                        </button>
                                                        <a href="../proses/proses_status.php?id=<?= $row['id_sewa'] ?>&aksi=lunas" class="btn btn-primary btn-sm" onclick="return confirm('Konfirmasi pembayaran lunas?')">
                                                            <i class="fas fa-check"></i> Lunas
                                                        </a>

                                                    <?php else : ?>
                                                        <small class="text-muted"><i>Selesai diproses</i></small>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="modalBukti<?= $row['id_sewa'] ?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bukti Transfer: <?= $row['nama_lengkap'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <?php if (!empty($row['bukti_bayar'])): ?>
                                                                <img src="../images/bukti/<?= $row['bukti_bayar'] ?>" class="img-fluid" alt="Bukti Transfer">
                                                                <br><br>
                                                                <a href="../images/bukti/<?= $row['bukti_bayar'] ?>" target="_blank" class="btn btn-sm btn-secondary">Lihat Full Size</a>
                                                            <?php else: ?>
                                                                <p class="text-danger">User belum upload bukti.</p>
                                                            <?php endif; ?>
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
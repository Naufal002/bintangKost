<?php
session_start();
include "../proses/koneksi.php";

// Cek session Admin
// if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
//     header("Location: ../login.php");
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Manajemen Pesanan</title>

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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrator</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Manajemen Pesanan Masuk</h1>
                    <p class="mb-4">Kelola status pesanan dan verifikasi bukti pembayaran penyewa.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kamar</th>
                                            <th>Penyewa</th>
                                            <th>Tgl Pengajuan</th>
                                            <th>Status Saat Ini</th>
                                            <th>Aksi Admin</th>
                                            <!--<th>KTP</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // JOIN Tabel Pengajuan Sewa + Data Kamar + Login User (Opsional, pakai nama_lengkap dari pengajuan aja cukup)
                                        $query = "SELECT ps.*, k.nama_kamar
                                                  FROM pengajuan_sewa ps
                                                  JOIN data_kamar k ON ps.id_kamar = k.id_kamar
                                                  ORDER BY ps.tanggal_pengajuan DESC";
                                        $result = mysqli_query(
                                            $koneksi,
                                            $query,
                                        );
                                        $no = 1;
                                        while (
                                            $row = mysqli_fetch_assoc($result)
                                        ): ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $row["nama_kamar"] ?></td>
                                            <td>
                                                <strong><?= $row[
                                                    "nama_lengkap"
                                                ] ?></strong><br>
                                                <small class="text-muted">KTP: ... (Opsional)</small>
                                            </td>
                                            <td><?= date(
                                                "d M Y, H:i",
                                                strtotime(
                                                    $row["tanggal_pengajuan"],
                                                ),
                                            ) ?></td>

                                            <td class="text-center">
                                                <?php if (
                                                    $row["status"] == "Pending"
                                                ) {
                                                    echo '<span class="badge badge-warning">Menunggu Konfirmasi</span>';
                                                } elseif (
                                                    $row["status"] ==
                                                    "Disetujui"
                                                ) {
                                                    echo '<span class="badge badge-info">Menunggu Pembayaran</span>';
                                                } elseif (
                                                    $row["status"] ==
                                                    "Menunggu Verifikasi"
                                                ) {
                                                    echo '<span class="badge badge-primary">Cek Bukti Bayar</span>';
                                                } elseif (
                                                    $row["status"] == "Lunas"
                                                ) {
                                                    echo '<span class="badge badge-success">Lunas / Aktif</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger">Ditolak</span>';
                                                } ?>
                                            </td>

                                            <td class="text-center">
                                                <?php if (
                                                    $row["status"] == "Pending"
                                                ): ?>
                                                    <a href="../proses/proses_status.php?id=<?= $row[
                                                        "id_sewa"
                                                    ] ?>&aksi=terima" class="btn btn-success btn-sm" onclick="return confirm('Terima pengajuan ini? User akan diminta upload bukti bayar.')">
                                                        <i class="fas fa-check"></i> Terima
                                                    </a>
                                                    <a href="../proses/proses_status.php?id=<?= $row[
                                                        "id_sewa"
                                                    ] ?>&aksi=tolak" class="btn btn-danger btn-sm" onclick="return confirm('Tolak pengajuan ini?')">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </a>

                                                <?php elseif (
                                                    $row["status"] ==
                                                    "Menunggu Verifikasi"
                                                ): ?>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalBukti<?= $row[
                                                        "id_sewa"
                                                    ] ?>">
                                                        <i class="fas fa-eye"></i> Cek Bukti
                                                    </button>
                                                    <a href="../proses/proses_status.php?id=<?= $row[
                                                        "id_sewa"
                                                    ] ?>&aksi=lunas" class="btn btn-primary btn-sm" onclick="return confirm('Pastikan uang sudah masuk! Konfirmasi lunas?')">
                                                        <i class="fas fa-dollar-sign"></i> Sahkan
                                                    </a>

                                                <?php else: ?>
                                                    <span class="text-muted small"><i class="fas fa-check-circle"></i> Selesai</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modalBukti<?= $row[
                                            "id_sewa"
                                        ] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Bukti Transfer: <?= $row[
                                                            "nama_lengkap"
                                                        ] ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <?php if (
                                                            !empty(
                                                                $row[
                                                                    "bukti_bayar"
                                                                ]
                                                            )
                                                        ): ?>
                                                            <img src="../images/bukti/<?= $row[
                                                                "bukti_bayar"
                                                            ] ?>" class="img-fluid mb-3" alt="Bukti Transfer">
                                                            <a href="../images/bukti/<?= $row[
                                                                "bukti_bayar"
                                                            ] ?>" target="_blank" class="btn btn-secondary btn-sm">Buka Gambar Penuh</a>
                                                        <?php else: ?>
                                                            <p class="text-danger">File bukti pembayaran tidak ditemukan.</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endwhile;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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

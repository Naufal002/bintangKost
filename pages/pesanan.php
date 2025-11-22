<?php
session_start();
include '../proses/koneksi.php';

// Cek login dulu, kalo belum login tendang
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$id_user = $_SESSION['user_id'];

// QUERY: Ambil data sewa + data kamar khusus user ini
$query = "SELECT 
            ps.id_sewa, 
            ps.status, 
            ps.tanggal_pengajuan,
            k.nama_kamar, 
            k.harga, 
            k.gambar,
            k.kategori
          FROM pengajuan_sewa ps
          JOIN data_kamar k ON ps.id_kamar = k.id_kamar
          WHERE ps.id_user = '$id_user' 
          ORDER BY ps.tanggal_pengajuan DESC";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pesanan Saya - BintangKost</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bookmark"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Penyewa <sup>BintangKost</sup></div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="kamar.php">
                    <i class="fas fa-fw fa-bed"></i>
                    <span>List Kamar</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="pesanan.php">
                    <i class="fas fa-fw fa-file-invoice"></i>
                    <span>Pesanan Saya</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="keluhan.html">
                    <i class="fas fa-fw fa-comments"></i>
                    <span>keluhan</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, <?php echo $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Riwayat Pesanan Saya</h1>
                    <p class="mb-4">Berikut adalah daftar pengajuan sewa kos yang pernah Anda lakukan.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pesanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kamar</th>
                                            <th>Kategori</th>
                                            <th>Harga/Bulan</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                            <tr>
                                                <td>
                                                    <img src="../images/<?= $row['gambar'] ?>" width="60" style="border-radius:5px;">
                                                    <br>
                                                    <b><?= $row['nama_kamar'] ?></b>
                                                </td>
                                                <td><?= $row['kategori'] ?></td>
                                                <td>Rp <?= number_format($row['harga']) ?>.000</td>
                                                <td><?= date('d-m-Y', strtotime($row['tanggal_pengajuan'])) ?></td>

                                                <td>
                                                    <?php
                                                    if ($row['status'] == 'Menunggu Konfirmasi') {
                                                        echo '<span class="badge badge-warning">Menunggu ACC</span>';
                                                    } elseif ($row['status'] == 'Disetujui') {
                                                        echo '<span class="badge badge-success">Disetujui (Silakan Bayar)</span>';
                                                    } elseif ($row['status'] == 'Ditolak') {
                                                        echo '<span class="badge badge-danger">Ditolak</span>';
                                                    } elseif ($row['status'] == 'Menunggu Verifikasi') {
                                                        echo '<span class="badge badge-info">Sedang Dicek Admin</span>';
                                                    } elseif ($row['status'] == 'Lunas') {
                                                        echo '<span class="badge badge-primary">Aktif / Lunas</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td>
                                                    <?php if ($row['status'] == 'Menunggu Konfirmasi') : ?>
                                                        <a href="../proses/proses_batal.php?id=<?= $row['id_sewa'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin batalkan pesanan?')">
                                                            <i class="fas fa-times"></i> Batal
                                                        </a>

                                                    <?php elseif ($row['status'] == 'Disetujui') : ?>
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalBayar<?= $row['id_sewa'] ?>">
                                                            <i class="fas fa-money-bill-wave"></i> Bayar
                                                        </button>

                                                    <?php elseif ($row['status'] == 'Ditolak') : ?>
                                                        <a href="../proses/proses_batal.php?id=<?= $row['id_sewa'] ?>" class="btn btn-secondary btn-sm" onclick="return confirm('Hapus riwayat?')">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="modalBayar<?= $row['id_sewa'] ?>" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Pembayaran: <?= $row['nama_kamar'] ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="../proses/proses_bayar.php" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <div class="alert alert-info">
                                                                    Silakan transfer <b>Rp <?= number_format($row['harga']) ?>.000</b> ke:<br>
                                                                    <b>BCA 475-458-089</b> a.n BintangKost<br>
                                                                    Lalu upload buktinya di bawah ini.
                                                                </div>
                                                                <input type="hidden" name="id_sewa" value="<?= $row['id_sewa'] ?>">
                                                                <div class="form-group">
                                                                    <label>Bukti Transfer</label>
                                                                    <input type="file" name="bukti_bayar" class="form-control-file" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-primary">Kirim Bukti</button>
                                                            </div>
                                                        </form>
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

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" jika Anda ingin mengakhiri sesi ini.</div>
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
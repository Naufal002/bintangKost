<?php
session_start();
include "../proses/koneksi.php";

// 1. CEK LOGIN (WAJIB ADA)
// Pastikan user sudah login, kalau belum lempar ke login
if (!isset($_SESSION["id_user"])) {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

$id_user = $_SESSION["id_user"];
$nama_user = isset($_SESSION["nama"]) ? $_SESSION["nama"] : "Penyewa";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pesanan Saya - BintangKost</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">

       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard_penyewa.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-smile"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Penyewa <sup>Kost</sup></div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="dashboard-penyewa.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard Saya</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Menu</div>

            <li class="nav-item">
                <a class="nav-link" href="kamar.php"> <i class="fas fa-fw fa-bed"></i>
                    <span>Cari Kamar Baru</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="pesanan.php">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Riwayat Pesanan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="keluhan.php">
                    <i class="fas fa-fw fa-mail-bulk"></i>
                    <span>keluhan anda</span></a>
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
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, <?= $nama_user ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800">Riwayat Pesanan Saya</h1>
                    <p class="mb-4">Pantau status pengajuan sewa kamar kost Anda di sini.</p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Info Kamar</th>
                                            <th>Harga/Bulan</th>
                                            <th>Tgl Pengajuan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Query hanya menampilkan data milik user yang sedang login
                                        $query = "SELECT ps.*, k.nama_kamar, k.gambar, k.kategori, k.harga
                                                  FROM pengajuan_sewa ps
                                                  JOIN data_kamar k ON ps.id_kamar = k.id_kamar
                                                  WHERE ps.id_user = '$id_user'
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
                                            <td>
                                                <img src="../images/upload/<?= $row[
                                                    "gambar"
                                                ] ?>" width="80" style="border-radius:5px; margin-bottom:5px;">
                                                <br>
                                                <b><?= $row["nama_kamar"] ?></b>
                                                <br>
                                                <small class="text-muted"><?= $row[
                                                    "kategori"
                                                ] ?></small>
                                            </td>
                                            <td>Rp <?= number_format(
                                                $row["harga"],
                                                0,
                                                ",",
                                                ".",
                                            ) ?></td>
                                            <td><?= date(
                                                "d M Y",
                                                strtotime(
                                                    $row["tanggal_pengajuan"],
                                                ),
                                            ) ?></td>

                                            <td class="text-center">
                                                <?php if (
                                                    $row["status"] == "Pending"
                                                ) {
                                                    // Di DB mungkin 'Menunggu Konfirmasi'
                                                    echo '<span class="badge badge-warning">Menunggu Konfirmasi</span>';
                                                } elseif (
                                                    $row["status"] ==
                                                    "Disetujui"
                                                ) {
                                                    echo '<span class="badge badge-primary">Disetujui (Silakan Bayar)</span>';
                                                } elseif (
                                                    $row["status"] ==
                                                    "Menunggu Verifikasi"
                                                ) {
                                                    echo '<span class="badge badge-info">Sedang Diverifikasi</span>';
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
                                                    <a href="../proses/proses_batal.php?id=<?= $row[
                                                        "id_sewa"
                                                    ] ?>&aksi=batal" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                                        <i class="fas fa-times"></i> Batal
                                                    </a>

                                                <?php elseif (
                                                    $row["status"] ==
                                                    "Disetujui"
                                                ): ?>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalBayar<?= $row[
                                                        "id_sewa"
                                                    ] ?>">
                                                        <i class="fas fa-upload"></i> Bayar sekarang
                                                    </button>

                                                <?php elseif (
                                                    $row["status"] == "Ditolak"
                                                ): ?>
                                                    <a href="../proses/proses_batal.php?id=<?= $row[
                                                        "id_sewa"
                                                    ] ?>&aksi=hapus" class="btn btn-secondary btn-sm" onclick="return confirm('Hapus dari riwayat?')">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>

                                                <?php else: ?>
                                                    <small class="text-muted">Tidak ada aksi</small>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                        <?php if (
                                            $row["status"] == "Disetujui"
                                        ): ?>
                                        <div class="modal fade" id="modalBayar<?= $row[
                                            "id_sewa"
                                        ] ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="../proses/proses_bayar.php" method="POST" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="alert alert-info">
                                                                Silakan transfer sebesar <b>Rp <?= number_format(
                                                                    $row[
                                                                        "harga"
                                                                    ],
                                                                    0,
                                                                    ",",
                                                                    ".",
                                                                ) ?></b><br>
                                                                Ke Rekening: <b>BCA 123-456-789</b> a.n BintangKost
                                                            </div>
                                                            <input type="hidden" name="id_sewa" value="<?= $row[
                                                                "id_sewa"
                                                            ] ?>">
                                                            <div class="form-group">
                                                                <label>Foto Bukti Transfer</label>
                                                                <input type="file" name="bukti_bayar" class="form-control-file" required>
                                                                <small class="text-muted">Format: JPG, PNG, JPEG. Max 2MB.</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Kirim Bukti</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
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

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../js/demo/datatables-demo.js"></script>

</body>
</html>

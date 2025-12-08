<?php
session_start();
include '../proses/koneksi.php';

// Cek apakah sudah login sebagai penyewa?
// if($_SESSION['role'] != 'penyewa'){ header("location:../login.php"); }

// Ambil ID User dari session (Pastikan login.php sudah set $_SESSION['id_user'])
// Kalau belum ada login, kita set dummy id dulu biar errornya ilang saat testing
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 0; 
$nama_user = isset($_SESSION['nama']) ? $_SESSION['nama'] : "Penyewa";

// --- LOGIKA QUERY DATA KHUSUS PENYEWA ---

// 1. Cek Pesanan Terakhir User Ini
$query_sewa = mysqli_query($koneksi, "
    SELECT p.*, k.nama_kamar, k.harga, k.gambar 
    FROM pengajuan_sewa p
    JOIN data_kamar k ON p.id_kamar = k.id_kamar
    WHERE p.id_user = '$id_user'
    ORDER BY p.tanggal_pengajuan DESC LIMIT 1
");

$data_sewa = mysqli_fetch_assoc($query_sewa);
$cek_ada_pesanan = mysqli_num_rows($query_sewa);

// Default Values kalau belum pernah pesan
$status_sewa = "Belum Ada";
$nama_kamar = "-";
$harga_kamar = 0;
$warna_status = "secondary";
$pesan_status = "Kamu belum memesan kamar apapun.";

if($cek_ada_pesanan > 0) {
    $status_sewa = $data_sewa['status'];
    $nama_kamar = $data_sewa['nama_kamar'];
    $harga_kamar = $data_sewa['harga'];

    // Atur Warna & Pesan berdasarkan Status
    if($status_sewa == 'Lunas') {
        $warna_status = "success"; // Hijau
        $pesan_status = "Selamat! Pesanan kamu sudah dikonfirmasi. Silakan tempati kamar.";
    } elseif ($status_sewa == 'Pending') {
        $warna_status = "warning"; // Kuning
        $pesan_status = "Pesanan sedang diperiksa pemilik kost. Mohon tunggu konfirmasi.";
    } elseif ($status_sewa == 'Ditolak') {
        $warna_status = "danger"; // Merah
        $pesan_status = "Maaf, pengajuan sewa kamu ditolak. Silakan cari kamar lain.";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Area Penyewa</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Halo, <?php echo $nama_user; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Penyewa</h1>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4 border-left-<?php echo $warna_status; ?>">
                                <div class="card-body">
                                    <h4 class="font-weight-bold text-<?php echo $warna_status; ?>">
                                        Status Pesanan: <?php echo $status_sewa; ?>
                                    </h4>
                                    <p class="mb-0"><?php echo $pesan_status; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if($cek_ada_pesanan > 0) { ?>
                    <div class="row">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Kamar Pilihan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $nama_kamar; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bed fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Biaya Sewa (Per Bulan)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                Rp <?php echo number_format($harga_kamar,0,',','.'); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-tag fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Tanggal Pengajuan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo date('d M Y', strtotime($data_sewa['tanggal_pengajuan'])); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                        <div class="text-center mt-5">
                            <img src="img/undraw_posting_photo.svg" alt="Empty" style="width: 200px;" class="mb-4">
                            <h5>Kamu belum menyewa kamar nih!</h5>
                            <a href="../index.php" class="btn btn-primary mt-3">Cari Kamar Sekarang</a>
                        </div>
                    <?php } ?>



                    <!-- logout modal -->
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
                     <!-- logout modal -->

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

</body>
</html>
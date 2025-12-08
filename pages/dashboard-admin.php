<?php
session_start();
include '../proses/koneksi.php';

// --- LOGIKA QUERY DATA (OTOMATIS) ---

// 1. HITUNG TOTAL KAMAR
$q_total = mysqli_query($koneksi, "SELECT * FROM data_kamar");
$total_kamar = mysqli_num_rows($q_total);

// 2. HITUNG KAMAR TERSEDIA
// (Mencari yang statusnya 'Tersedia' atau 'sedia' karena di databasemu ada typo dikit hehe)
$q_sisa = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE ketersediaan LIKE '%sedia%'");
$sisa_kamar = mysqli_num_rows($q_sisa);

// 3. HITUNG JUMLAH PENYEWA (USER)
$q_user = mysqli_query($koneksi, "SELECT * FROM login_user WHERE role='penyewa'");
$total_penyewa = mysqli_num_rows($q_user);

// 4. HITUNG PENDAPATAN (LOGIKA JOIN)
// Kita jumlahkan harga kamar DARI transaksi yang statusnya 'Lunas'
$q_duit = mysqli_query($koneksi, "
    SELECT SUM(data_kamar.harga) as total_omset 
    FROM pengajuan_sewa 
    JOIN data_kamar ON pengajuan_sewa.id_kamar = data_kamar.id_kamar 
    WHERE pengajuan_sewa.status = 'Lunas'
");
$data_duit = mysqli_fetch_assoc($q_duit);
$pendapatan = $data_duit['total_omset'];

// Kalau pendapatan masih kosong (NULL), anggap 0
if($pendapatan == null) { $pendapatan = 0; }

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Admin BintangKost</title>

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Overview</h1>
                    </div>

                    <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Kamar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $total_kamar; ?> Unit
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-door-closed fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Kamar Kosong</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $sisa_kamar; ?> Unit
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Akun Penyewa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $total_penyewa; ?> User
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Pendapatan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                Rp <?php echo number_format($pendapatan,0,',','.'); ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Riwayat Pengajuan Sewa (Terbaru)</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tgl Pengajuan</th>
                                            <th>Nama Penyewa</th>
                                            <th>Kamar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // Gabungkan tabel pengajuan_sewa dengan data_kamar
                                        $query = mysqli_query($koneksi, "
                                            SELECT p.tanggal_pengajuan, p.nama_lengkap, k.nama_kamar, p.status 
                                            FROM pengajuan_sewa p
                                            JOIN data_kamar k ON p.id_kamar = k.id_kamar
                                            ORDER BY p.tanggal_pengajuan DESC LIMIT 5
                                        ");
                                        
                                        while($row = mysqli_fetch_array($query)){
                                            // Warna label status
                                            $warna = "secondary";
                                            if($row['status'] == 'Lunas') { $warna = 'success'; }
                                            elseif($row['status'] == 'Ditolak') { $warna = 'danger'; }
                                            elseif($row['status'] == 'Pending') { $warna = 'warning'; }
                                        ?>
                                        <tr>
                                            <td><?php echo date('d-m-Y H:i', strtotime($row['tanggal_pengajuan'])); ?></td>
                                            <td><?php echo $row['nama_lengkap']; ?></td>
                                            <td><?php echo $row['nama_kamar']; ?></td>
                                            <td>
                                                <span class="badge badge-<?php echo $warna; ?>">
                                                    <?php echo $row['status']; ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
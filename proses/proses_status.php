<?php
// Contoh isi proses_status.php
include 'koneksi.php';

$id = $_GET['id'];
$aksi = $_GET['aksi'];

if($aksi == 'terima'){
    // Ubah status jadi 'Disetujui'
    mysqli_query($koneksi, "UPDATE pengajuan_sewa SET status='Disetujui' WHERE id_sewa='$id'");
} elseif($aksi == 'tolak'){
    // Ubah status jadi 'Ditolak'
    mysqli_query($koneksi, "UPDATE pengajuan_sewa SET status='Ditolak' WHERE id_sewa='$id'");
} elseif($aksi == 'lunas'){
    // Ubah status jadi 'Lunas' dan kurangi stok kamar jika perlu
    mysqli_query($koneksi, "UPDATE pengajuan_sewa SET status='Lunas' WHERE id_sewa='$id'");
}

header("location:../pages/data_pesanan.php");
?>
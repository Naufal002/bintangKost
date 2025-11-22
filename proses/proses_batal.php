<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus permanen dari database
    $query = "DELETE FROM pengajuan_sewa WHERE id_sewa = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: ../pages/pesanan.php?pesan=dihapus");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
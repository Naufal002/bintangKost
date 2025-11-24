<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 1. AMBIL DATA GAMBAR DULU (Sebelum dihapus datanya)
    // Kita perlu tau nama filenya biar bisa dihapus dari folder
    $query_cek = mysqli_query($koneksi, "SELECT gambar FROM data_kamar WHERE id_kamar = '$id'");
    $data = mysqli_fetch_assoc($query_cek);
    $nama_gambar = $data['gambar'];

    // 2. HAPUS FILE FISIK DI FOLDER IMAGES
    $lokasi_file = "../images/" . $nama_gambar;
    if (file_exists($lokasi_file)) {
        unlink($lokasi_file); // Fungsi sakti buat ngehapus file
    }

    // 3. BARU HAPUS DATA DI DATABASE
    $query_hapus = mysqli_query($koneksi, "DELETE FROM data_kamar WHERE id_kamar = '$id'");

    if ($query_hapus) {
        echo "<script>
                alert('Data kamar dan fotonya berhasil dihapus!');
                window.location = '../pages/data_kamar.php';
              </script>";
    } else {
        echo "Gagal menghapus database: " . mysqli_error($koneksi);
    }

} else {
    // Kalo ga ada ID, balikin
    header("Location: ../pages/data_kamar.php");
}
?>
<?php
include 'koneksi.php';

// Ambil data dari form
$id_kamar   = $_POST['id_kamar'];
$nama_kamar = $_POST['nama_kamar'];
$kategori   = $_POST['kategori'];
$deskripsi  = $_POST['deskripsi'];
$fasilitas  = $_POST['fasilitas'];
$harga      = $_POST['harga'];
$ketersediaan = $_POST['ketersediaan'];
$foto_lama  = $_POST['foto_lama'];

// Cek apakah user pilih gambar baru atau tidak
if ($_FILES['gambar']['error'] === 4) {
    // Kalo gak upload gambar baru, pake gambar lama
    $gambar = $foto_lama;
} else {
    // Kalo upload gambar baru
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file  = $_FILES['gambar']['tmp_name'];
    
    // Rename biar unik
    $gambar = rand(1,999) . '-' . $nama_file;
    
    // Pindahin file ke folder images
    move_uploaded_file($tmp_file, '../images/' . $gambar);
}

// Update Database
$query = "UPDATE data_kamar SET 
            nama_kamar = '$nama_kamar',
            kategori = '$kategori',
            deskripsi = '$deskripsi',
            fasilitas = '$fasilitas',
            harga = '$harga',
            ketersediaan = '$ketersediaan',
            gambar = '$gambar'
          WHERE id_kamar = '$id_kamar'";

$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>
            alert('Data kamar berhasil diupdate!');
            window.location = '../pages/data_kamar.php';
          </script>";
} else {
    echo "Gagal update: " . mysqli_error($koneksi);
}
?>
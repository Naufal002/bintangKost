<?php
session_start();
include 'koneksi.php';

// 1. Cek Login Dulu
if (!isset($_SESSION['status_login'])) {
    echo "<script>alert('Anda harus login dulu!'); window.location='../pages/login.php';</script>";
    exit;
}

// 2. Tangkap Data dari Form Modal
$id_user      = $_POST['id_user'];
$id_kamar     = $_POST['id_kamar'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat       = $_POST['alamat_ktp'];

// 3. Proses Upload Foto KTP
$foto_nama    = $_FILES['foto_ktp']['name'];
$foto_tmp     = $_FILES['foto_ktp']['tmp_name'];
$folder_tujuan = "../images/ktp/"; // Pastikan folder ini ADA!

// Cek apakah user beneran upload foto
if($foto_nama != "") {
    // Bikin nama file unik biar gak bentrok (misal: 123_foto.jpg)
    $nama_file_baru = rand(1,999) . "_" . $foto_nama;
    
    // Pindahkan foto dari folder sementara ke folder tujuan
    move_uploaded_file($foto_tmp, $folder_tujuan . $nama_file_baru);

    // 4. Masukkan ke Database
    $query = "INSERT INTO pengajuan_sewa (id_user, id_kamar, nama_lengkap, alamat_ktp, foto_ktp, status) 
              VALUES ('$id_user', '$id_kamar', '$nama_lengkap', '$alamat', '$nama_file_baru', 'Menunggu Konfirmasi')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Pengajuan berhasil! Tunggu konfirmasi pemilik.'); window.location='../pages/index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

} else {
    echo "<script>alert('Harap upload foto KTP!'); window.history.back();</script>";
}
?>
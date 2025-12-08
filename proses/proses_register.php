<?php
include 'koneksi.php';

// Tangkap data dari form register
$email    = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$nama     = $_POST['nama'];
$no_telp  = $_POST['no_telp'];
$role     = "penyewa"; // Default role user baru adalah penyewa

// Cek apakah username sudah ada?
$cek_user = mysqli_query($koneksi, "SELECT * FROM login_user WHERE username='$username'");

if(mysqli_num_rows($cek_user) > 0){
    // Kalau username sudah dipakai, kembalikan dengan pesan error
    echo "<script>alert('Username sudah terdaftar! Silakan pakai username lain.'); window.location='../pages/index.php';</script>";
} else {
    // Kalau aman, masukkan ke database
    $query = "INSERT INTO login_user (email, username, password, nama, no_telp, role) 
              VALUES ('$email', '$username', '$password', '$nama', '$no_telp', '$role')";
    
    if(mysqli_query($koneksi, $query)){
        echo "<script>alert('Pendaftaran Berhasil! Silakan Login.'); window.location='../pages/index.php';</script>";
    } else {
        echo "<script>alert('Pendaftaran Gagal!'); window.location='../pages/index.php';</script>";
    }
}
?>
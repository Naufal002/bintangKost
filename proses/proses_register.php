<?php
include 'koneksi.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$nama = $_POST['nama']; // Tambahkan ini
$no_telp = $_POST['no_telp']; 
$role = "penyewa";

// Cek username unik
$cek = mysqli_query($koneksi, "SELECT * FROM login_user WHERE username='$username'");
if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username sudah digunakan!'); window.location='../pages/index.php';</script>";
    exit();
}

// Simpan ke database
$query = "INSERT INTO login_user (email, username, password, nama, no_telp, role)
        VALUES ('$email', '$username', '$password', '$nama', '$no_telp', '$role')";
if (!mysqli_query($koneksi, $query)) {
    die("Query gagal: " . mysqli_error($koneksi));
}

echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='../pages/index.php';</script>";
?>

<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// ambil data user dari tabel
$query = "SELECT * FROM login_user WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // simpan ke session (opsional)
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama'];

    // arahkan berdasarkan username
    if ($data['username'] == 'pemilik') {
        header("Location: ../dashboard-pemilik.html");
        exit();
    } elseif ($data['username'] == 'penyewa') {
        header("Location: ../dashboard-penyewa.html");
        exit();
    } elseif ($data['username'] == 'admin') {
        header("Location: ../dashboard-admin.html");
        exit();
    } else { 
        echo "<script>alert('Role tidak dikenali'); window.location='../index.html';</script>";
    }
} else {
    echo "<script>alert('Username atau Password salah!'); window.location='../index.html';</script>";
}
?>

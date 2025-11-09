<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Cek apakah username dan password ada di database
$query = "SELECT * FROM login_user WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // Simpan session biar bisa dipakai di halaman lain
    session_start();
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    // Cek role untuk redirect ke halaman yang sesuai
    if ($data['role'] == 'admin') {
        header("Location: ../pages/dashboard-admin.html");
    } elseif ($data['role'] == 'pemilik') {
        header("Location: ../pages/dashboard-pemilik.html");
    } elseif ($data['role'] == 'penyewa') {
        header("Location: ../pages/dashboard-penyewa.html");
    } else {
        echo "<script>alert('Role tidak dikenali!'); window.location='../pages/index.html';</script>";
    }
} else {
    echo "<script>alert('Username atau password salah!'); window.location='../pages/index.html';</script>";
}
?>

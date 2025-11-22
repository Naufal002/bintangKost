<?php
// 1. PINDAHKAN KE BARIS 1, WAJIB!
session_start(); 

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// (Ini masih plain text & bahaya, tapi oke... demi deadline)
$query = "SELECT * FROM login_user WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);

    // 2. TAMBAHKAN INI! Ini "stempel" yang kamu cek di navbar
    $_SESSION['status_login'] = true; 
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    $_SESSION['user_id'] = $data['id_user'];

    // Cek role untuk redirect
    if ($data['role'] == 'admin') {
        header("Location: ../pages/dashboard-admin.html");
        exit; // 3. SELALU tambahkan 'exit;' setelah header
    } elseif ($data['role'] == 'pemilik') {
        header("Location: ../pages/dashboard-pemilik.html");
        exit; // 3. SELALU tambahkan 'exit;' setelah header
    } elseif ($data['role'] == 'penyewa') {
        header("Location: ../pages/index.php");
        exit; // 3. SELALU tambahkan 'exit;' setelah header
    } else {
        echo "<script>alert('Role tidak dikenali!'); window.location='../pages/index.html';</script>";
    }
} else {
    echo "<script>alert('Username atau password salah!'); window.location='../pages/index.html';</script>";
}
?>
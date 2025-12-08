<?php
session_start();
include 'koneksi.php';

// Tangkap data dari form modal
$email    = $_POST['email']; // Di form kamu ada input email
$username = $_POST['username']; // Dan ada input username juga
$password = $_POST['password'];

// Cek data di database (Mencocokkan username DAN password)
// Note: Di form loginmu ada input email & username. 
// Biasanya login cukup salah satu, tapi karena di form ada dua-duanya, kita cek username saja yang lebih unik.
$login = mysqli_query($koneksi, "SELECT * FROM login_user WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
    $data = mysqli_fetch_assoc($login);

    // Buat Session Login
    $_SESSION['username'] = $username;
    $_SESSION['nama']     = $data['nama'];
    $_SESSION['role']     = $data['role'];
    $_SESSION['id_user']  = $data['id_user']; // PENTING: ID User buat dashboard penyewa
    $_SESSION['status_login'] = true;

    // Cek Role (Level User) dan Lempar ke Halaman yang Sesuai
    if($data['role'] == "admin"){
        // Redirect ke Dashboard Admin
        header("location:../pages/dashboard-admin.php");

    } else if($data['role'] == "pemilik"){
        // Redirect ke Dashboard Pemilik
        header("location:../pages/dashboard-pemilik.php");

    } else if($data['role'] == "penyewa"){
        // Redirect Balik ke Halaman Utama (Landing Page)
        // Karena file index.php ada di folder 'user' atau root, sesuaikan path-nya
        // Asumsi file index.php ada di folder 'user'
        header("location:../pages/index.php"); 
    } else {
        // Role tidak dikenali
        header("location:../pages/index.php?pesan=gagal_login");
    }

} else {
    // Kalau Username/Password Salah
    header("location:../pages/index.php?pesan=gagal_login");
}
?>
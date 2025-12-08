<?php
session_start();
include 'koneksi.php';

// Cek login dulu (Jaga-jaga)
// GANTI 'user_id' JADI 'id_user' (Sesuai proses_login.php)
if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Sesi habis, silakan login lagi.'); window.location='../pages/login.php';</script>";
    exit;
}

if (isset($_POST['judul_laporan'])) {

    // GANTI 'user_id' JADI 'id_user' DI SINI JUGA
    $id_user   = $_SESSION['id_user']; 
    $judul     = $_POST['judul_laporan'];
    $deskripsi = $_POST['deskripsi'];

    // --- PROSES UPLOAD FOTO ---
    $foto_nama = $_FILES['bukti']['name'];
    $foto_tmp  = $_FILES['bukti']['tmp_name'];
    $folder    = "../images/keluhan/";

    $nama_baru = rand(1,999) . '_' . $foto_nama;

    if (move_uploaded_file($foto_tmp, $folder . $nama_baru)) {
        
        // --- SIMPAN KE DATABASE ---
        $query = "INSERT INTO keluhan (id_user, judul_laporan, deskripsi, bukti) 
                  VALUES ('$id_user', '$judul', '$deskripsi', '$nama_baru')";

        if (mysqli_query($koneksi, $query)) {
            echo "<script>
                    alert('Keluhan terkirim! Admin akan segera mengecek, terima kasih karena telah melapor. laporan anda akan kami tangani secepatnya.');
                    window.location = '../pages/keluhan.php'; 
                  </script>";
        } else {
            echo "Gagal database: " . mysqli_error($koneksi);
        }

    } else {
        echo "<script>alert('Gagal upload gambar!'); window.history.back();</script>";
    }

} else {
    header("Location: ../pages/keluhan.php");
}
?>
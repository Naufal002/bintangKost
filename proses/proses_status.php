<?php
session_start();
include 'koneksi.php';

// 1. Cek apakah parameter ID dan AKSI ada di URL?
if (isset($_GET['id']) && isset($_GET['aksi'])) {
    
    $id_sewa = $_GET['id'];
    $aksi = $_GET['aksi'];
    $status_baru = "";

    // 2. Tentukan Status Baru Berdasarkan Tombol yang Diklik
    if ($aksi == 'terima') {
        $status_baru = "Disetujui"; // Admin ACC pesanan awal
    } elseif ($aksi == 'tolak') {
        $status_baru = "Ditolak";   // Admin menolak pesanan
    } elseif ($aksi == 'lunas') {
        $status_baru = "Lunas";     // Admin konfirmasi pembayaran (INI YANG BARU)
    }

    // 3. Eksekusi Update ke Database
    if ($status_baru != "") {
        
        $query = "UPDATE pengajuan_sewa SET status = '$status_baru' WHERE id_sewa = '$id_sewa'";
        
        if (mysqli_query($koneksi, $query)) {
            // Jika Berhasil
            echo "<script>
                    alert('Status berhasil diperbarui menjadi: $status_baru');
                    window.location = '../pages/data_pesanan.php'; 
                  </script>";
        } else {
            // Jika Gagal
            echo "Error updating record: " . mysqli_error($koneksi);
        }
    } else {
        // Kalau aksi tidak dikenali
        header("Location: ../pages/data_pesanan.php");
    }

} else {
    // Kalau orang iseng buka file ini tanpa parameter
    header("Location: ../pages/data_pesanan.php");
}
?>
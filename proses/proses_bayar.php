<?php
session_start();
include 'koneksi.php';

// Cek apakah ada file yang diupload
if (isset($_POST['id_sewa']) && isset($_FILES['bukti_bayar'])) {
    
    $id_sewa = $_POST['id_sewa'];
    
    // Proses Upload
    $foto_nama = $_FILES['bukti_bayar']['name'];
    $foto_tmp  = $_FILES['bukti_bayar']['tmp_name'];
    $folder_tujuan = "../images/bukti/"; // Pastikan folder ini ada!
    
    // Bikin nama unik
    $nama_file_baru = "BUKTI-" . rand(1,9999) . "-" . $foto_nama;
    
    if (move_uploaded_file($foto_tmp, $folder_tujuan . $nama_file_baru)) {
        
        // Update Database: Simpan nama file & Ganti Status
        $query = "UPDATE pengajuan_sewa SET 
                    bukti_bayar = '$nama_file_baru', 
                    status = 'Menunggu Verifikasi' 
                  WHERE id_sewa = '$id_sewa'";
                  
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Bukti berhasil dikirim! Tunggu admin mengecek.'); window.location='../pages/pesanan.php';</script>";
        } else {
            echo "Database Error: " . mysqli_error($koneksi);
        }
        
    } else {
        echo "<script>alert('Gagal upload gambar!'); window.history.back();</script>";
    }
}
?>
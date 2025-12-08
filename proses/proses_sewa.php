<?php
session_start();
include 'koneksi.php';

// 1. CEK LOGIN
// Kalau user belum login (session id_user kosong), tendang ke halaman login
if (!isset($_SESSION['id_user'])) {
    echo "<script>
            alert('Silakan Login terlebih dahulu untuk menyewa kamar!');
            window.location = '../user/index.php'; 
          </script>";
    exit;
}

// 2. TANGKAP DATA DARI FORM
$id_kamar     = $_POST['id_kamar'];
$id_user      = $_SESSION['id_user']; // Ambil dari session biar aman (bukan dari input hidden)
$nama_lengkap = $_POST['nama_lengkap'];
$alamat_ktp   = $_POST['alamat_ktp'];
$status_awal  = "Pending"; // Status default saat baru daftar

// 3. PROSES UPLOAD FOTO KTP
$rand = rand();
$allowed =  array('png','jpg','jpeg');
$filename = $_FILES['foto_ktp']['name'];
$ukuran = $_FILES['foto_ktp']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

// Cek Ekstensi File
if(!in_array($ext, $allowed) ) {
    echo "<script>alert('Format foto KTP harus JPG atau PNG!'); window.history.back();</script>";
    exit;
}

// Cek Ukuran File (Max 2MB = 2048 * 1024)
if($ukuran < 2097152){		
    
    // Buat nama file unik (AngkaAcak_NamaFileAsli)
    $nama_file_baru = $rand.'_'.$filename;
    
    // Pindahkan file ke folder tujuan
    // Pastikan kamu sudah buat folder 'ktp' di dalam folder 'images'
    $upload_dir = '../images/ktp/';
    
    // Cek folder, kalau belum ada buat dulu (opsional, tapi bagus buat error handling)
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if(move_uploaded_file($_FILES['foto_ktp']['tmp_name'], $upload_dir.$nama_file_baru)){
        
        // 4. QUERY INSERT KE DATABASE
        // Kolom 'bukti_bayar' diisi NULL dulu karena belum bayar
        $query = "INSERT INTO pengajuan_sewa (id_user, id_kamar, nama_lengkap, alamat_ktp, foto_ktp, tanggal_pengajuan, status, bukti_bayar) 
                  VALUES ('$id_user', '$id_kamar', '$nama_lengkap', '$alamat_ktp', '$nama_file_baru', NOW(), '$status_awal', NULL)";
        
        $result = mysqli_query($koneksi, $query);

        if($result){
            // BERHASIL: Arahkan ke halaman Riwayat Pesanan
            echo "<script>
                    alert('Pengajuan sewa berhasil dikirim! Tunggu konfirmasi pemilik. untuk melihat status konfrmasinya, silakan cek di halaman Riwayat Pesanan.');
                    window.location = '../pages/pesanan.php'; 
                  </script>";
        } else {
            echo "<script>alert('Gagal menyimpan data ke database!'); window.history.back();</script>";
        }

    } else {
        echo "<script>alert('Gagal mengupload foto KTP!'); window.history.back();</script>";
    }

} else {
    echo "<script>alert('Ukuran foto KTP terlalu besar! Maksimal 2MB.'); window.history.back();</script>";
}
?>
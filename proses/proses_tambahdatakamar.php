<?php
session_start();

// CEK KEAMANAN (Sama seperti di form)
if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'admin') {
    // Tampilkan pesan error dan stop proses
    die("AKSES DITOLAK: Kamu tidak memiliki izin untuk menambah data!");
}

include 'koneksi.php';

// Menangkap data yang dikirim dari form
$nama_kamar   = $_POST['nama_kamar'];
$kategori     = $_POST['kategori'];
$deskripsi    = $_POST['deskripsi'];
$fasilitas    = $_POST['fasilitas'];
$harga        = $_POST['harga'];
$ketersediaan = $_POST['ketersediaan'];

// --- PROSES UPLOAD GAMBAR ---

// Ambil data file gambar
$rand = rand(); // Membuat angka acak biar nama file gak bentrok
$ekstensi =  array('png','jpg','jpeg','gif'); // Format yang dibolehkan
$filename = $_FILES['gambar']['name']; // Nama file asli
$ukuran   = $_FILES['gambar']['size']; // Ukuran file
$ext      = pathinfo($filename, PATHINFO_EXTENSION); // Ambil ekstensinya

// Cek apakah ekstensi file sesuai?
if(!in_array($ext,$ekstensi) ) {
    echo "<script>alert('Format file tidak diperbolehkan! Harus PNG, JPG, atau JPEG.'); window.location='../admin/tambah_kamar.php';</script>";
} else {
    // Jika ukuran kurang dari 5MB (contoh validasi size)
    if($ukuran < 5044070){		
        
        // Nama file baru (AngkaAcak_NamaAsli.jpg)
        $xx = $rand.'_'.$filename;
        
        // Pindahkan file fisik ke folder tujuan
        // Pastikan folder ini ADA
        move_uploaded_file($_FILES['gambar']['tmp_name'], '../images/upload/'.$xx);

        // Simpan data ke Database
        // Kolom gambar diisi nama file baru ($xx)
        $query = mysqli_query($koneksi, "INSERT INTO data_kamar VALUES (
            NULL, 
            '$nama_kamar', 
            '$kategori', 
            '$deskripsi', 
            '$fasilitas', 
            '$harga', 
            '$xx', 
            '$ketersediaan'
        )");

        if($query){
            echo "<script>alert('Berhasil menambahkan kamar baru!'); window.location='../pages/data_kamar.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan ke database!'); window.location='../pages/tambahdata_kamar.php';</script>";
        }

    } else {
        echo "<script>alert('Ukuran file terlalu besar! Maksimal 5MB.'); window.location='../pages/tambahdata_kamar.php';</script>";
    }
}
?>
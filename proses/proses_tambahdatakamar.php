<?php
include "koneksi.php";

$nama_kamar = $_POST['nama_kamar'];
$kategori = $_POST['kategori'];
$deskripsi = $_POST['deskripsi'];
$fasilitas = $_POST['fasilitas'];
$harga = $_POST['harga'];
$gambar = $_POST['gambar'];
$ketersediaan = $_POST['ketersediaan'];

$input = mysqli_query($koneksi, "insert into data_kamar set nama_kamar='$nama_kamar',
														kategori='$kategori',
														deskripsi='$deskripsi',
														fasilitas='$fasilitas',
														harga='$harga',
														gambar='$gambar',
                                                        ketersediaan='$ketersediaan'");

if ($input) {
	header("location:../pages/data_kamar.php");
}else{
	header("location:blank.php");
}

?>

<?php
session_start();
include '../proses/koneksi.php'; // Pastikan path koneksi benar

// 1. Cek ID di URL
if (!isset($_GET['id'])) {
    header("Location: data_kamar.php");
    exit;
}
$id = $_GET['id'];

// 2. Ambil data dari database
$query = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE id_kamar = '$id'");
$data = mysqli_fetch_assoc($query);

// Cek kalo data gak ada
if (!$data) {
    die("Data kamar tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kamar | Admin</title> 
    <link rel="stylesheet" href="css/tambah_datakamar.css">
   </head>
<body>
  <div class="wrapper">
    <h2>Edit Data Kamar</h2>
    
    <form action="../proses/proses_edit_kamar.php" method="POST" enctype="multipart/form-data">
      
      <input type="hidden" name="id_kamar" value="<?php echo $data['id_kamar']; ?>">
      <input type="hidden" name="foto_lama" value="<?php echo $data['gambar']; ?>">

      <div class="input-box">
        <input type="text" placeholder="Nama kamar" name="nama_kamar" value="<?php echo $data['nama_kamar']; ?>" required>
      </div>

      <div class="input-box">
        <input type="text" placeholder="Kategori" name="kategori" value="<?php echo $data['kategori']; ?>" required>
      </div>

      <div class="input-box">
        <textarea placeholder="Deskripsi" name="deskripsi" required style="width:100%; padding:10px;"><?php echo $data['deskripsi']; ?></textarea>
      </div>

      <div class="input-box">
        <textarea placeholder="Fasilitas" name="fasilitas" required style="width:100%; padding:10px;"><?php echo $data['fasilitas']; ?></textarea>
      </div>

      <div class="input-box">
        <input type="number" placeholder="Harga" name="harga" value="<?php echo $data['harga']; ?>" required>
      </div>

      <div style="margin-bottom: 10px;">
        <p style="font-size: 14px; margin-bottom: 5px;">Gambar Saat Ini:</p>
        <img src="../images/<?php echo $data['gambar']; ?>" width="100" style="border-radius: 5px; border: 1px solid #ccc;">
      </div>

      <div class="input-box">
        <input type="file" name="gambar" style="padding-top: 10px;">
        <span style="font-size: 12px; color: #666;">*Biarkan kosong jika tidak ingin ganti foto</span>
      </div>

      <div class="input-box">
        <select name="ketersediaan" style="width: 100%; height: 100%; padding: 0 15px; outline: none; border: 1.5px solid #C7BEBE; border-radius: 5px; border-bottom-width: 2px; font-size: 17px;">
            <option value="Tersedia" <?php if($data['ketersediaan'] == 'Tersedia') echo 'selected'; ?>>Tersedia</option>
            <option value="Penuh" <?php if($data['ketersediaan'] == 'Penuh') echo 'selected'; ?>>Penuh</option>
        </select>
      </div>

      <div class="input-box button">
        <input type="submit" value="Simpan Perubahan">
      </div>
      
      <div class="input-box button" style="margin-top: 10px;">
         <a href="data_kamar.php" style="text-decoration: none; display: block; text-align: center; line-height: 50px; background: #555; color: #fff; border-radius: 5px;">Batal</a>
      </div>

    </form>
  </div>
</body>
</html>
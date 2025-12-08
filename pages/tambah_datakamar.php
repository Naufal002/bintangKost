
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kamar - Admin</title> 
    <link rel="stylesheet" href="css/tambah_datakamar.css">
</head>
<body>
  <div class="wrapper">
    <h2>Tambah Data Kamar</h2>
    
    <form action="../proses/proses_tambahdatakamar.php" method="POST" enctype="multipart/form-data">
      
      <div class="input-box">
        <input type="text" placeholder="Nama Kamar (Cth: Kamar Melati 01)" name="nama_kamar" required>
      </div>
      
      <div class="input-box">
        <input type="text" placeholder="Kategori/Rentang Harga (Cth: 500k - 700k)" name="kategori" required>
      </div>
      
      <div class="input-box">
        <textarea placeholder="Deskripsi Singkat" name="deskripsi" required style="width:100%; padding:10px; margin-top:10px;"></textarea>
      </div>
      
      <div class="input-box">
        <textarea placeholder="Fasilitas (Cth: Kasur, Lemari, WiFi)" name="fasilitas" required style="width:100%; padding:10px; margin-top:10px;"></textarea>
      </div>
      
      <div class="input-box">
        <input type="number" placeholder="Harga Sewa (Angka saja, cth: 500000)" name="harga" required>
      </div>
      
      <div class="input-box" style="margin-top: 10px;">
        <label style="color: #666; font-size: 14px;">Upload Foto Kamar:</label>
        <input type="file" name="gambar" accept=".jpg, .jpeg, .png" required>
      </div>

      <div class="input-box" style="margin-top: 10px;">
        <select name="ketersediaan" required style="width: 100%; height: 50px; padding: 0 15px; border-radius: 5px; border: 1px solid #ccc;">
            <option value="" disabled selected>Pilih Status Ketersediaan</option>
            <option value="Tersedia">Tersedia</option>
            <option value="Penuh">Penuh</option>
        </select>
      </div>

      <div class="input-box button">
        <input type="Submit" value="Simpan Data Kamar">
      </div>
      
      <div class="text" style="text-align: center; margin-top: 20px;">
        <a href="data_kamar.php" style="color: #333; text-decoration: none;">Batal & Kembali</a>
      </div>

    </form>
  </div>
</body>
</html>
<!doctype html>

<?php
session_start(); // <--- INI YANG HILANG! WAJIB ADA.
?>

<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Kost Singgahsini Muhajar 50 — Tipe B | Kebon Jeruk</title>

  <!-- Swiper CSS -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/datail_kamar.css">
</head>
<body>
<div class="container">


  <header>
    <div class="logo">Kost Listing</div>
    <nav><a href="#">Home</a> / <a href="#">Kost</a> / <b>Singgahsini Muhajar 50</b></nav>
  </header>

  <?php
include '../proses/koneksi.php';

// 1. CEK apakah ada parameter id
if (!isset($_GET['id'])) {
    echo "Kamar tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

// 2. AMBIL DATA KAMAR BERDASARKAN ID
$query = mysqli_query($koneksi, "SELECT * FROM data_kamar WHERE id_kamar = '$id'");
$kamar = mysqli_fetch_assoc($query);

// 3. CEK DATA KETEMU ATAU NGGA
if (!$kamar) {
    echo "Data kamar tidak ditemukan!";
    exit;
}
?>


  <div class="grid">
    <main>
      <div class="card">
         <img src="../images/upload/<?php echo $kamar['gambar']; ?>" 
             style="width:100%; height:auto;" 
             alt="<?php echo $kamar['nama_kamar']; ?>">
             
        <div class="info">
          <h1><?php echo $kamar['nama_kamar']; ?></h1>
          <div class="meta">kategori kamar <?php echo $kamar['kategori']; ?></div>

          <div class="section">
            <h3>Fasilitas</h3>
            <div class="facilities">
              <div class="chip">AC</div>
              <div class="chip">Kamar mandi dalam</div>
              <div class="chip">Wi-Fi</div>
              <div class="chip">Laundry</div>
              <div class="chip">Dapur bersama</div>
            </div>
          </div>

          <div class="section description">
            <h3>Deskripsi Kamar</h3>
            <p><?php echo $kamar['deskripsi']; ?></p>
          </div>

          <div class="section rating">
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star">★</span>
            <span class="star" style="color:#d1d5db;">★</span>
            <span>4.0 / 5 dari 23 ulasan</span>
          </div>
        </div>
      </div>
    </main>

    <aside class="sidebar">
      <div class="priceBox">
        <div style="font-size:13px;color:var(--accent);font-weight:600">Diskon 10%</div>
        <div class="price">
          Rp <?php echo number_format($kamar['harga']); ?>
          <span class="small">/bulan</span>
        </div>

        <a href="https://wa.me/6285602494352" class="btn outline">Tanya Pemilik</a>
        <button type="button" class="btn green" data-bs-toggle="modal" data-bs-target="#modalSewa">
      Ajukan Sewa
        </button>

      </div>
    </aside>
  </div>

  <!-- 🟩 Bagian Rekomendasi Kamar -->
  <section class="rekomendasi">
    <h2>Rekomendasi Kamar Lainnya</h2>
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="rekom-card">
            <img src="../images/item15.png" alt="Kamar Ramah Kantong">
            <div class="rekom-body">
              <h4>Kamar Ramah Kantong</h4>
              <p>Nyaman dengan kamar mandi dalam</p>
              <small>Rp 1.000.000 /bulan</small>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="rekom-card">
            <img src="../images/item16.png" alt="Kamar Premium">
            <div class="rekom-body">
              <h4>Kamar Premium</h4>
              <p>Full furnished + Wi-Fi cepat</p>
              <small>Rp 2.000.000 /bulan</small>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="rekom-card">
            <img src="../images/item17.png" alt="Kamar Minimalis">
            <div class="rekom-body">
              <h4>Kamar Minimalis</h4>
              <p>Desain modern, lokasi strategis</p>
              <small>Rp 1.700.000 /bulan</small>
            </div>
          </div>
        </div>
      </div>

      <!-- tombol navigasi -->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
    </div>
  </section>
</div>



<div class="modal fade" id="modalSewa" tabindex="-1" aria-labelledby="labelModalSewa" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content text-dark" >
      
      <div class="modal-header">
        <h5 class="modal-title" id="labelModalSewa">Form Pengajuan Sewa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="../proses/proses_sewa.php" method="POST" enctype="multipart/form-data">
          
          <div class="modal-body">
            
            <input type="hidden" name="id_kamar" value="<?php echo $kamar['id_kamar']; ?>">
            
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['user_id'] ?? ''; ?>">

            <div class="mb-3">
                <label class="form-label">Nama Lengkap (Sesuai KTP)</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Asal</label>
                <textarea name="alamat_ktp" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto KTP</label>
                <input type="file" name="foto_ktp" class="form-control" accept=".jpg, .jpeg, .png" required>
                <small class="text-muted">Format: JPG/PNG, Maks 2MB</small>
            </div>

          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
          </div>

      </form>

    </div>
  </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper(".swiper", {
    slidesPerView: 3,
    spaceBetween: 20,
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    breakpoints: {
      0: { slidesPerView: 1 },
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>  
</html>


<!-- shdhakjshdkjadh -->
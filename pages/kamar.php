<!doctype html>
<html lang="en">

<?php
 session_start(); // WAJIB ada di paling atas file ini juga
?>


<?php
// (Pastikan session_start() sudah ada di baris 1 file ini)

// Kita siapkan variabel 'jembatan' untuk JavaScript
$userSudahLogin = false; // Defaultnya, anggap belum login
if (isset($_SESSION['status_login']) && $_SESSION['status_login'] === true) {
    $userSudahLogin = true;
}
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bintang Kost - Kos nya siimut</title>

  <link rel="stylesheet" type="text/css" href="css/vendor.css">

  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />


  <!-- Link Bootstrap's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <link rel="stylesheet" href="css/style.css">

  <!-- Google Fonts ================================================== -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">

  <!-- script ================================================== -->
  <script src="js/modernizr.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script>
        const isUserLoggedIn = <?php echo $userSudahLogin ? 'true' : 'false'; ?>;
    </script>
</head>



<body data-bs-spy="scroll" data-bs-target="#navbar-example2" tabindex="0">


  <!-- nav bar start  -->
  <header id="nav" class="site-header position-fixed text-white bg-dark">
    <nav id="navbar-example2" class="navbar navbar-expand-lg py-2">

      <div class="container ">

        <a class="navbar-brand" href="index.html"><img src="../images/logo.png" style="width: 150px;" alt="image"></a>


        <button class="navbar-toggler text-white" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation"><ion-icon
            name="menu-outline" style="font-size: 30px;"></ion-icon></button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
          aria-labelledby="offcanvasNavbar2Label">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbar2Label">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav align-items-center justify-content-end align-items-center flex-grow-1 ">
              <li class="nav-item">
                <a class="nav-link me-md-4" href="index.php">Home</a>
              </li>
              <a class="nav-link me-md-4 text-center dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
              aria-expanded="false">List kamar</a>
              <li class="nav-item dropdown ">
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a href="index.html" class="dropdown-item active">Semua kamar</a>
                  </li>
                  <li><a href="index.html" class="dropdown-item">350k - 400k</a>
                  </li>
                  <li><a href="index.html" class="dropdown-item">450k -500k <span
                        class="badge bg-secondary">super</span></a></li>
                  <li><a href="index.html" class="dropdown-item">550k - 600k <span
                        class="badge bg-secondary">super 2</span></a></li>
                  <li><a href="index.html" class="dropdown-item">650k - 700k<span
                        class="badge bg-secondary">super 3</span></a></li>
                  <li><a href="index.html" class="dropdown-item">750k - 800k <span
                        class="badge bg-secondary">super 4</span></a></li>
                  <li><a href="index.html" class="dropdown-item">850k - 1jt <span
                        class="badge bg-secondary">super 5</span></a></li>
                  <li><a href="index.html" class="dropdown-item">1jt - 3jt</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link me-md-4" href="#about-us">Tentang kami</a>
              </li>
              <li class="nav-item">
                <a class="nav-link me-md-4" href="#help">Contact</a>
              </li>
              <?php
            // Cek, apakah "stempel" status_login ada dan bernilai true?
              if (isset($_SESSION['status_login']) && $_SESSION['status_login'] === true):
              ?>

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Halo, <b> <?php echo $_SESSION['username']; ?> </b>
                  </a>
                      <ul class="dropdown-menu dropdown-menu-dark">
                          <li><a class="dropdown-item" href="dashboard_penyewa.php">Dashboard</a></li>
                          <li><a class="dropdown-item" href="pesanan.html">Riwayat Pesanan</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="../proses/logout.php">Logout</a></li>
                      </ul>
              </li>

              <?php else: ?>

              <li class="nav-item">
                  <a class="btn-medium btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Login or Register</a>
              </li>

              <?php endif; ?>
              
              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="tabs-listing mt-4">
                        <nav>
                          <div class="nav nav-tabs d-flex justify-content-center border-0" id="nav-tab" role="tablist">
                            <button class="btn btn-outline-primary text-uppercase me-3 active" id="nav-sign-in-tab"
                              data-bs-toggle="tab" data-bs-target="#nav-sign-in" type="button" role="tab"
                              aria-controls="nav-sign-in" aria-selected="true">Log In</button>
                            <button class="btn btn-outline-primary text-uppercase" id="nav-register-tab"
                              data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab"
                              aria-controls="nav-register" aria-selected="false">Sign Up</button>
                          </div>
                        </nav>



                  <!-- login session -->
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade active show" id="nav-sign-in" role="tabpanel"
                            aria-labelledby="nav-sign-in-tab">
                            <form action="../proses/proses_login.php" method="post" id="form1" class="form-group flex-wrap p-3 ">
                              <div class="form-input col-lg-12 my-4">
                                <label for="exampleInputEmail1"
                                  class="form-label fs-6 text-uppercase fw-bold text-black">Email addres</label>
                                <input type="email" id="exampleInputEmail1" name="email" placeholder="username"
                                  class="form-control ps-3">
                              </div>
                              <div class="form-input col-lg-12 my-4">
                                <label for="exampleInputEmail1"
                                  class="form-label fs-6 text-uppercase fw-bold text-black">Username</label>
                                <input type="text" id="exampleInputEmail1" name="username" placeholder="username"
                                  class="form-control ps-3">
                              </div>
                              <div class="form-input col-lg-12 my-4">
                                <label for="inputPassword1"
                                  class="form-label  fs-6 text-uppercase fw-bold text-black">Password</label>
                                <input type="password" name="password" id="inputPassword1" placeholder="Password"
                                  class="form-control ps-3" aria-describedby="passwordHelpBlock">
                                <div id="passwordHelpBlock" class="form-text text-center">
                                  <a href="#" class=" password">Forgot Password ?</a>
                                </div>

                              </div>
                              <label class="py-3">
                                <input type="checkbox" required="" class="d-inline">
                                <span class="label-body text-black">Remember Me</span>
                              </label>
                              <div class="d-grid my-3">
                                <button class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Log In</button>
                              </div>
                            </form>
                          </div>
                          <!-- login session -->





                    <!-- register session -->
                          <div class="tab-pane fade" id="nav-register" role="tabpanel"
                            aria-labelledby="nav-register-tab">
                            <form action="../proses/proses_register.php" method="post" class="form-group flex-wrap p-3 ">
                              <div class="form-input col-lg-12 my-4">
                                <label for="exampleInputEmail2"
                                  class="form-label fs-6 text-uppercase fw-bold text-black">Email
                                  Address</label>
                                <input type="text" id="exampleInputEmail2" name="email" placeholder="Email"
                                  class="form-control ps-3">
                              </div>

                              <div class="form-input col-lg-12 my-4">
                                <label for="exampleInputEmail1"
                                  class="form-label fs-6 text-uppercase fw-bold text-black">Username</label>
                                <input type="text" id="exampleInputEmail1" name="username" placeholder="username"
                                  class="form-control ps-3">
                              </div>

                              <div class="form-input col-lg-12 my-4">
                                <label for="inputPassword2"
                                  class="form-label  fs-6 text-uppercase fw-bold text-black">Password</label>
                                <input type="password" id="inputPassword2" placeholder="Password"
                                  class="form-control ps-3" name="password" aria-describedby="passwordHelpBlock">
                              </div>

                              <div class="form-input col-lg-12 my-4">
                                <label for="inputPassword2"
                                  class="form-label  fs-6 text-uppercase fw-bold text-black">nama</label>
                                <input type="text" id="inputPassword2" placeholder="Nama"
                                  class="form-control ps-3" name="nama" aria-describedby="passwordHelpBlock">
                              </div>

                              <div class="form-input col-lg-12 my-4">
                                <input type="hidden" name="role" value="penyewa" id="inputPassword2" placeholder="Password"
                                  class="form-control ps-3" aria-describedby="passwordHelpBlock">
                              </div>

                              <label class="py-3">
                                <input type="checkbox" required="" class="d-inline">
                                <span class="label-body text-black">I agree to the <a href="#"
                                    class="text-black password border-bottom">Privacy Policy</a>
                                </span>
                              </label>
                              <div class="d-grid my-3">
                                <button
                                  class="btn btn-primary btn-lg btn-dark text-uppercase btn-rounded-none fs-6">Sign
                                  Up</button>
                              </div>
                            </form>
                          </div>
                          <!-- register session -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>




  <!-- Kamar - kamar  -->
  <section id="residence">
    <div class="container my-5 py-5">
        
        <h2 class="text-capitalize m-0 py-lg-3 text-center mb-4">Semua kamar</h2>

        <div class="row g-4">

            <?php 
            // Cukup panggil koneksi & query satu kali di sini
            include '../proses/koneksi.php';
            
            // Pastikan koneksi berhasil sebelum query
            if ($koneksi) {
                $query = mysqli_query($koneksi, "SELECT * FROM data_kamar");

                // Lakukan looping selama datanya ada
                while ($kamar = mysqli_fetch_assoc($query)) { 
            ?>
            
                <div class="col-lg-4 col-md-6 mb-4">
                    
                    <div class="card h-100 shadow-sm"> 
                        <a href="detail_kamar.php?id=<?php echo $kamar['id_kamar']; ?>">
                            <img 
                                src="../images/<?php echo $kamar['gambar']; ?>" 
                                class="card-img-top" 
                                style="height: 200px; object-fit: cover;">
                        </a>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <?php echo $kamar['nama_kamar']; ?>
                            </h5>
                            <p class="card-text text-muted">
                                <?php echo $kamar['deskripsi']; ?>
                            </p>

                            <ul class="list-unstyled">
                                <li>🛏️ <?php echo $kamar['fasilitas']; ?></li>
                                <li>📌 Kategori: <?php echo $kamar['kategori']; ?></li>
                                <li>✔️ Status: <?php echo $kamar['ketersediaan']; ?></li>
                            </ul>

                            <a 
                                href="detail_kamar.php?id=<?php echo $kamar['id_kamar']; ?>" 
                                class="btn btn-primary w-100 mt-auto js-tombol-pesan"  data-idkos="<?php echo $kamar['id_kamar']; ?>" > 
                                Pesan
                            </a>
                        </div>
                    </div>
                </div> <?php 
                } // Penutup while loop
            } else {
                echo "<p>Koneksi ke database gagal.</p>";
            }
            ?>

        </div> 
      </div> 
    </section>


      <!-- <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Gedhe</h5>
            </a>
            <p class="card-text">Cocok untuk share dengan teman</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->





      <!-- <div class="card">
  <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
  <div class="card-body p-0">
    <a href="index.html">
      <h5 class="card-title pt-4">Kamar-Gedhe</h5>
    </a>
    <p class="card-text">Cocok untuk share dengan teman</p>
    <div class="card-text">
      <ul class="d-flex">
        <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
        <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
        <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
      </ul>
      <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
    </div>
  </div>
      </div>
      </div>
    </div>
  </div>
</div> -->


            <!-- <div class="container  my-5 py-5">
  <div class="swiper-button-next residence-swiper-next  residence-arrow"></div>
  <div class="swiper-button-prev residence-swiper-prev residence-arrow"></div>
  <div class="swiper residence-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item15.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Ramah kantong</h5>
            </a>
            <p class="card-text">Nyaman dengan kamar mandi dalam</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 1 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-dark btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">Terisi</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->


      <!-- <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Gedhe</h5>
            </a>
            <p class="card-text">Cocok untuk share dengan teman</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-dark btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">Terisi</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->




      <!-- <div class="card">
  <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
  <div class="card-body p-0">
    <a href="index.html">
      <h5 class="card-title pt-4">Kamar-Gedhe</h5>
    </a>
    <p class="card-text">Cocok untuk share dengan teman</p>
    <div class="card-text">
      <ul class="d-flex">
        <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
        <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
        <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
      </ul>
      <a href="detail_kamar.html" class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</a>
    </div>
  </div>
      </div>
      </div>
    </div>
  </div>
</div> -->




                      <!-- <div class="container  my-5 py-5">
  <div class="swiper-button-next residence-swiper-next  residence-arrow"></div>
  <div class="swiper-button-prev residence-swiper-prev residence-arrow"></div>
  <div class="swiper residence-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item15.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Ramah kantong</h5>
            </a>
            <p class="card-text">Nyaman dengan kamar mandi dalam</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 1 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->


      <!-- <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Gedhe</h5>
            </a>
            <p class="card-text">Cocok untuk share dengan teman</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->


      <!-- <div class="card">
  <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
  <div class="card-body p-0">
    <a href="index.html">
      <h5 class="card-title pt-4">Kamar-Gedhe</h5>
    </a>
    <p class="card-text">Cocok untuk share dengan teman</p>
    <div class="card-text">
      <ul class="d-flex">
        <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
        <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
        <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
      </ul>
      <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
    </div>
  </div>
      </div>
      </div>
    </div>
  </div>
</div> -->




<!-- <div class="container  my-5 py-5">
  <div class="swiper-button-next residence-swiper-next  residence-arrow"></div>
  <div class="swiper-button-prev residence-swiper-prev residence-arrow"></div>
  <div class="swiper residence-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item15.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Ramah kantong</h5>
            </a>
            <p class="card-text">Nyaman dengan kamar mandi dalam</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 1 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->


      <!-- <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Gedhe</h5>
            </a>
            <p class="card-text">Cocok untuk share dengan teman</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->


      <!-- <div class="card">
  <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
  <div class="card-body p-0">
    <a href="index.html">
      <h5 class="card-title pt-4">Kamar-Gedhe</h5>
    </a>
    <p class="card-text">Cocok untuk share dengan teman</p>
    <div class="card-text">
      <ul class="d-flex">
        <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
        <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
        <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
      </ul>
      <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
    </div>
  </div>
      </div>
      </div>
    </div>
  </div>
</div> -->


            <!-- <div class="container  my-5 py-5">
  <div class="swiper-button-next residence-swiper-next  residence-arrow"></div>
  <div class="swiper-button-prev residence-swiper-prev residence-arrow"></div>
  <div class="swiper residence-swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item15.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Ramah kantong</h5>
            </a>
            <p class="card-text">Nyaman dengan kamar mandi dalam</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 1 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->

      <!-- <div class="swiper-slide">
        <div class="card">
          <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
          <div class="card-body p-0">
            <a href="index.html">
              <h5 class="card-title pt-4">Kamar-Gedhe</h5>
            </a>
            <p class="card-text">Cocok untuk share dengan teman</p>
            <div class="card-text">
              <ul class="d-flex">
                <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
                <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
                <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
              </ul>
              <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
            </div>
          </div>
        </div>
      </div> -->


      <!-- <div class="card">
  <a href="index.html"><img src="../images/item16.png" class="card-img-top" alt="image"></a>
  <div class="card-body p-0">
    <a href="index.html">
      <h5 class="card-title pt-4">Kamar-Gedhe</h5>
    </a>
    <p class="card-text">Cocok untuk share dengan teman</p>
    <div class="card-text">
      <ul class="d-flex">
        <li class="residence-list"> <img src="../images/bed.png" alt="image"> 2 Kasur</li>
        <li class="residence-list"> <img src="../images/bath.png" alt="image"> 1 Bath</li>
        <li class="residence-list"> <button class="btn btn-primary btn-lg px-30 me-md-2" style="border-radius: 200px; height: 35px; "><p style="font-size: medium;">sedia</p></button></li>
      </ul>
      <button class="btn btn-primary btn-lg px-40 me-md-2" style="width: 19rem;">pesan</button>
    </div>
  </div>
      </div>. -->

      <!-- </div>
    </div>
  </div>
</div> -->
  <!-- </section> -->

  



  
  <!-- Lets start  -->
  <section id="start">
    <div class="container my-5 py-5">
      <div class="row featurette py-lg-5 ">
        <div class="col-md-5 order-md-1 d-flex">
          <h1 class="text-capitalize  lh-1 mb-3">Ayo tunggu apalagi, Pesan segera!!!</h1>
        </div>
        <div class="col-md-7 order-md-2">
          <div class="text-content ps-md-5 mt-4 mt-md-0">
            <p class="py-lg-2">Neque, vestibulum sed varius magna et at. Eu, adipiscing morbi augue justo. Nibh
              laoreet volutpat quis velit. Blandit aliquam donec sed morbi congue eget lorem viverra porta id
              lobortis.</p>
            <a href="index.html" class="btn btn-primary btn-lg px-4 me-md-2">Get
              Started</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer start  -->
  <section id="footer">
    <div class="container footer-container">
      <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5  ">

        <div class=" col-md-4">
          <h3><img src="../images/logo.png" style="width: 200px;" alt="image"></h3>
          <p>Pilihan kost ideal dengan fasilitas lengkap dan harga terjangkau</p>
          <i class="bi-facebook pe-4"></i>
          <i class="bi-instagram pe-4"></i>
          <i class="bi-twitter pe-4"></i>
          <i class="bi-youtube pe-4"></i>
        </div>

        <div class="col-md-2 ">
          <h5>Project</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Houses</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Rooms</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Flats</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Appartments</a></li>
          </ul>
        </div>

        <div class="col-md-2 ">
          <h5>Company</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">How we work ?</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Capital </a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Security </a></li>
          </ul>
        </div>

        <div class="col-md-2 ">
          <h5>Movement</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Movement</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Support us</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Pricing</a></li>
          </ul>
        </div>

        <div class="col-md-2 ">
          <h5>Help</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Privacy </a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Condition</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">Blog</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 ">FAQs</a></li>
          </ul>
        </div>
      </footer>
    </div>



    <footer class="d-flex flex-wrap justify-content-between align-items-center border-top"></footer>

    <div class="container">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-2 ">
        <div class="col-md-8 d-flex align-items-center">
          <p>© 2025 BintangKost, Inc. All rights reserved.</p>

        </div>


      </footer>
    </div>
  </section>



<script>
// 1. Ambil SEMUA tombol yang punya kelas 'js-tombol-pesan'
const semuaTombolPesan = document.querySelectorAll('.js-tombol-pesan');

// 2. Pasang "pendengar" di setiap tombol
semuaTombolPesan.forEach(tombol => {
    
    // 3. Saat tombolnya di-klik, jalankan fungsi ini
    tombol.addEventListener('click', function(event) {
        
        // 4. Mencegah link href="#" biar gak jalan (halaman gak loncat ke atas)
        event.preventDefault(); 
        
        // 5. Cek variabel 'jembatan' yang kita buat di <head> tadi
        if (isUserLoggedIn === true) {
            
            // --- KONDISI A: SUDAH LOGIN ---
            
            // Ambil ID kos dari tombol yang diklik
            const idKos = this.getAttribute('data-idkos');
            
            // Arahkan dia ke halaman detail (sesuai kode aslimu)
            // PASTIKAN halaman 'detail_kamar.php' juga ada include 'navbar.php'
            window.location.href = 'detail_kamar.php?id=' + idKos;
            
        } else {
            
            // --- KONDISI B: BELUM LOGIN ---
            
            // Tampilkan alert sesuai permintaanmu! 🗿
            alert('Anda harus login terlebih dahulu untuk memesan!');
            
            // (Opsional) Kalo mau, arahin ke modal login Bootstrap-mu
            // Ganti "exampleModal" dengan ID modal login-mu
            // var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            // myModal.show();
        }
    });
});
</script>
  <script src="../js/jquery-1.11.0.min.js"></script>
  <script src="../js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>
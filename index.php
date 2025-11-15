<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - Bimbob Printing</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Sailor
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <?php include "component/navbar.php" ?>
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active">
          <img src="assets/img/hero-carousel/hero-carousel-1.jpg" alt="">
          <div class="carousel-container">
            <h2>Welcome To Bimbob Printing<br></h2>
            <p>Menyediakan layanan cetak lengkap untuk berbagai kebutuhan, mulai dari banner, printing, laminating, hingga stiker. Kami berkomitmen menghadirkan hasil yang rapi, presisi, dan memuaskan di setiap cetakan.</p>
            <a href="#featured-services" class="btn-get-started">Get Started</a>
          </div>
        </div><!-- End Carousel Item -->

       <!-- End Carousel Item -->

       <!-- End Carousel Item -->

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

      </div>

    </section><!-- /Hero Section -->
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Product</h2>
        <p>Silahkan Pesan</p>
      </div><!-- End Section Title -->

      <div class="container">

        <?php
        include 'koneksi.php';

        // Ambil semua jenis barang unik untuk filter
        $filterQuery = mysqli_query($koneksi, "SELECT DISTINCT jenis_barang FROM data_barang");

        // Ambil semua data produk
        $produkQuery = mysqli_query($koneksi, "SELECT * FROM data_barang");
        


         
        ?>

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <!-- Filter Otomatis -->
          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <?php while ($filter = mysqli_fetch_assoc($filterQuery)) : ?>
              <?php
              $filterClass = 'filter-' . strtolower(str_replace(' ', '', $filter['jenis_barang']));
              ?>
              <li data-filter=".<?php echo $filterClass; ?>"><?php echo $filter['jenis_barang']; ?></li>
            <?php endwhile; ?>
          </ul><!-- End Portfolio Filters -->

          <!-- Container Produk -->
          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <?php while ($row = mysqli_fetch_assoc($produkQuery)) : ?>
              <?php
              $filterClass = 'filter-' . strtolower(str_replace(' ', '', $row['jenis_barang']));



                  $produk_id = $row['id_barang'];

                   $ratingQuery = mysqli_query($koneksi, "SELECT AVG(rating) as rataRating FROM rating WHERE produk_id = '$produk_id'");
              $ratingData = mysqli_fetch_assoc($ratingQuery);
              $rataRating = $ratingData && $ratingData['rataRating'] ? round($ratingData['rataRating'], 1) : 0;
              $ratingBulat = round($rataRating);

              // Biar tampilan bintangnya bulat (bisa 1–5)
              $ratingBulat = round($rataRating);
              ?>
              <div class="col-lg-4 col-md-6 portfolio-item isotope-item <?php echo $filterClass; ?>">

                <div class="card border-0 shadow-sm text-center p-3">
                  <!-- Gambar Produk -->
                  <img src="img/<?php echo $row['gambar_produk']; ?>"
                    class="img-fluid rounded mx-auto d-block mb-3"
                    alt="<?php echo $row['nama_barang']; ?>"
                    style="max-height: 250px; object-fit: cover;">

                  <!-- Penjelasan -->
                  <h5 class="fw-bold mb-1"><?php echo $row['nama_barang']; ?></h5>
                  <p class="mb-2 text-muted">
                    <?php echo $row['jenis_barang']; ?> - Rp<?php echo number_format($row['harga_barang'], 0, ',', '.'); ?> / <?php echo $row['satuan']; ?>
                  </p>

                  <div class="mb-2 text-warning">
                    <?php
                    if ($rataRating > 0) {
                      for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $ratingBulat ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
                      }
                      echo " <small class='text-muted'>($rataRating)</small>";
                    } else {
                      echo "<small class='text-muted'><i class='bi bi-star'>(0)</i></small>";
                    }
                    ?>
                  </div>

                  <!-- Tombol Zoom -->
                  <a href="detail_produk.php?id=<?php echo $row['id_barang']; ?>"
                    class="btn btn-sm btn-primary">
                    <i class="bi bi-info-circle"></i> Pesan Produk
                  </a>
                </div>

              </div><!-- End Portfolio Item -->
            <?php endwhile; ?>
          </div><!-- End Portfolio Container -->
        </div>
      </div>
    </section><!-- /Portfolio Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Bimbob Printing</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
       
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
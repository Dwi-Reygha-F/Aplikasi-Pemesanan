<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Rating - Bimbob Printing</title>
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

  <style>
.card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      border-radius: 10px;
    }
    /* Animasi ketika muncul */
.produk-item {
  transition: all 0.3s ease-in-out;
  opacity: 1;
  transform: scale(1);
}

.produk-item.hide {
  opacity: 0;
  transform: scale(0.8);
  pointer-events: none;
  position: absolute;
  visibility: hidden;
}

/* Tombol aktif */
.filter-btn.active {
  background: #c62828;
  color: white;
  padding: 6px 14px;
  border-radius: 6px;
  transition: 0.3s;
}

.filter-btn {
  cursor: pointer;
  padding: 6px 14px;
  border-radius: 6px;
}

  </style>

 
</head>

<body class="index-page">
  <?php include "component/navbar.php" ?>

  <main class="main">
    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Product</h2>
        <p>Silahkan Rating Produk</p>
      </div><!-- End Section Title -->

      <div class="container">

        <?php

        include 'koneksi.php';

        $user_id = $_SESSION['id'] ?? null;


        // Ambil semua jenis barang unik untuk filter
        $filterQuery = mysqli_query($koneksi, "SELECT DISTINCT jenis_barang FROM data_barang");

        // Ambil semua data produk
        $produkQuery = mysqli_query($koneksi, "SELECT * FROM data_barang");
        ?>

        <div class="layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

            <!-- Filter Otomatis -->
     <ul class="portfolio-filters d-flex justify-content-center gap-3 mb-4">
    <li class="filter-btn active" data-filter="all">All</li>
    <?php while ($filter = mysqli_fetch_assoc($filterQuery)) : ?>
        <?php 
        $clean = strtolower(str_replace(' ', '', $filter['jenis_barang'])); 
        ?>
        <li class="filter-btn" data-filter="<?php echo $clean; ?>">
            <?php echo $filter['jenis_barang']; ?>
        </li>
    <?php endwhile; ?>
</ul>


          <!-- Container Produk -->
           <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">

            <?php while ($row = mysqli_fetch_assoc($produkQuery)) : ?>
              <?php
              $filterClass = 'filter-' . strtolower(str_replace(' ', '', $row['jenis_barang']));
              $produk_id = $row['id_barang'];

              // Cek apakah user sudah memberi rating
              $sudahRating = false;
              if ($user_id) {
                $cek = mysqli_query($koneksi, "SELECT * FROM rating WHERE user_id='$user_id' AND produk_id='$produk_id'");
                $sudahRating = mysqli_num_rows($cek) > 0;
              }

              // Hitung rata-rata rating
              $avgQuery = mysqli_query($koneksi, "SELECT AVG(rating) AS avg_rating FROM rating WHERE produk_id='$produk_id'");
              $avgData = mysqli_fetch_assoc($avgQuery);
              $avgRating = round($avgData['avg_rating'], 1);
              ?>
              <div class="col-lg-4 col-md-6 produk-item" data-category="<?php echo strtolower(str_replace(' ', '', $row['jenis_barang'])); ?>">
    <div class="card border-0 shadow-sm text-center p-3">
        <img src="img/<?php echo $row['gambar_produk']; ?>"
            class="img-fluid rounded mx-auto d-block mb-3"
            style="max-height: 250px; object-fit: cover;">

        <h5 class="fw-bold mb-1"><?php echo $row['nama_barang']; ?></h5>
        <p class="mb-1 text-muted">
            <?php echo $row['jenis_barang']; ?> - Rp<?php echo number_format($row['harga_barang'], 0, ',', '.'); ?> / <?php echo $row['satuan']; ?>
        </p>

        <p class="mb-2">
            <i class="bi bi-star-fill text-warning"></i>
            <strong><?php echo $avgRating ?: 0; ?></strong>/5
        </p>

        <?php if (!$user_id): ?>
            <button class="btn btn-outline-secondary btn-sm" onclick="alert('Silakan login terlebih dahulu!')">
                <i class="bi bi-star"></i> Beri Rating
            </button>
        <?php elseif ($sudahRating): ?>
            <button class="btn btn-secondary btn-sm" disabled>
                <i class="bi bi-star-fill text-warning"></i> Sudah Dirating
            </button>
        <?php else: ?>
            <button class="btn btn-primary btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#ratingModal"
                data-id="<?php echo $produk_id; ?>">
                <i class="bi bi-star"></i> Beri Rating
            </button>
        <?php endif; ?>
    </div>
</div>

            <?php endwhile; ?>
          </div><!-- End Portfolio Container -->
        </div>
      </div>

      <!-- Modal Rating -->
      <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="ratingModalLabel"><i class="bi bi-star-fill"></i> Beri Rating</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="submit_rating.php" method="POST">
              <div class="modal-body text-center">
                <input type="hidden" name="produk_id" id="produk_id">
                <div class="rating mb-3">
                  <i class="bi bi-star" data-value="1"></i>
                  <i class="bi bi-star" data-value="2"></i>
                  <i class="bi bi-star" data-value="3"></i>
                  <i class="bi bi-star" data-value="4"></i>
                  <i class="bi bi-star" data-value="5"></i>
                </div>
                <input type="hidden" name="rating" id="ratingValue" required>
                <p class="text-muted small">Klik bintang untuk memberi penilaian.</p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Kirim Rating</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        // ambil id produk ke modal
        const ratingModal = document.getElementById('ratingModal');
        ratingModal.addEventListener('show.bs.modal', function(event) {
          const button = event.relatedTarget;
          const produkId = button.getAttribute('data-id');
          document.getElementById('produk_id').value = produkId;
        });

        // efek klik bintang
        const stars = document.querySelectorAll('.rating i');
        stars.forEach(star => {
          star.addEventListener('click', function() {
            const value = this.getAttribute('data-value');
            document.getElementById('ratingValue').value = value;
            stars.forEach(s => s.classList.remove('bi-star-fill', 'text-warning'));
            for (let i = 0; i < value; i++) {
              stars[i].classList.add('bi-star-fill', 'text-warning');
            }
          });
        });
      </script>
    </section>


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
  <script src="assets/vendor/-layout/.pkgd.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
 <script>
const buttons = document.querySelectorAll('.filter-btn');
const items = document.querySelectorAll('.produk-item');

buttons.forEach(btn => {
    btn.addEventListener('click', () => {
        // Active btn
        buttons.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        let filter = btn.getAttribute('data-filter');

        items.forEach(item => {
            let category = item.getAttribute('data-category');

            if (filter === "all" || filter === category) {
                item.classList.remove("hide");
            } else {
                item.classList.add("hide");
            }
        });
    });
});

</script>


</body>

</html>
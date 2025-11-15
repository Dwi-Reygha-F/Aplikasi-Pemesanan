<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']); // ambil nama file aktif (misal: index.php, about.php)
?>

<style>
.logo {
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 10px; /* jarak antara logo dan teks */
  padding: 8px 15px;
  border-radius: 10px;
  transition: all 0.3s ease;
}

.logo:hover {
  background: #f4f4f4;
  transform: translateY(-2px);
}

.logo-img {
  height: 45px;
  width: 45px;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.logo:hover .logo-img {
  transform: rotate(-5deg) scale(1.05);
}

.sitename {
  font-size: 1.4rem;
  font-weight: 700;
  color: #222;
  letter-spacing: 0.5px;
  margin: 0;
}

.sitename span {
  color: #ff4d00; /* warna aksen bisa diganti */
}

/* Responsif untuk layar kecil */
@media (max-width: 576px) {
  .sitename {
    font-size: 1.1rem;
  }
  .logo-img {
    height: 35px;
    width: 35px;
  }
}
</style>

<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

   <a href="index.php" class="logo d-flex align-items-center me-auto">
  <img src="img/logo.png" alt="Logo" class="logo-img">
  <h1 class="sitename">Bimbob Printing</h1>
</a>




    <nav id="navmenu" class="navmenu">
      <ul>
        <?php if ($current_page == 'index.php'): ?>
          <!-- Jika sedang di halaman index -->
          <li><a href="#hero">Home</a></li>
          <li><a href="#portfolio">Pesanan</a></li>
           <li><a href="rating.php">Rating</a></li>
          <li></li>
        <?php else: ?>
          <!-- Jika di halaman lain -->
          <li><a href="index.php#hero">Home</a></li>
          <li><a href="index.php#portfolio">Pesanan</a></li>
            <li><a href="rating.php">Rating</a></li>
          <li></li>
        <?php endif; ?>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <?php if (isset($_SESSION['email'])): ?>
      <!-- Kalau sudah login -->
      <div class="dropdown">
        <button class="btn btn-danger dropdown-toggle d-flex align-items-center" type="button" id="userDropdown"
          data-bs-toggle="dropdown" aria-expanded="false"
          style="border-radius: 25px; padding: 6px 14px;">
          👋 <span class="ms-2 fw-semibold"><?php echo htmlspecialchars($_SESSION['nama']); ?></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown"
          style="border-radius: 12px;">
          <li><a class="dropdown-item" href="history.php"><i class="bi bi-clock-history me-2 text-danger"></i>Riwayat Pesanan</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger fw-semibold" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
        </ul>
      </div>
    <?php else: ?>
      <!-- Kalau belum login -->
      <a class="btn-getstarted" href="login.php" style="background-color:#c62828; color:white; border:none;">Login</a>
    <?php endif; ?>

  </div>
</header>

<!-- Bootstrap JS dan Icons -->

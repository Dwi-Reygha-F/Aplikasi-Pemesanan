<?php
// Ambil nama file aktif (misalnya: akun.php)
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true" data-img="theme-assets/images/backgrounds/02.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="index.php">
                    <img class="brand-logo" alt="Chameleon admin logo" src="../img/logo.png" />
                    <h3 class="brand-text">Bimbob Printing</h3>
                </a>
            </li>
            <li class="nav-item d-md-none">
                <a class="nav-link close-navbar"><i class="ft-x"></i></a>
            </li>
        </ul>
    </div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">
                <a href="index.php">
                    <i class="ft-home"></i>
                    <span class="menu-title" data-i18n="">Dashboard</span>
                </a>
            </li>

            <li class="<?= ($current_page == 'akun.php') ? 'active' : '' ?>">
                <a href="akun.php">
                    <i class="ft-users"></i>
                    <span class="menu-title" data-i18n="">Akun User</span>
                </a>
            </li>

            <li class="<?= ($current_page == 'dataProduct.php') ? 'active' : '' ?>">
                <a href="dataProduct.php">
                    <i class="ft-package"></i>
                    <span class="menu-title" data-i18n="">Data Product</span>
                </a>
            </li>

            <li class="<?= ($current_page == 'dataPemesanan.php') ? 'active' : '' ?>">
                <a href="dataPemesanan.php">
                    <i class="ft-shopping-cart"></i>
                    <span class="menu-title" data-i18n="">Data Pemesanan</span>
                </a>
            </li>

            <li>
                <a href="../logout.php">
                    <i class="ft-power"></i>
                    <span class="menu-title" data-i18n="">Logout</span>
                </a>
            </li>

        </ul>
    </div>

    <div class="navigation-background"></div>
</div>

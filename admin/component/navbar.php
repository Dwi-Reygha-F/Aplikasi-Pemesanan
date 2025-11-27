<?php
session_start();
?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="collapse navbar-collapse show" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-block d-md-none">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                            <i class="ft-menu"></i>
                        </a>
                    </li>
                </ul>
                
                <ul class="nav navbar-nav float-right">
                    <!-- Notifikasi Pesanan Baru -->
                    <li class="nav-item">
                        <a class="nav-link" href="dataPemesanan.php" style="position: relative;">
                            <i class="fa fa-shopping-cart" style="font-size: 18px;"></i>
                            <span id="notifPesanan" 
                                  style="display:none; position: absolute; top: 3px; right: -10px; 
                                         background:red; color:white; font-size:12px; 
                                         padding:2px 6px; border-radius:50%;"></span>
                        </a>
                    </li>

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="avatar avatar-online">
                                <img src="../img/logo_admin.jpeg" alt="avatar">
                                <i></i>
                            </span>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="arrow_box_right">
                                <a class="dropdown-item" href="#">
                                    <span class="avatar avatar-online">
                                        <img src="../img/logo_admin.jpeg" alt="avatar">
                                        <span class="user-name text-bold-700 ml-1">
                                            <?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'User'; ?>
                                        </span>
                                    </span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../logout.php">
                                    <i class="ft-power"></i> Logout
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Tambahkan script di bawah sebelum </body> di index.php -->
<script>
// Minta izin notifikasi browser
if (Notification.permission !== "granted") {
    Notification.requestPermission();
}

// Fungsi cek pesanan baru
function checkNewOrders() {
    fetch('cek_pesanan_baru.php')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notifPesanan');
            if(badge){
                if(data.new_order > 0){
                    badge.textContent = data.new_order;
                    badge.style.display = 'inline-block';

                    // Notifikasi browser
                    if(Notification.permission === "granted"){
                        new Notification('Pesanan Baru!', {
                            body: `Ada ${data.new_order} pesanan baru.`,
                            icon: '../../img/logo.png'
                        });
                    }
                } else {
                    badge.style.display = 'none';
                }
            }
        })
        .catch(err => console.error(err));
}

// Cek setiap 10 detik
setInterval(checkNewOrders, 100000);

// Cek pertama kali saat halaman dibuka
checkNewOrders();
</script>

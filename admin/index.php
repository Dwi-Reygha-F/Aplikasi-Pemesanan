<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Dashboard Penjualan Percetakan">
    <meta name="author" content="Egha">
    <title>Dashboard Penjualan</title>

    <!-- ICONS & FONT -->
    <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,600,700|Comfortaa:400,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- BEGIN VENDOR CSS -->
    <link rel="stylesheet" href="theme-assets/css/vendors.css">
    <!-- END VENDOR CSS -->

    <!-- BEGIN CHAMELEON CSS -->
    <link rel="stylesheet" href="theme-assets/css/app-lite.css">
    <link rel="stylesheet" href="theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" href="theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" href="theme-assets/css/pages/dashboard-ecommerce.css">
    <!-- END CHAMELEON CSS -->

    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .card h5 {
            font-size: 0.95rem;
        }

        .icon-bg {
            background: linear-gradient(45deg, #36d1dc, #5b86e5);
            color: #fff;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-red" data-col="2-columns">

    <!-- Navbar -->
    <?php include "component/navbar.php"; ?>

    <!-- Sidebar -->
    <?php include "component/sidebar.php"; ?>

    <!-- Main Content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>

            <div class="content-body">
                <div class="row">
                    <!-- Total Pendapatan Hari Ini -->
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180 position-relative">
                                <h5 class="text-muted danger position-absolute p-1">Total Pendapatan Hari Ini</h5>
                                <div>
                                    <i class="ft-pie-chart danger font-large-1 float-right p-1"></i>
                                </div>
                                <div class="pt-5 text-center">
                                    <?php
                                    include '../koneksi.php';
                                    date_default_timezone_set('Asia/Jakarta');
                                    $today = date('Y-m-d');

                                    $query_pendapatan = "
                        SELECT SUM(total_harga) AS total_pendapatan_hari_ini
                        FROM data_pemesanan
                        WHERE DATE(tanggal_pemesanan) = '$today'
                        AND validasi = 'Pesanan Sudah Di Ambil'
                    ";

                                    $result_pendapatan = mysqli_query($koneksi, $query_pendapatan);
                                    if (!$result_pendapatan) {
                                        echo "<p class='text-danger mt-3'>Error: " . mysqli_error($koneksi) . "</p>";
                                    } else {
                                        $row = mysqli_fetch_assoc($result_pendapatan);
                                        $total_hari_ini = $row['total_pendapatan_hari_ini'] ?? 0;
                                        echo "<h2 class='mt-3 text-success'>Rp " . number_format($total_hari_ini, 0, ',', '.') . "</h2>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Pemesanan Hari Ini -->
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180 position-relative">
                                <h5 class="text-muted info position-absolute p-1">Jumlah Pemesanan Hari Ini</h5>
                                <div>
                                    <i class="ft-activity info font-large-1 float-right p-1"></i>
                                </div>
                                <div class="pt-5 text-center">
                                    <?php
                                    $query_pemesanan = "
                        SELECT COUNT(*) AS total_pemesanan_hari_ini
                        FROM data_pemesanan
                        WHERE DATE(tanggal_pemesanan) = '$today'
                        AND validasi = 'Pesanan Sudah Di Ambil'
                    ";

                                    $result_pemesanan = mysqli_query($koneksi, $query_pemesanan);
                                    if (!$result_pemesanan) {
                                        echo "<p class='text-danger mt-3'>Error: " . mysqli_error($koneksi) . "</p>";
                                    } else {
                                        $row = mysqli_fetch_assoc($result_pemesanan);
                                        $total_pemesanan = $row['total_pemesanan_hari_ini'] ?? 0;
                                        echo "<h2 class='mt-3 text-primary'>$total_pemesanan Pesanan</h2>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pendapatan (Keseluruhan) -->
                    <div class="col-xl-4 col-lg-12">
                        <div class="card pull-up ecom-card-1 bg-white">
                            <div class="card-content ecom-card2 height-180 position-relative">
                                <h5 class="text-muted warning position-absolute p-1">Total Pendapatan</h5>
                                <div>
                                    <i class="fa-solid fa-coins warning font-large-1 float-right p-1"></i>
                                </div>
                                <div class="pt-5 text-center">
                                    <?php
                                    $query_total = "
                        SELECT SUM(total_harga) AS total_pendapatan
                        FROM data_pemesanan
                        WHERE validasi = 'Pesanan Sudah Di Ambil'
                    ";
                                    $result_total = mysqli_query($koneksi, $query_total);
                                    if (!$result_total) {
                                        echo "<p class='text-danger mt-3'>Error: " . mysqli_error($koneksi) . "</p>";
                                    } else {
                                        $row = mysqli_fetch_assoc($result_total);
                                        $total_semua = $row['total_pendapatan'] ?? 0;
                                        echo "<h2 class='mt-3 text-success'>Rp " . number_format($total_semua, 0, ',', '.') . "</h2>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row match-height">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="heading-multiple-thumbnails">Chart Penjualan</h4>
                                <a class="heading-elements-toggle">
                                    <i class="la la-ellipsis-v font-medium-3"></i>
                                </a>

                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <canvas id="chartPenjualan" height="130"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <footer class="footer footer-static footer-light navbar-border navbar-shadow mt-3">
        <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 py-1">
            <span class="float-md-left d-block d-md-inline-block">
                © 2025 | Dashboard Percetakan by <strong>Bimbob Printing</strong>
            </span>
        </div>
    </footer>
<!-- SweetAlert2 -->


    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        fetch('get_chart_data.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.jenis_barang);
                const values = data.map(item => parseInt(item.total_pesanan) || 0);

                const ctx = document.getElementById('chartPenjualan').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Penjualan',
                            data: values,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            },
                            title: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
// Fungsi cek pesanan baru pakai SweetAlert2
function checkNewOrders() {
    fetch('cek_pesanan_baru.php')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notifPesanan');
            if(badge){
                if(data.new_order > 0){
                    badge.textContent = data.new_order;
                    badge.style.display = 'inline-block';

                    // Notifikasi pakai SweetAlert2
                    Swal.fire({
                        title: 'Pesanan Baru!',
                        text: `Ada ${data.new_order} pesanan baru.`,
                        icon: 'info',
                        timer: 3000, // otomatis hilang setelah 3 detik
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                } else {
                    badge.style.display = 'none';
                }
            }
        })
        .catch(err => console.error(err));
}

// Cek setiap 10 detik
setInterval(checkNewOrders, 10000);

// Cek pertama kali saat halaman dibuka
checkNewOrders();
</script>



    <!-- VENDOR JS -->
    <script src="theme-assets/vendors/js/vendors.min.js"></script>
    <script src="theme-assets/js/core/app-menu-lite.js"></script>
    <script src="theme-assets/js/core/app-lite.js"></script>
</body>

</html>
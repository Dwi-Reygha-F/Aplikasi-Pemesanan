<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
 <title>Data Pemesanan - Admin Bimbob Printing</title>
    <link rel="apple-touch-icon" href="theme-assets/images/ico/apple-icon-120.png">
     <link rel="shortcut icon" type="image/x-icon" href="../img/logo.png">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="theme-assets/css/vendors.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="theme-assets/css/app-lite.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="theme-assets/css/core/colors/palette-gradient.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-red" data-col="2-columns">

    <!-- fixed-top-->
    <?php include "component/navbar.php" ?>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <?php include "component/sidebar.php" ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Data Pemesanan</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Data Pemesanan
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-content collapse show">
                        <div class="card-body">

                            <?php
                            include "../koneksi.php";
                            $query = mysqli_query($koneksi, "SELECT * FROM data_pemesanan ORDER BY id DESC");
                            ?>

                            <h4 class="mb-3">Daftar Pemesanan</h4>

                            <div class="table-responsive">
                                <table id="tableAdmin" class="table table-bordered table-striped mb-0">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Nama Customer</th>
                                            <th>No. Telp</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Tanggal Pengambilan</th>
                                            <th>Ukuran (L x T)</th>
                                            <th>Jumlah</th>
                                            <th>Jenis Pembayaran</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Total Harga</th>
                                            <th>Status Validasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            // Cek ukuran
                                            if (($row['lebar'] == 0 && $row['tinggi'] == 0) || ($row['lebar'] == '' && $row['tinggi'] == '')) {
                                                $ukuran = '-';
                                            } else {
                                                $ukuran = $row['lebar'] . ' x ' . $row['tinggi'];
                                            }

                                            echo "
      <tr class='text-center'>
        <td>{$no}</td>
        <td>{$row['nama_barang']}</td>
        <td>{$row['nama_cust']}</td>
        <td>{$row['no_telp']}</td>
        <td>{$row['tanggal_pemesanan']}</td>
        <td>{$row['tanggal_pengambilan']}</td>
        <td>{$ukuran}</td>
        <td>{$row['jumlah_barang']}</td>
        <td>{$row['jenis_pembayaran']}</td>
                        <td>";
                                            if (!empty($row['bukti_pembayaran'])) {
                                                echo "<a href='../bukti_pembayaran/{$row['bukti_pembayaran']}' target='_blank'>
            <img src='../bukti_pembayaran/{$row['bukti_pembayaran']}' width='60' class='rounded'>
          </a>";
                                            } else {
                                                echo "-";
                                            }
                                            echo "
</td>

                        <td>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>
                        <td>
                          <span class='badge ";
                                            if ($row['validasi'] == 'Menunggu Validasi Admin') echo "badge-warning";
                                            elseif ($row['validasi'] == 'Pesanan Siap Di Ambil') echo "badge-info";
                                            elseif ($row['validasi'] == 'Pesanan Sudah Di Ambil') echo "badge-success";
                                            else echo "badge-secondary";
                                            echo "'>{$row['validasi']}</span>
                        </td>
                        <td>
                          <button class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modalEdit{$row['id']}'><i class='ft-edit'></i></button>
                        </td>
                      </tr>
                      ";

                                            // Modal Edit Validasi
                                            echo "
                      <div class='modal fade' id='modalEdit{$row['id']}' tabindex='-1'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header bg-warning'>
                              <h5 class='modal-title text-white'>Ubah Status Validasi</h5>
                              <button type='button' class='close' data-dismiss='modal'>&times;</button>
                            </div>
                            <form method='POST' action='proses/proses_editValidasi.php'>
                              <div class='modal-body'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <div class='form-group'>
                                  <label>Status Validasi</label>
                                  <select name='validasi' class='form-control' required>
                                    <option value='Menunggu Validasi Admin' " . ($row['validasi'] == 'Menunggu Validasi Admin' ? 'selected' : '') . ">Menunggu Validasi Admin</option>
                                    <option value='Pesanan Siap Di Ambil' " . ($row['validasi'] == 'Pesanan Siap Di Ambil' ? 'selected' : '') . ">Pesanan Siap Di Ambil</option>
                                    <option value='Pesanan Sudah Di Ambil' " . ($row['validasi'] == 'Pesanan Sudah Di Ambil' ? 'selected' : '') . ">Pesanan Sudah Di Ambil</option>
                                  </select>
                                </div>
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                                <button type='submit' class='btn btn-warning'>Simpan</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      ";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


     <footer class="footer footer-static footer-light navbar-border navbar-shadow mt-3">
        <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2 py-1">
            <span class="float-md-left d-block d-md-inline-block">
                © 2025 | Dashboard Percetakan by <strong>Bimbob Printing</strong>
            </span>
        </div>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
</body>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tableAdmin').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data ditemukan",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(difilter dari total _MAX_ data)"
            },
            "pageLength": 10
        });
    });
</script>


</html>
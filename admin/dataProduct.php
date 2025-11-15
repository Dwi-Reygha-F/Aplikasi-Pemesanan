<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Data Product - Admin Bimbob Printing</title>
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
                    <h3 class="content-header-title">Data Product</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Data Product
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
                            $query = mysqli_query($koneksi, "SELECT * FROM data_barang");
                            ?>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0">Daftar Product</h4>
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
                                    <i class="ft-plus"></i> Tambah Product
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table id="tableAdmin" class="table table-bordered table-striped mb-0">
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Harga Barang</th>
                                            <th>Satuan</th>
                                            <th>Gambar Produk</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "
                                            <tr>
                                                <td class='text-center'>{$no}</td>
                                                <td>{$row['nama_barang']}</td>
                                                <td>{$row['jenis_barang']}</td>
                                                <td>Rp " . number_format($row['harga_barang'], 0, ',', '.') . "</td>
                                                <td>{$row['satuan']}</td>
                                                <td class='text-center'>
                                                    <img src='../img/{$row['gambar_produk']}' width='60' class='rounded'>
                                                </td>
                                                <td class='text-center'>
                                                    <button class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modalEdit{$row['id_barang']}'><i class='ft-edit'></i></button>
                                                    <button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#modalHapus{$row['id_barang']}'><i class='ft-trash-2'></i></button>
                                                </td>
                                            </tr>
                                            ";

                                            // Modal Edit
                                            echo "
                                            <div class='modal fade' id='modalEdit{$row['id_barang']}' tabindex='-1'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header bg-warning'>
                                                            <h5 class='modal-title text-white'>Edit Barang</h5>
                                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        </div>
                                                        <form method='POST' action='proses/proses_editBarang.php' enctype='multipart/form-data'>
                                                            <div class='modal-body'>
                                                                <input type='hidden' name='id_barang' value='{$row['id_barang']}'>
                                                                <div class='form-group'>
                                                                    <label>Nama Barang</label>
                                                                    <input type='text' name='nama_barang' class='form-control' value='{$row['nama_barang']}' required>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label>Jenis Barang</label>
                                                                    <select name='jenis_barang' class='form-control' required>
                                                                        <option value='Sticker' " . ($row['jenis_barang'] == 'Sticker' ? 'selected' : '') . ">Sticker</option>
                                                                        <option value='Banner' " . ($row['jenis_barang'] == 'Banner' ? 'selected' : '') . ">Banner</option>
                                                                        <option value='Laminating' " . ($row['jenis_barang'] == 'Laminating' ? 'selected' : '') . ">Laminating</option>
                                                                        <option value='Print' " . ($row['jenis_barang'] == 'Print' ? 'selected' : '') . ">Print</option>
                                                                    </select>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label>Harga Barang</label>
                                                                    <input type='number' name='harga_barang' class='form-control' value='{$row['harga_barang']}' required>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label>Satuan</label>
                                                                    <select name='satuan' class='form-control' required>
                                                                        <option value='Meter' " . ($row['satuan'] == 'Meter' ? 'selected' : '') . ">Meter</option>
                                                                        <option value='Lembar' " . ($row['satuan'] == 'Lembar' ? 'selected' : '') . ">Lembar</option>
                                                                      
                                                                    </select>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label>Gambar Produk</label>
                                                                    <input type='file' name='gambar_produk' class='form-control'>
                                                                    <small class='text-muted'>Biarkan kosong jika tidak ingin mengganti.</small>
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

                                            // Modal Hapus
                                            echo "
                                            <div class='modal fade' id='modalHapus{$row['id_barang']}' tabindex='-1'>
                                                <div class='modal-dialog modal-sm'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header bg-danger'>
                                                            <h5 class='modal-title text-white'>Hapus Barang</h5>
                                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        </div>
                                                        <form method='POST' action='proses/proses_hapusBarang.php'>
                                                            <div class='modal-body text-center'>
                                                                <input type='hidden' name='id_barang' value='{$row['id_barang']}'>
                                                                <p>Yakin ingin menghapus <strong>{$row['nama_barang']}</strong>?</p>
                                                            </div>
                                                            <div class='modal-footer justify-content-center'>
                                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                                                                <button type='submit' class='btn btn-danger'>Hapus</button>
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

                            <!-- Modal Tambah -->
                            <div class="modal fade" id="modalTambah" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title text-white">Tambah Barang</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <form method="POST" action="proses/proses_tambahBarang.php" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama Barang</label>
                                                    <input type="text" name="nama_barang" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Barang</label>
                                                    <select name="jenis_barang" class="form-control" required>
                                                        <option value="">-- Pilih Jenis --</option>
                                                        <option value="Sticker">Sticker</option>
                                                        <option value="Banner">Banner</option>
                                                        <option value="Laminating">Laminating</option>
                                                        <option value="Print">Print</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Harga Barang</label>
                                                    <input type="number" name="harga_barang" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Satuan</label>
                                                    <select name="satuan" class="form-control" required>
                                                        <option value="">-- Pilih Satuan --</option>
                                                        <option value="Meter">Meter</option>
                                                        <option value="Lembar">Lembar</option>
                                                     
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Gambar Produk</label>
                                                    <input type="file" name="gambar_produk" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /card-body -->
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
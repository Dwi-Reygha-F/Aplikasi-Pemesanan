<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
  <title>Data Akun - Admin Bimbob Printing</title>
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
                    <h3 class="content-header-title">Akun Pengguna</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Akun Pengguna
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body"><!-- Basic Tables start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-content collapse show">
                                <div class="card-body">

                                    <?php
                                    include "../koneksi.php"; // Pastikan file koneksi sudah ada

                                    // Ambil data user yang sebagai admin
                                    $query = mysqli_query($koneksi, "SELECT * FROM akun WHERE sebagai = 'user'");
                                    ?>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Daftar Akun Admin</h4>
    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambah">
        <i class="ft-plus"></i> Tambah Akun
    </button>
</div>

<div class="table-responsive">
    <table id="tableAdmin" class="table table-bordered table-striped mb-0">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
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
                    <td>{$row['nama']}</td>
                    <td>{$row['email']}</td>
                    <td class='text-center'><span class='badge badge-success'>{$row['sebagai']}</span></td>
                    <td class='text-center'>
                        <button class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modalEdit{$row['id']}'><i class='ft-edit'></i></button>
                        <button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#modalHapus{$row['id']}'><i class='ft-trash-2'></i></button>
                    </td>
                </tr>
                ";

                // Modal Edit
                echo "
                <div class='modal fade' id='modalEdit{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='modalEditLabel{$row['id']}' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header bg-warning'>
                                <h5 class='modal-title text-white' id='modalEditLabel{$row['id']}'>Edit Akun Admin</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <form method='POST' action='proses/proses_edit.php'>
                                <div class='modal-body'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <div class='form-group'>
                                        <label>Nama</label>
                                        <input type='text' name='nama' class='form-control' value='{$row['nama']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label>Email</label>
                                        <input type='text' name='email' class='form-control' value='{$row['email']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label>Password (isi jika ingin ubah)</label>
                                        <input type='password' name='password' class='form-control' minlength='6'>
                                         <div class='invalid-feedback'>Kata sandi minimal 6 karakter.</div>
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                                    <button type='submit' class='btn btn-warning'>Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                ";

                // Modal Hapus
                echo "
                <div class='modal fade' id='modalHapus{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='modalHapusLabel{$row['id']}' aria-hidden='true'>
                    <div class='modal-dialog modal-sm' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header bg-danger'>
                                <h5 class='modal-title text-white' id='modalHapusLabel{$row['id']}'>Hapus Akun</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <form method='POST' action='proses/proses_hapus.php'>
                                <div class='modal-body text-center'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <p>Yakin ingin menghapus akun <strong>{$row['nama']}</strong>?</p>
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
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalTambahLabel">Tambah Akun Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="proses/proses_tambah.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                         <div class="invalid-feedback">Kata sandi minimal 6 karakter.</div>
                    </div>
                    <input type="hidden" name="sebagai" value="user">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>


                                </div>
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
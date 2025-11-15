    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>Pesan Product - Bimbob Printing</title>
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



        <main class="main py-5">
            <?php
            include 'koneksi.php';
            // Cek login
            if (!isset($_SESSION['nama'])) {
                echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
                exit;
            }

            // Ambil data produk berdasarkan ID
            $id = $_GET['id'];
            $query = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE id_barang='$id'");
            $produk = mysqli_fetch_assoc($query);

            // Ambil nama customer dari session
            $nama_cust = $_SESSION['nama'];
            $id_cust = $_SESSION['id'];

            // Generate nomor pesanan otomatis (BMB001, BMB002, dst)
            $q_no = mysqli_query($koneksi, "SELECT MAX(no_pesanan) AS last_no FROM data_pemesanan");
            $d_no = mysqli_fetch_assoc($q_no);
            if ($d_no['last_no']) {
                // Ambil angka terakhir dan tambahkan 1
                $lastNumber = (int) substr($d_no['last_no'], 3);
                $nextNumber = $lastNumber + 1;
                $no_pesanan = 'BMB' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            } else {
                // Jika belum ada data, mulai dari BMB001
                $no_pesanan = 'BMB001';
            }

            ?>
            <div class="container">
                <div class="row">

                    <!-- Gambar Produk -->
                    <div class="col-lg-6 text-center">
                        <img src="img/<?php echo $produk['gambar_produk']; ?>"
                            alt="<?php echo $produk['nama_barang']; ?>"
                            class="img-fluid rounded shadow-sm mb-3"
                            style="max-height: 350px; object-fit: contain;"
                            width="500px">
                    </div>

                    <!-- Kalkulator Harga -->
                    <div class="col-lg-6">
                        <h3 class="fw-bold text-primary"><?php echo strtoupper($produk['nama_barang']); ?></h3>
                        <p class="text-muted">(<?php echo $produk['jenis_barang']; ?>)</p>

                        <div class="card p-3 shadow-sm">
                            <h5 class="fw-bold mb-3">Pesan <?php echo $produk['jenis_barang']; ?></h5>
                            <form id="formHitung" action="proses_pesan.php" method="POST" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label>No Pesanan</label>
                                    <input type="text" id="no_pesanan" name="no_pesanan" class="form-control" value="<?= $no_pesanan ?>" readonly>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Nama Customer</label>
                                        <input type="text" id="nama" name="nama" class="form-control" value="<?= $nama_cust ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nomor Telepon</label>
                                        <input type="text" id="telepon" name="telepon" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Tanggal Pemesanan</label>
                                        <input type="date" id="tanggal_pesan" name="tanggal_pesan" class="form-control" value="<?= date('Y-m-d') ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Pengambilan</label>
                                        <input type="date" id="tanggal_ambil" name="tanggal_ambil" class="form-control" required>
                                    </div>
                                </div>

                                <!-- Lebar & Tinggi sejajar -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Lebar (Meter)</label>
                                        <input type="number" id="lebar" name="lebar" class="form-control" value="1" step="1" min="1">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tinggi (Meter)</label>
                                        <input type="number" id="tinggi" name="tinggi" class="form-control" value="1" step="1" min="1">
                                    </div>
                                </div>

                                <!-- Kuantitas -->
                                <div class="mb-3">
                                    <label>Kuantitas</label>
                                    <input type="number" id="qty" name="qty" class="form-control" value="1" min="1">
                                    <small id="minQtyNotice" class="text-danger mt-1 d-none">
                                        *Minimal pembelian untuk produk Print adalah <strong>5</strong> unit.
                                    </small>
                                </div>


                                <div class="mb-3" id="finishingSection">
                                    <label>Finishing</label>
                                    <select name="finishing" id="finishing" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <option value="Mata Ayam">Mata Ayam</option>
                                        <option value="Selongsong">Selongsong</option>
                                    </select>
                                </div>

                                <div class="mb-3" id="LaminasiSection">
                                    <label for="">Laminasi</label>
                                    <select name="laminasi" id="laminasi" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <option value="-">No Laminasi</option>
                                        <option value="Glossy">Glossy</option>
                                        <option value="Doff">Doff</option>
                                    </select>
                                </div>

                                <div class="mb-3" id="cuttingSection">
                                    <label for="">Cutting Stiker</label>
                                    <select name="cutting" id="cutting" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <option value="-">No Cutting</option>
                                        <option value="Kiss Cut/Potong Setengah">Kiss Cut/Potong Setengah</option>
                                        <option value="Die Cut/Potong Putus">Die Cut/Potong Putus</option>
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label>Upload Gambar</label>
                                    <input type="file" id="gambar" name="gambar" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Jenis Pembayaran</label>
                                    <select class="form-select" id="jenis_pembayaran" name="jenis_pembayaran">
                                        <option value="tunai">Tunai</option>
                                        <option value="qris">Qris</option>
                                    </select>
                                </div>


                                <div id="qrisSection" style="display: none;">
                                    <div class="mb-3 text-center">
                                        <img src="img/qris.png" width="50%" height="50%" class="img-fluid">
                                    </div>
                                    <div class="mb-3">
                                        <label>Bukti Pembayaran</label>
                                        <input class="form-control" type="file" name="bukti" id="bukti">
                                    </div>
                                </div>
                                <input type="hidden" name="validasi" value="Menunggu Validasi Admin">
                                <input type="hidden" name="id_cust" value="<?= $id_cust ?>">
                                <input type="hidden" name="nama_barang" value="<?= $produk['nama_barang'] ?>">

                                <p class="fw-bold fs-5">Total:
                                    <span id="totalHarga">Rp<?php echo number_format($produk['harga_barang'], 0, ',', '.'); ?></span>
                                </p>


                                <button type="submit" class="btn btn-danger w-100 mt-2">Pesan Sekarang</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </main>

        <script>
            const hargaSatuan = <?php echo $produk['harga_barang']; ?>;
            const satuan = "<?php echo strtolower(trim($produk['satuan'])); ?>"; // ambil & ubah ke huruf kecil
            const jenisBarang = "<?php echo strtolower(trim($produk['jenis_barang'])); ?>";

            const lebar = document.getElementById('lebar');
            const tinggi = document.getElementById('tinggi');
            const qty = document.getElementById('qty');
            const totalHarga = document.getElementById('totalHarga');
            const jenisPembayaran = document.getElementById('jenis_pembayaran');
            const qrisSection = document.getElementById('qrisSection');

            const finishingSection = document.getElementById('finishingSection');
            const LaminasiSection = document.getElementById('LaminasiSection');
            const cuttingSection = document.getElementById('cuttingSection');

            const laminasi = document.getElementById('laminasi');
            const cutting = document.getElementById('cutting');

            // 🔹 Tampilkan dropdown Finishing hanya jika jenis_barang = Banner
            if (jenisBarang !== 'banner') {
                finishingSection.style.display = 'none';
                document.getElementById('finishing').disabled = true;
            }

            // 🔹 Tampilkan dropdown Laminasi & Cutting hanya jika jenis_barang = Sticker
            if (jenisBarang !== 'sticker') {
                LaminasiSection.style.display = 'none';
                cuttingSection.style.display = 'none';
                laminasi.disabled = true;
                cutting.disabled = true;
            }

            // 🔹 Jika produk bukan per meter → sembunyikan & disable input lebar & tinggi
            if (!satuan.includes('meter')) {
                document.querySelectorAll('#lebar, #tinggi').forEach(el => {
                    el.closest('.col-md-6').style.display = 'none';
                    el.disabled = true;
                    el.value = '';
                });
            }

            // 🔹 Fungsi hitung total harga
            function hitungTotal() {
                let total = 0;

                // --- Hitung harga dasar ---
                if (satuan.includes('meter')) {
                    total = lebar.value * tinggi.value * qty.value * hargaSatuan;
                } else {
                    total = qty.value * hargaSatuan;
                }

                // --- Tambahan harga Laminasi (Glossy / Doff = +3000 per unit) ---
                if (laminasi && (laminasi.value === 'Glossy' || laminasi.value === 'Doff')) {
                    if (satuan.includes('meter')) {
                        total += lebar.value * tinggi.value * qty.value * 3000;
                    } else {
                        total += qty.value * 3000;
                    }
                }

                // --- Tambahan harga Cutting Stiker (apapun pilihannya kecuali “No Cutting”) ---
                if (cutting && cutting.value !== '' && cutting.value !== '-' && cutting.value !== 'No Cutting') {
                    total += 10000; // flat tambahan
                }

                totalHarga.textContent = 'Rp' + total.toLocaleString('id-ID');
            }

            // 🔹 Event listener perubahan input
            [lebar, tinggi, qty, laminasi, cutting].forEach(el => {
                if (el) el.addEventListener('input', hitungTotal);
                if (el) el.addEventListener('change', hitungTotal);
            });

            // 🔹 Tampilkan / sembunyikan QRIS
            jenisPembayaran.addEventListener('change', function() {
                qrisSection.style.display = this.value === 'qris' ? 'block' : 'none';
            });

            // 🔹 Minimal kuantitas 5 jika jenis_barang = Print
            // 🔹 Minimal kuantitas 5 jika jenis_barang = Print
            if (jenisBarang === 'print') {
                qty.min = 5; // batas minimal di form input

                const notice = document.getElementById('minQtyNotice');
                notice.classList.remove('d-none'); // tampilkan teks peringatan

                qty.addEventListener('input', () => {
                    if (qty.value < 5) {
                        qty.value = 5;
                        hitungTotal();
                    }
                });
            }



            // Hitung total awal saat halaman dibuka
            hitungTotal();
        </script>




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
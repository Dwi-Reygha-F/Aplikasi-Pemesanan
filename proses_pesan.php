<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location='login.php';</script>";
    exit;
}

$id_cust          = $_POST['id_cust'];
$no_pesanan       = $_POST['no_pesanan'];
$nama             = $_POST['nama'];
$telepon          = $_POST['telepon'];
$tanggal_pesan    = $_POST['tanggal_pesan'];
$tanggal_ambil    = $_POST['tanggal_ambil'];
$lebar            = isset($_POST['lebar']) ? $_POST['lebar'] : 0;
$tinggi           = isset($_POST['tinggi']) ? $_POST['tinggi'] : 0;
$qty              = $_POST['qty'];
$jenis_pembayaran = $_POST['jenis_pembayaran'];
$validasi         = $_POST['validasi'];
$nama_barang      = $_POST['nama_barang'];


// Ambil data barang untuk harga satuan
$query_barang = mysqli_query($koneksi, "SELECT * FROM data_barang WHERE nama_barang='$nama_barang'");
$barang = mysqli_fetch_assoc($query_barang);


if (!$barang) {
    echo "<script>alert('Produk tidak ditemukan!'); window.history.back();</script>";
    exit;
}

$harga_satuan = $barang['harga_barang'];
$satuan       = strtolower(trim($barang['satuan']));

// Hitung total harga
if (strpos($satuan, 'meter') !== false) {
    $total_harga = $lebar * $tinggi * $qty * $harga_satuan;
} else {
    $total_harga = $qty * $harga_satuan;
}

// Upload gambar desain
$gambar = '';
if (!empty($_FILES['gambar']['name'])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) mkdir($target_dir);
    $gambar = $no_pesanan . "_" . basename($_FILES["gambar"]["name"]);
    $target_file = $target_dir . $gambar;
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
}

// Upload bukti pembayaran (kalau qris)
$bukti = '';
if ($jenis_pembayaran == 'qris' && !empty($_FILES['bukti']['name'])) {
    $target_dir = "bukti_pembayaran/";
    if (!is_dir($target_dir)) mkdir($target_dir);
    $bukti = "bukti_" . $no_pesanan . "_" . basename($_FILES["bukti"]["name"]);
    $target_file = $target_dir . $bukti;
    move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file);
}

// Simpan ke tabel data_pemesanan
$sql = "INSERT INTO data_pemesanan 
        (id_cust, no_pesanan, nama_cust, no_telp, tanggal_pemesanan, tanggal_pengambilan, nama_barang, lebar, tinggi, jumlah_barang, total_harga, jenis_pembayaran, desain_cetak, bukti_pembayaran, validasi)
        VALUES 
        ('$id_cust', '$no_pesanan', '$nama', '$telepon', '$tanggal_pesan', '$tanggal_ambil', '$nama_barang', '$lebar', '$tinggi', '$qty', '$total_harga', '$jenis_pembayaran', '$gambar', '$bukti', '$validasi')";


if (mysqli_query($koneksi, $sql)) {
    echo "<script>
        alert('Pesanan berhasil dibuat!\\nNomor Pesanan: $no_pesanan');
        window.location='history.php';
    </script>";
} else {
    echo "<script>
        alert('Terjadi kesalahan: " . mysqli_error($koneksi) . "');
        window.history.back();
    </script>";
}
?>

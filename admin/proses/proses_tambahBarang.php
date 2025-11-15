<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $jenis_barang = mysqli_real_escape_string($koneksi, $_POST['jenis_barang']);
    $harga_barang = mysqli_real_escape_string($koneksi, $_POST['harga_barang']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    // Upload gambar
    $gambar_produk = '';
    if (!empty($_FILES['gambar_produk']['name'])) {
        $target_dir = "../../img/";
        $gambar_produk = time() . '_' . basename($_FILES['gambar_produk']['name']);
        $target_file = $target_dir . $gambar_produk;

        move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file);
    }
    $query = "INSERT INTO data_barang (nama_barang, jenis_barang, harga_barang, satuan, gambar_produk)
              VALUES ('$nama_barang', '$jenis_barang', '$harga_barang', '$satuan', '$gambar_produk')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Barang berhasil ditambahkan!'); window.location='../dataProduct.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan barang!'); window.location='../dataProduct.php';</script>";
    }
}
?>

<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    // Hapus gambar dari folder
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar_produk FROM data_barang WHERE id_barang='$id_barang'"));
    $gambar = $data['gambar_produk'];

    if ($gambar && file_exists("../../img/" . $gambar)) {
        unlink("../../img/" . $gambar);
    }
    // Hapus data dari database
    $query = "DELETE FROM data_barang WHERE id_barang='$id_barang'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Barang berhasil dihapus!'); window.location='../dataProduct.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus barang!'); window.location='../dataProduct.php';</script>";
    }
}
?>

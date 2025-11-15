<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_barang = $_POST['id_barang'];
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $jenis_barang = mysqli_real_escape_string($koneksi, $_POST['jenis_barang']);
    $harga_barang = mysqli_real_escape_string($koneksi, $_POST['harga_barang']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    // Ambil data lama
    $dataLama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar_produk FROM data_barang WHERE id_barang='$id_barang'"));
    $gambar_lama = $dataLama['gambar_produk'];
    // Cek jika user upload gambar baru
    if (!empty($_FILES['gambar_produk']['name'])) {
        $target_dir = "../../img/";
        $gambar_produk = time() . '_' . basename($_FILES['gambar_produk']['name']);
        $target_file = $target_dir . $gambar_produk;

        // Hapus gambar lama jika ada
        if (file_exists($target_dir . $gambar_lama) && $gambar_lama != '') {
            unlink($target_dir . $gambar_lama);
        }
        move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $target_file);
    } else {
        $gambar_produk = $gambar_lama; // tetap pakai gambar lama
    }
    $query = "UPDATE data_barang SET 
                nama_barang='$nama_barang',
                jenis_barang='$jenis_barang',
                harga_barang='$harga_barang',
                satuan='$satuan',
                gambar_produk='$gambar_produk'
              WHERE id_barang='$id_barang'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data barang berhasil diupdate!'); window.location='../dataProduct.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data!'); window.location='../dataProduct.php';</script>";
    }
}
?>

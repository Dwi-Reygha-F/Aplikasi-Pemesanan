<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $validasi = mysqli_real_escape_string($koneksi, $_POST['validasi']);

  $query = "UPDATE data_pemesanan SET validasi='$validasi' WHERE id='$id'";

  if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Status validasi berhasil diperbarui!'); window.location='../dataPemesanan.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui status!'); window.location='../dataPemesanan.php';</script>";
  }
}
?>

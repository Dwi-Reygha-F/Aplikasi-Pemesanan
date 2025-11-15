<?php
session_start();
include 'koneksi.php';

$user_id = $_SESSION['id'] ?? null;
$produk_id = $_POST['produk_id'];
$rating = $_POST['rating'];

if (!$user_id) {
  echo "<script>alert('Silakan login untuk memberi rating'); window.location='login.php';</script>";
  exit;
}

$cek = mysqli_query($koneksi, "SELECT * FROM rating WHERE user_id='$user_id' AND produk_id='$produk_id'");
if (mysqli_num_rows($cek) > 0) {
  echo "<script>alert('Anda sudah memberi rating untuk produk ini!'); window.location='index.php';</script>";
} else {
  mysqli_query($koneksi, "INSERT INTO rating (user_id, produk_id, rating) VALUES ('$user_id','$produk_id','$rating')");
  echo "<script>alert('Terima kasih atas rating Anda!'); window.location='index.php';</script>";
}
?>

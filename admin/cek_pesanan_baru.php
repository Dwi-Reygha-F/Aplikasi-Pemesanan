<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

// Cek jumlah pesanan baru yang belum diambil
$query = "SELECT COUNT(*) AS total_baru 
          FROM data_pemesanan 
          WHERE validasi = 'Menunggu Validasi Admin'";
$result = mysqli_query($koneksi, $query);

$row = mysqli_fetch_assoc($result);
$total_baru = $row['total_baru'] ?? 0;

echo json_encode(['new_order' => $total_baru]);
?>

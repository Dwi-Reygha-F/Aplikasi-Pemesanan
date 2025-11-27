<?php
session_start();
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

// Ambil user_id dari session (sesuaikan dengan login system Anda)
$user_id = $_SESSION['user_id'] ?? 0;

// Cek pesanan user ini yang statusnya siap diambil
$query = "SELECT COUNT(*) AS total_baru 
          FROM data_pemesanan 
          WHERE id_user = ? AND validasi = 'Pesanan Siap Di Ambil'";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
$total_baru = $row['total_baru'] ?? 0;

echo json_encode(['new_order' => $total_baru]);
?>
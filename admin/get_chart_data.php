<?php
// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Buat log file kalau ada error
function logError($message) {
    $logFile = __DIR__ . '/chart_error_log.txt';
    file_put_contents($logFile, "[" . date('Y-m-d H:i:s') . "] " . $message . "\n", FILE_APPEND);
}

include '../koneksi.php'; // pastikan path koneksi benar

// Hitung jumlah pesanan per jenis barang (bukan jumlah_barang)
$query = "
    SELECT b.jenis_barang, COUNT(p.id_cust) AS total_pesanan
    FROM data_pemesanan p
    JOIN data_barang b ON p.nama_barang = b.nama_barang
    WHERE p.validasi = 'Pesanan Sudah Di Ambil'
    GROUP BY b.jenis_barang
";

$result = $koneksi->query($query);

// Cek error query
if (!$result) {
    $errorMsg = "Query gagal: " . $koneksi->error;
    logError($errorMsg);
    echo json_encode(["error" => $errorMsg]);
    exit;
}

// Cek kalau data kosong
if ($result->num_rows == 0) {
    logError("Tidak ada data ditemukan untuk chart penjualan.");
    echo json_encode([]);
    exit;
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

// Tutup koneksi
$koneksi->close();
?>

<?php
include "../../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $validasi = mysqli_real_escape_string($koneksi, $_POST['validasi']);

  // Ambil data pesanan untuk kebutuhan WA
  $q = mysqli_query($koneksi, "SELECT * FROM data_pemesanan WHERE id='$id'");
  $data = mysqli_fetch_assoc($q);

  if (!$data) {
    echo "<script>alert('Data pesanan tidak ditemukan!'); window.location='../dataPemesanan.php';</script>";
    exit;
  }

  $nama     = $data['nama_cust'];
  $telepon  = $data['no_telp'];
  $barang   = $data['nama_barang'];
  $lebar    = $data['lebar'];
  $tinggi   = $data['tinggi'];
  $qty      = $data['jumlah_barang'];
  $total    = $data['total_harga'];
  $ambil    = $data['tanggal_pengambilan'];
  $no_pesan = $data['no_pesanan'];

  // UPDATE STATUS
  $query = "UPDATE data_pemesanan SET validasi='$validasi' WHERE id='$id'";

  if (mysqli_query($koneksi, $query)) {

    // ======================
    //   KIRIM WA OTOMATIS
    // ======================
    $token = "GsJsEp2drBnGtEpQvb7F"; // GANTI DENGAN TOKEN FONNTE

    // Pesan sesuai validasi
    if ($validasi == "Pesanan Siap Di Ambil") {

      $pesan = "
📢 *Pemberitahuan Pesanan*

Halo *$nama*,
Pesanan Anda sudah *SIAP DIAMBIL*.

🧾 *Detail Pesanan:*
No Pesanan : $no_pesan
Barang     : $barang
Jumlah     : $qty
Tanggal Ambil : $ambil

Silakan datang ke toko untuk mengambil pesanan Anda 🙏
";
    } elseif ($validasi == "Pesanan Sudah Di Ambil") {

      $pesan = "
📄 *NOTA PESANAN – SUDAH DIAMBIL*
────────────────────────
No Pesanan : $no_pesan
Nama       : $nama
Barang     : $barang
Ukuran     : {$lebar} x {$tinggi}
Jumlah     : $qty
Total      : Rp " . number_format($total, 0, ',', '.') . "
Tanggal Pengambilan : $ambil
────────────────────────
Terima kasih sudah berbelanja 🙏
";
    } else {
      $pesan = ""; // Tidak mengirim WA jika status lain
    }

    // Kirim WA jika ada pesan
    if ($pesan != "") {

      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.fonnte.com/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => array(
          "target" => $telepon,
          "message" => $pesan,
        ),
        CURLOPT_HTTPHEADER => array(
          "Authorization: $token"
        ),
      ));

      $response = curl_exec($curl);
      curl_close($curl);
    }

    // Redirect success
    echo "<script>alert('Status validasi berhasil diperbarui!'); window.location='../dataPemesanan.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui status!'); window.location='../dataPemesanan.php';</script>";
  }
}

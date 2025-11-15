<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama']);
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);
  $sebagai = trim($_POST['sebagai']);

  $nama = mysqli_real_escape_string($koneksi, $nama);
  $email = mysqli_real_escape_string($koneksi, $email);
  $password = mysqli_real_escape_string($koneksi, $password);

  $cekEmail = mysqli_query($koneksi, "SELECT * FROM akun WHERE email='$email'");
  
  echo "<!doctype html><html><head>
        <meta charset='utf-8'>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head><body>";

  if (mysqli_num_rows($cekEmail) > 0) {
    echo "<script>
      Swal.fire({
        title: 'Email Sudah Terdaftar!',
        text: 'Silakan gunakan email lain atau login.',
        icon: 'warning',
        confirmButtonColor: '#b71c1c'
      }).then(() => {
        window.location.href = 'register.php';
      });
    </script>";
  } else {
    $query = "INSERT INTO akun (nama, email, password, sebagai) VALUES ('$nama', '$email', '$password', '$sebagai')";
    if (mysqli_query($koneksi, $query)) {
      echo "<script>
        Swal.fire({
          title: 'Berhasil!',
          text: 'Pendaftaran berhasil. Silakan login sekarang.',
          icon: 'success',
          confirmButtonColor: '#b71c1c'
        }).then(() => {
          window.location.href = 'login.php';
        });
      </script>";
    } else {
      echo "<script>
        Swal.fire({
          title: 'Gagal!',
          text: 'Terjadi kesalahan saat menyimpan data.',
          icon: 'error',
          confirmButtonColor: '#b71c1c'
        }).then(() => {
          window.location.href = 'register.php';
        });
      </script>";
    }
  }

  echo "</body></html>";
} else {
  header("Location: register.php");
  exit;
}
?>

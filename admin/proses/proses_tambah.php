<?php
include "../../koneksi.php";

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$sebagai = $_POST['sebagai'];

mysqli_query($koneksi, "INSERT INTO akun (nama, email, password, sebagai) VALUES ('$nama', '$email', '$password', '$sebagai')");
header("Location: ../akun.php");
?>

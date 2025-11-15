<?php
include "../../koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($password)) {
    mysqli_query($koneksi, "UPDATE akun SET nama='$nama', email='$email', password='$password' WHERE id='$id'");
} else {
    mysqli_query($koneksi, "UPDATE akun SET nama='$nama', email='$email' WHERE id='$id'");
}

header("Location: ../akun.php");
?>

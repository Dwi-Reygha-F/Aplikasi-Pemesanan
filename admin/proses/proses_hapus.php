<?php
include "../../koneksi.php";

$id = $_POST['id'];
mysqli_query($koneksi, "DELETE FROM akun WHERE id='$id'");
header("Location: ../akun.php");
?>

<?php
session_start();
include 'koneksi.php';

// Pastikan method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($email === '' || $password === '') {
    echo "<script>alert('Email dan password wajib diisi'); window.location.href = 'login.php';</script>";
    exit;
}

// Query akun
$query = "SELECT id, nama, email, password, sebagai FROM akun WHERE email = ? LIMIT 1";
if ($stmt = mysqli_prepare($koneksi, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $nama, $db_email, $db_password, $sebagai);
    $found = mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if ($found) {
        // Login berhasil (tanpa hash)
        if ($password === $db_password) {
            session_regenerate_id(true);
            $_SESSION['id'] = $id;
            $_SESSION['nama'] = $nama;
            $_SESSION['email'] = $db_email;
            $_SESSION['sebagai'] = $sebagai;

            // Tentukan arah redirect
            if ($sebagai === 'cust') {
                echo "<script>window.location.href = 'index.php';</script>";
                exit;
            } elseif ($sebagai === 'user') {
                echo "<script>window.location.href = 'admin/index.php';</script>";
                exit;
            } else {
                echo "<script>alert('Role tidak dikenali'); window.location.href = 'login.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Email atau password salah'); window.location.href = 'login.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Email tidak ditemukan'); window.location.href = 'login.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Terjadi kesalahan server'); window.location.href = 'login.php';</script>";
    exit;
}
?>

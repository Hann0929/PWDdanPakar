<?php
session_start();
include "db/koneksi.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);
    
    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role'];

    // LOGIKA PENGALIHAN PINTAR:
    // 1. Cek apakah ada permintaan halaman tertentu (seperti diagnosa.php)
    if (isset($_SESSION['redirect_after_login'])) {
        $destination = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']); // Hapus agar tidak tersimpan terus
        header("Location: " . $destination);
    } 
    // 2. Jika tidak ada, baru cek Role
    else if ($data['role'] == 'admin') {
        header("Location: dashboard-admin.php");
    } else {
        header("Location: beranda.php");
    }
} else {
    header("Location: login.php?error=1");
}
?>
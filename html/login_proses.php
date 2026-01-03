<?php
session_start();
include "db/koneksi.php"; // Pastikan path ke file koneksi benar

$username = $_POST['username'];
$password = $_POST['password'];

// Menggunakan variabel $conn dari file koneksi kamu
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    $_SESSION['username'] = $data['username'];
    $_SESSION['role'] = $data['role']; 
    $_SESSION['status'] = "login";

    // Arahkan berdasarkan role yang ada di database
    if ($data['role'] == "admin") {
        header("location: dashboard-admin.php"); 
    } else {
        header("location: diagnosa.php");
    }
} else {
    header("location: login.php?error=1");
}
?>
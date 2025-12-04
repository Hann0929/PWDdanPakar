<?php
// KONFIGURASI DATABASE
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data_mlbb"; // GANTI dengan nama database kamu

// MEMBUAT KONEKSI
$conn = mysqli_connect($host, $user, $pass, $db);

// CEK KONEKSI
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

<?php
session_start();
include "db/koneksi.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') { exit; }

$proses = $_REQUEST['proses'] ?? '';

if ($proses == 'tambah') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_hero']);
    $gambar = mysqli_real_escape_string($conn, $_POST['gambar_hero']);
    mysqli_query($conn, "INSERT INTO hero (name, image) VALUES ('$nama', '$gambar')");
    header("Location: dashboard-admin.php");
}

if ($proses == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM hero WHERE hero_id = '$id'");
    header("Location: dashboard-admin.php");
}

if ($proses == 'edit') {
    $id = $_POST['hero_id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_hero']);
    $gambar = mysqli_real_escape_string($conn, $_POST['gambar_hero']);
    mysqli_query($conn, "UPDATE hero SET name='$nama', image='$gambar' WHERE hero_id='$id'");
    header("Location: dashboard-admin.php");
}
?>
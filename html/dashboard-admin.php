<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>

<h2>Dashboard Admin</h2>
<p>Login sebagai: <?= $_SESSION['username']; ?></p>

<ul>
    <li>Tambah Hero</li>
    <li>Edit Hero</li>
    <li>Hapus Hero</li>
</ul>

<a href="logout.php">Logout</a>

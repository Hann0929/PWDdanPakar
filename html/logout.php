<?php
session_start();
session_destroy(); // Menghapus data login pemain1 atau admin
header("Location: beranda.php"); // Diarahkan ke beranda sesuai keinginanmu
exit;
?>
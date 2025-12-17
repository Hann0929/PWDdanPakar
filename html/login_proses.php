<?php
session_start();
include "db/koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$username' AND password='$password'"
);

if (mysqli_num_rows($query) > 0) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    header("Location: beranda.php");
} else {
    header("Location: login.php?error=1");
}

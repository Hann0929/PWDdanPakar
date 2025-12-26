<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == '1' || $_GET['error'] == 'user') {
        echo "<p style='color:red'>Username atau Password salah</p>";
    } elseif ($_GET['error'] == 'kosong') {
        echo "<p style='color:red'>Username / Password kosong</p>";
    }
}
?>

<form method="POST" action="login_proses.php">
    <input type="text" name="username" placeholder="Username" required>
    <br><br>
    <input type="password" name="password" placeholder="Password" required>
    <br><br>
    <button type="submit">Login</button>
</form>

</body>
</html>

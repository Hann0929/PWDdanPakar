<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MyHERO</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="login-box">
    <h2>✦ MyHERO</h2>
    <p>Masuk untuk diagnosa hero</p>

    <?php
    if (isset($_GET['error'])) {
        echo "<div class='error'>Username atau Password salah!</div>";
    }
    ?>

    <form method="POST" action="login_proses.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">LOGIN</button>
    </form>
</div>

</body>
</html>
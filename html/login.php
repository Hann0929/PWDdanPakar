<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | MyHero</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="login-box">
    <h2>MyHero Login</h2>

    <form action="login_proses.php" method="POST" onsubmit="return validasi()">
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="password" id="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>

    <?php if(isset($_GET['error'])): ?>
        <p class="error">Username atau Password salah!</p>
    <?php endif; ?>
</div>

<script src="../js/login.js"></script>
</body>
</html>

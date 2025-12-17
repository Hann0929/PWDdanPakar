<?php
require_once "db/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Information</title>

    <link rel="stylesheet" href="../css/list-hero.css">
</head>

<body>

<header class="navbar">
    <div class="nav-container">

        <div class="nav-logo">
            <span class="logo-icon">✦</span>
            <span class="logo-text">My<span>HERO</span></span>
        </div>

        <nav class="nav-menu">
            <a href="beranda.php">BERANDA</a>
            <a href="list-hero.php" class="active">HERO</a>
            <a href="diagnosa.php">DIAGNOSA</a>
        </nav>

        <a href="login.php" class="login-btn">LOGIN</a>

    </div>
</header>

<section class="list-header">
    <h1>Selamat Datang di List Hero</h1>
    <p>Pilih dan kenali hero Mobile Legends favoritmu</p>
</section>

<section class="hero-grid">

<?php
$query = mysqli_query($conn, "SELECT * FROM hero");

if (!$query) {
    echo "<pre>SQL ERROR:\n" . mysqli_error($conn) . "</pre>";
    die();
}

while ($hero = mysqli_fetch_assoc($query)) {

    if (
        empty($hero['image']) ||
        !file_exists("../assets/hero/" . $hero['image'])
    ) {
        continue;
    }
?>
    <div class="hero-card">

        <div class="hero-img-wrapper">
            <img
                src="../assets/hero/<?php echo $hero['image']; ?>"
                alt="<?php echo $hero['name']; ?>"
                class="hero-img"
            >
        </div>

        <h3><?php echo $hero['name']; ?></h3>
        <p>Main Role: <?php echo $hero['main_role']; ?></p>
        <p>Sub Role: <?php echo $hero['sub_role']; ?></p>

    </div>
<?php
}
?>

</section>
</body>
</html>

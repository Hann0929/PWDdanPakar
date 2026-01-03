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
    // 1. Perbaikan Path Gambar: Jika file tidak ada, pakai gambar default
    $image_name = !empty($hero['image']) ? $hero['image'] : 'default.png';
    $image_path = "../assets/hero/" . $image_name;
    
    // Jika file fisik tidak ada di folder, arahkan ke default
    if (!file_exists($image_path)) {
        $image_path = "../assets/hero/default.png";
    }
?>
    <div class="hero-card">
        <div class="hero-img-wrapper">
            <img 
                src="<?php echo $image_path; ?>" 
                alt="<?php echo htmlspecialchars($hero['name']); ?>" 
                class="hero-img"
            >
        </div>

        <h3><?php echo htmlspecialchars($hero['name']); ?></h3>
        
        <p>Main Role: <?php echo isset($hero['main_role']) ? $hero['main_role'] : '-'; ?></p>
        <p>Sub Role: <?php echo isset($hero['sub_role']) ? $hero['sub_role'] : '-'; ?></p>

        <div style="font-size: 11px; color: #ff4fd8; margin-top: 10px;">
            PA: <?php echo $hero['physical_attack'] ?? '0'; ?> | 
            Dur: <?php echo $hero['durability'] ?? '0'; ?>
        </div>
    </div>
<?php
}
?>
</section>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['diagnosa'])) {
    header("Location: diagnosa.php");
    exit;
}

$finalDiagnosis   = $_SESSION['diagnosa'];
$validFacts       = $_SESSION['jawaban'];

$recommendedHeroes = $finalDiagnosis['final_hero_recommendation'] ?? [];
$triggeredRules    = $finalDiagnosis['triggered_rules'] ?? [];

$triggerRuleList = empty($triggeredRules) ? 'Tidak ada' : implode(", ", $triggeredRules);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosa - MyHERO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/diagnosa.css">
    <link rel="stylesheet" href="../css/hasil.css">
    
</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">✦ MyHERO</div>
        <ul class="nav-menu">
            <li><a href="beranda.php">BERANDA</a></li>
            <li><a href="diagnosa.php">DIAGNOSA</a></li>
            <li><a href="list-hero.php">LIST HERO</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="dashboard-admin.php" class="nav-admin">KELOLA HERO</a></li>
            <?php endif; ?>
        </ul>
        <a href="logout.php" class="nav-login">LOGOUT</a>
    </div>
</nav>

<div class="result-container">
    <h1 style="text-align: center; color: #ff4fd8; margin-bottom: 30px;">HASIL DIAGNOSA</h1>

    <div class="box">
        <h3>Aturan Terpicu</h3>
        <p style="color: #ccc;"><?= $triggerRuleList ?></p>
    </div>

    <div class="box" style="margin-top:20px;">
        <h3>Rekomendasi Hero Untukmu</h3>
        <div class="hero-grid">
            <?php if (!empty($recommendedHeroes)): ?>
                <?php foreach ($recommendedHeroes as $hero): ?>
                    <div class="hero-card">
                        <?php $imgName = !empty($hero['image']) ? $hero['image'] : 'default.png'; ?>
                        <img src="../assets/hero/<?= $imgName ?>" alt="<?= $hero['name'] ?>" onerror="this.src='../assets/hero/default.png';">
                        <div class="hero-name"><?= $hero['name'] ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Maaf, tidak ada hero yang cocok dengan kriteria kamu.</p>
            <?php endif; ?>
        </div>
    </div>

    <div style="text-align: center; margin-top: 40px;">
        <a href="diagnosa.php" class="nav-login">← ULANGI DIAGNOSA</a>
    </div>
</div>

</body>
</html>
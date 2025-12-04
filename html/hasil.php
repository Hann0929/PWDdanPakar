<?php
session_start();

if (!isset($_SESSION['diagnosa'])) {
    header("Location: diagnosa.php");
    exit;
}

$finalDiagnosis   = $_SESSION['diagnosa'];
$validFacts       = $_SESSION['jawaban'];

$recommendedHeroes = $finalDiagnosis['final_hero_recommendation'] ?? [];
$triggeredRules    = $finalDiagnosis['triggered_rules'] ?? [];

$heroList = empty($recommendedHeroes)
    ? 'Tidak ada hero yang direkomendasikan.'
    : implode(" / ", $recommendedHeroes);

$triggerRuleList = empty($triggeredRules)
    ? 'Tidak ada'
    : implode(", ", $triggeredRules);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Hasil Diagnosa</title>
<link rel="stylesheet" href="../css/hasil.css">
</head>

<body>

<div class="container">

    <h1>Hasil Diagnosa Hero MLBB</h1>

    <div class="result-card">

        <div class="grid">

            <!-- KOLOM 1 — HERO -->
            <div class="box">
                <h3>Rekomendasi Hero</h3>
                <p class="hero-list"><?= $heroList ?></p>
            </div>

            <!-- KOLOM 2 — ATURAN -->
            <div class="box">
                <h3>Aturan Terpicu</h3>
                <p class="rules"><?= $triggerRuleList ?></p>
            </div>

            <!-- KOLOM 3 — JAWABAN -->
            <div class="box">
                <h3>Jawaban Anda</h3>
                <pre class="facts"><?php print_r($validFacts); ?></pre>
            </div>

        </div>

        <!-- FAKTA LENGKAP -->
        <div class="box" style="margin-top:25px;">
            <h3>Fakta Sistem Lengkap</h3>
            <pre class="facts"><?php print_r($finalDiagnosis); ?></pre>
        </div>

    </div>

    <a href="diagnosa.php" class="back-btn">← Kembali ke Diagnosa</a>

</div>

</body>
</html>

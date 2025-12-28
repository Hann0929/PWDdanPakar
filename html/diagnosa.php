<?php
session_start();
include "db/koneksi.php";

if (!isset($_SESSION['username'])) {
    $_SESSION['redirect_after_login'] = 'diagnosa.php';
    header("Location: login.php");
    exit;
}

$koneksi = $conn;

$query = "SELECT gejala_id, pertanyaan, attribute_key FROM gejala ORDER BY gejala_id ASC";
$result = mysqli_query($koneksi, $query);

$questions = [];

while ($row = mysqli_fetch_assoc($result)) {
    $key = $row['attribute_key'];

    if (strpos($key, 'low') !== false || strpos($key, 'high') !== false) {
        $options = ["yes", "no"];
    } elseif ($key == 'preferred_role') {
        $options = ["ranged", "melee"];
    } elseif ($key == 'team_needs' || $key == 'team_needs_role') {
        $options = [
            "crowd_control",
            "burst_damage",
            "anti_tank",
            "mid_lane",
            "exp_lane",
            "roamer"
        ];
    } else {
        $options = ["yes", "no", "low", "medium", "high"];
    }

    $questions[] = [
        "key" => $key,
        "question" => $row['pertanyaan'],
        "options" => $options
    ];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Diagnosa Hero MLBB</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/diagnosa.css">

</head>
<body>

<nav class="navbar">
    <div class="nav-container">
        <div class="nav-logo">✦ MyHERO</div>
        <ul class="nav-menu">
            <li><a href="beranda.php">BERANDA</a></li>
            <li><a href="diagnosa.php" class="active">DIAGNOSA</a></li>
            <li><a href="list-hero.php">LIST HERO</a></li>
            
            
                <li><a href="dashboard-admin.php" class="nav-admin">KELOLA HERO</a></li>
           
        </ul>
        <a href="logout.php" class="nav-login">LOGOUT</a>
    </div>
</nav>

<div class="container">
    <div class="quiz-card">
        <div class="progress" id="progress"></div>
        <h2 id="questionText"></h2>
        <div id="answerBox"></div>

        <form id="diagnosaForm" method="POST" action="proses.php">
            <input type="hidden" name="jawaban" id="jawabanInput">
        </form>
    </div>

    <div class="character-box">
        <img src="../assets/fanny.png" alt="Karakter">
    </div>
</div>

<script>
    const QUESTIONS_DATA = <?= json_encode($questions); ?>;
</script>
<script src="../js/diagnosa.js"></script>

</body>
</html>
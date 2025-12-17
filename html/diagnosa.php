<?php
include "db/koneksi.php";
$koneksi = $conn;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosa Hero MLBB</title>
    <link rel="stylesheet" href="../css/diagnosa.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-container">

        <div class="nav-logo">
            <span class="logo-icon">✦</span>
            <span class="logo-text">MyHERO</span>
        </div>

        <ul class="nav-menu">
            <li><a href="beranda.php">BERANDA</a></li>
            <li><a href="informasi.php">INFORMASI</a></li>
            <li><a href="diagnosa.php" class="active">DIAGNOSA</a></li>
            <li><a href="list-hero.php">LIST HERO</a></li>
        </ul>

        <a href="../login.php" class="nav-login">LOGIN</a>
    </div>
</nav>

<div class="container">

    <div class="question-section">

        <p class="question-number">DIAGNOSE</p>
        <h2 class="question-title">Jawablah pertanyaan berikut untuk mendapatkan rekomendasi hero terbaik untuk Anda.</h2>

        <form method="POST" action="proses.php">

        <?php
        $query_gejala = "SELECT gejala_id, pertanyaan, attribute_key FROM gejala ORDER BY gejala_id ASC";
        $result_gejala = mysqli_query($koneksi, $query_gejala);

        if (!$result_gejala) {
            die("Query Gagal: " . mysqli_error($koneksi));
        }

        while ($row = mysqli_fetch_assoc($result_gejala)) {
            $pertanyaan = $row['pertanyaan'];
            $key = $row['attribute_key'];

            if (strpos($key, 'low') !== false || strpos($key, 'high') !== false) {
                $options = ["yes", "no"];
            } 
            elseif ($key == 'preferred_role') {
                $options = ["ranged", "melee"];
            } 
            elseif ($key == 'team_needs' || $key == 'team_needs_role') {
                $options = ["crowd_control", "burst_damage", "anti_tank", "mid_lane", "exp_lane", "roamer"];
            } 
            else {
                $options = ["yes", "no", "low", "medium", "high"];
            }
        ?>

            <div class="box">
                <p class="question-text"><b><?= $pertanyaan ?></b></p>

                <select name="jawaban[<?= $key ?>]" class="select" required>
                    <option value="">-- pilih jawaban --</option>

                    <?php foreach ($options as $op): ?>
                        <option value="<?= $op ?>"><?= $op ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        <?php } ?>

            <button type="submit" class="btn">Proses Diagnosa</button>
        </form>

        <div class="nav-dots">
            <div class="active"></div>
            <div></div>
            <div></div>
        </div>

    </div>

    <!-- RIGHT SIDE IMAGE -->
    <div class="character-box">
        <img src="../assets/fanny.png" alt="Karakter">
    </div>

</div>
</body>
</html>

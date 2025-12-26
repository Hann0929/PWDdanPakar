<?php
session_start();
include "db/koneksi.php";

if (!isset($_POST['jawaban'])) {
    header("Location: diagnosa.php");
    exit;
}

$jawaban = $_POST['jawaban'];
$_SESSION['jawaban'] = $jawaban;

$triggeredRules = [];
$recommendedHeroes = [];

// Ambil semua rule
$ruleBase = mysqli_query($conn, "SELECT rule_id FROM rule_base");

while ($rule = mysqli_fetch_assoc($ruleBase)) {
    $rule_id = $rule['rule_id'];

    // Ambil kondisi rule
    $conditions = mysqli_query($conn, "
        SELECT rc.gejala_id, rc.expected_value, g.attribute_key
        FROM rule_condition rc
        JOIN gejala g ON rc.gejala_id = g.gejala_id
        WHERE rc.rule_id = '$rule_id'
    ");

    $ruleMatch = true;

    while ($cond = mysqli_fetch_assoc($conditions)) {
        $key = $cond['attribute_key'];
        $expected = $cond['expected_value'];

        if (!isset($jawaban[$key]) || $jawaban[$key] != $expected) {
            $ruleMatch = false;
            break;
        }
    }

    // Jika rule terpenuhi
    if ($ruleMatch) {
        $triggeredRules[] = $rule_id;

        // Ambil hero dari conclusion
        $conclusions = mysqli_query($conn, "
            SELECT h.name
            FROM rule_conclusion rc
            JOIN hero h ON rc.hero_id = h.hero_id
            WHERE rc.rule_id = '$rule_id'

        ");

        while ($h = mysqli_fetch_assoc($conclusions)) {
            $recommendedHeroes[] = $h['name'];

        }
    }
}

// Simpan hasil ke session
$_SESSION['diagnosa'] = [
    'triggered_rules' => $triggeredRules,
    'final_hero_recommendation' => array_unique($recommendedHeroes)
];

header("Location: hasil.php");
exit;

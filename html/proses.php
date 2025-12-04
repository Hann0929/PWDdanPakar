<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db/koneksi.php";

if (!isset($conn) || mysqli_connect_errno()) {
    die("ERROR: Koneksi database gagal.");
}

function getRulesFromDatabase($conn): array {
    $rules = [];

    $sql_conditions = "
        SELECT rb.rule_id, g.attribute_key, rc.expected_value
        FROM rule_base rb
        JOIN rule_condition rc ON rb.rule_id = rc.rule_id
        JOIN gejala g ON rc.gejala_id = g.gejala_id
        ORDER BY rb.rule_id;
    ";

    $result_conditions = mysqli_query($conn, $sql_conditions);

    while ($row = mysqli_fetch_assoc($result_conditions)) {
        if (!isset($rules[$row['rule_id']])) {
            $rules[$row['rule_id']] = ['conditions' => [], 'conclusions' => []];
        }
        $rules[$row['rule_id']]['conditions'][] = [
            'attribute_key' => $row['attribute_key'],
            'expected_value' => $row['expected_value']
        ];
    }

    $sql_conclusions = "
        SELECT rc.rule_id, h.name AS hero_name
        FROM rule_conclusion rc
        JOIN hero h ON rc.hero_id = h.hero_id
        ORDER BY rc.rule_id;
    ";

    $result_conclusions = mysqli_query($conn, $sql_conclusions);

    while ($row = mysqli_fetch_assoc($result_conclusions)) {
        $rules[$row['rule_id']]['conclusions'][] = [
            'hero_name' => $row['hero_name']
        ];
    }
    return $rules;
}

function forwardChain(array $facts, $conn): array {

    $rules = getRulesFromDatabase($conn);
    $currentFacts = $facts;
    $firedRules = [];
    $newFactsAdded = true;

    while ($newFactsAdded) {
        $newFactsAdded = false;

        foreach ($rules as $ruleId => $rule) {

            if (in_array($ruleId, $firedRules))
                continue;

            $conditionsMet = true;

            foreach ($rule['conditions'] as $condition) {
                $factKey = $condition['attribute_key'];
                $requiredValue = $condition['expected_value'];

                if (!isset($currentFacts[$factKey]) || $currentFacts[$factKey] !== $requiredValue) {
                    $conditionsMet = false;
                    break;
                }
            }

            if ($conditionsMet) {
                foreach ($rule['conclusions'] as $conclusion) {
                    $heroName = $conclusion['hero_name'];

                    $currentFacts['final_hero_recommendation'][] = $heroName;
                }

                $firedRules[] = $ruleId;
                $newFactsAdded = true;
            }
        }
    }

    $currentFacts['triggered_rules'] = $firedRules;
    return $currentFacts;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jawaban'])) {

    $input = $_POST['jawaban'];
    $validFacts = [];

    foreach ($input as $key => $value) {
        if (!empty($value) && $value !== '-- pilih jawaban --') {
            $validFacts[$key] = $value;
        }
    }

    if (empty($validFacts)) {
        header("Location: diagnosa.php?error=no_input");
        exit;
    }

    $diagnosis = forwardChain($validFacts, $conn);

    session_start();
    $_SESSION['diagnosa'] = $diagnosis;
    $_SESSION['jawaban'] = $validFacts;

    header("Location: hasil.php");
    exit;
}

header("Location: diagnosa.php");
exit;

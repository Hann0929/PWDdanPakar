<?php
session_start();
include "db/koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['jawaban'])) {
    
    $userAnswers = json_decode($_POST['jawaban'], true);
    if (!$userAnswers) {
        header("Location: diagnosa.php");
        exit;
    }

    $triggeredRules = [];
    $recommendedHeroes = [];

    // Ambil rule dari rule_base
    $query_rules = "SELECT rule_id, rule_name FROM rule_base";
    $result_rules = mysqli_query($conn, $query_rules);

    while ($rule = mysqli_fetch_assoc($result_rules)) {
        $rule_id = $rule['rule_id'];
        $rule_name = $rule['rule_name'];

        $query_conditions = "
            SELECT g.attribute_key, rc.expected_value 
            FROM rule_condition rc
            JOIN gejala g ON rc.gejala_id = g.gejala_id
            WHERE rc.rule_id = '$rule_id'
        ";
        $result_conditions = mysqli_query($conn, $query_conditions);
        
        $isMatch = true;
        $countConditions = mysqli_num_rows($result_conditions);
        
        if ($countConditions > 0) {
            while ($cond = mysqli_fetch_assoc($result_conditions)) {
                $attr = $cond['attribute_key'];
                $expected = $cond['expected_value'];
                
                if (!isset($userAnswers[$attr]) || $userAnswers[$attr] !== $expected) {
                    $isMatch = false;
                    break;
                }
            }
        } else {
            $isMatch = false;
        }

        // Forward Chaining
        if ($isMatch) {
            $triggeredRules[] = $rule_name; 
            

            $query_heroes = "
                SELECT h.name, h.image 
                FROM rule_conclusion rcon
                JOIN hero h ON rcon.hero_id = h.hero_id
                WHERE rcon.rule_id = '$rule_id'
            ";
            $result_heroes = mysqli_query($conn, $query_heroes);
            while ($h = mysqli_fetch_assoc($result_heroes)) {
                
                $hero_data = [
                    'name' => $h['name'],
                    'image' => $h['image']
                ];
                
               
                if (!in_array($hero_data, $recommendedHeroes)) {
                    $recommendedHeroes[] = $hero_data;
                }
            }
        }
    }

   
    $_SESSION['jawaban'] = $userAnswers;
    $_SESSION['diagnosa'] = [
        'triggered_rules' => $triggeredRules,
        'final_hero_recommendation' => $recommendedHeroes
    ];

    header("Location: hasil.php");
    exit;
} else {
    header("Location: diagnosa.php");
    exit;
}
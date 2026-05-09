<?php

// Script simple avec PDO pour normaliser les téléphones et détecter les doublons

$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    die(".env non trouvé\n");
}

$env = parse_ini_file($envFile);
$host = $env['database.default.hostname'] ?? 'localhost';
$dbName = $env['database.default.database'] ?? 'missmath_bd';
$user = $env['database.default.username'] ?? 'root';
$pass = $env['database.default.password'] ?? '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage() . "\n");
}

function cleanPhone($phone) {
    if (empty($phone)) return $phone;
    $clean = str_replace([' ', '+', '-', '(', ')'], '', $phone);
    if (strpos($clean, '221') === 0 && strlen($clean) > 9) {
        $clean = substr($clean, 3);
    }
    if (strpos($clean, '00221') === 0 && strlen($clean) > 11) {
        $clean = substr($clean, 5);
    }
    return $clean;
}

$stmt = $pdo->query("SELECT id, prenom, nom, email, telephone FROM utilisateurs");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "Début de la normalisation de " . count($users) . " utilisateurs...\n";

$updateStmt = $pdo->prepare("UPDATE utilisateurs SET telephone = ? WHERE id = ?");
$deleteStmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
$updatedCount = 0;
$duplicatesCount = 0;

$phonesSeen = [];

foreach ($users as $user) {
    $oldPhone = $user['telephone'];
    $newPhone = cleanPhone($oldPhone);
    
    if (isset($phonesSeen[$newPhone])) {
        echo "DOUBLON DÉTECTÉ : ID {$user['id']} ({$user['email']}) utilise le même numéro ({$newPhone}) que ID {$phonesSeen[$newPhone]}\n";
        echo "Suppression de l'entrée en double ID {$user['id']}...\n";
        $deleteStmt->execute([$user['id']]);
        $duplicatesCount++;
        continue;
    }
    
    $phonesSeen[$newPhone] = $user['id'];

    if ($oldPhone !== $newPhone) {
        try {
            $updateStmt->execute([$newPhone, $user['id']]);
            echo "ID {$user['id']}: {$oldPhone} -> {$newPhone}\n";
            $updatedCount++;
        } catch (PDOException $e) {
            if ($e->getCode() == '23000') {
                echo "ERREUR DOUBLON lors de la mise à jour ID {$user['id']}: {$newPhone} existe déjà.\n";
                echo "Suppression de l'entrée en double ID {$user['id']}...\n";
                $deleteStmt->execute([$user['id']]);
                $duplicatesCount++;
            } else {
                throw $e;
            }
        }
    }
}

echo "Normalisation terminée.\n";
echo "- {$updatedCount} numéros mis à jour.\n";
echo "- {$duplicatesCount} doublons supprimés.\n";

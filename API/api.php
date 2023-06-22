<?php
// DATABASE
$config = array(
    'DB_HOST' => 'localhost',
    'DB_USERNAME' => 'root',
    'DB_PASSWORD' => '',
    'DB_DATABASE' => 'appweb'
);

try {
    $host = $config['DB_HOST'];
    $dbname = $config['DB_DATABASE'];

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $config['DB_USERNAME'], $config['DB_PASSWORD']);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Requête pour récupérer les données des utilisateurs
$sql = "SELECT username, level, score FROM user";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Conversion en JSON
$jsonData = json_encode($users);

// Enregistrement du fichier JSON localement
$file = 'users.json';
file_put_contents($file, $jsonData);

// Envoi du fichier JSON vers le port 2020
$remoteUrl = 'http://localhost/Dasbord/api.php';
$remoteFile = '/json/users.json';
$remoteData = file_get_contents($file);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $remoteUrl . $remoteFile);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $remoteData);
curl_exec($ch);
curl_close($ch);

unlink($file);
?>

<?php
// Commencez une nouvelle session ou continuez l'ancienne
session_start();

// Connectez-vous à la base de données
require('../phpconnect/database.php');

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "Vous devez être connecté pour voir vos messages privés.";
    exit();
}

// Récupérez tous les messages privés où l'utilisateur actuellement connecté est le destinataire
$stmt = $pdo->prepare("SELECT private_messages.*, users.username FROM private_messages INNER JOIN users ON private_messages.sender_id = users.id WHERE receiver_id = ? OR sender_id = ? ORDER BY timestamp DESC");
$stmt->execute([$_SESSION['user']['id'], $_SESSION['user']['id']]);
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages privés</title>
</head>
<body>
    <h1>Messages privés</h1>

    <?php foreach ($messages as $message): ?>
        <div>
            <h2><?php echo $message['username']; ?> à <?php echo $message['timestamp']; ?></h2>
            <p><?php echo $message['message']; ?></p>
        </div>
    <?php endforeach; ?>

</body>
</html>

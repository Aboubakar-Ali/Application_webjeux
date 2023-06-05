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
$stmt = $pdo->prepare("SELECT private_messages.*, user.username, user.photo FROM private_messages INNER JOIN user ON private_messages.sender_id = user.id WHERE receiver_id = ? OR sender_id = ? ORDER BY timestamp DESC");
$stmt->execute([$_SESSION['user']['id'], $_SESSION['user']['id']]);
$messages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages privés</title>
    <style>
        body {
            background-color: #1f1f1f;
            color: #c8c8c8;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #ffffff;
        }

        .message-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
        }

        .user-photo {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .message-content {
            background-color: #2d2d2d;
            border: 1px solid #3f3f3f;
            padding: 10px;
            flex-grow: 1;
        }

        h2 {
            color: #ffffff;
            font-size: 16px;
            margin-bottom: 5px;
        }

        p {
            color: #c8c8c8;
            font-size: 14px;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h1>Messages privés</h1>

    <?php foreach ($messages as $message): ?>
        <div class="message-container">
            <img src="<?php echo $message['photo']; ?>" alt="Photo de l'utilisateur" class="user-photo">
            <div class="message-content">
                <h2><?php echo $message['username']; ?> à <?php echo $message['timestamp']; ?></h2>
                <p><?php echo $message['message']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>

</body>

</html>

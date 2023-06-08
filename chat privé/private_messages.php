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

// Récupérez les derniers messages privés de chaque utilisateur où l'utilisateur actuellement connecté est le destinataire
$stmt = $pdo->prepare("
    SELECT pm.*, sender.username AS sender_username, sender.photo AS sender_photo, receiver.username AS receiver_username, receiver.photo AS receiver_photo 
    FROM private_messages pm 
    INNER JOIN (
        SELECT MAX(timestamp) AS max_timestamp, sender_id
        FROM private_messages
        WHERE receiver_id = ?
        GROUP BY sender_id
    ) max_messages ON pm.timestamp = max_messages.max_timestamp AND pm.sender_id = max_messages.sender_id
    INNER JOIN user sender ON pm.sender_id = sender.id 
    INNER JOIN user receiver ON pm.receiver_id = receiver.id 
    WHERE pm.receiver_id = ?
    ORDER BY pm.timestamp DESC
");
$stmt->execute([$_SESSION['user']['id'], $_SESSION['user']['id']]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            align-items: flex-start; /* Aligner les messages en haut */
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

        .sent-message { /* Style pour les messages envoyés */
            align-self: flex-end; /* Aligner les messages envoyés à droite */
            background-color: #4caf50;
        }

        .received-message { /* Style pour les messages reçus */
            background-color: #2196f3;
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
        <?php
        $userPhoto = $message['sender_photo'];
        $username = $message['sender_username'];
        ?>
        <a href="profil_utilisateur.php?user_id=<?php echo $message['sender_id']; ?>&receiver_id=<?php echo $message['receiver_id']; ?>">
            <div class="message-container received-message">
                <img class="user-photo" src="<?php echo $userPhoto; ?>" alt="Photo utilisateur">
                <div class="message-content">
                    <h2><?php echo $username; ?></h2>
                    <p><?php echo $message['message']; ?></p>
                </div>
            </div>
        </a>
    <?php endforeach ;?>

</body>

</html>
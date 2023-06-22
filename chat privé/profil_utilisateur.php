<?php
// Commencez une nouvelle session ou continuez l'ancienne


// Connectez-vous à la base de données
;

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "Vous devez être connecté pour voir vos messages privés.";
    exit();
}

// Récupérez l'ID de l'utilisateur connecté
$user_id = $_SESSION['user']['id'];

// Vérifiez si l'ID de l'utilisateur à afficher est spécifié dans l'URL
if (!isset($_GET['user_id'])) {
    echo "L'ID de l'utilisateur n'est pas spécifié.";
    exit();
}

// Récupérez l'ID de l'utilisateur à partir de l'URL
$target_user_id = $_GET['user_id'];

// Récupérez les messages privés envoyés par l'utilisateur spécifique
$stmt_sent = $pdo->prepare("SELECT pm.*, receiver.username AS receiver_username, receiver.photo AS receiver_photo FROM private_messages pm INNER JOIN user receiver ON pm.receiver_id = receiver.id WHERE pm.sender_id = ? AND pm.receiver_id = ? ORDER BY pm.timestamp ASC");
$stmt_sent->execute([$user_id, $target_user_id]);
$messages_sent = $stmt_sent->fetchAll(PDO::FETCH_ASSOC);

// Récupérez les messages privés reçus par l'utilisateur spécifique
$stmt_received = $pdo->prepare("SELECT pm.*, sender.username AS sender_username, sender.photo AS sender_photo FROM private_messages pm INNER JOIN user sender ON pm.sender_id = sender.id WHERE pm.receiver_id = ? AND pm.sender_id = ? ORDER BY pm.timestamp ASC");
$stmt_received->execute([$user_id, $target_user_id]);
$messages_received = $stmt_received->fetchAll(PDO::FETCH_ASSOC);

// Vérifiez si les données du formulaire ont été soumises
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    // Vérifiez si le destinataire existe dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$receiver_id]);
    $receiver = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$receiver) {
        echo "Le destinataire du message n'existe pas.";
        exit();
    }

    // Enregistrez le message dans la base de données
    $stmt = $pdo->prepare("INSERT INTO private_messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $receiver_id, $message]);

    // Stockez le message dans une variable de session
    $_SESSION['success_message'] = "Message envoyé avec succès !";

    // Redirigez vers la page de profil de l'utilisateur
    header("Location: profil_utilisateur.php?user_id=$target_user_id");
    exit();
}

// Récupérez les informations de l'utilisateur cible
$stmt_user = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$stmt_user->execute([$target_user_id]);
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "L'utilisateur n'existe pas.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil de <?php echo $user['username']; ?></title>
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
            position: relative;
            left: 30%;
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
        }

        .sent-message {
            align-self: flex-end; /* Aligner les messages envoyés à droite */
            background-color: #4caf50;
            width: 40%;
        }

        .received-message {
            background-color: #2196f3;
            align-self: flex-start; /* Aligner les messages reçus à gauche */
        }

        h3 {
            color: #ffffff;
            font-size: 16px;
            margin-bottom: 5px;
        }

        p {
            color: #c8c8c8;
            font-size: 14px;
            margin-top: 0;
        }

        .message-container.sent-message .message-content,
        .message-container.received-message .message-content {
            width: 100%; /* Ajuster la largeur du message à 100% */
        }

        .message-container.received-message {
            width: 40%; /* Ajuster la largeur du message à 100% */
        }

        .message-container.received-message .user-photo {
            margin-left: 10px; /* Ajouter une marge à gauche pour les messages reçus inversés */
            margin-right: 0; /* Supprimer la marge droite pour les messages reçus inversés */
        }

        .form-container {
            margin-top: 20px;
            width: 50%;
            position: relative;
            left: 25%;
        }

        textarea {
            width: 100%;
            height: 100px;
            resize: vertical;
        }

        button {
            margin-top: 10px;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<?php include 'elements/header.php';
            ?>
<body>
    <h1>Profil de <?php echo $user['username']; ?></h1>

    <?php
    // Afficher le message de succès s'il existe
    if (isset($_SESSION['success_message'])) {
        echo "<p>{$_SESSION['success_message']}</p>";
        unset($_SESSION['success_message']); // Supprimer le message de la session
    }
    ?>

    <?php
    // Combinez les messages envoyés et reçus dans un seul tableau
    $all_messages = array_merge($messages_sent, $messages_received);

    // Triez les messages par ordre croissant de timestamp
    usort($all_messages, function ($a, $b) {
        return strtotime($a['timestamp']) - strtotime($b['timestamp']);
    });

    foreach ($all_messages as $message): ?>
        <?php
        $isSent = $message['sender_id'] === $user_id;
        $userPhoto = $isSent ? $_SESSION['user']['photo'] : $message['sender_photo'];
        $username = $isSent ? $_SESSION['user']['username'] : $message['sender_username'];
        $messageClass = $isSent ? 'sent-message' : 'received-message';
        ?>
        <div class="message-container <?php echo $messageClass; ?>">
            <img src="<?php echo $userPhoto; ?>" alt="Photo de l'utilisateur" class="user-photo">
            <div class="message-content">
                <h3><?php echo $username; ?></h3>
                <p><?php echo $message['message']; ?></p>
            </div>
        </div>
    <?php endforeach; ?>

    <div class="form-container">
        <form method="POST" action="">
            <input type="hidden" name="receiver_id" value="<?php echo $target_user_id; ?>">
            <textarea name="message" placeholder="Saisissez votre message..." required></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>

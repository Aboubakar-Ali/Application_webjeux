<?php
// Commencez une nouvelle session ou continuez l'ancienne
session_start();

// Connectez-vous à la base de données
require('../phpconnect/database.php');

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "Vous devez être connecté pour envoyer un message privé.";
    exit();
}

// Récupérez le nom d'utilisateur du destinataire et le contenu du message du formulaire
$receiver_username = $_POST['username'];
$message_content = $_POST['message'];

// Cherchez l'ID correspondant au nom d'utilisateur du destinataire dans la table des utilisateurs
$stmt = $pdo->prepare("SELECT id FROM user WHERE username = ?");
$stmt->execute([$receiver_username]);
$receiver = $stmt->fetch();

// Si un tel utilisateur existe
if ($receiver) {
    // Insérez un nouvel enregistrement dans la table des messages privés
    $stmt = $pdo->prepare("INSERT INTO private_messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user']['id'], $receiver['id'], $message_content]);
    
    // Afficher le message de succès avec du code HTML intégré
    echo "<div style='background-color: green; color: white; padding: 10px;'>Votre message a été envoyé avec succès à " . $receiver_username . ".</div>";
} else {
    // Afficher le message d'erreur avec du code HTML intégré
    echo "<div style='background-color: red; color: white; padding: 10px;'>L'utilisateur " . $receiver_username . " n'existe pas.</div>";
}
?>

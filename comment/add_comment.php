<?php
session_start();
require('../phpconnect/database.php');

if (isset($_POST['article_id']) && isset($_POST['content']) && isset($_SESSION['user'])) {
    $stmt = $pdo->prepare('INSERT INTO comments (user_id, article_id, content) VALUES (?, ?, ?)');
    $stmt->execute([$_SESSION['user']['id'], $_POST['article_id'], $_POST['content']]);

    // Rediriger l'utilisateur vers la page du profil après l'ajout du commentaire
    header('Location: ../Accueil\accueil.php');
}
?>
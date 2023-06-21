<?php

;

if (!isset($_SESSION['user'])) {
    echo 'not_authenticated';
    exit();
}

if (!isset($_POST['user_id'])) {
    echo 'invalid_request';
    exit();
}

$followerId = $_SESSION['user']['id'];
$followingId = $_POST['user_id'];

// Vérifier si l'utilisateur connecté suit déjà l'utilisateur donné
$stmt = $pdo->prepare('SELECT COUNT(*) FROM followers WHERE follower_id = ? AND following_id = ?');
$stmt->execute([$followerId, $followingId]);
$isFollowing = $stmt->fetchColumn() > 0;

if ($isFollowing) {
    // Si l'utilisateur connecté suit déjà l'utilisateur donné, supprimer l'entrée de la table des followers
    $stmt = $pdo->prepare('DELETE FROM followers WHERE follower_id = ? AND following_id = ?');
    $stmt->execute([$followerId, $followingId]);
    echo 'unfollowed';
} else {
    // Sinon, ajouter une entrée dans la table des followers pour indiquer que l'utilisateur connecté suit l'utilisateur donné
    $stmt = $pdo->prepare('INSERT INTO followers (follower_id, following_id) VALUES (?, ?)');
    $stmt->execute([$followerId, $followingId]);
    echo 'followed';
}

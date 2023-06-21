<?php

;

if (isset($_POST['article_id']) && isset($_SESSION['user'])) {
    $stmt = $pdo->prepare('INSERT INTO likes (user_id, article_id) VALUES (?, ?)');
    $stmt->execute([$_SESSION['user']['id'], $_POST['article_id']]);

    // Compter le nombre de likes pour cet article
    $stmt = $pdo->prepare('SELECT COUNT(*) AS likes FROM likes WHERE article_id = ?');
    $stmt->execute([$_POST['article_id']]);
    $likes = $stmt->fetch()['likes'];

    // Renvoyer le nombre de likes
    echo $likes;
}


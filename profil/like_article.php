<?php
session_start();
require('../phpconnect/database.php');

if (isset($_POST['article_id']) && isset($_SESSION['user'])) {
    $stmt = $pdo->prepare('INSERT INTO likes (user_id, article_id) VALUES (?, ?)');
    $stmt->execute([$_SESSION['user']['id'], $_POST['article_id']]);
}

<?php
if (isset($_POST['article_id']) && isset($_SESSION['user'])) {
    $articleId = $_POST['article_id'];
    $userId = $_SESSION['user']['id'];

    // Vérifier si l'utilisateur a déjà "liké" l'article
    $stmt = $pdo->prepare('SELECT COUNT(*) AS liked FROM likes WHERE user_id = ? AND article_id = ?');
    $stmt->execute([$userId, $articleId]);
    $liked = $stmt->fetch()['liked'];

    if ($liked) {
        // Supprimer le "Like" de la base de données
        $stmt = $pdo->prepare('DELETE FROM likes WHERE user_id = ? AND article_id = ?');
        $stmt->execute([$userId, $articleId]);

        // Compter le nombre de likes restants pour cet article
        $stmt = $pdo->prepare('SELECT COUNT(*) AS likes FROM likes WHERE article_id = ?');
        $stmt->execute([$articleId]);
        $likes = $stmt->fetch()['likes'];

        // Renvoyer le nombre de likes
        echo $likes;
    }
}
?>

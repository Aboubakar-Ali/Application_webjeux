<?php
    session_start();
    require('../phpconnect/database.php');
    if(isset($_SESSION['user'])){
        $id = $_SESSION['user']['id'];
        $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
    } else {
        // header('Location: login.php');
        // redirection du user sur la page d'acceuil
        header('Location: ../Authentification/connexion/singin.html');
    }

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        // Utilisez $user_id pour charger les informations de l'utilisateur depuis la base de données
    } else {
        // Si aucun user_id n'est passé dans l'URL, vous pouvez rediriger vers une page d'erreur ou utiliser l'ID de l'utilisateur connecté par défaut
    }
?>



<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="profile-card">
        <img src="<?php echo $user['photo']; ?>" alt="Photo de profil">
        <h1><?php echo $user['username']; ?></h1>
        <p class="title">Description</p>
        <p><?php echo $user['description']; ?></p>
        <a href="../chat privé/private_messages.php"><button>Messages privés</button></a> 
        <a href="../chat privé/inbox.html"><button>Envoyer un message privé</button></a> 
        <a href="../edit profil/edit_profile.php"><button>Modifier le profil</button></a>
        <a href="../articles/publish_article.php"><button>Publier un article</button></a>
    </div>
    <?php
    // Récupérez tous les articles de l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE user_id = ? ORDER BY timestamp DESC");
    $stmt->execute([$_SESSION['user']['id']]);
    $articles = $stmt->fetchAll();
    ?>

    <!-- Affichez les articles de l'utilisateur -->
    <?php foreach ($articles as $article): ?>
        <?php
        // Compter le nombre de likes pour cet article
        $stmt = $pdo->prepare('SELECT COUNT(*) AS likes FROM likes WHERE article_id = ?');
        $stmt->execute([$article['id']]);
        $likes = $stmt->fetch()['likes'];

        // Récupérez tous les commentaires pour cet article, ainsi que le username de chaque commentaire
        $stmt = $pdo->prepare('SELECT comments.*, user.username FROM comments JOIN user ON comments.user_id = user.id WHERE comments.article_id = ? ORDER BY comments.timestamp ASC');
        $stmt->execute([$article['id']]);
        $comments = $stmt->fetchAll();
        ?>
        <div>
            <h2><?php echo $article['title']; ?></h2>
            <p><?php echo $article['content']; ?></p>
            <button class="like-button" data-article-id="<?php echo $article['id']; ?>">Like</button>
            <span><?php echo $likes; ?> likes</span>
            
            <!-- Affichez les commentaires -->
            <?php foreach ($comments as $comment): ?>
                <div>
                    <strong><?php echo $comment['username']; ?></strong>
                    <p><?php echo $comment['content']; ?></p>
                </div>
            <?php endforeach; ?>
            
            <!-- Affichez un formulaire pour ajouter un nouveau commentaire -->
            <form action="add_comment.php" method="POST">
                <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                <textarea name="content" placeholder="Ajouter un commentaire"></textarea>
                <button type="submit">Commenter</button>
            </form>
        </div>
        
        <div>
            <h2><?php echo $article['title']; ?></h2>
            <p><?php echo $article['content']; ?></p>
            <button class="like-button" data-article-id="<?php echo $article['id']; ?>">Like</button>
            <span><?php echo $likes; ?> likes</span>
        </div>
    <?php endforeach; ?>



    <script>
    // Le code JavaScript pour gérer les likes
    document.querySelectorAll('.like-button').forEach(function(button) {
    button.addEventListener('click', function() {
        var articleId = this.getAttribute('data-article-id');

        // Envoyer une requête AJAX au serveur pour "liker" l'article
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'like_article.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('article_id=' + articleId);

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Mise à jour de l'interface utilisateur pour montrer que l'article a été "liké"
                button.textContent = xhr.responseText + ' likes';
            }
        };

        });
    });
    </script>
</body>
</html>


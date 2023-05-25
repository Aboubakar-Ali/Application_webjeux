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
        <div>
            <h2><?php echo $article['title']; ?></h2>
            <p><?php echo $article['content']; ?></p>
            <button class="like-button" data-article-id="<?php echo $article['id']; ?>">Like</button>
        </div>
    <?php endforeach; ?>


    <script>
    // Le code JavaScript pour gérer les likes
    document.querySelectorAll('.like-button').forEach(function(button) {
        button.addEventListener('click', function() {
            console.log("button clicked");  // 
            var articleId = this.getAttribute('data-article-id');

            // Envoyer une requête AJAX au serveur pour "liker" l'article
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'like_article.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('article_id=' + articleId);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Mise à jour de l'interface utilisateur pour montrer que l'article a été "liké"
                    button.textContent = 'Liked';
                }
            };
        });
    });
    </script>
</body>
</html>


<?php

$username = isset($_SESSION['user']['username']) ? $_SESSION['user']['username'] : '';

$stmt = $pdo->prepare("SELECT articles.*, user.username FROM articles JOIN user ON articles.user_id = user.id ORDER BY timestamp DESC LIMIT 10");
$stmt->execute();
$articles = $stmt->fetchAll();



?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="acceuil.css">
    <script>
        var username = "<?php echo $username; ?>";
    </script>
    <script src="../chat general/client/chat.js"></script>
    <script src="../chat general/client/comment.js"></script>
    <script>
        function toggleTheme() {
            document.body.classList.toggle("dark-theme");
        }
    </script>
</head>
<body>
<div class="wave-animation">
    <div class="navbarr">

        <?php include 'elements/header.php'; ?>

        <button onclick="toggleTheme()">thème</button>

    </div>
    <div class="content">
        <div class="main-content">
            <h2>Publications</h2>
            <?php foreach ($articles as $article): ?>
                <div class="article">
                    <h2><?php echo $article['title']; ?> by <?php echo $article['username']; ?></h2>
                    <p><?php echo $article['content']; ?></p>

                    <?php
                    // Récupérer les likes pour cet article
                    $stmt = $pdo->prepare('SELECT COUNT(*) AS likes FROM likes WHERE article_id = ?');
                    $stmt->execute([$article['id']]);
                    $likes = $stmt->fetch()['likes'];
                    ?>
                    <button class="toggle-comments-button">Afficher les commentaires</button>
                    <div class="comment-section hidden">
                        <?php
                        $stmt = $pdo->prepare('SELECT * FROM comments WHERE article_id = ?');
                        $stmt->execute([$article['id']]);
                        $comments = $stmt->fetchAll();
                        foreach ($comments as $comment) {
                            $stmt = $pdo->prepare('SELECT username FROM user WHERE id = ?');
                            $stmt->execute([$comment['user_id']]);
                            $username = $stmt->fetch()['username'];
                            echo '<div class="comment">';
                            echo '<strong>' . $username . '</strong>';
                            echo '<p>' . $comment['content'] . '</p>';
                            echo '</div>';
                        }
                        ?>
                        <div class="comments">
                            <!-- Zone pour les commentaires -->
                        </div>
                        <form class="comment-form" data-article-id="<?php echo $article['id']; ?>">
                            <input type="text" name="content" placeholder="Ajouter un commentaire">
                            <button type="submit">Envoyer</button>
                        </form>
                    </div>

                    <?php
                    // Vérifier si l'utilisateur est connecté
                    if (isset($_SESSION['user'])) {
                        $userId = $_SESSION['user']['id'];

                        // Récupérer la liste des articles likés par l'utilisateur
                        $stmt = $pdo->prepare('SELECT article_id FROM likes WHERE user_id = ?');
                        $stmt->execute([$userId]);
                        $likedArticles = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        // Mettre à jour le statut de "like" pour l'article actuel
                        $article['liked'] = in_array($article['id'], $likedArticles);
                    }
                    ?>

                    <?php if (isset($_SESSION['user']) && !$article['liked']): ?>
                        <button class="like-button" data-article-id="<?php echo $article['id']; ?>">Like</button>
                    <?php else: ?>
                        <button class="like-button" data-article-id="<?php echo $article['id']; ?>" disabled>Already Liked</button>
                    <?php endif; ?>
                    <span><?php echo $likes; ?> likes</span>
                </div>
            <?php endforeach; ?>

        </div>


        <div class="chat">
            <h2>Chat Général</h2>
            <!-- Code pour afficher le chat ici -->
            <div id="chat-messages"></div>
            <form id="chat-form">
                <input type="text" id="chat-input">
                <button type="submit">Envoyer</button>
            </form>
        </div>

    </div>
</div> <!-- L'élément pour les vagues -->
<script>

    // Toggle Comments
    document.querySelectorAll('.toggle-comments-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var articleElement = this.closest('.article');
            var commentSection = articleElement.querySelector('.comment-section');
            commentSection.classList.toggle('hidden');
        });
    });

    // Handle Likes
    document.querySelectorAll('.like-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var articleId = this.getAttribute('data-article-id');
            var likeButton = this;
            var likesElement = button.nextElementSibling;

            // Check if the article is already liked by the user
            var isLiked = likeButton.dataset.liked === 'true';

            // Toggle the like status
            if (isLiked) {
                // Remove the like
                var likes = parseInt(likesElement.textContent);
                likesElement.textContent = (likes - 1) + ' likes';
                likeButton.dataset.liked = 'false';
                likeButton.textContent = 'Like';
            } else {
                // Add the like
                var likes = parseInt(likesElement.textContent);
                likesElement.textContent = (likes + 1) + ' likes';
                likeButton.dataset.liked = 'true';
                likeButton.textContent = 'Liked';
            }
        });
    });

    // Handle Comments
    document.querySelectorAll('.comment-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var articleId = this.getAttribute('data-article-id');
            var content = this.elements['content'].value;

            // Send AJAX request to post comment
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_comment.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('article_id=' + articleId + '&content=' + encodeURIComponent(content));

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Update the UI to show the new comment
                    // Here, we'll create a new comment element and add it to the DOM
                    var newComment = document.createElement('div');
                    newComment.classList.add('comment');
                    var strong = document.createElement('strong');
                    strong.textContent = username; // we assume 'username' is available
                    var p = document.createElement('p');
                    p.textContent = content;

                    newComment.appendChild(strong);
                    newComment.appendChild(p);

                    // Update the comment section with the new comment
                    var commentSection = form.parentNode.querySelector('.comments');
                    commentSection.appendChild(newComment);

                    // Clear the form input
                    form.elements['content'].value = '';

                    // Scroll to the newly added comment
                    newComment.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            };
        });
    });
</script>
</body>
</html>







<style>
/* acceuil.css */
.wave-animation {
   
    width: 100%;
    height: 100%;
    z-index: -1;
    background: radial-gradient(circle, red 10%, blue 90%);
    background-size: 200% 200%;
    animation: waveAnimation 10s linear infinite;
   margin-top: -15px;
}

@keyframes waveAnimation {
    0% {
        background-position: 0% 50%;
    }
    100% {
        background-position: 100% 50%;
    }
}


html, body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    max-width: 100%;
    max-height: 100%;
}

.navbarr {
        margin-top: 5px;
        display: flex;
        justify-content: center;
    }

.content {
    display: flex;
    justify-content: space-between;
}

.main-content {
    flex: 2;
    padding: 20px;
}



h2 {
    font-size: 20px;
}

/* Styling for articles */

.article {
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
}

.article:before {
    content: '';
    position: absolute;
    top: 0;
    left: -15px;
    width: 0;
    height: 0;
    /*border-top: 15px solid transparent;
    border-right: 15px solid white;
    border-bottom: 15px solid transparent;*/
}

.article:after {
    content: '';
    position: absolute;
    top: 0;
    left: -14px;
    width: 0;
    height: 0;
    /*border-top: 15px solid transparent;
    border-right: 15px solid #F5F8FA;
    border-bottom: 15px solid transparent;*/
}

.article h2 {
    margin-top: 0;
}

.article p {
    margin-bottom: 10px;
}

.article {
    margin-bottom: 20px;
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.article h2 {
    margin-top: 0;
}

.article p {
    margin-bottom: 10px;
}

.like-button {
    background-color: #1DA1F2;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.like-button:hover {
    background-color: #0E86D4;
}

.comment-form input[type="text"] {
    width: 80%;
    padding: 5px;
    margin-right: 10px;
}

.comment-form button {
    background-color: #1DA1F2;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.comment-form button:hover {
    background-color: #0E86D4;
}

.comments div {
    margin-top: 10px;
}

/* Styling for chat */



#chat-form input[type="text"] {
    width: 80%;
    padding: 5px;
    margin-right: 10px;
}

#chat-form button {
    background-color: #1DA1F2;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

#chat-form button:hover {
    background-color: #0E86D4;
}

.article .comment-section {
    display: block;
}

.article .comment-section.hidden {
    display: none;
}


.dark-theme {
    background-color: #212121;
    color: white;
}

.dark-theme .navbar {
    background-color: #121212;
}

.dark-theme .navbar a {
    color: white;
}

.dark-theme .navbar button {
    background-color: #000080;
}

.dark-theme .content {
    background-color: #121212;
}

.dark-theme .article {
    background-color: #363636;
    color: white;
}

.dark-theme .like-button {
    background-color: #000080;
}

.dark-theme .comment-form input[type="text"] {
    background-color: #363636;
    color: white;
}

.dark-theme .comment-form button {
    background-color: #000080;
}


.dark-theme #chat-form input[type="text"] {
    background-color: #363636;
    color: white;
}

.dark-theme #chat-form button {
    background-color: #000080;
}


#chat-messages {
    height: 300px;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
    color: black; /* Ajoutez une couleur de texte par défaut pour les messages du chat */
    overflow: auto; /* Ajoutez cette propriété pour activer la barre de défilement */
    scroll-behavior: smooth;
}

.dark-theme #chat-messages {
    background-color: #363636;
    color: white; /* Définissez la couleur du texte sur blanc dans le thème sombre */
    border: 1px solid #777;
}



    .chat {
    position: fixed;
    top: 80px;
    right: 20px;
    background-color: #F5F8FA;
    padding: 20px;
    color: black;
    height: 500px;
    overflow: auto;
}

.dark-theme .chat {
    background-color: #121212;
    color: white;
}

.dark-theme .navbar {
    background-color: #191970; /* Remplacez par la couleur bleu foncé de votre choix */
}

.dark-theme .navbar a {
    color: white;
}

</style>



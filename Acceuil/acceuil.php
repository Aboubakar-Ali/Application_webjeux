<?php
    session_start();
    require('../phpconnect/database.php');

    $stmt = $pdo->prepare("SELECT articles.*, user.username FROM articles JOIN user ON articles.user_id = user.id ORDER BY timestamp DESC LIMIT 10");
    $stmt->execute();
    $articles = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html>
    <head>
        <title>acceuil</title>
        <link rel="stylesheet" type="text/css" href="acceuil.css">
        <script>
            var username = "<?php echo $_SESSION['user']['username']; ?>";
        </script>
        <script src="../chat general/client/chat.js"></script> 
    </head>
<body>
    <div class="navbar">
        <h1>Mon Application</h1>
        <a href="../profil/index.php" class="profile-link">Profil</a>
    </div>
        
    <div class="content">
        <div class="main-content">
            <h2>Publications</h2>
             <!-- Code pour afficher les publications ici -->
            <?php foreach ($articles as $article): ?>
                <div>
                    <h2><?php echo $article['title']; ?>  by  <?php echo $article['username']; ?></h2>
                    <p><?php echo $article['content']; ?></p>

                    <?php
                    // Récupérer les likes pour cet article
                    $stmt = $pdo->prepare('SELECT COUNT(*) AS likes FROM likes WHERE article_id = ?');
                    $stmt->execute([$article['id']]);
                    $likes = $stmt->fetch()['likes'];
                    ?>
                    <button class="like-button" data-article-id="<?php echo $article['id']; ?>">Like</button>
                    <span><?php echo $likes; ?> likes</span>


                    <?php
                    // Récupérer les commentaires pour cet article
                    $stmt = $pdo->prepare('SELECT * FROM comments WHERE article_id = ?');
                    $stmt->execute([$article['id']]);
                    $comments = $stmt->fetchAll();
                    ?>
                    <!-- Comment Form -->
                    <form class="comment-form" data-article-id="<?php echo $article['id']; ?>">
                        <input type="text" name="content" placeholder="Your comment">
                        <button type="submit">Post Comment</button>
                    </form>
                    <!-- Affichez les commentaires -->
                    <?php foreach ($comments as $comment): ?>
                        <?php
                        // Récupérer le nom d'utilisateur pour ce commentaire
                        $stmt = $pdo->prepare('SELECT username FROM user WHERE id = ?');
                        $stmt->execute([$comment['user_id']]);
                        $username = $stmt->fetch()['username'];
                        ?>
                        <div>
                            <strong><?php echo $username; ?></strong>
                            <p><?php echo $comment['content']; ?></p>
                        </div>
                    <?php endforeach; ?>
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
    <script>
        // Handle Likes
        document.querySelectorAll('.like-button').forEach(function(button) {
            button.addEventListener('click', function() {
                var articleId = this.getAttribute('data-article-id');
                
                // Send AJAX request to like article
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../profil/like_article.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('article_id=' + articleId);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Update the UI to show the article has been liked
                        var likesElement = button.nextElementSibling;
                        var likes = parseInt(likesElement.textContent);
                        likesElement.textContent = (likes + 1) + ' likes';
                    }
                };
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
                xhr.open('POST', '../profil/add_comment.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('article_id=' + articleId + '&content=' + encodeURIComponent(content));

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Update the UI to show the new comment
                        // Here, we'll create a new comment element and add it to the DOM
                        var newComment = document.createElement('div');
                        var strong = document.createElement('strong');
                        strong.textContent = username; // we assume 'username' is available
                        var p = document.createElement('p');
                        p.textContent = content;

                        newComment.appendChild(strong);
                        newComment.appendChild(p);
                        // You need to have a container for the comments
                        // Let's assume it's a div with the class "comments" that is a sibling of the form
                        form.nextElementSibling.appendChild(newComment);

                        // Clear the form input
                        form.elements['content'].value = '';
                    }
                };
            });
        });


    </script>
</body>
</html>

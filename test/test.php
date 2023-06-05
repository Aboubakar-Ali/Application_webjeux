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
        header('Location: ../Authentification/connexion/singin.php');
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
    <link rel="stylesheet" type="text/css" href="test.css">
</head>
<body>
<div class="container">
  <div class="card">
    <img src="<?php echo $user['photo']; ?>" alt="Photo de profil" class="card__image">
    <h1 class="card__name"><?php echo $user['username']; ?></h1>
    <p><?php echo $user['description']; ?></p>
    <div class="grid-container">
      <div class="grid-child-posts">
        156 Post
      </div>

      <div class="grid-child-followers">
        1012 Likes
      </div>

    </div>
    <ul class="social-icons">
    <li>
        <a href="../edit profil/edit_profile.php">
        <i class="fa fa-instagram"> <img class="social-icon" src="https://cdn.discordapp.com/attachments/984816485446852629/1114110196210471012/image.png" alt=""></i>
        </a>
    </li>
    <li>
        <a href="../articles/publish_article.php">
        <i class="fa fa-twitter"><img class="social-icon" src="https://cdn.discordapp.com/attachments/984816485446852629/1114109974562476042/friends_link_send_share_icon_123609.png" alt=""></i>
        </a>
    </li>
    </ul>

    <div class = "bouton_profil">

    
   <a href="../chat privé/private_messages.php"> <button class="btn draw-border">Messages</button></a> 
   <a href="../chat privé/demo.php"> <button class="btn draw-border">DM</button></a> 
    </div>
  </div>
  </div>
</div>
</body>

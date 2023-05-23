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
        <a href="edit_profile.php"><button>Modifier le profil</button></a> 
    </div>
</body>
</html>

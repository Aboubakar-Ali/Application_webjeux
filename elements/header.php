
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="navbar">
        <?php if (isset($_SESSION['user'])): ?>
            <a href="/<?= $root; ?>/" class="profile-link">Accueil</a>
            <a href="/<?= $root; ?>/profil/?user_id=<?php echo $_SESSION['user']['id']; ?>" class="profile-link">Profil</a>
            <a href="/<?= $root; ?>/joueur" class="profile-link">Joueurs</a>
            <a href="/<?= $root; ?>/stream/play" class="profile-link">Videos</a>
            <a href="/<?= $root; ?>/auth/logout" class="profile-link">logout</a>
        <?php endif; ?>
   
    </div>
<style>
   .navbar {
    background-color: #333; 
    color: #fff;
    display: flex;
    justify-content: center;
    gap: 20px;
    padding: 20px;
    border-radius: 20px;
    width: 100ch;
    margin: 0% auto;
}

.navbar a {
    color: #fff;
    text-decoration: none;
}

</style>

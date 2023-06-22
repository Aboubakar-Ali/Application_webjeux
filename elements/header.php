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
            <div class="logo-container">
                <img class="logo" src="https://cdn.discordapp.com/attachments/1093091615981183047/1121214958139613304/KINGDOM_test_6.png" alt="">
            </div>
            <div class="title-container">
                <a href="/<?= $root; ?>/" class="profile-link">Accueil</a>
                <a href="/<?= $root; ?>/profil/?user_id=<?php echo $_SESSION['user']['id']; ?>" class="profile-link">Profil</a>
                <a href="/<?= $root; ?>/joueur" class="profile-link">Joueurs</a>
                <a href="/<?= $root; ?>/stream/play" class="profile-link">Videos</a>
                <a href="/<?= $root; ?>/dashbord" class="profile-link">Dashbord</a>
                <a href="/<?= $root; ?>/auth/logout" class="profile-link">logout</a>
            </div>
        <?php endif; ?>
    </div>
<style>
    .logo{
        width: 150px;
        height: 150px;
    }
   .navbar {
    position: relative;
    background-color: #333; 
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 3px 10px; /* Réduisez davantage le padding vertical pour réduire la hauteur */
    border-radius: 10px;
    width: 80%;
    margin: 0 auto;
}

.logo-container {
    display: flex;
    align-items: center;
}

.title-container {
    position: relative;
    left: 100px;
    display: flex;
    flex-grow: 1;
    /* Utilisez 'space-between' pour augmenter l'espacement entre les titres */
    gap: 100px; /* Réduisez l'espace entre les liens à 10px */
}

.navbar a {
    color: #fff;
    text-decoration: none;
    font-size: 14px; /* Réduisez davantage la taille de la police */
}



</style>
</body>
</html>

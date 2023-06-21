<?php
session_start();
//echo '<pre>', var_dump($_SESSION);
require('phpconnect/database.php');

$route = explode('/', $_SERVER['REQUEST_URI']);
unset($route[0]);

$root = $route[1];

switch ($route[2]) {
    case "" :
        if (empty($_SESSION['user'])) { include "Accueil/nonconnect.php"; }
        if (!empty($_SESSION['user'])) { include "Accueil/accueil.php"; }
        break;
    case "auth":
        switch ($route[3]) {
            case "login" :
                include "Authentification/connexion/signin.php";
                break;
            case "signup" :
                include "Authentification/inscription/signup.php";
                break;
            case "logout" :
                include "Authentification/logout/logout.php";
                break;
            case "forgot" :
                include "Authentification/mot_de_passe/passe.php";
                break;
            default:
                header("Location: /$root/auth/login");
        }
        break;
    case "profil":
        include "test/test.php";
        break;
    case "messages":
        include "chat privé/private_messages.php";
        break;
    case "messages_p":
        include "chat privé/profil_utilisateur.php";
        break;
    case "dm":
        include "chat privé/demo.php";
        break;
    case "edit_p":
        include "edit profil/edit_profile.php";
        break;
    case "publish":
        include "articles/publish_article.php";
        break;
    case "joueur":
        include "joueur/joueur.php";
        break;
    case "stream":
        switch ($route[3]) {
            case "play" :
                include "stream_/play.php";
                break;
            case "push":
                include "stream_/upload.php";
                break;
            default:
                header("Location: /$root/stream/play");
        }
        break;
    default:
        header("Location: /$root/");
}

?>
<?php

$routes = [
    '/' => '/Authentification/connexion/singin.php',
    // Ajoutez d'autres règles de routage pour chaque page de votre site
];

// Récupérer l'URL demandée
$requestUrl = $_SERVER['REQUEST_URI'];

// Supprimer les éventuels paramètres de l'URL
$requestUrl = strtok($requestUrl, '?');

// Vérifier si l'URL demandée existe dans les règles de routage
if (array_key_exists($requestUrl, $routes)) {
    // Inclure le fichier associé à l'URL demandée
    include $routes[$requestUrl];
} else {
    // Afficher un message d'erreur
    echo "Page not found";
    exit();
}

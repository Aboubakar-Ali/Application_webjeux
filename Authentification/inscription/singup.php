<?php
// planté la page si la connexion ne passe pas
require('../../phpconnect/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // hachage du mot de passe

        // vérification de l'existence du nom d'utilisateur
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo 'Le nom d\'utilisateur existe déjà, veuillez choisir un autre nom d\'utilisateur.';
        } else {
            // préparation de la requête
            $stmt = $pdo->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
            
            // exécution de la requête
            $stmt->execute([$email, $username, $password]);

            // redirection vers la connexion
            header('Location: ../connexion/singin.html');
        }
    } else {
        echo 'Veuillez remplir tous les champs';
    }
}
?>

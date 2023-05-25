<?php
// planté la page si la connexion ne passe pas
require('../../phpconnect/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // hachage du mot de passe

        // vérification de l'existence du nom d'utilisateur
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo 'Le nom d\'utilisateur existe déjà, veuillez choisir un autre nom d\'utilisateur.';
        } else {

            // Sélection d'une image par défaut pour le nouvel utilisateur
            $default_images = array('../image/profil.jpg', '../image/profil1.jpg'); 
            $random_image = $default_images[array_rand($default_images)];
            $default_description = "Hey, Je suis nouveau.";


            // préparation de la requête
            $stmt = $pdo->prepare("INSERT INTO user (email, username, password, photo, description) VALUES (?, ?, ?, ?, ?)");
            
            // exécution de la requête
            $stmt->execute([$email, $username, $password, $random_image, $default_description]);

        
            // redirection vers la connexion
            header('Location: ../connexion/singin.html');
        }
    } else {
        echo 'Veuillez remplir tous les champs';
    }
}
?>

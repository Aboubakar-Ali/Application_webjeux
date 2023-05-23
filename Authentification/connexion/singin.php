<?php
// planté la page si la connexion ne passe pas
require('../../phpconnect/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];  

        // Fetch the user by username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Start a new session
            session_start();

            // Store user data into the session
            $_SESSION['users'] = $user;

            // redirection du user sur la page d'acceuil
            header('Location: ../../Acceuil/acceuil.php');
        } else {
            echo 'Nom d\'utilisateur ou mot de passe incorrect';
        }
    } else {
        echo 'Veuillez remplir tous les champs';
    }
}
?>

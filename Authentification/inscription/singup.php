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
            header('Location: ../connexion/singin.php');
        }
    } else {
        echo 'Veuillez remplir tous les champs';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Singup</title>
    <link rel="stylesheet" type="text/css" href="singup.css">
    <style>
        /* Les styles CSS pour les vagues */
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1c20;
            overflow: hidden;
            position: relative;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wave-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle, #25555a 10%, #1a1c20 90%);
            background-size: 200% 200%;
            animation: waveAnimation 10s linear infinite;
        }

        @keyframes waveAnimation {
            0% {
                background-position: 0% 50%;
            }
            100% {
                background-position: 100% 50%;
            }
        }

        form {
            width: 400px;
            background-color: transparent;
            border-radius: 5px;
            padding: 20px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        label {
            display: block;
            margin-top: 20px;
            color: #ffffff;
            text-align: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
    <form method="POST" action="singup.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="photo">Photo de profil:</label><br>
        <input type="file" id="photo" name="photo"><br>
    
        <input type="submit" value="Register">
    </form>
</body>
</html>


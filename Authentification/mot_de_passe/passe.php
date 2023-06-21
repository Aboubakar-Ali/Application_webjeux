<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Définition des variables pour les messages
$successMessage = '';
$errorMessage = '';

// Récupération des données du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    // Vérification que le nouveau mot de passe correspond à la confirmation
    if ($newPassword !== $confirmPassword) {
        $errorMessage = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérification de l'existence de l'email dans la base de données
        $query = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows === 0) {
            $errorMessage = "Cet email n'est pas enregistré.";
        } else {
            // Réinitialisation du mot de passe
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE user SET password = '$hashedPassword' WHERE email = '$email'";

            if ($conn->query($query) === TRUE) {
                $successMessage = "Le mot de passe a été réinitialisé avec succès.";
            } else {
                $errorMessage = "Une erreur s'est produite lors de la réinitialisation du mot de passe : " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation du mot de passe</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            padding: 2em;
            background-color: #171717;
            border-radius: 20px;
        }

        
        #heading {
            color: rgb(0, 255, 200);
            font-size: 1.2em;
        }

        .field {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5em;
            border-radius: 25px;
            padding: 0.6em;
            background-color: #171717;
            box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
        }

        .field label {
            color: white;
        }

        .input-icon {
            height: 1.3em;
            width: 1.3em;
            fill: rgb(0, 255, 200);
        }

        .input-field {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: rgb(0, 255, 200);
        }

        .form .btn {
            margin-top: 2em;
        }

        .button1 {
            padding: 0.5em 1.1em;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: .4s ease-in-out;
            background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
            color: rgb(0, 0, 0);
            text-decoration: none;
        }

        .button1:hover {
            background-image: linear-gradient(163deg, #00642f 0%, #13034b 100%);
            color: rgb(0, 255, 200);
        }

        .button12 {
            padding: 0.5em 1.1em;
            border-radius: 5px;
            margin-left: 25px;
            border: none;
            outline: none;
            transition: .4s ease-in-out;
            background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
            color: rgb(0, 0, 0);
            text-decoration: none;
        }

        .button12:hover {
            background-image: linear-gradient(163deg, #00642f 0%, #13034b 100%);
            color: rgb(0, 255, 200);
        }
        .wave-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle, #00ff75 10%, #3700ff 90%);
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

        /* Nouveau style pour les messages */
        .message {
            margin-top: 1rem;
            color: white;
            text-align: center;
        }

        .success {
            background-color: #00ff75;
        }

        .error {
            background-color: #ff0000;
        }
    </style>
</head>
<body>
<div class="wave-animation"></div>
    <div class="form">
        <h2 id="heading">Réinitialisation du mot de passe</h2>
        <form method="post" action="">
            <div class="field">
                <label for="email">Email :</label>
                <input class="input-field" type="email" name="email" required>
            </div>

            <div class="field">
                <label for="new_password">Nouveau mot de passe :</label>
                <input class="input-field" type="password" name="new_password" required>
            </div>

            <div class="field">
                <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
                <input class="input-field" type="password" name="confirm_password" required>
            </div>
            <input class="button12" type="submit" value="Réinitialiser le mot de passe">
        </form>
        <div class="btn">
            <a href="signin" class="button1">Connect</a>
            <a href="signup" class="button1">Sign Up</a>
        </div>
        <!-- Affichage des messages de succès et d'erreur -->
    <?php if ($successMessage): ?>
        <div class="message success"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <?php if ($errorMessage): ?>
        <div class="message error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>
    </div>

</body>
</html>

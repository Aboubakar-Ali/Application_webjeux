<?php
// planté la page si la connexion ne passe pas
require('../../phpconnect/database.php');

$message = '';
$messageClass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];  

        // Fetch the user by username
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Start a new session
            session_start();

            // Store user data into the session
            $_SESSION['user'] = $user;

            // redirection du user sur la page d'acceuil
            header('Location: ../../Acceuil/acceuil.php');
        } else {
            $message = 'Nom d\'utilisateur ou mot de passe incorrect';
            $messageClass = 'error';
        }
    } else {
        $message = 'Veuillez remplir tous les champs';
        $messageClass = 'error';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <style>
        .form {
        display: flex;
        flex-direction: column;
        background-color: transparent;
        gap: 10px;
        padding-left: 2em;
        padding-right: 2em;
        padding-bottom: 0.4em;
        background-color: #171717;
        border-radius: 20px;
        
             }

#heading {
  text-align: center;
  margin: 2em;
  color: rgb(0, 255, 200);
  font-size: 1.2em;
}

.field {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.5em;
  border-radius: 25px;
  padding: 0.6em;
  border: none;
  outline: none;
  color: white;
  background-color: #171717;
  box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
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
  display: flex;
  justify-content: center;
  flex-direction: row;
  margin-top: 2.5em;
}

.button1 {
  padding: 0.5em;
  padding-left: 1.1em;
  padding-right: 1.1em;
  border-radius: 5px;
  margin-right: 0.5em;
  border: none;
  outline: none;
  transition: .4s ease-in-out;
  background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
  color: rgb(0, 0, 0);
  text-decoration: none; /* Supprime le soulignement du lien */
}

.button1:hover {
  background-image: linear-gradient(163deg, #00642f 0%, #13034b 100%);
  color: rgb(0, 255, 200);
}

.button2 {
        padding: 0.5em;
        padding-left: 2.3em;
        padding-right: 2.3em;
        border-radius: 5px;
        border: none;
        outline: none;
        transition: .4s ease-in-out;
        background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
        color: rgb(0, 0, 0);
        text-decoration: none; /* Supprime le soulignement du lien */
        display: inline-block; /* Affiche le lien en tant que bloc */
        cursor: pointer; /* Change le curseur en pointeur au survol */
    }

    .button2:hover {
        background-image: linear-gradient(163deg, #00642f 0%, #13034b 100%);
        color: rgb(0, 255, 200);
    }

.button3 {
  margin-bottom: 3em;
  padding: 0.5em;
  border-radius: 5px;
  border: none;
  outline: none;
  transition: .4s ease-in-out;
  background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
  color: rgb(0, 0, 0);
}

.button3:hover {
  background-image: linear-gradient(163deg, #a00000fa 0%, #d10050 100%);
  color: rgb(255, 255, 255);
}

.card {
  background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
  border-radius: 22px;
  transition: all .3s;
  display: flex;
  justify-content: center; /* Centrer horizontalement */
  align-items: center; /* Centrer verticalement */
  height: 100vh; /* Hauteur égale à la hauteur de la fenêtre */

}
body{
  background-image: linear-gradient(163deg, #00ff75 0%, #3700ff 100%);
  overflow: hidden; /* Empêche le défilement */
}

.card2 {
  border-radius: 0;
  transition: all .2s;
}

.card2:hover {
  transform: scale(0.98);
  border-radius: 20px;
}

.card:hover {
  box-shadow: 0px 0px 30px 1px rgba(0, 255, 117, 0.30);
}
.success {
            color: green;
        }

        .error {
            color: red;
        }

    </style>
</head>
<body>
    <div class="card">
        <div class="card2">
                <form class="form" method="POST" action="singin.php">
                <p id="heading">Login</p>
                <div class="field">
                    <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                    </svg>
                    <input class="input-field" type="text" id="username" name="username" placeholder="Username" autocomplete="off">
                </div>
                <div class="field">
                    <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                    </svg>
                    <input class="input-field" type="password" id="password" name="password" placeholder="password" autocomplete="off">
                </div>
                <div class="btn">
                    <input class="button1" type="submit" value = "connect"> 
                    <a href="/Application_webjeux/Authentification/inscription/singup.php"  class="button2">Sign Up</a>
                </div>
                <button class="button3">Forgot Password</button>
                <?php if (!empty($message)) : ?>
                <p class="<?php echo $messageClass; ?>"><?php echo $message; ?></p>
            <?php endif; ?>

            </form>
        </div>
    </div>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Répertoire de destination pour les vidéos
    $uploadDir = 'stream_/videos/';

    // Génération d'un nom de fichier unique
    $videoName = uniqid('video_') . '.mp4';

    // Chemin complet du fichier de destination
    $targetPath = $uploadDir . $videoName;

    // Déplacer le fichier téléchargé vers le répertoire de destination
    if (move_uploaded_file($_FILES['video']['tmp_name'], $targetPath)) {
        // Enregistrement dans la base de données
        $userId = $_SESSION['user']['id']; // L'ID de l'utilisateur qui a téléchargé la vidéo
        $status = 'live';

        $query = "INSERT INTO streams (user_id, stream_key, status) VALUES (:user_id, :stream_key, :status)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':stream_key', $videoName);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        // Redirection vers la page d'accueil
        header("Location: /$root/");
        exit();
    } else {
        echo 'Une erreur s\'est produite lors du téléchargement de la vidéo.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<?php include 'elements/header.php';
            ?>
                    <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
    <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
    <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
    <title>Formulaire d'envoi de vidéos</title>
    <style>
        body {
            background-color: skyblue;
            background-image: url('https://example.com/waves-animation.gif');
            background-repeat: repeat-x;
            animation: waves 10s infinite linear;
        }

        @keyframes waves {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100% 0;
            }
        }
        .wave-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle, red 10%, blue 90%);
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
            margin: 50px auto;
            max-width: 400px;
            padding: 20px;
            background-color: #333;
            border-radius: 5px;
        }

        form input[type="file"] {
            margin-bottom: 10px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="video" accept="video/mp4">
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>
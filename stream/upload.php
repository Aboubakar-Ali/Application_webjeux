<?php
session_start();
require('../phpconnect/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Répertoire de destination pour les vidéos
    $uploadDir = 'videos/';

    // Génération d'un nom de fichier unique
    $videoName = uniqid('video_') . '.mp4';

    // Chemin complet du fichier de destination
    $targetPath = $uploadDir . $videoName;

    // Déplacer le fichier téléchargé vers le répertoire de destination
    if (move_uploaded_file($_FILES['video']['tmp_name'], $targetPath)) {
        // Enregistrement dans la base de données
        $userId = $_SESSION['user']['id'] ;; // L'ID de l'utilisateur qui a téléchargé la vidéo
        $status = 'live';

        $query = "INSERT INTO streams (user_id, stream_key, status) VALUES (:user_id, :stream_key, :status)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':stream_key', $videoName);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        echo 'Le téléchargement de la vidéo est terminé.';
    } else {
        echo 'Une erreur s\'est produite lors du téléchargement de la vidéo.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'envoi de vidéos</title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="video" accept="video/mp4">
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>

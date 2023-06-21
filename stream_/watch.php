<?php
;

// Récupérer l'ID de la vidéo à lire depuis l'URL
$streamId = $_GET['id'];

// Récupérer les informations de la vidéo depuis la base de données
$query = "SELECT * FROM streams WHERE id = :stream_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':stream_id', $streamId);
$stmt->execute();
$video = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si la vidéo existe et est en direct
if ($video && $video['status'] === 'live') {
    $streamKey = $video['stream_key'];
    $streamPath = 'videos/' . $streamKey;

    // Afficher la vidéo
    echo '<video width="640" height="480" controls>';
    echo '<source src="' . $streamPath . '" type="video/mp4">';
    echo '</video>';
} else {
    echo 'La vidéo demandée est indisponible.';
}
?>

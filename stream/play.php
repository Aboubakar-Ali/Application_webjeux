<?php
require('../phpconnect/database.php');

// Récupérer toutes les vidéos de la base de données avec les informations utilisateur
$query = "SELECT streams.*, user.photo FROM streams INNER JOIN user ON streams.user_id = user.id";
$stmt = $pdo->query($query);
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des vidéos</title>
    <style>
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            grid-gap: 20px;
        }
        .video-item {
            text-align: center;
        }
        .video-item video {
            width: 100%;
        }
        .video-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Liste des vidéos disponibles :</h1>

    <div class="video-grid">
        <?php if (!empty($videos)): ?>
            <?php foreach ($videos as $video): ?>
                <div class="video-item">
                    <?php if (!empty($video['photo'])): ?>
                        <?php
                        // Récupérer l'ID de l'utilisateur associé à la vidéo
                        $userId = $video['user_id'];
                        $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
                        $stmt->execute([$userId]);
                        $profileUser = $stmt->fetch();
                        ?>
                        <?php if ($profileUser): ?>
                            <a href="../test/profilviews.php?user_id=<?php echo $userId; ?>">
                                <img src="<?php echo $video['photo']; ?>" alt="Photo utilisateur">
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="watch.php?id=<?php echo $video['id']; ?>">
                        <video controls>
                            <source src="videos/<?php echo $video['stream_key']; ?>" type="video/mp4">
                        </video>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune vidéo disponible.</p>
        <?php endif; ?>
    </div>
</body>
</html>

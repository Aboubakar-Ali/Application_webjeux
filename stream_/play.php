<?php

// Récupérer toutes les vidéos de la base de données avec les informations utilisateur
$query = "SELECT streams.*, user.photo FROM streams INNER JOIN user ON streams.user_id = user.id";
$stmt = $pdo->query($query);
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?php

    $stmt = $pdo->prepare("SELECT articles.*, user.username FROM articles JOIN user ON articles.user_id = user.id ORDER BY timestamp DESC LIMIT 10");
    $stmt->execute();
    $articles = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des vidéos</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            overflow: hidden;
            background-color: #000;
        }

        .video-container {
            position:fixed;
            margin-top: 10px;
            width: 1000px;
            left:800px;
            max-height: calc(100vh - 100px);
            overflow-y: hidden;
            scroll-snap-type: y mandatory;
        }

        .video-item {
            position: relative;
            width: 90%;
            margin: 0 auto;
            height: 1150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            scroll-snap-align: start;
            background-color: #222;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .profile-photo {
        position: absolute;
        top: 20px; /* Ajustez la valeur pour positionner la photo de profil */
        right: 20px; /* Ajustez la valeur pour positionner la photo de profil */
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        z-index: 1; /* Assurez-vous que la photo de profil se superpose à la vidéo */
    }
.profile-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}



        .profile-photo-large {
            width: 100px;
            height: 100px;
        }

        .video-item video {
            width: 100%;
            height: auto;
            max-height: calc(100vh - 120px);
            object-fit: cover;
            border-radius: 10px;
        }

        @media screen and (max-width: 768px) {
            .video-item {
                width: 90%;
            }
        }

        @media screen and (max-width: 480px) {
            .profile-photo {
                top: 10px;
                right: 10px;
                width: 40px;
                height: 40px;
            }

            .profile-photo img {
                object-position: top;
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
     
    </style>
</head>
<?php include 'elements/header.php'; ?>
<body>
    <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
    <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
    <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
    <div class="video-container">
    <?php foreach ($videos as $video): ?>
    <div class="video-item">
        <?php if (!empty($video['photo'])): ?>
            <?php
                $userId = $video['user_id'];
                $query = "SELECT * FROM user WHERE id = :userId";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $profileUser = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <?php if ($profileUser): ?>
                <a class="profile-link" href="/<?= $root; ?>/profil/?user_id=<?php echo $userId; ?>">
                    <div class="profile-photo">
                        <img src="/<?= $root; ?>/image/<?php echo $video['photo']; ?>" alt="Photo utilisateur">
                    </div>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <video controls autoplay loop muted>
            <source src="/<?= $root; ?>/stream_/videos/<?php echo $video['stream_key']; ?>" type="video/mp4">
        </video>
    </div>
<?php endforeach; ?>


    </div>
    <script>
    var videoItems = document.querySelectorAll('.video-item');
    var currentIndex = 0;
    var isScrolling = false;
    var videoContainer = document.querySelector('.video-container');

    window.addEventListener('wheel', function(event) {
        if (isScrolling) return;

        isScrolling = true;

        var deltaY = event.deltaY;

        if (deltaY < 0 && currentIndex > 0) {
            currentIndex--;
        } else if (deltaY > 0 && currentIndex < videoItems.length - 1) {
            currentIndex++;
        }

        scrollToVideo(currentIndex);

        setTimeout(function() {
            isScrolling = false;
        }, 800); // Réglez le délai de défilement ici (en millisecondes)
    });

    videoContainer.addEventListener('click', function(event) {
        var targetVideoIndex = Array.from(videoItems).indexOf(event.target.closest('.video-item'));

        if (targetVideoIndex !== -1 && targetVideoIndex !== currentIndex) {
            currentIndex = targetVideoIndex;
            scrollToVideo(currentIndex);
        }
    });

    function scrollToVideo(index) {
        videoItems[index].scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Activer le son de la vidéo courante
        videoItems[index].querySelector('video').muted = false;

        // Lancer la lecture de la vidéo courante
        videoItems[index].querySelector('video').play();

        // Mettre en pause les autres vidéos
        for (var i = 0; i < videoItems.length; i++) {
            if (i !== index) {
                videoItems[i].querySelector('video').pause();
            }
        }
    }
</script>

</body>
</html>

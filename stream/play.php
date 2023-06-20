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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #000;
        }

        .navbar {
            background-color: #1d1d1d;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1;
        }

        .navbar h1 {
            font-size: 24px;
            color: #fff;
        }

        .video-container {
            width: 100%;
            max-height: calc(100vh - 60px);
            overflow-y: hidden;
            scroll-snap-type: y mandatory;
        }

        .video-item {
            position: relative;
            width: 70%;
            margin: 0 auto;
            height: calc(100vh - 60px);
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
    top: 20px;
    right: 0px; /* Modifier la valeur pour décaler vers la droite */
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
}


        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            .navbar h1 {
                font-size: 20px;
            }

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
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Bienvenue sur notre site de vidéos</h1>
    </div>


    <div class="video-container">
        <?php foreach ($videos as $video): ?>
            <div class="video-item">
                <div class="profile-photo">
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
                            <a href="../test/profilviews.php?user_id=<?php echo $userId; ?>">
                                <img src="<?php echo $video['photo']; ?>" alt="Photo utilisateur">
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>

                <video controls autoplay loop muted>
                    <source src="videos/<?php echo $video['stream_key']; ?>" type="video/mp4">
                </video>
            </div>
        <?php endforeach; ?>
    </div>
    

    <script>
        var videoItems = document.querySelectorAll('.video-item');
        var currentIndex = 0;
        var isScrolling = false;

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

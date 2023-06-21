

<?php

if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']['id'];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
} else {
    header('Location: ../Authentification/connexion/singin.php');
    exit();
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$user_id]);
    $profile_user = $stmt->fetch();
    if (!$profile_user) {
        header('Location: ../Acceuil/acceuil.php');
        exit();
    }
} else {
    header('Location: test.php?user_id=' . $user_id);
    exit();
}

// Récupérer le nombre d'abonnés
$stmt = $pdo->prepare('SELECT COUNT(*) AS followers_count FROM followers WHERE following_id = ?');
$stmt->execute([$profile_user['id']]);
$followersCount = $stmt->fetch()['followers_count'];

// Récupérer la liste des abonnés
$stmt = $pdo->prepare('SELECT user.username FROM followers JOIN user ON followers.follower_id = user.id WHERE followers.following_id = ?');
$stmt->execute([$profile_user['id']]);
$followers = $stmt->fetchAll();




// Vérifier si l'utilisateur connecté suit le profil de l'utilisateur affiché
$following = false;
if (isset($_SESSION['user'])) {
    $follower_id = $_SESSION['user']['id'];
    $following_id = $profile_user['id'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM followers WHERE follower_id = ? AND following_id = ?");
    $stmt->execute([$follower_id, $following_id]);
    $following = $stmt->fetchColumn() > 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="/<?= $root; ?>/test/test.css">
    <style>
        .followers-list {
            display: none;
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
        a {
            text-decoration: none;
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
    <script>
        function toggleFollowersList() {
            var followersList = document.getElementById('followers-list');
            followersList.style.display = followersList.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
<?php include 'elements/header.php';
            ?>
            <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
        <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
        <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
<div class="container">
    
<div class="card">
        <a href="/<?= $root; ?>/profil/?user_id=<?php echo $profile_user['id']; ?>"><img src="/<?= $root; ?>/image/<?php echo $profile_user['photo']; ?>" alt="Photo de profil" class="card__image"></a>
        <h1 class="card__name"><a href="/<?= $root; ?>/profil/?user_id=<?php echo $profile_user['id']; ?>"><?php echo $profile_user['username']; ?></a></h1>
        <p><?php echo $profile_user['description']; ?></p>
        <div class="grid-container">
            <div class="grid-child-posts">
                156 Post
            </div>
            <div class="grid-child-followers">
                <button onclick="toggleFollowersList()">Follower(s) (<?php echo count($followers); ?>)</button>
                <div id="followers-list" class="followers-list">
                    <?php if (!empty($followers)): ?>
                        <ul>
                            <?php foreach ($followers as $follower): ?>
                                <li><?php echo $follower['username']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Aucun abonné</p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="grid-child-followers">
                1012 Likes
            </div>

        </div>
        <ul class="social-icons">
            <li>
                <a href="../edit_p/">
                    <i class="fa fa-instagram"> <img class="social-icon" src="https://cdn.discordapp.com/attachments/984816485446852629/1114110196210471012/image.png" alt=""></i>
                </a>
            </li>
            <li>
                <a href="../publish/">
                    <i class="fa fa-twitter"><img class="social-icon" src="https://cdn.discordapp.com/attachments/984816485446852629/1114109974562476042/friends_link_send_share_icon_123609.png" alt=""></i>
                </a>
            </li>
        </ul>

        <div class="bouton_profil">
            <a href="../messages/private_messages"> <button class="btn draw-border">Messages</button></a> 
            <a href="../dm/demo"> <button class="btn draw-border">DM</button></a>
            <a href="../stream/push"> <button class="btn draw-border">video push</button></a> 

            <?php if ($user_id !== $id): // Ne pas afficher le bouton "Follow" si c'est le profil de l'utilisateur connecté lui-même ?>
                <?php if ($following): ?>
                    <button class="follow-button" data-user-id="<?php echo $profile_user['id']; ?>" disabled>Followed</button>
                <?php else: ?>
                    <button class="follow-button" data-user-id="<?php echo $profile_user['id']; ?>">Follow</button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Gestion du clic sur le bouton "Follow"
        $('.follow-button').click(function () {
            var userId = $(this).data('user-id');
            var button = $(this);

            // Envoi de la demande AJAX pour suivre/unfollow l'utilisateur
            $.ajax({
                url: 'follow.php',
                method: 'POST',
                data: {
                    user_id: userId
                },
                success: function (response) {
                    if (response === 'followed') {
                        button.text('Followed');
                        button.attr('disabled', true);
                    } else if (response === 'unfollowed') {
                        button.text('Follow');
                        button.attr('disabled', false);
                    }
                }
            });
        });
    });
</script>
</body>
</html>



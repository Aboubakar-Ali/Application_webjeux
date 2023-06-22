<?php

if (!isset($_SESSION['user']) || $_SESSION['user']['username'] !== 'admin') {
    header("Location: /$root/");
    exit;
}

// Fonction pour supprimer un article
function deleteArticle($articleId) {
    global $pdo;
    $sql = "DELETE FROM articles WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $articleId, PDO::PARAM_INT);
    $stmt->execute();
}

// Fonction pour supprimer une vidéo
function deleteVideo($videoId) {
    global $pdo;
    $sql = "DELETE FROM streams WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $videoId, PDO::PARAM_INT);
    $stmt->execute();
}

// Supprimer un article si son ID est fourni dans la requête
if (isset($_GET['delete_article'])) {
    $articleId = $_GET['delete_article'];
    deleteArticle($articleId);

    // Rediriger l'utilisateur vers le tableau de bord après la suppression
    header("Location: dashboard.php");
    exit;
}

// Supprimer une vidéo si son ID est fourni dans la requête
if (isset($_GET['delete_video'])) {
    $videoId = $_GET['delete_video'];
    deleteVideo($videoId);

    // Rediriger l'utilisateur vers le tableau de bord après la suppression
    header("Location: dashboard.php");
    exit;
}

// Fonction pour supprimer un utilisateur
function deleteUser($userId) {
    global $pdo;
    $sql = "DELETE FROM user WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
}

// Supprimer un utilisateur si son ID est fourni dans la requête
if (isset($_GET['delete_user'])) {
    $userId = $_GET['delete_user'];
    deleteUser($userId);

    // Rediriger l'utilisateur vers le tableau de bord après la suppression
    header("Location: dashboard.php");
    exit;
}

// Récupérer tous les articles
$sqlArticles = "SELECT * FROM articles";
$resultArticles = $pdo->query($sqlArticles);

// Récupérer toutes les vidéos de la base de données
$sqlVideos = "SELECT streams.*, user.photo FROM streams INNER JOIN user ON streams.user_id = user.id";
$resultVideos = $pdo->query($sqlVideos);
$videos = $resultVideos->fetchAll(PDO::FETCH_ASSOC);

// Récupérer tous les utilisateurs
$sqlUsers = "SELECT * FROM user";
$resultUsers = $pdo->query($sqlUsers);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de bord ADMIN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #fff;
        }

        h1 {
            font-size: 28px;
            text-align: center;
            margin-top: 40px;
        }

        h2 {
            font-size: 24px;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #444;
        }

        tr:hover {
            background-color: #666;
        }

        .video-wrapper {
            display: flex;
            align-items: center;
        }

        .video-thumbnail {
            width: 320px;
            height: 240px;
            background-color: #222;
            border-radius: 5px;
            overflow: hidden;
        }

        .video-thumbnail video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-details {
            margin-left: 20px;
        }

        .video-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .video-actions {
            margin-top: 10px;
            font-size: 14px;
        }

        .video-actions a {
            margin-right: 10px;
            color: #00f;
            text-decoration: none;
        }

        .video-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .video-item {
            width: calc(33.33% - 20px);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include 'elements/header.php';?>

<h1>Tableau de bord ADMIN</h1>

<h2>Articles</h2>
<table>
    <tr>
        <th>Titre</th>
        <th>Contenu</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $resultArticles->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['content']; ?></td>
            <td><a href="?delete_article=<?php echo $row['id']; ?>">Supprimer</a></td>
        </tr>
    <?php endwhile; ?>
</table>

<h2>Vidéos</h2>
<div class="video-list">
    <?php foreach ($videos as $video): ?>
        <div class="video-item">
            <div class="video-wrapper">
                <div class="video-thumbnail">
                    <video controls>
                        <source src="/<?= $root; ?>/stream_/videos/<?php echo $video['stream_key']; ?>" type="video/mp4">
                    </video>
                </div>
                <div class="video-details">
                    <div class="video-title">ID: <?php echo $video['id']; ?></div>
                    <div class="video-actions">
                        <a href="?delete_video=<?php echo $video['id']; ?>">Supprimer</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<h2>Utilisateurs</h2>
<table>
    <tr>
        <th>Nom d'utilisateur</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $resultUsers->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><a href="?delete_user=<?php echo $row['id']; ?>">Supprimer</a></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

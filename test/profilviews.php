<?php
session_start();
require('../phpconnect/database.php');

if (isset($_SESSION['user'])) {
    $id = $_SESSION['user']['id'];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
} else {
    header('Location: ../Authentification/connexion/singin.php');
    exit(); // Assurez-vous de terminer le script après la redirection
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$user_id]);
    $profile_user = $stmt->fetch();
    if (!$profile_user) {
        // L'ID de l'utilisateur fourni n'existe pas dans la base de données, vous pouvez rediriger vers une page d'erreur ou utiliser l'ID de l'utilisateur connecté par défaut
        header('Location: ../Acceuil/acceuil.php'); // Redirige vers le profil de l'utilisateur connecté
        exit(); // Assurez-vous de terminer le script après la redirection
    }
} else {
    // Si aucun user_id n'est passé dans l'URL, vous pouvez rediriger vers une page d'erreur ou utiliser l'ID de l'utilisateur connecté par défaut
    header('Location: test.php?user_id=' . $user_id); // Redirige vers le profil de l'utilisateur connecté
    exit(); // Assurez-vous de terminer le script après la redirection

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="test.css">
</head>
<body>
<div class="container">
    <div class="card">
        <a href="../test/test.php?user_id=<?php echo $profile_user['id']; ?>"><img src="<?php echo $profile_user['photo']; ?>" alt="Photo de profil" class="card__image"></a>
        <h1 class="card__name"><a href="../test/profilviews.php?user_id=<?php echo $profile_user['id']; ?>"><?php echo $profile_user['username']; ?></a></h1>
        <p><?php echo $profile_user['description']; ?></p>
        <div class="grid-container">
            <div class="grid-child-posts">
                156 Post
            </div>

            <div class="grid-child-followers">
                1012 Likes
            </div>

        </div>
        <div class="bouton_profil">
            <a href="../chat privé/demo.php"> <button class="btn draw-border">DM</button></a>
        </div>
    </div>
</div>
</body>
</html>

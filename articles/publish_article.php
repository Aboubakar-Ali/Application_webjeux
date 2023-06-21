<?php

;

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "Vous devez être connecté pour publier un article.";
    exit();
}

// Si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez le titre et le contenu de l'article du formulaire
    $article_title = $_POST['title'];
    $article_content = $_POST['content'];

    // Insérez un nouvel enregistrement dans la table des articles
    $stmt = $pdo->prepare("INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)");
    $stmt->execute([$_SESSION['user']['id'], $article_title, $article_content]);

    echo "Votre article a été publié avec succès.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Publier un article</title>
</head>
<body>
    <h1>Publier un article</h1>
    <form action="publish_article.php" method="POST">
        <label for="title">Titre de l'article :</label>
        <input type="text" id="title" name="title">
        <label for="content">Contenu :</label>
        <textarea id="content" name="content"></textarea>
        <input type="submit" value="Publier">
    </form>
</body>
</html>

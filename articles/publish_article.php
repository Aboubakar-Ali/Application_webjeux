<?php

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    echo "Vous devez être connecté pour publier un article.";
    exit();
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Publier un article</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222831;
            overflow: hidden;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
            margin-top: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            margin-top: 20px;
            background-color: #ff5e3a;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ff7b5a;
        }

    </style>
</head>
<?php include 'elements/header.php';
            ?>
<body>
    
    <div class="container">
        <h1>Publier un article</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="title">Titre de l'article :</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="content">Contenu :</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <input type="submit" value="Publier">
        </form>
        <?php 
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
       
    </div>
</body>
</html>

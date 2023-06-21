<?php 
    
    if (!isset($_SESSION['user'])) {
        echo "Vous devez être connecté pour modifier votre profil.";
        exit();
    }
    
    // Récupérez les informations de l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$_SESSION['user']['id']]);
    $user = $stmt->fetch();
?>
<head>
    <title>Modifier le profil</title>
    <style>
        body {
            background-color: skyblue;
            background-image: url('https://example.com/waves-animation.gif');
            background-repeat: repeat-x;
            animation: waves 10s infinite linear;
        }

        @keyframes waves {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 100% 0;
            }
        }

        .edit-profile {
            margin: 50px auto;
            max-width: 400px;
            padding: 30px;
            background-color: white;
            border-radius: 5px;
        }

        .edit-profile label {
            font-weight: bold;
        }

        .edit-profile input[type="text"],
        .edit-profile textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .edit-profile input[type="file"] {
            margin-top: 10px;
        }

        .edit-profile input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="edit-profile">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="username">Nom d'utilisateur:</label><br>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>"><br>
            
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"><?php echo $user['description']; ?></textarea><br>
            
            <label for="photo">Photo de profil:</label><br>
            <input type="file" id="photo" name="photo"><br>
            
            <input type="submit" value="Mettre à jour">
        </form>
    </div>
</body>

<?php
if (!empty($_POST)) {    
    $username = $_POST['username'];
    $description = $_POST['description'];

    $photo = $_FILES['photo']['tmp_name'];
    $photo_name = $_FILES['photo']['name'];
    
    // Vérifier si l'utilisateur a choisi une nouvelle photo
    if ($photo) {
        move_uploaded_file($photo, 'image/' . $photo_name);
    } else {
        $photo_path = $user['photo'];
    }

    // Vérifiez si le nom d'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = ? AND id != ?");
    $stmt->execute([$username, $_SESSION['user']['id']]);
    $existing_user = $stmt->fetch();

    if ($existing_user) {
        echo "Ce nom d'utilisateur est déjà pris.";
    } else {
        // Mettez à jour les informations de l'utilisateur
        $stmt = $pdo->prepare("UPDATE user SET username = ?, description = ?, photo = ? WHERE id = ?");
        $stmt->execute([$username, $description, $photo_name, $_SESSION['user']['id']]);

        // Mettre à jour les informations de l'utilisateur dans la session
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['description'] = $description;
        $_SESSION['user']['photo'] = $photo_path;

        // redirection vers la PP
        header('Location: ../test/test.php');
    }}
?>

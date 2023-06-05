<?php
    session_start();
    require('../phpconnect/database.php');

    $username = $_POST['username'];
    $description = $_POST['description'];

    $photo = $_FILES['photo']['tmp_name'];
    $photo_name = $_FILES['photo']['name'];
    
    // Vérifier si l'utilisateur a choisi une nouvelle photo
    if ($photo) {
        $photo_path = '../image/' . $photo_name;
        move_uploaded_file($photo, $photo_path);
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
        $stmt->execute([$username, $description, $photo_path, $_SESSION['user']['id']]);

        // Mettre à jour les informations de l'utilisateur dans la session
        $_SESSION['user']['username'] = $username;
        $_SESSION['user']['description'] = $description;
        $_SESSION['user']['photo'] = $photo_path;

        // redirection vers la PP
        header('Location: ../test/test.php');
    }
?>

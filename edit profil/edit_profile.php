<?php 
    session_start();
    require('../phpconnect/database.php');
    
    if (!isset($_SESSION['user'])) {
        echo "Vous devez être connecté pour modifier votre profil.";
        exit();
    }
    
    // Récupérez les informations de l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$_SESSION['user']['id']]);
    $user = $stmt->fetch();
?>
<body>
    <div class="edit-profile">
        <form action="update_profile.php" method="POST" enctype="multipart/form-data">
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

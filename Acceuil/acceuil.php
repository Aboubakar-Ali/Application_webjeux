<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>acceuil</title>
        <link rel="stylesheet" type="text/css" href="acceuil.css">
        <script>
            var username = "<?php echo $_SESSION['user']['username']; ?>";
        </script>
        <script src="../chat general/client/chat.js"></script> 
    </head>
<body>
    <div class="navbar">
        <h1>Mon Application</h1>
        <a href="../profil/index.php" class="profile-link">Profil</a>
    </div>
        
    <div class="content">
        <div class="main-content">
            <h2>Publications</h2>
            <!-- Code pour afficher les publications ici -->
        </div>
        
        <div class="chat">
            <h2>Chat Général</h2>
            <!-- Code pour afficher le chat ici -->
            <div id="chat-messages"></div>
            <form id="chat-form">
                <input type="text" id="chat-input">
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
</body>
</html>

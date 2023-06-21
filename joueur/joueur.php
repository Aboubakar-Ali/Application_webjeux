<!DOCTYPE html>
<html>
<head>
    <title>Affichage des profils des joueurs</title>
    <style>
        /* CSS existant */
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            overflow: hidden;
            margin: 0; /* Ajout pour enlever les marges par défaut du body */
            padding: 0; 
        }
        body:before,
        body:after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            z-index: -1;
            opacity: 0.8;
            animation-duration: 20s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        body:before {
            animation-name: background-anim1;
        }

        body:after {
            animation-name: background-anim2;
        }

        @keyframes background-anim1 {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
                background: radial-gradient(circle at center, #ff6eff 10%, transparent 60%), linear-gradient(to right, #ff002d, #ff6eff, #ff002d);
            }
            50% {
                transform: translate(-50%, -50%) rotate(180deg);
                background: radial-gradient(circle at center, #ff002d 10%, transparent 60%), linear-gradient(to right, #ff6eff, #ff002d, #ff6eff);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
                background: radial-gradient(circle at center, #ff6eff 10%, transparent 60%), linear-gradient(to right, #ff002d, #ff6eff, #ff002d);
            }
        }

        @keyframes background-anim2 {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
                background: radial-gradient(circle at center, #00ffff 10%, transparent 60%), linear-gradient(to right, #00ff00, #00ffff, #00ff00);
            }
            50% {
                transform: translate(-50%, -50%) rotate(180deg);
                background: radial-gradient(circle at center, #00ff00 10%, transparent 60%), linear-gradient(to right, #00ffff, #00ff00, #00ffff);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
                background: radial-gradient(circle at center, #00ffff 10%, transparent 60%), linear-gradient(to right, #00ff00, #00ffff, #00ff00);
            }
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fade-in 0.6s ease-in-out;
            max-height: 500px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: transparent transparent;
        }

        
        ::-webkit-scrollbar {
            width: 0.5em;
            background-color: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: transparent;
        }

        h1 {
            text-align: center;
            color: #ff6eff;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-top: 0;
        }

        .joueur {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #333;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-left: 10px;
            border: 2px solid #ff6eff;
        }

        .profil {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #1e1e1e;
            border: 1px solid #ff6eff;
            border-radius: 4px;
            order: 1;
            animation: fade-in 0.6s ease-in-out;
        }

        .profil p {
            margin: 0;
            color: #fff;
            font-size: 14px;
        }

        /* Couleurs et styles personnalisés */
        .joueur:hover {
            background-color: #333;
        }

        .joueur.active {
            background-color: #ff6eff;
        }

        .profil p strong {
            color: #ff6eff;
        }

        .search-bar {
            margin-bottom: 20px;
        }

        .search-input {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: none;
            font-size: 16px;
            margin-bottom: 10px;
            background-color: #333;
            color: #fff;
        }

        .filters {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .filter-label {
            color: #fff;
            margin-right: 10px;
        }

        .filter-input {
            padding: 4px 8px;
            border-radius: 4px;
            border: none;
            font-size: 14px;
            background-color: #333;
            color: #fff;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Styles futuristes */
        body:before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            z-index: -1;
            opacity: 0.8;
            animation: background-anim 20s infinite;
        }

        @keyframes background-anim {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
                background: radial-gradient(circle at center, #ff6eff 10%, transparent 60%), linear-gradient(to right, #ff002d, #ff6eff, #ff002d);
            }
            50% {
                transform: translate(-50%, -50%) rotate(180deg);
                background: radial-gradient(circle at center, #ff002d 10%, transparent 60%), linear-gradient(to right, #ff6eff, #ff002d, #ff6eff);
            }
            100% {
                transform: translate(-50%, -50%) rotate(360deg);
                background: radial-gradient(circle at center, #ff6eff 10%, transparent 60%), linear-gradient(to right, #ff002d, #ff6eff, #ff002d);
            }
        }

        /* Nouveaux styles pour le thème néon japonais et moderne */
        body {
            background-color: #000;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.5);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }

        h1 {
            color: #ff6eff;
            letter-spacing: 4px;
        }

        .joueur {
            border-bottom: 1px solid #333;
            background-color: #1e1e1e;
            transition: background-color 0.3s ease;
        }

        .joueur:hover {
            background-color: #333;
        }

        .avatar {
            border: 2px solid #ff6eff;
        }

        .profil {
            background-color: #1e1e1e;
            border: 1px solid #ff6eff;
        }

        .profil p {
            color: #fff;
        }

        .search-input, .filter-input {
            background-color: #1e1e1e;
            color: #fff;
            border: 1px solid #ff6eff;
        }

        .search-input::placeholder, .filter-input::placeholder {
            color: #999;
        }
    </style>
</head>
<body>

<?php include 'elements/header.php';
            ?>
            <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
        <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
        <div class="wave-animation"></div> <!-- L'élément pour les vagues -->
<div class="container">
    </br></br>
    <div class="container">
        <h1>Profils des joueurs</h1>

        <div class="search-bar">
            <input type="text" id="searchInput" class="search-input" placeholder="Rechercher un joueur...">
        </div>

        <div class="filters">
            <div class="filter">
                <label for="levelFilter" class="filter-label">Niveau :</label>
                <input type="number" id="levelFilter" class="filter-input" min="1" max="10">
            </div>

            <div class="filter">
                <label for="scoreFilter" class="filter-label">Score :</label>
                <input type="number" id="scoreFilter" class="filter-input" min="0" max="9999">
            </div>
        </div>

        <?php
        // Lecture du fichier JSON
        $data = file_get_contents('joueur/data.json');

        // Conversion du JSON en tableau associatif
        $joueurs = json_decode($data, true);

        // Vérification des erreurs lors de la lecture du JSON
        if ($joueurs === null) {
            echo 'Erreur lors de la lecture du fichier JSON.';
        } else {
            // Parcours des joueurs et affichage de leurs profils complets
            foreach ($joueurs['joueurs'] as $index => $joueur) {
                echo '<div class="joueur">
                        <img class="avatar" src="' . $joueur['avatar'] . '" alt="Avatar joueur">
                        <span style="color: #fff;">' . $joueur['nom'] . '</span>
                        <div class="profil">
                            <p><strong>Nom:</strong> ' . $joueur['nom'] . '</p>
                            <p><strong>Score:</strong> <span class="score">' . $joueur['score'] . '</span></p>
                            <p><strong>Niveau:</strong> <span class="niveau">' . $joueur['niveau'] . '</span></p>
                        </div>
                    </div>';
            }
        }
        ?>

        <script>
            var joueurs = <?php echo json_encode($joueurs['joueurs']); ?>;
            var searchInput = document.getElementById('searchInput');
            var levelFilter = document.getElementById('levelFilter');
            var scoreFilter = document.getElementById('scoreFilter');

            function filtrerJoueurs() {
                var searchValue = searchInput.value.toLowerCase();
                var levelValue = parseInt(levelFilter.value);
                var scoreValue = parseInt(scoreFilter.value);

                var joueursElements = document.getElementsByClassName('joueur');

                for (var i = 0; i < joueursElements.length; i++) {
                    var joueurElement = joueursElements[i];
                    var profilElement = joueurElement.querySelector('.profil');
                    var scoreElement = joueurElement.querySelector('.score');
                    var niveauElement = joueurElement.querySelector('.niveau');

                    var joueur = joueurs[i];

                    var shouldShow = joueur.nom.toLowerCase().indexOf(searchValue) !== -1;

                    if (levelValue > 0) {
                        shouldShow = shouldShow && joueur.niveau === levelValue;
                    }

                    if (scoreValue > 0) {
                        shouldShow = shouldShow && joueur.score === scoreValue;
                    }

                    if (shouldShow) {
                        joueurElement.style.display = 'flex';
                        scoreElement.innerText = joueur.score;
                        niveauElement.innerText = joueur.niveau;
                    } else {
                        joueurElement.style.display = 'none';
                    }
                }
            }

            function afficherProfil(event) {
                var joueurElement = event.currentTarget;
                var profilElement = joueurElement.querySelector('.profil');

                joueurElement.classList.toggle('active');
                profilElement.style.display = joueurElement.classList.contains('active') ? 'block' : 'none';
            }

            searchInput.addEventListener('input', filtrerJoueurs);
            levelFilter.addEventListener('input', filtrerJoueurs);
            scoreFilter.addEventListener('input', filtrerJoueurs);

            var joueursElements = document.getElementsByClassName('joueur');

            for (var i = 0; i < joueursElements.length; i++) {
                var joueurElement = joueursElements[i];
                joueurElement.addEventListener('click', afficherProfil);
            }
        </script>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="play.css">
    <title>PitchBoss</title>

    <?php
    require('../controller/isConnected.php');
    include('../controller/getUserInfo.php');
    ?>
</head>

<body>
    <header>
        <div class="back-button" onclick="goBack()"></div>

        <script>
            // La fonction pour revenir à la page précédente
            function goBack() {
                window.history.back();
            }
        </script>
        <div class="logo-container">
            <a id="mainlogo" href="index.php">
                <img src="images/logo.png" alt="logo">
            </a>
        </div>

        <div id="menu-icon">
            <img src="images/fleche.png" alt="menu">
        </div>

        <div id="menu" class="menu-closed">
            <a id="decologo" href="../controller/logout.php">
                <img id="menuimg" src="images/logo.png" alt="Logo">
            </a>
            <a href="versus.php">Prochain Match</a>
            <a href="player_list.php">Mes joueurs</a>
            <a href="packs_page.php">Packs</a>
            <a href="classement.php">Classement</a>
            <a href="allplayers.php">Meilleurs joueurs</a>

            <a href="../controller/logout.php">
                <img id="decoimg" src="images/deconnexion.png" alt="Déconnexion">
            </a>

        </div>
    </header>
    <div class="playbtncontainer">
        <div class="playbt">
            <a id="myteambtn" href="myteam.php">
                <img class="imgbt" src="images/myteam.png" alt="logo">
            </a>
        </div>
        <div class="playbt">
            <a id="versusbtn" href="versus.php">
                <img class="imgbt" src="images/versus.png" alt="logo">
            </a>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
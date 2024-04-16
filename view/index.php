<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
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
            <a id="menulogo" href="index.php">
                <img id="menuimg" src="images/logo.png" alt="Logo">
            </a>
            <a href="versus.php">Prochain Match</a>
            <a href="player_list.php">Mes joueurs</a>
            <a href="packs_page.php">Packs</a>
            <a href="classement.php">Classement</a>
            <a href="allplayers.php">Meilleurs joueurs</a>

            <a id="decologo" href="../controller/logout.php">
                <img id="decoimg" src="images/deconnexion.png" alt="Déconnexion">
            </a>

        </div>
    </header>

    <div class="body-content">
        <div class="buypacks">
            <div class="user-infos">
                <div class="user-info">
                    <img class="infoimg" src="images/username_icon.png" alt="User Icon">
                    <p><?php echo $username; ?></p>
                </div>
                <div class="user-info">
                    <img class="infoimg" src="images/credits_icon.png" alt="Credits Icon">
                    <p><?php echo $user['credits'] . " crédits"; ?></p>
                </div>

                <div class="user-info">

                    <img class="infoimg" src="images/team_icon.png" alt="Team Icon">
                    <p><?php echo $user['team']; ?></p>
                </div>

            </div>
            <div class="playcontainer">
                <a href="play.php" class="button playbtn">Jouer</a> <!-- Nouveau bouton ajouté -->
            </div>
        </div>


    </div>
    <div class="buttonsbox">
        <div class="buttonbox">
            <img class="infoimg" src="images/packs.png" alt="Packs">
            <a href="packs_page.php" class="button">Packs</a> <!-- Nouveau bouton ajouté -->
        </div>

        <div class="buttonbox">
            <img class="infoimg" src="images/players.png" alt="Players">
            <a href="player_list.php" class="button">Joueurs</a> <!-- Nouveau bouton ajouté -->
        </div>

        <!-- <div class="buttonbox"> 
//    <img class="infoimg" src="images/trade.png" alt="Trades">
    <a href="trades_page.php" class="button">Marché</a>   
</div> -->


    </div>
    <script src="script.js"></script>
</body>

</html>
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
    include('../controller/getPackInfo.php');

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


        </div>
    </div>

    <div class="buttonsbox">
        <div class="packbox">
            <img src="images/pack.png" alt="Votre image">
            <p>Vous possédez <?php echo $pack_info['pack_count']; ?> packs.</p>
            <?php if ($pack_info['pack_count'] > 0) : ?>
                <a href="open_packs.php" class="button">Ouvrir</a> <!-- Le bouton sera affiché uniquement si le nombre de packs est supérieur à 0 -->
            <?php endif; ?>

        </div>

        <div class="packbox">
            <img class="infoimg" src="images/buypacks.png" alt="Players">
            <a href="buy_packs.php" class="button">Acheter</a> <!-- Nouveau bouton ajouté -->
        </div>




    </div>
    <script src="script.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Votre Site Web</title>
    
     <?php
        // require('../controller/isConnected.php');
        include('../controller/getUserInfo.php');
        include('../model/functions.php');

        
    ?> 
</head>
<body>
<header>
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
            <p><?php echo $user['credits']. " crédits"; ?></p>
            </div>

            <div class="user-info">

            <img class="infoimg" src="images/team_icon.png" alt="Team Icon">
            <p><?php echo $user['team']; ?></p>
            </div>

        </div>
        </div>  
    </div>
    <div class="player-cards-container"> <!-- Add this line -->

        <?php 
                include('../controller/getGeneratedPlayers.php');
                foreach ($players as $player) : ?>
      <div class="player-card">
    <div class="player-info">
        <span class="player-name"><?php echo $player['firstName']; ?></span>
        <span class="player-lastname"><?php echo $player['lastName']; ?></span>
    </div>
    <div class="player-flag">
    <img src="../assets/flags/<?php echo strtolower($player['nationality']); ?>.png" alt="<?php echo $player['nationality']; ?>">
    </div>
    <div class="player-face">
        <img class="face-element" src="<?php echo $player['faceLink']; ?>" alt="Face">
        <img class="face-element" src="<?php echo $player['noseLink']; ?>" alt="Nose">
        <img class="face-element" src="<?php echo $player['eyebrowsLink']; ?>" alt="Eyebrows">
        <img class="face-element" src="<?php echo $player['mouthLink']; ?>" alt="Mouth">
        <img class="face-element" src="<?php echo $player['eyesLink']; ?>" alt="Eyes">
    </div>
    <div class="player-ratings">
        <div class="player-rating">
            <span class="position">G</span>
            <div class="rating-circle" style="background-color: <?php echo getRatingColor($player['noteGardien']); ?>">
                <?php echo $player['noteGardien']; ?>
            </div>
        </div>
        <div class="player-rating">
            <span class="position">D</span>
            <div class="rating-circle" style="background-color: <?php echo getRatingColor($player['noteDefenseur']); ?>">
                <?php echo $player['noteDefenseur']; ?>
            </div>
        </div>
        <div class="player-rating">
            <span class="position">M</span>
            <div class="rating-circle" style="background-color: <?php echo getRatingColor($player['noteMilieu']); ?>">
                <?php echo $player['noteMilieu']; ?>
            </div>
        </div>
        <div class="player-rating">
            <span class="position">A</span>
            <div class="rating-circle" style="background-color: <?php echo getRatingColor($player['noteAttaquant']); ?>">
                <?php echo $player['noteAttaquant']; ?>
            </div>
        </div>
    </div>
    <div class="player-score">
        <div class="score-circle" style="background-color: <?php echo getRatingColor($player['totalscore']); ?>">
            <?php echo $player['totalscore']; ?>
        </div>
    </div>
</div>
        <?php endforeach; ?>
        </div> <!-- Add this line -->

         
        <script src="script.js"></script>
</body>
</html>

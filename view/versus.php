<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="play.css">
    <link rel="stylesheet" href="versus.css">

    <title>PitchBoss</title>
    
     <?php
        require('../controller/isConnected.php');
        include('../controller/getUserInfo.php');
        include ('../controller/fetch_match_data.php'); 
        include ('../model/functions.php'); 
        include('../controller/nextMatchController.php');
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
    <div id="background-image">
        
<div id="next-match">
    <h2>Prochain match</h2>
    <p><?php echo date('d-m-Y', strtotime($nextMatchDate)); ?></p>
    <h3>18H</h3>
    <div class="classcontainer">
<a class="voirclass" href="last_match_stats.php">Dernier match</a></div>
<script src="script.js"></script>

</div>
    <div class="team" id="team-left">
    <h2><?php echo $teamA['team_name']; ?></h2>
    <?php foreach ($teamA['players'] as $player): ?>
    <div class="player-row">
        <!-- Assurez-vous de remplacer "path_to_your_icons" par le véritable chemin vers vos icônes de position -->
        <img class="player-position" src="images/<?php echo substr($player['position'], 0, -1); ?>.png" alt="<?php echo $player['position']; ?>">
        <span class="player_name"><?php echo substr($player['firstName'], 0, 1) . '. ' . $player['lastName']; ?></span>
        <div class="player-rating" style="background-color: 
<?php 
    switch ($player['position']) {
        case 'gk1':
            echo getRatingColor($player['noteGardien']);
            break;
        case 'def1':
        case 'def2':
        case 'def3':
        case 'def4':
            echo getRatingColor($player['noteDefenseur']);
            break;
        case 'mid1':
        case 'mid2':
        case 'mid3':
            echo getRatingColor($player['noteMilieu']);
            break;
        case 'atk1':
        case 'atk2':
        case 'atk3':
            echo getRatingColor($player['noteAttaquant']);
            break;
    }
?>
;">
    <?php 
        switch ($player['position']) {
            case 'gk1':
                echo $player['noteGardien'];
                break;
            case 'def1':
            case 'def2':
            case 'def3':
            case 'def4':
                echo $player['noteDefenseur'];
                break;
            case 'mid1':
            case 'mid2':
            case 'mid3':
                echo $player['noteMilieu'];
                break;
            case 'atk1':
            case 'atk2':
            case 'atk3':
                echo $player['noteAttaquant'];
                break;
        }
    ?>
</div>

<span class="player-totalscore" style="background-color: <?php echo getRatingColor($player['totalscore']); ?>;">
    <?php echo $player['totalscore']; ?>
</span>
    </div>
    <?php endforeach; ?>
    <div class="totalmoyenne">
    <div class="notecontainer">
    <img class="poste-icon" src="images/gk.png" alt="GK">
    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamA['avgGK']); ?>;">
        <?php echo round($teamA['avgGK']); ?>
    </span>
    </div>
    <div class="notecontainer">
    <img class="poste-icon" src="images/def.png" alt="DEF">
    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamA['avgDEF']); ?>;">
        <?php echo round($teamA['avgDEF']); ?>
    </span>
    </div>
    <div class="notecontainer">
    <img class="poste-icon" src="images/mid.png" alt="MID">
    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamA['avgMID']); ?>;">
        <?php echo round($teamA['avgMID']); ?>
    </span>
    </div>
    <div class="notecontainer">
    <img class="poste-icon" src="images/atk.png" alt="ATK">
    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamA['avgATK']); ?>;">
        <?php echo round($teamA['avgATK']); ?>
    </span>
    </div>
    <div class="totalcontainer">

    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamA['avgTotalScore']); ?>;">
        <?php echo round($teamA['avgTotalScore']); ?>
    </span>
    </div>

    </div>
    <div class="last-matches">
    <h2>5 derniers matchs</h2>
    <ul>
        <?php foreach ($lastMatchesA as $match): ?>
            <li><?php echo $match['teamA_name'] . ' ' . $match['scoreA'] . ' : ' . $match['scoreB'] . ' ' . $match['teamB_name']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>

</div>




<div class="team" id="team-right">
    <h2><?php echo $teamB['team_name']; ?></h2>
    <?php foreach ($teamB['players'] as $player): ?>
    <div class="player-row">
        <!-- Assurez-vous de remplacer "path_to_your_icons" par le véritable chemin vers vos icônes de position -->
        <img class="player-position" src="images/<?php echo substr($player['position'], 0, -1); ?>.png" alt="<?php echo $player['position']; ?>">
        <span class="player_name"><?php echo substr($player['firstName'], 0, 1) . '. ' . $player['lastName']; ?></span>
        <div class="player-rating" style="background-color: 
<?php 
    switch ($player['position']) {
        case 'gk1':
            echo getRatingColor($player['noteGardien']);
            break;
        case 'def1':
        case 'def2':
        case 'def3':
        case 'def4':
            echo getRatingColor($player['noteDefenseur']);
            break;
        case 'mid1':
        case 'mid2':
        case 'mid3':
            echo getRatingColor($player['noteMilieu']);
            break;
        case 'atk1':
        case 'atk2':
        case 'atk3':
            echo getRatingColor($player['noteAttaquant']);
            break;
    }
?>
;">
    <?php 
        switch ($player['position']) {
            case 'gk1':
                echo $player['noteGardien'];
                break;
            case 'def1':
            case 'def2':
            case 'def3':
            case 'def4':
                echo $player['noteDefenseur'];
                break;
            case 'mid1':
            case 'mid2':
            case 'mid3':
                echo $player['noteMilieu'];
                break;
            case 'atk1':
            case 'atk2':
            case 'atk3':
                echo $player['noteAttaquant'];
                break;
        }
    ?>
</div>

<span class="player-totalscore" style="background-color: <?php echo getRatingColor($player['totalscore']); ?>;">
    <?php echo $player['totalscore']; ?>
</span>
    </div>
    <?php endforeach; ?>
    <div class="totalmoyenne">
        <div class="notecontainer">
    <img class="poste-icon" src="images/gk.png" alt="GK">
    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamB['avgGK']); ?>;">
        <?php echo round($teamB['avgGK']); ?>
    </span>
    </div>
    <div class="notecontainer">

    <img class="poste-icon" src="images/def.png" alt="DEF">
    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamB['avgDEF']); ?>;">
        <?php echo round($teamB['avgDEF']); ?>
    </span>
    </div>
    <div class="notecontainer">
    <img class="poste-icon" src="images/mid.png" alt="MID">
    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamB['avgMID']); ?>;">
        <?php echo round($teamB['avgMID']); ?>
    </span>
    </div>
    <div class="notecontainer">
    <img class="poste-icon" src="images/atk.png" alt="ATK">
    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamB['avgATK']); ?>;">
        <?php echo round($teamB['avgATK']); ?>
    </span>
    </div>
    <div class="totalcontainer">

    <span class="score-cercle" style="background-color: <?php echo getRatingColor($teamB['avgTotalScore']); ?>;">
        <?php echo round($teamB['avgTotalScore']); ?>
    </span>
    </div>
    </div>
    <div class="last-matches">
    <h2>5 derniers matchs</h2>
    <ul>
        <?php foreach ($lastMatchesB as $match): ?>
            <li><?php echo $match['teamA_name'] . ' ' . $match['scoreA'] . ' : ' . $match['scoreB'] . ' ' . $match['teamB_name']; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
</div>
</div>


<script src="script.js"></script>
</body>
</html>
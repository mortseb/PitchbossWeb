<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="play.css">
    <link rel="stylesheet" href="versus.css">
    <link rel="stylesheet" href="last-match.css">

    <title>Votre Site Web</title>

    <?php
        require('../controller/isConnected.php');
        include('../controller/getUserInfo.php');
        include('../controller/last_match.php');
echo   $teamName  ;  ?> 
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
    <div class="lastmatchcontainer">
<div class="lastmatch"  id="lastteamA">
    <div class="lastteamname"><?php echo $lastMatch['teamA'] == $teamId ? htmlspecialchars($teamName, ENT_QUOTES, 'UTF-8') : htmlspecialchars($opponentName, ENT_QUOTES, 'UTF-8'); ?></div>
    
    <div class="lastdomination">    <div class="stattype">Domination</div>
    <div class="statnumber"><?php echo htmlspecialchars($lastMatch['dominationA'], ENT_QUOTES, 'UTF-8'); ?>   %</div></div>
    <div class="lastoccasion">    <div class="stattype">Occasions</div>
    <div class="statnumber"><?php echo htmlspecialchars($lastMatch['occasionA'], ENT_QUOTES, 'UTF-8'); ?></div></div>
    <div class="lasttir">         <div class="stattype">Tirs</div>
    <div class="statnumber"><?php echo htmlspecialchars($lastMatch['tirA'], ENT_QUOTES, 'UTF-8'); ?></div></div>
    <div class="lastscore">    <div class="stattype">But(s)</div>
    <div class="statnumber"><?php echo htmlspecialchars($lastMatch['scoreA'], ENT_QUOTES, 'UTF-8'); ?></div></div>
</div>




<div class="lastmatch" id="lastteamB">
    <div class="lastteamname">
       
    <?php echo $lastMatch['teamB'] == $teamId ? htmlspecialchars($teamName, ENT_QUOTES, 'UTF-8') : htmlspecialchars($opponentName, ENT_QUOTES, 'UTF-8'); ?></div>
   
    <div class="lastdomination">
    <div class="stattype">Domination</div>
    <div class="statnumber"><?php echo htmlspecialchars($lastMatch['dominationB'], ENT_QUOTES, 'UTF-8'); ?>   %</div></div>
    <div class="lastoccasion">
    <div class="stattype">Occasions</div>
    <div class="statnumber"><?php echo htmlspecialchars($lastMatch['occasionB'], ENT_QUOTES, 'UTF-8'); ?></div></div>
    <div class="lasttir">
         <div class="stattype">Tirs</div>
         <div class="statnumber"><?php echo htmlspecialchars($lastMatch['tirB'], ENT_QUOTES, 'UTF-8'); ?></div></div>
         <div class="lastscore">
    <div class="stattype">But(s)</div>
    <div class="statnumber"><?php echo htmlspecialchars($lastMatch['scoreB'], ENT_QUOTES, 'UTF-8'); ?></div></div>
</div>
</div>
<div class="classcontainer">
<a class="voirclass" href="classement.php">classement</a></div>
<script src="script.js"></script>

</body>
</html>
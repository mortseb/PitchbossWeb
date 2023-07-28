<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="play.css">
    <link rel="stylesheet" href="versus.css">

    <title>Votre Site Web</title>
    
     <?php
        require('../controller/isConnected.php');
        require('../controller/dbconnect.php');


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
    <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Nom de l'équipe</th>
            <th>Points</th>
            <th>Victoires</th>
            <th>Nuls</th>
            <th>Défaites</th>
            <th>Buts marqués</th>
            <th>Buts concédés</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Récupérer les données de la base de données
        $stmt = $db->prepare("
            SELECT users.team, team_season_result.*
            FROM team_season_result
            JOIN team ON team_season_result.teamid = team.id
            JOIN users ON team.ownerid = users.id
            ORDER BY team_season_result.points DESC
        ");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Afficher les données dans le tableau
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['team'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['points'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['win'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['draw'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['lose'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['scored'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['conceded'], ENT_QUOTES, 'UTF-8') . "</td>";
            
            echo "</tr>";
        }
    ?>
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        "order": [[ 2, "desc" ]]
    });
});
</script>
<script src="script.js"></script>

</body></html>
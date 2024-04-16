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
    <link rel="stylesheet" href="last-match.css">


    <title>PitchBoss</title>

    <?php
    require('../controller/isConnected.php');
    require('../controller/dbconnect.php');


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
    <table id="playersTable" class="display">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Propriétaire</th>
                <th>Score total</th>
                <th>Note gardien</th>
                <th>Note défenseur</th>
                <th>Note milieu</th>
                <th>Note attaquant</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require('../model/functions.php');  // Assurez-vous d'inclure votre fichier de fonctions

            // Récupérer les données de la base de données
            $stmt = $db->prepare("
        SELECT players.firstName, players.lastName, users.username, players.totalscore, players.noteGardien, players.noteDefenseur, players.noteMilieu, players.noteAttaquant
        FROM players
        JOIN users ON players.ownerid = users.id
        ORDER BY players.totalscore DESC
    ");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Afficher les données dans le tableau
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td><i class='firstname'>" . htmlspecialchars($row['firstName'], ENT_QUOTES, 'UTF-8') . "</i> <b class='lastname'>" . htmlspecialchars($row['lastName'], ENT_QUOTES, 'UTF-8') . "</b></td>";
                echo "<td>" . htmlspecialchars($row['username'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td style='background-color:" . getRatingColor($row['totalscore']) . "'>" . htmlspecialchars($row['totalscore'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td style='background-color:" . getRatingColor($row['noteGardien']) . "'>" . htmlspecialchars($row['noteGardien'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td style='background-color:" . getRatingColor($row['noteDefenseur']) . "'>" . htmlspecialchars($row['noteDefenseur'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td style='background-color:" . getRatingColor($row['noteMilieu']) . "'>" . htmlspecialchars($row['noteMilieu'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "<td style='background-color:" . getRatingColor($row['noteAttaquant']) . "'>" . htmlspecialchars($row['noteAttaquant'], ENT_QUOTES, 'UTF-8') . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>

    </table>
    <script>
        $(document).ready(function() {
            $('#playersTable').DataTable({
                "order": [
                    [2, "desc"]
                ]
            });
        });
    </script>
    <script src="script.js"></script>

</body>

</html>
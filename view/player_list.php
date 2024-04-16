<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>


    <link rel="stylesheet" href="styles.css">

    <title>PitchBoss</title>

    <?php
    require('../controller/isConnected.php');
    include('../controller/getUserInfo.php');
    include('../model/functions.php');
    include('../controller/getAllPlayers.php');
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

    <div class="next-nat">
        <p class="textnextnat"> Nationalité du jour : </p>
        <img src="../assets/flags/<?php echo strtolower($next_match_nationality); ?>.png" alt="<?php echo $next_match_nationality; ?>">
        <p class="textnextnat"> Code pays : <?php echo ($next_match_nationality); ?></p>
    </div>

    <div class="tablecontainer">
        <select id="sortColumn">
            <option value="0">Tête</option>
            <option value="1">Total Score</option>
            <option value="2">Note Gardien</option>
            <option value="3">Note Défenseur</option>
            <option value="4">Note Milieu</option>
            <option value="5">Note Attaquant</option>
            <option value="6">Nom</option>
            <option value="7">Prénom</option>
            <option value="8">Nationalité</option>

        </select>

        <table class="player-table">
            <thead>
                <tr>
                    <th>Tête</th>
                    <th>Total Score</th>
                    <th>Note Gardien</th>
                    <th>Note Défenseur</th>
                    <th>Note Milieu</th>
                    <th>Note Attaquant</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Nationalité</th>
                    <th>Vendre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($players as $player) : ?>
                    <tr>
                        <td class="player-face-cell">
                            <!-- Player face images -->
                            <img class="face-elements" src="<?php echo $player['faceLink']; ?>" alt="Face">
                            <img class="face-elements" src="<?php echo $player['noseLink']; ?>" alt="Nose">
                            <img class="face-elements" src="<?php echo $player['eyebrowsLink']; ?>" alt="Eyebrows">
                            <img class="face-elements" src="<?php echo $player['mouthLink']; ?>" alt="Mouth">
                            <img class="face-elements" src="<?php echo $player['eyesLink']; ?>" alt="Eyes">
                        </td>
                        <td class="global-cell">
                            <div class="rating-circles" style="background-color: <?php echo getRatingColor($player['totalscore']); ?>">
                                <?php echo $player['totalscore']; ?>
                            </div>
                        </td>
                        <td class="note-cell">
                            <div class="rating-circles" style="background-color: <?php echo getRatingColor($player['noteGardien']); ?>">
                                <?php echo $player['noteGardien']; ?>
                            </div>
                        </td>
                        <td class="note-cell">
                            <div class="rating-circles" style="background-color: <?php echo getRatingColor($player['noteDefenseur']); ?>">
                                <?php echo $player['noteDefenseur']; ?>
                            </div>
                        </td>
                        <td class="note-cell">
                            <div class="rating-circles" style="background-color: <?php echo getRatingColor($player['noteMilieu']); ?>">
                                <?php echo $player['noteMilieu']; ?>
                            </div>
                        </td>
                        <td class="note-cell">
                            <div class="rating-circles" style="background-color: <?php echo getRatingColor($player['noteAttaquant']); ?>">
                                <?php echo $player['noteAttaquant']; ?>
                            </div>
                        </td>
                        <td class="info-cell"><?php echo $player['lastName']; ?></td>
                        <td class="info-cell"><?php echo $player['firstName']; ?></td>
                        <td class="nationality-cell" data-sort="<?php echo $player['nationality']; ?>">
                            <img class="player-flags" src="../assets/flags/<?php echo strtolower($player['nationality']); ?>.png" alt="<?php echo $player['nationality']; ?>">
                        </td>
                        <td class="action-cell">
                            <!-- Formulaire pour vendre un joueur -->
                            <form action="../controller/sell_player.php" method="post">
                                <!-- Input caché pour stocker l'id du joueur -->
                                <input type="hidden" name="player_id" value="<?php echo $player['id']; ?>">
                                <!-- Bouton pour soumettre le formulaire -->
                                <button type="submit" style="border: none; background: none;">
                                    <img src="images/sell.png" alt="Sell player" class="sellimg">
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="script.js"></script>

    <script src="table.js"></script>
</body>

</html>
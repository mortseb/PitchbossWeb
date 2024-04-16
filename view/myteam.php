<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="user-id" content="' . $_SESSION['user_id'] . '">
    <title>PitchBoss</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="play.css">

    <?php
    require('../controller/isConnected.php');
    include('../controller/getUserInfo.php');
    ?>
</head>

<body id="myteambody">

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
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p></p>
        </div>


    </div>
    <div class="pitchcontainer">
        <div class="pitchimg">
            <img id="pitchimage" src="images/pitch.png" alt="Terrain">


            <div class="playerscontainer">
                <div class="gkcontainer">
                    <a href="#" class="addplayer gardien" id="gk1">+</a>
                </div>

                <div class="defcontainer">
                    <a href="#" class="addplayer defenseur" id="def1">+</a>
                    <a href="#" class="addplayer defenseur" id="def2">+</a>
                    <a href="#" class="addplayer defenseur" id="def3">+</a>
                    <a href="#" class="addplayer defenseur" id="def4">+</a>

                </div>

                <div class="midcontainer">
                    <a href="#" class="addplayer milieu" id="mid1">+</a>
                    <a href="#" class="addplayer milieu" id="mid2">+</a>
                    <a href="#" class="addplayer milieu" id="mid3">+</a>
                </div>


                <div class="atkcontainer">
                    <a href="#" class="addplayer attaquant" id="atk1">+</a>
                    <a href="#" class="addplayer attaquant" id="atk2">+</a>
                    <a href="#" class="addplayer attaquant" id="atk3">+</a>

                </div>
            </div>

        </div>
    </div>
    <div class="notescontainer">
        <div class="avg">
            <img src="images/gk.png" alt="GK Icon">
            <div id="avgGK" class="circle"></div>
        </div>
        <div class="avg">
            <img src="images/def.png" alt="DEF Icon">
            <div id="avgDEF" class="circle"></div>
        </div>
        <div class="avg">
            <img src="images/mid.png" alt="MID Icon">
            <div id="avgMID" class="circle"></div>
        </div>
        <div class="avg">
            <img src="images/atk.png" alt="ATK Icon">
            <div id="avgATK" class="circle"></div>
        </div>
        <div class="avg">
            <img src="images/total.png" alt="Total Icon">
            <div id="avgTotalScore" class="circle"></div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="play.js"></script>

</body>

</html>
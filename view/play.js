function getRatingColor(rating) {
    if (rating >= 1 && rating < 20) {
        return '#FF3131';
    } else if (rating >= 20 && rating < 40) {
        return '#FF5757';
    } else if (rating >= 40 && rating < 60) {
        return '#FFBD59';
    } else if (rating >= 60 && rating < 70) {
        return '#C1FF72';
    } else if (rating >= 70 && rating < 80) {
        return '#7ED957';
    } else if (rating >= 80 && rating < 90) {
        return '#00BF63';
    } else if (rating >= 90 && rating <= 100) {
        return '#5CE1E6';
    } else {
        return '#ccc';
    }
}
var countGK = 0, sumGK = 0;
var countDEF = 0, sumDEF = 0;
var countMID = 0, sumMID = 0;
var countATK = 0, sumATK = 0;
var countPlayers = 0, sumTotalScore = 0;
var userId = $('meta[name="user-id"]').attr('content');

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementsByClassName("addplayer");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
for (var i = 0; i < btn.length; i++) {
    btn[i].onclick = function() {
        modal.style.display = "block";
    }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Récupérer les éléments addplayer
var addPlayers = document.getElementsByClassName('addplayer');
function updateAveragesAndTotals() {
    // Récupérer à nouveau les données de l'équipe
    $.ajax({
        url: '../controller/fetch_team.php',
        type: 'POST',
        dataType: 'json',
        data: {
            ownerid: userId,
        },
        success: function(data) {
            // Réinitialiser les compteurs et les sommes
            countGK = 0;
            sumGK = 0;
            countDEF = 0;
            sumDEF = 0;
            countMID = 0;
            sumMID = 0;
            countATK = 0;
            sumATK = 0;
            countPlayers = 0;
            sumTotalScore = 0;

            // Parcourir les données de l'équipe et mettre à jour les compteurs et les sommes
            for(var i = 0; i < data.length; i++) {
                var playerInfo = data[i].player;
                var position = data[i].position;
                var totalScore = parseFloat(playerInfo.totalscore);
            
                switch (position) {
                    case 'gk1':
                        countGK++;
                        sumGK += parseFloat(playerInfo.noteGardien);
                        break;
                    case 'def1':
                    case 'def2':
                    case 'def3':
                    case 'def4':
                        countDEF++;
                        sumDEF += parseFloat(playerInfo.noteDefenseur);
                        break;
                    case 'mid1':
                    case 'mid2':
                    case 'mid3':
                        countMID++;
                        sumMID += parseFloat(playerInfo.noteMilieu);
                        break;
                    case 'atk1':
                    case 'atk2':
                    case 'atk3':
                        countATK++;
                        sumATK += parseFloat(playerInfo.noteAttaquant);
                        break;
                }
            
                countPlayers++;
                sumTotalScore += totalScore;
            }

            // Calculer les nouvelles moyennes
            var avgGK = sumGK / countGK;
            var avgDEF = sumDEF / countDEF;
            var avgMID = sumMID / countMID;
            var avgATK = sumATK / countATK;
            var avgTotalScore = sumTotalScore / countPlayers;

            // Mettre à jour les div avec les nouvelles moyennes
            $('#avgGK').text(avgGK.toFixed(2)).css('background-color', getRatingColor(avgGK));
            $('#avgDEF').text(avgDEF.toFixed(2)).css('background-color', getRatingColor(avgDEF));
            $('#avgMID').text(avgMID.toFixed(2)).css('background-color', getRatingColor(avgMID));
            $('#avgATK').text(avgATK.toFixed(2)).css('background-color', getRatingColor(avgATK));
            $('#avgTotalScore').text(avgTotalScore.toFixed(2)).css('background-color', getRatingColor(avgTotalScore));
            $.ajax({
                url: '../controller/update_averages.php',
                type: 'POST',
                data: {
                    avgGK: avgGK,
                    avgDEF: avgDEF,
                    avgMID: avgMID,
                    avgATK: avgATK,
                    avgTotalScore: avgTotalScore,
                },
                success: function(response) {
                    console.log(response); // Log the server's response
                },
                error: function(err) {
                    console.error(err); // Log any error that occurred
                },
            });
        }
    });
}


// Parcourir tous les éléments addplayer
for(var i = 0; i < addPlayers.length; i++) {

    // Ajouter un écouteur d'événements à chaque élément addplayer
    addPlayers[i].addEventListener('click', function(event) {
        event.preventDefault();

        // Récupérer le type de joueur (gardien, defenseur, milieu, attaquant)
        var playerType = this.classList[1];
        var addButton = this;  // Enregistrer une référence à l'élément bouton

        // Appeler une fonction AJAX pour récupérer les données du serveur
        $.ajax({
            url: '../controller/fetch_players.php',  // URL du script PHP qui va interroger la base de données
            type: 'POST',
            data: {
                type: playerType,    // Envoyer le type de joueur au script PHP
            },
            success: function(data) {
                // Insérer les données dans la fenêtre modale
                $('.modal-content').html(data);

                // Ajouter un écouteur d'événements à chaque joueur
                $('.player').click(function() {
                    // Récupérer les informations du joueur
                    var playerInfo = {
                        id: $(this).data('id'),  // Ajouter data-id dans le HTML généré par PHP
                        faceLink: $(this).find('.player-image img:nth-child(1)').attr('src'),
                        eyebrowsLink: $(this).find('.player-image img:nth-child(2)').attr('src'),
                        eyesLink: $(this).find('.player-image img:nth-child(3)').attr('src'),
                        mouthLink: $(this).find('.player-image img:nth-child(4)').attr('src'),
                        noseLink: $(this).find('.player-image img:nth-child(5)').attr('src'),
                        score: $(this).find('.player-score p').text(),
                        scoreColor: $(this).find('.player-score').css('background-color'),
                        totalScore: $(this).find('.player-total-score p').text(),
                        totalScoreColor: $(this).find('.player-total-score').css('background-color'),
                    };

                    // Fermer la fenêtre modale
                    $('#myModal').modal('hide');

                    // Insérer le joueur dans le bouton
                    $(addButton).html(`
                        <div class="player-added">
                            <div class="player-image-added">
                                <img src="${playerInfo.faceLink}" alt="Face">
                                <img src="${playerInfo.eyebrowsLink}" alt="Eyebrows">
                                <img src="${playerInfo.eyesLink}" alt="Eyes">
                                <img src="${playerInfo.mouthLink}" alt="Mouth">
                                <img src="${playerInfo.noseLink}" alt="Nose">
                            </div>
                            <div class="player-score-added" style="background-color:${playerInfo.scoreColor};">
                                <p>${playerInfo.score}</p>
                            </div>
                            <div class="player-total-score-added" style="background-color:${playerInfo.totalScoreColor};">
                                <p>${playerInfo.totalScore}</p>
                            </div>
                        </div>
                    `);

                    // Faire une requête AJAX pour mettre à jour la table de l'équipe
                    $.ajax({
                        url: '../controller/update_team.php',  // URL du script PHP qui va mettre à jour la table de l'équipe
                        type: 'POST',
                        data: {
                            ownerid: userId,
                            playerid: playerInfo.id,
                            position: addButton.id,  // Utiliser l'id du bouton comme le poste
                        },
                        success: function() {
                            // Mettre à jour les moyennes et les totaux
                            updateAveragesAndTotals();
                        }
                    }); // Fermeture du bloc AJAX
                }); // Fermeture du bloc .click

                // Ouvrir la fenêtre modale
                $('#myModal').modal('show');
            } // Fermeture du bloc success de la première requête AJAX
        }); // Fermeture du bloc AJAX
    }); // Fermeture du bloc .addEventListener
} // Fermeture du bloc for

$(document).ready(function() {
    // Effectuer une requête AJAX pour récupérer les données de l'équipe
    updateAveragesAndTotals();
});
// Lorsque le document est prêt
$(document).ready(function() {
    // Effectuer une requête AJAX pour récupérer les données de l'équipe
    $.ajax({
        url: '../controller/fetch_team.php',  // URL du script PHP qui va interroger la base de données
        type: 'POST',
        dataType: 'json',
        data: {
            ownerid: userId,
        },
        success: function(data) {
            // Parcourir les données de l'équipe
            for(var i = 0; i < data.length; i++) {
                // Récupérer les informations du joueur et la position
                var playerInfo = data[i].player;
                var position = data[i].position;
            
                // Convertir le score total en nombre
                var totalScore = parseFloat(playerInfo.totalscore);
            
                // Incrémenter les compteurs et ajouter le score aux sommes
                switch (position) {
                    case 'gk1':
                        countGK++;
                        sumGK += parseFloat(playerInfo.noteGardien);
                        break;
                    case 'def1':
                    case 'def2':
                    case 'def3':
                    case 'def4':
                        countDEF++;
                        sumDEF += parseFloat(playerInfo.noteDefenseur);
                        break;
                    case 'mid1':
                    case 'mid2':
                    case 'mid3':
                        countMID++;
                        sumMID += parseFloat(playerInfo.noteMilieu);
                        break;
                    case 'atk1':
                    case 'atk2':
                    case 'atk3':
                        countATK++;
                        sumATK += parseFloat(playerInfo.noteAttaquant);
                        break;
                }
            
                // Incrémenter le compteur des joueurs et ajouter le score total à la somme
                countPlayers++;
                sumTotalScore += totalScore;

                // Déterminer le score à afficher en fonction de la position
                var score;
                switch (position) {
                    case 'gk1':
                        score = playerInfo.noteGardien;
                        break;
                    case 'def1':
                    case 'def2':
                    case 'def3':
                    case 'def4':    
                        score = playerInfo.noteDefenseur;
                        break;
                    case 'mid1':
                    case 'mid2':
                    case 'mid3':
                        score = playerInfo.noteMilieu;
                        break;
                    case 'atk1':
                    case 'atk2':
                    case 'atk3':
                        score = playerInfo.noteAttaquant;
                        break;
                    default:
                        score = 'N/A';
                }

                // Trouver le bouton correspondant à la position
                var addButton = $('#' + position);

                // Mettre à jour le bouton avec les informations du joueur
                $(addButton).html(`
                    <div class="player-added">
                        <div class="player-image-added">
                            <img src="${playerInfo.faceLink}" alt="Face">
                            <img src="${playerInfo.eyebrowsLink}" alt="Eyebrows">
                            <img src="${playerInfo.eyesLink}" alt="Eyes">
                            <img src="${playerInfo.mouthLink}" alt="Mouth">
                            <img src="${playerInfo.noseLink}" alt="Nose">
                        </div>
                        <div class="player-score-added" style="background-color:${getRatingColor(score)};">
                            <p>${score}</p>
                        </div>
                        <div class="player-total-score-added" style="background-color:${getRatingColor(playerInfo.totalscore)};">
                            <p>${playerInfo.totalscore}</p>
                        </div>
                    </div>
                `);
            }

            // Calculer les moyennes
            var avgGK = sumGK / countGK;
            var avgDEF = sumDEF / countDEF;
            var avgMID = sumMID / countMID;
            var avgATK = sumATK / countATK;
            var avgTotalScore = sumTotalScore / countPlayers;

            // Mettre à jour les div avec les moyennes
$('#avgGK').text(avgGK.toFixed(2)).css('background-color', getRatingColor(avgGK));
$('#avgDEF').text(avgDEF.toFixed(2)).css('background-color', getRatingColor(avgDEF));
$('#avgMID').text(avgMID.toFixed(2)).css('background-color', getRatingColor(avgMID));
$('#avgATK').text(avgATK.toFixed(2)).css('background-color', getRatingColor(avgATK));
$('#avgTotalScore').text(avgTotalScore.toFixed(2)).css('background-color', getRatingColor(avgTotalScore));

        }
    }); // Fermeture du bloc AJAX
}); // Fermeture du bloc $(document).ready


<?php
session_start();

// Récupérer les données POST
$ownerid = $_SESSION['user_id'];
$playerid = $_POST['playerid'];
$position = $_POST['position'];
require __DIR__ . '/vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Connexion à la base de données
$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];

$db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);


// Préparer la requête SQL pour mettre à jour l'équipe
$stmt = $db->prepare("
    UPDATE team 
    SET $position = :playerid 
    WHERE ownerid = :ownerid
");

// Exécuter la requête SQL
$stmt->execute([
    ':ownerid' => $ownerid,
    ':playerid' => $playerid,
]);
?>

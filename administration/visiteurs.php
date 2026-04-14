<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "rud_business";
$connection = mysqli_connect($host, $user, $password, $dbname);

// Vérification de la connexion
if (!$connection) {
    die("Connexion échouée: " . mysqli_connect_error());
}

// Récupération de l'adresse IP du visiteur
$ip = $_SERVER['REMOTE_ADDR'];

// Vérification si l'adresse IP existe déjà dans la table
$query = "SELECT * FROM visiteur_r_b WHERE ip = '$ip'";
$result = mysqli_query($connection, $query);

// Récupération du nombre de visiteurs
$query = "SELECT COUNT(*) FROM visiteur_r_b";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
$nb_visiteurs = $row[0];

// Affichage du nombre de visiteurs


// Fermeture de la connexion
mysqli_close($connection);
?>
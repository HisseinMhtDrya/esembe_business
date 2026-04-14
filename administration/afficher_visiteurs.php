<?php

// Récupère l'adresse IP du visiteur
$ip_address = $_SERVER['REMOTE_ADDR'];

// Connecte à la base de données MySQL
$conn = mysqli_connect("localhost", "root", "", "espace_membre");

// Insère le nouveau visiteur dans la table des visiteurs
$sql = "INSERT INTO visitors (ip_address) VALUES ('$ip_address')";
mysqli_query($conn, $sql);


// Compte le nombre de visiteurs actuellement présents sur le site
$sql = "SELECT COUNT(*) as count FROM visitors WHERE last_activity > DATE_SUB(NOW(), INTERVAL 5 MINUTE)";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

// Affiche le nombre de visiteurs
echo "Il y a $count visiteurs sur le site.";


?>
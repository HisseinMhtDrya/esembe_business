<?php

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "espace_membre";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données de l'utilisateur
$userID = $_POST['userID'];
$status = $_POST['status'];

// Mettre à jour le statut de l'utilisateur dans la table 'message'
$sql = "UPDATE surho SET status = '$status' WHERE id = '$userID'";

if ($conn->query($sql) === TRUE) {
  echo "Statut de l'utilisateur mis à jour avec succès.";
} else {
  echo "Erreur lors de la mise à jour du statut de l'utilisateur : " . $conn->error;
}

$conn->close();

?>
<?php
// Connexion à la base de données MySQL
$serveur = "127.0.0.1";
$utilisateur = "root";
$motdepasse = "";
$base_de_donnees = "espace_membre";
$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Récupération des données du formulaire
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$mail = htmlspecialchars($_POST['mail']);
$mdp = sha1($_POST['mdp']);
// Requête de suppression du compte utilisateur
$requete = "DELETE FROM surho WHERE nom='$nom' AND prenom='$prenom' AND motdepasse='$mdp' AND mail='$mail'";
$resultat = mysqli_query($connexion, $requete);

// Vérification de la suppression
if ($resultat) {
	echo "Le compte utilisateur a été supprimé avec succès.";
	header("Location: ../DIRECTION GENERALE/accueil.php");
	exit;
} else {
	echo "Erreur : la suppression du compte utilisateur a échoué.";
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>

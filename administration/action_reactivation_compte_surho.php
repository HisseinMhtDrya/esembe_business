<?php
session_start();
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
$requete = "SELECT * FROM surho WHERE nom='$nom' AND prenom='$prenom'";
$resultat = mysqli_query($connexion, $requete);

if(mysqli_num_rows($resultat) > 0) {
    $row = mysqli_fetch_assoc($resultat);
	$genre = $row['sexe'];
    
    // Vérification du genre de l'utilisateur
    if($genre == 'femme') {
        $statut = 'active';
    } else {
        $statut = 'actif';
    }

$requete = "UPDATE  surho SET statut = '$statut' WHERE nom='$nom' AND prenom='$prenom' AND motdepasse='$mdp' AND mail='$mail'";
$resultat = mysqli_query($connexion, $requete);

// Vérification de la suppression
if ($resultat) {
	
	 // Rediriger vers une page d'accueil personnalisée
	 echo "L'utilisateur a été réactivé !";
	 header('Location: admin.php');  
	exit;
} else {
	echo "Erreur : la réactivation du compte utilisateur a échoué.";
}
}else{
	echo "Cet utilisateur n'existe pas !";
}
// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>

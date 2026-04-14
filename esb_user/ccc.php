<?php
 session_start();
 require_once('activite.php');
 require_once('../connexiondb.php');
if(!isset($_SESSION['id'])){
    header('location:connexion_rud_bus.php');
}

$recup_produit_plus_vendu_jour = $bdd->prepare("SELECT nom_produit, SUM(quantite) as total_quantite
FROM commande
WHERE id_vendeur = :id_vendeur AND DATE(date_commande) = :currentDate
GROUP BY nom_produit
ORDER BY SUM(quantite) DESC
LIMIT 1");

$recup_produit_plus_vendu_jour->execute(array(':id_vendeur' => $_SESSION['id'], ':currentDate' => $currentDate));

$produit_plus_vendu_jour = $recup_produit_plus_vendu_jour->fetch();




$recup_produit_plus_revenu_jour = $bdd->prepare("SELECT nom_produit, (SUM(prix_vente*quantite) - SUM(prix_achat*quantite)) as total_revenu
FROM commande
WHERE id_vendeur = :id_vendeur AND DATE(date_commande) = :currentDate
GROUP BY nom_produit
ORDER BY (SUM(prix_vente*quantite) - SUM(prix_achat*quantite)) DESC
LIMIT 1");

$recup_produit_plus_revenu_jour->execute(array(':id_vendeur' => $_SESSION['id'], ':currentDate' => $currentDate));

$produit_plus_revenu_jour = $recup_produit_plus_revenu_jour->fetch();

$produit_plus_vendu_jour['nom_produit'];
$produit_plus_vendu_jour['total_quantite'];
$produit_plus_revenu_jour['nom_produit'];
$produit_plus_revenu_jour['total_revenu'];
?>
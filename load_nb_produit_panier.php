<?php
session_start();
require_once('connexiondb.php');

if(isset($_SESSION['client_id'])){
    $recup_nb_produit_panier = $bdd->prepare("SELECT count(*) AS nb_produit FROM panier WHERE id_client = :id_client");
    $recup_nb_produit_panier->execute(array(':id_client' => $_SESSION['client_id']));
    $nb_produit = $recup_nb_produit_panier->fetch();
}
?>
<?=$nb_produit['nb_produit'] ?>
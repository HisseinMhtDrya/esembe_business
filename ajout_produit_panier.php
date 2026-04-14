<?php
session_start();

require_once('connexiondb.php');



function GetInfoProduit($id_produit){
    global $bdd;
    $produit_exist = "";
    $recup_info_produit = $bdd->prepare("SELECT * FROM produit WHERE id_produit = ?");
    $recup_info_produit->execute(array($id_produit));
    if($recup_info_produit->rowCount() == 0){
        $produit_exist = false;
    }else{
        $produit_exist = true;
    }
    if($produit_exist){
        $info_produit = $recup_info_produit->fetch();
        return $info_produit;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produit = json_decode(file_get_contents('php://input'), true)['id_produit'];
    
    $info_produit = GetInfoProduit($id_produit);

    $prix_produit = $info_produit['prix_vente'];
    $quantite = 1;
    $client_id = $_SESSION['client_id'];
    $nom_produit = $info_produit['nom_produit'];
    $add_to_panier = $bdd->prepare("INSERT INTO panier(id_client, id_produit, quantite, prix_total, date_ajout) VALUES(?, ?, ?, ?, NOW())");
    $add_to_panier->execute(array($client_id, $id_produit, $quantite, $prix_produit));
}
?>
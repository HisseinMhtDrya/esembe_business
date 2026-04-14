<?php
session_start();
require_once('../../connexiondb.php');

class Ineventaire{
    private $id;
    private $id_vendeur;
    private $id_produit;
    private $nom_produit;
    private $categorie_produit;
    private $description;
    private $quantite_stock;
    private $quantite_disponible;
    private $prix_unitaire;
    private $fournisseur;
    private $date_entree;
    private $date_sortie;

    public function __construct($id, $id_vendeur, $id_produit, $nom_produit, $categorie_produit, $description, $quantite_stock, $quantite_disponible, $prix_unitaire, $fournisseur, $date_entree, $date_sortie){
        $this->id                  = $id;
        $this->id_vendeur          = $id_vendeur;
        $this->id_produit          = $id_produit;
        $this->nom_produit         = $nom_produit;
        $this->categorie_produit   = $categorie_produit;
        $this->description         = $description;
        $this->quantite_stock      = $quantite_stock;
        $this->quantite_disponible = $quantite_disponible;
        $this->prix_unitaire       = $prix_unitaire;
        $this->fournisseur         = $fournisseur;
        $this->date_entree         = $date_entree;
        $this->date_sortie         = $date_sortie;
    }
    public function getId(){
        return $this->id;
    }
    public function getIdVenduer(){
        return $this->id_vendeur;
    }
    public function getIdProduit(){
        return $this->id_produit;
    }
}
?>
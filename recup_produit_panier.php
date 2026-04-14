<?php
session_start();
require_once('connexiondb.php');

if(isset($_SESSION['client_id'])){
    $recup_produit_panier = $bdd->prepare("SELECT id_panier, id_client, id_produit, sum(quantite) as quantite_produit, sum(prix_total) as prix_total_produit, date_ajout  FROM panier WHERE id_client = :id_client GROUP BY id_produit");
    $recup_produit_panier->execute(array(':id_client' => $_SESSION['client_id']));
    $produits = $recup_produit_panier->fetchAll();
}

?>
<div class="row">
<?php
 foreach($produits as $produit){
    $recup_info_produit = $bdd->prepare("SELECT * FROM produit WHERE id_produit = ?");
    $recup_info_produit->execute(array($produit['id_produit']));
    $info_produit = $recup_info_produit->fetch();
    ?>

                 <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div class="d-flex flex-row align-items-center">
                          <div>
                          <a href="fichier/<?=$info_produit['fichier'] ?>" class="glightbox">
                            <img src="fichier/<?=$info_produit['fichier'] ?>" class="img-fluid rounded-3" alt="<?=$info_produit['nom_produit'] ?>" style="width: 65px;">
                          </a>
                          </div>
                          <div class="ms-3">
                            <h5><?=$info_produit['nom_produit'] ?></h5>
                            <p class="small mb-0"><?=$info_produit['description'] ?></p>
                          </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                          <div style="width: 50px;">
                            <h5 class="fw-normal mb-0"><?=$produit['quantite_produit'] ?></h5>
                          </div>
                          <div style="width: 80px;">
                            <h5 class="mb-0">$<?=$produit['prix_total_produit'] ?></h5>
                          </div>
                          <a href="afficher_panier_client?id_produit=<?=$produit['id_produit'] ?>&motif=supprimer" id="delete_prod"  style="color: #0d66ff;"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
 <?php
 }
?>
</div>
<?php
require_once('connexiondb.php');
?>
<?php
require_once('header.php');
?>


<main class="main" style="margin-top:190px;">
<?php
 if(isset($_GET['query']) && !empty($_GET['query'])){
  $query = NettoyerDonnee($_GET['query']);
  $recup_categorie = $bdd->prepare("SELECT * FROM categorie WHERE titre LIKE :search OR description LIKE :search ORDER BY id_categorie DESC");
  $recup_categorie->execute(array(':search' => '%'.$query.'%'));
 }else{
  $recup_categorie = $bdd->prepare("SELECT * FROM categorie ORDER BY id_categorie DESC");
  $recup_categorie->execute();
 }
 $categories = $recup_categorie->fetchAll();
?>
<?php
  if(count($categories) > 0){
    shuffle($categories);
      foreach($categories as $cat){
      $categorie = $cat['titre'];
?>
  <h2 class="container text-white">
   <?=$categorie ?>
  </h2>
  <?php
    $recup_produit = $bdd->prepare("SELECT * FROM produit WHERE categorie = :categorie ORDER BY RAND() DESC LIMIT 20");
    $recup_produit->execute(array(':categorie' => $categorie));
    $produits = $recup_produit->fetchAll();
  ?>
<?php
 if(count($produits) > 0){
?>
  <section>
    <div class="container">
        <h2 class="text-center text-primary" style="font-weight:900; font-size:20px;">Produits</h2>
      <div class="row">
          <?php
            shuffle($produits);
            foreach($produits as $produit){
          ?>
            <div class="col-lg-2 col-md-6 col-6 shadow py-1">
              <a href="fichier/<?=$produit['fichier'] ?>" class="glightbox">
                <img src="fichier/<?=$produit['fichier'] ?>" class="img-produit" style="object-fit:cover;" alt="">
              </a>
              <div class="info-produit">
                <h6 class="text-center"><?=$produit['nom_produit'] ?> <?=$produit['prix_vente'] ?>FC</h6>
                <p class="text-center"><?=$produit['type_produit'] ?></p>
                <button class="btn btn-primary w-100 add_to_cart" data-id="<?=$produit['id_produit'] ?>">Ajouter au panier <i class="bi bi-cart"></i></button>
              </div>
            </div>
          <?php
          }
          ?>
      </div>
    </div>
  </section>
<?php
  }
?>
<?php
    }
  }
?>
</main>

<?php
require_once('footer.php');
?>
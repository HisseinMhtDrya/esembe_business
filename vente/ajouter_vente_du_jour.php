<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../");
    exit();
}
require_once('../connexiondb.php');
$requser = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = :id");
$requser->execute(array(':id' => $_SESSION['id']));
$userinfo = $requser->fetch();
$vendeur = $userinfo['prenom'] .' '. $userinfo['nom'];

$recup_produit = $bdd->prepare("SELECT * FROM produit");
$recup_produit->execute();
$produits = $recup_produit->fetchAll();

if(isset($_POST['valider'])){
    if(!empty($_POST['produit']) && !empty($_POST['quantite'])){
        $id_produit = htmlspecialchars($_POST['produit']);
        $quantite = htmlspecialchars($_POST['quantite']);
        
        $req_prod = $bdd->prepare("SELECT * FROM produit WHERE id_produit = ?");
        $req_prod->execute(array($id_produit));
        if($req_prod->rowcount() > 0){
          $info_prod = $req_prod->fetch();
          $nom_produit = $info_prod['nom_produit'];
          $prix_achat = $info_prod['prix_achat'];
          $prix_vente = $info_prod['prix_vente'];

          $montant = $prix_vente;
          $montant_total = $montant*$quantite;

          $insert_vente = $bdd->prepare("INSERT INTO vente(nom_produit, prix_achat, prix_vente, quantite, montant_total, date_vente, vendeur) VALUES(?, ?, ?, ?, ?, NOW(), ?)");
          $insert_vente->execute(array($nom_produit, $prix_achat, $prix_vente, $quantite, $montant_total, $vendeur));

       
          
          $quantite_prod = $info_prod['quantite'];
          $id_produit = $info_prod['id_produit'];
          $nouvelle_quantite_prod = $quantite_prod - $quantite;
          $update_prod = $bdd->prepare("UPDATE produit SET quantite = :quantite WHERE id_produit = :id_produit");
          $update_prod->execute(array(':quantite' => $nouvelle_quantite_prod, ':id_produit' => $id_produit));
        
          $erreur = "Vente enregistrée avec succès.";
        }else{
          $erreur = "Ce produit n'existe pas. Veuillez d'abord l'ajouter à la boutique !";
        }
    }else{
        $erreur = "Veuillz compléter tous les champs !";
    }
}
$today = date('Y-m-d');
$vente = $bdd->prepare('SELECT * FROM vente WHERE DATE(date_vente) = :today ORDER BY id DESC');
$vente->execute(array(':today' => $today));

$recup_produits = $bdd->prepare("SELECT * FROM produit ORDER BY nom_produit");
$recup_produits->execute();
$produits = $recup_produits->fetchAll();
?>
<?php
 require_once('header.php');
?>

  
  <main class="container" style="margin-top:100px;">
 
   <div class="row">
    <div class="col-lg-6 col-12 order-1 card py-3">
             <div class="pt-4 pb-2">
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Enregistrer vente du jour</h5>
              </div>
             <form class="row g-3 needs-validation" novalidate method="post">
               
               <?php
               if(isset($erreur)) {
                echo '<font color="red">'.$erreur."</font>";
                }
               ?>
             <div class="col-lg-6 col-12">
                <label for="produit" class="form-label">Nom du produit</label>
        
                <select class="form-control" name="produit" id="produit">
                  <?php 
                  if(count($produits) > 0){
                   foreach($produits as $produit){
                    ?>
                    <option value="<?=$produit['id_produit'] ?>"><?=$produit['nom_produit'] ?>(<?=$produit['type_produit'] ?>)</option>
                    <?php
                   }
                  }else{
                    echo "Vous devez d'abord ajouter des produits";
                  }
                  ?>
                </select>
                <div class="invalid-feedback">Veuillez saisir le nom du produit</div>
               
              </div>

              <div class="col-lg-6 col-12">
                <label for="quantite" class="form-label">Quantité vendue</label>
            
                  <input type="number" class="form-last-name form-control" placeholder="" id="quantite" name="quantite" value="<?php if(isset($quantite)) { echo $quantite; } ?>" required />
                  <div class="invalid-feedback">Veuillez saisir la quantité.</div>
            
              </div>

           
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <input type="reset" value="Annuler" class="btn btn-danger">
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <button class="btn btn-primary w-100" name="valider" type="submit">Enregistrer</button>
              </div>
             
             
            </form>
    </div>
    <div class="col-lg-6 col-12 order-2">
                        <div class="bg-white rounded  p-4 table-responsive">
                            <h6 class="mb-4">Vente du jour</h6>
                            <?php if($vente->rowCount() > 0) { ?>
                            <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nom produit</th>
                                        <th scope="col">Quantité</th>
                                        <th scope="col">Montant total</th>
                                        <th scope="col">Vendeur</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  $is_first = true; // Détecte si c'est la première ligne
                                  while ($v = $vente->fetch()) { 
                                  ?>
                                  <tr class="<?= $is_first ? 'table-warning' : '' ?>">
                                      <td><?= $v['id'] ?></td>
                                      <td><?= $v['nom_produit'] ?></td>
                                      <td><?= $v['quantite'] ?></td>
                                      <td><?= $v['montant_total'] ?></td>
                                      <td><?= $v['vendeur'] ?></td>
                                  </tr>
                                  <?php
                                      $is_first = false; // Après la première ligne, désactiver la classe
                                  } 
                                  ?>
                                </tbody>


                            </table>
                            <?php 
                            } else { 
                            ?>
                                <p>Aucune vente trouvée</p>
                            <?php
                              } 
                            ?>
                        </div>
    </div>
   </div>
         
  </main>

  <?php
 require_once('footer.php');
?>
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

if(isset($_GET['id_vente'], $_GET['action']) && $_GET['id_vente'] > 0 && $_GET['action'] == "supprimer"){
    $id_vente = htmlspecialchars(intval($_GET['id_vente']));
    $delete_vente = $bdd->prepare("DELETE FROM vente WHERE id = ?");
    $delete_vente->execute(array($id_vente));
}

if(isset($_GET['query']) && !empty($_GET['query'])){
    $query = htmlspecialchars($_GET['query']);
    $vente = $bdd->prepare('SELECT * FROM vente WHERE nom_produit LIKE :query OR quantite LIKE :query OR vendeur LIKE :query OR date_vente LIKE :query OR montant_total LIKE :query ORDER BY id DESC');
    $vente->execute(array(':query' => '%'.$query.'%'));
}else{
    $vente = $bdd->prepare('SELECT * FROM vente ORDER BY id DESC');
    $vente->execute();
}


$recup_vente_totale_mois = $bdd->prepare("SELECT SUM(montant_total) AS vente_totale FROM vente ");
$recup_vente_totale_mois->execute();
$vente_totale = $recup_vente_totale_mois->fetch();

?>
<?php
 require_once('header.php');
?>

  
  <main>
    <div class="container mt-5">


      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <form class=" d-md-flex ms-4 mb-4" action="" method="GET">
            <input class="form-control border-0" name="query" type="text" placeholder="Recherche...">
          </form>
          <div class="row justify-content-center">
            
           <div class="col-lg-12 col-md-12 align-items-center justify-content-center">
           
                        <div class="bg-white rounded h-100 p-4 table-responsive">
                            <h6 class="mb-4">Toutes les ventes <span class="text-primary"><?=$vente_totale['vente_totale']  ?> Fc</span></h6>
                            <?php if($vente->rowCount() > 0) { ?>
                            <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nom produit</th>
                                        <th scope="col">Quantité</th>
                                        <th scope="col">Montant total</th>
                                        <th scope="col">Vendeur</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($v = $vente->fetch()) { 
                                ?>
                                <tr>
                                    <td><?= $v['id'] ?></td>
                                    <td><?= $v['nom_produit'] ?></td>
                                    <td><?= $v['quantite'] ?></td>
                                    <td><?= $v['montant_total'] ?></td>
                                    <td><?= $v['vendeur'] ?></td>
                                    <td><?= $v['date_vente'] ?></td>
                                    <td>
                                        <a href="toutes_les_ventes?id_vente=<?=$v['id'] ?>&action=supprimer" class="btn btn-danger">Supprimer</a>
                                    </td>
                                    </tr>
                                <?php
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
          </div>
        </div>

      </section>

    </div>
  </main>

  <?php
 require_once('footer.php');
?>
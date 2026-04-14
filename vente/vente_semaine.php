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

$today = date('Y-m-d');
$vente = $bdd->prepare('SELECT * FROM vente WHERE YEARWEEK(date_vente) = YEARWEEK(NOW()) ORDER BY id DESC');
$vente->execute();

$recup_vente_totale_semaine = $bdd->prepare("SELECT SUM(montant_total) AS vente_totale FROM vente WHERE YEARWEEK(date_vente) = YEARWEEK(NOW())");
$recup_vente_totale_semaine->execute();
$vente_totale = $recup_vente_totale_semaine->fetch();
?>

<?php
 require_once('header.php');
?>

  
  <main>
    <div class="container mt-5">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
           <div class="col-lg-12 col-md-12 align-items-center justify-content-center">
                        <div class="bg-white rounded h-100 p-4 table-responsive">
                            <h6 class="mb-4">Ventes de la semaine <span class="text-primary"><?=$vente_totale['vente_totale']  ?> Fc</span></h6>
                            <?php if($vente->rowCount() > 0) { ?>
                            <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nom produit</th>
                                        <th scope="col">Quantité</th>
                                        <th scope="col">Montant total</th>
                                        <th scope="col">Vendeur</th>
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
                                    <td>
                                        <a href="vente_du_jour?id_vente=<?=$v['id'] ?>&action=supprimer" class="btn btn-danger">Supprimer</a>
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
<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: ../");
    exit();
  }
  require_once('../connexiondb.php');

$requser = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = :id");
$requser->execute(array(':id' => $_SESSION['id']));
$userinfo = $requser->fetch();
$vendeur = $userinfo['prenom'] .' '. $userinfo['nom'];

if(isset($_GET['type']) && $_GET['type'] == 'commande') {
  
   if(isset($_GET['supprime']) && !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM commande WHERE id_commande = ?');
      $req->execute(array($supprime));
   }
   if(isset($_GET['confirme']) && !empty($_GET['confirme'])){
      $confirme = htmlspecialchars($_GET['confirme']);
      $nouveau_statut = "Reglée";
      $update_commande = $bdd->prepare("UPDATE commande SET statut = :statut WHERE id_commande = :id_commande");
      $update_commande->execute(array(':statut' => $nouveau_statut, ':id_commande' => $confirme));

      $req_commande = $bdd->prepare("SELECT * FROM commande WHERE id_commande = ? ");
      $req_commande->execute(array($confirme));
      $info_cmd = $req_commande->fetch();
      $id_produit = $info_cmd['id_produit'];
      $quantite_cmd = $info_cmd['quantite'];

      $id_client_cmd = $info_cmd['id_client'];


      $req_prod = $bdd->prepare("SELECT * FROM produit WHERE id_produit = ?");
      $req_prod->execute(array($id_produit));
      if($req_prod->rowcount() > 0){
        $info_prod = $req_prod->fetch();
        $quantite_prod = $info_prod['quantite'];
        $nouvelle_quantite_prod = $quantite_prod - $quantite_cmd;
        $update_prod = $bdd->prepare("UPDATE produit SET quantite = :quantite WHERE id_produit = :id_produit");
        $update_prod->execute(array(':quantite' => $nouvelle_quantite_prod, ':id_produit' => $id_produit));

        $nom_produit = $info_prod['nom_produit'];
        $quantite = $quantite_cmd;
        $montant_total = $info_cmd['montant_total'];
        $prix_achat = $info_prod['prix_achat_details'] / $info_prod['stock'];
        $prix_vente = $info_prod['prix_vente_details'];
        $insert_vente = $bdd->prepare("INSERT INTO vente(nom_produit, prix_achat, prix_vente, quantite, montant_total, date_vente, vendeur) VALUES(?, ?, ?, ?, ?, NOW(), ?)");
        $insert_vente->execute(array($nom_produit, $prix_achat, $prix_vente, $quantite, $montant_total, $vendeur));

        $message = "Cher(e) client(e), votre commande a été validée avec succès";
        $sujet = "Validation commande";
        
        $verif_not = $bdd->prepare("SELECT * FROM notification WHERE id_to = ? ANd sujet = ? AND lu = 0");
        $verif_not->execute(array($_SESSION['id'], $sujet));
       
            $lu = 0;
            $date_notification = date("Y-m-d h:m:s");
            $id_admin = $id_client_cmd;
            $id_from = 138;
        
            $sql_insert = $bdd->prepare("INSERT INTO notification (id_from, id_to,sujet, msg, lu, date_envoi) VALUES (?, ?, ?, ?, ?, NOW())");  
            $sql_insert->execute(array($id_from, $id_admin, $sujet, $message, $lu));
        
      }
   }
}
if(!isset($_GET['argument'])){
  header('location:../profil_client.php');
}else{
    $argument = htmlspecialchars($_GET['argument']);
}

switch($argument){
    case "tout":
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = htmlspecialchars($_GET['search']);
            $recup_commande = $bdd->prepare("SELECT * FROM commande WHERE (nom LIKE :search OR produit_commande LIKE :search) ORDER BY id_commande DESC");
            $recup_commande->execute(array(':search' => "%$search%"));
          } else {
            $recup_commande = $bdd->prepare("SELECT * FROM commande ORDER BY id_commande DESC");
            $recup_commande->execute();
          }
    break;
    case "en_attente":
        $statut = "Attente";
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = htmlspecialchars($_GET['search']);
            $recup_commande = $bdd->prepare("SELECT * FROM commande WHERE AND statut = :statut AND (nom LIKE :search OR produit_commande LIKE :search) ORDER BY id_commande DESC");
            $recup_commande->execute(array(':statut' => $statut, ':search' => "%$search%"));
          } else {
            $recup_commande = $bdd->prepare("SELECT * FROM commande WHERE statut = ? ORDER BY id_commande DESC");
            $recup_commande->execute(array($statut));
          }
    break;
    case "reglée":
        $statut = "Reglée";
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = htmlspecialchars($_GET['search']);
            $recup_commande = $bdd->prepare("SELECT * FROM commande WHERE statut = :statut AND (nom LIKE :search OR produit_commande LIKE :search) ORDER BY id_commande DESC");
            $recup_commande->execute(array(':statut' => $statut, ':search' => "%$search%"));
          } else {
            $recup_commande = $bdd->prepare("SELECT * FROM commande WHERE statut = ? ORDER BY id_commande DESC");
            $recup_commande->execute(array( $statut));
          }
    break;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Esembe Buzz</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

 
    <link href="../img/logo_esembe.jpg" rel="icon">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>

            <nav class="navbar navbar-expand bg-primary navbar-light sticky-top px-4 py-0">
               
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="bi bi-activity"></i>
                </a>
                <form class=" d-md-flex ms-4" action="" method="GET">
                    <input type="hidden" name="argument" value="<?=$argument ?>">
                    <input class="form-control border-0" name="search" type="text" placeholder="Recherche...">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                        <a href="../esb_user/profil_esb?id=<?=$_SESSION['id']?>" class="nav-link">
                            <i class="bi bi-box-arrow-right text-white display-6 me-lg-2"></i>
                            <span class="badge bg-primary badge-number"></span>
                        </a>
                    </div>
                </div>
            </nav>
           
            <!-- Recent Sales début -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recentes commandes</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    
                                    <th scope="col">Date</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Facture</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Statut</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   while($com = $recup_commande->fetch()){
                                ?>
                                <tr>
                                    
                                    <td><?=$com['date_commande'] ?></td>
                                    <td><?=$com['produit_commande'] ?></td>
                                    <td><?=$com['facture'] ?></td>
                                    <td><?=$com['nom'] ?> <?=$com['postnom'] ?> <?=$com['prenom'] ?></td>
                                    <td><?=$com['quantite'] ?></td>
                                    <td><?=$com['montant_total'] ?> FC</td>
                                    <td><?=$com['message'] ?></td>
                                    <td><?=$com['statut'] ?></td>
                                    <td><?=$com['type_commande'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-primary mb-2" href="admin/liste_commande.php?argument=tout">Details</a>
                                        <?php
                                          if($com['statut'] == "Attente"){
                                        ?>
                                        <a href="liste_commande?argument=<?=$argument ?>&type=commande&confirme=<?= $com['id_commande'] ?>" class="btn btn-primary btn-sm mb-2">Confirmer</a>
                                        <?php
                                        }
                                        ?>
                                        <a class="btn btn-sm btn-danger mb-2" href="liste_commande.php?argument=<?=$argument ?>&type=commande&supprime=<?= $com['id_commande'] ?>">Supprimer</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent et vente fin -->
        </div>
       
    
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
	document.onkeydown = 
	 function(e){
	  if(e.ctrlKey && e.which == 85){
		return false;
	  }
	 };
	 
	 document.addEventListener('contextmenu', function(event) {
	event.preventDefault();
  });
  
  document.addEventListener('keydown', function(event) {
	if (event.keyCode == 93 || event.keyCode == 91) {
	  event.preventDefault();
	}
  });
  document.addEventListener('keydown', function(event) {
    if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 's') {
        event.preventDefault();
        return false;
    }
});
document.addEventListener('keydown', function(e) {
    var isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
    if ((isMac && e.metaKey && e.keyCode === 85) || (!isMac && e.ctrlKey && e.keyCode === 85)) {
        e.preventDefault();
    }
});



document.addEventListener('keydown', function(e) {
    if (e.metaKey && e.keyCode === 85) {
        e.preventDefault();
    }
});
  </script>
</body>

</html>
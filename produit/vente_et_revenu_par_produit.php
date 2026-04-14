<?php

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../");
    exit();
  }
  require_once('../connexiondb.php');

if(isset($_GET['type']) && $_GET['type'] == 'produit') {
  
   if(isset($_GET['supprime']) && !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM produit WHERE id_produit = ?');
      $req->execute(array($supprime));
   }
}

if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $recup_produit = $bdd->prepare("SELECT * FROM produit WHERE  (nom_produit LIKE :search OR description LIKE :search) ORDER BY id_produit DESC");
    $recup_produit->execute(array(':search' => "%$search%"));
  } else {
    $recup_produit = $bdd->prepare("SELECT * FROM produit  ORDER BY id_produit DESC");
    $recup_produit->execute();
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
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
</head>

<body>
            
            <nav class="navbar navbar-expand bg-white navbar-light sticky-top px-4 py-0">
               
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="bi bi-activity"></i>
                </a>
                <form class=" d-md-flex ms-4" action="" method="GET">
                    <input class="form-control border-0" name="search" type="text" placeholder="Recherche...">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                        <a href="../administration/bureau_admin" class="nav-link">
                            <i class="bi bi-arrow-right text-primary display-6 me-lg-2"></i>
                            <span class="badge bg-primary badge-number"></span>
                        </a>
                    </div>
                </div>
            </nav>
           
            <!-- Recent Sales début -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white shadow-lg text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Vente et revenu par produit</h6>
                        <a href="ajouter_produit" class="btn btn-warning text-white">Ajouter un produit <i class="bi bi-cart"></i></a>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead class="bg-primary">
                                <tr class="text-white">
                                    
                                    <th scope="col">Date Ajout</th>
                                    <th scope="col">Nom produit</th>
                                    <th scope="col">Prix vente</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Vente du jour</th>
                                    <th scope="col">Vente total</th>
                                    <th scope="col">Revenu du jour</th>
                                    <th scope="col">Revenu total</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                  if($recup_produit->rowcount() > 0){
                                  while($ouv = $recup_produit->fetch()){
                                    $statut = "Reglée";
                                    $recup_nb_vente = $bdd->prepare("SELECT sum(montant_total) AS vente_total FROM vente WHERE nom_produit = :nom_produit");
                                    $recup_nb_vente->execute(array(':nom_produit' => $ouv['nom_produit']));
                                    $vente_total = $recup_nb_vente->fetch();

                                    $statut = "Reglée";
                                    $currentDate = date('Y-m-d');

                                    $recup_nb_vente_jour = $bdd->prepare("SELECT sum(montant_total) AS vente_jour FROM vente WHERE  DATE(date_vente) = :currentDate AND nom_produit = :nom_produit");
                                    $recup_nb_vente_jour->execute(array(':currentDate' => $currentDate, ':nom_produit' => $ouv['nom_produit']));
                                    $vente_jour = $recup_nb_vente_jour->fetch();


                                    $recup_revenu_total = $bdd->prepare("SELECT (sum(prix_vente*quantite) - sum(prix_achat*quantite)) AS revenu_total
                                    FROM vente
                                    WHERE nom_produit = :nom_produit GROUP BY nom_produit");
                                    $recup_revenu_total->execute(array(':nom_produit' => $ouv['nom_produit']));
                                    $revenu_total = $recup_revenu_total->fetch();


                                    $recup_revenu_jour = $bdd->prepare("SELECT (sum(prix_vente*quantite) - sum(prix_achat*quantite)) AS revenu_jour
                                    FROM vente
                                    WHERE DATE(date_vente) = :currentDate AND nom_produit = :nom_produit GROUP BY nom_produit");
                                    $recup_revenu_jour->execute(array(':currentDate' => $currentDate, ':nom_produit' => $ouv['nom_produit']));
                                    $revenu_jour = $recup_revenu_jour->fetch();

                                    $recup_quantite_jour = $bdd->prepare("
                                        SELECT SUM(quantite) AS total_quantite
                                        FROM vente
                                        WHERE DATE(date_vente) = :currentDate 
                                        AND nom_produit = :nom_produit
                                    ");

                                    $recup_quantite_jour->execute(array(
                                        ':currentDate' => $currentDate, 
                                        ':nom_produit' => $ouv['nom_produit']
                                    ));

                                    $quantite_jour = $recup_quantite_jour->fetch(PDO::FETCH_ASSOC);
                                    $quantiteVendue = $quantite_jour ? $quantite_jour['total_quantite'] : 0; 

                                    ?>
                                <tr>
                                    <td><?=$ouv['date_ajout'] ?></td>
                                    <td>
                                        <a href="../fichier/<?=$ouv['fichier'] ?>" class="gallery-lightbox">
                                        <img src="../fichier/<?=$ouv['fichier'] ?>" style="width:100px;height:100px;object-fit:cover;" alt="">
                                        </a>
                                        <h6 class="text-primary"><?=$ouv['nom_produit'] ?></h6>
                                    </td>
                                    <td><?=$ouv['prix_vente'] ?> Fc</td>
                                    <td><?=$ouv['quantite'] ?></td>
                                    <td><?=$ouv['stock'] ?></td>
                                    <td><?=$vente_jour['vente_jour'] ?> Fc <br>
                                     Quantité vendue : <?=$quantiteVendue ?>
                                    </td>
                                    <td><?=$vente_total['vente_total'] ?> Fc</td>
                                    <td>
                                        <?php
                                          if($revenu_jour == true){
                                            ?>
                                            <?=$revenu_jour['revenu_jour'] ?> Fc 
                                            <?php
                                          }
                                        ?>
                                        
                                    </td>
                                    <td>
                                        <?php
                                          if($revenu_total == true){
                                            ?>
                                            <?=$revenu_total['revenu_total'] ?> Fc
                                            <?php      
                                          }
                                        ?>
                                    </td>
                                </tr>
                               <?php
                                  }
                                }else{
                                    ?>
                                    <p class="text-center">Aucun produit trouvé</p>
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


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
      <script>
        (function() {
        "use strict";
        const galleryLightbox = GLightbox({
            selector: '.gallery-lightbox'
            });

        })()
        </script>

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
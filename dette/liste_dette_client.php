<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../");
    exit();
}
require_once('../connexiondb.php');

if(isset($_GET['action']) && $_GET['action'] == 'supprimer') {
   if(isset($_GET['id']) && !empty($_GET['id'])) {
      $supprime = (int) $_GET['id'];
      $req = $bdd->prepare('DELETE FROM dette_client WHERE id = ?');
      $req->execute(array($supprime));
   }
}

if(isset($_GET['search']) && !empty($_GET['search'])) {
   $search = htmlspecialchars($_GET['search']);
   $debiteurs = $bdd->query("SELECT * FROM dette_client WHERE nom LIKE '%$search%' OR prenom LIKE '%$search%' ORDER BY id DESC");
} else {
   $debiteurs = $bdd->query('SELECT * FROM dette_client ORDER BY id DESC');
}
$recup_dette_totale = $bdd->prepare("SELECT sum(montant_emprunt) as montant_dette_totale FROM dette_client ");
$recup_dette_totale->execute();
$dette_totale = $recup_dette_totale->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Esembes Buzz</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="../img/logo_esembe.jpg" rel="icon">
    <link href="../img/logo_esembe.jpg" rel="apple-touch-icon">

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
            
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="bi bi-broadcast"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="bi bi-activity"></i>
                </a>
                <form class=" d-md-flex ms-4" action="" method="GET">
                    <input class="form-control border-0" name="search" type="text" placeholder="Recherche...">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                        <a href="../administration/bureau_admin" class="nav-link">
                            <i class="bi bi-box-arrow-right text-primary display-6 me-lg-2"></i>
                            <span class="badge bg-primary badge-number"></span>
                        </a>
                    </div>
                </div>
            </nav>
            
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-80 bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-10 text-center p-4">
                 
                        <div class="bg-light rounded h-100 p-4 table-responsive">
                            <h6 class="mb-4">Liste dette client</h6>
                            <h6>Dette totale : <?=$dette_totale['montant_dette_totale'] ?>Fc</h6>
                            <a href="ajouter_dette_client" class="btn btn-primary">Ajouter dette client</a>
                            <?php if($debiteurs->rowCount() > 0) { ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prenom</th>
                                        <th scope="col">Sexe</th>
                                        <th scope="col">Téléphone</th>
                                        <th scope="col">Adresse</th>
                                        <th scope="col">Produit emprunté</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Date emprunt</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($d = $debiteurs->fetch()) { ?>
                                <tr>
                                    <td><?= $d['id'] ?></td>
                                    <td><?= $d['nom'] ?></td>
                                    <td><?= $d['prenom'] ?></td>
                                    <td><?= $d['sexe'] ?></td>
                                    <td><a href="tel:<?= $d['telephone'] ?>"><?= $d['telephone'] ?></a></td>
                                    <td><?= $d['adresse'] ?></td>
                                    <td><?= $d['produit_emprunte'] ?></td>
                                    <td><?= $d['montant_emprunt'] ?>Fc</td>
                                    <td><?= $d['statut'] ?></td>
                                    <td><?= $d['code'] ?></td>
                                    <td><?= $d['date_emprunt'] ?></td>
                                    <td> 
                                        <a href="liste_dette_client?action=supprimer&id=<?= $d['id'] ?>" class="btn btn-danger mb-2 mt-2">Supprimer</a>     
                                        <a href="modifier_dette?action=modifier&id=<?= $d['id'] ?>" class="btn btn-primary mb-2 mt-2">Modifier</a>
                                    </td>   
                                </tr>
                                 <?php } ?>
                                </tbody>
                            </table>
                            <?php } else { ?>
    <p>Aucune dette trouvée</p>
   <?php } ?>
                        </div>
   </div>
    </div>
   </div>


            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="htptps://www.esembe-business.com">Esembe</a>, Tous droits réservés. <br>
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            &copy;   <span class="small"><script>document.write(new Date().getFullYear())</script>
                        </div>
                    </div>
                </div>
            </div>
           
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
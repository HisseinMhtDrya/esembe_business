<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../");
    exit();
}
require_once('../connexiondb.php');

if(isset($_GET['type']) AND $_GET['type'] == 'commentaire') {
   if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
      $approuve = (int) $_GET['approuve'];
      $req = $bdd->prepare('UPDATE contact_esembe SET lu = 1 WHERE id = ?');
      $req->execute(array($approuve));
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM contact_esembe WHERE id = ?');
      $req->execute(array($supprime));
   }
}

if(isset($_GET['search_query']) && !empty($_GET['search_query'])) {
   $search_query = $_GET['search_query'];
   $commentaires = $bdd->prepare('SELECT * FROM contact_esembe WHERE sujet LIKE :search_query OR message LIKE :search_query OR nom LIKE :search_query ORDER BY id DESC');
   $commentaires->execute(array('search_query' => '%' . $search_query . '%'));
} else {
   $commentaires = $bdd->query('SELECT * FROM contact_esembe ORDER BY id DESC');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Esembe Business</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="img/logorudless.jpeg" rel="icon">

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
                <form class=" d-md-flex ms-4" method="GET">
                    <input class="form-control border-0" name="search_query" type="search" placeholder="Recherche...">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                <a href="bureau_admin" class="nav-link">
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
                            <h6 class="mb-4">Listes des messages</h6>
                            <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Expéditeur</th>
                                        <th scope="col">Mail</th>
                                        <th scope="col">Sujet</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Date envoi</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($c = $commentaires->fetch()) { ?>
      <li style="list-style:none;">
                                <tr>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= $c['prenom'] ?> <?= $c['nom'] ?></td>
                                    <td><?= $c['mail'] ?></td>
                                    <td><?= $c['sujet'] ?></td>
                                    <td><?= $c['message'] ?></td>
                                    <td><?= $c['date_message'] ?></td>
                                    <td><?php if($c['lu'] == 0) { ?> 
          <a href="listes_contact?type=commentaire&approuve=<?= $c['id'] ?>" class="btn btn-outline-primary mb-2 mb-2">Approuver</a><?php } ?> <br>
          <a href="mailto:<?= $c['mail']?>" class="btn btn-outline-primary mt-2 mb-2">Répondre</a><br>
          <a href="listes_contact?type=commentaire&supprime=<?= $c['id'] ?>" class="btn btn-primary">Supprimer</a>
        </li>    
                                </tr>
                                 <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
   </div>
    </div>
   </div>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="htptps://www.esemebe-business.com">Esembe</a>, Tous droits réservés. <br>
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
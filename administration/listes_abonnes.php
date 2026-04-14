<?php
session_start();
if (!isset($_SESSION['id'])) {
    // Rediriger vers la page de connexion
    header("Location: ../connexion/login/connexion_secodn.php");
    exit();
  }
$bdd = new PDO('mysql:host=127.0.0.1;dbname=d_second;charset=utf8', 'root', '');

if(isset($_GET['type']) AND $_GET['type'] == 'commentaire') {
   if(isset($_GET['approuve']) AND !empty($_GET['approuve'])) {
      $approuve = (int) $_GET['approuve'];
      $req = $bdd->prepare('UPDATE abonnement SET approuve = 1 WHERE id = ?');
      $req->execute(array($approuve));
   }
   if(isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
      $supprime = (int) $_GET['supprime'];
      $req = $bdd->prepare('DELETE FROM abonnement WHERE id = ?');
      $req->execute(array($supprime));
   }
}

if(isset($_GET['search_query']) && !empty($_GET['search_query'])) {
   $search_query = $_GET['search_query'];
   $commentaires = $bdd->prepare('SELECT * FROM abonnement WHERE mail LIKE :search_query ORDER BY id DESC');
   $commentaires->execute(array('search_query' => '%' . $search_query . '%'));
} else {
   $commentaires = $bdd->query('SELECT * FROM abonnement ORDER BY id DESC');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RudLess</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/logorudless.jpeg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
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
                        <a href="../PROFIL/mon_profil.php?id=<?=$_SESSION['id']?>" class="nav-link">
                            <i class="bi bi-person-circle text-primary display-6 me-lg-2"></i>
                            <span class="badge bg-primary badge-number"></span>
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-80 bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-10 text-center p-4">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Listes des abonnés</h6>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Mail</th>
                                        <th scope="col">Date abonnement</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($c = $commentaires->fetch()) { ?>
      <li style="list-style:none;">
                                <tr>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= $c['mail'] ?></td>
                                    <td><?= $c['date_abonnement'] ?></td>
                                    <td><?php if($c['approuve'] == 0) { ?> 
          <a href="listes_abonnes.php?type=commentaire&approuve=<?= $c['id'] ?>" class="btn btn-outline-primary">Approuver</a><?php } ?> 
          <a href="listes_abonnes.php?type=commentaire&supprime=<?= $c['id'] ?>" class="btn btn-primary">Supprimer</a></li>    
                                </tr>
                                 <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
   </div>
    </div>
   </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="htptps://www.rudless.com">RudLess</a>, Tous droits réservés. <br>
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            &copy;   <span class="small"><script>document.write(new Date().getFullYear())</script>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
  
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
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
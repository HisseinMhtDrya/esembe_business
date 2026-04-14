<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: ../");
  exit();
}

require_once('../connexiondb.php');

$req_verif_admin = $bdd->prepare("SELECT * FROM admin WHERE id_admin = ?");
$req_verif_admin->execute(array($_SESSION['id']));

if($req_verif_admin->rowCount() == 0){
	$temps_attente = 0;
	$insert_admin = $bdd->prepare("INSERT INTO admin(id_admin, statut, temps_attente) VALUES(?, ?, ?)");
	$insert_admin->execute(array($_SESSION['id'], 'actif', $temps_attente));
}else{
	$info_admin = $req_verif_admin->fetch();

if (isset($_POST['code_validation'])) {
    $code_validation = $_POST['mdpconnect'];
    $sql = "SELECT * FROM code_admin WHERE code = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$code_validation]);

    if ($stmt->rowCount() == 1) {
        $_SESSION['administrateur'] = true;
        header("Location: bureau_admin");
        exit();
    } else {

        if (!isset($_SESSION['nb_tentatives'])) {
            $_SESSION['nb_tentatives'] = 1;
        } else {
            $_SESSION['nb_tentatives']++;
        }

        if ($_SESSION['nb_tentatives'] >= 3) {
            $temps_attente = time() + 1800;  
			$statut = "bloque"; 
			$update_admin = $bdd->prepare("UPDATE admin SET statut = ? , temps_attente = ? WHERE id_admin = ? ");
			$update_admin->execute(array($statut, $temps_attente, $_SESSION['id']));
			echo "Trop de tentatives erronées. Veuillez patienter 30 minutes avant de réessayer.";
            exit();
        } else {
            $erreur = "Code de validation incorrect. Tentative " . $_SESSION['nb_tentatives'] . " sur 3.";
            
        }
    }
}

$id_utilisateur = $_SESSION['id'];
$sql = "SELECT * FROM membre_esembe WHERE id = :id_utilisateur AND (type = 'Super Administrateur' OR type = 'Super Administratrice' OR type = 'Administrateur' OR type = 'Administratrice' )";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_utilisateur', $id_utilisateur);
$stmt->execute();

if ($stmt->rowCount() == 0) {
    // Rediriger vers la page de profil
    header('Location: ../');
    exit();
}
if($info_admin['statut']=='actif' AND $info_admin['temps_attente'] < time()){

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
  
  <div class="container-fluid position-relative bg-white d-flex p-0">

    <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-8 col-lg-4 col-xl-4">
                    <div class="bg-white card shadow rounded p-4 p-sm-5 my-4 mx-3">

                       

                        <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Espace d'administration</h5>
                    <p class="text-center small">Saisir le code d'accès</p>
                  </div>
                  <form method="POST" class="row g-3 needs-validation" novalidate>
                  <?php
                      if(isset($erreur)) {
                       echo '<font color="red">'.$erreur."</font>";
                      }
                      ?>

                    <div class="col-12">
                    
                      <input type="password" name="mdpconnect" class="form-control" placeholder="Saisir le code" id="yourPassword" required>
                      <div class="invalid-feedback">Veuillez saisir le code d'accès!</div>
                    </div>
                    <div class="col-12">
                    <input type="submit" class="btn btn-primary w-100" style="border-radius: 15px;" name="code_validation" value="Valider" class="btnLogin">
                    </div>
                  </form>
                   
                    </div>
                </div>
            </div>
        </div>
 
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
<?php
}elseif($info_admin['statut']=='bloque' AND $info_admin['temps_attente'] < time()){
//Mise à jour du statut et temps_attente
    $sql_reinitialisation = "UPDATE admin SET statut = 'actif', temps_attente = 0 WHERE id_admin = :id_admin";
    $resultat_reinitialisation = $bdd->prepare($sql_reinitialisation);
    $resultat_reinitialisation->bindParam(':id_admin', $_SESSION['id']);
    $resultat_reinitialisation->execute();
}else{
	$temps_attente = $info_admin['temps_attente'];
	$dif_temps = $temps_attente - time();
	?>
	<p class="text-center">Votre statut a été bloqué !</p>
	<p>Veuillez patienter encore pendant <?=$dif_temps ?> secondes avant de reéssayer.</p>
	<?php
}
}
?>
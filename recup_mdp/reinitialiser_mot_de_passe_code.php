<?php
session_start();

if(!isset($_SESSION['code'])){
  header("location: ../");
}else{
  $code = htmlspecialchars($_SESSION['code']);
}

require_once('../connexiondb.php');

   $requser = $bdd->prepare("SELECT * FROM membre_tz WHERE unique_id = ?");
   $requser->execute(array($code));
   $user = $requser->fetch();

   if(isset($_POST['valider'])) {

	  $mdp1 = $_POST['mdp1'];
      $mdp2 = $_POST['mdp2'];

      if(isset($_POST['mdp1']) AND !empty($_POST['mdp1']) AND isset($_POST['mdp2']) AND !empty($_POST['mdp2'])) {
       
               if($mdp1 == $mdp2) {

                $valid_password = true;
		
                if(strlen($mdp1) < 6) {
                   $valid_password = false;
                   $erreur = "Le mot de passe doit contenir au moins 6 caractères.";
                }
        
                if(!preg_match('@[A-Z]@', $mdp1)) {
                   $valid_password = false;
                   $erreur = "Le mot de passe doit contenir au moins une lettre majuscule.";
                }
            
                if(!preg_match('@[a-z]@', $mdp1)) {
                   $valid_password = false;
                   $erreur = "Le mot de passe doit contenir au moins une lettre minuscule.";
                }
                if($valid_password) {

                     $insertmdp = $bdd->prepare("UPDATE surho SET motdepasse = ? WHERE mail = ?");
                     $insertmdp->execute(array(password_hash($mdp1, PASSWORD_DEFAULT), $email));
                     $erreur = "Votre mot de passe a été mis à jour avec succès !";

		             header('Location: pre_connexion');
                 $erreur = "Mot de passe mis à jour avec succès !";
		        
            }
		      }else{
            $erreur = "Vos mots de passse ne sont pas identiques !";
          }
        
}else{
	$erreur = "Veuillez compléter tous les champs !";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TaZa</title>
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

<main>
    <div class="container">

      <section class="section register min-vh-90 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight:900;">Réinitialisation du mot de passe</h5>
                  </div>
                 
    <form action="" method="POST">
    <?php
         if(isset($erreur))
         {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>	
                     <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
                    <label for="mdp1">Nouveau mot de passe</label>
                              <div class="input-group has-validation">
                                <input type="password" id="mdp1" class="form-last-name form-control" name="mdp1" required>
                              </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
                    <label for="password">Confirmer mot de passe</label>
                              <div class="input-group has-validation">
                                <input style="margin-bottom: 10px;" type="password" id="password" class="form-last-name form-control" name="mdp2" required>
                              </div>
                    </div><br><br>
                    <div class="col-12">
        <input type="submit" class="btn btn-primary w-100" name="valider" value="Mettre à jour">
                    </div>
                     </div>
    </form>

    </form>
                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <script src="assets/js/main.js"></script>

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
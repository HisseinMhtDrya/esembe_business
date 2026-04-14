<?php
session_start();
require_once('../../connexiondb.php');

if(isset($_POST['formconnexion'])) {
  $identifiant = htmlspecialchars($_POST['identifiant']);
  $mdpconnect = $_POST['mdpconnect'];
  if(!empty($identifiant) && !empty($mdpconnect)) {
     $requser = $bdd->prepare("SELECT * FROM membre_esembe WHERE (mail = :identifiant OR phone = :identifiant)");
     $requser->execute(array(':identifiant' => $identifiant));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         if(password_verify($mdpconnect, $userinfo['motdepasse'])) {
          
          
           $_SESSION['id'] = $userinfo['id'];
           $_SESSION['nom'] = $userinfo['nom'];
           $_SESSION['mail'] = $userinfo['mail'];
           $status = "En ligne";

           $req = $bdd->prepare("UPDATE membre_esembe SET status = :status WHERE id = :id");
           $req->execute(array(':status' => $status, ':id' => $_SESSION['id']));
           
           $req = $bdd->prepare("UPDATE membre_esembe SET derniere_activite = NOW() WHERE id = :id");
           $req->execute(array(':id' => $_SESSION['id']));

           if($userinfo['statut'] == 'actif' || $userinfo['statut'] == 'active') {
            
             header("Location: ../../esb_user/profil_esb?id=".$_SESSION['id']);
           } elseif($userinfo['statut'] == 'desactive' && $userinfo['confirme'] == 1) {
             $erreur = "Ce compte a été temporairement désactivé. Veuillez suivre ce lien pour le réactiver !
             <a href=\"../reactivation_compte_tz\"><br>Réactiver mon compte</a>";
           }elseif($userinfo['statut'] == 'desactive' && $userinfo['confirme'] == 0) {
            $erreur = "Ce compte a été désactivé pour non paiement de frais d'abonnement. 
            Veuillez suivre ce lien pour le réactiver !
            <a href=\"../avant_confirme_compte\"><br>Réactiver mon compte</a>";
          } else {
             $erreur = "Ce compte a été temporairement suspendu. Veuillez contacter un administrateur pour le réactiver !";
           }
         } else {
           $erreur = "Mauvais identifiant ou mot de passe !";
         }
      } else {
        $erreur = "Mauvais identifiant ou mot de passe !";
      }
   } else {
      $erreur = "Veuillez compléter tous les champs !";
   }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Esembe Business</title>
  <meta name="description" content="Bienvenue sur ensembe business - votre destination pour le meilleur du commerce en ligne et des services de qualité. Découvrez nos services, avantages et opportunités uniques.">
  <meta name="keywords" content="commerce en ligne, services, avantages, opportunités, ensembe business">
 
  <link href="../img/logo_esembe.jpg" rel="icon">
  <link href="../img/logo_esembe.jpg" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
   <style>
    .btnLogin{
      background:#3366ff;
      color:#fff;
      padding:8px;
    }
   </style>

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

            

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 900;color:#3366ff;" >Esembe</h5>
                    <p class="text-center small">Veuillez vous identifier pour vous connecter</p>
                  </div>

                  <form class="row g-3 needs-validation" method="post" novalidate>
                    <?php
                     if(isset($erreur)) {
                    ?>
                       <span class="text-center text-danger"><?=$erreur ?></span>
                    <?php
                    }
                    ?>
                    <div class="col-12">
                      <div class="input-group has-validation">
                        <input type="text" name="identifiant"  class="form-control" id="" placeholder="Mail ou Téléphone" required>
                        <div class="invalid-feedback">Veuillez saisir votre adresse mail ou numéro de Téléphone</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <input type="password" name="mdpconnect" class="form-control" id="" placeholder="Mot de passe" required>
                      <div class="invalid-feedback">Veuillez saisir votre mot de passe!</div>
                    </div>

                    
                    <div class="col-12">
                    <input type="submit" class="w-100 btnLogin" style="border-radius: 15px;" name="formconnexion" value="Se connecter">
                    </div>
                    <div class="text-center">
                      <a href="../../recup_mdp/choix_maniere" class="text-center">Mot de passe oublié ?</a>
                    </div>
                    <div class="col-12 text-center">
                      <p class="small mb-0">Nouveau ici ? <a href="../inscription_esembe" class="btn btn-success">Creér un compte</a></p>
                    </div>
                  </form>

                </div>
              </div>

           
            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
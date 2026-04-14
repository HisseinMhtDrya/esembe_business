<?php
session_start();
require_once('../connexiondb.php');

if(isset($_POST['forminscription'])) {
   $nom = htmlspecialchars($_POST['nom']);
   $postnom = htmlspecialchars($_POST['postnom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $sexe = htmlspecialchars($_POST['sexe']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
  
   $date_inscription = date("Y-m-d h:m:s");
   $phone = htmlspecialchars($_POST['phone']);
   $mdp = $_POST['mdp'];
   $mdp2 = $_POST['mdp2'];
   $biographie = "";
   $profession = "";
   $attente = "";
   $avatar = "";
   $cover = "";
   $status ="";
   $date_naissance = "";
   $derniere_activite = date("Y-m-d h:m:s");
   $last = time();
   $confirme = 0;

   if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['sexe']) AND (!empty($_POST['mail']) || !empty($_POST['phone'])) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {

    $req_membre = $bdd->prepare("SELECT * FROM membre_effectif WHERE nom = ? AND postnom = ? AND prenom = ?");
    $req_membre->execute(array($nom, $postnom, $prenom));
    
    $membre_exist = $req_membre->rowCount();
    if($membre_exist > 0){
      $info_membre = $req_membre->fetch();
      $type = $info_membre['type'];
   
          $nom = ucfirst(strtolower($nom));
          $prenom = ucfirst(strtolower($prenom));
          

        if($mail == $mail2 || empty($mail)) {
            // Vérifier si l'adresse mail est saisie et est valide
            if(empty($mail) || filter_var($mail, FILTER_VALIDATE_EMAIL)) {
             
               $reqmail = $bdd->prepare("SELECT * FROM membre_esembe WHERE mail = ? AND mail != '' ");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();

               if($mailexist == 0) {

                  if(!empty($phone)){
                    $reqphone = $bdd->prepare("SELECT * FROM membre_esembe WHERE phone = ?");
                    $reqphone->execute(array($phone));
                    $phonexist = $reqphone->rowCount();
                    if($phonexist == 0){

                $valid_password = true;

                if(strlen($_POST['mdp']) < 7) {
                   $valid_password = false;
                   $erreur = "Le mot de passe doit contenir au moins 7 caractères.";
                }

               
                if($valid_password) {

                  if($mdp == $mdp2) {
                    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
                 
                    if($sexe == "Homme"){
                        $statut="actif";
                    } else {
                        $statut="active";
                    }
                    
                    $insertmbr = $bdd->prepare("INSERT INTO membre_esembe(nom, postnom, prenom, sexe, mail, type, phone, motdepasse, status, last_activity, date_inscription, confirme, statut, derniere_activite, avatar, couverture) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
                    
                    $insertmbr->execute(array($nom, $postnom, $prenom, $sexe, $mail, $type, $phone, $mdpHash, $status, $last, $date_inscription, $confirme, $statut, $avatar, $cover));
                   
                        
                    $id = $bdd->LastInsertId();
                    $_SESSION['id_user'] = $id;

                    $erreur = "Votre compte a bie été créé ! Merci beaucoup pour la confiance!!!!! <a href=\"login/connexion_msi.php\" class=\"btn btn-primary\">Me connecter </a>";
                    header('location:accueil_inscription?nom='.$nom.'&postnom='.$postnom.'&prenom='.$prenom);
                    } else {
                        $erreur = "Vos mots ne sont pas identiques !";
                    }
                }
              
              }else{
                $erreur = "Numéro de téléphone déjà utilisé !";
              }
              }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
             
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne sont pas identiques !";
         }
      }else{
        $erreur = "Vous ne pouvez pas créer un compte. Bye !";
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
  <meta content="TaZa, votre plateforme de référence pour les formations d'éducation financière et l'accompagnement des jeunes entrepreneurs en Afrique. Notre mission est de vous aider à transformer vos ambitions en succès concret, quel que soit votre point de départ." name="description">
  <meta content="Embrassez les opprtunités infinies qui s'offrent à vous." name="keywords">

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
    .btnInscription{
      background:#3366ff;
      color:#fff;
      padding:8px;
      border-radius:10px;
    }
   </style>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

              <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Réjoindre <a href="https://www.esembe.com">Esembe</a></h5>
                    <p class="text-center small">Veuillez décliner votre identité pour créer un compte</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                      echo '<font color="red">'.$erreur."</font>";
                      }
                     ?>
                    <div class="col-6">
                      <label for="nom" class="form-label">Nom</label>
                   
                        <input type="text" placeholder="" class="form-first-name form-control" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" required />
                      <div class="invalid-feedback">Veuillez saisir votre nom</div>
                 
                    </div>
                    <div class="col-6">
                      <label for="postnom" class="form-label">Postnom</label>
               
                        <input type="text" class="form-last-name form-control" placeholder="" id="postnom" name="postnom" value="<?php if(isset($postnom)) { echo $postnom; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir votre postnom.</div>
                   
                    </div>
                    <div class="col-12">
                      <label for="prenom" class="form-label">Prenom</label>
                    
                        <input type="text" class="form-last-name form-control" placeholder="" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir votre prenom.</div>
                  
                    </div>

                    <div class="col-12">
                  
                      <label for="sexe">Genre</label><br>
                      <select name="sexe" id="sexe" class="form-control">
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                      </select>
                    </div>
                    <div class="col-12">
                          <label for="phone">Téléphone</label>
                          <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-telephone"></i></span>
                          <input class="form-control" type="tel" placeholder="" id="phone" name="phone" value="<?php if(isset($phone)) { echo $phone; } ?>" required />
                       <div class="invalid-feedback">Veuillez saisir votre numéro de téléphone !</div></div>
                    </div>

                    <div class="col-6">
                      <label for="mail" class="form-label">E-mail</label>
                  
                        <input type="email" class="form-password form-control" placeholder="" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>"/>
                      <div class="invalid-feedback">Veuillez saisir votre adresse mail</div>
                    </div>
              
                    <div class="col-6">
                      <label for="yourEmail" class="form-label">Confirmer</label>
           
                        <input class="form-control" type="email" placeholder="" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                      <div class="invalid-feedback">Veuillez Confirmer votre adresse mail</div>
                    
                    </div>
                   
                    <div class="col-6">
                      <label for="yourPassword" class="form-label">Mot de passe</label>
              
                        <input type="password" class="form-password form-control" placeholder="Votre mot de passe" id="mdp" name="mdp" value="<?php if(isset($mdp)) { echo $mdp; } ?>" required />
                      <div class="invalid-feedback">Veuillez saisir votre mot de passe</div>
              
                    </div>
                    <div class="col-6">
                      <label for="yourPassword" class="form-label">Confirmer</label>
                    
                        <input  class="form-repeat-password form-control" type="password" placeholder="" id="mdp2" name="mdp2" value="<?php if(isset($mdp2)) { echo $mdp2; } ?>" required />
                      <div class="invalid-feedback">Veuillez Confirmer votre mot de passe</div>
                 
                    </div>
                   
                    <div class="col-12">
                      <button class="btnInscription w-100" name="forminscription" type="submit">S'inscrire</button>
                    </div>
                    <div class="col-12 text-center">
                      <p class="small mb-0" style="font-weight:bolder;">Vous avez déjà un compte ?
                       <a href="login/connexion_esembe" class="btn btn-primary" >Connectez-vous ici</a></p>
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

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
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
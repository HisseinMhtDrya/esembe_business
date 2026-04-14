<?php
require_once('../connexiondb.php');
if(!isset($_GET['type_compte'])){
 header('location:../');
}else{
  $type_compte = htmlspecialchars($_GET['type_compte']);
}
function verifierInsultes($nom, $prenom) {
  $insultes = array("abruti", "salope", "idiot", "fou", "folle", "putain", "impoli", "mal éduqué", "absurde", "enculé", "con", "pute", "merde", "pd", "connard", "aller niquer sa mère", "aller se faire enculer", "aller se faire endauffer", "aller se faire foutre", "aller se faire mettre", "andouille", "appareilleuse", "assimilé", "astèque", "avorton", "bande d’abrutis", "bâtard", "bellicole", "bête", "bête à pleurer", "bête comme ses pieds", "bête comme un chou", "bête comme un cochon", "biatch", "bic", "bicot", "bite", "bitembois", "Bitembois", "bordille", "boudin", "bouffon", "bougnoul", "bougnoule", "Bougnoulie", "bougnoulisation", "bougnouliser", "bougre", "boukak", "boulet", "bounioul", "bourdille", "branleur", "brigand", "brise-burnes", "cacou", "cafre", "cageot", "caldoche", "casse-bonbon", "casse-couille", "casse-couilles", "cave", "chachar", "chagasse", "charlot de vogue", "bite", "fesse", "pénis", "vagin", "sein", "chauffard", "chien de chrétien", "chiennasse", "chienne", "chier", "chinetoc", "chinetoque", "chintok", "chleuh" , "chnoque", "citrouille", "coche", "colon", "con", "con comme la lune", "con comme la Lune", "con comme ses pieds", "con comme un balai", "con comme un manche", "con comme une chaise", "con comme une valise sans poignée", "conasse", "conchier", "connard", "connarde", "connasse", "counifle", "courtaud", "crétin", "crevure", "cricri", "crotté", "crouillat", "crouille", "croûton", "débile", "doryphore", "doxosophe", "doxosophie", "drouille", "du schnoc", "ducon", "duconnot", "dugenoux", "dugland", "duschnock", "emmanché", "emmerder", "emmerdeur", "emmerdeuse", "empafé", "empapaouté", "enculé", "enculé de ta race", "enculer", "enfant de putain", "enfant de pute", "enfant de salaud", "enflure", "enfoiré", "envaselineur", "épais", "espèce de", "espingoin", "étron", "face de chien", "face de pet", "face de rat", "FDP", "fell", "fils de bâtard", "fils de chien", "fils de chienne", "fils de garce", "fils de putain", "fils de pute", "fils de ta race", "fiotte", "folle", "fouteur", "fripouille", "frisé", "fritz", "Fritz", "fumier", "garage à bite", "garce", "gaupe", "GDM", "gland", "glandeur", "glandeuse", "glandouillou", "glandu", "gnoul", "gnoule", "Godon", "gogol", "goï", "gouilland", "gouine", "gourde", "gourgandine", "grognasse", "gueniche", "guide de merde", "guindoule", "habitant", "halouf", "imbécile", "incapable", "islamo-gauchisme", "jean-foutre", "jeannette", "journalope", "Khmer rouge", "Khmer vert", "kikoo", "kikou", "Kraut", "lâche", "lâcheux", "lavette", "lopette", "magot", "makoumé", "mal blanchi", "manche", "mange-merde", "mangeux de marde", "marchandot", "margouilliste", "marsouin", "mauviette", "melon", "merdaille", "merdaillon", "merde", "merdeux", "merdouillard", "michto", "minable", "minus", "misérable", "moinaille", "moins-que-rien", "monacaille", "mongol");

  foreach($insultes as $insulte) {
     if(strpos($nom, $insulte) !== false || strpos($prenom, $insulte) !== false) {
        return false;
     }
  }
  return true;
}
function insulte($chaine){
   $injures = array("abruti", "salope", "idiot", "fou", "folle", "putain", "impoli", "mal éduqué", "absurde", "enculé", "con", "pute", "merde", "pd", "connard", "aller niquer sa mère", "aller se faire enculer", "aller se faire endauffer", "aller se faire foutre", "aller se faire mettre", "andouille", "appareilleuse", "assimilé", "astèque", "avorton", "bande d’abrutis", "bâtard", "bellicole", "bête", "bête à pleurer", "bête comme ses pieds", "bête comme un chou", "bête comme un cochon", "biatch", "bic", "bicot", "bite", "bitembois", "Bitembois", "bordille", "boudin", "bouffon", "bougnoul", "bougnoule", "Bougnoulie", "bougnoulisation", "bougnouliser", "bougre", "boukak", "boulet", "bounioul", "bourdille", "branleur", "brigand", "brise-burnes", "cacou", "cafre", "cageot", "caldoche", "casse-bonbon", "casse-couille", "casse-couilles", "cave", "chachar", "chagasse", "charlot de vogue", "bite", "fesse", "pénis", "vagin", "sein", "chauffard", "chien de chrétien", "chiennasse", "chienne", "chier", "chinetoc", "chinetoque", "chintok", "chleuh" , "chnoque", "citrouille", "coche", "colon", "con", "con comme la lune", "con comme la Lune", "con comme ses pieds", "con comme un balai", "con comme un manche", "con comme une chaise", "con comme une valise sans poignée", "conasse", "conchier", "connard", "connarde", "connasse", "counifle", "courtaud", "crétin", "crevure", "cricri", "crotté", "crouillat", "crouille", "croûton", "débile", "doryphore", "doxosophe", "doxosophie", "drouille", "du schnoc", "ducon", "duconnot", "dugenoux", "dugland", "duschnock", "emmanché", "emmerder", "emmerdeur", "emmerdeuse", "empafé", "empapaouté", "enculé", "enculé de ta race", "enculer", "enfant de putain", "enfant de pute", "enfant de salaud", "enflure", "enfoiré", "envaselineur", "épais", "espèce de", "espingoin", "étron", "face de chien", "face de pet", "face de rat", "FDP", "fell", "fils de bâtard", "fils de chien", "fils de chienne", "fils de garce", "fils de putain", "fils de pute", "fils de ta race", "fiotte", "folle", "fouteur", "fripouille", "frisé", "fritz", "Fritz", "fumier", "garage à bite", "garce", "gaupe", "GDM", "gland", "glandeur", "glandeuse", "glandouillou", "glandu", "gnoul", "gnoule", "Godon", "gogol", "goï", "gouilland", "gouine", "gourde", "gourgandine", "grognasse", "gueniche", "guide de merde", "guindoule", "habitant", "halouf", "imbécile", "incapable", "islamo-gauchisme", "jean-foutre", "jeannette", "journalope", "Khmer rouge", "Khmer vert", "kikoo", "kikou", "Kraut", "lâche", "lâcheux", "lavette", "lopette", "magot", "makoumé", "mal blanchi", "manche", "mange-merde", "mangeux de marde", "marchandot", "margouilliste", "marsouin", "mauviette", "melon", "merdaille", "merdaillon", "merde", "merdeux", "merdouillard", "michto", "minable", "minus", "misérable", "moinaille", "moins-que-rien", "monacaille", "mongol");
   
   foreach($injures as $injure){
    if(strpos($chaine, $injure) !== false){
      return false;
    }
   }
   return true;
}

if(isset($_POST['valider'])) {
   $nom = htmlspecialchars($_POST['nom']);
   $postnom = htmlspecialchars($_POST['postnom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $date_naissance = "";
   $sexe = htmlspecialchars($_POST['sexe']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $adresse = htmlspecialchars($_POST['adresse']);
   $date_inscription = date("Y-m-d h:m:s");
   $phone = htmlspecialchars($_POST['phone']);
   $mdp = $_POST['mdp'];
   $mdp2 = $_POST['mdp2'];
   $biographie = "";
   $profession = "";
   $attente = "";
   $avatar = "";
   $cover = "";
   $site = "";
   $status ="";
   $derniere_activite = date("Y-m-d h:m:s");
   $confirme = "";
   $facebook = "";
   $instagram = "";
   $twitter = "";
   $linkedin = "";
   $role = "Assistance client";
  
   $last_activity = time();
 
   if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['sexe']) AND (!empty($_POST['mail']) || !empty($_POST['phone'])) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
    
   $verif_membre_effectif = $bdd->prepare("SELECT * FROM membre_effectif WHERE nom = ? AND postnom = ? AND prenom = ?");
   $verif_membre_effectif->execute(array($nom, $postnom, $prenom));
   
   if($verif_membre_effectif->rowCount() > 0){
    $info_membre = $verif_membre_effectif->fetch();
    $type = $info_membre['type'];

    if(isset($_POST['mail'])){
      $mail = htmlspecialchars($_POST['mail']);
    }else{
      $mail = "";
    }
    $nomlength = strlen($nom);
      $prenomlength = strlen($prenom);
     
      if($nomlength >= 4 AND $nomlength <=255 AND $prenomlength >=4 AND $prenomlength <=255) {

        if(verifierInsultes(strtolower($nom), strtolower($prenom))) {
          $nom = ucfirst(strtolower($nom));
          $prenom = ucfirst(strtolower($prenom));
          

        if($mail == $mail2 || empty($mail)) {
            // Vérifier si l'adresse mail est saisie et est valide
            if(empty($mail) || filter_var($mail, FILTER_VALIDATE_EMAIL)) {
              // Requête pour vérifier si l'adresse mail existe déjà dans la table abonnement
              $reqmail_abonnement = $bdd->prepare("SELECT * FROM abonne_r_b WHERE mail = ?");
              
              $reqmail = $bdd->prepare("SELECT * FROM surho WHERE mail = ? AND mail != ''");
              $reqmail->execute(array($mail));
              $mailexist = $reqmail->rowCount();

               if($mailexist == 0 OR $mailexist <= 5) {

                  if(!empty($phone)){
                    $reqphone = $bdd->prepare("SELECT * FROM surho WHERE phone = ?");
                    $reqphone->execute(array($phone));
                    $phonexist = $reqphone->rowCount();
                    if($phonexist == 0 OR $phoneexist <= 5){

                $valid_password = true;

                if(strlen($_POST['mdp']) < 7) {
                   $valid_password = false;
                   $erreur = "Le mot de passe doit contenir au moins 7 caractères.";
                }

               
                if($valid_password) {

                  if($mdp == $mdp2) {
                    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
                    $longueurKey = 15;
                    $key = "";
                    for($i=1; $i<$longueurKey; $i++) {
                        $key .= mt_rand(0,9);
                    }
                    $unique_id = uniqid();
                    if($sexe=="homme"){
                        $statut="actif";
                    
                    } else {
                        $statut="active";
                        
                    }
                    
                    $insertmbr = $bdd->prepare("INSERT INTO surho(nom, postnom, prenom, sexe,phone, mail, mot_de_passe, date_naissance, type, role, adresse, date_inscription, statut, profession, attente, avatar, couverture, site, status, last_activity, derniere_activite, confirme, facebook, instagram, twitter, linkedin, unique_id, confirmekey, type_compte, date_creation) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW() )");
                    
                    $insertmbr->execute(array($nom, $postnom, $prenom, $sexe, $phone, $mail,  $mdpHash, $date_naissance, $type, $role, $adresse, $date_inscription, $statut, $profession, $attente, $avatar, $cover, $site, $status, $last_activity, $derniere_activite, 0, $facebook, $instagram, $twitter, $linkedin, $unique_id, $key, $type_compte));
                           
                     $reqmail_abonnement->execute(array($mail));
                     $mailexist_abonnement = $reqmail_abonnement->rowCount();
              
                  if($mailexist_abonnement == 0) {
                      // Insérer l'utilisateur dans la table abonnement
                      $insertabonnement = $bdd->prepare("INSERT INTO abonne_r_b(mail, date_abonnement) VALUES(?, NOW())");
                      $insertabonnement->execute(array($mail));
                  }
                     session_start();
                     $_SESSION['nom'] = $nom; 
                     $_SESSION['prenom'] = $prenom;
                     $_SESSION['mail'] = $mail; 

                     $erreur = "Votre compte a bien été créé !!!";
                  header('location : pre_connexion.php?id='.$userid.'&text=Félicitations! Votre inscription a été effectuée avec succès. Connectez-vous maintenant pour commencer.');
                  exit;
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
          $erreur = "Votre nom ou prenom ne peut pas contenir une insulte";
         }
      } else {
         $erreur = "Votre nom ou prenom doit être compris entre 4 et 255 caractères !";
      }
    }else{
      $erreur = "Désolé ! Vous ne pouvez pas créer un compte professionnel.";
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
    <title>RudLess Business</title>
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
    <div class="container-fluid position-relative bg-white d-flex p-0">
        

     
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-8 col-xl-6">
                    <div class="bg-white rounded p-4 p-sm-5 my-4 mx-3">
                    <div class="d-flex align-items-center bg-warning text-white py-3 justify-content-center mb-3">
                          
                    <h3 style="font-weight:900;color:#fff;">Créer un compte <?=htmlspecialchars($_GET['type_compte']) ?></h3>
                        </div>
                        <form class="row g-3 needs-validation" novalidate method="post">
                          <?php
                            if(isset($erreur)) {
                              echo '<font color="red" class="text-center">'.$erreur."</font>";
                                 }
                          ?>
                            <div class="col-lg-6 col-sm-6 col-md-6 col-6">
                             <label for="nom" class="form-label">Nom</label>
                          
                               <input type="text" placeholder="" class="form-first-name form-control" id="nom" name="nom" value="" required />
                          
                           </div>
                           <div class="col-lg-6 col-sm-6 col-md-6 col-6">
                            <label for="postnom" class="form-label">Postnom</label>
                        
                              <input type="text" class="form-last-name form-control" placeholder="" id="postnom" name="postnom" value="" required />
                             
                          </div>
                           <div class="col-12">
                             <label for="prenom" class="form-label">Prenom</label>
                         
                               <input type="text" class="form-last-name form-control" placeholder="" id="prenom" name="prenom" value="" required />
                              
                           </div>
       
       
                           <div class="col-12">
                         
                             <label for="sexe">Genre</label><br>
                             <select id="sexe" class="form-control" name="sexe" required>
                                <option value="homme">Homme</option>
                                <option value="femme">Femme</option>          
                            </select><br>
                    
                             </div>
                             <div class="col-12">
                             <label for="adresse" class="form-label">Adresse</label>
                         
                               <input type="text" class="form-last-name form-control" placeholder="" id="adresse" name="adresse" value="" required />
                              
                           </div>

                             <div class="col-12">
                                 <label for="phone">Téléphone</label>
                        
                                 <input class="form-control" type="tel" placeholder="" id="phone" maxlength="15" name="phone" value="" required />
                             
                                 </div>
       
                                 <div class="col-lg-6 col-sm-6 col-md-6 col-6">
                             <label for="mail" class="form-label">E-mail</label>
                         
                               <input type="email" class="form-password form-control" placeholder="" id="mail" name="mail" value=""/>
                            
                           </div>
                           <div class="col-lg-6 col-sm-6 col-md-6 col-6">
                             <label for="mail2" class="form-label">Confirmer</label>
                      
                               <input class="form-control" type="email" placeholder="" id="mail2" name="mail2" value="" />
                            
                           </div>
                          
                           <div class="col-lg-6 col-sm-6 col-md-6 col-6">
                             <label for="mdp" class="form-label">Mot de passe</label>
                          
                               <input type="password" class="form-password form-control" placeholder="" id="mdp" title="Le mot de passe doit contenir au moins 7 caractères et une lettre majuscule." name="mdp" value="" required />
                             
                           </div>
                           <div class="col-lg-6 col-sm-6 col-md-6 col-6">
                             <label for="mdp2" class="form-label">Confirmer</label>
                            
                               <input  class="form-repeat-password form-control" type="password" title="Le mot de passe doit contenir au moins 7 caractères et une lettre majuscule." placeholder="" id="mdp2" name="mdp2" value="" required />
                             
                           </div>
                           
                           <div class="col-12">
                             <div class="form-check">
                               <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                               <label class="form-check-label" for="acceptTerms">J'accepte <a href="../direction generale/conditions_rud.php">les 
                                 Conditions et 
                                 <a href="../direction generale/politique_rud.php">Politique 
                            </a> de RudLess.</a></label>
                               <div class="invalid-feedback">Vous devez être d'accord avec nous avant de soumettre votre demande.</div>
                             </div>
                           </div>
                           <div class="col-12">
                             <button class="btn btn-primary w-100" name="valider" type="submit">S'inscrire</button>
                           </div>
                           <div class="col-12 text-center">
                            <p class="small mb-0"><span>Vous avez déjà un compte ?</span>
                             <a href="connexion_rud_bus.php" class="btn btn-warning text-white">Connectez-vous ici</a></p>
                          </div>
                         </form>
                        
                    </div>
                </div>
            </div>
        </div>
       
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
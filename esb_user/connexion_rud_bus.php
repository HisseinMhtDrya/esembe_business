<?php
session_start();
require_once('../connexiondb.php');

if(isset($_POST['valider'])) {
  $identifiant = htmlspecialchars($_POST['identifiant']);
  $mdpconnect = $_POST['motdepasse'];
  if(!empty($identifiant) && !empty($mdpconnect)) {
     $requser = $bdd->prepare("SELECT * FROM surho WHERE (mail = :identifiant OR phone = :identifiant)");
     $requser->execute(array(':identifiant' => $identifiant));
      $userexist = $requser->rowCount();
      if($userexist > 0) {
         $userinfo = $requser->fetch();
         if(password_verify($mdpconnect, $userinfo['mot_de_passe'])) {
           
           $_SESSION['id'] = $userinfo['id'];
           $_SESSION['unique_id'] = $userinfo['unique_id'];
           $_SESSION['business'] = $userinfo['confirmekey'];
           $status = "En ligne";
           $last_activity = time();

           $req = $bdd->prepare("UPDATE surho SET status = :status WHERE id = :id");
           $req->execute(array(':status' => $status, ':id' => $_SESSION['id']));
           
           
           $req = $bdd->prepare("UPDATE surho SET derniere_activite = NOW() WHERE id = :id");
           $req->execute(array(':id' => $_SESSION['id']));

           $req = $bdd->prepare("UPDATE surho SET last_activity = :last_activity WHERE id = :id");
           $req->execute(array(':last_activity' => $last_activity, ':id' => $_SESSION['id']));

           if($userinfo['statut'] == 'actif' || $userinfo['statut'] == 'active') {
                 if($userinfo['type_compte'] == "Professionnel"){
                  header("Location: profil_membre_rud.php?id=".$_SESSION['id'] ."&unique_id=".$userinfo['unique_id']."&confirmekey=".$userinfo['confirmekey']."&text=&text=Bienvenue sur votre profil. Gérez vos informations personnelles et paramètres ici.");
                 }else{
                  header("Location: profil_client.php?id=".$_SESSION['id'] ."&unique_id=".$userinfo['unique_id']."&confirmekey=".$userinfo['confirmekey']."&text=&text=Bienvenue sur votre profil. Gérez vos informations personnelles et paramètres ici.");
                 }
                 
                 
           } elseif($userinfo['statut'] == 'desactive') {
             $erreur = "Ce compte a été temporairement désactivé. Veuillez suivre ce lien pour le réactiver !
             <a href=\"../update_bus/reactiver_compte_bus.php\"><br>Réactiver mon compte</a>";
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
        
        <!-- Sign début -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            
                            <h3 class="text-center">Connexion</h3>
                        </div>
                        <form action="" method="post">
                            <?php
                              if(isset($erreur)){
                            ?>
                            <div class="text-center text-danger">
                                <?=$erreur ?>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-12">
                                    <input type="text" name="identifiant" class="form-control" id="identifiant" required placeholder="Mail ou téléphone">
                                </div>
                                <div class="col-12 mt-2">
                                    <input type="password" name="motdepasse" class="form-control" id="motdepasse" required placeholder="Mot de passe">
                                </div>
                            </div>
                            <div class="text-center mb-2 mt-3">                         
                                <a href="">Mot de passe oublié ?</a>
                            </div>
                            <button type="submit" name="valider" class="btn btn-primary py-3 w-100 mb-4">Se connecter</button>
                       </form>
                        <p class="text-center mb-0">Nouveau ici ? <a href="creation_compte_rud_bus.php?type_compte=Standard" class="btn btn-success">Créer un compte</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign fin -->
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
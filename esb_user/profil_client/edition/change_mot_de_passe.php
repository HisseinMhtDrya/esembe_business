<?php
session_start();
if(!isset($_SESSION['id'])){
   header("location: ../");
 }
 require_once('../../../connexiondb.php');

if(isset($_SESSION['id'])) {
  $requser = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();

  if(isset($_POST['forminscription'])) {
   $mdp = $_POST['mdp'];  
   $mdp1 = $_POST['newmdp1'];
     $mdp2 = $_POST['newmdp2'];

     if(isset($_POST['mdp']) AND !empty($_POST['mdp']) AND isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
        if(password_verify($mdp, $user['motdepasse'])){
   
      
   
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


             if($mdp <> $mdp1){

                    $insertmdp = $bdd->prepare("UPDATE membre_esembe SET motdepasse = ? WHERE id = ?");
                    $insertmdp->execute(array(password_hash($mdp1, PASSWORD_DEFAULT), $_SESSION['id']));
                    $_SESSION['message'] = "Votre mot de passe a été mis à jour avec succès !";


                    // Ajout de la requete d'insertion dans la table activite
                $insertactivite = $bdd->prepare('INSERT INTO activite (id_user, activite, date_activite) VALUES(?, ?, ?)');
                $insertactivite->execute(array($_SESSION['id'], 'Vous avez modifié votre mot de passe', date('Y-m-d H:i:s')));
                header('Location: ../mon_profil?id='.$_SESSION['id']);
                $_SESSION['message'] = "Mot de passe mis à jour avec succès !";
             }else{
               $erreur = "Le mot de passe actule doit être différent du nouveau !";
             }
           }
         }else{
           $erreur = "Vos mots de passse ne sont pas identiques !";
         }
       
   }else{
   $erreur = "Mot de passe actuel incorrect !";
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
 <meta content="width=device-width, initial-scale=1.0" name="viewport">

 <title>Esembe Business</title>
 <meta content="" name="description">
 <meta content="" name="keywords">

 <link href="img/logorudless.jpeg" rel="icon">
 <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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

</head>

<body>

 <main>
   <div class="container">

     <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-lg-10 col-md-8 d-flex flex-column align-items-center justify-content-center">

             <div class="card mb-3">

               <div class="card-body">

                 <div class="pt-4 pb-2">
                   <h5 class="card-title text-center pb-0 fs-4">Modifier mon mot de passe</h5>
                   <p class="text-center small">Veuillez vos informatins</p>
                 </div>
                 <?php
                 if(isset($erreur)) {
                    echo '<font color="red">'.$erreur."</font>";
                 }
                 ?>
                 <form class="row g-3 needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                   <div class="col-12">
                     <label for="mdp" class="form-label">Mot de passe actuel</label>
                     <div class="input-group has-validation">
                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                     <input type="password" name="mdp" class="form-control" id="mdp" required>
                     <div class="invalid-feedback">Veuillez saisir votre mot de passe actuel.</div>
                     </div>
                   </div>

                   <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                     <label for="newmdp1" class="form-label">Nouveau mot de passe</label>
                     <div class="input-group has-validation">
                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                     <input type="password" name="newmdp1" class="form-control" id="newmdp1" required>
                     <div class="invalid-feedback">Veuillez saisir votre nouveau mot de passe.</div>
                     </div>
                   </div>

                   <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                     <label for="newmdp2" class="form-label">Confirmer</label>
                     <div class="input-group has-validation">
                       <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-lock"></i></span>
                       <input type="password" name="newmdp2" class="form-control" id="newmdp2" required>
                       <div class="invalid-feedback">Veuillez confirmer votre nouveau mot de passe.</div>
                     </div>
                   </div>

                   <div class="col-12">
                     <input type="submit" name="forminscription" value="Mettre à jour mot mot de passe" class="btn btn-primary w-100">
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
<?php   
}
else {
  header("Location: ../../connexion/login/connexion_second.php");
}
?>
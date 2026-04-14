<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../");
    exit();
}
require_once('../connexiondb.php');


if(isset($_POST['forminscription'])) {
   $nom = htmlspecialchars($_POST['nom']);
   $postnom = htmlspecialchars($_POST['postnom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $type = htmlspecialchars($_POST['type']);
   $confirme = 0;

 
   if(!empty($_POST['nom']) AND !empty($_POST['postnom']) AND !empty($_POST['prenom'])) {
    
    $req_membre = $bdd->prepare("SELECT * FROM membre_effectif WHERE nom = ? AND postnom = ? AND prenom = ?");
    $req_membre->execute(array($nom, $postnom, $prenom));
    
    $membre_exist = $req_membre->rowCount();
    if($membre_exist == 0){
     
      $nomlength = strlen($nom);
      $prenomlength = strlen($prenom);
     
      if($nomlength >= 4 AND $nomlength <=255 AND $prenomlength >=4 AND $prenomlength <=255) {

       
          $nom = ucfirst(strtolower($nom));
          $prenom = ucfirst(strtolower($prenom));
          
                    
                     $insertmbr = $bdd->prepare("INSERT INTO membre_effectif(nom, postnom, prenom, type) VALUES(?, ?, ?, ?)");
                    
                    $insertmbr->execute(array($nom, $postnom, $prenom, $type));
                      
                     $erreur = "Membre ajouté avec succès !!!";
                 
                  
          }else{
            $erreur = "Le nom ou prenom doit contenir au moins 4 caractères !";
          }
        }else{
          $erreur = "Ce membre existe déjà !";
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
  <link href="img/logorudless.jpeg" rel="apple-touch-icon">

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
<nav class="navbar navbar-light bg-light fixed-top">
  <a href="https://www.esembe-business.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >Esembe</a>
<div class="text-center">
<a href="bureau_admin" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i></a>
</div>
</nav>

  
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Ajouter des membres effectifs</h5>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                      echo '<font color="red">'.$erreur."</font>";
                      }
                     ?>
                 <div class="col-6">
                      <label for="yourName" class="form-label">Nom</label>
              
                        <input type="text" placeholder="" class="form-first-name form-control" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" required />
                      <div class="invalid-feedback">Veuillez saisir votre nom</div>
                     
                    </div>

                    <div class="col-6">
                      <label for="yourUsername" class="form-label">Postnom</label>
                  
                        <input type="text" class="form-last-name form-control" placeholder="" id="postnom" name="postnom" value="<?php if(isset($postnom)) { echo $postnom; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir votre prenom.</div>
                  
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Prenom</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-last-name form-control" placeholder="" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir votre prenom.</div>
                      </div>
                    </div>

                    <div class="col-12">
                  
                      <label for="type">Type</label><br>
                      <select id="fonction" class="form-control"  name="type" required>
                          <option class="form-control text-primary" value="" disabled selected>Sélectionner une fonction</option>
                          <option class="form-control" value="Assistance client">Assistance client</option>
                          <option class="form-control" value="Administrateur">Administrateur</option>
                          <option class="form-control" value="Chargé de cours">Administratrice</option>
                          <option class="form-control" value="Super Administrateur">Super Administrateur</option> 
                          <option class="form-control" value="Super Administratrice">Super Administratrice</option>                      
                      </select>
                 
                   <div class="invalid-feedback">Veuillez choisir le type !</div>
                      </div>
                     
                      <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <input type="reset" value="Annuler" class="btn btn-danger">
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <button class="btn btn-primary" name="forminscription" type="submit">Ajouter</button>
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

  <script src="assets/js/main.js"></script>


  <script>
  function redirigerVersLeBas() {
  window.scrollTo(0,document.body.scrollHeight);
}

// Appel de la fonction au chargement de la page
window.onload = redirigerVersLeBas;
</script>
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
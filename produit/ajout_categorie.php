<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: ../');
  exit;
}
require_once('../connexiondb.php');
function NettoyerDonnee($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!empty($_POST['categorie']) && !empty($_POST['description'])){
        $categorie = NettoyerDonnee($_POST['categorie']);
        $verif_categorie = $bdd->prepare("SELECT * FROM categorie WHERE titre = :titre");
        $verif_categorie->execute(array(':titre' => $categorie));
        if($verif_categorie->rowCount() == 0){
          $description = NettoyerDonnee($_POST['description']);
          $insert_categorie = $bdd->prepare("INSERT INTO categorie(titre, description, date_ajout) VALUEs(?, ?, NOW())");
          $insert_categorie->execute(array($categorie, $description));
          $erreur = "Catégorie ajoutée avec succès";
        }else{
          $erreur = "Catégorie déjà existante";
        }
    }else{
        $erreur = "Veuillez compléter toutes les informations";
    }
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
<nav class="navbar navbar-light bg-light fixed-top">
  <a href="https://www.esembe.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >esembe</a>
<div class="text-center">
  <a href="../esb_user/profil_esb" class="btn btn-primary"><i class="bi bi-arrow-right"></i></a>
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
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Ajouter des catégories pour votre boutique</h5>
                  </div>

                  <form class="row g-3 needs-validation" enctype="multipart/form-data" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                      echo '<font color="red">'.$erreur."</font>";
                      }
                     ?>
                    <div class="col-lg-12">
                      <label for="categorie" class="form-label">Titre catégorie</label>

                        <input type="text" placeholder="" class="form-first-name form-control" id="categorie" name="categorie" value="<?php if(isset($categorie)) { echo $categorie; } ?>" required />
                      <div class="invalid-feedback">Veuillez saisir le titre de la catégorie</div>
                
                    </div>
                    <br><br>
                    <div class="col-12">
                      <label for="description">Description</label>
                      <textarea style="height: 50px;" class="form-control" placeholder="Description..." name="description" id="description" rows="4" cols="50" required></textarea>
                    </div>
                    <br><br>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <input type="reset" class="btn btn-danger" value="Annuler">
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <input class="btn btn-primary w-100" name="valider" type="submit" value="Ajouter" >
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
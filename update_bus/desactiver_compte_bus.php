<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: ../');
  exit;
}
require_once('../connexiondb.php');
if(isset($_POST['valider'])){
  if(!empty($_POST['identifiant']) && !empty($_POST['mdp'])){
    $identifiant = htmlspecialchars($_POST['identifiant']);
    $mdp = $_POST['mdp'];
    $req_user = $bdd->prepare("SELECT * FROM membre_esembe WHERE (mail = :identifiant OR phone =:identifiant) AND id = :id ");
    $req_user->execute(array(':identifiant' => $identifiant, ':id' => $_SESSION['id']));
    if($req_user->rowCount() > 0){
      $userinfo = $req_user->fetch();
      $_SESSION['nom'] = $userinfo['nom'];
      $_SESSION['prenom'] = $userinfo['prenom'];
      $statut = "desactive";
      $update_surho = $bdd->prepare("UPDATE membre_esembe SET statut = ? WHERE id = ?");
      $update_surho->execute(array($statut, $_SESSION['id']));
      header('location:console_desactivation_compte.php');
    }else{
      $erreur = "Informations incorrectes.";
    }
  }else{
    $erreur = "Vous devez compéter tous les champs";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Esembe Business</title>
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

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-8 d-flex flex-column align-items-center justify-content-center">

          
              </div>

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight:900;">Désactivation Compte</h5>
                    <p class="text-center small">Veuillez fournir quelques informations pour désactiver votre compte</p>
                  </div>
                  <?php if (isset($erreur)) : ?>
                      <p style="color:red;"><?php echo $erreur; ?></p>
                  <?php endif; ?>

                  <form method="post" action="" class="registration-form row g-3 needs-validation" novalidate>
                  <div class="row">
                
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
                      <label for="identifiant">Identifiant</label>
                      <input type="email" class="form-control" name="identifiant" placeholder="Mail ou mobile..." id="identifiant" required>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
                      <label for="mot_de_passe">Mot de passe </label>
                      <input type="password" class="form-control" name="mdp" id="mot_de_passe" required><br>
                      </div>
                      <div class="col-12">
                      <input type="submit" name="valider" class="btn btn-primary w-100" value="Désactiver mon compte">
                      </div>
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
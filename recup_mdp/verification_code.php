<?php
session_start();
require_once('../connexiondb.php');
if(!isset($_SESSION['mail'])) {
  header('Location: ../'); 
  exit;
}

$email = $_SESSION['mail'];
if(isset($_POST['valider']) AND isset($_POST['code']) AND !empty($_POST['code'])) {
  $code = $_POST['code'];


        $query = $bdd->prepare("SELECT * FROM recup_mdp WHERE (mail = :email AND code = :code)");
        $query->bindParam(':email', $email);
        $query->bindParam(':code', $code);
        $query->execute();
        if($query->rowCount() > 0){
        
          $_SESSION['mail'] = $email; 
          
          
          $req_del = $bdd->prepare("DELETE FROM recup_mdp WHERE (mail = :email AND code = :code)");
          $req_del->bindParam(':email', $email);
          $req_del->bindParam(':code', $code);
          header("Location: reinitialiser_mot_de_passe?mail=" . $email);
        }else{
            $erreur = "Code incorrect .";
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
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight:900;">Récupération du compte</h5>
                  </div>
                    <form method="POST" action="">
                     <?php
                        if(isset($erreur)){
                      ?>
                         <div class="bg-danger text-white py-2 text-center mb-2">
                          <?=$erreur ?>
                         </div>
                      <?php
                        }                                              
                      ?>	       
                    <label for="code" class="text-center">Veuillez saisir le code de confirmation reçu par adresse e-mail</label>                
                        <input type="text" id="code" class="form-control" name="code" required>
                        <br>
                        <input type="submit" class="btn btn-primary w-100" name="valider" value="Valider">
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
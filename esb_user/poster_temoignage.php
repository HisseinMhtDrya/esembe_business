<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: ../');
  exit;
}
require_once('../connexiondb.php');

if(isset($_POST['valider'])){
    if(!empty($_POST['message'])){
        $message = htmlspecialchars($_POST['message']);
        $insert_temoignage = $bdd->prepare("INSERT INTO temoignage_client(id_user, message, date_post) VALUES(?, ?, NOW() )");
        $insert_temoignage->execute(array($_SESSION['id'], $message));
        $erreur = "Témoignage posté avec succès. Merci beaucoup !";
    }else{
        $erreur = "Veuillez taper un message";
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
<nav class="navbar navbar-light bg-light fixed-top">
  <a href="https://www.esembe.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >Esembe</a>
<div class="text-center">
  <a href="profil_esb" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i></a>
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
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Ajouter un témoignage</h5>
                  </div>

                  <form class="row g-3 needs-validation" enctype="multipart/form-data" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                        ?>
                      <div class="text-center bg-danger text-white py-2">
                        <?=$erreur ?>
                      </div>
                      <?php
                      }
                     ?>
                    <br><br>
                    <div class="col-12">

                    <label for="message">Message</label>
                    <textarea style="height: 50px;" class="form-control" placeholder="Message..." name="message" id="message" rows="4" cols="50" required></textarea>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                     <input type="reset" class="btn btn-danger" value="Effacer">
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
  </main><!-- End #main -->
  <script type="text/javascript">
function readFile() {
    var reader = new FileReader();
    var file = document.getElementById('demo').files[0];
    reader.onload = function(e) {
        document.getElementById('result').href = e.target.result;
    }
    document.getElementById('result').textContent = file.name;
    reader.readAsDataURL(file);
}

</script>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
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
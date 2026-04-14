<?php
session_start();

  if(!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
    header('Location: ../');
    exit;
  }

  $nom = $_SESSION['nom'];
  $prenom = $_SESSION['prenom'];

  if(isset($_GET['id'])){
    $getid = intval($_GET['id']);
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

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">  
   
 
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
    <!-- Template Stylesheet -->
    <link href="css/style_membre.css" rel="stylesheet">

</head>
<body>

 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center" style="margin-bottom:10px;">

<div class="d-flex align-items-center justify-content-between">
  <a href="../direction generale/accueil.php" class="logo d-flex align-items-center">
   
    <span class="">RudLess</span>
  </a>
 
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">
                    <?php echo $prenom; ?> <?php echo $nom; ?>, </h5>
                     <p class="text-center small">Vos informations ont été enregistrées avec succès.</p>
                    <p class="text-center small">Merci infiniment d'avoir choisi de vous inscrire sur notre Plateforme. Nous sommes honorés de vous accueillir parmi nous.
                  </p>
                  <p class="text-center small">Sans plus tarder, veuillez passer en action et profiter de votre temps sur <a href="https://www.rudless.com" class="">RudLess</a>.
                  </p>
                  <p>
                    
                       <a href="connexion_rud_bus.php" class="btn btn-primary w-100">Continuer</a>
                    
                  </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

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
<?php
session_start();

if(!isset($_SESSION['nom']) || !isset($_SESSION['mail'])) {
  header('Location: login/connexionSurho.php'); // Si les informations de session ne sont pas disponibles, rediriger vers la page de connexion
  exit;
}

$nom = $_SESSION['nom'];
$mail = $_SESSION['mail'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RudLess</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/logorudless.jpeg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">


              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Cher(e) <?php echo $nom; ?>,</h5>
                    <p class="text-center small">
Nous tenions à prendre quelques instants pour vous remercier de votre temps et de votre engagement sur notre Plateforme. Nous sommes conscients que la
décision de supprimer votre compte n'a pas été facile, et nous sommes désolés de vous voir partir.
                    </p>
<p class="text-center small">
Nous apprécions votre confiance en notre site, et nous espérons que votre expérience a été positive et enrichissante. Nous sommes désolés si 
nous avons pu vous décevoir dans certains aspects, et nous prenons vos commentaires très au sérieux pour améliorer nos services.
</p>
<p class="text-center small">
</p>
<p class="text-center small">
Nous souhaitons vous remercier pour votre contribution à notre communauté et pour avoir partagé vos idées avec nous. Nous espérons que vous garderez de
bons souvenirs de votre passage sur notre site web, et nous vous souhaitons le meilleur pour vos projets futurs.
</p>
<p class="text-center small text-info">
Nous serions ravis de vous accueillir à nouveau sur notre Plateforme si vous changez d'avis à l'avenir. En attendant, nous vous souhaitons une excellente continuation.

</p>
<p class="text-center small">
L'équipe Admin.
                    </p>
                  </div>

               
                    <div class="col-12">
                    <a href="../direction generale/accueil.php" class="btn btn-primary w-100">Quitter cette page</a>
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
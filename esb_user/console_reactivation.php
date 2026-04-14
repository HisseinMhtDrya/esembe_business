<?php
session_start();

if(!isset($_SESSION['nom']) || !isset($_SESSION['prenom']) || !isset($_SESSION['mail'])) {
  header('Location: LOGIN/connexionSurho.php'); // Si les informations de session ne sont pas disponibles, rediriger vers la page de connexion
  exit;
}

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
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
            <div class="col-lg-10 col-md-6 d-flex flex-column align-items-center justify-content-center">


              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4"><?php echo $prenom; ?> <?php echo $nom; ?>,</h5>
                    <p class="text-center small">
Nous tenons à vous exprimer notre sincère gratitude pour avoir réactivé votre compte sur notre site web. Votre retour parmi nous nous ravit énormément !
                    </p>
                    <p class="text-center small">
Vos décisions en tant qu'utilisateur peuvent grandement influencer la dynamique et le développement de notre communauté en ligne. Nous sommes honorés de constater que vous avez choisi de donner une nouvelle chance à notre plateforme.
                    </p>
                    <p class="text-center small">
Votre réactivation témoigne de votre confiance continue envers notre site web, et nous en sommes profondément reconnaissants. Nous nous engageons à vous offrir une expérience exceptionnelle, riche en contenu de qualité et en interactions enrichissantes.
                    </p>
                    <p class="text-center small">
Nous tenons également à vous rappeler que votre participation active et constructive est précieuse. Votre retour d'expérience, vos contributions et votre implication contribuent à rendre notre communauté encore plus vivante et stimulante.
                    </p>
                    <p class="text-center small">
Nous souhaitons faire de votre expérience sur notre site web une véritable réussite. N'hésitez pas à nous contacter pour toute demande d'assistance ou si vous avez des suggestions d'amélioration. Nous serons ravis de vous accompagner tout au long de votre parcours en ligne.
                    </p>
                    <p class="text-center small">
Encore une fois, nous vous remercions chaleureusement pour avoir réactivé votre compte et pour votre confiance renouvelée. Nous sommes impatients de vous compter parmi nos membres actifs et de partager de merveilleux moments en ligne ensemble.
                    </p>
<p class="text-center small">
Bien cordialement, <br>
L'équipe Admin.
                    </p>
                  </div>

                    <div class="col-12">
                    <a href="LOGIN/connexionSurho.php"  class="btn btn-primary w-100">Me connecter</a>
                  </div>
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

</body>

</html>
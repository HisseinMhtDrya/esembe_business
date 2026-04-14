<?php
session_start();

if(!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
  header('Location: ../../'); 
  exit;
}

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];

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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">


              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Cher(e) <?php echo $prenom; ?> <?php echo $nom; ?>,</h5>
                    <p class="text-center small">
Nous tenions à prendre quelques instants pour vous remercier de votre temps et de votre engagement sur notre Plateforme. 
                    </p>
                    <p class="text-center small">
Nous sommes conscients que la décision de désactiver votre compte n'a pas été facile, et nous sommes désolés de vous voir partir pour un temps.
<p class="text-center small">
Nous apprécions votre confiance en notre site, et nous espérons que votre expérience a été positive et enrichissante.
 Nous sommes désolés si nous avons pu vous décevoir dans certains aspects, et nous prenons vos commentaires très au sérieux pour 
 améliorer nos services.
</p>
<p class="text-center small">
</p>
<p class="text-center small">
Nous souhaitons vous remercier pour votre contribution à notre communauté et pour avoir partagé vos idées avec nous. 
Nous espérons que vous garderez de bons souvenirs de votre passage sur notre site web, et nous vous souhaitons le meilleur pour
 vos projets futurs.
</p>
<p class="text-center small text-info">
Nous serions ravis de vous accueillir à nouveau sur notre Plateforme si vous changez d'avis à l'avenir. En attendant, nous vous 
souhaitons une excellente continuation.

</p>
<p class="text-center small">
L'équipe Admin.
                    </p>
                  </div>

                    <div class="col-12">
                      <a href="../../index.php" class="btn btn-primary w-100">Quitter cette page</a>
                    </div>
                   
                </div>
              </div>

              

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

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
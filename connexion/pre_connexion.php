<?php
session_start();
require_once('../connexiondb.php');

$recup_info_user = $bdd->prepare("SELECT * FROM membre_esembe WHERE mail = :mail");
$recup_info_user->execute(array(':mail' => $_SESSION['mail']));
if($recup_info_user->rowCount() == 1){
  $userinfo = $recup_info_user->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
   
    <title>Esembe Buzz</title>
    <link href="../img/logo_esembe.jpg" rel="icon">
    <link href="../img/logo_esembe.jpg" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />

    <link href="css/style_membre.css" rel="stylesheet">
    <style>
    .btnPreLogin{
      background:#ff00ff;
      color:#fff;
      padding:8px;
      border-radius:10px;
      width: 100%;
    }
   </style>
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
                    <h5 class="card-title text-center pb-0 fs-4">
                    <?php echo $userinfo['prenom']; ?> <?php echo $userinfo['nom']; ?>, </h5>
                     <p class="text-center small">Votre compte a bien été confirmé. Vous avez désormais droit à tout.</p>
                    <p class="text-center small">Merci infiniment pour la confiance.</p>
                  <p class="text-center small">Sans plus tarder, veuillez passer en action et profiter de votre temps ici.</a>
                  </p>
                  <p class="text-center">
                    <a href="login/connexion_esembe" class="btnPreLogin w-100">Me connecter</a>
                  </p>
                  </div>
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
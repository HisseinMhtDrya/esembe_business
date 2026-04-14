<?php
session_start();
require_once('../connexiondb.php');
if(!isset($_SESSION['id'])){
  header('location:../connexion/login/connexion_taza');
}
$id_user = $_SESSION['id'];
$statut =  "desactive";
$recup_info_user = $bdd->prepare("SELECT * FROM membre_tz WHERE id = :id AND statut = :statut");
$recup_info_user->execute(array(':id' => $id_user, ':statut' => $statut));
if($recup_info_user->rowCount() == 0){
  header('location:../connexion/login/connexion_taza');
}
$userinfo = $recup_info_user->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TaZa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="logorudless.jpeg" rel="icon">
  <link href="logorudless.jpeg" rel="apple-touch-icon">

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
  <style>
    .btnPreLogin{
      background:#ff00ff;
      color:#fff;
      padding:8px;
      border-radius:10px;
      width: 100%;
    }
    ul{
      list-style: none;
    }
    ul li{
      font-weight:bold;
      margin-bottom:8px;
      color:#ff00ff;
    }
    ul li a{
      text-decoration:none;
      font-weight:bold;
    }
    ul li i{
      background:#ff00ff;
      padding:5px;
      border-radius:50px;
      color:#fff;
      justify-content:space-between;
    }

    .btnConfirme, .btnContinue{
      padding:10px;
      margin-right:5px;
      border-radius:5px;
      font-weight:600;
    }
    .btnConfirme:hover{
      color:#fff;
    }
    .btnContinue:hover{
      color:#fff;
      background:#000;
      transition:1s;
      border:2px solid #000;
    }
    .btnConfirme{
      background:#ff00ff;
      color:#fff;
    }
    .btnContinue{
      background:#fff;
      border:2px solid #ff00ff;
      color:#ff00ff;
    }
   </style>

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

            

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2 py-2 mb-2" style="background:#ff00ff;">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 900;color:#fff;" >TaZa</h5>
                  </div>
                  <p class="text-center small">
                    <span style="color:#ff00ff;font-weight:bold;"><?=$userinfo['prenom'] ?> <?=$userinfo['nom'] ?></span>, vous avez épuisé vos heures d'essai.
                  </p>
                  <p class="text-center">
                    Nous vous recommandons vivement de confirmer votre compte pour une meilleure expérience remplie d'opportunités infinies.
                    Pour ce, vous devez payer le frais d'abonnement fixé à <span style="color:#ff00ff;font-weight:bolder;">5$</span>. 
                    Vous pouvez le faire en envoyant votre argent à l'un des numéros suivants :
                    <ul>
                      <li><i class="bi bi-check"></i> M-Pesa : <a href="tel:243822251435">+243822251435</a></li>
                      <li><i class="bi bi-check"></i> Orange Money : <a href="tel:243892251435">+243892251435</a></li>
                      <li><i class="bi bi-check"></i> Airtel Money : <a href="tel:243922251435">+243922251435</a></li>
                    </ul> 
                  </p>

                 
                    <div class="col-12">
                    <p class="text-center d-flex justify-content-center align-items-center">
                    <a href="confirmation_compte" class="btnConfirme w-100">Confirmer mon compte</a> <a href="../index" class="btnContinue w-100">Confirmer après</a>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
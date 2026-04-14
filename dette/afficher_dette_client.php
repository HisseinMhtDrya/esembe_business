<?php
session_start();

require_once('../connexiondb.php');

if(!isset($_SESSION['id_client_dette'])){
  header('location:../');
}

$id_dette = htmlspecialchars(intval($_SESSION['id_client_dette']));

$recup_info_dette = $bdd->prepare("SELECT * FROM dette_client WHERE id = ?");
$recup_info_dette->execute(array($id_dette));

$info_dette = $recup_info_dette->fetch();
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Esembe Buzz</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="../img/logo_esembe.jpg" rel="icon">
  <link href="../img/logo_esembe.jpg" rel="apple-touch-icon">

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

</head>

<body>
<nav class="navbar navbar-light bg-light fixed-top">
  <a href="https://www.esembe-buzz.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >Esembe</a>
<div class="text-center">
<a href="../" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i></a>
</div>
</nav>

  
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
                <div class="section-header bg-primary">
                   
                   <h2 class="text-center pb-0 fs-4" style="font-weight:900;"><a href="https://esemebe-buzz.com" class="text-white" style="font-weight:900;">Esembe Business</a></h2>
                   <h3 class="text-center text-warning pb-0 fs-4" style="font-weight:900;">Dette de <?=$info_dette['prenom'] ?> <?=$info_dette['nom'] ?></h3>
                 
                 </div> 
               <div class="col-lg-7 col-md-10 d-flex flex-column align-items-center justify-content-center mt-5">
                   
                     <table class="table text-start align-middle table-bordered table-hover mb-0">
                     
                        <tbody>
                          <tr>
                            <td>Id</td>
                            <td><?=$info_dette['id'] ?></td>
                          </tr>
                          <tr>
                            <td>Nom</td>
                            <td><?=$info_dette['nom'] ?></td>
                          </tr>
                          <tr>
                            <td>Prenom</td>
                            <td><?=$info_dette['prenom'] ?></td>
                          </tr>
                          <tr>
                            <td>Sexe</td>
                            <td><?=$info_dette['sexe'] ?> </td>
                          </tr>
                          <tr>
                            <td>Téléphone</td>
                            <td><a href="<?=$info_dette['telephone'] ?>"><?=$info_dette['telephone'] ?></a></td>
                          </tr>
                          <tr>
                            <td>Adresse</td>
                            <td><?=$info_dette['adresse'] ?></td>
                          </tr>
                           <tr>
                            <td>Produit emprunté</td>
                            <td><?=$info_dette['produit_emprunte'] ?></td>
                          </tr>
                          <tr>
                            <td>Montant</td>
                            <td><?=$info_dette['montant_emprunt'] ?>Fc</td>
                          </tr>
                          <tr>
                            <td>Statut</td>
                            <td><?=$info_dette['statut'] ?></td>
                          </tr>
                          <tr>
                            <td>Code</td>
                            <td><?=$info_dette['code'] ?></td>
                          </tr>
                          <tr>
                            <td>Date emprunt</td>
                            <td><?=$info_dette['date_emprunt'] ?></td>
                          </tr>
                        </tbody>
                      </table>
            
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
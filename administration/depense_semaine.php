<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../");
    exit();
}
require_once('../connexiondb.php');
$requser = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = :id");
$requser->execute(array(':id' => $_SESSION['id']));
$userinfo = $requser->fetch();

if(isset($_GET['id_vente'], $_GET['action']) && $_GET['id_vente'] > 0 && $_GET['action'] == "supprimer"){
    $id_vente = htmlspecialchars(intval($_GET['id_vente']));
    $delete_vente = $bdd->prepare("DELETE FROM vente WHERE id = ?");
    $delete_vente->execute(array($id_vente));
}


$depense = $bdd->prepare('SELECT * FROM depense WHERE YEARWEEK(date_depense) = YEARWEEK(NOW()) ORDER BY id DESC');
$depense->execute();

$recup_depense_total_semaine = $bdd->prepare("SELECT sum(montant_depense) as montant_depense_semaine FROM depense WHERE YEARWEEK(date_depense) = YEARWEEK(NOW()) ");
$recup_depense_total_semaine->execute();
$montant_depense_semaine = $recup_depense_total_semaine->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Esembe Business</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="img/logorudless.jpeg" rel="icon">
  <link href="img/logorudless.jpeg" rel="apple-touch-icon">

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
  <a href="https://www.esembe-business.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >Esembe</a>
<div class="text-center">
<a href="bureau_admin" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i></a>
</div>
</nav>

  
  <main>
    <div class="container mt-5">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
           <div class="col-lg-12 col-md-12 align-items-center justify-content-center">
           <div class="bg-white rounded h-100 p-4 table-responsive">
                            <h6 class="mb-4">Dépense de la semaine : <?=$montant_depense_semaine['montant_depense_semaine'] ?>Fc</h6>
                            <?php if($depense->rowCount() > 0) { ?>
                            <table class="table table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Produit</th>
                                        <th scope="col">Motif</th>
                                        <th scope="col">Montant total</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                <?php while($d = $depense->fetch()) { 
                                ?>
                                 <tr>
                                    <td><?= $d['id'] ?></td>
                                    <td><?= $d['produit_concerne'] ?></td>
                                    <td><?= $d['motif_depense'] ?></td>
                                    <td><?= $d['montant_depense'] ?> Fc</td> 
                                </tr>
                                <?php
                                 } 
                                ?>
                                </tbody>
                            </table>
                            <?php 
                            } else { 
                            ?>
                                <p>Aucune dépense trouvée</p>
                            <?php
                              } 
                            ?>
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
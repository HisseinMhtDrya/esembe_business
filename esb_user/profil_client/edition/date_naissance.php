<?php
session_start();
if (!isset($_SESSION['id'])) {
   header("Location: ../../connexion_rud_bus.php");
}
require_once('../../../connexiondb.php');
 
if(isset($_POST['forminscription'])) {
   $jour = $_POST['jour'];
   $mois = $_POST['mois'];
   $annee = $_POST['annee'];
   if(!empty($_POST['mois']) AND !empty($_POST['jour']) AND !empty($_POST['annee'])) {
     if (checkdate($mois, $jour, $annee)) {
      $date_naissance = $_POST['annee'] . "-" . $_POST['mois'] . "-" . $_POST['jour'];
      $user_id = $_SESSION['id'];
       $req = $bdd->prepare("UPDATE surho SET date_naissance = ? WHERE id = ?");
       $req->execute(array($date_naissance, $user_id));
       $_SESSION['message'] = "Votre date de naissance a été mise à jour avec succès !";
       // Ajout de la requete d'insertion dans la table activite
   $insertactivite = $bdd->prepare('INSERT INTO activite (id_user, activite, date_activite) VALUES(?, ?, ?)');
   $insertactivite->execute(array($_SESSION['id'], 'Vous avez modifié votre date de naissance', date('Y-m-d H:i:s')));
   header('Location: ../mon_profil.php?id='.$_SESSION['id']);

  }else{
    $erreur = "Date de naissance non valide !";
  }
 }else{
    $erreur= "Veuillez compléter tous les champs !";
 }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MSI</title>
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

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Mise à jour de la date de naissance</h5>
                    <p class="text-center small">Merci de renseigner tous les champs</p>
                  </div>

                  <?php
         if(isset($erreur))
         {
            echo '<p class="text-center" style="color:red;">'.$erreur."</p>";
         }
         ?>		
                  <form role="form" method="POST" action="" class="registration-form row g-3 needs-validation" novalidate>
                 
                    <label for="jour">Date de naissance :</label><br>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xl-4 col-4">
<select class="form-control" name="jour" id="jour" required>
<option value="">Jour</option>
<?php
for ($i=1; $i<=31; $i++) {
  echo "<option value=\"$i\">$i</option>";
}
?>
</select>
<div class="invalid-feedback">Veuillez indiquer le jour de votre naissance !</div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xl-4 col-4">
<select class="form-control" name="mois" id="mois" required>
<option value="">Mois</option>
<option value="01">Janvier</option>
<option value="02">Février</option>
<option value="03">Mars</option>
<option value="04">Avril</option>
<option value="05">Mai</option>
<option value="06">Juin</option>
<option value="07">Juillet</option>
<option value="08">Août</option>
<option value="09">Septembre</option>
<option value="10">Octobre</option>
<option value="11">Novembre</option>
<option value="12">Décembre</option>
</select>
<div class="invalid-feedback">Veuillez indiquer le mois de votre naissance !</div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xl-4 col-4">
<select class="form-control" name="annee" id="annee" required>
<option value="">Année</option>
<?php
$current_year = date('Y');
for ($i=$current_year; $i>=1940; $i--) {
  echo "<option value=\"$i\">$i</option>";
}
?>
</select>
<div class="invalid-feedback">Veuillez indiquer l'année de votre naissance !</div>
                      </div>
                      </div>
            
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="forminscription" type="submit">Mettre à jour</button>
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

</body>

</html>
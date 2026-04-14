<?php
require_once('../connexiondb.php');

if(isset($_POST['valider'])){
  $id_user = intval($_POST['id_user']);
  
  $req_user = $bdd->prepare('SELECT * FROM membre_esembe WHERE id = :id');
  $req_user->execute(array(':id' =>$id_user));
  if($req_user->rowCount() >0 ) {
    $row = $req_user->fetch();
    $genre = $row['sexe'];
    
    // Vérification du genre de l'utilisateur
    if($genre == 'femme') {
        $type = 'Administratrice';
    } else {
        $type = 'Administrateur';
    }

    $update_user = $bdd->prepare("UPDATE membre_esembe SET type = ? WHERE id = ?");
    $update_user->execute(array($type, $id_user));

    $erreur = "L'administrateur a été mis à jour avec succès.";
    header("Location: bureau_admin");
        exit;
  }else{
    $erreur =  "Erreur : l'utilisateur n'existe pas.";
  }

}
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
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
 
  <link href="assets/css1/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight:900;">Création administrateur</h5>
                    <p class="text-center small">Veuillez déclinper fournir quelques informations pour suspendre l'administrateur</p>
                  </div>
                  <form role="form" method="POST" action="" class="registration-form row g-3 needs-validation" novalidate>
                  <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?> 
                        <div class="col-12">
                        
                        
                        <label for="form-first-name">Identifiant</label>
                          <input type="text" name="id_user" placeholder="Id..." class="form-first-name form-control" id="form-first-name">
                          <div class="invalid-feedback">Veuillez saisir votre nom !</div>
                        </div>
                        
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="valider" type="submit">Créer l'administrateur</button>
                    </div>
     
                </form>
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
  <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>
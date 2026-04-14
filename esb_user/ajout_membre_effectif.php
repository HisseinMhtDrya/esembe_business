<?php
require_once('../connexiondb.php');
if(isset($_POST['forminscription'])) {
   $nom = htmlspecialchars($_POST['nom']);
   $postnom = htmlspecialchars($_POST['postnom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $type = htmlspecialchars($_POST['type']);
   $confirme = 0;

 
   if(!empty($_POST['nom']) AND !empty($_POST['postnom']) AND !empty($_POST['prenom'])) {
    
    $req_membre = $bdd->prepare("SELECT * FROM membre_effectif WHERE nom_membre = ? AND postnom_membre = ? AND prenom_membre = ?");
    $req_membre->execute(array($nom, $nom, $prenom));
    
    $membre_exist = $req_membre->rowCount();
    if($membre_exist == 0){
     
      $nomlength = strlen($nom);
      $prenomlength = strlen($prenom);
     
      if($nomlength >= 4 AND $nomlength <=255 AND $prenomlength >=4 AND $prenomlength <=255) {

       
          $nom = ucfirst(strtolower($nom));
          $prenom = ucfirst(strtolower($prenom));
          
                    
                     $insertmbr = $bdd->prepare("INSERT INTO membre_effectif(nom_membre, postnom_membre, prenom_mmebre, type, confirme, date_ajout) VALUES(?, ?, ?, ?, ?, NOW())");
                    
                    $insertmbr->execute(array($nom, $postnom, $prenom, $type, $confirme));
                      
                     $erreur = "Membre ajouté avec succès !!!";
                 
                  
          }else{
            $erreur = "Le nom ou prenom doit contenir au moins 4 caractères !";
          }
        }else{
          $erreur = "Ce membre existe déjà !";
        }
      }else{
        $erreur = "Veuillez compléter tous les champs !";
      }
    }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Biblio</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="IMG/logorudless.jpeg" rel="icon">
  <link href="IMG/logorudless.jpeg" rel="apple-touch-icon">

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


<nav class="navbar navbar-light bg-light fixed-top">
  <a href="https://www.rudless.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >Biblio</a>
<div class="text-center">
<a href="profil_surho.php" class="btn btn-primary"><i class="bi bi-arrow-right"></i></a>
</div>
</nav>

  
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Ajouter des membres effectifs</h5>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                      echo '<font color="red">'.$erreur."</font>";
                      }
                     ?>
                 <div class="col-6">
                      <label for="yourName" class="form-label">Nom</label>
              
                        <input type="text" placeholder="" class="form-first-name form-control" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" required />
                      <div class="invalid-feedback">Veuillez saisir le nom</div>
                     
                    </div>

                    <div class="col-6">
                      <label for="yourUsername" class="form-label">Postnom</label>
                  
                        <input type="text" class="form-last-name form-control" placeholder="" id="postnom" name="postnom" value="<?php if(isset($postnom)) { echo $postnom; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir le prenom.</div>
                  
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Prenom</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-last-name form-control" placeholder="" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir le prenom.</div>
                      </div>
                    </div>

                    <div class="col-12">
                  
                      <label for="type">Type</label><br>
                      <select id="type" class="form-control"  name="type" required>
           
                        <option class="form-control" value="Client">Client</option>
                        <option class="form-control" value="Membre">Membre</option>
                        <option class="form-control" value="Administrateur">Administrateur</option>
                        <option class="form-control" value="Administratrice">Administratrice</option>
            
                      </select>
                 
                   <div class="invalid-feedback">Veuillez crocher le type !</div>
                      </div>
                     
                      <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <a href="" class="btn btn-danger">Vider le formulaire</a>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <button class="btn btn-primary" name="forminscription" type="submit">Ajouter</button>
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
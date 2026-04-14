<?php
session_start();
require_once('../connexiondb.php');

if(isset($_POST['confirme_compte_code'])) {
 if(isset($_POST['code_verifcation']) && !empty($_POST['code_verifcation'])){
    $mail = $_SESSION['mail'];
    $code_verification = htmlspecialchars($_POST['code_verifcation']);
    $req_code = $bdd->prepare("SELECT * FROM confirme_compte WHERE code = ? AND mail = ?");
    $req_code->execute(array($code_verification, $mail));
    if($req_code->rowCount() == 1){
        $req_mail =  $bdd->prepare("SELECT * FROM membre_tz WHERE mail = ?");
        $req_mail->execute(array($mail));
          
            $userinfo = $req_mail->fetch();
      if($userinfo['confirme'] == 0){
          if($userinfo['sexe'] == 'Homme'){
            $statut = "actif";
          }else{
            $statut = "active";
          }
        $confirme = 1;
        $confirme_compte = $bdd->prepare("UPDATE membre_tz SET confirme = ?, statut = ? WHERE mail = ?");
        $confirme_compte->execute(array($confirme, $statut, $mail));

                    $id_provenance = $userinfo['id'];
                    $montant_parent = 2;
                    $montant_ancetre = 1;

                    $type_recompense_parent = "Fils";
                    $type_recompense_ancetre = "Petit fils";
                    $id_parent = $userinfo['id_parent'];
                    $id_ancetre = $userinfo['id_ancetre'];
                    $confirme = 0;
                    
                    if($id_parent != 0){
                      $verif_recompense_parent = $bdd->prepare("SELECT * FROM recompense WHERE id_user = ? AND id_provenance = ? AND type_recompense = ?");
                      $verif_recompense_parent->execute(array($id_parent, $id_provenance, $type_recompense_parent));
                      if($verif_recompense_parent->rowCount() == 0){
                        $insert_recompense_parent = $bdd->prepare("INSERT INTO recompense(id_user, montant, id_provenance, type_recompense, date_recompense, confirme) VALUES (?, ?, ?, ?, NOW(), ?)");
                        $insert_recompense_parent->execute(array($id_parent, $montant_parent, $id_provenance, $type_recompense_parent, $confirme));
                      }
                      $recup_solde_parent = $bdd->prepare("SELECT * FROM solde_user WHERE id_user = ?");
                      $recup_solde_parent->execute(array($id_parent));
                      if($recup_solde_parent->rowCount() > 0){
                        $info_solde_parent = $recup_solde_parent->fetch();
                        $solde_dispo_parent = $info_solde_parent['solde_disponible'];
                        $nouveau_solde_parent = $solde_dispo_parent + $montant_parent;
                        $update_nouveau_solde_parent = $bdd->prepare("UPDATE solde_user SET solde_disponible = ?, date_modif = NOW() WHERE id_user = ?");
                        $update_nouveau_solde_parent->execute(array($nouveau_solde_parent, $id_parent));
                      }else{
                        $insert_solde_parent = $bdd->prepare("INSERT INTO solde_user(id_user, solde_disponible, date_modif) VALUES (?, ?, NOW())");
                        $insert_solde_parent->execute(array($id_parent, $montant_parent));
                      }
                    }

                    if($userinfo['id_ancetre'] != 0){
                      $verif_recompense_ancetre = $bdd->prepare("SELECT * FROM recompense WHERE id_user = ? AND id_provenance = ? AND type_recompense = ?");
                      $verif_recompense_ancetre->execute(array($id_ancetre, $id_provenance, $type_recompense_ancetre));
                      if($verif_recompense_ancetre->rowCount() == 0){
                        $insert_recompense_ancetre = $bdd->prepare("INSERT INTO recompense(id_user, montant, id_provenance, type_recompense, date_recompense, confirme) VALUES (?, ?, ?, ?, NOW(), ?)");
                        $insert_recompense_ancetre->execute(array($id_ancetre, $montant_ancetre, $id_provenance, $type_recompense_ancetre, $confirme));
                      }
                      $recup_solde_ancetre = $bdd->prepare("SELECT * FROM solde_user WHERE id_user = ?");
                        $recup_solde_ancetre->execute(array($id_ancetre));
                        if($recup_solde_ancetre->rowCount() > 0){
                          $info_solde_ancetre = $recup_solde_ancetre->fetch();
                          $solde_dispo_ancetre = $info_solde_ancetre['solde_disponible'];
                          $nouveau_solde_ancetre = $solde_dispo_ancetre + $montant_ancetre;
                          $update_nouveau_solde_ancetre = $bdd->prepare("UPDATE solde_user SET solde_disponible = ?, date_modif = NOW() WHERE id_user = ?");
                          $update_nouveau_solde_ancetre->execute(array($nouveau_solde_ancetre, $id_ancetre));
                        }else{
                          $insert_solde_ancetre = $bdd->prepare("INSERT INTO solde_user(id_user, solde_disponible, date_modif) VALUES (?, ?, NOW())");
                          $insert_solde_ancetre->execute(array($id_ancetre, $montant_ancetre));
                        }
                    }
        
        $delete_confrime_from_confirme_compte = $bdd->prepare("DELETE FROM confirme_compte WHERE code = ? AND mail = ?");
        $delete_confrime_from_confirme_compte->execute(array($confirme, $mail));
        header('location:pre_connexion');
      }else{
        $erreur = "Votre compte est déjà confirmé.";
        header('location:pre_connexion');
      }
    }else{
        $erreur = "Code incorrect. Veuillez réessayer !";
    }
 }
}

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
    .btnLogin{
      background:#ff00ff;
      color:#fff;
      padding:8px;
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

                  <div class="pt-4 pb-2 py-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 900;color:#ff00ff;" >TaZa</h5>
                    <p class="text-center small">Veuillez saisir le code reçu par mail</p>
                  </div>

                  <form class="row g-3 needs-validation" method="post" novalidate>
                    <?php
                      if(isset($erreur)) {
                    ?>
                       <span class="text-center text-danger"><?=$erreur?></span>
                    <?php
                    }
                    ?>
                    <div class="col-12">
                      <div class="input-group has-validation">
                        <input type="text" name="code_verifcation"  class="form-control" id="" placeholder="Code_verifcation..." required>
                        <div class="invalid-feedback">Veuillez saisir le code</div>
                      </div>
                    </div>
                  

                    <div class="col-12">
                    <input type="submit" class="w-100 btnLogin" style="border-radius: 15px;" name="confirme_compte_code" value="Valider">
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
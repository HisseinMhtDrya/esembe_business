<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../");
    exit();
}
require_once('../connexiondb.php');

if(!isset($_GET['action']) && empty($_GET['action']) && empty($_GET['id'])){
  header('location:liste_dette_client');
}

$action = htmlspecialchars($_GET['action']);
$id_dette = htmlspecialchars(intval($_GET['id']));

$recup_info_dette = $bdd->prepare("SELECT * FROM dette_client WHERE id = ?");
$recup_info_dette->execute(array($id_dette));

if($recup_info_dette->rowCount() == 0){
  header('location:liste_dette_client');
}
$info_dette = $recup_info_dette->fetch();
if(isset($_POST['valider'])) {

  if(isset($_POST['nom']) && !empty($_POST['nom']) && $_POST['nom'] != $info_dette['nom']){
    $nom = htmlspecialchars($_POST['nom']);
    $update_nom_dette = $bdd->prepare("UPDATE dette_client SET nom = ? WHERE id = ?");
    $update_nom_dette->execute(array($nom, $id_dette));
    header('location:modifier_dette?action=modifier&id='.$id_dette);
  }
  if(isset($_POST['prenom']) && !empty($_POST['prenom']) && $_POST['prenom'] != $info_dette['prenom']){
    $prenom = htmlspecialchars($_POST['prenom']);
    $update_prenom_dette = $bdd->prepare("UPDATE dette_client SET prenom = ? WHERE id = ?");
    $update_prenom_dette->execute(array($prenom, $id_dette));
    header('location:modifier_dette?action=modifier&id='.$id_dette);
  }
  if(isset($_POST['sexe']) && !empty($_POST['sexe']) && $_POST['sexe'] != $info_dette['sexe']){
    $sexe = htmlspecialchars($_POST['sexe']);
    $update_sexe_dette = $bdd->prepare("UPDATE dette_client SET sexe = ? WHERE id = ?");
    $update_sexe_dette->execute(array($sexe, $id_dette));
    header('location:modifier_dette?action=modifier&id='.$id_dette);
  }
  if(isset($_POST['phone']) && !empty($_POST['phone']) && $_POST['phone'] != $info_dette['telephone']){
    $phone = htmlspecialchars($_POST['phone']);
    $update_phone_dette = $bdd->prepare("UPDATE dette_client SET telephone = ? WHERE id = ?");
    $update_phone_dette->execute(array($phone, $id_dette));
    header('location:modifier_dette?action=modifier&id='.$id_dette);
  }
  if(isset($_POST['adresse']) && !empty($_POST['adresse']) && $_POST['adresse'] != $info_dette['adresse']){
    $adresse = htmlspecialchars($_POST['adresse']);
    $update_adresse_dette = $bdd->prepare("UPDATE dette_client SET adresse = ? WHERE id = ?");
    $update_adresse_dette->execute(array($adresse, $id_dette));
    header('location:modifier_dette?action=modifier&id='.$id_dette);
  }
  if(isset($_POST['produit']) && !empty($_POST['produit']) && $_POST['produit'] != $info_dette['produit_emprunte']){
    $produit = htmlspecialchars($_POST['produit']);
    $update_produit_dette = $bdd->prepare("UPDATE dette_client SET produit_emprunte = ? WHERE id = ?");
    $update_produit_dette->execute(array($produit, $id_dette));
    header('location:modifier_dette?action=modifier&id='.$id_dette);
  }
  if(isset($_POST['montant']) && !empty($_POST['montant']) && $_POST['montant'] != $info_dette['montant_emprunt']){
    $montant = htmlspecialchars($_POST['montant']);
    $update_montant_dette = $bdd->prepare("UPDATE dette_client SET montant_emprunt = ? WHERE id = ?");
    $update_montant_dette->execute(array($montant, $id_dette));
    header('location:modifier_dette?action=modifier&id='.$id_dette);
  }
  if(isset($_POST['statut']) && !empty($_POST['statut']) && $_POST['statut'] != $info_dette['statut']){
    $statut = htmlspecialchars($_POST['statut']);
    $update_statut_dette = $bdd->prepare("UPDATE dette_client SET statut = ? WHERE id = ?");
    $update_statut_dette->execute(array($statut, $id_dette));
    header('location:modifier_dette?action=modifier&id='.$id_dette);
  }
  

}
  
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Esembes Buzz</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
  <a href="https://www.esembe-business.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >Esembe</a>
<div class="text-center">
<a href="../administration/bureau_admin" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i></a>
</div>
</nav>

  
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-12 mt-5">
                   <div class="section-header bg-primary">
                   
                    <h2 class="text-center pb-0 fs-4" style="font-weight:900;"><a href="https://esemebe-business.com" class="text-white" style="font-weight:900;">Esembe Business</a></h2>
                    <h3 class="text-center text-warning pb-0 fs-4" style="font-weight:900;">Dette de <?=$info_dette['prenom'] ?> <?=$info_dette['nom'] ?></h3>
                  
                  </div> 
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
                            <td><?=$info_dette['statut'] ?>Fc</td>
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
            <div class="col-lg-7 col-md-10 d-flex flex-column align-items-center justify-content-center mt-5">

              <div class="card mb-3">

                <div class="card-body">
                  <a href="Liste_dette_client" class="btn btn-primary mt-2">Liste dette client</a>
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Modifier dette</h5>
                   
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                       echo '<font color="red">'.$erreur."</font>";
                      }
                     ?>
                 <div class="col-6">
                      <label for="nom" class="form-label">Nom</label>
                        <input type="text" placeholder="" class="form-first-name form-control" id="nom" name="nom" value="<?=$info_dette['nom'] ?>"/>
                    </div>

                    <div class="col-6">
                      <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="prenom" name="prenom" value="<?=$info_dette['prenom'] ?>"/>
                    </div>
                    <div class="col-12">
                      <label for="sexe" class="form-label">Sexe</label>
                        <select name="sexe" id="sexe" class="form-control">
                          <option value="<?=$info_dette['sexe'] ?>"><?=$info_dette['sexe'] ?></option>
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                    </div>

                    <div class="col-12">
                      <label for="phone" class="form-label">Téléphone</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="phone" name="phone" value="<?=$info_dette['telephone'] ?>"/>
                    </div>
                    <div class="col-12">
                      <label for="adresse" class="form-label">Adresse client</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="adresse" name="adresse" value="<?=$info_dette['adresse'] ?>"/>
                    </div>
                    <div class="col-12">
                      <label for="produit" class="form-label">Produit emprunté</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="produit" name="produit" value="<?=$info_dette['produit_emprunte'] ?>"/>
                    </div>
                    <div class="col-12">
                      <label for="montant" class="form-label">Montant emprunté (en Fc)</label>
                        <input type="number" class="form-last-name form-control" placeholder="" id="montant" name="montant" value="<?=$info_dette['montant_emprunt'] ?>"/>
                    </div>
                    <div class="col-12">
                      <label for="statut" class="form-label">Statut</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="statut" name="statut" value="<?=$info_dette['statut'] ?>"/>
                    </div>
                     
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="valider" type="submit">Modifier</button>
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
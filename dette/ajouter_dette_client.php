<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../");
    exit();
}
require_once('../connexiondb.php');


if(isset($_POST['valider'])) {

   if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['phone']) && !empty($_POST['adresse']) && !empty($_POST['montant'])){
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $sexe = htmlspecialchars($_POST['sexe']);
    $phone = htmlspecialchars($_POST['phone']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $produit_emprunte = htmlspecialchars($_POST['produit']);
    $montant = htmlspecialchars($_POST['montant']);
    $statut = "non payée";
    
    $longueurKey = 8;
        $code = "";
        for($i = 1; $i < $longueurKey; $i++) {
            $code .= mt_rand(0,9);
        }
    
    $verif_client = $bdd->prepare("SELECT * FROM dette_client WHERE nom = :nom AND prenom = :prenom AND sexe = :sexe");
    $verif_client->execute(array(':nom' => $nom, ':prenom' => $prenom, ':sexe' => $sexe));
    if($verif_client->rowcount() > 0){
        $info_dette = $verif_client->fetch();
        $montant_dette_exist = $info_dette['montant_emprunt'];
        $nouveau_montant = $montant + $montant_dette_exist;
        $id_dette = $info_dette['id'];
        $update_dette = $bdd->prepare("UPDATE dette_client SET montant_emprunt = ? WHERE id = ?");
        $update_dette->execute(array($nouveau_montant, $id_dette));
        $erreur = "Opération réussie";
    }else{
        $insert_dette = $bdd->prepare("INSERT INTO dette_client(nom, prenom, sexe, telephone, adresse, produit_emprunte, montant_emprunt, statut, code, date_emprunt) VALUES(:nom, :prenom, :sexe, :telephone, :adresse, :produit_emprunte, :montant_emprunt, :statut, :code, NOW())");
        $insert_dette->execute(array(':nom' => $nom, ':prenom' => $prenom, ':sexe' => $sexe, ':telephone' => $phone, ':adresse' => $adresse, ':produit_emprunte' => $produit_emprunte, ':montant_emprunt' => $montant, ':statut' => $statut, ':code' => $code));
        $erreur = "Dette enregistrée avec succès";
    }
  }else{
    $erreur = "Veuillez compléter tous les champs";
  }
   
}
  
  
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
            <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Ajouter dette client</h5>
                    <a href="liste_dette_client" class="btn btn-primary">Liste dette client</a>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                       echo '<font color="red">'.$erreur."</font>";
                      }
                     ?>
                 <div class="col-6">
                      <label for="nom" class="form-label">Nom</label>
              
                        <input type="text" placeholder="" class="form-first-name form-control" id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom; } ?>" required />
                      <div class="invalid-feedback">Veuillez remplir ce champs</div>
                     
                    </div>

                    <div class="col-6">
                      <label for="prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom; } ?>" required />
                        <div class="invalid-feedback">Veuillez remplir ce champs.</div>
                    </div>
                    <div class="col-12">
                      <label for="sexe" class="form-label">Sexe</label>
                        <select name="sexe" id="sexe" class="form-control">
                            <option value="Homme">Homme</option>
                            <option value="Femme">Femme</option>
                        </select>
                        <div class="invalid-feedback">Veuillez remplir ce champs.</div>
                    </div>

                    <div class="col-12">
                      <label for="phone" class="form-label">Téléphone</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="phone" name="phone" value="<?php if(isset($phone)) { echo $phone; } ?>" required />
                        <div class="invalid-feedback">Veuillez remplir ce champs.</div>
                    </div>
                    <div class="col-12">
                      <label for="adresse" class="form-label">Adresse client</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="adresse" name="adresse" value="<?php if(isset($adresse)) { echo $adresse; } ?>" required />
                        <div class="invalid-feedback">Veuillez remplir ce champs.</div>
                    </div>
                    <div class="col-6">
                      <label for="produit" class="form-label">Produit emprunté</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="produit" name="produit" value="<?php if(isset($produit)) { echo $produit; } ?>" required />
                        <div class="invalid-feedback">Veuillez remplir ce champs.</div>
                    </div>
                    <div class="col-6">
                      <label for="montant" class="form-label">Montant</label>
                        <input type="number" class="form-last-name form-control" placeholder="" id="montant" name="montant" value="<?php if(isset($montant)) { echo $montant; } ?>" required />
                        <div class="invalid-feedback">Veuillez remplir ce champs.</div>
                    </div>
                     
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <input type="reset" value="Annuler" class="btn btn-danger">
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <button class="btn btn-primary w-100" name="valider" type="submit">Ajouter</button>
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
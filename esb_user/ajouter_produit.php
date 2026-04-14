<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: ../');
  exit;
}
require_once('../connexiondb.php');

$getid = $_SESSION['id'];
$requser = $bdd->prepare('SELECT * FROM surho WHERE id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();
// Vérification si le formulaire est soumis

if (isset($_POST['valider']) && !empty($_FILES['fichier']['name'])) {
 
  $auteur = htmlspecialchars($_POST['auteur']);
  $titre = htmlspecialchars($_POST['titre']);

  $valeur = htmlspecialchars($_POST['valeur']);
  $mot_cle = htmlspecialchars($_POST['mot_cle']);
  $description = htmlspecialchars($_POST['description']);

  $nom_fichier = $_FILES['fichier']['name'];
  $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
  $extensions_autorisees = array('mp4', 'png', 'jpg', 'gif', 'jpeg', 'avi', 'pdf',  'doc', 'docx', 'mp3','xlsx', 'docx', 'xls', 'mkv', 'mov', 'wmv', 'flv', 'mpeg', 'mpg', 'webm', '3gp', 'm4v', 'ogv');

  if (in_array($extension, $extensions_autorisees)) {
    // Déplacement du fichier vers le dossier "uploads/"
    $unique_id = uniqid();
    $destination = '../fichier/' . $unique_id . '.' . $extension;
    $nom_du_fichier =  $unique_id . '.' . $extension;

    move_uploaded_file($_FILES['fichier']['tmp_name'], $destination);

    $utilisateur_id = $_SESSION['id'];
    $date_ajout = date('Y-m-d H:i:s');

    $sql = "INSERT INTO ouvrage (auteur, titre, valeur, mot_cle, resume, fichier, date_ajout) VALUES (:auteur, :titre, :valeur, :mot_cle, :resume,  :fichier, NOW())";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':auteur', $auteur);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':valeur', $valeur);
    $stmt->bindParam(':mot_cle', $mot_cle);
    $stmt->bindParam(':resume', $description);
    $stmt->bindParam(':fichier', $nom_du_fichier);

    if ($stmt->execute()) {
     $erreur = "Ouvrage ajouté avec succès !";
    } else {
      $erreur = "Une erreur s'est produite lors de l'ajout de l'ouvrage !";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RudLess</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/logorudless.jpeg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
  <style>
.btn-file {
    position: relative;
    overflow: hidden;
 cursor: pointer;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
</head>

<body>
<nav class="navbar navbar-light bg-light fixed-top">
  <a href="https://www.rudless.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >RudLess</a>
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
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Ajouter un ouvrage</h5>
                  </div>

                  <form class="row g-3 needs-validation" enctype="multipart/form-data" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                      echo '<font color="red">'.$erreur."</font>";
                      }
                     ?>
             <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <label for="auteur" class="form-label">Auteur</label>

                        <input type="text" placeholder="" class="form-first-name form-control" id="auteur" name="auteur" value="<?php if(isset($auteur)) { echo $auteur; } ?>" required />
                      <div class="invalid-feedback">Veuillez saisir le nom de l'auteur</div>
                
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="titre" name="titre" value="<?php if(isset($titre)) { echo $titre; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir le titre de l'ouvrage.</div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <label for="valeur" class="form-label">Valeur</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="valeur" name="valeur" value="<?php if(isset($valeur)) { echo $valeur; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir la valeur de remplacement de l'ouvrage.</div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <label for="mot_cle" class="form-label">Mot clé</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="mot_cle" name="mot_cle" value="<?php if(isset($mot_cle)) { echo $mot_cle; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir le mot clé de l'ouvrage.</div>
                    </div>
        
                   
                    <br><br>
                    <div class="col-12">
                   
       <div class="shadow-lg p-3 mb-5 bg-white rounded"> 
           <a href="" id="result"></a>
       </div>

       <label for="contenu">Description</label>
  
    <div class="input-group has-validation">
    <span class="input-group-text  btn-file" id="inputGroupPrepend">
      <i class="bi bi-download"></i>
      <input type="file" class="form-control" name="fichier" id="demo" onchange="readFile();" accept="file/*" required>
    </span>
    <textarea style="height: 50px;" class="form-control" placeholder="Description..." name="description" id="description" rows="4" cols="50" required></textarea>
    </div>
                    </div>
                    <br><br>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <a href="" class="btn btn-danger">Vider le formulaire</a>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <input class="btn btn-primary w-100" name="valider" type="submit" value="Ajouter" >
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
  <script type="text/javascript">
function readFile() {
    var reader = new FileReader();
    var file = document.getElementById('demo').files[0];
    reader.onload = function(e) {
        document.getElementById('result').href = e.target.result;
    }
    document.getElementById('result').textContent = file.name;
    reader.readAsDataURL(file);
}

</script>
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


  <script>
  function redirigerVersLeBas() {
  window.scrollTo(0,document.body.scrollHeight);
}

// Appel de la fonction au chargement de la page
window.onload = redirigerVersLeBas;
</script>
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
<?php
session_start();
require_once('../connexiondb.php');

if (!isset($_SESSION['id']) && !isset($_SESSION['id_page'])) {
  header('Location: ../');
  exit;
}else{
  $id_page = $_SESSION['id_page'];
}
$req_page = $bdd->prepare("SELECT * FROM page WHERE id = ? AND id_createur = ?");
$req_page->execute(array($id_page, $_SESSION['id']));
$info_page = $req_page->fetch();

if(isset($_POST['valider'])){
  if(!empty($_POST['nom_entreprise'])){
    $nom_entreprise = htmlspecialchars($_POST['nom_entreprise']);
    $update_nom = $bdd->prepare("UPDATE page SET titre = ? WHERE id = ? AND id_createur = ?");
    $update_nom->execute(array($nom_entreprise, $id_page, $_SESSION['id']));
    $erreur = "Modification apportée avec succès !";
    //header('location:modifier_page.php?id='.$id_page);
  }
  if(!empty($_POST['pays'])){
    $pays = htmlspecialchars($_POST['pays']);
    $update_pays = $bdd->prepare("UPDATE page SET pays = ? WHERE id = ? AND id_createur = ?");
    $update_pays->execute(array($pays, $id_page, $_SESSION['id']));
    $erreur = "Modification apportée avec succès !";
    //header('location:modifier_page.php?id='.$id_page);
  }
  if(!empty($_POST['ville'])){
    $ville = htmlspecialchars($_POST['ville']);
    $update_ville = $bdd->prepare("UPDATE page SET ville = ? WHERE id = ? AND id_createur = ?");
    $update_ville->execute(array($ville, $id_page, $_SESSION['id']));
    $erreur = "Modification apportée avec succès !";
    //header('location:modifier_page.php?id='.$id_page);
  }
  if(!empty($_POST['phone'])){
    $phone = htmlspecialchars($_POST['phone']);
    $update_phone = $bdd->prepare("UPDATE page SET phone = ? WHERE id = ? AND id_createur = ?");
    $update_phone->execute(array($phone, $id_page, $_SESSION['id']));
    $erreur = "Modification apportée avec succès !";
    //header('location:modifier_page.php?id='.$id_page);
  }
  if(!empty($_POST['mail'])){
    $mail = htmlspecialchars($_POST['mail']);
    $update_mail = $bdd->prepare("UPDATE page SET mail = ? WHERE id = ? AND id_createur = ?");
    $update_mail->execute(array($mail, $id_page, $_SESSION['id']));
    $erreur = "Modification apportée avec succès !";
    //header('location:modifier_page.php?id='.$id_page);
  }
  if(!empty($_POST['adresse'])){
    $adresse = htmlspecialchars($_POST['adresse']);
    $update_adresse = $bdd->prepare("UPDATE page SET adresse = ? WHERE id = ? AND id_createur = ?");
    $update_adresse->execute(array($adresse, $id_page, $_SESSION['id']));
    $erreur = "Modification apportée avec succès !";
    //header('location:modifier_page.php?id='.$id_page);
  }
  if(!empty($_POST['categorie'])){
    $categorie = htmlspecialchars($_POST['categorie']);
    $update_categorie = $bdd->prepare("UPDATE page SET categorie = ? WHERE id = ? AND id_createur = ?");
    $update_categorie->execute(array($categorie, $id_page, $_SESSION['id']));
    $erreur = "Modification apportée avec succès !";
    //header('location:modifier_page.php?id='.$id_page);
  }
  if(!empty($_POST['description'])){
    $description = htmlspecialchars($_POST['ville']);
    $update_description = $bdd->prepare("UPDATE page SET description = ? WHERE id = ? AND id_createur = ?");
    $update_description->execute(array($description, $id_page, $_SESSION['id']));
    $erreur = "Modification apportée avec succès !";
    //header('location:modifier_page.php?id='.$id_page);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RudLess Business</title>
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
  <a href="../les_pages/profil_page.php?id=<?=$id_page ?>" class="btn btn-primary"><i class="bi bi-arrow-right"></i></a>
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

                  <div class="pt-4 pb-2 bg-warning text-white">
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Editer ma page</h5>
                    <p class="text-center">Chosisissez les informations à modifier. <br>
                       Vous pouvez modifier une ou plusieurs informations à la fois.</p>
                  </div>

                  <form action="" method="post">
                       <?php
                         if(isset($erreur)){
                          ?>
                            <div class="py-3 bg-danger text-center text-white">
                              <?=$erreur ?>
                            </div>
                          <?php
                         }
                        ?>
                        <?php
                       ?>
                   <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nom_entreprise">Nom de l'entreprise</label>
                            <input type="text" class="form-control" name="nom_entreprise" id="nom_entreprise" placeholder="">
                        </div>
                       
                        <div class="col-6 mb-3">
                            <label for="telephone">Téléphone</label>
                            <input type="tel" class="form-control" name="phone" id="telephone" placeholder="">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="mail">E-mail</label>
                            <input type="email" class="form-control" name="mail" id="mail" placeholder="">
                        </div>
                           <div class="form-group">
                            <label for="adresse">Adresse:</label>
                            <input type="text" class="form-control" name="adresse" id="adresse">
                            </div> 
                            <div class="form-group col-6">
                            <label for="pays">Pays:</label>
                            <input type="text" class="form-control" name="pays" id="pays">
                            </div>
                            <div class="form-group col-6">
                            <label for="ville">Ville:</label>
                            <input type="text" class="form-control" name="ville" id="ville">
                            </div>
                            <div class="form-group mb-2">
                            <label for="codePostal">Code Postal:</label>  
                            <input type="text" class="form-control" name="code_postal" id="codePostal">
                            </div>
                        <div class="col-12 mb-4">
                        <label for="categorie">Catégorie de la page </label>
                            <select id="categorie" class="form-control" name="categorie">
                            <option value="" class="form-control">Sélectionner une catégorie</option>
                            <option value="Entreprise" class="form-control">Entreprise locale</option>
                            <option value="site web" class="form-control">Site web ou blog</option>
                            <option value="Personnalite" class="form-control">Personnalité publique</option>
                            <option class="form-control" value="Mode">Mode</option>
                            <option class="form-control" value="Technologie">Technologie</option>
                            <option class="form-control" value="3">Alimentation</option>
                            <option class="form-control" value="Alimentation">Beauté</option>
                            <option class="form-control" value="Santé">Santé</option>
                            <option class="form-control" value="Finance">Finance</option>
                            <option class="form-control" value="Immobilier">Immobilier</option>
                            <option class="form-control" value="Transport">Transport</option>
                            <option class="form-control" value="Education">Éducation</option>
                            <option class="form-control" value="Sport">Sport</option>
                            <option class="form-control" value="Loisirs">Loisirs</option>
                            <option class="form-control" value="Marketing">Marketing</option>
                            <option class="form-control" value="Communication">Communication</option>
                            <option class="form-control" value="Art">Art</option>
                            <option class="form-control" value="Service">Services</option>
                            <option class="form-control" value="Consulting">Consulting</option>
                            <option class="form-control" value="Ingenierie">Ingénierie</option>
                            <option class="form-control" value="Juridique">Juridique</option>
                            <option class="form-control" value="Maintenance">Maintenance</option>
                            <option class="form-control" value="Restauration">Restauration</option>
                            </select>
                        </div>
                        <div class="col-12 mb-4">
                            <label for="text">Description de la page</label>
                            <textarea style="height: 50px;" class="form-control" placeholder="Dites un mot sur votre page..." name="description" id="contenu" rows="4" cols="50"></textarea>
                        </div>
                    <br><br>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <input type="reset" class="btn btn-danger" value="Annuler">
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <input class="btn btn-primary w-100" name="valider" type="submit" value="Modifier" >
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
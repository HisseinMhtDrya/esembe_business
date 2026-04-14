<?php
session_start();

if (!isset($_SESSION['id'])) {
  header('Location: ../');
  exit;
}
require_once('../connexiondb.php');

$getid = $_SESSION['id'];
$requser = $bdd->prepare('SELECT * FROM membre_esembe WHERE id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();



$recup_categorie_page = $bdd->prepare("SELECT * FROM categorie ORDER BY id_categorie DESC");
$recup_categorie_page->execute();

if (isset($_POST['valider']) && !empty($_FILES['fichier']['name'])) {
 
  $nom_produit = htmlspecialchars($_POST['nom_produit']);
  $type_produit = htmlspecialchars($_POST['type_produit']);
  $categorie = htmlspecialchars($_POST['categorie']);
  $prix_achat = htmlspecialchars($_POST['prix_achat']);
  
  $prix_vente = htmlspecialchars($_POST['prix_vente']);


  $quantite_produit = htmlspecialchars($_POST['quantite_produit']);



  $stock_produit = $quantite_produit;

  $description = htmlspecialchars($_POST['description']);

  $nom_fichier = $_FILES['fichier']['name'];
  $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
  $extensions_autorisees = array('mp4', 'png', 'jpg', 'gif', 'jpeg', 'avi', 'pdf',  'doc', 'docx', 'mp3','xlsx', 'docx', 'xls', 'mkv', 'mov', 'wmv', 'flv', 'mpeg', 'mpg', 'webm', '3gp', 'm4v', 'ogv');

  if (in_array($extension, $extensions_autorisees)) {

    $unique_id = uniqid();
    $destination = '../fichier/' . $unique_id . '.' . $extension;
    $nom_du_fichier =  $unique_id . '.' . $extension;

    move_uploaded_file($_FILES['fichier']['tmp_name'], $destination);

    $id_client = $_SESSION['id'];
    $date_ajout = date('Y-m-d H:i:s');

    $sql = "INSERT INTO produit (nom_produit, type_produit, categorie, description, prix_achat, prix_vente, quantite, stock, fichier, date_ajout) VALUES (:nom_produit, :type_produit, :categorie, :description, :prix_achat, :prix_vente, :quantite, :stock, :fichier, NOW())";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':nom_produit', $nom_produit);
    $stmt->bindParam(':type_produit', $type_produit);
    $stmt->bindParam(':categorie', $categorie);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':prix_achat', $prix_achat);
    $stmt->bindParam(':prix_vente', $prix_vente);
    $stmt->bindParam(':quantite', $quantite_produit);
    $stmt->bindParam(':stock', $stock_produit);
    
    $stmt->bindParam(':fichier', $nom_du_fichier);

    if ($stmt->execute()) {
     $erreur = "Produit ajouté avec succès !";
     $bg = 'bg-success';
    } else {
      $erreur = "Une erreur s'est produite lors de l'ajout de votre produit. Merci de réessayer !";
      $bg = 'bg-danger';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Esembe Buzz</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="../img/logo_esembe.jpg" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="css/bootstrap.min.css" rel="stylesheet">

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
  <a href="https://www.esembe-buzz.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >esembe</a>
<div class="text-center">
  <a href="../administration/bureau_admin" class="btn btn-primary"><i class="bi bi-arrow-right"></i></a>
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
                  <?php
                   if($recup_categorie_page->rowCount() > 0){
                  ?>
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center text-primary pb-0 fs-4">Ajouter un produit</h5>
                    <p class="text-center">Importer une photo du produit à ajouter aussi</p>
                  </div>

                  <form class="row g-3 needs-validation" enctype="multipart/form-data" novalidate method="post">
               
                     <?php
                     if(isset($erreur)) {
                    ?>
                     <div class="text-center py-3 <?=$bg ?>">
                      <p class="text-center text-white"><?=$erreur ?></p>
                     </div>
                    <?php
                      }
                     ?>
                     <div class="col-6">
                        <label for="nom_produit" class="form-label">Nom produit</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="nom_produit" name="nom_produit" value="<?php if(isset($nom_produit)) { echo $nom_produit; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir le nom du produit.</div>
                     </div>
                     <div class="col-6">
                        <label for="type_produit" class="form-label">Type produit</label>
                        <select name="type_produit" id="type_produit" class="form-control">
                          <option value="Gros">En gros</option>
                          <option value="Détails">En détails</option>
                        </select>
                        <div class="invalid-feedback">Veuillez saisir le type du produit.</div>
                     </div>
                     <div class="col-12">
                      <label for="categorie">Catégorie</label>
                      <select class="form-control" id="categorie" name="categorie">
                        <?php
                          while($c = $recup_categorie_page->fetch()){
                            ?>
                             <option value="<?=$c['titre'] ?>"><?=$c['titre'] ?></option>
                            <?php
                          }
                        ?>
                      </select>
                     </div>
                     <div class="col-lg-12">
                      <label for="quantite_produit" class="form-label">Paquet ou carton</label>
                        <input type="text" class="form-last-name form-control" placeholder="Nombre paquet ou carton" id="quantite_produit" name="quantite_produit" value="<?php if(isset($quantite_produit)) { echo $quantite_produit; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir la quantité du produit.</div>
                    </div>

                  
                    <div class="col-lg-6 col-12">
                      <label for="prix_achat" class="form-label">Prix achat /FC</label>
                        <input type="text" class="form-last-name form-control" placeholder="Prix en détails par paquet ou carton" id="prix_achat" name="prix_achat" value="<?php if(isset($prix_achat)) { echo $prix_achat; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir le prix du produit.</div>
                    </div>

                    <div class="col-lg-6 col-12">
                      <label for="prix_vente" class="form-label">Prix vente /Pièce /FC</label>
                        <input type="text" class="form-last-name form-control" placeholder="" id="prix_vente" name="prix_vente" value="<?php if(isset($prix_produit_vente)) { echo $prix_vente; } ?>" required />
                        <div class="invalid-feedback">Veuillez saisir le prix du produit.</div>
                    </div>
                    
                    
                    <br><br>
                    <div class="col-12">    
                      <div class="shadow-lg p-3 mb-5 bg-white rounded"> 
                          <a href="" id="result"></a>
                      </div>

                      <label for="contenu">Description et fichier(Une photo uniquement)</label>
                  
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
                      <input type="reset" class="btn btn-danger" value="Annuler">
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <input class="btn btn-primary w-100" name="valider" type="submit" value="Ajouter" >
                    </div>
                   
                  </form>
                  <?php
                   }else{
                    ?>
                    <div class="text-center">
                     <p>Vous devez d'abord mettre à jour les différentes catégories de vos produits avant d'ajouter un produit</p>
                     <a href="ajout_categorie" class="btn btn-primary">Ajouter catégorie</a>
                    </div>                 
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
<?php
session_start();
require_once('../connexiondb.php');


if(!isset($_SESSION['id'])){
  header('location:../');
}


$getid = $_SESSION['id'];
$requser = $bdd->prepare('SELECT * FROM membre_esembe WHERE id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();

if (isset($_POST['ajouter']) && !empty($_FILES['fichier']['name'])) {
  $nom_fichier = $_FILES['fichier']['name'];
  $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
  $extensions_autorisees = array('pdf', 'doc', 'docx', 'mp3','xlsx', 'mp4');
  if (in_array($extension, $extensions_autorisees)) {
    $unique_id = uniqid();

    $utilisateur_id = $_SESSION['id'];
    $mon_fichier = $unique_id.'.'.$extension;
    $date_ajout = date('Y-m-d H:i:s');
    
    $requete = $bdd->prepare("INSERT INTO `fichiers` (`utilisateur_id`, `nom_fichier`, `date_ajout`) VALUES (:id, :nom_fichier, :date_ajout)");
    $requete->bindParam(':id', $utilisateur_id);
    $requete->bindParam(':nom_fichier', $mon_fichier);
    $requete->bindParam(':date_ajout', $date_ajout);
    $requete->execute();
    
    $id_photo = $bdd->lastInsertId();
    $chemin_fichier = '../membres/fichiers/' .$mon_fichier;
    move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin_fichier);
    
    header('Location: mes_fichiers?id='.$_SESSION['id']);
    
  }
}

// Récupération de l'utilisateur en session
$utilisateur_id = intval($_SESSION['id']);

// Si une photo a été supprimée, on la supprime de la base de données
if (isset($_POST['supprimer'])) {
    $fichier_id = $_POST['fichier_id'];
    $req = $bdd->prepare('DELETE FROM fichiers WHERE id = :fichier_id AND utilisateur_id = :id');
    $req->execute(array('fichier_id' => $fichier_id, 'id' => $utilisateur_id));
}

// Requête SQL pour récupérer les photos de l'utilisateur
$req = $bdd->prepare('SELECT * FROM fichiers WHERE utilisateur_id = :id');
$req->execute(array('id' => $utilisateur_id));
$fichiers = $req->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Esembe Business| <?=$userinfo['prenom'] ?></title>

    <meta content="" name="description">
    <meta content="" name="keywords">


    <link href="../img/logo_taza.jpg" rel="icon">
    <link href="../img/logo_taza.jpg" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />

    <link href="css/style_membre.css" rel="stylesheet">
   
            <style>
.btn-file {
    position: relative;
    overflow: hidden;
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
    <header id="header" class="header fixed-top d-flex align-items-center" style="margin-bottom:10px;">

<div class="d-flex align-items-center justify-content-between">
<a href="../esb_user/profil_esb?id=<?php echo $_SESSION['id']; ?>">
<i style="font-weight:900;font-size:20px;" class="bi bi-arrow-left"></i></a>

</div>

<nav class="header-nav ms-auto">
<ul class="d-flex align-items-center">


<li class="nav-item dropdown">

  <a class="nav-link nav-icon" href="../taza_users/profil_tz?id=<?php echo $_SESSION['id']; ?>">
</a>
</li>
  
</ul>
</nav>

</header>
<br><br><br>


    <div class="container">
    <div class="row">
    
      <?php
         if($_SESSION['id']==$getid){
      ?>
    <h1 class="text-center text-info">Ma sauvegarde</h1>
<?php
         }
         ?>
          <?php
         if($_SESSION['id']==$getid){
      ?>
<main>
    <div class="container">

      <section class="section register min-vh-50 d-flex flex-column align-items-center justify-content-center py-4">
    <a href="#" data-bs-toggle="modal" data-bs-target="#fichier" class="btn btn-primary" style="width: auto; color:#fff; float:right;">
<i style="font-weight:900;font-size:20px;" class="bi bi-plus"></i>Ajouter un fichier</a>
      </section>
    </div>
  </main>

  <div class="modal fade" id="fichier" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form form method="post" action="" class="modal-content" enctype="multipart/form-data">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="backDropModalTitle">Ajouter une photo</h5>     
                              </div>
                              <div class="modal-body">       
                                <div class="row g-2">
                                  <label for="fichier">Sélectionner un fichier à sauvegarder</label><br>
                                  <span class="btn btn-file">
                                        <i class="bi bi-download" style="font-size:40px"></i><br>
                                        <input type="file" class="form-control" name="fichier" id="demo" onchange="readFile();" accept="file/*" required>
                                        <div class="shadow-lg p-3 mb-5 bg-white rounded"> 
                                            <a href="" id="result"></a>
                                        </div>
                                      </span>

                                  <input type="submit" class="btn btn-primary w-100" name="ajouter" value="Ajouter">
                                  </form>
                              <div class="modal-footer">
                               <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                  Fermer
                                </a>
                              </div>
                            </form>
                          </div>
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
  </div>
</div>
    </div>
<?php
         }
         ?>

    <div class="row">
   <?php
foreach ($fichiers as $fichier) {

    ?>
   
    <div class="col-lg-3 col-sm-6 col-md-4 col-6">
                <div class="shadow-lg p-3 mb-5 bg-white " style="border-radius:22px 6px 20px 6px;"> 
                <div class="team-area">
                       <div class="single-team">
                          <div class="img-area">
    <a href="../membres/fichiers/<?= $fichier['nom_fichier'] ?>" style="width: 100%; height: 200px;" alt=""></a>
    <p> <?= $fichier['nom_fichier'] ?> </p>
  
    <?php
         if($_SESSION['id']==$getid){
      ?>
    <form method="post">
    <input type="hidden" name="fichier_id" value=" <?= $fichier['id'] ?> ">
    <button type="submit" class="btn btn-outline-danger" name="supprimer"><i class="bi bi-trash"></i></button>&nbsp;&nbsp;&nbsp;
    <?php
         }
         ?>
 <a href="../membres/fichiers/<?= $fichier['nom_fichier'] ?>" class="btn btn-primary" download="../membres/fichiers/<?= $fichier['nom_fichier'] ?>"><i class="bi bi-download"></i></a>
    </form>
    </form>
    </div>
    </div>
                </div>
                </div>
    </div>
    <?php
}
?>
    </div>
    </div>
   



    
<!-- Back to Top -->
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
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
</script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="main.js"></script>
</body>

</html>
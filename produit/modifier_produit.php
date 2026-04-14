<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../");
    exit();
  }
  if(!isset($_GET['modifier'])){
    header("Location: ../../");
    exit();
  }else{
    $id_produit = intval($_GET['modifier']);
  }
  require_once('../connexiondb.php');;

if(isset($_GET['type']) && $_GET['type'] == 'produit') {
   $type = $_GET['type'];
   $req_produit = $bdd->prepare("SELECT * FROM produit WHERE id_produit = ? ");
   $req_produit->execute(array($id_produit));
   if($req_produit->rowCount() > 0){
      $r = $req_produit->fetch();
   }else{
    header("Location: ../../");
    exit();
   }
 }

 if (isset($_POST['valider'])) {
    if(!empty($_POST['nom_produit'])){
        $nom_produit = htmlspecialchars($_POST['nom_produit']);
        $update_nom_produit = $bdd->prepare("UPDATE produit SET nom_produit = ? WHERE id_produit = ? ");
        $update_nom_produit->execute(array($nom_produit, $id_produit));
        header('location:modifier_produit?type=produit&modifier='.$id_produit);
        $erreur = "Modification apportée avec succès";
    }
   
    if(!empty($_POST['prix_achat'])){
        $prix_achat = htmlspecialchars($_POST['prix_achat']);
        $update_prix_achat = $bdd->prepare("UPDATE produit SET prix_achat = ? WHERE id_produit = ?");
        $update_prix_achat->execute(array($prix_achat, $id_produit));
        header('location:modifier_produit?type=produit&modifier='.$id_produit);
        $erreur = "Modification apportée avec succès";
    }
   
    if(!empty($_POST['prix_vente'])){
        $prix_vente = htmlspecialchars($_POST['prix_vente']);
        $update_prix_vente = $bdd->prepare("UPDATE produit SET prix_vente = ? WHERE id_produit = ?");
        $update_prix_vente->execute(array($prix_vente, $id_produit));
        header('location:modifier_produit?type=produit&modifier='.$id_produit);
        $erreur = "Modification apportée avec succès";
    }

    if(!empty($_POST['quantite_produit'])){
        $quantite_produit = htmlspecialchars($_POST['quantite_produit']);
        $update_quantite = $bdd->prepare("UPDATE produit SET quantite = ? WHERE id_produit = ?");
        $update_quantite->execute(array($quantite_produit, $id_produit));
        header('location:modifier_produit?type=produit&modifier='.$id_produit);
        $erreur = "Modification apportée avec succès";
    }
    if(!empty($_POST['stock_produit'])){
        $stock_produit = htmlspecialchars($_POST['stock_produit']);
        $update_stock = $bdd->prepare("UPDATE produit SET stock = ? WHERE id_produit = ?");
        $update_stock->execute(array($stock_produit, $id_produit));
        header('location:modifier_produit?type=produit&modifier='.$id_produit);
        $erreur = "Modification apportée avec succès";
    }
    if(!empty($_POST['description'])){
        $description = htmlspecialchars($_POST['description']);
        $update_description = $bdd->prepare("UPDATE produit SET description = ? WHERE id_produit = ?");
        $update_description->execute(array($description, $id_produit));
        header('location:modifier_produit?type=produit&modifier='.$id_produit);
        $erreur = "Modification apportée avec succès";
    }
   if(isset($_FILES['fichier']) && !empty($_FILES['fichier'])){
    $nom_fichier = $_FILES['fichier']['name'];
    $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
    $extensions_autorisees = array('mp4', 'png', 'jpg', 'gif', 'jpeg', 'avi', 'pdf',  'doc', 'docx', 'mp3','xlsx', 'docx', 'xls', 'mkv', 'mov', 'wmv', 'flv', 'mpeg', 'mpg', 'webm', '3gp', 'm4v', 'ogv');
  
    if (in_array($extension, $extensions_autorisees)) {
  
      $unique_id = uniqid();
      $destination = '../fichier/' . $unique_id . '.' . $extension;
      $nom_du_fichier =  $unique_id . '.' . $extension;
  
      move_uploaded_file($_FILES['fichier']['tmp_name'], $destination);
      $update_fichier = $bdd->prepare("UPDATE produit SET fichier = ? WHERE id_produit = ? ");
      $update_fichier->execute(array($nom_du_fichier, $id_produit));
      header('location:modifier_produit?type=produit&modifier='.$id_produit);
      $erreur = "Modification apportée avec succès";
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
tr, th, td{
      border: 2px solid royalblue;
    }
    thead{
      background-color: royalblue;
    }
</style>
</head>

<body>
            <nav class="navbar navbar-expand bg-white navbar-white sticky-top px-4 py-0">
               
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="bi bi-activity"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">
                <div class="nav-item dropdown">
                        <a href="liste_produit" class="nav-link">
                            <i class="bi bi-box-arrow-right text-primary display-6 me-lg-2"></i>
                            <span class="badge bg-primary badge-number"></span>
                        </a>
                    </div>
                </div>
            </nav>
           

            <div class="container-fluid pt-4 px-4">
                <div class="bg-white shadow-lg rounded p-4">
                   
                   
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                        <div class="shadow-lg p-3 mb-5  rounded text-white" style="background-color: royalblue;">
                  <div class="section-header">
                    <div class="">
                    <h2 class="text-center pb-0 fs-4" style="font-weight:900;"><a href="https://esemebe-business.com" class="text-white" style="font-weight:900;">Esembe Business</a></h2>
                    <h3 class="text-center text-warning pb-0 fs-4" style="font-weight:900;">Modifier <?=$r['nom_produit'] ?></h3>
                    </div>
                  
                  </div>     
                  <hr>
        </div>
                        <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                        
                        <tbody>
                          <tr>
                            <td>Date ajout</td>
                            <td><?=$r['date_ajout'] ?></td>
                          </tr>
                          <tr>
                          <td>Nom produit</td>
                            <td><?=$r['nom_produit'] ?></td>
                          </tr>
                          <td>Type produit</td>
                            <td><?=$r['type_produit'] ?></td>
                          </tr>
                          <tr>
                            <td>Prix achat</td>
                            <td><?=$r['prix_achat'] ?>FC</td>
                          </tr>
                          
                          <tr>
                            <td>Prix vente</td>
                            <td><?=$r['prix_vente'] ?>FC</td>
                          </tr>
                          
                          <tr>
                            <td>Quantité</td>
                            <td><?=$r['quantite'] ?></td>
                          </tr>
                          <tr>
                            <td>Stock</td>
                            <td><?=$r['stock'] ?> </td>
                          </tr>
                          <tr>
                            <td>Description</td>
                            <td><?=$r['description'] ?> </td>
                          </tr>
                          <tr>
                            <td>Fichier</td>
                            <td>
                              <a href="../fichier/<?=$r['fichier'] ?>">
                                <img src="../fichier/<?=$r['fichier'] ?>" style="width:100%;height:auto;" alt="">
                              </a> 
                            </td>
                          </tr>
                         
                        </tbody>
                      </table>
                    </div>
                    </div>
          <div class="col-lg-8 col-md-8 col-12">
            <form class="row g-3 needs-validation" enctype="multipart/form-data" novalidate method="post">
               
               <?php
               if(isset($erreur)) {
                echo '<font color="red">'.$erreur."</font>";
                }
               ?>
               <div class="col-12">
                <label for="nom_produit" class="form-label">Nom produit</label>
                  <input type="text" class="form-last-name form-control" placeholder="" id="nom_produit" name="nom_produit" value="<?php if(isset($nom_produit)) { echo $nom_produit; } ?>" />
                  <div class="invalid-feedback">Veuillez saisir le nom du produit.</div>
              </div>

              <div class="col-12">
                <label for="type_produit" class="form-label">Type produit</label>
                <select name="type_produit" id="type_produit" class="form-control">
                  <option value="Gros">En gros</option>
                  <option value="Détails">En détails</option>
                </select>
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
                    

              <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <label for="quantite_produit" class="form-label">Quantité</label>
                  <input type="text" class="form-last-name form-control" placeholder="" id="quantite_produit" name="quantite_produit" value="<?php if(isset($quantite_produit)) { echo $quantite_produit; } ?>" />
                  <div class="invalid-feedback">Veuillez saisir la quantité du produit.</div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                <label for="stock_produit" class="form-label">Stock</label>
                  <input type="text" class="form-last-name form-control" placeholder="" id="stock_produit" name="stock_produit" value="<?php if(isset($stock_produit)) { echo $stock_produit; } ?>" />
                  <div class="invalid-feedback">Veuillez saisir le stock.</div>
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
                    <input type="file" class="form-control" name="fichier" id="demo" onchange="readFile();" accept="file/*">
                    </span>
                <textarea style="height: 50px;" class="form-control" placeholder="Description..." name="description" id="description" rows="4" cols="50"></textarea>
                </div>
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
        
    
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
   
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="js/main.js"></script>
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
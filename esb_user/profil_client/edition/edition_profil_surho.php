<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: ../connexion/login/connexion_esembe.php");
}
require_once('../../../connexiondb.php');
function insulte($chaine) {
  $insultes = array("abruti", "salope", "idiot", "fou", "folle", "putain", "impoli", "mal éduqué", "absurde", "enculé", "con", "pute", "merde", "pd", "connard", "aller niquer sa mère", "aller se faire enculer", "aller se faire endauffer", "aller se faire foutre", "aller se faire mettre", "andouille", "appareilleuse", "assimilé", "astèque", "avorton", "bande d’abrutis", "bâtard", "bellicole", "bête", "bête à pleurer", "bête comme ses pieds", "bête comme un chou", "bête comme un cochon", "biatch", "bic", "bicot", "bite", "bitembois", "Bitembois", "bordille", "boudin", "bouffon", "bougnoul", "bougnoule", "Bougnoulie", "bougnoulisation", "bougnouliser", "bougre", "boukak", "boulet", "bounioul", "bourdille", "branleur", "brigand", "brise-burnes", "cacou", "cafre", "cageot", "caldoche", "casse-bonbon", "casse-couille", "casse-couilles", "cave", "chachar", "chagasse", "charlot de vogue", "bite", "fesse", "pénis", "vagin", "sein", "chauffard", "chien de chrétien", "chiennasse", "chienne", "chier", "chinetoc", "chinetoque", "chintok", "chleuh" , "chnoque", "citrouille", "coche", "colon", "con", "con comme la lune", "con comme la Lune", "con comme ses pieds", "con comme un balai", "con comme un manche", "con comme une chaise", "con comme une valise sans poignée", "conasse", "conchier", "connard", "connarde", "connasse", "counifle", "courtaud", "crétin", "crevure", "cricri", "crotté", "crouillat", "crouille", "croûton", "débile", "doryphore", "doxosophe", "doxosophie", "drouille", "du schnoc", "ducon", "duconnot", "dugenoux", "dugland", "duschnock", "emmanché", "emmerder", "emmerdeur", "emmerdeuse", "empafé", "empapaouté", "enculé", "enculé de ta race", "enculer", "enfant de putain", "enfant de pute", "enfant de salaud", "enflure", "enfoiré", "envaselineur", "épais", "espèce de", "espingoin", "étron", "face de chien", "face de pet", "face de rat", "FDP", "fell", "fils de bâtard", "fils de chien", "fils de chienne", "fils de garce", "fils de putain", "fils de pute", "fils de ta race", "fiotte", "folle", "fouteur", "fripouille", "frisé", "fritz", "Fritz", "fumier", "garage à bite", "garce", "gaupe", "GDM", "gland", "glandeur", "glandeuse", "glandouillou", "glandu", "gnoul", "gnoule", "Godon", "gogol", "goï", "gouilland", "gouine", "gourde", "gourgandine", "grognasse", "gueniche", "guide de merde", "guindoule", "habitant", "halouf", "imbécile", "incapable", "islamo-gauchisme", "jean-foutre", "jeannette", "journalope", "Khmer rouge", "Khmer vert", "kikoo", "kikou", "Kraut", "lâche", "lâcheux", "lavette", "lopette", "magot", "makoumé", "mal blanchi", "manche", "mange-merde", "mangeux de marde", "marchandot", "margouilliste", "marsouin", "mauviette", "melon", "merdaille", "merdaillon", "merde", "merdeux", "merdouillard", "michto", "minable", "minus", "misérable", "moinaille", "moins-que-rien", "monacaille", "mongol");
  
      foreach($insultes as $insulte) {
          if(stripos($chaine, $insulte) !== false) {
              return true;
          }
      }
  
      return false;
  }
  
if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom']) {
    $newnom = htmlspecialchars($_POST['newnom']);
    $nomlength = strlen($newnom);
 
    if($nomlength >= 4 AND $nomlength <=255) {

    if(!insulte(strtolower($newnom))) {
      $nom = ucfirst(strtolower($newnom));
    $insertnom = $bdd->prepare("UPDATE membre_esembe SET nom = ? WHERE id = ?");
    $insertnom->execute(array($nom, $_SESSION['id']));
    
    
    header('Location: ../mon_profil?id='.$_SESSION['id']);
    }else{
      $msg = "Votre nom ne peut pas contenir une insulte !";
    }
  }else{
    $msg = "Votre nom doit être compris entre 4 et 255 caractères !";
  }
}

if(isset($_POST['newpostnom']) AND !empty($_POST['newpostnom']) AND $_POST['newpostnom'] != $user['postnom']) {
  $newpostnom = htmlspecialchars($_POST['newpostnom']);

  if(!insulte(strtolower($newpostnom))) {
    $postnom = ucfirst(strtolower($newpostnom));
  $insertpostnom = $bdd->prepare("UPDATE membre_esembe SET postnom = ? WHERE id = ?");
  $insertpostnom->execute(array($postnom, $_SESSION['id']));
  
  
  header('Location: ../mon_profil?id='.$_SESSION['id']);
  }else{
    $msg = "Votre nom ne peut pas contenir une insulte !";
  }
}

if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom']) {
  $newprenom = htmlspecialchars($_POST['newprenom']);
  $prenomlength = strlen($newprenom);
 
  if($prenomlength >= 4 AND $prenomlength <=255) {

  if(!insulte(strtolower($newprenom))) {
    $prenom = ucfirst(strtolower($newprenom));
  $insertprenom = $bdd->prepare("UPDATE membre_esembe SET prenom = ? WHERE id = ?");
  $insertprenom->execute(array($prenom, $_SESSION['id']));
  
 
  header('Location: ../mon_profil?id='.$_SESSION['id']);
  }else{
    $msg = "Votre prenom ne peut pas contenir une insulte !";
  }
}else{
  $msg = "Votre prenom doit être compris entre 4 et 255 caractères !";
}
}

if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
    $newmail = htmlspecialchars($_POST['newmail']);
    $insertmail = $bdd->prepare("UPDATE membre_esembe SET mail = ? WHERE id = ?");
    $insertmail->execute(array($newmail, $_SESSION['id']));
    
 
 header('Location: ../mon_profil?id='.$_SESSION['id']);
}

if(isset($_POST['site']) AND !empty($_POST['site']) AND $_POST['site'] != $user['mail']) {
  $newsite = htmlspecialchars($_POST['site']);
  $sitelength = strlen($newsite);
 
  if($sitelength >= 4 AND $sitelength <=255) {
  if(!insulte(strtolower($newsite))) {
  $insertsite = $bdd->prepare("UPDATE membre_esembe S SET site = ? WHERE id = ?");
  $insertsite->execute(array($newsite, $_SESSION['id']));
  

header('Location: ../mon_profil?id='.$_SESSION['id']);
}else{
  $msg = "Le nom de votre site ne peut pas contenir une insulte !";
}
}else{
  $msg = "Le nom de votre site doit être compris entre 4 et 255 caractères !";
}
}


if(isset($_POST['phone']) AND !empty($_POST['phone']) AND $_POST['phone'] != $user['phone']) {
  $newphone = htmlspecialchars($_POST['phone']);

  $reqphone = $bdd->prepare("SELECT * FROM membre_esembe WHERE phone = {$newphone} ");
  $reqphone->execute(array($newphone));
  $phonexist = $reqphone->rowCount();
  if($phonexist == 0){
    $newphone = htmlspecialchars($_POST['phone']);
  $insertphone = $bdd->prepare("UPDATE membre_esembe SET phone = ? WHERE id = ?");
  $insertphone->execute(array($newphone, $_SESSION['id']));
  

  header('Location: ../mon_profil?id='.$_SESSION['id']);
}else{
  $msg = "Numéro de téléphone déjà utilisé !";
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
  <link href="img/logorudless.jp" rel="apple-touch-icon">


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

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Modifier mon profil</h5>
                    <p class="text-center small">Veuillez choisir les informatins à modifier</p>
                  </div>
                  <?php
         if(isset($msg))
         {
            echo '<font color="red">'.$msg."</font>";
         }
         ?>		
                  <form method="POST" action="" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <label for="nom" class="form-label">Nom</label>
                      <input type="text" name="newnom" class="form-control" value="<?php echo $user['nom']; ?>" id="nom">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <label for="potsnom" class="form-label">Postnom</label>
                      <input type="text" name="newpostnom" class="form-control" value="<?php echo $user['postnom']; ?>" id="postnom">
                    </div>

                    <div class="col-12">
                      <label for="newprenom" class="form-label">Prénom</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                        <input type="text" name="newprenom" class="form-control" value="<?php echo $user['prenom']; ?>" id="newprenom">
                       
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <label for="mail" class="form-label">Adresse mail</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope"></i></span>
                      <input type="email" name="newmail" class="form-control" value="<?php echo $user['mail']; ?>" id="mail">
                      
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                      <label for="phone" class="form-label">Téléphone</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-phone"></i></span>
                      <input type="tel" name="phone" class="form-control" value="<?php echo $user['phone']; ?>" id="phone">
                    
                      </div>
                    </div>

                  
                    <div class="col-12">
                      <input  class="btn btn-primary w-100" type="submit" value="Mettre à jour mon profil !" />
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
<?php   
}
else {
   header("Location: ../../");
}
?>
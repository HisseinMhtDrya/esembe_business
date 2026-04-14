<?php
session_start();

if(!isset($_SESSION['nom']) || !isset($_SESSION['prenom']) || !isset($_SESSION['mail'])) {
  header('Location: LOGIN/connexionSurho.php'); // Si les informations de session ne sont pas disponibles, rediriger vers la page de connexion
  exit;
}

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$mail = $_SESSION['mail'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Connexion à la base de données
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "espace_membre";

   $conn = mysqli_connect($servername, $username, $password, $dbname);

   // Vérifier la connexion
   if (!$conn) {
       die("Erreur de connexion à la base de données: " . mysqli_connect_error());
   }
   if(!empty($_POST['profession'])){
   $attentes = $_POST['profession']; // Récupérer les valeurs du tableau
   $attentesEscaped = array(); // Tableau pour stocker les valeurs échappées
    
   // Échapper chaque valeur du tableau $attentes
   foreach ($attentes as $attente) {
       $attentesEscaped[] = mysqli_real_escape_string($conn, $attente);
   }

   $profession = implode(", ", $attentesEscaped);

   // Récupérer les autres champs à renseigner ici

   // Insérer les informations supplémentaires dans la table utilisateur
   $sql = "UPDATE surho SET profession=' $profession' WHERE nom='$nom' AND mail='$mail'";

   if (mysqli_query($conn, $sql)) {
    header('Location: profession_inscription.php'); 
   exit;
   } else {
       echo "Erreur lors de l'enregistrement des informations : " . mysqli_error($conn);
   }
  }else{
    $erreur = "Veuilez indiquer votre profession !";
   }

   mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RudLess</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/logorudless.jpeg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
<main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-md-8 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">

                  <h1 class="text-center">Bienvenue sur <a href="https://www.rudless.com">RudLess</a> <?php echo $prenom; ?> <?php echo $nom; ?></h1>
   <p class="text-center">
      Merci de votre inscription ! Nous avons besoin de quelques informations supplémentaires pour mieux vous connaître.<br>
      Veuillez cocher l'un des champs suivants :
   </p>

   <!-- Formulaire pour demander les informations supplémentaires -->
  
   <form action="" method="post">
        <h3 class="text-center text-info">Que faites-vous dans la vie ? </h3>
        <?php
         if(isset($erreur))
         {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>		
        <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Elève">Elève<br>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Etudiant(e)">Etudiant(e)<br>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Etudiant(e) en ligne">Etudiant(e) en ligne<br>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Enseignant(e)">Enseignant(e)<br>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Parent">Parent<br>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Professionnel(le) en reconversion">Professionnel(le) en reconversion<br>
    </div>
     <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Professionnel(le) en quête de perfectionnement">Professionnel(le) en quête de perfectionnement<br>
     </div>
     <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Employé(e)">Employé(e)<br>
     </div>
     <div class="form-check">
        <input class="form-check-input" type="checkbox" name="profession[]" value="Autre">Autre<br>
     </div>
        <!-- Ajoutez plus de checkboxes si nécessaire -->
        <br>
        <input type="submit" class="btn btn-primary w-100" value="Valider et continuer">
    </form>

    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main><!-- End #main -->

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

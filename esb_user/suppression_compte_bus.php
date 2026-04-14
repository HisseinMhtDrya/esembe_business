<?php
session_start();

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['id'])){
  header("location: login/ConnexionSurho.php");
}

// Récupérer les informations de l'utilisateur en session
$id = $_SESSION['id'];

// Se connecter à la base de données
$connexion = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');



// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Récupérer les informations de l'utilisateur depuis la table 'surho'
$requete = $connexion->prepare('SELECT * FROM surho WHERE id = :id');
$requete->bindParam(':id', $_SESSION['id']);
$requete->execute();
$utilisateur = $requete->fetch();

        // Récupération des données du formulaire
        $nom = htmlspecialchars(trim($_POST['nom']));
        $mail = htmlspecialchars(trim($_POST['mail']));
        $motDePasse = htmlspecialchars(trim($_POST['mdp']));
        
        // Ignorer les espaces dans l'adresse e-mail et le mot de passe
        $nom = str_replace(' ', '', $nom);
        $mail = str_replace(' ', '', $mail);
        $motDePasse = str_replace(' ', '', $motDePasse);

    // Comparer les informations saisies avec celles de la base de données
    if ($utilisateur['nom'] === $nom &&
        $utilisateur['mail'] === $mail &&
        password_verify($motDePasse, $utilisateur['motdepasse'])) {

        // Supprimer le compte de l'utilisateur de la table 'surho'
        $requete = $connexion->prepare('DELETE FROM surho WHERE id = :id');
        $requete->bindParam(':id', $_SESSION['id']);
        $requete->execute();

        // Supprimer les relations associées à cet utilisateur dans la table 'relation'
        $requete = $connexion->prepare('DELETE FROM relation WHERE id_demandeur = :id OR id_receveur = :id');
        $requete->bindParam(':id', $_SESSION['id']);
        $requete->execute();

        // Rediriger vers une page de confirmation
        session_unset();
        session_destroy();
        session_start();
        $_SESSION['nom'] = $nom;
        $_SESSION['mail'] = $mail;
        header('Location: console_suppression_compte.php');
        exit();
    } else {
        $erreur = 'Les informations saisies sont incorrectes';
    }
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
  
  <link href="assets/css1/style.css" rel="stylesheet">
 
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-12 d-flex flex-column align-items-center justify-content-center">

          
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight:900;">Suppression Compte</h5>
                    <p class="text-center small">Veuillez fournir quelques informations pour supprimer votre compte</p>
                  </div>
    <?php if (isset($erreur)) : ?>
        <p style="color:red;"><?php echo $erreur; ?></p>
    <?php endif; ?>

    <form method="post" action="" class="registration-form row g-3 needs-validation" novalidate>
    <div class="row">
    <div class="col-12">
        <label for="nom">Nom </label>
        <input type="text" class="form-control" name="nom" id="nom" required>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" name="mail" id="email" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
        <label for="mot_de_passe">Mot de passe </label>
        <input type="password" class="form-control" name="mdp" id="mot_de_passe" required><br>
        </div>
        <div class="col-12">
        <input type="submit" name="submit" class="btn btn-primary w-100" value="Supprimer mon compte">
        </div>
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
  <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
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
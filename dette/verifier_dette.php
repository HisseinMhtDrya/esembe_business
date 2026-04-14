<?php
session_start();
require_once('../connexiondb.php');

if(isset($_POST['valider'])){
  if(!empty($_POST['code'])){
   $code = htmlspecialchars(intval($_POST['code']));
   $verif_client = $bdd->prepare("SELECT * FROM dette_client WHERE code = :code");
   $verif_client->execute(array(':code' => $code));
   if($verif_client->rowCount() == 1){
     $info_dette = $verif_client->fetch();
     $_SESSION['id_client_dette'] = $info_dette['id'];
     header('location:afficher_dette_client');
   }else{
    $erreur = "Code incorrect";
   }
  }else{
    $erreur = "Vous devez saisir votre code client";
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

              
              <div class="card mb-3">
              <div class="card-body" style="border: 4px solid royalblue">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Vérification <i class="bi bi-bug"></i> </h5>
                    <p class="text-center small">
                      Cher(e) client(e), pour des raisons de confidentialité, nous devons nous assurer que vous avez réellement une dette envers <a href="https://esembe-business.com">Esembe Business</a>.
                      Pour ce, nous vous prions de remplir le formulaire ci-dessous.
                    </p>
                  </div>

                  <form method="POST" class="row g-3 needs-validation" novalidate>
                    <?php
                    if(isset($erreur)) {
                        ?>
                        <div class="bg-danger py-2 text-center">
                          <span class="text-white text-center"><?=$erreur ?></span>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="col-12">
                      <div class="input-group has-validation">
                        <input type="number" name="code"  class="form-control" id="code" placeholder="Votre code client" required>
                        <div class="invalid-feedback">Veuillez saisir le code</div>
                      </div>
                    </div>

                   
                    <div class="col-12">
                    <input type="submit" class="btn btn-primary w-100" style="border-radius: 15px;" name="valider" value="Valider" class="btnLogin">
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
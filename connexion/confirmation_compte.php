<?php
session_start();
require_once('../connexiondb.php');

if(isset($_POST['confirme_compte'])) {
    if(isset($_POST['num_reference']) && !empty($_POST['num_reference'])){
        $num_ref = htmlspecialchars($_POST['num_reference']);
        $verif_paiement = $bdd->prepare("SELECT * FROM paiement WHERE numero_reference = :num_ref");
        $verif_paiement->execute(array(':num_ref' => $num_ref));
        if($verif_paiement->rowCount() > 0){
            $mail = htmlspecialchars($_POST['mail']);
            if( filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $req_mail =  $bdd->prepare("SELECT * FROM membre_tz WHERE mail = ?");
                $req_mail->execute(array($mail));
                if($req_mail->rowCount() == 0){
                    $erreur = "Adresse mail inconnue";
                }else{
                    $_SESSION['mail'] = $mail; 
                    $longueurKey = 7;
                    $code = "";
                    for($i=1;$i<$longueurKey;$i++) { 
                        $code .= mt_rand(0,9);
                    }
                    
                    $insert_code  = $bdd->prepare("INSERT INTO confirme_compte(mail, code) VALUES(?, ?)");
                    $insert_code->execute(array($mail, $code));
                    
                    $headers = "From: rudless@rudless.com\r\n";
                    $headers .= "Reply-To: taza@gmail.com\r\n";
                    $headers .= "Content-Type: text/html\r\n";
                    $to = $mail;
                    $subject = "Récupération du mot de passe";
                    $message = "salut cher(e) membre, voici votre code de confirmation : $code";
                    if (mail($to, $subject, $message, $headers)) {
                        echo "L'e-mail a été envoyé avec succès.";
                         
                        header("Location: verification_code?email=" . $mail);
                    } else {
                        echo "Une erreur s'est produite lors de l'envoi de l'e-mail.";
                    }
                    header("Location: verification_code?email=" . $mail);
                }
            }else{
                $erreur = "Votre adresse mail n'est pas valide";
            }
        }else{
            $erreur =  "Numéro inccorect. Veuillez réessayer !";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TaZa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="logorudless.jpeg" rel="icon">
  <link href="logorudless.jpeg" rel="apple-touch-icon">

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
   <style>
    .btnLogin{
      background:#ff00ff;
      color:#fff;
      padding:8px;
    }
   </style>

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

            

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2 py-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight: 900;color:#ff00ff;" >TaZa</h5>
                    <p class="text-center small">Veuillez saisir le numéro de référence pour confirmer votre compte. Nous vous enverrons un code de confirmation par mail.</p>
                  </div>

                  <form class="row g-3 needs-validation" method="post" novalidate>
                    <?php
                      if(isset($erreur)) {
                    ?>
                       <span class="text-center text-danger"><?=$erreur?></span>
                    <?php
                    }
                    ?>
                    <div class="col-12">
                      <div class="input-group has-validation">
                        <input type="text" name="num_reference"  class="form-control" id="" placeholder="Numéro de référence..." required>
                        <div class="invalid-feedback">Veuillez saisir le numéro de référence</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="input-group has-validation">
                        <input type="email" name="mail"  class="form-control" id="" placeholder="Mail..." required>
                        <div class="invalid-feedback">Veuillez saisir votre adresse mail</div>
                      </div>
                    </div>

                    <div class="col-12">
                    <input type="submit" class="w-100 btnLogin" style="border-radius: 15px;" name="confirme_compte" value="Valider">
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
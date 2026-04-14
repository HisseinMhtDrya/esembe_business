<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=d_second;charset=utf8', 'root', '');

if (isset($_POST['envoyer'])) {
    // Récupération du code de validation entré par l'administrateur
    $notification = htmlspecialchars($_POST['message']);
    $sujet = htmlspecialchars($_POST['sujet']);

$req_mail = $bdd->prepare("SELECT * FROM surho WHERE type='Super Adminitrateur' ");
$req_mail->execute();
while ($row = $req_mail->fetch()) {
    $mail = $row['mail'];
    $prenom = $row['prenom'];
    $nom = $row['nom'];

$to = $mail;
$subject = $sujet;
$message = " cher(e) $prenom $nom, $notification  
 <html>
                        <body>
                           <div align='center'>
                              <a href='https://www.rudless.com'>Accéder au site !</a>
                           </div>
                        </body>
                     </html> ";

$headers = "From: rudless@rudless.com\r\n";
$headers .= "Reply-To: russellmk8299@gmail.com\r\n";
$headers .= "Content-Type: text/html\r\n";

if (mail($to, $subject, $message, $headers)) {
    echo "L'e-mail a été envoyé avec succès.";
} else {
    echo "Une erreur s'est produite lors de l'envoi de l'e-mail.";
}
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
  
  <link href="IMG/logorudless.jpeg" rel="icon">
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
         <img src="img/">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Espace d'administration</h5>
                    <p class="text-center small">Envoi e-mail aux utilisateurs</p>
                  </div>

                  <form method="POST" class="row g-3 needs-validation" novalidate>
                  <div class="col-12">
                  <label for="sujet">Sujet</label>
                          <input type="text" name="sujet" placeholder="Sujet..." class="form-first-name form-control" id="sujet">
                  </div>
                    <div class="col-12">
                      <label for="message" class="form-label">Message</label>
                      <textarea style="height: 75px;" class="form-control" placeholder="Dites un mot..." name="message" id="message" rows="4" cols="50" required></textarea>
                    </div>

                    <div class="col-12">
                    <input type="submit" class="btn btn-primary w-100" style="border-radius: 15px;" name="envoyer" value="Envoyer" class="btnLogin">
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

</body>

</html>
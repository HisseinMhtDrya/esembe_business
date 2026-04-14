<?php
session_start();
require_once('connexiondb.php');

?>
<!Doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Esembe Business</title>
    <meta name="description" content="Explorez RudLess Business pour trouver des outils puissants qui vous aideront à gérer et développer votre entreprise avec succès.">
    <meta name="keywords" content="Business, RudLess, outils puissants, gestion, développement, succès">

    <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
     
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
 
     <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
     <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
 
     <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
     
    
    <link rel="stylesheet" href="style/lightbox.css">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <link rel="stylesheet" href="css/bootstrap-shopping-carts.min.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      text-align: center;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: white;
      /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
      border-radius: 5px;
    }
    h4 {
      color: #007bff;
      font-weight:900;
    }
    p {
      margin-bottom: 20px;
    }
  </style>
  <title>Confirmation de commande</title>
</head>
<body>
  <div class="container">
  
    <section class="inner-page">
      <div class="container" data-aos="fade-up">
        <div class="card-body" style="border: 4px solid royalblue">
                  <div class="pt-4 pb-2">
                  <div class="shadow-lg p-3 mb-5  rounded text-white" style="background-color: royalblue;">
                  <div class="section-header">
                    <div class="">
                      <img src="img/logo_esembe.jpg" alt="" class="rounded-circle" style="height:40px; width:40px;">
                    <h2 class="text-center pb-0 fs-4" style="font-weight:900;"><a href="https://esembe.com" class="text-white" style="font-weight:900;">Esembe Business</a></h2>
                  <h3 class="text-center text-warning pb-0 fs-4" style="font-weight:900;">Confirmation de la commande</h3>
                    </div>
                  
                  </div>     
                  <hr>
        </div>
        
                    <div class="card">
                        <div class="card-body row">
                            <h4>Merci pour votre commande, <?=$_SESSION['prenom_client'] ?> <?=$_SESSION['nom_client'] ?> !</h4>
                            <p>Nous tenions à vous remercier chaleureusement pour votre confiance et pour avoir choisi notre boutique en ligne. Votre satisfaction est notre priorité absolue, c'est pourquoi nous mettons tout en oeuvre pour que votre expérience d'achat soit exceptionnelle.</p>
                            <p>Nous avons bien enregistré votre commande et vos informations. Soyez assuré(e) que notre équipe expédiera votre colis dans les plus brefs délais. Vous recevrez un email de confirmation dès que votre commande sera expédiée.</p>
                            <p>Si vous avez des questions concernant votre commande ou si vous avez besoin d'assistance, n'hésitez pas à nous contacter. Notre service client est là pour vous aider et répondre à toutes vos demandes.</p>
                            <p>Encore une fois, merci de nous avoir choisi. Nous sommes impatients de vous compter parmi nos clients satisfaits.</p>
                            <p>Bien cordialement.</p>
                            <h3 class="text-warning" style="font-weight:900;">L'équipe Esembe Business</h3></p>
                        </div>
                    </div>


                    <div class="text-center">
                    <div class="row">
                      <div class="col-6">
                       <p>
                        <a href="../" class="btn btn-danger text-white">Quitter</a>
                       </p>
                      </div>
                      <div class="col-6">
                       <p>
                        <a href="index" class="btn btn-primary text-white">Visiter notre page</a>
                       </p>
                      </div>
                    </div>
                    
                    </div>
      </div>
    </section>
  </div>
</body>
</html>
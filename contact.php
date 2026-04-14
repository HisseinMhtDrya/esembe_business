<?php
session_start();
require_once('connexiondb.php');

function insulte($chaine) {
  $insultes = array("abruti", "salope", "idiot", "fou", "folle", "putain", "impoli", "mal éduqué", "absurde", "enculé", "con", "pute", "merde", "pd", "connard", "aller niquer sa mère", "aller se faire enculer", "aller se faire endauffer", "aller se faire foutre", "aller se faire mettre", "andouille", "appareilleuse", "assimilé", "astèque", "avorton", "bande d’abrutis", "bâtard", "bellicole", "bête", "bête à pleurer", "bête comme ses pieds", "bête comme un chou", "bête comme un cochon", "biatch", "bic", "bicot", "bite", "bitembois", "Bitembois", "bordille", "boudin", "bouffon", "bougnoul", "bougnoule", "Bougnoulie", "bougnoulisation", "bougnouliser", "bougre", "boukak", "boulet", "bounioul", "bourdille", "branleur", "brigand", "brise-burnes", "cacou", "cafre", "cageot", "caldoche", "casse-bonbon", "casse-couille", "casse-couilles", "cave", "chachar", "chagasse", "charlot de vogue", "bite", "fesse", "pénis", "vagin", "sein", "chauffard", "chien de chrétien", "chiennasse", "chienne", "chier", "chinetoc", "chinetoque", "chintok", "chleuh" , "chnoque", "citrouille", "coche", "colon", "con", "con comme la lune", "con comme la Lune", "con comme ses pieds", "con comme un balai", "con comme un manche", "con comme une chaise", "con comme une valise sans poignée", "conasse", "conchier", "connard", "connarde", "connasse", "counifle", "courtaud", "crétin", "crevure", "cricri", "crotté", "crouillat", "crouille", "croûton", "débile", "doryphore", "doxosophe", "doxosophie", "drouille", "du schnoc", "ducon", "duconnot", "dugenoux", "dugland", "duschnock", "emmanché", "emmerder", "emmerdeur", "emmerdeuse", "empafé", "empapaouté", "enculé", "enculé de ta race", "enculer", "enfant de putain", "enfant de pute", "enfant de salaud", "enflure", "enfoiré", "envaselineur", "épais", "espèce de", "espingoin", "étron", "face de chien", "face de pet", "face de rat", "FDP", "fell", "fils de bâtard", "fils de chien", "fils de chienne", "fils de garce", "fils de putain", "fils de pute", "fils de ta race", "fiotte", "folle", "fouteur", "fripouille", "frisé", "fritz", "Fritz", "fumier", "garage à bite", "garce", "gaupe", "GDM", "gland", "glandeur", "glandeuse", "glandouillou", "glandu", "gnoul", "gnoule", "Godon", "gogol", "goï", "gouilland", "gouine", "gourde", "gourgandine", "grognasse", "gueniche", "guide de merde", "guindoule", "habitant", "halouf", "imbécile", "incapable", "islamo-gauchisme", "jean-foutre", "jeannette", "journalope", "Khmer rouge", "Khmer vert", "kikoo", "kikou", "Kraut", "lâche", "lâcheux", "lavette", "lopette", "magot", "makoumé", "mal blanchi", "manche", "mange-merde", "mangeux de marde", "marchandot", "margouilliste", "marsouin", "mauviette", "melon", "merdaille", "merdaillon", "merde", "merdeux", "merdouillard", "michto", "minable", "minus", "misérable", "moinaille", "moins-que-rien", "monacaille", "mongol");
  
      foreach($insultes as $insulte) {
          if(stripos($chaine, $insulte) !== false) {
              return true;
          }
      }
  
      return false;
  }

if(isset($_POST['valider'])){
   $nom = htmlspecialchars($_POST['nom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $phone = htmlspecialchars($_POST['phone']);
   $mail = htmlspecialchars($_POST['mail']);
   $sujet = htmlspecialchars($_POST['sujet']);
   $message = htmlspecialchars($_POST['message']);;

   if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['sujet']) AND !empty($_POST['message']) AND !empty($_POST['phone']) AND !empty($_POST['mail'])) {
      $nomlength = strlen($nom);
      $sujetlength = strlen($sujet);
     
      if($nomlength >= 4 AND $nomlength <=255 AND $sujetlength >=4 AND $sujetlength <=255) {
        if(!insulte(strtolower($message))) {
            $message = htmlspecialchars($_POST['message']);
            if(!insulte(strtolower($nom))) {
              $nom = ucfirst(strtolower($nom));
                if(!insulte(strtolower($sujet))) {
                  $sujet = htmlspecialchars($_POST['sujet']);
        
                    // Vérifier si l'adresse mail est saisie et est valide
                     if(empty($mail) || filter_var($mail, FILTER_VALIDATE_EMAIL)) {
             
                      $insertcontact = $bdd->prepare("INSERT INTO contact_rud(nom, prenom, mail, phone, sujet, message, date_contact, lu) VALUES(?, ?, ?, ?, ?, ?, NOW(), ?)");
                      $insertcontact->execute(array($nom, $prenom, $mail, $phone, $sujet, $message, 0));
        
                     $erreur = "Votre message a bien été envoyé. Merci beaucoup !!!";
                     }else{
                        $erreur = "Votre adresse mail n'est pas valide !";
                     }
                    }else{
                        $erreur = "Votre sujet ne peut pas contenir une insulte !";
                    }
                }else{
                    $erreur = "Votre nom ne peut pas contenir une insulte !";
                }
            }else{
                $erreur = "Votre message ne peut pas contenir une insulte !";
            }
    } else {
       $erreur = "Votre nom ou prenom doit être compris entre 4 et 255 caractères !";
    }
}else{
  $erreur = "Veuillez compléter tous les champs !";
}
}         
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RudLess Business</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="img/logorudless.jpeg" rel="icon">
  <link href="img/logorudless.jpeg" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/style_icon.css" rel="stylesheet">
  <script>
    function afficherDateEtHeure() {
      var joursSemaine = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
      var maintenant = new Date();
      var jour = joursSemaine[maintenant.getDay()];
      var date = maintenant.getDate();
      var mois = maintenant.getMonth() + 1;
      var annee = maintenant.getFullYear();
      var heure = maintenant.getHours();
      var minute = maintenant.getMinutes();
      var seconde = maintenant.getSeconds();

      var dateEtHeure = ' ' + jour + ', ' + date + '/' + mois + '/' + annee + '  ' + heure + ':' + minute + ':' + seconde;
      document.getElementById('dateEtHeure').innerHTML = dateEtHeure;
      setTimeout(afficherDateEtHeure, 1000); // Actualise toutes les secondes
    }
  </script>
  <style>
    .badge-number {
  position: relative;
  inset: -8px 5px auto auto;
  font-weight: normal;
  font-size: 15px;

  border-radius:40px;
}
  </style>

</head>

<body onload="afficherDateEtHeure()">

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
      <i class="bi bi-phone d-flex align-items-center"><span><a href="tel:243979880155">+243979880155</a></span></i>
      <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"> <span class="text-danger" id="dateEtHeure"></span></i>
    </div>
  </section>


  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

   

  <section id="contact" class="contact">
    <div class="container">
        <a href="index.php" class="btn btn-danger">Quitter</a>
      <div class="section-title">
        <h2><span>Nous</span> Contacter</h2>
        <p>Pour toute préoccupation, veuillez nous contacter.</p>
      </div>
    </div>

    
    <div class="container mt-5">

      <div class="info-wrap">
        <div class="row">
          <div class="col-lg-3 col-md-6 info">
            <i class="bi bi-geo-alt"></i>
            <h4>Location:</h4>
            <p>RDC/Kinshasa<br>Lemba, N° 535022</p>
          </div>

          <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
            <i class="bi bi-clock"></i>
            <h4>Heures d'ouberture:</h4>
            <p>Lundi-Samedi:<br>11:00 AM - 23:00 PM</p>
          </div>

          <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
            <i class="bi bi-envelope"></i>
            <h4>Email:</h4>
            <p><a href="mailto:russellmk8299@gmail.com">russellmk8299@gmail.com</a><br>
              <a href="mailto:rudless@gmail.com">rudless@gmail.com</a></p>
          </div>

          <div class="col-lg-3 col-md-6 info mt-4 mt-lg-0">
            <i class="bi bi-phone"></i>
            <h4>Appel:</h4>
            <p><a href="tel:243979880155">243979880155</a></p>
          </div>
        </div>
      </div>

      <form action="" method="post">
        
          <?php
             if(isset($erreur)){
          ?>
          <div class="text-center bg-danger text-white mb-2 mt-2 p-2">
             <p class="text-white"><?=$erreur ?></p>
             </div>
          <?php
             }
          ?>
       
        <div class="row">
          <div class="col-6 form-group mb-2 mt-2">
            <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom" required>
          </div>
          <div class="col-6 form-group mb-2 mt-2">
            <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Prenom" required>
          </div>
          <div class="col-6 form-group mt-3 mt-md-0">
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Téléphone" required>
          </div>
          <div class="col-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="mail" id="mail" placeholder="Email" required>
          </div>
        </div>
        <div class="form-group mt-3">
          <input type="text" class="form-control" name="sujet" id="sujet" placeholder="Sujet" required>
        </div>
        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Message..." required></textarea>
        </div>
        
        <div class="text-center mt-2">
          <input type="submit" name="valider" value="Envoyer" class="btn btn-danger">
        </div>
      </form>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span>R-Bus</span>
          </a>
          <p>
            Suivez-nous sur les réseaux sociaux pour ne manquer aucune promotion ou nouveauté
          </p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Liens utiles</h4>
          <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">A propos</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Conditions</a></li>
            <li><a href="#">Politique</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Nos Services</h4>
          <ul>
            <li><a href="#">Livraison rapide et fiable</a></li>
            <li><a href="#">Suivi de commande</a></li>
            <li><a href="#">Emballage écologique</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Service après-vente</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Nous contacter</h4>
          <p>Kinshasa/DRC</p>
          <p>Kinshasa, N° 535022</p>
          <p>DRC</p>
          <p class="mt-4"><strong>Phone :</strong> <span><a href="tel:243979880155" class="text-white">+243979880155</a></span></p>
          <p><strong>Email :</strong> <span><a href="mailto:rudless8299@gmail.com" class="text-white">rudless8299@gmail.com</a></span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>Inscrivez-vous à notre newsletter pour recevoir des offres exclusives et des réductions</p>
      <a href="abonnement.html" class="btn btn-danger">S'abonner</a>
      <p>&copy; <span><script>document.write(new Date().getFullYear())</script></span> <strong class="px-1">Rudless Business</strong> <span>Tous droits réservés</span></p>
      <div class="credits">
        Développé par <a href="https://rudless.com" class="text-white">RudLess</a>
      </div>
    </div>

  </footer><!-- End Footer -->


 
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/script.js"></script>

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
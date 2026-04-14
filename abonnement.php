<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RudLess Business</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/logorudless.jpeg" rel="icon">
  <link href="img/logorudless.jpeg" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
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

   
<!-- ======= Book A Table Section ======= -->
<section id="book-a-table" class="book-a-table">
  <div class="container">

    <div class="section-title">
      <h2>S'<span>abooner</span></h2>
      <p>Inscrivez-vous à notre newsletter pour recevoir des offres exclusives et des réductions.</p>
    </div>

    <form action="" method="post" role="form" class="php-email-form">
      <div class="row">
       
        <div class="col-lg-6 col-6 col-md-6 form-group mt-3 mt-md-0">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Veuillez saisir une adresse mail valide">
          <div class="validate"></div>
        </div>
        <div class="col-lg-6 col-6 col-md-6 form-group mt-3 mt-md-0">
          <input type="email" class="form-control" name="phone" id="phone" placeholder="Confirmer email" data-rule="email" data-msg="Veuillez saisir une adresse mail valide">
          <div class="validate"></div>
        </div>
        <div class="col-12">
          <div class="text-center"><button type="submit">S'abonner</button></div>
        </div>
    </form>

  </div>
</section><!-- End Book A Table Section -->

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
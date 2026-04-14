<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Esembe Buzz</title>
  <meta name="description" content="Bienvenue sur ensembe buzz - votre destination pour le meilleur du commerce en ligne et des services de qualité. Découvrez nos services, avantages et opportunités uniques.">
  <meta name="keywords" content="commerce en ligne, services, avantages, opportunités, ensembe buzz">
 
  <meta name="theme-color" content="#0d66ff">

  <meta property="og:image" content="https://esembe-buzz.com/img/logo_esembe.jpg" />
  <meta property="og:image:secure_url" content="https://esembe-buzz.com/img/logo_esembe.jpg" />
  <meta property="og:image:type" content="image/jpeg" />
  <meta property="og:image:width" content="400" />
  <meta property="og:image:height" content="300" />
  <meta property="og:image:alt" content="" />

  <link href="img/logo_esembe.jpg" rel="icon">
  <link href="img/logo_esembe.jpg" rel="apple-touch-icon">

 
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style_nav.css">
  <link rel="stylesheet" href="css/style_surho.css">
  
<script>
function togglePopup() {
var popup = document.getElementById('popup');
if (popup.style.display === "none" || !popup.style.display) {
  popup.style.display = "block";
  setTimeout(() => popup.style.opacity = 1, 10);
  setTimeout(() => popup.style.transform = "translateY(0)", 20);
  setTimeout(() => popup.style.display = "none", 10000);
  setTimeout(() => {
    popup.style.opacity = 0;
    popup.style.transform = "translateY(100%)";
    setTimeout(() => popup.style.display = "none", 1000);
  }, 9000);
} else {
  popup.style.opacity = 0;
  popup.style.transform = "translateY(100%)";
  setTimeout(() => popup.style.display = "none", 1000);
}
}

setTimeout(() => {
var popup = document.getElementById('popup');
if (popup.style.display === "none" || !popup.style.display) {
  popup.style.display = "block";
  setTimeout(() => popup.style.opacity = 1, 10);
  setTimeout(() => popup.style.transform = "translateY(0)", 20);
  setTimeout(() => popup.style.display = "none", 10000);
  setTimeout(() => {
    popup.style.opacity = 0;
    popup.style.transform = "translateY(100%)";
    setTimeout(() => popup.style.display = "none", 1000);
  }, 9000);
}
}, 3000);
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
      setTimeout(afficherDateEtHeure, 1000); 
    }
</script>
</head>

<body class="index-page" onload="afficherDateEtHeure()">
  <section id="topbar" class="d-flex align-items-center fixed-top topbar-transparent">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
      <i class="bi bi-phone d-flex align-items-center"><span><a href="tel:243992854177">+243992854177</a> /<a href="tel:243824195733">+243824195733</a></span></i>
      <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"> <span style="color:#3366ff;" id="dateEtHeure"></span></i>
    </div>
  </section>
  <header id="header" class="header align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center autre_nav">

      <a href="" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename" style="font-weight: 900;color: #3366ff;font-size: 30px;">Esembe</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a class="nav-link scrollto active" href="index">Accueil</a></li>
          <li><a class="nav-link scrollto" href="apropos">A propos</a></li>
          <li><a class="nav-link scrollto" href="services">Services</a></li>
          <li><a class="nav-link scrollto" href="specialite">Spécialités</a></li>
          <li><a class="nav-link scrollto" href="produits">Produits</a></li>
          <li class="dropdown"><a href="#"><span>Programmes</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>

              <li class="dropdown"><a href="#"><span>Esembe</span> <i class="bi bi-chevron-right toggle-dropdown"></i></a>
                <ul>
                <li><a href="https://step-forward.esembe-buzz.com" target="_blank">Step Forward</a></li>
                </ul>
              </li>
            </ul>
          </li>
         
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list" style="color:#3366ff;"></i>
      </nav>
      <?php
         if(!isset($_SESSION['id'])){
      ?>
      <a href="connexion/login/connexion_esembe" class="btn-getstarted">Se connecter</a>
      <?php
      }else{
        ?>
        <a href="esb_user/profil_esb" class="btn-getstarted"><i class=" bi bi-person-circle"></i></a>
        <a href="connexion/deconnexion" class="btn-getstarted"><i class=" bi bi-box-arrow-right"></i></a>
        <?php
      }
      ?>
    </div>
    <div class="container-fluid autre py-1" style="background:#3366ff;">
     
     <div class="d-flex align-items-center">
        <div class="elements d-flex">
          <a href="afficher_panier_client" target="_blank" class="fw-600 font-xssss text-primary">
            <i class="bi bi-cart text-white" style="font-size:26px;"></i>
            <span class="badge bg-warning badge-number">
              <span id="panier"></span>
            </span>
          </a>
        </div>
        <form action="" method="get" class="d-flex ms-auto">
          <input type="search" style="width: 100%;border: 1 solid #000;outline: none;box-shadow: none;" class="form-control search-input" placeholder="Recherche..." name="query" id="query">
          <button type="submit" class="btn_search"><i class="bi bi-search"></i></button>
        </form>
     </div>

    </div>
  </header>
<?php
session_start();
require_once('connexiondb.php');
require_once('update_status.php');
require_once('recup_produit.php');
function NettoyerDonnee($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(isset($_SESSION['client_id'])){
  $client_id = $_SESSION['client_id'];
}else{
  $unique_id = uniqid();
  $_SESSION['client_id'] = $unique_id;
}


if (!empty($_SERVER['HTTP_CLIENT_IP']))
{
      $ip=$_SERVER['HTTP_CLIENT_IP'];
}

else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
{
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
      $ip=$_SERVER['REMOTE_ADDR'];
}

  $query = $bdd->prepare("INSERT INTO visiteur (ip_visiteur, date_visite) VALUES (?, NOW())");
  $query->execute(array($ip));
  
?>
<?php
require_once('header.php');
?>
 <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">
        <?php
          $messages = ['Découvrez notre sélection de produits de haute qualité à des prix imbattables. Vous satisfaire est notre devoir <i class="bi bi-emoji-smile"></i>', 'Votre satisfaction est notre priorité - retour gratuit sous 30 jours ', 'offres spéciales pour les nouveaux clients - bénéficiez de 10% de réduction sur votre première commande'];
        ?>
          <!-- Slide 1 -->
          <div class="carousel-item active" style="background-image: url(img/logo_esembe.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown"><span>esembe</span> buzz</h2>
                <p class="animate__animated animate__fadeInUp">
                 <?=$messages[0] ?>
                </p>
                <div>
                  <a href="connexon/inscription_esembe" target="_blank" class="btn-book animate__animated animate__fadeInUp scrollto">Je créé mon compte</a>
                </div>
              </div>
            </div>
          </div>


          <?php
           shuffle($photos);
           shuffle($messages);
           foreach($photos as $photo){
          ?>
          <div class="carousel-item " style="background-image: url(fichier/<?=$photo['fichier'] ?>);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown"><span>esembe</span> buzz</h2>
                <p class="animate__animated animate__fadeInUp">
                  <?=$messages[1] ?>
                </p>
                <div>
                  <a href="client/creation_compte_rud_bus_pro.php?type_compte=Professionnel" target="_blank" class="btn-book animate__animated animate__fadeInUp scrollto">Créer un compte professionnel</a>
                </div>
              </div>
            </div>
          </div>
          <?php
           }
          ?>

        
        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>
    </section>


  <main class="main">

    <!-- Hero Section -->
    <section id="heo" class="hero_taza section mt-2">
      
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up" class="">Bienvenue sur <span>esembe</span> buzz</h1>
          <p data-aos="fade-up" data-aos-delay="100" class="">
            Nous sommes là pour vous offrir un service de qualité et faciliter vos achats en ligne. Découvrez ce que nous avons à offrir !
            <br>
          </p>
          <div class="justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
            <a href="connexion/inscription_esembe" class="btn-get-started">Je crée mon compte</a>
            
          </div>
          <img src="img/logo_esembe.jpg" class="img-fluid hero-img mt-2" style="height:260px;" alt="" data-aos="zoom-out" data-aos-delay="300">
          <a href="dette/verifier_dette" class="btn-get-started mt-3">Vérifier ma dette</a>
        </div>
      </div>

    </section>
   
    

    <section id="features" class="features section">
      <div class="container section-title" data-aos="fade-up">
        <h2 class="">Pourquoi choisir <a href="#" style="font-weight:bold;color:#3366ff;">esembe</a> ?</h2>
        <p>
        Nous nous engageons à offrir des produits de qualité, un service client exceptionnel, des livraisons rapides et une expérience d'achat sécurisée. Faites confiance à esembe buzz pour vos achats en ligne !
        </p>
      </div>

      <div class="container">
        <div class="row justify-content-between">

          <div class="col-lg-5 d-flex align-items-center">

            <ul class="nav nav-tabs" data-aos="fade-up" data-aos-delay="100">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                  <i class="bi bi-binoculars"></i>
                  <div>
                    <h4 class="d-none d-lg-block">
                    Livraison Rapide
                    </h4>
                    <p>
                    Notre service de livraison rapide garantit que vos produits seront livrés dans les délais les plus courts possibles.
                    </p>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                  <i class="bi bi-box-seam"></i>
                  <div>
                    <h4 class="d-none d-lg-block">
                    Service Client 24/7
                    </h4>
                    <p>
                    Notre équipe de service client est disponible 24 heures sur 24, 7 jours sur 7 pour répondre à vos questions et résoudre vos problèmes.
                    </p>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                  <i class="bi bi-brightness-high"></i>
                  <div>
                    <h4 class="d-none d-lg-block">
                    Produits de Qualité, 
                    </h4>
                    <p>
                    Nous nous engageons à ne proposer que des produits de la plus haute qualité à nos clients.
                    </p>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                  <i class="bi bi-brightness-high"></i>
                  <div>
                    <h4 class="d-none d-lg-block">
                    Retours Faciles
                    </h4>
                    <p>
                    Nous offrons des retours faciles et sans tracas pour tous les produits achetés sur notre site.
                    </p>
                  </div>
                </a>
              </li>
            </ul>

          </div>

          <div class="col-lg-6">

            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

              <div class="tab-pane fade active show" id="features-tab-1">
                <img src="img/rud8.jpeg" alt="" class="img-fluid">
              </div>

              <div class="tab-pane fade" id="features-tab-2">
                <img src="img/rud3.jpeg" alt="" class="img-fluid">
              </div>

              <div class="tab-pane fade" id="features-tab-3">
                <img src="img/service.jpeg" alt="" class="img-fluid">
              </div>
            </div>

          </div>

        </div>

      </div>

    </section>

   


   

   

    <section id="more-features" class="more-features section">

      <div class="container">

        <div class="row justify-content-around gy-4">

          <div class="col-lg-6 d-flex flex-column justify-content-center order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
            <h3>Esembe buzz</h3>
            <p>Découvrez et utilisez les meilleures plateformes de trading pour maximiser vos opportunités de gain.</p>

            <div class="row">

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-easel flex-shrink-0"></i>
                <div>
                  <h4>Programme de fidélité</h4>
                  <p>Recevez des récompenses et des offres spéciales en profitant de notre programme de fidélité exclusif.</p>
                </div>
              </div>

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-patch-check flex-shrink-0"></i>
                <div>
                  <h4>Promotions régulières</h4>
                  <p>Ne manquez pas nos promotions et nos offres spéciales pour des économies encore plus grandes.</p>
                </div>
              </div>

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-brightness-high flex-shrink-0"></i>
                <div>
                  <h4>Service de personnalisation</h4>
                  <p>Personnalisez certains produits selon vos préférences pour une expérience unique.</p>
                </div>
              </div>

              <div class="col-lg-6 icon-box d-flex">
                <i class="bi bi-brightness-high flex-shrink-0"></i>
                <div>
                  <h4>Partenariats d'affaires</h4>
                  <p>Collaborez avec ensembe buzz pour étendre votre présence en ligne et augmenter vos ventes.</p>
                </div>
              </div>

            </div>

          </div>

          <div class="features-image col-lg-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
            <img src="img/rud8.jpeg" alt="">
          </div>

        </div>

      </div>

    </section>

   
   
    <section id="faq" class="faq section">

      <div class="container section-title" data-aos="fade-up">
        <h2>Quelques questions fréquentes</h2>
      </div>

      <div class="container">

        <div class="row">
          <div class="col-lg-4 col-12">
            <img src="img/rud8.jpeg" style="width: 350px;" alt="">
          </div>
          <div class="col-lg-8 col-12" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item faq-active">
                <h3>Comment créer un compte ?</h3>
                <div class="faq-content">
                  <p>Cliquer sur créer un compte tout simplement et ....</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

              <div class="faq-item">
                <h3>Vous appliquez aussi des réductions ?</h3>
                <div class="faq-content">
                <p>Oui oui ....</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>

            </div>

          </div>

        </div>

      </div>

    </section>
     
    
    <section id="contact" class="contact section">

      <div class="container section-title" data-aos="fade-up">
          <h2>Nous contacter</h2>
          <p>
          N'hésitez pas à nous contacter pour toute question ou demande d'assistance. Nous sommes là pour vous aider 
          </p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-geo-alt"></i>
              <h3>Adresse</h3>
              <p>Kinshasa/Lemba</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-whatsapp"></i>
              <h3>Whatsapp</h3>
              <p><a href="https://wa.me/243992854177" targte="_blank">+243992854177</a></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-telephone"></i>
              <h3>Appel</h3>
              <p><a href="tel:243992854177">+243992854177</a></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:busiesembe@gmail.com">busiesembe@gmail.com</a></p>
            </div>
          </div>

        </div>

        <div class="row gy-4 mt-1">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <img src="img/rud8.jpeg" alt="">
          </div>

          <div class="col-lg-6">
            <form action="" method="post" class="" data-aos="fade-up" data-aos-delay="400">
              <div class="row gy-4">

                <div class="col-md-6 col-6">
                  <input type="text" name="name" id="nom" class="form-control" placeholder="Nom..." required="">
                </div>
                <div class="col-md-6 col-6">
                  <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom..." required="">
                </div>

                <div class="col-md-12">
                  <input type="email" class="form-control" id="mail" name="mail" placeholder="E-mail..." required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" id="sujet" name="sujet" placeholder="Sujet..." required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" id="message" rows="4" placeholder="Message..." required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                
                  <button type="submit" class="valider btn btn-dark" style="background:#3366ff;">Envoyer message</button>
                  <div class="my-3">
                  <div class="sent-message">
                    <p id="erreur" class="text-center"></p>
                  </div>
                </div>

                </div>

              </div>
            </form>
          </div>

        </div>

      </div>

    </section>


    <section id="heo" class="hero_taza section mt-2">
      
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          
            </div>
          </div>
        </div>
        
      </div>

    </section>


  </main>

<?php
 require_once('footer.php');
?>
<?php
session_start();
require_once('connexiondb.php');
require_once('functions.php');

if(isset($_GET['id_produit'], $_GET['motif'])){
  $motif = NettoyerDonnee($_GET['motif']);
  $id_produit = htmlspecialchars(intval($_GET['id_produit']));
  if($motif == 'supprimer'){
    SupprimerProduitFromPanier($_SESSION['client_id'], $id_produit);
  }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
 if(!empty($_POST['nom']) && !empty($_POST['postnom']) && !empty($_POST['prenom']) && !empty($_POST['phone']) && !empty($_POST['adresse_livraison']) && !empty($_POST['message'])){
   if(!empty($_POST['mail'])){
      $mail                = htmlspecialchars($_POST['mail']);
      if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $mail = htmlspecialchars($mail);
      }else{
        $mail = "";
      }
    }else{
      $mail                = htmlspecialchars($_POST['mail']);
    }
    $nom                   = ucfirst(strtolower(NettoyerDonnee($_POST['nom'])));
    $postnom               = ucfirst(strtolower(NettoyerDonnee($_POST['postnom'])));
    $prenom                = ucfirst(strtolower(NettoyerDonnee($_POST['prenom'])));
    $phone                 = NettoyerDonnee($_POST['phone']);
    $adresse_livraison     = NettoyerDonnee($_POST['adresse_livraison']);
    $message               = NettoyerDonnee($_POST['message']);
    $moyen_paiement        = NettoyerDonnee($_POST['moyen_paiement']);
    $facture               = uniqid();
    if(!est_insulte_phrase($message)){
      if(!est_insulte_phrase($nom)){
        if(!est_insulte_phrase($postnom)){
          if(!est_insulte_phrase($prenom)){
              $_SESSION['nom_client']      =  $nom;
              $_SESSION['prenom_client']   =  $prenom;
              $_SESSION['postnom_client']  =  $postnom;
              $_SESSION['phone_client']    =  $phone;
              $_SESSION['facture']         = $facture;

            $recup_produit_commande = $bdd->prepare("SELECT id_panier, id_client, id_produit, sum(quantite) as quantite_produit, sum(prix_total) as prix_total_produit, date_ajout  FROM panier WHERE id_client = :id_client GROUP BY id_produit");
            $recup_produit_commande->execute(array(':id_client' => $_SESSION['client_id']));
            $produits = $recup_produit_commande->fetchAll();
            foreach($produits as $produit){
              $id_produit = $produit['id_produit'];
              
              $recup_info_prod = $bdd->prepare("SELECT * FROM produit WHERE id_produit = ?");
              $recup_info_prod->execute(array($id_produit));
              $produit_info = $recup_info_prod->fetch();
              $nom_produit = $produit_info['nom_produit'];
              
              $statut = "Attente";
              $prix_achat = $produit_info['prix_achat'];
              $quantite_dispo = $produit_info['quantite'];
              $prix_vente = $produit_info['prix_vente'];
              $quantite = $produit['quantite_produit'];
              $montant_total = $produit['prix_total_produit'];
              $ref = "produit";
              $type = "details";

              $insert_commande = $bdd->prepare("INSERT INTO commande(id_produit, produit_commande, prix_achat, prix_vente, quantite,  montant_total, nom, postnom, prenom, mail, phone, adresse_livraison, statut, moyen_paiement, facture, type_commande, message, date_commande) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
              $insert_commande->execute(array($id_produit, $nom_produit, $prix_achat, $prix_vente, $quantite, $montant_total, $nom, $postnom, $prenom, $mail, $phone, $adresse_livraison, $statut, $moyen_paiement, $facture, $type, $message));
              $delete_produit_from_panier = $bdd->prepare("DELETE FROM panier WHERE id_client = ?");
              $delete_produit_from_panier->execute(array($_SESSION['client_id']));
              header('location:apres_commande');
            }
          }else{
            $msg = "Votre prenom ne peut pas contenir une insulte. Attenton !";
          }
        }else{
          $msg = "Votre postnom ne peut pas contenir une insulte. Attention !";
        }
      }else{
        $msg = "Votre nom ne peut pas contenir une insulte. Attention !";
      }
    }else{
      $msg = "Votre message ne peut âs contenir une insulte. Attention !";
    }
 }else{
  $msg = "Veuillez compléter tous les champs";
 }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Resto Business</title>
  <meta name="description" content="Bienvenue sur ensembe business - votre destination pour le meilleur du commerce en ligne et des services de qualité. Découvrez nos services, avantages et opportunités uniques.">
  <meta name="keywords" content="commerce en ligne, services, avantages, opportunités, ensembe business">
 
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
  
</head>

<body>

 
  <section class="h-100 h-custom" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card">
            <div class="card-body p-4">

              <div class="row">

                <div class="col-lg-7">
                  <h5 class="mb-3"><a href="index" class="text-body"><i
                        class="bi bi-arrow-left me-2"></i>Continuer mon shopping</a></h5>
                  <hr>

                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                      <p class="mb-1">Votre panier</p>
                      <p class="mb-0">Vous avez produits <span id="nb_produit" class="text-primary"></span> dans votre panier</p>
                    </div>
                    <div>
                     
                    </div>
                  </div>
                  <div id="panier_produit">

                  </div>
                </div>
                <div class="col-lg-5">

                  <div class="card bg-primary text-white rounded-3">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0 text-white">Esembe Business</h5>
                        
                            <img src="img/logo_esembe.jpg" alt="Profil" class="rounded-3 me-lg-2" style="width: 40px; height: 40px;">
                        
                      </div>

                      <!--<p class="small mb-2">Moyen de paiement</p>
                      <a href="#!" type="submit" class="text-white"><i
                          class="fab fa-cc-mastercard fa-2x me-2"></i></a>
                      <a href="#!" type="submit" class="text-white"><i
                          class="fab fa-cc-visa fa-2x me-2"></i></a>
                      <a href="#!" type="submit" class="text-white"><i
                          class="fab fa-cc-amex fa-2x me-2"></i></a>
                      <a href="#!" type="submit" class="text-white"><i class="fab fa-cc-paypal fa-2x"></i></a>-->

                      <form class="mt-4" method="post">
                        <?php
                          if(isset($msg)){
                            ?>
                             <div class="bg-danger py-2 text-white text-center">
                               <?=$msg ?>
                             </div>
                            <?php
                          }
                        ?>
                        <label class="form-label text-white" for="typeName">Nom</label>
                        <div class="form-outlin form-white mb-4">
                          <input type="text" id="nom" name="nom" class="form-control form-control-lg" siez="17"
                            placeholder="Nom..." />                          
                        </div>

                    

                        <div class="row mb-4">
                          <div class="col-md-6 col-6 mb-4">
                            <label class="form-label text-white" for="postnom">Postnom</label>
                            <div class="form-outlin form-white">
                              <input type="text"  class="form-control form-control-lg"
                                placeholder="Postnom..." size="7" name="postnom" id="postnom" minlength="4" maxlength="7" required/>                             
                            </div>
                          </div>
                          <div class="col-md-6 col-6 mb-4">
                            <label class="form-label text-white" for="prenom">Prenom</label>
                            <div class="form-outlin form-white">
                              <input type="text"  class="form-control form-control-lg"
                                placeholder="Prenom..." size="7" name="prenom" id="prenom" minlength="4" maxlength="7" required/>                 
                            </div>
                          </div>

                          <div class="col-md-6 col-6 mb-4">
                            <label class="form-label text-white" for="mail">Mail(Facultative)</label>
                            <div class="form-outlin form-white">
                              <input type="email"  class="form-control form-control-lg"
                                placeholder="Mail..." size="7" id="mail" name="mail"/>                    
                            </div>
                          </div>
                          <div class="col-md-6 col-6 mb-4">
                            <label class="form-label text-white" for="phone">Téléphone</label>
                            <div class="form-outlin form-white">
                              <input type="text"  class="form-control form-control-lg"
                                placeholder="Téléphone..." size="7" id="phone" name="phone" required/>
                            </div>
                          </div>
                        </div>
                        <label class="form-label text-white" for="adresse_livraison">Adresse de livraison</label>
                        <div class="form-outlin form-white mb-4">
                          <input type="text" id="adresse_livraison" name="adresse_livraison" placeholder="Votre adresse de livraison..." class="form-control form-control-lg"
                            placeholder="" minlength="19" maxlength="19" />                         
                        </div>

                         <label class="form-label text-white mb-4" for="moyen_paiement">Moyen de paiement</label>
                          <select name="moyen_paiement" id="moyen_paiement" class="form-control">
                            <option value="M-Pesa">M-Pesa</option>
                            <option value="Airtel-Money">Airtel Money</option>
                            <option value="Orange-Money">Orange Money</option>
                          </select>
                          <div class="form-outlin form-white mb-4 mt-3">
                            <textarea name="message" id="message" class="form-control" style="resize:none;" placeholder="Message..." required></textarea>
                          </div>
                          <hr class="my-4">
                          <div id="montant_total">

                          </div>
                          <button type="submit" class="btn btn-dark btn-block btn-lg">
                            <div class="text-center">
                              <span>Valider la commande <i class="bi bi-arrow-right ms-2"></i></span>
                            </div>
                          </button>
                      </form>

                      
                    </div>
                  </div>

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="js/plugin.js"></script>
    <script src="js/lightbox.js"></script>
    <script src="js/scripts.js"></script></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    //recupérer le montant total à payer
    $(document).ready(function(){
        loadMontantTotal();
    });
    function loadMontantTotal() {
        $.ajax({
            url: 'recup_montant_total.php',
            type: 'POST',
            success: function(data) {
                $('#montant_total').html(data);
            }
        });
    }
    setInterval(function(){ loadMontantTotal(); }, 1000);

    $(document).ready(function(){
        loadProduitPanier();
    });
    function loadProduitPanier() {
        $.ajax({
            url: 'recup_produit_panier.php',
            type: 'POST',
            success: function(data) {
                $('#panier_produit').html(data);
            }
        });
    }
    setInterval(function(){ loadProduitPanier(); }, 1000);

    $(document).ready(function(){
        loadPanier();
    });
    function loadPanier() {
        $.ajax({
            url: 'load_nb_produit_panier.php',
            type: 'POST',
            success: function(data) {
                $('#nb_produit').html(data);
            }
        });
    }
    setInterval(function(){ loadPanier(); }, 1000);

  </script>
  

    
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
      <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
      <script>
  (function() {
  "use strict";
  const galleryLightbox = GLightbox({
    selector: '.gallery-lightbox'
    });

  })()
  </script>

</body>
      
</html>
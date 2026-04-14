<footer id="footer" class="footer position-relative">

<div class="container footer-top">
  <div class="row gy-4">
    <div class="col-lg-4 col-md-6 footer-about">
      <a href="" class="logo d-flex align-items-center">
        <span class="sitename" style="font-weight: 900;color: #3366ff;">Esembe buzz</span>
      </a>
      <div class="footer-contact pt-3">
        <p>RDC</p>
        <p>Kinshasa, N°10</p>
        <p class="mt-3"><strong>Phone:</strong> <span><a href="tel:243992854177">+243992854177</a></span></p>
        <p><strong>Email:</strong> <span><a href="mailto:busiesembe@gmail.com">busiesembe@gmail.com</a></span></p>
      </div>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Liens utiles</h4>
      <ul>
        <li><a href="#about">A propos</a></li>
        <li><a href="affiche_page/aidep">Aide</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Conditions</a></li>
        <li><a href="#">Politique</a></li>
      </ul>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Nos Services</h4>
      <ul>
        <li><a href="#">Formations</a></li>
        <li><a href="#">Suivi du parcours</a></li>
        <li><a href="#">Traiding</a></li>
        <li><a href="#">Marketing</a></li>
        <li><a href="#">Service après formations</a></li>
      </ul>
    </div>

    <div class="col-lg-4 col-md-12 footer-newsletter">
      <h4>Notre Newsletter</h4>
      <p>Inscrivez-vous à notre newsletter pour recevoir des offres exclusives et des réductions</p>
      <p>
        Suivez-nous pour ne manquer aucune promotion ou nouveauté
      </p>
      
      <form action="" method="post" class="abonnement">
        <div class="newsletter-form">
          <input type="email" placeholder="Votre e-mail..." style="height:30px;" id="mail_abonne" name="email">
          <input type="submit" class="abonne" value="Souscrire">
        </div>
        <div class="my-3">
            <div class="sent-message_abonne">
              <p id="erreur_abonne" class="text-center"></p>
            </div>
        </div>
      </form>
    </div>

  </div>
</div>

    <div class="container copyright text-center mt-4">
      <p>&copy; <span><script>document.write(new Date().getFullYear())</script></span> <strong class="px-1">Esembe buzz</strong> <span>Tous droits réservés</span></p>
      <div class="credits">
  
        Développé par <a href="https://rudless.com/">rudless</a>
      </div>
    </div>

</footer>
<div class="navbarbot">
    <div class="ico">
        <a href="index">
        <i class="bi bi-house-fill"></i>
        <div class="icon-title">Accueil</div>
        </a>
    </div>
    <div class="ico">
        <a href="apropos">
         <i class="bi bi-person-fill"></i>
         <div class="icon-title">A propos</div>
        </a>
    </div>
    <div class="ico">
        <a href="services">
        <i class="bi bi-activity"></i>
        <div class="icon-title">Services</div>
        </a>
    </div>

    <div class="ico">
        <a href="produits">
          <i class="bi bi-box"></i>
          <div class="icon-title">Produits</div>
        </a>
    </div>
   
    <div class="ico">
        <a href="afficher_panier_client">
        <i class="bi bi-cart-fill"></i>
        <div class="icon-title">Panier</div>
        </a>
    </div>
   
</div>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <script src="assets/js/main.js"></script>
  <script src="js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    const valider =document.querySelector('.valider');
    valider.addEventListener("click", () => {
    var nom = document.getElementById("nom").value;
    var prenom = document.getElementById("prenom").value;
    var mail = document.getElementById("mail").value;
    var sujet= document.getElementById("sujet").value;
    var message= document.getElementById("message").value;
    
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("erreur").innerHTML = this.responseText;
            document.querySelector(".sent-message").style.background = "#ed3c0d";
            document.querySelector(".sent-message").style.color = "white";
            document.querySelector(".sent-message").style.padding = "10px";
        }
    };
    xhr.open("POST", "send_message.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("nom=" + nom + "&prenom="+ prenom + "&mail=" + mail + "&sujet=" + sujet + "&message=" + message);
    document.getElementById("nom").value = "";
    document.getElementById("prenom").value = "";
    document.getElementById("mail").value = "";
    document.getElementById("sujet").value = "";
    document.getElementById("message").value = "";
    });

</script>

  <script>
const formAbonne =document.querySelector('.abonnement')
formAbonne.addEventListener('submit', (e) =>{
  e.preventDefault();
})
const abonne = document.querySelector('.abonne');
abonne.addEventListener("click", () => {
  
var mail = document.getElementById("mail_abonne").value;

var xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("erreur_abonne").innerHTML = this.responseText;
        document.querySelector(".sent-message_abonne").style.background = "#ed3c0d";
        document.querySelector(".sent-message_abonne").style.color = "white";
        document.querySelector(".sent-message_abonne").style.padding = "10px";
    }
};
xhr.open("POST", "abonne.php", true);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send("mail=" + mail);
document.getElementById("mail_abonne").value = "";
});

</script>
<script>
$(document).ready(function(){
        loadProduitPanier();
    });
    function loadProduitPanier() {
        $.ajax({
            url: 'recup_produit_panier.php',
            type: 'POST',
            success: function(data) {
                $('#produit_panier').html(data);
            }
        });
    }
    setInterval(function(){ loadProduitPanier(); }, 1000);

    //Panier sur grand écran
    $(document).ready(function(){
        loadPanier();
    });
    function loadPanier() {
        $.ajax({
            url: 'load_panier.php',
            type: 'POST',
            success: function(data) {
                $('#panier').html(data);
            }
        });
    }
    setInterval(function(){ loadPanier(); }, 1000);

    
document.querySelectorAll('.add_to_cart').forEach(likeBtn => {
likeBtn.addEventListener('click', function() {
    const id_produit = this.getAttribute('data-id');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'ajout_produit_panier.php');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function() {
        
    };

    const data_p = JSON.stringify({ id_produit });
    xhr.send(data_p);
});
});
</script>
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
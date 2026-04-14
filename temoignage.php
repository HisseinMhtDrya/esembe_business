<?php
require_once('connexiondb.php');

$recup_temoignage = $bdd->prepare("SELECT s.id, s.type, s.sexe, s.avatar, s.nom, s.postnom, s.prenom, t.*
FROM membre_esembe as s INNER JOIN temoignage_client as t ON s.id = t.id_user ORDER BY t.date_post DESC");
$recup_temoignage->execute();
?>
<?php
              if($recup_temoignage->rowCount() > 0){
?> 

    <section id="testimonials" class="testimonials section">

  
      <div class="container section-title" data-aos="fade-up">
        <h2>Témoignages de nos clients</h2>
        <p>Retrouvez les témoignages de nos clients</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
          <div class="swiper-wrapper">
<?php
              while($t = $recup_temoignage->fetch()){
            ?> 
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                <?=$t['message'] ?>
                </p>
                <div class="profile mt-auto">
                
           
                <?php
                  if(!empty($t['avatar']))
                  {
                ?>
                  <img src="membres/avatars/<?php echo $t['avatar']; ?>" class="testimonial-img" alt="" style="width:50px; height:50px;">
                <?php
                  }elseif($t['sexe']=='homme'){
                  ?>
                    <img src="membres/avatars/default_h.jpeg" class="testimonial-img" alt="" style="width:50px; height:50px;">
                  <?php
                  }else{
                    ?>
                      <img src="membres/avatars/default_f.jpeg" class="testimonial-img" alt="" style="width:50px; height:50px;">
                    <?php
                    }
                ?>
                  <h3><?=$t['prenom'] ?> <?=$t['nom'] ?></h3>
                  <h3><?=$t['type'] ?></h3>
                </div>
              </div>
            </div>

       <?php
              }
              ?>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section>


<?php
    }
?>

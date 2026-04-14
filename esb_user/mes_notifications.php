<?php
session_start();

if(!isset($_SESSION['id'])) {
  header('Location: ../../'); 
  exit;
}

require_once('../connexiondb.php');

if(isset($_SESSION['id']) && $_SESSION['id'] > 0) {
    $confirme = 1;
    $req = $bdd->prepare('UPDATE notification SET lu = 1 WHERE id_to = ?');
    $req->execute(array($_SESSION['id']));
    
 }

$id_utilisateur = $_SESSION['id'];


$sql = "SELECT notification.*, m.nom, m.prenom, m.avatar, m.sexe FROM notification
 INNER JOIN membre_esembe as m ON notification.id_from = m.id WHERE id_to = :id_utilisateur AND m.id<>:id_utilisateur ORDER BY id DESC";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id_utilisateur', $id_utilisateur);
$stmt->execute();

if(isset($_GET['type']) && $_GET['type'] == 'membre') {
    
    if(isset($_GET['supprime']) && !empty($_GET['supprime'])) {
       $supprime = (int) $_GET['supprime'];
       $req = $bdd->prepare('DELETE FROM notification WHERE id = ?');
       $req->execute(array($supprime));
       header('location:mes_notifications?id='.$_SESSION['id']);
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Esembe Buzz</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">


    <link href="../img/logo_esembe.jpg" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />

    <link href="css/style_membre.css" rel="stylesheet">
   
            <style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
<style>@import url(https://fonts.googleapis.com/css?family=Roboto:300,400,700&display=swap);
body {
    font-family: "Roboto", sans-serif;
    background: #EFF1F3;
    min-height: 100vh;
    position: relative;
}

.section-50 {
    padding: 50px 0;
}

.m-b-50 {
    margin-bottom: 50px;
}

.dark-link {
    color: #333;
}

.heading-line {
    position: relative;
    padding-bottom: 5px;
}

.heading-line:after {
    content: "";
    height: 4px;
    width: 75px;
    background-color: #29B6F6;
    position: absolute;
    bottom: 0;
    left: 0;
}

.notification-ui_dd-content {
    margin-bottom: 30px;
}

.notification-list {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 20px;
    margin-bottom: 7px;
    background: #fff;
    -webkit-box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
}

.notification-list--unread {
    border-left: 2px solid #29B6F6;
}

.notification-list .notification-list_content {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}

.notification-list .notification-list_content .notification-list_img img {
    height: 48px;
    width: 48px;
    border-radius: 50px;
    margin-right: 20px;
}

.notification-list .notification-list_content .notification-list_detail p {
    margin-bottom: 5px;
    line-height: 1.2;
}

.notification-list .notification-list_feature-img img {
    height: 48px;
    width: 48px;
    border-radius: 5px;
    margin-left: 20px;
}</style>
    </head>
    <body>
   
 <header id="header" class="header fixed-top bg-light d-flex align-items-center" style="margin-bottom:10px;">

<div class="d-flex align-items-center justify-content-between">
<a href="profil_esb">
<i style="font-weight:900;font-size:20px;" class="bi bi-arrow-left"></i></a>

 
</div>

<nav class="header-nav ms-auto">
  
</nav>

</header>
<br><br><br>
    <div class="container bg-light">
    <div class="row">

    <section class="section-50">
      <div class="">
        <h3 class="m-b-50 heading-line">Notifications <i class="fa fa-bell text-muted"></i></h3>
        <div class="notification-ui_dd-content">

        <?php
// Vérifier s'il y a des notifications
if($stmt->rowCount() > 0) {
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
       
?>  

           <div class="notification-list notification-list--unread">
                <div class="notification-list_content">

                    <div class="notification-list_img">
                    <?php
          if(!empty($row['avatar']))
          {
         ?>
          <img src="../membres/avatars/<?php echo $row['avatar']; ?>" alt="Profil" class="rounded-circle me-lg-2" style="width: 50px; height: 50px;">
          <?php
          }elseif($row['sexe']=='homme'){
          ?>
            <img src="../membres/avatars/default_h.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 50px; height: 50px;">
          <?php
           }else{
            ?>
              <img src="../membres/avatars/default_f.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 50px; height: 50px;">
            <?php
            }
         ?>
                    </div>

                    <div class="notification-list_detail">
                        <p><b><?=$row['prenom'] ?> <?=$row['nom'] ?><br> </b><?= $row['sujet'] ?></p>
                        <a href="">
                        <p class="text-info"><?=$row['msg'] ?></p>
                        <p class="text-info"><small><?= $row['date_envoi'] ?></small></p>
                        </a>
                        <?php
        if($row['lu'] == 0) {
            ?>
            
            <?php
        } else {
            ?>
            <p><i class="bi bi-check-all text-info" style="font-size:20px;"></i></p>
            <a href="mes_notifications?type=membre&supprime=<?=$row['id'] ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
            <?php
           }
             ?>
                    </div>
                </div>
                
                
            </div>

<?php
    }
}else{
    echo "<p>Aucune notification pour le moment.</p>";
}
?>
        </div>
    </div>
</section>


    </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
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

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="main.js"></script>
</body>

</html>
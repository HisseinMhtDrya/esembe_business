<?php
 session_start();

 require_once('../../connexiondb.php');
if(!isset($_SESSION['id'])){
    header('location: ../../');
}
if(isset($_GET['id'])){
  $getid = intval($_GET['id']);
}else{
  header('location:../');
}
$req_user = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = :id_client");
$req_user->execute(array(':id_client' => $_SESSION['id']));
$userinfo = $req_user->fetch();


$id_utilisateur = $_SESSION['id'];


 if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
  if(isset($_POST['supprime_avatar'])) {

    $chemin_avatar = "../../membres/avatars/". $_SESSION['id'] . "/" . $_SESSION['avatar'];
    unlink($chemin_avatar);
 
    $repertoire_avatar = "../../membres/avatars/". $_SESSION['id'] . "/";
    if (is_dir($repertoire_avatar) && count(glob($repertoire_avatar . "*")) === 0) {
        rmdir($repertoire_avatar);
    }
    $update = $bdd->prepare('UPDATE membre_esembe SET avatar = NULL WHERE id = ?');
    $update->execute(array($_SESSION['id']));
    $_SESSION['message'] = "<p class='text-danger'>Votre photo de profil a été supprimée avec succès<p>";
    header("Location: mon_profil?id=".$_SESSION['id']);
}
if(isset($_POST['supprime_cover'])) {

    $chemin_couverture = "../../membres/couverture/". $_SESSION['id'] . "/" . $_SESSION['couverture'];
    unlink($chemin_couverture);
    $repertoire_couverture = "../../membres/couverture/". $_SESSION['id'] . "/";
    if (is_dir($repertoire_couverture) && count(glob($repertoire_couverture . "*")) === 0) {
        rmdir($repertoire_couverture);
    }
    $update = $bdd->prepare('UPDATE membre_esembe SET couverture = NULL WHERE id = ?');
    $update->execute(array($_SESSION['id']));
    $_SESSION['message'] = "<p class='text-danger'>Votre photo de couverture a été supprimée avec succès<p>";
    header("Location: mon_profil?id=".$_SESSION['id']);
}
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Esembe</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="../img/logo_esembe.jpeg" rel="icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
    
    <style>
        .badge-number {
  position: absolute;
  inset: -2px -5px auto auto;
  font-weight: normal;
  font-size: 15px;
  padding: 3px 8px;
}
</style>
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
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");
      body{background-color: #eee;font-family: "Poppins", sans-serif;font-weight: 300}
      .card{border:none}
      .ellipsis{color: #a09c9c}
      hr{color: #a09c9c;margin-top: 4px;margin-bottom: 8px}
      .muted-color{color: #a09c9c;font-size: 13px}
      .ellipsis i{margin-top: 3px;cursor: pointer}
      .icons i{font-size: 25px}
      .icons .fa-heart{color: red}
      .icons .bi-smile-o{color: yellow;font-size: 29px}
      .rounded-image{border-radius: 50%!important;display: flex;justify-content: center;align-items: center;height: 50px;width: 50px}
      .name{font-weight: 600}
      .comment-text{font-size: 12px}
      .status small{margin-right: 10px;color: blue}
      .form-control{border-radius: 26px}
      .comment-input{position: relative}
      .fonts{position: absolute;right: 13px;top:8px;color: #a09c9c}
      .form-control:focus{color: #495057;background-color: #fff;border-color: #8bbafe;outline: 0;box-shadow: none}
  </style>
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
      

        <div class="sidebar pe-0 pb-0">
            <nav class="navbar bg-white navbar-light">
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Esembe</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                    <a href="mon_profil?id=<?=$_SESSION['id']?>">
                    <?php
          if(!empty($userinfo['avatar']))
          {
         ?>
          <img src="../../membres/avatars/<?php echo $userinfo['avatar']; ?>" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
          <?php
          }elseif($userinfo['sexe']=='Homme'){
          ?>
            <img src="../../membres/avatars/default_h.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
          <?php
           }else{
            ?>
              <img src="../../membres/avatars/default_f.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
            <?php
            }
         ?>
         <?php
              if($userinfo['status']=='En ligne'){
                       echo' <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>';
              }else{
                echo' <div class="bg-danger rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>';
              }
          ?>
</a> 
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?=$userinfo['prenom'] ?></h6>
                        <span><?=$userinfo['status'] ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                   <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Produits</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../admin/ajouter_produit.php?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Ajouter un produit</a>
                            <a href="../admin/liste_produit" class="dropdown-item">Modifier un produit</a>
                            <a href="../admin/liste_produit" class="dropdown-item">Supprimer un produit</a>
                            <a href="../admin/liste_produit" class="dropdown-item">Rechercher un produit</a>
                            <a href="..§admin/liste_produit?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Listes des produits</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-hashtag me-2"></i>Commandes</a>
                        <div class="dropdown-menu bg-transparent border-0">
                          <a href="" class="dropdown-item">Suivi des commandes</a>
                          <a href="" class="dropdown-item">Panier</a>
                          <a href="../admin/liste_commande?argument=en_attente" class="dropdown-item">Commandes en attente</a>
                          <a href="../admin/liste_commande?argument=reglée" class="dropdown-item">Commandes reglées</a>
                          <a href="../admin/liste_commande?argument=tout" class="dropdown-item">Listes des commandes</a>
                        </div>
                    </div>
                    <?php
                    if(isset($_SESSION['id']) AND $_SESSION['id']==$userinfo['id']){
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-gear me-2"></i> Paramètres</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="edition/edition_profil_surho" class="dropdown-item"><i class="bi bi-scissors me-2"></i>Editer mon profil</a>
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#desactiver_compte"><i class="bi bi-scissors me-2"></i>Désactiver mon compte</a>  
                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#supprimer_compte"><i class="bi bi-scissors me-2"></i>Supprimer mon compte</a>  
                            <a href="../" class="dropdown-item"><i class="fa fa-chart-bar me-2"></i>Conditions</a>
                            <a href="../" class="dropdown-item"><i class="fa fa-chart-bar me-2"></i>Politique</a>   
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </nav>
        </div>
        <!-- Fin du Sidebar -->
        <div class="sidebar-right pe-0 pb-0">
            <nav class="navbar bg-white navbar-light">
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Business</h3>
                </a>
                
                <div class="navbar-nav w-100">
                  
             <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                
                    <div class="col-12">
                        <div class="h-100 bg-white rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calendrier</h6>
                               
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>
                  
                </div>
            </div>
            <!-- Widgets fin -->
                 
                </div>
            </nav>
        </div>
        <!-- Fin du Sidebar -->
        <div class="modal fade" id="edtion_photo_profil" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title text-center" id="edtion_photo_profil">Editer ma photo de profil</h5>
                             
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col mb-3">
          <form method="POST" action="edition/action_edt_photo_prof.php" enctype="multipart/form-data">
          <?php if(isset($msg)) { echo $msg; } ?>
                                  <label for="nameSmall" class="form-label">Importer une photo</label>
                                  <span class="btn btn-file">
           <i class="bi bi-camera"></i>
           <input type="file" class="form-control" name="avatar" id="avatar" onchange="read_av();"/>
        </span>
        <img src="" alt="" id="result_av" width="50px" height="50px" class="rounded-circle"/>
                                </div>
                              </div>
                             
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Annuler
                              </button>
                              <input type="submit" value="Mettre à jour" class="btn btn-primary">
                            </div>
            </form>
                          </div>
                        </div>
                        <script type="text/javascript">
      function read_av() {
         var reader = new FileReader();
         var file = document.getElementById('avatar').files[0];
   
         reader.onload = function(e) {
            document.getElementById('result_av').src = e.target.result;
         }
   
         reader.readAsDataURL(file);
      }
   </script>
  
                      </div>

                      <div class="modal fade" id="edtion_photo_cover" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title text-center" id="edtion_photo_profil">Editer ma photo de couverture</h5>
                             
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col mb-3">
          <form method="POST" action="edition/action_edt_photo_cover.php" enctype="multipart/form-data">
          <?php if(isset($msg)) { echo $msg; } ?>
                                  <label for="nameSmall" class="form-label">Importer une photo</label>
                                  <span class="btn btn-file">
           <i class="bi bi-camera"></i>
           <input type="file" class="form-control" name="couverture" id="cover" onchange="read_cov();"/>
        </span>
        <img src="" alt="" id="result_cover" width="50px" height="50px" class="rounded-circle"/>
                                </div>
                              </div>
                             
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Annuler
                              </button>
                              <input type="submit" value="Mettre à jour" class="btn btn-primary">
                            </div>
            </form>
                          </div>
                        </div>
                        <script type="text/javascript">
      function read_cov() {
         var reader = new FileReader();
         var file = document.getElementById('cover').files[0];
   
         reader.onload = function(e) {
            document.getElementById('result_cover').src = e.target.result;
         }
   
         reader.readAsDataURL(file);
      }
   </script>
                      </div>


                        <div class="modal fade" id="supprimer_compte" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="backDropModalTitle"><?php echo $userinfo['prenom']; ?> <?php echo $userinfo['nom']; ?></h5>
                                
                              </div>
                              <div class="modal-body">
                               
                                <div class="row g-2">
                                 <p class="text-center">La suppression de votre compte entraînera également celle de toutes vos données. 
                                  Vous ne pourrez plus les récupérer<br>
                                si vous le voulez. Souhaitez-vous vraiment procéder à la suppression de votre compte?</p>
                                </div>
                              </div>
                              <div class="modal-footer">
                              <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                  Annuler
                                </a>
                                <a href="./../update_bus/supprimer_compte_bus?id=<?php echo $userinfo['id']; ?>" class="btn btn-primary">Continuer</a>
                              </div>
                            </form>
                          </div>
                        </div>

                        <div class="modal fade" id="desactiver_compte" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="backDropModalTitle"><?php echo $userinfo['prenom']; ?> <?php echo $userinfo['nom']; ?></h5>
                                
                              </div>
                              <div class="modal-body">
                               
                                <div class="row g-2">
                                 <p class="text-center">La désactivation de votre compte n'entraînera pas celle de toutes vos données. 
                                  Vous pourrez les récupérer. Mais vous n'aurez
                                    plus accès à toutes les fonctionnalités de notre Plateforme.<br>
                                  Souhaitez-vous vraiment procéder à la désactivation de votre compte??</p>
                                </div>
                              </div>
                              <div class="modal-footer">
                              <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                  Annuler
                                </a>
                                <a href="../../update_bus/desactiver_compte_bus?id=<?php echo $userinfo['id']; ?>" class="btn btn-primary">Continuer</a>
                              </div>
                            </form>
                          </div>
                        </div>

                        <div class="modal fade" id="photo_profil" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form form method="post" action="" class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="backDropModalTitle">Photo de profil</h5>
                                
                              </div>
                              <div class="modal-body">
                               
                                <div class="row g-2">
                                <img src="../../membres/avatars/<?php echo $userinfo['avatar']; ?>" alt="Profil" class=" me-lg-2" style="width: 100%; height: 100%;">
                                </div>
                              </div>
                              <div class="modal-footer">
                               <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                  Fermer
                                </a>
                                <?php
                          if($_SESSION['id']==$getid){
                      ?>
                                <input type="submit" class="btn btn-primary" name="supprime_avatar" value="Supprimer">
                                <?php }?>
                              </div>
                            </form>
                          </div>
                        </div>

                        <div class="modal fade" id="photo_cover" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form form method="post" action="" class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="backDropModalTitle">Photo de couverture</h5>
                                
                              </div>
                              <div class="modal-body">
                               
                                <div class="row g-2">
                                <img src="../../membres/couverture/<?php echo $userinfo['couverture']; ?>" alt="Couverture" class=" me-lg-2" style="width: 100%; height: 100%;">
                                </div>
                              </div>
                              <div class="modal-footer">
                              <a href="#" class="btn btn-outline-primary" data-bs-dismiss="modal">
                                  Fermer
                                </a>
                                <?php
                          if($_SESSION['id']==$getid){
                      ?>
                               <input type="submit" class="btn btn-primary" name="supprime_cover" value="Supprimer">
                               <?php } ?>
                              </div>
                            </form>
                          </div>
                        </div>


        <div class="content">
                        
					  <nav class="navbar navbar-expand bg-white navbar-white sticky-top  px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
             
                <div class="navbar-nav align-items-center ms-auto">
                  
				<div class="nav-item dropdown">
                        <a href="../profil_esb" class="nav-link" >
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="d-none d-lg-inline-flex"></span>
                        </a>
                       
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                        <?php
          if(!empty($userinfo['avatar']))
          {
         ?>
          <img src="../../membres/avatars/<?php echo $userinfo['avatar']; ?>" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
          <?php
          }elseif($userinfo['sexe']=='homme'){
          ?>
            <img src="../../membres/avatars/default_h.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
          <?php
           }else{
            ?>
              <img src="../../membres/avatars/default_f.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
            <?php
            }
         ?>
                            <span class="d-none d-lg-inline-flex"><?php echo $userinfo['prenom']; ?></span>
                        </a>
                        <?php
                        if($_SESSION['id']==$getid){

?>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            
                            <a href="../../aide_rud.php" class="dropdown-item"><i class="bi bi-question-circle  text-primary"></i> Aide</a>
                            <a href="../../deconnexion.php?logout_id=<?php echo $userinfo['id']; ?>" class="dropdown-item"><i class="bi bi-box-arrow-right text-warning"></i> Déconnection</a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link sidebar-toggler-right">
                            <i class="text-primary fa fa-bars me-lg-2"></i>
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Navbar Fin-->

            <!-- Table Start -->
          
            <div class="main_content_inner">

                <div id="spinneroverlay"> </div>

 
                <div class="profile">
                    <div class="profile-cover">

                    <?php
          if(!empty($userinfo['couverture']))
          {
         ?>
          <img src="../../membres/couverture/<?php echo $userinfo['couverture']; ?>" alt="Profil" data-bs-toggle="modal" data-bs-target="#photo_cover"/>
          <?php
          }elseif($userinfo['sexe']=='Homme'){
          ?>
            <img src="../../membres/couverture/default_h.jpeg" alt="Profil" />
          <?php
           }else{
            ?>
              <img src=".././membres/couverture/default_f.jpeg" alt="Profil" />
            <?php
            }
         ?>
         <?php
       if(isset($_SESSION['id']) AND ($_SESSION['id'])==$getid){
                       echo'  <a href="#" data-bs-toggle="modal" data-bs-target="#edtion_photo_cover"> 
                       <i class="uil-camera"></i> Editer </a>';
       }
?>
                    </div>

                    <div class="profile-details">
                        <div class="profile-image">
                        <?php
          if(!empty($userinfo['avatar']))
          {
         ?>
          <img src="../../membres/avatars/<?php echo $userinfo['avatar']; ?>" data-bs-toggle="modal" data-bs-target="#photo_profil" alt="Profil">
          <?php
          }elseif($userinfo['sexe']=='Homme'){
          ?>
            <img src="../../membres/avatars/default_h.jpeg" alt="Profil" >
          <?php
           }else{
            ?>
              <img src="../../membres/avatars/default_f.jpeg" alt="Profil">
            <?php
            }
         ?>
          <?php
       if(isset($_SESSION['id']) AND ($_SESSION['id'])==$getid){
                         echo' <a href="#" data-bs-toggle="modal" data-bs-target="#edtion_photo_profil"></a>';
       }
                          ?>
                        </div>
                        <div class="profile-details-info">
                            <h1> <?php echo $userinfo['prenom']; ?>  <?php echo $userinfo['nom']; ?>  </h1>
                            <h6 class="text-info"><?php echo $userinfo['type']; ?> </h6>
                            <div id="message-container">
                              <p id="message-text"></p>
                            </div>
                            <?php
                            if(isset($_SESSION['id']) AND ($_SESSION['id'])==$getid){
                              if($userinfo['avatar']==''){
                            ?>
                              <p><span class="text-info"><?php echo $userinfo['prenom']; ?></span>, votre photo de profil aide les 
                              autres membres à vous reconnaître. Veuillez en définir une  <span class="text-info">!!!</span></p>
                            <?php
                              }
                            }
                              ?>
                        </div>

                    </div>
                </div>
                
                
        <div class="container-fluid pt-4 px-4">
        <section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#">Accueil</a></li>
            <li class="breadcrumb-item"><a href="#">Mon profil</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mes informations</li>
          </ol>
        </nav>
      </div>
    </div>

    <div class="row">
      
      <div class="col-lg-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Nom</h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $userinfo['nom']; ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Postnom</h6>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $userinfo['postnom']; ?></p>
                </div>
            </div>
              <hr>
            <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Prenom</h6>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $userinfo['prenom']; ?></p>
                </div>
            </div>
              <hr>
              <?php if($_SESSION['id']==$userinfo['id']){ ?>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">E-mail</h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><a href="mailto:<?php echo $userinfo['mail']; ?>"><?php echo $userinfo['mail']; ?></a></p>
              </div>
            </div>
            <hr>
            <?php } ?>
            <?php if($_SESSION['id']==$userinfo['id']){ ?>
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0">Téléphone</h6>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?php echo $userinfo['phone']; ?></p>
              </div>
            </div>
            <hr>
           <?php } ?>
            <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Genre</h6>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?php echo $userinfo['sexe']; ?></p>
                </div>
            </div>
              <hr>
             
          
          </div>
        </div>
      </div>

        <div class="row">
           
          
          <div class="col-lg-6">
            <div class="card mb-4">
              <div class="card-body">
                <p class="mb-4"><span class="text-primary font-italic me-1">Informations supplémentaires</span>
                </p>
                
              
                  <h6>Type</h6>
              
                  <div class="col-sm-9">
                      <p class="text-info mb-0"><?php echo $userinfo['type']; ?></p>
                    </div>
             
                  <h6>Statut compte</h6>
                <div class="col-sm-9">
                    <p class="text-muted mb-0"><?php echo $userinfo['statut']; ?></p>
                  </div>
              </div>
            </div>
          </div>
          

        </div>
      </div>
    </div>
  </div>
</section>


    
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="htptps://www.esembe-buzz.com">Esembe</a>, Tous droits réservés. <br>
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            &copy;   <span class="small"><script>document.write(new Date().getFullYear())</script>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
       
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    
</script>

   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

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
</body>

</html>
<?php   

?>
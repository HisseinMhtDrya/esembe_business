<?php
 session_start();

 require_once('../connexiondb.php');
    if(!isset($_SESSION['id'])){
        header('location:connexion_rud_bus.php');
    }
    

    $status = "En ligne";
    $update_status = $bdd->prepare("UPDATE membre_esembe SET status = :status WHERE id = :id");
    $update_status->execute(array(':status' => $status, ':id' => $_SESSION['id']));

    $req_user = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = :id_client");
    $req_user->execute(array(':id_client' => $_SESSION['id']));
    $userinfo = $req_user->fetch();

    $verif_page_exist = $bdd->prepare("SELECT * FROM page WHERE id_createur = :id_createur");
    $verif_page_exist->execute(array(':id_createur' => $_SESSION['id']));

    $statut = "Attente";
    $recup_nb_commande = $bdd->prepare("SELECT count(*) AS nb_commande FROM commande WHERE statut = ? ");
    $recup_nb_commande->execute(array($statut));
    $nb_commande = $recup_nb_commande->fetch();

    $statut = "Reglée";
    $recup_nb_vente = $bdd->prepare("SELECT sum(montant_total) AS vente_total FROM vente");
    $recup_nb_vente->execute();
    $nb_vente_total = $recup_nb_vente->fetch();

    $statut = "Reglée";
    $currentDate = date('Y-m-d');

    $recup_nb_vente_jour = $bdd->prepare("SELECT sum(montant_total) AS vente_jour FROM vente  WHERE DATE(date_vente) = :currentDate");
    $recup_nb_vente_jour->execute(array(':currentDate' => $currentDate));
    $nb_vente_jour = $recup_nb_vente_jour->fetch();


    $recup_revenu_total = $bdd->prepare("SELECT (sum(prix_vente*quantite) - sum(prix_achat*quantite)) AS revenu_total
    FROM vente ");
    $recup_revenu_total->execute();
    $revenu_total = $recup_revenu_total->fetch();


    $recup_revenu_jour = $bdd->prepare("SELECT (sum(prix_vente*quantite) - sum(prix_achat*quantite)) AS revenu_jour
    FROM vente
    WHERE DATE(date_vente) = :currentDate");
    $recup_revenu_jour->execute(array(':currentDate' => $currentDate));
    $revenu_jour = $recup_revenu_jour->fetch();


    $recup_produit_plus_vendu_jour = $bdd->prepare("SELECT nom_produit, SUM(quantite) as total_quantite
    FROM vente
    WHERE  DATE(date_vente) = :currentDate 
    GROUP BY nom_produit
    ORDER BY SUM(quantite) DESC
    LIMIT 1");

    $recup_produit_plus_vendu_jour->execute(array(':currentDate' => $currentDate));

    $produit_plus_vendu_jour = $recup_produit_plus_vendu_jour->fetch();




    $recup_produit_plus_revenu_jour = $bdd->prepare("SELECT nom_produit, (SUM(prix_vente*quantite) - SUM(prix_achat*quantite)) as total_revenu
    FROM vente
    WHERE  DATE(date_vente) = :currentDate
    GROUP BY nom_produit
    ORDER BY (SUM(prix_vente*quantite) - SUM(prix_achat*quantite)) DESC
    LIMIT 1");

    $recup_produit_plus_revenu_jour->execute(array(':currentDate' => $currentDate));

    $produit_plus_revenu_jour = $recup_produit_plus_revenu_jour->fetch();

    $recup_notification = $bdd->prepare("SELECT COUNT(*) as nb_notification FROM notification WHERE id_to = ? AND lu = 0");
    $recup_notification->execute(array($_SESSION['id']));
    $nb_notification = $recup_notification->fetch();

    $recup_vente_totale_semaine = $bdd->prepare("SELECT SUM(montant_total) AS vente_totale FROM vente WHERE YEARWEEK(date_vente) = YEARWEEK(NOW()) ");
    $recup_vente_totale_semaine->execute();
    $vente_totale_semaine = $recup_vente_totale_semaine->fetch();

    $recup_vente_totale_mois = $bdd->prepare("SELECT SUM(montant_total) AS vente_totale FROM vente WHERE MONTH(date_vente) = MONTH(NOW()) AND YEAR(date_vente) = YEAR(NOW()) ORDER BY id DESC ");
    $recup_vente_totale_mois->execute();
    $vente_totale_mois = $recup_vente_totale_mois->fetch();




    $recup_s_vente = $bdd->prepare("SELECT DATE_FORMAT(date_vente, '%d/%m/%Y') as jour_mois_annee, COUNT(*) as nombre_vente
                                    FROM vente
                                    WHERE date_vente >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) AND date_vente <= CURDATE()
                                    GROUP BY jour_mois_annee");

    $recup_s_vente->execute();

    $vente = array();
    while ($row = $recup_s_vente->fetch()) {
        $vente[] = $row;
    }

    $json_vente = json_encode($vente);

    $recup_s_cmd = $bdd->prepare("SELECT DATE_FORMAT(date_commande, '%d/%m/%Y') as jour_mois_annee, COUNT(*) as nombre_commande
                                    FROM commande
                                    WHERE date_commande >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) AND date_commande <= CURDATE()
                                    GROUP BY jour_mois_annee");

    $recup_s_cmd->execute();

    $cmd = array();
    while ($row = $recup_s_cmd->fetch()) {
        $cmd[] = $row;
    }

    $json_cmd = json_encode($cmd);


    $recup_produit_a_quantite_preque_epuisee = $bdd->prepare("SELECT * FROM produit WHERE quantite <= 5 ORDER BY id_produit DESC");
    $recup_produit_a_quantite_preque_epuisee->execute();

    $nom_user = $userinfo['prenom']. ' ' .$userinfo['nom'];
    if($recup_produit_a_quantite_preque_epuisee->rowcount() == 1){
   
      $message = " <span class='text-primary'>$nom_user</span>, Alerte !!!!! Vous avez un produit dont la quantité est presque épuisée.<br>
        Veuillez cliquer <a href='admin/produit_a_quantite_presque_epuisee' target='_blank' class='btn btn-primary btn-sm text-white'> ici pour en savoir plus</a>";
    }else{
      $message = " <span class='text-primary'>$nom_user</span>, Alerte !!!!! Vous avez des produits dont la quantité est presque épuisée.<br>
      Veuillez cliquer <a href='admin/produit_a_quantite_presque_epuisee' target='_blank' class='btn btn-primary btn-sm text-white'> ici pour en savoir plus</a>";
    }
        $sujet = "Produit à quantité presque épuisée";
        
        $verif_not = $bdd->prepare("SELECT * FROM notification WHERE id_to = ? ANd sujet = ? AND lu = 0");
        $verif_not->execute(array($_SESSION['id'], $sujet));
        if($verif_not->rowCount() == 0){
            $lu = 0;
            $date_notification = date("Y-m-d h:m:s");
            $expediteur = $userinfo['prenom'] . " " . $userinfo['nom'];
            $id_admin = $userinfo['id'];
            $id_from = 138;
        
            $sql_insert = $bdd->prepare("INSERT INTO notification (id_from, id_to,sujet, msg, lu, date_envoi) VALUES (?, ?, ?, ?, ?, NOW())");  
            $sql_insert->execute(array($id_from, $id_admin, $sujet, $message, $lu));
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
    <link href="../img/logo_esembe.jpg" rel="apple-touch-icon">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">
    
    <style>
        .badge-number {
          position: absolute;
          inset: -2px -5px auto auto;
          font-weight: normal;
          font-size: 15px;
          padding: 3px 8px;
        }
        body::-webkit-scrollbar {
                background-color: rgb(255, 255, 255);
                width: 12px;
                border-radius: 50px;
                cursor: pointer;
        }


        body::-webkit-scrollbar-thumb {
                background-color:#0d83fd; 
                border-radius: 50px;
                cursor: pointer;
            }
        .sidebar::-webkit-scrollbar {
                background-color: rgb(255, 255, 255);
                width: 9px;
                border-radius: 50px;
                cursor: pointer;
        }

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
                    <a href="../profil/mon_profil?id=<?=$_SESSION['id']?>">
                        <?php
                            if(!empty($userinfo['avatar']))
                            {
                            ?>
                            <img src="../membres/avatars/<?php echo $userinfo['avatar']; ?>" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
                            <?php
                            }elseif($userinfo['sexe']=='Homme'){
                            ?>
                                <img src="../membres/avatars/default_h.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
                            <?php
                            }else{
                                ?>
                                <img src="../membres/avatars/default_f.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
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
                    <a href="" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Mon compte</a>
                    <a href="../sauvegarde/photos" class="nav-item nav-link"><i class="bi bi-image text-primary me-2"></i>Mon album</a>       
                      <a href="../sauvegarde/mes_fichiers" class="nav-item nav-link"><i class="bi bi-file text-primary me-2"></i>Mes fichiers</a>       
                    <?php
                      if($userinfo['type'] == "Super Administrateur" OR $userinfo['type'] == "Super Administratrice" OR $userinfo['type'] == "Administratrice" OR $userinfo['type'] == "Administrateur"){
                        ?>
                        <a href="../administration/code_admin" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Bureau Admin</a>
                        <?php
                      }
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Produits</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <!-- <a href="../produit/ajouter_produit?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Ajouter un produit</a>
                            <a href="../produit/liste_produit" class="dropdown-item">Modifier un produit</a> -->
                            <a href="../produit/liste_produit" class="dropdown-item">Rechercher un produit</a>
                            <a href="../produit/liste_produit?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Listes des produits</a>
                            <a href="../produit/produit_a_quantite_presque_epuisee?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Produits presque épuisés</a>
                            <a href="../produit/produit_epuise?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Produits épuisés</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-cart me-2"></i>Gestion vente</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../vente/creer_inventaire" class="dropdown-item">Créer inventaire</a>
                            <a href="../vente/ajouter_vente_du_jour" class="dropdown-item">Ajouter vente du jour</a>
                            <a href="../vente/vente_du_jour" class="dropdown-item">Vente du jour</a>
                            <?php
                             if($userinfo['type'] == "Super Administrateur" OR $userinfo['type'] == "Super Administratrice" OR $userinfo['type'] == "Administratrice" OR $userinfo['type'] == "Administrateur"){
                            ?>
                                <a href="../vente/vente_semaine" class="dropdown-item">Vente de la semaine</a>
                                <a href="../vente/vente_mois" class="dropdown-item">Vente du mois</a>
                                <a href="../vente/toutes_les_ventes" class="dropdown-item">Toutes les ventes</a>
                            <?php 
                             }
                            ?>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-hashtag me-2"></i>Commandes</a>
                        <div class="dropdown-menu bg-transparent border-0">
                          <a href="" class="dropdown-item">Suivi des commandes</a>
                          <a href="" class="dropdown-item">Panier</a>
                          <a href="../produit/liste_commande?argument=en_attente" class="dropdown-item">Commandes en attente</a>
                          <a href="../produit/liste_commande?argument=reglée" class="dropdown-item">Commandes reglées</a>
                          <a href="../produit/liste_commande?argument=tout" class="dropdown-item">Listes des commandes</a>
                        </div>
                    </div>
                   
                    <a href="../produit/stock_produit" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Stock produit</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Catégorie</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../produit/ajout_categorie" class="dropdown-item">Ajouter une catégorie</a>
                            <a href="../produit/liste_categorie" class="dropdown-item">Listes de catégorie</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Fin du Sidebar -->
        <div class="sidebar-right pe-0 pb-0">
            <nav class="navbar bg-white navbar-light">
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Esembe</h3>
                </a>
                
                <div class="navbar-nav w-100">
                <div class="text-center container bg-white py-3">
                    <p> <span class="text-primary"><?=$userinfo['prenom'] ?></span> , aimeriez-vous laisser un témoignage sur <a href="https://esemebe-business.com">Esembe Business ? <i class="bi bi-emoji-smile text-warning"></i></a></p>
                  <a href="poster_temoignage" target="_blank" class="btn btn-dark text-white">Laisser un témoignage</a>
                  </div>
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

        <div class="content">
       
            <nav class="navbar navbar-expand bg-white navbar-white sticky-top px-4 py-0">
               
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
               
                <div class="navbar-nav align-items-center ms-auto">
                
                 
                    
                    <div class="nav-item dropdown">
                        <a href="admin/liste_commande?argument=en_attente" class="nav-link" >
                            <i class="bi bi-cart me-lg-2" style="background:#fff;border-radius:50px;color:#0d66ff;font-size:23px;"></i>
                            <span class="badge bg-warning badge-number">
                                <?=$nb_commande['nb_commande'] ?>
                            </span>
                        </a>
                    </div>
                    <div class="nav-item dropdown">
                       <a href="../chat/users" target="_blank" class="nav-link">
                            <i class="bi bi-chat-fill me-lg-2 shadow" style="background:#fff;border-radius:50px;color:#0d66ff;font-size:23px;"></i>
                           
                            <span class="badge bg-warning badge-number" id="navbar_chat">

                            </span>
						
                        </a>
                    </div>
                    
                    <div class="nav-item dropdown">
                       <a href="mes_notifications" target="_blank" class="nav-link">
                            <i class="fa fa-bell me-lg-2 shadow" style="background:#fff;border-radius:50px;color:#0d66ff;font-size:23px;"></i>
                           
                            <span class="badge bg-warning badge-number" id="navbar_notification">

                            </span>
						
                        </a>
                    </div>
                    <div class="nav-item dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown">
                        <?php
                            if(!empty($userinfo['avatar']))
                            {
                            ?>
                            <img src="../membres/avatars/<?php echo $userinfo['avatar']; ?>" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
                            <?php
                            }elseif($userinfo['sexe']=='Homme'){
                            ?>
                                <img src="../membres/avatars/default_h.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
                            <?php
                            }else{
                                ?>
                                <img src="../membres/avatars/default_f.jpeg" alt="Profil" class="rounded-circle me-lg-2" style="width: 40px; height: 40px;">
                                <?php
                                }
                        ?>
                            <span class="d-none d-lg-inline-flex"><?php echo $userinfo['prenom']; ?></span>
                        </a>
                        <?php
                             if($_SESSION['id'] == $userinfo['id']){ 
                        ?>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="profil_client/mon_profil?id=<?=$_SESSION['id']?>&text=Bienvenue sur votre profil. Gérez vos informations personnelles et paramètres ici." class="dropdown-item"><i class="bi bi-person text-primary"></i> Mon Profil</a>
                            <a href="" class="dropdown-item"><i class="bi bi-question-circle  text-primary"></i> Aide</a>
                            <a href="deconnexion?logout_id=<?php echo $userinfo['id']; ?>" class="dropdown-item"><i class="bi bi-box-arrow-right text-warning"></i> Déconnexion</a>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link sidebar-toggler-right">
                            <i class="text-primary fa fa-bars me-lg-2"></i>
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Navbar Fin -->

            <!-- Vente & Revenue début -->
            <div class="container-fluid pt-4 px-4">
              
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-white shadow-lg rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">Vente du jour</p>
                                
                                <h6 class="mb-0"><?=$nb_vente_jour['vente_jour'] ?> Fc</h6>
                                
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-12 col-xl-6">
                        <div class="bg-white shadow-lg rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">Vente de la semaine</p>
                                
                                <h6 class="mb-0"><?=$vente_totale_semaine['vente_totale'] ?> Fc</h6>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 col-xl-6">
                        <div class="bg-white shadow-lg rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">Vente du mois</p>
                                
                                <h6 class="mb-0"><?=$vente_totale_mois['vente_totale'] ?> Fc</h6>
                                
                            </div>
                        </div>
                    </div>
                       <div class="col-sm-6 col-12 col-xl-6">
                           <div class="bg-white shadow-lg rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Vente totale/plus</p>
                                
                                <h6 class="mb-0"><?=$nb_vente_total['vente_total'] ?> Fc</h6>
                               
                            </div>
                        </div>
                    </div> -->
                    
                    <!-- <div class="col-sm-6 col-12 col-xl-6">
                        <div class="bg-white shadow-lg rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">Revenu du jour</p>
                                <?php
                                  if($revenu_jour == true){
                                ?>
                                <h6 class="mb-0"><?=$revenu_jour['revenu_jour'] ?> Fc</h6>
                                <?php } ?>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-sm-6 col-12 col-xl-6">
                           <div class="bg-white shadow-lg d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Revenu total/</p>
                                <?php
                                  if($revenu_total == true){
                                ?>
                                <h6 class="mb-0"><?=$revenu_total['revenu_total'] ?> Fc</h6>
                                <?php
                                }else{
                                    echo "Pas de revenu";
                                }
                                ?>
                            </div>
                        </div>
                    </div> -->


                      <!-- stat vente et revenu début --
                        <div class="container-fluid pt-4 px-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-xl-6">
                                    <div class="bg-white text-center rounded p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <h6 class="mb-0">Ventes</h6>
                                            <a href=""></a>
                                        </div>
                                        <canvas id="worldwide-sales"></canvas>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xl-6">
                                    <div class="bg-white text-center rounded p-4">
                                        <div class="d-flex align-items-center justify-content-between mb-4">
                                            <h6 class="mb-0">Revenue</h6>
                                            <a href=""></a>
                                        </div>
                                        <canvas id="salse-revenue"></canvas>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                   </div>      
                    -->


            <div class="container mb-3">
                <div class="d-flex justify-content-center text-center mt-3">
                    
                    <a href="../produit/stock_produit" target="_blank" class="btn btn-warning text-white" style="margin-right:5px;">Stock produits</a>
                    <a href="../produit/liste_produit" target="_blank" class="btn btn-warning text-white" style="margin-right:5px;">Produits</a>
                    <a href="../produit/vente_et_revenu_par_produit" target="_blank" style="margin-right:5px;" class="btn btn-primary">Vente et revenu par produit</a>
                
                </div>
            </div>

            <div class="bg-white shadow py-3 row">
                <div class="col-12 col-lg-6">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
                <div class="col-12 col-lg-6">
                    <canvas id="myLineChart" width="400" height="400"></canvas>
                </div>
            </div>

                     <div class="bg-white shadow-lg py-3">
                        <h2 class="text-primary text-center">Produits du jour</h2>
                         <p class="text-primary">Produit le plus vendu du jour </p>
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Quantité totale</th>
                                    </tr>
                                </thead>
                               <tbody>
                               <tr>
                                    <td>
                                    <?php
                                        if($produit_plus_vendu_jour == true){
                                            ?>
                                            <?=$produit_plus_vendu_jour['nom_produit']?>
                                            <?php
                                        }
                                    ?>
                                    </td>
                                    <td>
                                    <?php
                                        if($produit_plus_vendu_jour == true){
                                            ?>
                                        <?=$produit_plus_vendu_jour['total_quantite'] ?>
                                        <?php
                                        }
                                    ?>
                                    </td>
                                </tr>
                               </tbody>                              
                            </table>

                        
                            <p class="text-primary">Produit ayant procuré le plus de revenu aujourd'hui</p>
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Produit</th>
                                            <th>Revenu total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            <?php
                                            if($produit_plus_revenu_jour == true){
                                                ?>
                                            <?=$produit_plus_revenu_jour['nom_produit']?>
                                            <?php
                                            }
                                            ?>
                                            </td>
                                            <td>
                                            <?php
                                            if($produit_plus_revenu_jour == true){
                                                ?>
                                            <?=$produit_plus_revenu_jour['total_revenu']?>
                                            <?php
                                            }
                                            ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                     </div>
                </div>
            </div>
            <!-- Sale & Revenue fin -->


           


            <!-- Recent Sales début -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white shadow-lg text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recentes commandes</h6>
                        <?php
                           $recup_commande = $bdd->prepare("SELECT * FROM commande ORDER BY id_commande DESC");
                           $recup_commande->execute();
                        ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    
                                    <th scope="col">Date</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Statut</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                   while($com = $recup_commande->fetch()){
                                ?>
                                <tr>
                                    
                                    <td><?=$com['date_commande'] ?></td>
                                    <td><?=$com['produit_commande'] ?></td>
                                    <td><?=$com['nom'] ?> <?=$com['postnom'] ?> <?=$com['prenom'] ?></td>
                                    <td>$<?=$com['montant_total'] ?></td>
                                    <td><?=$com['message'] ?></td>
                                    <td><?=$com['statut'] ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-primary mb-2" href="admin/liste_commande.php?argument=tout">Details</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent et vente fin -->


           


             <!-- Footer début -->
             <div class="container-fluid pt-4 px-4">
                <div class="bg-white shadow-lg rounded-top p-4">
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
            <!-- Footer fin -->
        </div>
        <!-- Content fin -->


        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


    <script src="js/main.js"></script>
    <script>
  //Chargement message
  $(document).ready(function(){
            loadChat();
        });
        function loadChat() {
            $.ajax({
                url: 'load/charge_message.php',
                type: 'POST',
                success: function(data) {
                    $('#navbar_chat').html(data);
                }
            });
        }
        setInterval(function(){ loadChat(); }, 1000);
        //Chargement notification
        $(document).ready(function(){
            loadNotification();
        });
        function loadNotification() {
            $.ajax({
                url: 'load/charge_notification.php',
                type: 'POST',
                success: function(data) {
                    $('#navbar_notification').html(data);
                }
            });
        }
        setInterval(function(){ loadNotification(); }, 1000);

       
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

<script>
        //stat vente
        var ctx = document.getElementById('myChart').getContext('2d');

        var data = <?php echo $json_vente; ?>;

        var dates = data.map(function (item) {
            return item.jour_mois_annee;
        });
        var nombreVente = data.map(function (item) {
            return item.nombre_vente;
        });

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Nombre de ventes pour 10 derniers jours',
                    data: nombreVente,
                    backgroundColor: '#0d66ff',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });

        //stat commande
        var ctx2 = document.getElementById('myLineChart').getContext('2d');

        var data2 = <?php echo $json_cmd; ?>;

        var dates2 = data2.map(function (item) {
            return item.jour_mois_annee;
        });
        var nombreCmd = data2.map(function (item) {
            return item.nombre_commande;
        });

        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: dates2,
                datasets: [{
                    label: 'Nombre de commandes pour 10 derniers jours',
                    data: nombreCmd,
                    fill: false,
                    borderColor: '#ff6384',
                    lineTension: 0.1
                }]
            }
        });




        
    // Worldwide Sales Chart
    var ctx1 = $("#worldwide-sales").get(0).getContext("2d");
    var myChart1 = new Chart(ctx1, {
        type: "bar",
        data: {
            labels: data,
            datasets: [{
                    label: "USA",
                    data: nombreVente,
                    backgroundColor: "rgba(0, 156, 255, .7)"
                }
            ]
            },
        options: {
            responsive: true
        }
    });


    // Salse & Revenue Chart
    var ctx2 = $("#salse-revenue").get(0).getContext("2d");
    var myChart2 = new Chart(ctx2, {
        type: "line",
        data: {
            labels: data2,
            datasets: [{
                    label: "Vente",
                    data: nombreCmd,
                    backgroundColor: "rgba(0, 156, 255, .5)",
                    fill: true
                }
            ]
            },
        options: {
            responsive: true
        }
    });
    


   
    </script>
</body>
      
</html>
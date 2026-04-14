<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../../");
    exit();
}

require_once('../connexiondb.php');

$req_user = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = :id_client");
$req_user->execute(array(':id_client' => $_SESSION['id']));
$userinfo = $req_user->fetch();


$view = $bdd->prepare("SELECT * 
FROM visiteur");

$view->execute();

$view = $view->fetchAll();	
$nb_view_unique = 0;
        $nb_view_unique_pourcent = 0;
        $pourcent_view_unique = 0;
        
        foreach($view as $v):
            
            $d = date_create($v['date_visite']);
            
            if (date_format($d, "Y-m-d") == date('Y-m-d')){
                $nb_view_unique += 1;
                
            }elseif (date_format($d, "Y-m-d") >= date('Y-m-d', strtotime(date("Y-m-d") . ' - 1 day'))){
                $nb_view_unique_pourcent += 1;
                
            }											
        
        endforeach;
        
        if ($nb_view_unique == $nb_view_unique_pourcent){ // (10 == 10) : 0%
            
            $pourcent_view_unique = 0; 
            
            
        }elseif ($nb_view_unique > $nb_view_unique_pourcent){ // (20 > 10) : 
            
            if ($nb_view_unique_pourcent == 0){
            
                $pourcent_view_unique = "+" . $nb_view_unique;	
        
            }else{
                
                $pourcent_view_unique = ( $nb_view_unique * 100) / $nb_view_unique_pourcent;
                $pourcent_view_unique = "+" . number_format($pourcent_view_unique, 0, '', '');	
                
            }
            
        }elseif ($nb_view_unique < $nb_view_unique_pourcent){
            
            if ($nb_view_unique == 0){
            
                $pourcent_view_unique = 100 - $nb_view_unique;	
                $pourcent_view_unique = "-" . $pourcent_view_unique;	
        
            }else{
                
                $pourcent_view_unique = 100 - ( $nb_view_unique * 100) / $nb_view_unique_pourcent;
                $pourcent_view_unique = "-" . number_format($pourcent_view_unique, 0, '', '');		
                
            }
            
        }
        
    
$abonne = $bdd->query("SELECT * FROM abonne ORDER BY id DESC");

$recup_nb_membre_en_ligne = $bdd->prepare("SELECT count(*) AS nb_membre_en_ligne FROM membre_esembe WHERE status = 'En ligne' ");
$recup_nb_membre_en_ligne->execute();
$nb_membre_en_ligne = $recup_nb_membre_en_ligne->fetch();

$admin = $bdd->prepare("SELECT * FROM membre_esembe WHERE type = 'Administrateur' OR type = 'Administratrice' OR type = 'Super Administrateur' OR type = 'Super Administratrice' ORDER BY id DESC");
$admin->execute();
$membres = $bdd->prepare("SELECT * FROM membre_esembe WHERE type != 'Administrateur' AND type != 'Administratrice' AND type != 'Super Administrateur' AND type != 'Super Administratrice' ORDER BY id DESC");
$membres->execute();

$req_user = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = :id");
$req_user->execute(array(':id' => $_SESSION['id']));
$userinfo = $req_user->fetch();

$recup_nb_client = $bdd->prepare("SELECT count(*) as nb_client FROM membre_esembe WHERE type != 'Administrateur' AND type != 'Administratrice' AND type != 'Super Administrateur' AND type != 'Super Administratrice'");
$recup_nb_client->execute();
$nb_client = $recup_nb_client->fetch();



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
    <title>Esembe Business</title>
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
    <style>
        .badge-number {
  position: absolute;
  inset: 8px 1px auto auto;
  font-weight: normal;
  font-size: 15px;
  padding: 3px 8px;
  
}

    
</style>
</head>

<body>
<div class="container-fluid position-relative bg-white d-flex p-0">
        

       
        <div class="sidebar pe-0 pb-0">
            <nav class="navbar bg-white navbar-light">
                <a href="../" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Esembe</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../img/logo_esembe.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"></h6>
                        <span>Administration</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Produits</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../esb_user/admin/ajouter_produit?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Ajouter un produit</a>
                            <a href="../esb_user/admin/liste_produit" class="dropdown-item">Modifier un produit</a>
                            <a href="../esb_user/admin/liste_produit" class="dropdown-item">Supprimer un produit</a>
                            <a href="../esb_user/admin/liste_produit" class="dropdown-item">Rechercher un produit</a>
                            <a href="../esb_user/admin/liste_produit?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Listes des produits</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-cart me-2"></i>Gestion vente</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../vente/creer_inventaire" class="dropdown-item">Créer inventaire</a>
                            <a href="../vente/ajouter_vente_du_jour" class="dropdown-item">Ajouter vente du jour</a>
                            <a href="../vente/vente_du_jour" class="dropdown-item">Vente du jour</a>
                            <a href="../vente/vente_semaine" class="dropdown-item">Vente de la semaine</a>
                            <a href="../vente/vente_mois" class="dropdown-item">Vente du mois</a>
                            <a href="../vente/toutes_les_ventes" class="dropdown-item">Toutes les ventes</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-grid me-2"></i>Gestion depense</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="ajouter_depense_du_jour" class="dropdown-item">Ajouter dépense du jour</a>
                            <a href="depense_du_jour" class="dropdown-item">Dépense du jour</a>
                            <a href="depense_semaine" class="dropdown-item">Dépense de la semaine</a>
                            <a href="depense_mois" class="dropdown-item">Dépense du mois</a>
                            <a href="depense_annee" class="dropdown-item">Dépense de l'année</a>
                            <a href="toutes_les_depenses" class="dropdown-item">Toutes les dépenses</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Produits</a>
                        <div class="dropdown-menu bg-transparent border-0">
                        <?php
                         if($userinfo['type'] == "Super Administrateur" OR $userinfo['type'] == "Super Administratrice"){
                        ?>
                            <a href="../produit/ajouter_produit?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Ajouter un produit</a>
                            <a href="../produit/liste_produit" class="dropdown-item">Modifier un produit</a>
                        <?php
                         }
                        ?>
                            <a href="../produit/liste_produit" class="dropdown-item">Rechercher un produit</a>
                            <a href="../produit/liste_produit?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Listes des produits</a>
                            <a href="../produit/produit_a_quantite_presque_epuisee?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Produits presque épuisés</a>
                            <a href="../produit/produit_epuise?id_client=<?=$userinfo['id'] ?>" class="dropdown-item">Produits épuisés</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-grid me-2"></i>Dettes clients</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="../dette/ajouter_dette_client" class="dropdown-item">Ajouter dette</a>
                            <a href="../dette/liste_dette_client" class="dropdown-item">Listes dettes</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-hashtag me-2"></i>Commandes</a>
                        <div class="dropdown-menu bg-transparent border-0">
                          <a href="../produit/liste_commande?argument=en_attente" class="dropdown-item">Commandes en attente</a>
                          <a href="../produit/liste_commande?argument=reglée" class="dropdown-item">Commandes reglées</a>
                          <a href="../produit/liste_commande?argument=tout" class="dropdown-item">Listes des commandes</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-pentagon-fill me-2"></i>Administration</a>
                        <div class="dropdown-menu bg-transparent border-0">
                          
                            <a href="change_code_admin" class="dropdown-item"><i class="bi bi-pencil-square me-2"></i>Changer code Admin</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-pentagon-fill me-2"></i>Membres</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a  href="membres_insc" class="dropdown-item"><i class="bi bi-envelope me-2"></i>Membres inscrits</a>
                            <a  href="membres_insc" class="dropdown-item"><i class="bi bi-envelope me-2"></i>Bureau</a>
                            
                        </div>
                    </div>

        
                   
                   
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-pentagon-fill me-2"></i>Membre effectif</a>
                        <div class="dropdown-menu bg-transparent border-0">
                          <a  href="ajout_membre_effectif" class="dropdown-item"><i class="bi bi-person-circle me-2"></i>Ajouter membre</a> 
                          <a  href="listes_membre_effectif" class="dropdown-item"><i class="bi bi-person-circle me-2"></i>Tous les membres</a> 
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-envelope me-2"></i>Messages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                        <a href="listes_contact" class="nav-item nav-link"><i class="bi bi-envelope me-2"></i>Messages</a>          
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-people-fill me-2"></i>Gest. membres</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="comptes_desactives" class="dropdown-item"><i class="bi bi-person-circle me-2"></i>Comptes désactivés</a>
                            <a href="comptes_suspendus" class="dropdown-item"><i class="bi bi-pencil-square me-2"></i>Comptes suspendus</a>
                            
                            <a href="mise_a_jourSurho" class="dropdown-item"><i class="bi bi-person-circle me-2"></i>Mettre à jour</a>
                            <a href="reactivation_compte_surho" class="dropdown-item"><i class="bi bi-pencil-square me-2"></i>Réactiver</a>
                            <a href="suspendre_compte_surho" class="dropdown-item"><i class="fa fa-image me-2"></i>Suspendre</a>  
                            <a href="supprimer_membre" class="dropdown-item"><i class="fa fa-image me-2"></i>Supprimer</a>  
                            
                            <a href="envoi_mail_aux_membres" class="dropdown-item"><i class="bi bi-pencil-square me-2"></i>Envoi mail</a>
                            <a href="envoi_notification_utilisateurs" class="dropdown-item"><i class="bi bi-bell me-2"></i>Envoi notification</a> 
                        </div>
                    </div>
                    <?php
                       if($userinfo['type'] == 'Super Administrateur' OR $userinfo['type'] == 'Super Administratrice'){
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-grid-fill me-2"></i>Gestion Admin</a>
                        <div class="dropdown-menu bg-transparent border-0">
                        <a href="change_code_admin" class="dropdown-item"><i class="bi bi-lock me-2"></i>Changer code Admin</a>
                            <a href="creation_sup_admin" class="dropdown-item"><i class="bi bi-person-circle me-2"></i>Créer un Super Admin</a>
                            <a href="creation_admin" class="dropdown-item"><i class="bi bi-person-circle me-2"></i>Créer un Admin</a>
                            <a  href="suspendre_admin" class="dropdown-item"><i class="bi bi-pencil-square me-2"></i>Suspendre</a> 
                            
                            <a href="envoi_notification_code_admin" class="dropdown-item"><i class="bi bi-bell me-2"></i>envoi notification Admin/code </a>
                            <a href="envoi_notification_admin" class="dropdown-item"><i class="bi bi-bell me-2"></i>Envoi notification </a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </nav>
        </div>
        <div class="sidebar-right pe-0 pb-0">
            <nav class="navbar bg-white navbar-light">
                <a href="" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Buzz</h3>
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
                        <a href="#" class="nav-link" >
                            <i class="bi bi-people-fill"></i>
                            <span class="badge bg-warning badge-number">
                                <?=$nb_client['nb_client'] ?>
                            </span>
                        </a>
                       
                    </div>
                   
                    <div class="nav-item dropdown">
                        <a href="../esb_user/profil_esb" class="nav-link" >
                            <i class="bi bi-box-arrow-right me-lg-2"></i>
                            
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
                        }elseif($userinfo['sexe']=='homme'){
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
                            <a href="../esb_user/profil_client/mon_profil?id=<?=$_SESSION['id']?>&text=Bienvenue sur votre profil. Gérez vos informations personnelles et paramètres ici." class="dropdown-item"><i class="bi bi-person text-primary"></i> Mon Profil</a>
                            <a href="" class="dropdown-item"><i class="bi bi-question-circle  text-primary"></i> Aide</a>
                           
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
           
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-12 col-xl-6">
                        <div class="bg-white shadow rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">visiteurs</p>
                                <h6 class="mb-0"><p><?php echo $nb_view_unique . "<sup>(" . $pourcent_view_unique . "%)</sup>";?></p></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 col-xl-6">
                        <div class="bg-white shadow rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                    <p class="mb-2">membres connectés</p>
                                    <h6 class="mb-0"><?=$nb_membre_en_ligne['nb_membre_en_ligne']  ?> </h6>
                                </div>
                        </div>
                    </div>
                 
                </div>
               
                <div class="row g-4 mt-2">
                <?php
                    if($userinfo['type'] == "Super Administrateur" OR $userinfo['type'] == "Super Administratrice"){
                ?>
                    <div class="col-sm-6 col-12 col-xl-6">
                        <div class="bg-white shadow-lg rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">Vente du jour</p>
                                
                                <h6 class="mb-0"><?=$nb_vente_jour['vente_jour'] ?> Fc</h6>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12 col-xl-6">
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
                    </div>
                    
                    <div class="col-sm-6 col-12 col-xl-6">
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
                    </div>
                    <div class="col-sm-6 col-12 col-xl-6">
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
                    </div>
                    <?php
                     }
                    ?>


                </div>       -

            </div>
        
                
            <div class="container-fluid pt-4 px-4">
                <div class="bg-white shadow text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" id="admin">Administrateurs</h6>
                        <a href="">Voir plus</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
    
                                <tr class="text-dark">
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Genre</th>
                       
                                    <th scope="col">Rôle</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($ad = $admin->fetch()) { ?>
 
                                <tr>
                                    <td><?= $ad['id'] ?></td>
                                    <td><?= $ad['nom'] ?></td>
                                    <td><?= $ad['prenom'] ?></td>
                                    <td><?= $ad['sexe'] ?></td>
                    
                                    <td><?=$ad['type'] ?></td>
                                 
                                </tr>
                           
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          


            <div class="container-fluid pt-4 px-4">
                <div class="bg-white shadow text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" id="membres">Clients</h6>
                        <a href="listes_client.php">Voir plus</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
    
                                <tr class="text-dark">
                                    <th scope="col">Id</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Mail</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php while($m = $membres->fetch()) { ?>
      <li style="list-style:none;">
                                <tr>
                                    <td><?= $m['id'] ?></td>
                                    <td><?= $m['nom'] ?></td>
                                    <td><?= $m['prenom'] ?></td>
                                    <td><?= $m['sexe'] ?></td>
                                    <td><?= $m['mail'] ?></td>
                                  
                                   
                                </tr>
                                </li>
    
      <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       


            <div class="container-fluid pt-4 px-4">
    <div class="bg-white shadow text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0" id="abonnes">Abonnés</h6>
            <a href="">Voir plus</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    
                    <tr class="text-dark">
                        <th scope="col">Id</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Date</th>
                       
                    </tr>
                </thead>
                <tbody>
                <?php while($c = $abonne->fetch()) { ?>
         <li style="list-style:none;">
                    <tr>
                        <td><?= $c['id'] ?> </th><th> <?= $c['mail'] ?></td>
                        <td><?= $c['date_abonnement'] ?></td>
                       
                    </tr>
                    </li>
      <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


             <!-- Footer début -->
             <div class="container-fluid pt-4 px-4">
                <div class="bg-white shadow rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="htptps://www.esembe-business.com">Esembe</a>, Tous droits réservés. <br>
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
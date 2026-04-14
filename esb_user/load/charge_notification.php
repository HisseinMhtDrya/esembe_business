<?php
session_start();
require_once('../../connexiondb.php');

$recup_nb_notification_non_lu = $bdd->prepare("SELECT count(*) as nb_notification FROM notification WHERE id_to = ? AND lu = 0");
$recup_nb_notification_non_lu->execute(array($_SESSION['id']));
$nb_notification = $recup_nb_notification_non_lu->fetch();
?>
                      
<?php
  if($nb_notification == true AND $nb_notification['nb_notification'] > 0 ){
?>
    <?=$nb_notification['nb_notification'] ?>
<?php
 }
?>
                 
                  
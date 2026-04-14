<?php
 require_once('../connexiondb.php');
if(isset($_SESSION['id'])) {

   $requpdate = $bdd->prepare('UPDATE membre_esembe SET derniere_activite = NOW() WHERE id = ?');
   $requpdate->execute(array($_SESSION['id']));

   $requpdate = $bdd->prepare('UPDATE membre_esembe SET status = "En ligne" WHERE id = ?');
   $requpdate->execute(array($_SESSION['id']));

   $requserst = $bdd->prepare('SELECT * FROM membre_esembe WHERE id = ?');
   $requserst->execute(array($_SESSION['id']));
   $userstatut = $requserst->fetch();

   $last_activity = $userstatut['last_activity'];
   $current_time = time();
   $elapsed_time = $current_time - $last_activity;

   $req = $bdd->prepare("UPDATE membre_esembe SET last_activity = :last_activity WHERE id = :id");
   $req->execute(array(':last_activity' => $current_time, ':id' => $_SESSION['id']));

   if($elapsed_time > 300) {
      $reqdisconnect = $bdd->prepare('UPDATE membre_esembe SET status = "Hors ligne" WHERE id = ?');
      $reqdisconnect->execute(array($_SESSION['id']));
   }
}
?>
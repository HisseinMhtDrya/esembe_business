<?php
session_start();
if (!isset($_SESSION['id'])) {
   header("Location: ../../connexion_rud_bus.php");
}
require_once('../../../connexiondb.php');
 
if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   
  
if(isset($_FILES['couverture']) AND !empty($_FILES['couverture']['name'])) {
   $tailleMax = 209715200; 
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
   if($_FILES['couverture']['size'] <= $tailleMax) {
      $extensionUpload = strtolower(substr(strrchr($_FILES['couverture']['name'], '.'), 1));
      if(in_array($extensionUpload, $extensionsValides)) {
         $photoName = uniqid() . '.' . $extensionUpload;
         $chemin = "../../../membres/couverture/".$photoName;
         $resultat = move_uploaded_file($_FILES['couverture']['tmp_name'], $chemin);
         if($resultat) {
            $updateavatar = $bdd->prepare('UPDATE membre_esembe SET couverture = :couverture WHERE id = :id');
            $updateavatar->execute(array(
               'couverture' => $photoName,
               'id' => $_SESSION['id']
               ));
               $_SESSION['message'] = "Votre photo de couverture a été mise à jour avec succès !";

             header('Location: ../mon_profil?id='.$_SESSION['id']);
            } else {
               echo '<script>alert("Erreur durant l\'importation de votre photo de couverture. Veuilez ressayer ou chioisir une autre photo")</script>';
            }
         } else {
            echo "<script>alert('Votre photo de couverture doit être au format jpg, jpeg, gif ou png')</script>";
         }
      } else {
         echo "<script>alert('Votre photo de couverture ne doit pas dépasser 200Mo')</script>";
      }
   }
   ?>
<?php   
}
else {
   header("Location: ../");
}
?>
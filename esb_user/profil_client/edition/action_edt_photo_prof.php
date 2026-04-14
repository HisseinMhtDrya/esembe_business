<?php
session_start();
if (!isset($_SESSION['id'])) {
   header("location: ../../connexion_rud_bus.php");
}
require_once('../../../connexiondb.php');
if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM membre_esembe WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();

   if (isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
      $tailleMax = 209715200;
      $extensionsValides = array('jpg', 'jpeg', 'JPG', 'gif', 'png');
      if ($_FILES['avatar']['size'] <= $tailleMax) {
         $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
         if (in_array($extensionUpload, $extensionsValides)) {
            $photoName = uniqid() . '.' . $extensionUpload;
            $chemin = "../../../membres/avatars/" . $photoName;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
            if ($resultat) {
               $updateavatar = $bdd->prepare('UPDATE membre_esembe SET avatar = :avatar WHERE id = :id');
               $updateavatar->execute(array(
                  'avatar' => $photoName,
                  'id' => $_SESSION['id']
               ));
               $_SESSION['message'] = "Votre photo de profil a été mise à jour avec succès !";
              
               
               header('Location: ../mon_profil?id=' . $_SESSION['id']);
            } else {
               echo '<script>alert("Erreur durant l\'importation de votre photo de profil. Veuillez réessayer ou choisir une autre photo.")</script>';
            }
         } else {
            echo "<script>alert('Votre photo de profil doit être au format jpg, jpeg, gif ou png')</script>";
         }
      } else {
         echo "<script>alert('Votre photo de profil ne doit pas dépasser 200Mo')</script>";
      }
   }
} else {
   header("Location: ../");
}
?>
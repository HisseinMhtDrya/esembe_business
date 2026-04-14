<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
 
if(isset($_SESSION['id'])) {
    $outgoing_id = $_SESSION['id'];
    $incoming_id = intval($_POST['incoming_id']);
   
  
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
   $tailleMax = 2097152;
   $extensionsValides = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'mp4', 'avi', 'mov', 'wav', 'mp3', 'doc', 'docx', 'xls', 'xlsx', 'zip');
      $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

      if(in_array($extensionUpload, $extensionsValides)) {

        $id_fichier = uniqid();
         $chemin = "uploads/".$id_fichier.".".$extensionUpload;
         $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
         if($resultat) {

            $updateavatar = $bdd->prepare('INSERT INTO messages(incoming_msg_id, outgoing_msg_id, msg, extension, date_message)
             VALUES(?, ?, ?, ?, NOW() ) ');

            $updateavatar->execute(array($incoming_id, $outgoing_id, $id_fichier.".".$extensionUpload, $extensionUpload));
               header('Location: ../chat.php?user_id='.$incoming_id);

         } else {
            $msg = "Erreur durant l'importation de votre photo de profil";
         }
      } else {
         $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
      }
   
}
}
?>
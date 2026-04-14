<?php
session_start();

require_once('../connexiondb.php');
if(isset($_SESSION['id'])) {
    $outgoing_id = $_SESSION['id'];
    $incoming_id = intval($_POST['incoming_id']);


    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
      
        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'mp4', 'avi', 'mov', 'wav', 'mp3', 'doc', 'docx', 'xls', 'xlsx', 'zip');
        $nomFichier = $_FILES['avatar']['name'];
        $tailleFichier = $_FILES['avatar']['size'];
        $extensionUpload = strtolower(pathinfo($nomFichier, PATHINFO_EXTENSION));
        $tailleOctets = $tailleFichier . ' octets';
        $tailleKo = round($tailleFichier / 1024) . ' ko';
        $tailleMo = round($tailleFichier / 1024 / 1024, 2) . ' Mo';
        $tailleGo = round($tailleFichier / 1024 / 1024 / 1024, 2) . ' Go';

        if(in_array($extensionUpload, $extensionsValides)) {
         
                $id_fichier = uniqid();
                $chemin = "uploads/".$id_fichier.".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                if($resultat) {

                    $updateavatar = $bdd->prepare('INSERT INTO messages(incoming_msg_id, outgoing_msg_id, msg, extension, taille, date_message) VALUES(?, ?, ?, ?, ?, NOW() ) ');

                    $updateavatar->execute(array($incoming_id, $outgoing_id, $id_fichier.".".$extensionUpload, $extensionUpload, $tailleMo));
                    header('Location: chat?user_id='.$incoming_id);

                } else {
                    $msg = "Erreur durant l'importation de votre fichier";
                }
            
        } else {
            $msg = "Le fichier doit être au format jpg, jpeg, gif, png, pdf, mp4, avi, mov, wav, mp3, doc, docx, xls, xlsx ou zip";
        }
    }
}
?>
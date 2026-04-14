<?php
session_start();
require_once('connexiondb.php');
$erreur = "";

if(!empty($_POST['mail'])){
    $mail = htmlspecialchars($_POST["mail"]);
    if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $verif_abonne = $bdd->prepare("SELECT * FROM abonne WHERE mail = :mail");
        $verif_abonne->execute(array(':mail' => $mail));
        if($verif_abonne->rowCount() == 0){
            $insert_message = $bdd->prepare("INSERT INTO abonne(mail, date_abonnement) VALUES(?, NOW())");
            $insert_message->execute(array($mail));
            $erreur = "Abonnement réussi. Merci beaucoup !";
        }else{
            $erreur = "Adresse mail déjà utilisée. Merci de saisir une autre !";
        }
    }else{
       $erreur = "Votre adresse mail n'est pas valide";
    }
}else{
    $erreur = "Veuillez saisir votre adresse mail";
}
echo $erreur;
?>
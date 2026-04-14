<?php
session_start();
require_once('functions.php');
require_once('connexiondb.php');
$erreur = "";

if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['sujet']) && !empty($_POST['message'])){
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $mail = htmlspecialchars($_POST["mail"]);
    $sujet = htmlspecialchars($_POST["sujet"]);
    $message = htmlspecialchars($_POST["message"]);
    $nom = ucfirst(strtolower($nom));
     if(!est_insulte_phrase($message)){
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
        $insert_message = $bdd->prepare("INSERT INTO contact_esembe(nom, prenom, mail, sujet, message, date_message) VALUES(?, ?, ?, ?, ?, NOW())");
        $insert_message->execute(array($nom, $prenom, $mail, $sujet, $message));
            $erreur = "$prenom $nom, votre message a été envoyé et reçu avec succès. Nous vous répondons dans si peu de temps. Merci beaucoup !";
        }else{
            $erreur = "Votre adresse mail n'est pas valide";
        }
     }else{
        $erreur = "Votre message ne peut pas contenir une insulte.";
     }
    }else{
    $erreur = "Veuillez compléter tous les champs";
}
echo $erreur;
?>
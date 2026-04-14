<?php
session_start();
require_once('../../connexiondb.php');
$id_user = $_SESSION['id']; 
$getid = $_SESSION['id']; 


$req = $bdd->prepare('SELECT COUNT(*) as nb_messages
                            FROM messages
                            WHERE (incoming_msg_id = :id_user)
                            AND lu = 0 HAVING COUNT(*) >= 1');
$req->execute(array(
    'id_user' => $id_user
));
$message = $req->fetch(PDO::FETCH_ASSOC);


$nb_demandes = $req->fetch(PDO::FETCH_ASSOC);

$req = $bdd->prepare('SELECT COUNT(*) as nb_notifications
                            FROM notifications
                            WHERE (id_from <> :id_user) AND (id_to = :id_user)
                            AND lu = 0 HAVING COUNT(*) >= 1');
$req->execute(array(
    'id_user' => $id_user
));
$nb_notifications = $req->fetch(PDO::FETCH_ASSOC);

?>
             
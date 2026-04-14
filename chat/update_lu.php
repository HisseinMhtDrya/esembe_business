<?php
 session_start();
 require_once('connexiondb.php');
    $id_user = intval($_GET['id_user']);
    $update_lu = $bdd->prepare("UPDATE messages SET lu = 1 WHERE incoming_msg_id = :id_to AND outgoing_msg_id = :id_from");
    $update_lu->execute(array(':id_to' => $_SESSION['id'], ':id_from' => $id_user));
?>
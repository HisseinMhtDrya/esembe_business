<?php
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');
$statut = "En ligne";
$update_statut = $bdd->prepare("UPDATE code_msg_user SET statut = ? WHERE id_user = ? AND code = ?");
$update_statut->execute(array($statut, $outgoing_msg_id, $code_securite));

?>
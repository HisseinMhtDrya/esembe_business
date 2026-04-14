<?php
$bdd = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '');

$outgoing_msg_id = $_SESSION['id'];
$incoming_msg_id = intval($_GET['user_id']);

$verif_code = $bdd->prepare("SELECT * FROM code_securite_msg
 WHERE (id_user_1 = :id1 AND id_user_2 = :id2) OR (id_user_1 = :id2 AND id_user_2 = :id1) ");
$verif_code->execute(array(':id1' => $outgoing_msg_id, ':id2' => $incoming_msg_id));
//Récupération du code de sécurité
$info_code = $verif_code->fetch();
$code_securite = $info_code['code'];
?>
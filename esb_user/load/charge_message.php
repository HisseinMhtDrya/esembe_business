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
?>
 <?php
    if($message >0){
 ?>
  <?= $message['nb_messages'];?>
<?php 
    }
?>

                 
                  
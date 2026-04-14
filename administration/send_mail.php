<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$from = "russellmk8899@gmail.com";
$to = "russellmk8299@gmail.com";
$subject = "Test mail";
$message = "Salut ! C'est un test d'envoi mail";
$headers = "From :" .$from;
mail($to, $subject, $message, $headers);
?>
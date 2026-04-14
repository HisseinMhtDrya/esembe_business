<?php
session_start();

include_once "php/config.php";

if (isset($_SESSION['id']) && isset($_POST['user_id'])) {
  $user_id = $_SESSION['id'];
  $incoming_id = mysqli_real_escape_string($conn, $_POST['user_id']);

  $sql = mysqli_query($conn, "UPDATE messages SET lu = 1 WHERE incoming_msg_id = {$user_id} AND outgoing_msg_id = {$incoming_id}");

  if ($sql) {
    echo "Mise à jour réussie";
  } else {
    echo "Erreur de mise à jour";
  }
} else {
  echo "Paramètres invalides";
}
?>
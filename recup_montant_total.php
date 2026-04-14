<?php
session_start();
require_once('connexiondb.php');
 $recup_montant_total = $bdd->prepare("SELECT id_client, sum(prix_total) as montant_total FROM panier WHERE id_client = :id_client");
 $recup_montant_total->execute(array(':id_client' => $_SESSION['client_id']));
 $info_montant = $recup_montant_total->fetch();
?>
<div class="d-flex justify-content-between">
    <p class="mb-2">Total</p>
    <p class="mb-2">$<?=$info_montant['montant_total'] ?></p>
</div>
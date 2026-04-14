<?php
  $recup_photo_produit = $bdd->prepare("SELECT * FROM produit ORDER BY RAND() DESC LIMIT 20");
  $recup_photo_produit->execute();
  $photos = $recup_photo_produit->fetchAll();

  $recup_p_produit = $bdd->prepare("SELECT * FROM produit ORDER BY RAND() DESC LIMIT 20");
  $recup_p_produit->execute();
  $ps = $recup_p_produit->fetchAll();

?>
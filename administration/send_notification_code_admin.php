<?php

    $sql_admin = $bdd->prepare("SELECT * FROM membre_esembe WHERE (type = 'Administrateur' OR type = 'Administratrice' 
    OR type = 'Super Administrateur' OR type = 'Super Administratrice')");
    $sql_admin->execute();

    while ($row = $sql_admin->fetch()) {
      $sujet = "Code bureau admin";
      $lu = 0;
      $date_notification = date("Y-m-d h:m:s");
      $expediteur = $row['prenom'] . " " . $row['nom'];
        $id_admin = $row['id'];
        $id_from = 138;
        $message = $row['prenom'] . " " . $row['nom'] . " " . ", le code d'accès au bureau d'administration pour cette semaine est : $code_validation";
        $sql_insert = $bdd->prepare("INSERT INTO notification (id_from, id_to,sujet, msg, lu, date_envoi) VALUES (?, ?, ?, ?, ?, NOW())");  
        $sql_insert->execute(array($id_from, $id_admin, $sujet, $message, $lu));
    }
    header("Location: bureau_admin");
?>
<?php

$inactiveTime = time() - 10*60;

$stmt = $bdd->prepare("UPDATE membre_esembe SET status='Hors ligne' WHERE last_activity <= :inactiveTime");
$stmt->bindParam(':inactiveTime', $inactiveTime);
$stmt->execute();

?>



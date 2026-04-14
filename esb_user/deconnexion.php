<?php
    session_start();
    require_once('../connexiondb.php');
    if(isset($_SESSION['id'])){
        $id_user = htmlspecialchars(intval($_GET['logout_id']));
        if(isset($id_user)){
            $status = "Hors ligne";
            $sql = $bdd->prepare("UPDATE membre_esembe SET status = ? WHERE id = ?");
            $sql->execute(array($status, $id_user));
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../index");
                exit;
            }
        }else{
          header("location: ../connexion/login/connexion_esembe");
          exit;
        }
    }else{  
      header("location: ../connexion/login/connexion_esembe");
      exit;
    }
?>
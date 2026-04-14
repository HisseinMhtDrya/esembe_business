<?php 
    session_start();
    if(isset($_SESSION['id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['id'];
      
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
   
        $extension = "";
        $msg_audio = "";
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, extension, msg_audio, date_message)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$extension}', '{$msg_audio}', NOW())") or die();
        }
        ?>
           <script>
  var chat = document.getElementById('messages');
  chat.scrollTop = chat.scrollHeight;

   </script>
        <?php
    }else{
        header("location: ../../connexion/login/conexionSurho");
    }
?>
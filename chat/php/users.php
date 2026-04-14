<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['id'];
    $sql = "SELECT u.id, u.sexe, u.status, u.nom, u.prenom, u.mail, u.phone, u.avatar, MAX(m.date_message) AS last_msg_time
    FROM membre_esembe u
    
    LEFT JOIN messages m ON (m.incoming_msg_id = u.id OR m.outgoing_msg_id = u.id) AND (m.incoming_msg_id = $outgoing_id OR m.outgoing_msg_id = $outgoing_id)
    WHERE u.id <> $outgoing_id
    GROUP BY u.id
    ORDER BY last_msg_time DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "Aucun ami disponible";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?> 

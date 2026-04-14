<?php
while($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['id']}
            OR outgoing_msg_id = {$row['id']}) AND (outgoing_msg_id = {$outgoing_id} 
            OR incoming_msg_id = {$outgoing_id}) ORDER BY date_message DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);

    $getUnreadSql = "SELECT COUNT(*) AS unread_count FROM messages WHERE incoming_msg_id = {$outgoing_id} AND 
                     outgoing_msg_id = {$row['id']} AND lu = 0";
    $getUnreadResult = mysqli_query($conn,$getUnreadSql);
    $getUnreadRow = mysqli_fetch_assoc($getUnreadResult);

    $unread_count = $getUnreadRow['unread_count'];

    if(mysqli_num_rows($query2) > 0) {
        if(isset($row2['extension']) && !empty($row2['extension'])){
            $extension = $row2['extension'];
            $result = "";
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $result = "Photo";
            }elseif (in_array($extension, ['mp4', 'avi', 'mov'])) {
             $result = "Video";
            }elseif (in_array($extension, ['mp3', 'wav'])) {
             $result = "Audio";
            }elseif (in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip'])) {
             $result = "Fichier";
            }else {
                $result = 'Type de fichier non pris en charge';
            }
        }else if(!empty($row2['msg_audio'])){
            $result = "Message audio";
        }else{
        $result = $row2['msg'];
        }
        $message_date = $row2['date_message']; 
        $date_msg = date("d/m/Y", strtotime($message_date));
    } else {
        $result = "Aucun message";
        $message_date = "";
    }
     
    if(strlen($result) > 12) {
        $msg = substr($result, 0, 12) . '...';
    } else {
        $msg = $result;
    }
     
    if(isset($row2['outgoing_msg_id'])){
        if($outgoing_id == $row2['outgoing_msg_id']) {
            $you = " ";
            $sent_by_me = true;
        } else {
            $you = "";
            $sent_by_me = false;
        }
    } else {
        $you = "";
        $sent_by_me = false;
    }
    $nom_user =  $row['prenom']. " " . $row['nom'];
    if(strlen($nom_user) > 12) {
        $ami = substr($nom_user, 0, 12) . '...';
    } else {
        $ami = $nom_user;
    }
    ($row['status'] == "Hors ligne") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['id']) ? $hid_me = "hide" : $hid_me = "";
   
    $output .= '<a href="chat?user_id='. $row['id'] .'">
                    <div class="content">';
    if(empty($row['avatar'])){
        
        if($row['sexe'] == "Homme"){
            $output .= '<img src="../membres/avatars/default_h.jpeg" alt="">';
        } else {
            $output .= '<img src="../membres/avatars/default_f.jpeg" alt="">';
        }
    } else {
        $output .= '<img src="../membres/avatars/'. $row['avatar'] .'" alt="">';
    }
    $output .= '<div class="details">
                    <span>'.$ami.'</span>
                    <p>';
    if($sent_by_me && $row2['lu'] == 1){
        $output .= '<i style="padding-top:5px;" class="bi bi-check2-all text-info"></i>';
    }
    elseif($sent_by_me && $row2['lu'] == 0){
        $output .= '<i style="padding-top:5px;" class="bi bi-check2"></i>';
    } 
    if($getUnreadRow['unread_count'] > 0) {
        $output .= '<strong>';
    }
    $output .= $you . $msg;
    if($getUnreadRow['unread_count'] > 0) {
        $output .= '</strong>';
    }
    $output .= '</p>';
    if($message_date != "") {
        $current_date = new DateTime();
        $message_datetime = new DateTime($message_date); 
        $diff = date_diff($message_datetime, $current_date);
        if($diff->days == 0) {
            $output .= '</div></div><div class="message-date">'. date_format($message_datetime, "H:i") . '</div>';
            
        } elseif(date("Y-m-d", strtotime($message_date)) == date("Y-m-d", strtotime("-1 day"))) {
            $output .= '</div></div><div class="message-date">Hier</div>';
        } else {
            $output .= '</div></div><div class="message-date">'.  $date_msg  . '</div>';
        }
    }
    $output .= '</div>
                    </div>
                    ';

    if ($getUnreadRow['unread_count'] > 0) {
        $output .= '<div class="unread-count">'. $unread_count .'</div>';
    }
    $output .= '</a>';
}
?>
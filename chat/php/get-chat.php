<?php

session_start();

if (isset($_SESSION['id'])) {

    include_once "config.php";

  
    $user_id = $_SESSION['id'];
$sql_user = "SELECT * FROM membre_esembe WHERE id = $user_id";
$query_user = mysqli_query($conn, $sql_user);
if ($row_user = mysqli_fetch_assoc($query_user)) {
    $user_avatar = $row_user['avatar'];
}

$outgoing_id = $_SESSION['id'];
    $incoming_id = mysqli_real_escape_string($conn, $_GET['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN membre_esembe as t ON t.id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $current_date = "";
        while ($row = mysqli_fetch_assoc($query)) {
            $msg_date = date("Y-m-d", strtotime($row['date_message']));
            $formatted_date = "";
            if ($current_date != $msg_date) {
                if ($msg_date == date("Y-m-d")) {
                    $formatted_date = "Aujourd'hui";
                } elseif ($msg_date == date("Y-m-d", strtotime("-1 day"))) {
                    $formatted_date = "Hier";
                } else {
                    $formatted_date = date("d-m-Y", strtotime($row['date_message']));
                }
                $output .= '<div class="date">' . $formatted_date . '</div>';
            }
            if ($row['outgoing_msg_id'] == $outgoing_id) {
                $output .= '<div class="chat outgoing">
                            <div class="details">';
                if(isset($row['extension']) && !empty($row['extension'])){
                    $extension = $row['extension'];
                    $fileUrl = 'php/uploads/' . $row['msg'];


                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $msg = '<a href="php/uploads/'. $row['msg'] .'" download="php/uploads/'. $row['msg'] .'">
                        <img src="php/uploads/'. $row['msg'] .'" style="width:100%; height:100%;border-radius: 1px;" alt=""> 
                        </a>';
                        }elseif (in_array($extension, ['mp4', 'avi', 'mov'])) {
                            $msg = '<a href="' . $fileUrl . '" style="color:#fff;"> '.$row['msg'].' </a><br>';
                        }elseif (in_array($extension, ['mp3', 'wav'])) {
                            $msg = '<a href="' . $fileUrl . '" style="color:#fff;"> '.$row['msg'].' </a><br>';
                        }elseif (in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip'])) {
                            $msg = '<a href="' . $fileUrl . '" download="' . $fileUrl . '" style="width:100%; height:auto;border-radius: 1px; color:#fff;">  '.$row['msg'].' </a><br>';
                        } else {
                            $msg = 'Type de fichier non pris en charge';
                        }
                }else if(!empty($row['msg_audio'])){
                    $audioBlob = $row['msg_audio'];
                    $msg = '<a href="#" onclick="openAudioPlayer(\'data:audio/webm;base64,' . base64_encode($audioBlob) . '\'); return false;" style="color:#fff;">Lire l\'audio</a>';
                }else{
                    $msg = $row['msg']. '<br>';
                }
                $output .= '<p>' . $msg . ' <span class="time">' . date("H:i", strtotime($row['date_message'])) . '</span>';
                // Vérifier si le message a été lu
                if ($row['lu'] == 1) {
                    $output .= '<i class="bi bi-check2-all"></i></p>';
                } else {
                    $output .= '<i class="bi bi-check2"></i></p>';
                }
                $output .= '</div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">';
                            if(empty($row['avatar'])){
                                if($row['sexe'] == "Homme"){
                                    $output .= '<img src="../membres/avatars/default_h.jpeg" alt="">';
                                } else {
                                    $output .= '<img src="../membres/avatars/default_f.jpeg" alt="">';
                                }
                            } else {
                                $output .= '<img src="../membres/avatars/'. $row['avatar'] .'" alt="">';
                            }
                $output .= '       <div class="details">';

                if(isset($row['extension']) && !empty($row['extension'])){
                    $extension = $row['extension'];
                    $fileUrl = 'php/uploads/' . $row['msg'];


                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                        $msg = '<a href="php/uploads/'. $row['msg'] .'" download="php/uploads/'. $row['msg'] .'">
                        <img src="php/uploads/'. $row['msg'] .'" style="width:100%; height:100%;border-radius: 1px;" alt=""> 
                        </a>';
                        }elseif (in_array($extension, ['mp4', 'avi', 'mov'])) {
                            $msg = '<a href="' . $fileUrl . '" style="color:#1e90ff;;"> '.$row['msg'].' </a><br>';
                        }elseif (in_array($extension, ['mp3', 'wav'])) {
                            $msg = '<a href="' . $fileUrl . '" style="color:#1e90ff;;"> '.$row['msg'].' </a><br>';
                        }elseif (in_array($extension, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'zip'])) {
                            $msg = '<a href="' . $fileUrl . '" download="' . $fileUrl . '" style="width:100%; height:auto;border-radius: 1px; color:#1e90ff;;">  '.$row['msg'].' </a><br>';
                        } else {
                            $msg = 'Type de fichier non pris en charge';
                        }

                    }else if(!empty($row['msg_audio'])){
                        $audioBlob = $row['msg_audio'];
                        $msg = '<a href="#" onclick="openAudioPlayer(\'data:audio/webm;base64,' . base64_encode($audioBlob) . '\'); return false;" style="color:#1e90ff;">Lire l\'audio</a>';
                    }else{
                        $msg = $row['msg']. '<br>';
                    }
                $output .= '<p>' . $msg . ' <span class="time">' . date("H:i", strtotime($row['date_message'])) . '</span><br>
                            </div>
                            </div>';
            }
            $current_date = $msg_date;
        }
    } else {
        $output .= '<div class="text">Aucune conversation trouvée. Soyez le premier à démarrer une conversation !</div>';
    }
    echo $output;
} else {
    header("location: ../../connexion/login/connexionSurho");
}
?>
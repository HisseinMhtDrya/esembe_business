<?php
session_start();
include_once "php/config.php";
$outgoing_id = $_SESSION['id'];
$user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
if (!isset($_SESSION['id'])) {
  header("location: ../");
}
$user_id = mysqli_real_escape_string($conn, $_SESSION['id']);
$incoming_id =  mysqli_real_escape_string($conn, $_GET['user_id']);
$sql = mysqli_query($conn, "UPDATE messages SET lu=1 WHERE incoming_msg_id = {$user_id} AND outgoing_msg_id = {$incoming_id}");
if (!$sql) {
  echo "Erreur de mise à jour" . mysqli_error($conn);
}
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = mysqli_query($conn, "SELECT * FROM membre_esembe WHERE id = {$user_id}");
        if (mysqli_num_rows($sql) > 0) {
          $row = mysqli_fetch_assoc($sql);
        } else {
          header("location: users");
        }
        ?>
        <a href="users" class="back-icon"><i class="bi bi-arrow-left"></i></a>
        <a href="users">
        <?php
          if(!empty($row['avatar']))
          {
         ?>
          <img src="../membres/avatars/<?php echo $row['avatar']; ?>" alt="Profil">
          <?php
          }elseif($row['sexe']=='Homme'){
          ?>
            <img src="../membres/avatars/default_h.jpeg" alt="Profil">
          <?php
           }else{
            ?>
              <img src="../membres/avatars/default_f.jpeg" alt="Profil">
            <?php
            }
         ?>
        </a>
        <div class="details">
          <span><?php echo $row['prenom'] . " " . $row['nom'] ?></span>
          <?php
          if ($row['status'] == 'En ligne') {
          ?>
            <p class="text-info"><?php echo $row['status']; ?></p>
          <?php
          } else {
            $message_date = $row['derniere_activite'];
            $date_conn = date("d/m/Y", strtotime($message_date));
          ?>
            <p class="text-info"><?php echo $date_conn; ?></p>
          <?php
          }
          ?>
        </div>
         <script>
        
        $(document).ready(function() {
      
      function updateStatus() {
        $.ajax({
          url: "update_lu.php",
          type: "GET",
          data: {
            id_user: <?php echo $row['id']; ?>
          },
          success: function(response) {
            
          },
          error: function() {
            
          }
        });
      }
      
      setInterval(updateStatus, 1000);
    });
         </script>
      </header>
    
               
             
      <div class="chat-box" id="chat" style="height:100vh;">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <a id="" class="btn" data-bs-toggle="modal" data-bs-target="#photo_album"><i class="bx bx-link"></i></a>
        
        <textarea name="message" id="message" cols="30" class="input-field" placeholder="Message" style=" resize: none;" rows="10"></textarea>
        <button id="sendButton" disabled><i class="bi bi-send"></i></button>
      </form>
      
    </section>

  </div>

    <div class="modal fade" id="photo_album" data-bs-backdrop="static" tabindex="-1">
                          <div class="modal-dialog">
                            <form form method="post" action="php/envoi_fichier.php" class="modal-content" enctype="multipart/form-data">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="backDropModalTitle">Importer un fichier</h5>   
                                <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                              </div>
                              <div class="modal-body">
                                <div class="row g-2">
                         
          <span class="btn btn-file">
           <i class="bi bi-download" style="font-size:40px"></i>
           <input type="file" class="form-control" name="avatar" id="demo_fichier" onchange="readFile();" required>
           <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
           <div class="shadow-lg p-3 mb-5 bg-white rounded"> 
           <a href="" id="result_fichier"></a>
           </div>
        </span><br>
    
    <input type="submit" class="btn btn-primary w-100" name="ajouter" value="Envoyer">
  </form>
                          </div>
                             <script type="text/javascript">
function readFile() {
    var reader = new FileReader();
    var file = document.getElementById('demo_fichier').files[0];
    reader.onload = function(e) {
        document.getElementById('result_fichier').href = e.target.result;
    }
    document.getElementById('result_fichier').textContent = file.name;
    reader.readAsDataURL(file);
}

</script>
                        </div>
        </div>
    </div>
    <script>
function openAudioPlayer(audioData) {
    var audioWindow = window.open('', '_blank');
    audioWindow.document.write('<audio controls><source src="' + audioData + '" type="audio/webm"></audio>');
}
</script>
  
  <script>
    const messageInput = document.querySelector('.input-field');
    const sendButton = document.getElementById('sendButton');

    messageInput.addEventListener('input', function() {
      if (messageInput.value.trim() !== '') {
        sendButton.disabled = false;
        sendButton.innerHTML = '<i class="ri ri-send-plane-2-fill"></i>';
      } else {
        sendButton.disabled = true;
        sendButton.innerHTML = '<i class="bi bi-send"></i>';
      }
    });
  </script>
  <script>
    function updateScroll() {
      var chatBox = document.getElementById("chat");
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    function fetchMessages() {
      var incomingId = <?php echo $user_id; ?>;
      $.ajax({
        url: "fetch_messages.php",
        type: "POST",
        data: {
          user_id: incomingId
        },
        success: function(data) {
          $("#chat").html(data);
          updateScroll();
        }
      });
    }
    setInterval(fetchMessages, 1000);
  </script>
  <script src="javascript/chat.js"></script>
  <script>
    $(document).ready(function() {
      function updateStatus() {
        $.ajax({
          url: "update_status.php",
          type: "POST",
          data: {
            user_id: <?php echo $user_id; ?>
          },
          success: function(response) {
            
          },
          error: function() {

          }
        });
      }
     
      setInterval(updateStatus, 1000);
    });
  </script>
  <script>
    var chatBox = document.getElementById('chat');
    chatBox.onscroll = function() {
    
      if (chatBox.scrollTop === 0) {
        chatBox.style.scrollBehavior = 'auto';
      } else {
        chatBox.style.scrollBehavior = 'smooth';
      }
    }
  </script>



<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="main.js"></script>
<script>
  document.onkeydown = 
   function(e){
    if(e.ctrlKey && e.which == 85){
      return false;
    }
   };
   
   document.addEventListener('contextmenu', function(event) {
  event.preventDefault();
});

document.addEventListener('keydown', function(event) {
  if (event.keyCode == 93 || event.keyCode == 91) {
    event.preventDefault();
  }
});
document.addEventListener('keydown', function(event) {
    if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === 's') {
        event.preventDefault();
        return false;
    }
});
document.addEventListener('keydown', function(e) {
    var isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
    if ((isMac && e.metaKey && e.keyCode === 85) || (!isMac && e.ctrlKey && e.keyCode === 85)) {
        e.preventDefault();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.metaKey && e.keyCode === 85) {
        e.preventDefault();
    }
});

</script>
</body>

</html>
<?php 
  session_start();
  include_once "php/config.php";

  if(!isset($_SESSION['id'])){
    header("location: ../");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
     <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM membre_esembe WHERE id = {$_SESSION['id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <?php
          if(!isset($_SESSION['messenger'])){
            ?>
          <a href="../esb_user/profil_esb?id=<?php echo $row['id']; ?>" class=""><i style="font-weight: 900;font-size:25px;" class="bi bi-arrow-left"></i></a>
          <?php  
        }else{
        ?>
        </div>
       
        <a href="../connexion/deconnexion?logout_id=<?php echo $row['id']; ?>" class=""><i style="font-weight: 900;font-size:25px;" class="bi bi-arrow-right"></i></a>
          
          <?php
        }
        ?>
      </header>
      <div class="search">
        <span class="text text-info">Rechercher</span>
        <input type="text" placeholder="Rechercher..">
        <button><i class="bi bi-search"></i></button>
      </div>
    
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>
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

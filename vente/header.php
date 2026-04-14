<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Esembe Business</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="../img/logo_esembe.jpg" rel="icon">
  <link href="../img/logo_esembe.jpg" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="../administration/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../administration/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../administration/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../administration/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../administration/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../administration/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../administration/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="../administration/assets/css/style.css" rel="stylesheet">
  <style>
    .table-warning {
        background-color: yellow; 
    }
</style>

</head>

<body>
<nav class="navbar navbar-light bg-light fixed-top">
  <a href="https://www.esembe-buzz.com" class="navbar-brand font-weight-bold text-primary" style="font-weight: 900;" >Esembe</a>
<div class="text-center">
    <?php
        if($userinfo['type'] == "Super Administrateur" OR $userinfo['type'] == "Super Administratrice" OR $userinfo['type'] == "Administratrice" OR $userinfo['type'] == "Administrateur"){
    ?>
      <a href="../administration/bureau_admin" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i></a>
    <?php
        }else{
            ?>
            <a href="../esb_user/profil_esb" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i></a>
            <?php
        }
    ?>
</div>
</nav>
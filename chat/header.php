<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Esembe business</title>

  <link href="vendor/emoji-picker/lib/css/emoji.css" rel="stylesheet">

  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendor/emoji-picker/lib/js/config.js"></script>
  <script src="vendor/emoji-picker/lib/js/util.js"></script>
  <script src="vendor/emoji-picker/lib/js/jquery.emojiarea.js"></script>
  <script src="vendor/emoji-picker/lib/js/emoji-picker.js"></script>

  <link href="../img/logo_esembe.jpg" rel="icon">
  
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style - Copie.css" />
    <!-- Template Stylesheet -->
    <link href="css/style_membre.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
<style>
      .aff {
        margin: 0;
        box-sizing: border-box;
        width: 100%;
        max-width: 100%;
        display: flex;
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        margin-bottom:10px;
      }
      .amis {
        display: flex;
        align-items: center;
        height: 80px;
      }
      .amis img {
        height: 50px;
        width: 50px;
        border-radius: 50%;
        margin-right: 10px;
      }
       .aff_ami {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 50px;
        margin: 3px 3px;
      }
      .amis span {
        font-size: 12px;
        margin-top: 55px;
        color: royalblue;
      }
      .icon-smile:before {
        content: " ";
        width: 16px;
        height: 16px;
        display: flex;
        background: url(icon-smile.png);
     }
    </style>
    <style>
    .popup {
      display: none;
      position: fixed;
      
      bottom: 0;
      background: #fff;
      width: 450px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      transition: all 1s ease;
      opacity: 0;
      transform: translateY(100%);
    z-index:9999;
    }
    .button {
            padding: 5px 10px;
            background: royalblue;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left:5px;
        }
  </style>
   <script>

    function togglePopup() {
      var popup = document.getElementById('popup');
      if (popup.style.display === "none" || !popup.style.display) {
        popup.style.display = "block";
        setTimeout(() => popup.style.opacity = 1, 10);
        setTimeout(() => popup.style.transform = "translateY(0)", 20);
      } else {
        popup.style.opacity = 0;
        popup.style.transform = "translateY(100%)";
        setTimeout(() => popup.style.display = "none", 1000);
      }
    }

  </script>
</head>
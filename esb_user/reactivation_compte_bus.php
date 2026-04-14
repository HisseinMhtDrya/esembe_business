<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RudLess</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/logorudless.jpeg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
 
  <link href="assets/css1/style.css" rel="stylesheet">
  
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

          
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-weight:900;">Réactivation Compte</h5>
                    <p class="text-center small">Veuillez déclinper fournir quelques informations pour réactiver votre compte</p>
                  </div>
                  <form role="form" method="POST" action="action_reactivation_compte_surho.php" class="registration-form row g-3 needs-validation" novalidate>
                        		
                    <fieldset>
                      <div class="form-bottom">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
                        
                          <div class="form-group">
                        <label for="form-first-name">Nom</label>
                          <input type="text" name="nom" placeholder="Votre nom..." class="form-first-name form-control" id="form-first-name">
                          <div class="invalid-feedback">Veuillez saisir votre nom !</div>
                        </div>
                          </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
                        <div class="form-group">
                          <label for="form-last-name">Prénom</label>
                          <input type="text" name="prenom" placeholder="Votre prénom..." class="form-last-name form-control" id="form-last-name">
                          <div class="invalid-feedback">Veuillez saisir votre prenom !</div>
                        </div>
                        </div>
                      </div><br>
                        <button type="button" class="btn btn-primary btn-next">Poursuivre la réactivation</button>      
                      </div>                    
                  </fieldset>
                
                  <fieldset>
                        <div class="form-bottom">
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
                              <div class="form-group">
                              
                              <label for="form-password">Mail</label>
                              <input type="email" class="form-password form-control" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" required/>
                                <div class="invalid-feedback">Veuillez saisir votre adresse mail !</div> 
                              </div>
                              </div>
                             
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6 col-6">
                        <div class="form-group">
                        
                        <label for="form-password">Mot de passe</label>
                        <input type="password" class="form-password form-control" placeholder="Votre mot de passe" id="mdp" name="mdp" value="<?php if(isset($mdp)) { echo $mdp; } ?>" required />
                     <div class="invalid-feedback">Veuillez définir votre mot de passe !</div>
                        </div>
                        </div>
                        </div><br>        
                        <button type="button" class="btn btn-primary btn-previous">Précédent</button>
                       
                    </div>  
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Réactiver mon compte</button>
                    </div>
                  </fieldset>    
                </form>
                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
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
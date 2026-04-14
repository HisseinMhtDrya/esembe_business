<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="../administration/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../administration/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../administration/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../administration/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../administration/assets/vendor/quill/quill.min.js"></script>
  <script src="../administration/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../administration/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../administration/assets/vendor/php-email-form/validate.js"></script>

  <script src="../administration/assets/js/main.js"></script>


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
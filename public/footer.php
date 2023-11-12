  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <script src="/learn-bot/agil-bot/public/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/learn-bot/agil-bot/public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/learn-bot/agil-bot/public/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/learn-bot/agil-bot/public/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/learn-bot/agil-bot/public/assets/vendor/quill/quill.min.js"></script>
  <script src="/learn-bot/agil-bot/public/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/learn-bot/agil-bot/public/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/learn-bot/agil-bot/public/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/learn-bot/agil-bot/public/assets/js/main.js"></script>
  <script src="/learn-bot/agil-bot/public/assets/js/action.js"></script>

  <script type="text/javascript">
  

    function mask(o, f) {
      setTimeout(function() {
        var v = mphone(o.value);
        if (v != o.value) {
          o.value = v;
        }
      }, 1);
    }

    function mphone(v) {
      var r = v.replace(/\D/g, "");
      r = r.replace(/^0/, "");
      if (r.length > 10) {
        r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
      } else if (r.length > 5) {
        r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
      } else if (r.length > 2) {
        r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
      } else {
        r = r.replace(/^(\d*)/, "($1");
      }
      return r;
    }
  </script>
  </body>

  </html>
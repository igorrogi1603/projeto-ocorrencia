<?php if(!class_exists('Rain\Tpl')){exit;}?><!---------------------------------------------------------------------------------------------------->
  <!---------------------------------------------------------------------------------------------------->
  <!---------------------------------------------------------------------------------------------------->
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Desenvolvido por: Igor Santos
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 <a href="#">Prefeitura de Nova Campina</a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!--Ajax para input file-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- jQuery 2.2.3 -->
<script src="/res/site/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/res/site/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="/res/site/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="/res/site/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/res/site/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/res/site/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="/res/site/plugins/daterangepicker/daterangepicker.js"></script>
<!-- DataTables -->
<script src="/res/site/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/res/site/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="/res/site/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="/res/site/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="/res/site/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="/res/site/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="/res/site/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="/res/site/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/res/site/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/res/site/dist/js/demo.js"></script>
<!--Mascaras de imput-->
<!--Tem que vir antes do local-mascaras-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
<!--JS local-->
<script src="/res/site/dist/js/js-local/local-js.js"></script>
<script src="/res/site/dist/js/js-local/local-mascaras.js"></script>

<!--Pagina Novas Ocorrencias-->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<!--Fim Pagina Novas Ocorrencias-->

</body>
</html>
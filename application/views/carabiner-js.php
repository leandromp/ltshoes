<!-- jQuery 2.0.2 -->
        <script>
            var URL_BASE='<?=site_url();?>';
        </script>
        <script src="<?=URL_BASE?>/js/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?=URL_BASE?>/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?=URL_BASE?>/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="<?=URL_BASE?>/js/raphael-min.js"></script>
        <script src="<?=URL_BASE?>/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?=URL_BASE?>/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?=URL_BASE?>/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?=URL_BASE?>/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?=URL_BASE?>/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?=URL_BASE?>/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?=URL_BASE?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?=URL_BASE?>/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?=URL_BASE?>/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

          <!-- date-range-picker -->
        <script src="<?=URL_BASE?>/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Jquery validator -->
        <script src="<?=URL_BASE?>/js/bootstrapValidator.min.js" type="text/javascript"></script>
      
        <!-- DATA TABES SCRIPT -->
        <script src="<?=URL_BASE?>/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?=URL_BASE?>/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
       
        <!-- Datepicker -->
        <script src="<?=URL_BASE?>/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
         

        <!-- AdminLTE App -->
        <script src="<?=URL_BASE?>/js/AdminLTE/app.js" type="text/javascript"></script>

        <script src="<?=URL_BASE?>/js/app.js"></script>
        <!-- reglas para la validacion -->
        <script src="<?=URL_BASE?>/js/validacion.js"></script>  <!-- archivo para validar los formularios -->

         <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

        <script type="text/javascript">
        $('#desde').datepicker({
            format: "yyyy/mm/dd",
            startDate: "2012-01-01",
            endDate: "2015-01-01",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true
        });

        $('#hasta').datepicker({
            format: "yyyy/mm/dd",
            startDate: "2012-01-01",
            endDate: "2015-01-01",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true
        });

         $('#fecha-nac').datepicker({
            format: "yyyy/mm/dd",
            startDate: "2012-01-01",
            endDate: "2015-01-01",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true
        });
        </script>
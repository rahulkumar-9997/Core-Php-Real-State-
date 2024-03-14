    <!-- jQuery 2.1.4 -->
    <script src="../../assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jquery ui -->
    <script src="../../assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!--datepicker-->
    <script src="../../assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Select -->
    <script src="../../assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- DataTables -->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- datepicker -->
    <script src="../../assets/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../assets/dist/js/demo.js"></script>
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
      
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
    //Datepicker
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd"
    }); 
    </script>
        
    
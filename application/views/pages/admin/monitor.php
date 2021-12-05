<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$title0?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url()?>bootstrap/css/bootstrap.min.css">
 
</head>

<body class="" id="loadm">
<?php
$this->load->view($view);

?>
 
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url()?>bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App Yang nav-->
<script src="<?=base_url()?>dist/js/app.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!--<script src="<?=base_url()?>plugins/slimScroll/jquery.slimscroll.min.js"></script>-->
<!-- FastClick -->
<!--<script src="<?=base_url()?>plugins/fastclick/fastclick.js"></script>-->
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes -->
<!--<script src="<?=base_url()?>dist/js/demo.js"></script>-->
<!-- page script -->
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
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
     <script type="text/javascript">
setInterval(function() { $("#load").load(""); }, 10000);
</script>
</body>

</html>

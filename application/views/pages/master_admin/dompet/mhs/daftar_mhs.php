 <section class="content-header" style="background: #ecedee;">
   
    
      <br/>
        <h1>
         <b>
         <a href="<?=base_url('C_dompet/dafatar_pemesan_voucher/?vo=4')?>"> 
         <span class="glyphicon glyphicon-arrow-left"></span> 
         </a> DAFTAR MAHASISWA</b>
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
   	<!-- Nav tabs -->
   

<div class="box">

<h3>DAFTAR MAHASISWA AKTIF

  <span class="pull-right">
    
    <a href="<?=base_url('C_upxls/hpusData')?>" class="btn btn-danger">
    <span class="glyphicon glyphicon-trash"></span> Hapus Data</a>
    <a target="_blank" href="<?=base_url('C_upxls/?nprodi=')?>" class="btn btn-warning">
    <span class="glyphicon glyphicon-cloud-upload"></span> Upload Excel</a>
        
    </span>
  
</h3>

<div class="tab-content">
  <div class="tab-pane active" id="home">
  
  <table id="employee-grid" class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>NIM</th>
                    <th>Nama</th>
                    <!-- <th width="20%">NIM</th> -->
                    <th>PRODI</th>
                    <th>VOUCHER</th>
                    <th>Email</th>
                    <th>STATUS</th>
                  </tr>
                  </thead>
                   <tfoot>
                  <tr bgcolor="#d9d9dd">
                    <th>NIM</th>
                    <th>Nama</th>
                    <!-- <th width="20%">NIM</th> -->
                    <th>PRODI</th>
                    <th>VOUCHER</th>
                    <th>Email</th>
                    <th>STATUS</th>
                  </tr>
                  </tfoot>
                </table>

    </div>

      <div class="employee-grid-error"></div>

                    
                <table class="table no-margin">

                  <?php
                  ///hitpenermavoc_peg
                  ?>

                  <tr bgcolor="#d9d9dd">
                    <th>Total  : <?php //$penvoc['num']?></th>
                  </tr>
                  <tr bgcolor="#d9d9dd">
                    <th>Sudah Mendaftar (belum menerima voucher) : <?php //$penvoc['terdaftar']?></th>
                   
                  </tr>
                  <tr bgcolor="#d9d9dd">
                    <th>Sudah Menerima Voucher : <?php //$penvoc['menerima']?></th>
                   
                  </tr>
                 
                  <tr bgcolor="#d9d9dd">
                    <th>Belum Mendaftar : 
                      <?php //$penvoc['belumDaftar']?>
                         
                    </th>
                   
                   
                   
                  
                </table>

</div>
</div>	
	
    </section>
 
<script type="text/javascript" language="javascript" >
      $(document).ready(function() {
        var dataTable = $('#employee-grid').DataTable( {
          "processing": true,
          "serverSide": true,

          "ajax":{
            url : "<?=base_url('C_upxls/mhsExelJson')?>", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
              $(".employee-grid-error").html("");
              // $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#employee-grid_processing").css("display","none");
              
            }
          }
        } );
      } );
    </script>

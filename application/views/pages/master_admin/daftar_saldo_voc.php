 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar</li>
      </ol>
      <br/>
        <h1>
         <b>Daftar Voucher Akun</b>
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

  <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Penjual</th>
                    <th>Saldo Voucher</th>
                    <th>Saldo Voucher Dibelanjakan</th>
                    <th>Dompet ( Saldo Hasil Penjualan )</th>
                    <th>Dompet Dicairkan</th>
                    <th>Tahap Awal</th>
                    <th>Tahap Terakhir</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $get_all_id_produk=$this->Madmin_master->get_all_Penjual_all();
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td>
                    <a data-toggle="collapse" data-parent="#accordion<?=$gidp->idlog?>" href="#collapseOne<?=$gidp->idlog?>">
         <?=$gidp->nama?> 
        </a> ( <?=$gidp->idlog?> )
                    </td>
                   <td><?=$gidp->voucher_umy?></td>
                   <td><?=$gidp->voucher_dibelanjakan?></td>
                   <td><?=$gidp->dompet?></td>
                   <td><?=$gidp->dompet_dicairkan?></td>
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                                
                  </tbody>
                </table>
              </div>	
			
	
    </section>
    
   
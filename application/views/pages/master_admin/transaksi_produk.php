 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b>DAFTAR TRANSAKSI</b>
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
    
     <div class="well" align="center">
        <h3><span class="pull-left">
        <?php
        	$blnaray=array(
					'1'=>'Januari',
					'2'=>'Februari',
					'3'=>'Maret',
					'4'=>'April',
					'5'=>'Mei',
					'6'=>'Juni',
					'7'=>'Juli',
					'8'=>'Agustus',
					'9'=>'September',
					'10'=>'Oktober',
					'11'=>'November',
					'12'=>'Desember',
					);
        $thn_a=$thn+1;
        $thn_b=$thn-1;
        ?>
        <a href="<?=base_url('Master_admin/daf_transaksi/'.$thn_b)?>"><?=$thn-1?></a></span>
        <b>Tahun <?=$thn?></b><span class="pull-right">
        <a href="<?=base_url('Master_admin/daf_transaksi/'.$thn_a)?>"><?=$thn+1?></a></span></h3>
        
    </div>
    
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
	
	<div class="box box-info">
            <div class="box-header with-border">

             
            <!-- /.box-header -->
            <div class="box-body">
            
<br/>            
              <div class="table-responsive">
               <table class="table no-margin">
	 <tr bgcolor="#b7bdb8">
		 <th>Bulan</th>
        <th>Total</th>
	</tr>
		
	<?php
	
                  
                  ////induk
                $get_all_id_produk=$this->Madmin_master->get_all_transaksi_grupbln($thn);
                
                if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				foreach($get_all_id_produk->result() as $gidp0){ 
				  ///16/5/17
				  //$totbln=$this->Madmin_master->total_transaksiperbln_thn($gidp0->bln,$sort,$thn);
				  $totbln=$this->Madmin_master->total_tanpa_sort($gidp0->bln,$thn);
				  ///16/5/17
				  
				  	///list bulan
				  	?>
				  	<tr>
					<td>
                    <a  href="<?=base_url('Master_admin/transaksi/')?><?=$gidp0->bln?>/<?=$thn?>/a1/2">
                    <b><?=$blnaray[$gidp0->bln]?> <?=$gidp0->thn?></b>
                    </a>
                    </td>
					<td>
						<?php
					
                    	echo number_format($totbln,0,',','.') ;
						
						?>
						
					</td>
				
					
					</tr>
				  	<?php
				  }
					///grup
				  }
				  //if
	?>
	
               </table>
               
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
	
		</div>
    </section>
    
    <?php
   
    ?>
    
   
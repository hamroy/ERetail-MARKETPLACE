 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b>TRANSAKSI</b>
        <small></small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>
        <li class="active">Transaksi</li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    
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
        <a href="<?=base_url('User_admin/transaksi/'.$thn_b)?>"><span class="glyphicon glyphicon-chevron-left"></span> <?=$thn-1?></a></span>
        <b>Tahun <?=$thn?></b><span class="pull-right">
        <a href="<?=base_url('User_admin/transaksi/'.$thn_a)?>"> <?=$thn+1?> <span class="glyphicon glyphicon-chevron-right"></span></a></span></h3>
        
    </div>
    
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
	
                  
                  
                  $get_all_id_produk=$this->Madmin_master->get_all_transaksi_grupbln($thn);
                
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  foreach($get_all_id_produk->result() as $gidp0){ 
				  	 ////di susun perbulan
				  if($sort==NULL){
				  	//$get_id_produk=$this->Madmin->get_all_transaksi($gidp0->bln,$this->session->userdata('id_user'));
				  	$get_id_produk=$this->Madmin->get_all_transaksi_perbln($gidp0->bln,$this->session->userdata('id_user'),$thn); //terbaru
				  	//$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($gidp0->bln);
				  	 //$get_all_id_produk=$this->Madmin->get_all_transaksi($this->session->userdata('id_user'));
				  }elseif($sort==1){
				  	//$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_qty($gidp0->bln);
				  }elseif($sort==2){
				  	//$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_harga($gidp0->bln);
				  }
				  ///16/5/17
				  $totbln=$this->Madmin_master->total_transaksiperbln_id($gidp0->bln,$this->session->userdata('id_user'),$thn);
				  ///16/5/17
				  
				  	///list bulan
				  	?>
				  	<tr>
					<td>
                   
                    <a href="<?=base_url('User_admin/transaksi_rinci/'.$gidp0->thn.'/'.$gidp0->bln)?>">
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
    
   
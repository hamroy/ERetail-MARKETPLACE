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
        <a href="<?=base_url('Master_admin/daf_transaksi/'.$thn_b)?>"><?=$thn-1?></a></span>
        <b>Tahun <?=$thn?></b><span class="pull-right">
        <a href="<?=base_url('Master_admin/daf_transaksi/'.$thn_a)?>"><?=$thn+1?></a></span></h3>
        
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
                  	
                  	?>
	<?php
	
                  
                  
                  $get_all_id_produk=$this->Madmin_master->get_all_transaksi_grupbln();
                
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp0){ 
				  	 ////di susun perbulan
				  if($sort==NULL){
				  	$get_id_produk=$this->Madmin->get_all_transaksi($gidp0->bln,$this->session->userdata('id_user'));
				  	//$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($gidp0->bln);
				  	 //$get_all_id_produk=$this->Madmin->get_all_transaksi($this->session->userdata('id_user'));
				  }elseif($sort==1){
				  	//$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_qty($gidp0->bln);
				  }elseif($sort==2){
				  	//$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_harga($gidp0->bln);
				  }
				  ///16/5/17
				  $totbln=$this->Madmin_master->total_transaksiperbln_id($gidp0->bln,$this->session->userdata('id_user'));
				  ///16/5/17
				  
				  	///list bulan
				  	?>
				  	<tr>
					<td><a data-toggle="collapse" data-parent="#accordion<?=$gidp0->bln?>" href="#collapseOne<?=$gidp0->bln?>">
         <b><?=$blnaray[$gidp0->bln]?> <?=$gidp0->thn?></b>
        </a></td>
					<td>
						<?php
						echo number_format($totbln,0,',','.') ;
						
						?>
						
					</td>
					<tr>
						<td colspan="2">
	<div id="collapseOne<?=$gidp0->bln?>" class="panel-collapse collapse">
      <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai Transaksi</th>
                    <th>Pembayaran</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  
                  
                  
                
				  	
				 
				   $totperbln=0;
                  	foreach($get_id_produk->result() as $gidp){
						
					
				  	
				  	if($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0){
					$getpembeli=$this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;	
					
					if(empty($getpembeli)){
						$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli='(penjual)'.$getuser->row()->nama;
						}else{
							$getpembeli='user kosong';
						}
					}else{
					$getpembeli=$getpembeli;	
					}
					
						
					}else{
						
					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli='(penjual)'.$getuser->row()->nama;
						}else{
							$getpembeli='pembeli kosong';
						}	
					
					
					}
					
					if($this->Madmin_master->get_user_produk($gidp->id_pelapak)->num_rows() > 0){
					$getpenjual=$this->Madmin_master->get_user_produk($gidp->id_pelapak)->row()->nama;	
						
					}else{
					$getpenjual='';
					}
					if($this->Madmin_master->get_produk_produkid($gidp->id_produk)->num_rows() > 0){
					$getproduk=$this->Madmin_master->get_produk_produkid($gidp->id_produk)->row()->nama;	
						
					}else{
					$getproduk='';
					}
					  
				  	?>
					<tr >
                    <td><?=$no++?></td>
                     <td><?=$getpembeli?></td>
                    <td><?=$getproduk?></td>
                    <td><?=$gidp->qty?></td>
                    <td align="right">
                    <?php
                    if(empty($this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak)){
			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->harga;	
			}else{
			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak;	
			}
			if($gidp->harga_satuan!=0){
				$akhirsat=$gidp->harga_satuan;
			}else{
				$akhirsat=$hrgasatuan;
			}
                    ?>
                    <?=number_format($akhirsat,0,',','.')?></td>
                    <td align="right"><?=number_format($akhirsat*$gidp->qty,0,',','.')?></td>
                   
                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>
                    <td><?=$gidp->metode?></td>
                   
                  </tr>  
				<?php	
					$totperbln=$totperbln+$akhirsat*$gidp->qty;
					}
                  ////di susun perbulan
                  ?>
                  <tr style="background-color: #b3b3b9">
                  	<td colspan="6" align="right">
                  
                  			<b>Total Bulan <?=$blnaray[$gidp0->bln]?> <?=$gidp->thn?></b>
                  	</td>
                  	<td colspan="4"  align="center">
                  			<b><?=number_format($totperbln,0,',','.')?> </b>                 	</td>
                  </tr>
                  
                  <?php
					
                  ?>
                                
                  </tbody>
                </table>
    </div>

						
						
					</td>
					</tr>
					
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
    
   
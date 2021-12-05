 <div class="table-responsive">
 <?php
	
                  
                  
                $get_all_id_produk=$this->Madmin_master->get_all_transaksi_grupbln();
                
                $sort=NULL;
				  
				  	///list bulan
				  	?>
				  	<?php
                  	$blnaray=array(
					'0'=>'Bulan',
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
				  	
				  	<table class="table no-margin">
	 <tr bgcolor="#b7bdb8">
		 <th>Bulan</th>
        <td align="right">Total</td>
	</tr>
	<?php
	if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				foreach($get_all_id_produk->result() as $gidp0){ 
				$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($gidp0->bln);
				///16/5/17
				  $totbln=$this->Madmin_master->total_transaksiperbln($gidp0->bln,$sort);
				///16/5/17
				  
				  ?>
				  <tr>
				<td ><a data-toggle="collapse" data-parent="#accordion<?=$gidp0->bln?>" href="#collapseOnetran<?=$gidp0->bln?>">
         <b><?=$blnaray[$gidp0->bln]?> <?=$gidp0->thn?></b>
        </a></td>
					<td align="right">
						<?php
						//echo 'Rp '.number_format($totbln,0,',','.') ;
						
						?>
						
					</td>
					<tr>
						<td colspan="2">
	<div id="collapseOnetran<?=$gidp0->bln?>" class="panel-collapse collapse">
      <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Nama Penjual</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Jenis Transaksi</th>
                  <!--  <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai Transaksi</th>
                    <th>Pembayaran</th>-->
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
                     <td><?=$getpenjual?></td>
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
                    <!--<td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>-->
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
                  	<td colspan="1"  align="right">
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
				}
	?>
	</table>
</div>
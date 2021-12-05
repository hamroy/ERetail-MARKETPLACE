<table class="table no-margin">
                  <thead>
                  <?PHP
                  
                  $h = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
$hm = $h * 60;
$ms = $hm * 60;
$tanggal = gmdate("d-m-Y ", time()+($ms)); //	 the "-" can be switched to a plus if that's what your time zone is.
$waktu = gmdate ( "H:i:s ", time()+($ms));
$hariini = gmdate('d-m-Y H:i:s', time() + ($ms));
		//////////////
		//======================
   			    $xxxxx=substr($hariini,'14','2');
   				$xxxx=substr($hariini,'11','2');
   				$xxx=substr($tanggal,'0','2'); //tanggal
				$xx=substr($tanggal,'3','2'); //bln
				$x=substr($tanggal,'6','4'); //thn
				$tgl1=$x.''.$xx.''.$xxx.''.$xxxx.''.$xxxxx;
                  
                  $get_id_produk=$get_id_produk=$this->Madmin->get_all_transaksi_monitor_day($xxx,$xx,$x);
                  ?>
                  <tr bgcolor="#b7bdb8">
                    <th colspan="5"><?=$get_id_produk->NUM_ROWS()?> Baris  </th>
                    <th colspan="6">TAnggal <?=$hariini?> </th>
                    
                  </tr>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                     <th>Nama Pembeli</th>
                    <th>Nama Pembeli Akun</th>
                    <th>Nama Penjual</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai Transaksi</th>
                    <th>Pembayaran</th>
                    <th>PROSES</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  
                  
                  
                
					
				   $no=1;
				   $totperbln=0;
				   $tottunai=0;
				   $totvoc=0;
                  	foreach($get_id_produk->result() as $gidp){
						
					
				  	
				  	
					
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
					 
								if($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0){
					$getpembeli=$this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;	
					
					/*if(empty($getpembeli)){
						$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli='(penjual)'.$getuser->row()->nama;
						}else{
							$getpembeli='user kosong';
						}
					}else{
					$getpembeli=$getpembeli;	
					}
					//*/
						
					}else{
						
					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli='(penjual)'.$getuser->row()->nama;
						}else{
							$getpembeli='pembeli kosong';
						}	
					
					
					}
					
					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli_akun=$getuser->row()->nama;
							$voucerbelanjakan=$getuser->row()->voucher_dibelanjakan;
						}else{
							$getpembeli_akun='';
							$voucerbelanjakan='0';
						}		
				
					if($gidp->qty == 0){
						$wqty='style="background-color: #ff0000"';
					}else{
						$wqty='';
					}
					if($gidp->harga_satuan == 0){
						$wsat='style="background-color: #ff0000"';
					}else{
						$wsat='';
					}				 
					  
				  	?>
				  	<?php
				  	 
				  	 if($gidp->metode == 'VOUCHER'){
				  	 if($voucerbelanjakan < $gidp->harga_satuan*$gidp->qty and $gidp->buy=='dipesan')
					 	{
						$wmet='style="background-color: #ff0000"';
						}else{
					 	$wmet='';
					 	}
					 }else{
					 	
					 	$wmet='';
					 }
				  	 
				  	 ?>
					<tr >
                    <td><?=$gidp->id?></td>
                      <td><?=$getpembeli?> ( <?=$gidp->id_pembeli?> )</td>
                    <td><?=$getpembeli_akun?> ( <?=$gidp->id_user?> )</td>
                     <td><?=$getpenjual?> ( <?=$gidp->id_pelapak?> )</td>
                    <td><?=$getproduk?> ( <?=$gidp->id_produk?> )</td>
                    <td <?=$wqty?>><?=$gidp->qty?></td>
                    <td  <?=$wsat?> align="right">
                    
                    <?=number_format($gidp->harga_satuan,0,',','.')?></td>
                   
                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>
                    <td <?=$wmet?> >
                    
                    <?=$gidp->metode?> ( <?=$gidp->harga_satuan*$gidp->qty?> || <?=$voucerbelanjakan?> ) 
                    	
                    </td>
                    <td><?php
                    
                    echo $gidp->buy;
                    ?></td>
                   
                  </tr>  
				<?php	
				}
				
					//echo $totperbln=$totperbln+$akhirsat*$gidp->qty;
                  ////di susun perbulan
                  
                  ?>
                  
                  <?php
					
                  ?>
                  
                                
                  </tbody>
                </table>
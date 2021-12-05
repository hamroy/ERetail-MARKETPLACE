<script type="text/javascript">
 setTimeout(function(){
   window.location.reload(1);
}, 5000);
 
</script>


<table class="table no-margin">
                  <thead>
                  <?PHP
                  $get_id_produk0=$this->Madmin->get_all_transaksi_monitor();
                  $get_id_produk=$this->M_monitor->get_all_transaksi_refresh();
                  ?>
                  <tr bgcolor="#b7bdb8">
                    <th colspan="12"><?=$get_id_produk0->NUM_ROWS()?> Baris</th>
                    
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
                    <th>KET ERROR</th>
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
					    $bg0=""	;
					}else{
                          if($gidp->buy=='dipesan' and $gidp->metode == 'VOUCHER'){
                                 $bg0="error ID_PEMBELI KOSONg";
                                }else{
                                  $bg0="";
                                }
                            
                       
                    }
					
				$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli_akun=$getuser->row()->nama;
							$voucerbelanjakan=$getuser->row()->voucher_dibelanjakan;
                            $bg0_1="";
						}else{
							$getpembeli_akun='';
							$voucerbelanjakan='0';
                            
                            
                           
                            
                             if($gidp->buy=='dipesan' and $gidp->metode == 'VOUCHER'){
                                $bg0_1="error AKUN SALAH"      ;
                                }else{
                                 $bg0_1=""    ;
                                }
                            
                            
						}		
				
					if($gidp->qty == 0){
						$wqty='style="background-color: #ff0000"';
                        $bg1='error KUANTITAS';
					}else{
						$wqty='';
                        $bg1='';
					}
					if($gidp->harga_satuan == 0){
						$wsat='style="background-color: #ff0000"';
                        $bg2='error HARGA SATUAN';
					}else{
						$wsat='';
                        $bg2='';
					}				 
					  
				  	?>
				  	 <?php
				  	 
				  	 if($gidp->metode == 'VOUCHER'){
				  	 if($voucerbelanjakan < $gidp->harga_satuan*$gidp->qty and $gidp->buy=='dipesan')
					 	{
						$wmet='style="background-color: #ff0000"';
                        $bg3='error KUOTA VOUCHER';
						}else{
					 	$wmet='';
                         
                         $bg3='';
					 	}
					 }else{
					 	
					 	$wmet='';
                        $bg3='';
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
                    <td><?php
                    
                    echo $bg0 ."<br/>";
                    echo $bg0_1 ."<br/>";
                    echo $bg1 ."<br/>";
                    echo $bg2 ."<br/>";
                    echo $bg3 ."<br/>";
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
                
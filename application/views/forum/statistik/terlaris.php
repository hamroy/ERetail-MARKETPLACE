 <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga Satuan</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  
                  
                  
                
				  	
				 //$get_id_produk=$this->Madmin_master->get_transaksi_all_qty();
				 $get_id_produk=$this->Madmin_master->get_transaksi_all_qty_laris();
				   $totperbln=0;
				   $no=1;
                  	foreach($get_id_produk->result() as $gidp){
						
					
				  	
				  	
					if($this->Madmin_master->get_produk_produkid($gidp->id)->num_rows() > 0){
					$getproduk=$this->Madmin_master->get_produk_produkid($gidp->id)->row()->nama;	
						
					}else{
					$getproduk='';
					}
					  
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><blink><a href="<?=base_url('Welcome/produk/'.$gidp->id)?>"><?=$getproduk?></a></blink> </td>
                    <td align="right"><?=number_format($this->Madmin->get_produk_by_id($gidp->id)->row()->harga,0,',','.')?></td>
                   
                  </tr>  
				<?php	
					}
                  ////di susun perbulan
                  ?>
                  
                  <?php
					
                  ?>
                                
                  </tbody>
                </table>
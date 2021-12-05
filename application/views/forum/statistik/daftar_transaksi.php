 <div class="table-responsive" style="padding-left: 50px;padding-right: 50px">
 <?php
	
                  
                  
                $get_all_id_produk=$this->Madmin_master->get_all_transaksi_grupbln();
                
				  
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
				 $totbln=$this->Madmin_master->total_transaksiperbln($gidp0->bln,NULL);
				  ///16/5/17
				  
				  ?>
				 <tr>
				<td ><a href="<?=base_url('C_kom/info_rinci_transaksi/2/')?><?=$gidp0->bln?>">
         <b><?=$blnaray[$gidp0->bln]?> <?=$gidp0->thn?></b>
        </a></td>
					<td align="right">
						<?php
						echo 'Rp '.number_format($totbln,0,',','.') ;
						
						?>
						
					</td>
                    </tr>
				  <?php
				
				}
				}
	?>
	</table>
</div>
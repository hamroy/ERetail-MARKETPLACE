 <section class="content-header" style="background: #ecedee;">

    

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>

        <li class="active">Daftar transaksi Penjualan Member</li>

      </ol>

      <br/>

        <h1>

         <b>TRANSAKSI PENJUALAN</b>

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

                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  $get_all_id_produk=$this->Madmin_master->get_all_Penjual_all();

                  if($get_all_id_produk->num_rows() > 0){

                  	$no=1;

				  	foreach($get_all_id_produk->result() as $gidp0){ 

                      

                    $get_id_produk=$this->Madmin->get_all_transaksi_id_user_obatal_dibeli($gidp0->idlog);

                      

				    if($get_id_produk->num_rows() == 0){

                        continue;

                    }

				  	?>

					<tr >

                    <td><?=$no++?></td>

                    <td>

                    <a data-toggle="collapse" data-parent="#accordion<?=$gidp0->idlog?>" href="#collapseOne<?=$gidp0->idlog?>">

         <?=$gidp0->nama?> 

        </a> ( <?=$gidp0->idlog?> )

                    </td>

                    <tr>

						<td colspan="2">

	<div id="collapseOne<?=$gidp0->idlog?>" class="panel-collapse collapse in">

	<div class="table-responsive">

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

                    <th>PROSES</th>

                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                

				

				   $no1=1;

				   $totperbln=0;

				   $tottunai=0;

				   $totvoc=0;

                  	foreach($get_id_produk->result() as $gidp){

						

					

				  	

				  	

					

					/*if($this->Madmin_master->get_user_produk($gidp->id_user)->num_rows() > 0){

					$getpembeli=$this->Madmin_master->get_user_produk($gidp->id_pelapak)->row()->nama;	

					

					}else{

					

					

					} //*/

					if($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0){

					$getpembeli=$this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;	

					}else{

						$getpembeli='';

					}	

					

					if($this->Madmin_master->get_produk_produkid($gidp->id_produk)->num_rows() > 0){

					$getproduk=$this->Madmin_master->get_produk_produkid($gidp->id_produk)->row()->nama;	

						

					}else{

					$getproduk='';

					}

					  

				  	?>

					<tr >

                    <td><?=$no1++?></td>

                     <td><?=$getpembeli?></td>

                    <td><?=$getproduk?></td>

                    <td><?=$gidp->qty?></td>

                    <td align="right">

                    <?php

            /*if(empty($this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak)){

			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->harga;	

			}else{

			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak;	

			}
            //*/
			if($gidp->harga_satuan!=0){

				$akhirsat=$gidp->harga_satuan;

			}else{

				$akhirsat='1';

			}

                    ?>

                    <?=number_format($akhirsat,0,',','.')?></td>

                    <td align="right"><?=number_format($akhirsat*$gidp->qty,0,',','.')?></td>

                   

                    <td><?=$gidp->tgl_trans?></td>

                    <td><?=$gidp->tgl_otorisasi?></td>

                    <td><?=$gidp->metode?>

                    	<?php

                    	switch($gidp->metode){

						case 'VOUCHER':

						$totvoc=$totvoc+$akhirsat*$gidp->qty;

						break;

						case 'TUNAI':

						$tottunai=$tottunai+$akhirsat*$gidp->qty;

						break;

						}

                    	?>

                    </td>

                    <td><?php

                    

                    switch($gidp->buy){

						case 'dipesan':

						echo 'PESAN';

						

						break;

						case 'dibayar':

						echo 'SELESAI';

						break;

						case 'Batal_ot':

						echo 'Di Tolak';

						break;

					}

                    ?></td>

                   

                  </tr>  

				<?php	

					//echo $totperbln=$totperbln+$akhirsat*$gidp->qty;

					}

                  ////di susun perbulan

                  ?>

                  

                  <?php

					

                  ?>

                  <tr>

                  <td></td>

                  	<th>TOTAL PENDAPATAN TUNAI</th>

                  	<td><?=number_format($tottunai,0,',','.')?></td>

                  </tr>

                   <tr>

                                     <td></td>



                  	<th>TOTAL PENDAPATAN VOUCHER</th>

                  	<td><?=number_format($totvoc,0,',','.')?> ( V: <?=$gidp0->dompet?> )

                  		<?php

                  		 $get_reedeem=$this->Mbmt->get_tbl_reedeem_perid_user($gidp0->idlog);

                  		 $get_reedeem_setuju=$this->Mbmt->get_tbl_reedeem_perid_user_awl($gidp0->idlog);

                  		 echo '( R: '.$get_reedeem.')';

                  		 $totalsmentr=$gidp0->dompet+$get_reedeem;

                  		 //echo '( T: '.$totalsmentr.')';

                           

                  		if($totvoc != $totalsmentr ){

							echo '<span class="text-danger">salah</span>';	

							

						}

                        

                        if($gidp0->dompet_dicairkan !=  $get_reedeem_setuju){

                            echo '<br/><span class="text-danger">salah  == '.$gidp0->dompet_dicairkan.'</span>';	

                            echo '<br/>benar == '.$get_reedeem_setuju;

                        }

                        

                        

                  		?>

                  		

                  	</td>

                  </tr>

                  <tr>

                                    <td></td>



                  	<th>TOTAL PENDAPATAN SEMUA</th>

                  <td><?=number_format($tottunai+$totvoc,0,',','.')?></td>

                  </tr>

                                

                  </tbody>

                </table>

              </div>

    </div>



						

						

					</td>

					</tr>

                   

                  </tr>  

				<?php	}

				  }

                  ?>

                                

                  </tbody>

                </table>

              </div>	

			

	

    </section>

    

   
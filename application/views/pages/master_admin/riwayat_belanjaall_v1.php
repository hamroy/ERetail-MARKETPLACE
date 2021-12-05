 <section class="content-header" style="background: #ecedee;">

    

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>

        <li class="active">Daftar transaksi Belanja Member</li>

      </ol>

      <br/>

        <h1>

         <b>TRANSAKSI PEMBELIAN</b>

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

                    <th>Nama Pembeli</th>

                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  //$get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);

                  $get_all_id_produk=$this->Madmin_master->get_all_Penjual_all();

                  if($get_all_id_produk->num_rows() > 0){

                  	$no=1;

				  	         foreach($get_all_id_produk->result() as $gidp0){ 

                      $get_id_produk=	$get_id_produk=$this->Madmin->get_all_transaksi_id_user_obatal($gidp0->idlog);

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

                    <th>Nama Penjual</th>

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

                  

	//$get_id_produk=	$get_id_produk=$this->Madmin->get_all_transaksi($this->session->userdata('id_user'));

					

				   $no1=1;

				   $totperbln=0;

				   $tottunai=0;

				   $totvoc=0;

				   $totvoc_pered=0;
				   $totvoc_pered_pesan=0;

                  	foreach($get_id_produk->result() as $gidp){

					///////////////////

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

					///////////////////	

                    

                    $id_voc_s=$this->M_voucher->get_max_id_voc();   

				  	

				  	if($id_voc_s==$gidp->id_voc ){

                        $totvoc_pered=$totvoc_pered+$akhirsat*$gidp->qty;

                    }
                    if($id_voc_s==$gidp->id_voc and $gidp->buy=="dipesan" ){

                        $totvoc_pered_pesan=$totvoc_pered_pesan+$akhirsat*$gidp->qty;

                    }

					

                    ///////////////////	

					

					/////////////

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

                    <td><?=$no1++?></td>

                     <td><?=$getpenjual?></td>

                    <td><?=$getproduk?></td>

                    <td><?=$gidp->qty?></td>

                    <td align="right">

                   

                    <?=number_format($akhirsat,0,',','.')?></td>

                    <td align="right"><?=number_format($akhirsat*$gidp->qty,0,',','.')?></td>

                   

                    <td><?=$gidp->tgl_trans?></td>

                    <td><?=$gidp->tgl_otorisasi?></td>

                    <td><?=$gidp->metode?>

                    	<?php

                    	switch($gidp->metode){

						case 'VOUCHER':

                        

                        if($gidp->buy=="dipesan" or $gidp->buy=="dibayar"){

                        $totvoc=$totvoc+$akhirsat*$gidp->qty;    

                        }

                        

						

						break;

						case 'TUNAI':

                        

                         

                        if($gidp->buy=="dipesan" or $gidp->buy=="dibayar"){

                        $tottunai=$tottunai+$akhirsat*$gidp->qty;

                        }

						

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

                        case 'expired':

						echo 'expired';

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

                  	<th>TOTAL TUNAI</th>

                  	<td><?=number_format($tottunai,0,',','.')?></td>

                  </tr>

                   <tr>

                                     <td></td>



                  	<th>TOTAL VOUCHER</th>

                  	<td width="20%"><?=number_format($totvoc,0,',','.')?>

                  		<?php

							echo ' (Sisa Voucher ['.$gidp0->voucher_umy.'] )';

							

                          // $saldo_v_awal=$this->Login_model->get_saldo_pertama_id_user($gidp0->idlog);

                          ////ED VOC

                            $saldo_v_awal=$this->Login_model->get_saldo_pertama_id_user_ed($gidp0->idlog,$id_voc_s);

                            //echo 'get_saldo_voucher'.

                            $saldo_v=$this->Login_model->get_saldo_id_user($gidp0->idlog);

                            $sis=$saldo_v_awal - $totvoc_pered; //diterima-dipake
                           
                            if($totvoc_pered_pesan != $gidp0->voucher_dibelanjakan){ //pesan prosuk
                                echo '<br>ERROR 924893 {PRODUK DIPESAN}';
                                echo '<br/>TRUE '.$totvoc_pered;
                            }
                            
							if($totvoc_pered+$gidp0->voucher_umy != $saldo_v_awal ){

							echo '<br/><p class="text-danger">salah</p> <br/>';

                            echo 'saldo AWAL == '.

                            $saldo_v_awal.'<br/>';

                           // echo 'saldo voucher == '.

                            $saldo_v ;

                             echo 'ed now == '.

                            $totvoc_pered ;

                            

                            echo '<br/> sisa == '. $sis; //sisa voucer

                          //  echo '<br/> == '.($saldo_v_awal+$saldo_v)-$totvoc; //sisa voucer

                            

							}

                  		?>

                  		

                  	</td>

                  </tr>

                  <tr>

                                    <td></td>



                  	<th>TOTAL SEMUA</th>

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

    

   
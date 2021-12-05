 <section class="content-header" style="background: #ecedee;">

    

      <h1>

         <b>RINCI PRODUK DIPESAN</b>

        <small></small>

      </h1>

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>

        <li class="active">Produk dipesan</li>

      </ol>

    </section>

 

    <!-- Main content -->

    <section class="content">

<?php

	$message = $this->session->flashdata('pesan');

    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

    ?>

    <!--NAV-->

	

	<div class="box box-info">

            <div class="box-header with-border">

              <h3 class="box-title"><a href="<?=base_url('User_admin/barang_dipesan')?>"><i class="fa fa-arrow-left"></i> KEMBALI </a></h3>



              <div class="box-tools pull-right">

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              <div class="table-responsive">

                <table class="table no-margin">

                  <thead>

                  <tr bgcolor="#d9d9dd">

                    <th>No</th>

                    <th>Nama Pembeli</th>

                    <th>Email</th>

                    <th>No.hp</th>

                    <th>Produk</th>

                    <th>Kuantitas</th>

                    <th>Harga Satuan</th>

                    <th>Sub total</th>

                    <th>Pembayaran</th>

                    <th>Tanggal Transaksi</th>

                    <th>Status</th>

                    <th>Action</th>

                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  ////di grup produk dan id tgl

                  

                  $get_all_id_produk=$this->Madmin->get_Produk_dipesan_perid($this->session->userdata('id_user'),$id);

                  if($get_all_id_produk->num_rows() > 0){

                  	$no=1;

				  	foreach($get_all_id_produk->result() as $gidp){ 

				  	

                $sgetuser=$gt_id_pem=$this->Madmin->getidpembeli($gidp->id_pembeli);

				  	

				

				$g_id=$this->Madmin->getid_trnasaksi($gidp->id);

                

                $getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	

                

                $getpembeli=$gt_id_pem->row()->nama;	

                

                    if($g_id->row()->id_user != 0){

    					

                        $getpembeli=$getuser->row()->nama;

    					

                    }	

					

					

                    if($getuser->num_rows() > 0){

							$getpembeli_akun=$getuser->row()->nama;

							$voucerbelanjakan=$getuser->row()->voucher_dibelanjakan;

						}else{

							$getpembeli_akun='';

							$voucerbelanjakan='0';

						}	

				   

				  	?>

					<tr >

                    <td><?=$no++?></td>

                    <td><?=$gidp->nama_pembeli?></td>

                    <td><?=$sgetuser->row()->email?></td>

                    <td><?=$sgetuser->row()->hp?></td>

                    <td><?=$gidp->nama?></td>

                    <td><?=$gidp->qty?></td>

                    <td><?=number_format($gidp->harga_satuan,2,',','.')?></td>

                    <td><?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?></td>

                    <td><?=$gidp->metode?></td>

                    <td><?=$gidp->tgl_trans?></td>

                    <td>Proses</td>

                    <?php

                    

                        ////////////////////////////////////////////////////////////////////////

                    

                      if($voucerbelanjakan < $gidp->harga_satuan*$gidp->qty)

					 	{

					 		echo $voucerbelanjakan;

						?>

						

						<td class="text-red">MOHON HUB. Admin</td>

						<?php

						}

                        else

                        {

					    ?>

				     

                    <?php

                    if($gidp->harga_satuan*$gidp->qty != 0){ ///lolos karen harga tidak nol.

				  	

                      /////////////////////////////////////////////////////////////////////////

                      ?>

                     

                      <td>

                    

                    

                    

                     <a class="btn btn-xs btn-success kla" data-toggle="modal" data-target="#myModalgambar<?=$gidp->id?>">

                     Transaksi Selesai

                      </a>

                      

                       <a class="btn btn-xs btn-danger kla" data-toggle="modal" data-target="#myModalgambarbtl<?=$gidp->id?>">Transaksi Batal</a>

                      

                      

                      <!-- Modal POTO -->

<div class="modal fade" id="myModalgambar<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel">Transaksi Selesai</h4>

      </div>

      <div class="modal-body">

      <!--C_transelesai-->

          <form class="form-horizontal" action="<?=base_url('C_transelesai/otorisasi/'.$gidp->id.'/ok/user')?>" method="post" enctype="multipart/form-data">

              <div class="box-body" align="left">

             <div class="form-group">

				  Nama Pembeli :  <?=$gidp->nama_pembeli?><br/>

                  Email Pembeli :  <?=$sgetuser->row()->email?> <br/>

		          Produk         : <?=$gidp->nama?><br/>

                  Jumlah Produk : <?=$gidp->qty?><br/>

                  Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>

                  Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>

                 

            </div>

           <input type="hidden" id="exampleInputName2" name="ck" value="ya" placeholder="Jane Doe">

              </div>

              <!-- /.box-body -->

              <div class="box-footer">

                

                <button type="submit"  onclick="return confirm('anda Yakin!')"  class="btn btn-success pull-right btn-block btn-lg">Transaksi Selesai</button>

              </div>

              <!-- /.box-footer -->

            </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>

                   

 

 <div class="modal fade" id="myModalgambarbtl<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel">Transaksi Batal</h4>

      </div>

      <div class="modal-body">

          <form class="form-horizontal" action="<?=base_url('C_transelesai/otorisasi/'.$gidp->id.'/btl/user')?>" method="post" enctype="multipart/form-data">

              <div class="box-body" align="left">

             <div class="form-group">

					Nama Pembeli :  <?=$gidp->nama_pembeli?><br/>

                  Email Pembeli :  <?=$sgetuser->row()->email?> <br/>

		          Produk         : <?=$gidp->nama?><br/>

                  Jumlah Produk : <?=$gidp->qty?><br/>

                  Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>

                   Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>

                 

                </div>

                <input type="hidden" id="exampleInputName2" name="ck" value="ya" placeholder="Jane Doe">

              </div>

              <!-- /.box-body -->

              <div class="box-footer">

                

                <button type="submit" onclick="return confirm('anda Yakin!')" class="btn btn-danger pull-right btn-block btn-lg btn_wala">Transaksi Batal</button>

              </div>

              <!-- /.box-footer -->

            </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>   

                    

                    </td>

                      

				  	<?php

                      /////////////////////////////////////////////////////////////////////////

	 	        	}

                      else

                    {

                        ?>

                        <td>

                        <?php echo 'Untuk Keamanan Penjual dan Pembeli. transaksi tidak bisa di lakukan , MOHON HUBUNGI ADMIN';                 ?>

                        </td>

                        <?php

                   

                    }

                  

                    ?>

                  

                     



                    

					<?php

					}

                    

                    ////////////////////////////////////////////////////////////////////////

                    

                    ?>

                    

                    

                   

                  	

                 

                  </tr>  

				<?php

                  }

				  }

                  ?>

                                

                  </tbody>

                </table>

              </div>

              <!-- /.table-responsive -->

            </div>

            <!-- /.box-body -->

          

            <!-- /.box-footer -->

          </div>

	

		</div>

    </section>

    

    

    



             
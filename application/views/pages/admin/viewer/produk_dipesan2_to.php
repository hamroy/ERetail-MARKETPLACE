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
            $getpembeli_akun='';
            $voucerbelanjakan='0';

              if($g_id->row()->id_user != 0){
                $getpembeli=$getuser->row()->nama;
              }	

              if($getuser->num_rows() > 0){
							
              $getpembeli_akun=$getuser->row()->nama;
							$voucerbelanjakan=$getuser->row()->voucher_dibelanjakan;
						 
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
                    <?php
                    ////////////////////////////////////////////////////////////////////////
                    $iduser=$gidp->id_user;
                    $idjov=4; ///j_voucher
                    //=====
                    $NOMBEL=$gidp->harga_satuan*$gidp->qty;
                    
                    $modmen=0;
                    $vjvoc=0;
                    $tmenu='';
                    $vdigunkan='-';
                    //
                    $ssaldo=0;

                    //
                    $MenuBatal= '
                    <a class=\'btn btn-xs btn-danger kla\' data-toggle=\'modal\' data-target=\'#myModalgambarbtl'.$gidp->id.'\'>
                    Transaksi Batal
                    </a>';
                      if($gidp->metode=='VOUCHER'){ ///jenis voucher
                                    
                                    if ($gidp->metode=='VOUCHER') {
                                      $gv=$this->M_dompetKu->saldoKu($iduser);
                                      $ssaldo=$gv['saldo']+$gv['saldo_dibelanjakan'];
                                      //
                                    }
                                    


                                    $modmen=1;
                                    $vjvoc=99; // 99=DOMPET
                                    $vdigunkan='DOMPET';
                                    
                                    $tmenu ="<a class='btn btn-xs btn-success kla' data-toggle='modal' data-target='#myModalgambar".$gidp->id."'>
                                             Transaksi Selesai
                                            </a>
                                            <hr/>
                      
                                    ";
                        if($NOMBEL > $ssaldo){ ///ERROR PERKALIAN HARGA DAN QTY BENILAAI 0 NOLL
                                      $vdigunkan='Dompet Pembeli sudah hangus';
                                      $modmen=0;
                                      $tmenu ="";      
                        }
                        
                      }
                       
                      

                      if($NOMBEL == 0){ ///ERROR PERKALIAN HARGA DAN QTY BENILAAI 0 NOLL
                                    $vdigunkan='Transaksi Tidak Valid';
                                    $modmen=0;
                                    $tmenu ="";      
                      }
                     
                    
                    ////////////////////////////////////////////////////////////////////////
                    
                    

                    ?>

                    <!--HASIl AKHIR-->
                        
                        <td><?=$vdigunkan?></td>
                        
                        <td>
                        
                        <!--MENU-->
                        
                        <?php
                        ECHO  $tmenu;
                        ECHO  $MenuBatal;
                        ?>
                        
                        <!--MODAL-->
                        <?php
                        if($modmen=1){
                        ?>
                        <div class="modal fade" id="myModalgambar<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title" id="myModalLabel">Transaksi Selesai</h4>

                              </div>

                              <div class="modal-body">

                              <!--C_transelesai-->

                                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="theform">
                                  
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
                                   <input type="hidden" id="exampleInputName2" name="jevoc" value="<?=$vjvoc?>" placeholder="Jane Doe">
                                   <input type="hidden"  name="id_user" value="<?=$this->session->userdata('id_user')?>">

                                      </div>

                                      <!-- /.box-body -->

                                      <div class="box-footer">

                                        

                                        <input type="submit" id="form1" onclick="konfirmasi('<?=base_url('C_transelesai/transaksiSelesai/'.$gidp->id.'/ok/user')?>')"  class="btn btn-success pull-right btn-block btn-lg" value="Transaksi Selesai" />

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

                        
                        <?php
                        }
                        ?>
                        
                        <div class="modal fade" id="myModalgambarbtl<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                          <div class="modal-dialog">

                            <div class="modal-content">

                              <div class="modal-header">

                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                                <h4 class="modal-title" id="myModalLabel">Transaksi Batal</h4>

                              </div>

                              <div class="modal-body">

                                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="theform2">
                                  
                                      <div class="box-body" align="left">

                                     <div class="form-group">

                                          Nama Pembeli :  <?=$gidp->nama_pembeli?><br/>

                                          Email Pembeli :  <?=$sgetuser->row()->email?> <br/>

                                          Produk         : <?=$gidp->nama?><br/>

                                          Jumlah Produk : <?=$gidp->qty?><br/>

                                          Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>

                                          Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>

                                        <label>Keterangan :</label><br/>
                                        <textarea type="text" name="alasan" class="form-control"></textarea> 

                                        </div>

                                        <input type="hidden" id="exampleInputName2" name="ck" value="ya" placeholder="Jane Doe">
                                        <input type="hidden" id="exampleInputName2" name="jevoc" value="<?=$vjvoc?>" placeholder="Jane Doe">
                                        <input type="hidden"  name="id_user" value="<?=$this->session->userdata('id_user')?>">

                                      </div>

                                      <!-- /.box-body -->

                                      <div class="box-footer">

                                        

                                        <input value="Transaksi Batal" type="submit" id="form2" onclick="konfirmasi2('<?=base_url('C_transelesai/otorisasi/'.$gidp->id.'/btl/user')?>')" class="btn btn-danger pull-right btn-block btn-lg btn_wala" />

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
    <div class="callout callout-warning">
      (-) Jika tombol Transaksi Selesai tidak aktif maka durasi Dompet Pembeli sudah habis.
    </div>
    </section>

    

    

    



             
<?php
$nmPemebli='';
$Email='';
$nOk='0';
$noTag='0';
$noTagN='0';
////////
$get_all_id_produk=$this->Madmin->get_Produk_dipesan_perid_transaksi($id_user,$id);
if($get_all_id_produk->num_rows() > 0){
  $getuser=$this->Madmin_master->get_user_produk($get_all_id_produk->row()->id_user); 
    if($getuser->num_rows() > 0){
      $nmPemebli=$get_all_id_produk->row()->nama_pembeli .' ( '. $getuser->row()->nama . ' )';
      $Email=$getuser->row()->username;
      $nOk=$getuser->row()->no_kontak;
    } 

    $list_kd = $this->Mbank->cek_transaksi_pembeli($get_all_id_produk->row()->id_user,$get_all_id_produk->row()->id_tgl);  //tbltransaksi
              
    $noTag=$get_all_id_produk->row()->id_tgl;

    if($list_kd->num_rows() > 0){
        $noTag=$list_kd->row()->notagihan .' atau ( '. $noTag .' )';
        $noTagN=$list_kd->row()->notagihan;
    }

}else{
    redirect ('User_admin/barang_dipesan');
}
?>
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

            <div class="well h4">
              <ul class="h3">No. Tagihan : <?=$noTag?></ul>
              <ul>Nama Pembeli (Akun) : <?=$nmPemebli?></ul>
              <ul>Email : <?=$Email?></ul>
              <ul>No. HP : <?=$nOk?></ul>
            </div>

              <div class="table-responsive">

                <table class="table no-margin">

                  <thead>

                  <tr bgcolor="#d9d9dd">

                    <th>No</th>
                    
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

        if($get_all_id_produk->num_rows() > 0){

        $no=1;

			  foreach($get_all_id_produk->result() as $gidp){ 
            $sgetuser=$this->Madmin->getidpembeli($gidp->id_pembeli);
    				$g_id=$this->Madmin->getid_trnasaksi($gidp->id);

				  	?>
					<tr >

                    <td><?=$no++?></td>
                    <td><?=$gidp->nama?></td>

                    <td><?=$gidp->qty?></td>

                    <td><?=number_format($gidp->harga_satuan,2,',','.')?></td>

                    <td><?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?></td>

                    <td><?=$gidp->metode?></td>

                    <td><?=$gidp->tgl_trans?></td>

                    

                    <?php

                    
                    //--------
                    $NOMBEL=$gidp->harga_satuan*$gidp->qty;
                    
                    $modmen=0;
                    $vjvoc=0;
                    $tmenu='';
                    $vdigunkan='-';

                    $MenuBatal= '
                    <a class=\'btn btn-xs btn-danger kla\' data-toggle=\'modal\' data-target=\'#myModalgambarbtl'.$gidp->id.'\'>
                    Transaksi Batal
                    </a>';
                    
                      if($gidp->metode=='VOUCHER'){ ///jenis voucher
                        $modmen=1;
                        $vjvoc=$gidp->j_voucher; //voc normal
                        $vdigunkan='VOUCHER - '.$vjvoc;

                          $gv=$this->M_dompetKu->saldoKu($id_user);
                          $ssaldo=$gv['saldo']+$gv['saldo_dibelanjakan'];

                        $tmenu ="
                        <a class='btn btn-xs btn-success kla' data-toggle='modal' data-target='#myModalgambar".$gidp->id."'>Transaksi Selesai
                        </a><hr/>
                        ";

                        if($NOMBEL > $ssaldo){ ///ERROR PERKALIAN HARGA DAN QTY BENILAAI 0 NOLL
                            $vdigunkan='Dompet Pembeli sudah hangus';
                            $modmen=0;
                            $tmenu ="";      
                        }
                      
                      }else{
                        $modmen=1;
                        $vjvoc=0; //voc normal
                        $vdigunkan='TUNAI';
                        $tmenu ="
                        <a class='btn btn-xs btn-success kla' data-toggle='modal' data-target='#myModalgambar".$gidp->id."'>                               Transaksi Selesai 
                        </a>
                       
                        ";  
                      }
                      
                      ////VIA TRANSFER
                      
                      
                      
                       
                       if($NOMBEL == 0){ ///ERROR PERKALIAN HARGA DAN QTY BENILAAI 0 NOLL
                                    $vdigunkan='Harga atau Qty Kosong';
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
                        ECHO  $tmenu    ;
                        ECHO  $MenuBatal    ;
                        
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
              <p class="well">
		          No Tagihan    : <?=$noTag?><br/>
              Produk    : <?=$gidp->nama?><br/>
              Sub Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>
              </p>
              <P>- Pastikan barang sudah diterima oleh pembeli. </P>
            </div>

           <input type="hidden" name="ck" value="ya">
           <input type="hidden" name="jevoc" value="<?=$vjvoc?>">
           <input type="hidden" name="id_user" value="<?=$id_user?>">
           <input type="hidden" name="noTag" value="<?=$noTagN?>">
           <input type="hidden" name="num" value="<?=$get_all_id_produk->num_rows()?>">

              </div>

              <!-- /.box-body -->

              <div class="box-footer">

               <input type="submit" id="form1" 
              onclick="konfirmasi('<?=base_url('C_transelesai/transaksiSelesai/'.$gidp->id.'/ok/user')?>')" class="btn btn-success pull-right btn-block btn-lg" value="Transaksi Selesai" />

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

<div class="modal fade" id="myModalgambarbtl<?=$gidp->id?>" tabindex="-1" role="dialog" 
 aria-labelledby="myModalLabel" aria-hidden="true">

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
              No Tagihan    : <?=$noTag?><br/>
		          Produk         : <?=$gidp->nama?><br/>
              Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>

              <input type="hidden" name="ck" value="ya">
              <input type="hidden" name="id_user" value="<?=$id_user?>">
              <input type="hidden" name="jevoc" value="<?=$vjvoc?>">
              <input type="hidden" name="noTag" value="<?=$noTagN?>">
              <input type="hidden" name="num" value="<?=$get_all_id_produk->num_rows()?>">
              <label>Keterangan :</label><br/>
              <textarea type="text" name="alasan" class="form-control"></textarea>

              </div>

              </div>

              <!-- /.box-body -->

            <div class="box-footer">

              <input value="Transaksi Batal" type="submit" id="form2" 
              onclick="konfirmasi2('<?=base_url('C_transelesai/transaksiSelesaiBatal/'.$gidp->id.'/btl/user')?>')" 
              class="btn btn-danger pull-right btn-block btn-lg btn_wala" />

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
                        <?php
                        }
                        ?>
                        


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

    </section>

    

    

    



             
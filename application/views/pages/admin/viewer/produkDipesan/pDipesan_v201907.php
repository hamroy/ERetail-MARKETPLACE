<div class="box box-info">



            <div class="box-header with-border">


              <h3 class="box-title">Daftar Pembeli Produk Dipesan</h3>
              <hr>


            <!-- /.box-header -->

            <div class="box-body">

              <div class="table-responsive">

                <table class="table no-margin table-striped table-hover js-basic-example dataTable">

                  <thead>

                  <tr bgcolor="#d9d9dd">

                    <th>No</th>
                    <th>No. Tagihan</th>

                    <th>Nama Pembeli</th>

                    <th>Produk</th>

                    <th>Sub total</th>

                    <th>Pembayaran</th>

                    <th>Tanggal Transaksi</th>

                    <th>Action</th>

                  </tr>

                  </thead>
                  
                  <tfoot>

                  <tr bgcolor="#d9d9dd">

                    <th>No</th>
                    <th>No. Tagihan</th>

                    <th>Nama Pembeli</th>

                    <th>Produk</th>

                    <th>Sub total</th>

                    <th>Pembayaran</th>

                    <th>Tanggal Transaksi</th>

                    <th>Action</th>

                  </tr>

                  </tfoot>

                  <tbody>

                  <?php 

                  ////di grup produk dan id tgl

                  

                  $get_all_id_produk=$this->Madmin->get_Produk_dipesan($this->session->userdata('id_user'));

                  if($get_all_id_produk->num_rows() > 0){

                    $no=1;

          

                  foreach($get_all_id_produk->result() as $gidp){ 

        

                  $gt_id_pem=$this->Madmin->getidpembeli($gidp->id_pembeli);
                  
                  $sgetuser=$gt_id_pem=$this->Madmin->getidpembeli($gidp->id_pembeli);

                

                  $g_id=$this->Madmin->getid_trnasaksi($gidp->id);

                

                $getuser=$this->Madmin_master->get_user_produk($gidp->id_user); 

                

                $getpembeli='';  

                

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
                          
                        
                    $list_kd = $this->Mbank->cek_transaksi_pembeli($gidp->id_pembeli,$gidp->id_tgl);  //tbltransaksi
                    
                    $idtagihan=$gidp->id_tgl;
        
                    if($list_kd->num_rows() > 0){
                        $idtagihan=$list_kd->row()->notagihan;
                    }

                    

            ?>

          <tr >

                    <td><?=$no++?></td>

                   <!--<td><?=$getpembeli?></td>-->

                    
                    <td><a href="<?=base_url('User_admin/barang_idtransaksi/'.$gidp->id_tgl)?>"><?=$idtagihan?> [ <?=$gidp->id_tgl?> ]</a></td>
                    <td><?=$gidp->nama_pembeli?></td>
                    <td><?=$gidp->nama?></td>

                    <td><?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?></td>

                    <td><?=$gidp->metode?></td>

                    <td><?=$gidp->tgl_trans?></td>

                    <?php

                    

                        

                        

                  if($gidp->metode == 'VOUCHER'){

             

                     ?>

                     <td>

                

                    <a class="btn btn-success kla" href="<?=base_url('User_admin/barang_dipesan_to/'.$gidp->id)?>">

                     LIHAT RINCI

                    </a>

                  

                   </td>

                     <?php

          

                    }else{   ///TUNAI

             

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

          <form class="form-horizontal" action="<?=base_url('C_transelesai/otorisasi/'.$gidp->id.'/ok/user')?>" method="post" enctype="multipart/form-data" id="theform2">

              <div class="box-body" align="left">

             <div class="form-group">

                  Nama Pembeli :  <?=$gidp->nama_pembeli?><br/>

                  Email Pembeli :  <?=$sgetuser->row()->email?> <br/>

                  Produk         : <?=$gidp->nama?><br/>

                  Jumlah Produk : <?=$gidp->qty?><br/>

                  Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>

                  Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>

                 

            </div>

           <input type="hidden"  name="ck" value="ya" placeholder="Jane Doe">
           <input type="hidden"  name="jevoc" value="T">
           <input type="hidden"  name="id_user" value="<?=$this->session->userdata('id_user')?>">

              </div>

              <!-- /.box-body -->

              <div class="box-footer">

                

                <input type="submit" id="btnsubmit2" value="Transaksi Selesai"  onclick="return confirm('anda Yakin!')"  class="btn btn-success pull-right btn-block btn-lg" />

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

          <form class="form-horizontal" action="<?=base_url('C_transelesai/otorisasi/'.$gidp->id.'/btl/user')?>" method="post" enctype="multipart/form-data" id="theform">

              <div class="box-body" align="left">

             <div class="form-group">

                  Nama Pembeli :  <?=$gidp->nama_pembeli?><br/>

                  Email Pembeli :  <?=$sgetuser->row()->email?> <br/>

                  Produk         : <?=$gidp->nama?><br/>

                  Jumlah Produk : <?=$gidp->qty?><br/>

                  Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>

                  Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>

                <label>Keterangan :</label><br/>
                <textarea type="text" name="alasan" class="form-control" style="width: 100%"></textarea>

                </div>

                <input type="hidden" name="ck" value="ya">
                <input type="hidden"  name="jevoc" value="T">
                <input type="hidden"  name="id_user" value="<?=$this->session->userdata('id_user')?>">

              </div>

              <!-- /.box-body -->

              <div class="box-footer">

                

                <input type="submit" value="Transaksi Batal" id="btnsubmit" onclick="return confirm('anda Yakin!')" class="btn btn-danger pull-right btn-block btn-lg btn_wala" />
                
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

            

           }

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
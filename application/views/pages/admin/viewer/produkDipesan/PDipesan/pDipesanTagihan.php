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
                    <th>Sub Qty</th>
                    <th>Sub Total</th>

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
                    <th>Sub Qty</th>
                    <th>Sub Total</th>

                    <th>Pembayaran</th>

                    <th>Tanggal Transaksi</th>

                    <th>Action</th>

                  </tr>

                  </tfoot>

                  <tbody>

          <?php 

          ////di grup produk dan id tgl
          $get_all_id_produk=$this->M_produkDipesan->getTransaksiGroupNoTagihan($id_user,$tgla);

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

              $getpembeli_akun='';
              $voucerbelanjakan='0';
              if($getuser->num_rows() > 0){
                $getpembeli_akun=$getuser->row()->nama;
                $voucerbelanjakan=$getuser->row()->voucher_dibelanjakan;
              }

              $list_kd = $this->Mbank->cek_transaksi_pembeli($gidp->id_user,$gidp->id_tgl);  //tbltransaksi
              
              $idtagihan=$gidp->id_tgl;
  
              if($list_kd->num_rows() > 0){
                  $idtagihan=$list_kd->row()->notagihan;
              }

              $subt=$this->M_produkDipesan->getQtyperNoTagihan($gidp->id_tgl);

                    

            ?>

          <tr >

                    <td><?=$no++?></td>
                    <td>
                      <a href="<?=base_url('User_admin/barang_idtransaksi/'.$gidp->id_tgl)?>">
                      <?=$idtagihan?> [ <?=$gidp->id_tgl?> ]
                      </a>
                    </td>
                    <td><?=$gidp->nama_pembeli?></td>
                    <td><?=$subt['subqty']?>    </td>
                    <td><?=$subt['subtot']?>    </td>

                    <td><?=$gidp->metode?></td>

                    <td><?=$gidp->tgl_trans?></td>
                    <td>
                    <?php
                    if($gidp->metode == 'VOUCHER'){
                      // $linkskip=base_url('User_admin/barang_dipesan_to/'.$gidp->id);
                      $linkskip=base_url('User_admin/barang_idtransaksi/'.$gidp->id_tgl);
                    }else{
                      $linkskip=base_url('User_admin/barang_idtransaksi/'.$gidp->id_tgl);
                    }

                    ?>

                    <a class="btn btn-success kla" href="<?=$linkskip?>">LIHAT RINCI </a>

                 

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
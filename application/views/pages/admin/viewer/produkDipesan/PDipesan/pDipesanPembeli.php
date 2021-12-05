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
                    <th>Nama Pembeli</th>
                    <th>Sub Qty</th>
                    <th>Sub Total</th>
                    <th>Action</th>

                  </tr>

                  </thead>
                  
                  <tfoot>

                  <tr bgcolor="#d9d9dd">

                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Sub Qty</th>
                    <th>Sub Total</th>
                    <th>Action</th>                  
                  </tr>

                  </tfoot>

                  <tbody>

          <?php 

          ////di grup produk dan id tgl
          $get_all_id_produk=$this->M_produkDipesan->getTransaksiGroupNoPembeli($id_user,$tgla);

          if($get_all_id_produk->num_rows() > 0){
            $no=1;
          foreach($get_all_id_produk->result() as $gidp){ 
              $subt=$this->M_produkDipesan->getQtyperPembeli($gidp->id_user,$gidp->id_pelapak);
            ?>

          <tr >

                    <td><?=$no++?></td>
                    <td><?=$gidp->nama_pembeli?></td>
                    <td><?=$subt['subqty']?>    </td>
                    <td><?=$subt['subtot']?>    </td>
                    <td>
                    <?php
                    if($gidp->metode == 'VOUCHER'){
                      // $linkskip=base_url('User_admin/barang_dipesan_to/'.$gidp->id);
                      $linkskip=base_url('User_admin/barang_idtransaksi/'.$gidp->id_tgl);
                    }else{
                      $linkskip=base_url('User_admin/barang_idtransaksi/'.$gidp->id_tgl);
                    }

                    ?>

                    <!-- <a class="btn btn-success kla" href="<?=$linkskip?>">LIHAT RINCI </a> -->

                 

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
<div class="box box-info">



            <div class="box-header with-border">


              <h3 class="box-title">Daftar Pembeli Produk Diproses</h3>
              <hr>

              <div class="well" style="padding-bottom: 0px ">
              <blockquote>
              <p>Transaksi dianggap selesai jika selama 3 hari pembeli tidak ada keluhan.</p>
              </blockquote>  
              </div>
            <!-- /.box-header -->

            <div class="box-body">

              <div class="table-responsive">

                <table class="table no-margin table-striped table-hover js-basic-example dataTable">

                  <thead>

                  <tr bgcolor="#d9d9dd">

                    <th>No</th>
                    <th>No. Tagihan</th>
                    <th>No. Kuitansi</th>

                    <th>Pembeli</th>

                    <th>Produk</th>

                    <th>Sub total</th>

                    <th>Pembayaran</th>

                    <th>Tanggal Pesan</th>

                    <th>Tanggal Selesai</th>
                    <th>Durasi / hari</th>

                  </tr>

                  </thead>
                  
                  <tfoot>

                  <tr bgcolor="#d9d9dd">

                    <th>No</th>
                    <th>No. Tagihan</th>
                    <th>No. Kuitansi</th>

                    <th>Pembeli</th>

                    <th>Produk</th>

                    <th>Sub total</th>

                    <th>Pembayaran</th>

                    <th>Tanggal Pesan</th>

                    <th>Tanggal Selesai</th>
                    <th>Durasi / hari</th>

                  </tr>

                  </tfoot>

                  <tbody>

                  <?php 

                  ////di grup produk dan id tgl

                  

                  $get_all_id_produk=$this->Madmin->get_Produk_diproses($this->session->userdata('id_user'));

                  if($get_all_id_produk->num_rows() > 0){

                    $no=1;

          

                  foreach($get_all_id_produk->result() as $gidp){ 

                  ////durasi 0 hide
                      $hdur= $gidp->durasi;
                      $dur = $this->M_time->durasi_ymd($hdur,3);
                      if ($dur==0) {
                        continue;
                      }
                  ////durasi 0 hide

                  $gt_id_pem=$this->Madmin->getidpembeli($gidp->id_pembeli);
                  
                  $sgetuser=$gt_id_pem=$this->Madmin->getidpembeli($gidp->id_pembeli);

                

                  $g_id=$this->Madmin->getid_trnasaksi($gidp->id);

                

                $getuser=$this->Madmin_master->get_user_produk($gidp->id_user); 

                

                $getpembeli='nama kosong';  
                // $getpembeli=$gt_id_pem->row()->nama;  

                

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

                    
                    <td><?=$idtagihan?></td>
                    <td><?=$gidp->id_kuitansi?></td>
                    <td><?=$gidp->nama_pembeli?></td>
                    <td><?=$gidp->nama?></td>

                    <td><?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?></td>

                    <td><?=$gidp->metode?></td>

                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>
                    <td>
                      <?php

                      echo $dur;
                      ;
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
 <section class="content-header" style="background: #ecedee;">

   <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
     <li class="active">Daftar Produk</li>
   </ol>
   <br />
   <h1>
     <b>DAFTAR PRODUK </b>
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



   <?php
    $get_all_id_produk_perkategori = $this->Madmin->get_all_id_produk_perkateggori_master();
    if ($get_all_id_produk_perkategori->num_rows() > 0) {
      foreach ($get_all_id_produk_perkategori->result() as $kat) {
        $getnmakat = $this->Madmin->get_nama_kat_perid($kat->id_k);
        ///===============================================================================================
    ?>

       <div class="box box-info">
         <div class="box-header with-border">

           <button type="btn" class="btn btn-box-tool" style="font-size: 27px; color: #106710" data-widget="collapse"><i class="fa fa-minus"></i>
             Daftar Kategori <?= $getnmakat->row()->kategori ?>
           </button>
           <div class="box-tools pull-right">
             <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
             </button>

             <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
           </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <div class="table-responsive">
             <table class="table no-margin">
               <thead>
                 <tr bgcolor="#d9d9dd">
                   <th>No</th>
                   <th>gambar</th>
                   <th>Nama Produk</th>

                   <th>Penjual</th>
                   <th>Stok</th>
                   <th>Harga</th>
                   <th>Deskripsi</th>
                   <th>Status</th>
                   <th>action</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $get_all_id_produk = $this->Madmin_master->get_all_produk($kat->id_k);
                  if ($get_all_id_produk->num_rows() > 0) {
                    $no = 1;
                    foreach ($get_all_id_produk->result() as $gidp) {

                      /////////
                      //GET TBL USER
                      $getuser = $this->Madmin_master->get_user_produk($gidp->id_user);
                      //GET TBL KATEGORI
                      $getkat = $this->Madmin_master->get_kategori_produk($gidp->id_k);
                      ////
                      if ($getuser->num_rows() > 0) {
                        $user = $getuser->row()->nama;
                      } else {
                        $user = '';
                      }
                      ////
                      if ($getkat->num_rows() > 0) {
                        $kateg = $getkat->row()->kategori;
                      } else {
                        $kateg = '';
                      }

                  ?>
                     <tr>
                       <td><?= $no++ ?></td>
                       <td>
                         <?php
                          $string = read_file('./upload/barang/' . $gidp->gambar);
                          if ($string == FALSE) {
                            $fotoproduk = base_url() . '/dist/img/E-Retail.jpg';
                          } else {
                            $fotoproduk = base_url() . '/upload/barang/' . $gidp->gambar;
                          } ?>
                         <p align="center"> <img src="<?= $fotoproduk ?>" class="margin" width="100px" /></p>
                       </td>
                       <td><?= $gidp->nama ?></td>

                       <td><?= $user ?></td>

                       <td><?= $gidp->stok ?> <?= $gidp->satuan ?></td>
                       <td><?php

                            if (empty($gidp->hargak)) {
                              echo $gidp->harga;
                            } else {
                              echo $gidp->hargak;
                            }
                            ?></td>
                       <td><?= $gidp->deskripsi ?></td>
                       <?php
                        if ($gidp->status == 1) {
                          $wr = 'success';
                          $wr1 = 'danger';
                          $tx = 'active';
                          $up = 2;
                          $bt = 'block';
                        } else {
                          $wr = 'danger';
                          $wr1 = 'success';
                          $tx = 'non active';
                          $bt = 'active';

                          $up = 1;
                        }
                        ?>
                       <td class="<?= $wr ?>">
                         <?= $tx ?>
                       </td>
                       <td>
                         <?php
                          if ($gidp->status == 1) {
                          ?>
                           <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModaltbl<?= $gidp->id ?>"> <i class="fa fa-edita"></i>Block&nbsp;&nbsp;&nbsp;
                           </button>


                         <?php
                          } else {
                          ?>
                           <a href="<?= base_url('Master_admin/block_produk/' . $gidp->id . '/' . $up . '/p') ?>" class="btn btn-<?= $wr1 ?> btn-sm"><?= $bt ?>&nbsp;&nbsp;&nbsp;</a>

                         <?php
                          }
                          ?>

                         <br /><br />
                         <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?= $gidp->id ?>"> <i class="fa fa-edita"></i>Pindah
                         </button>
                         <!-- Modal -->
                         <div class="modal fade" id="myModaltbl<?= $gidp->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 <h4 class="modal-title" id="myModalLabel">BLOCK PRODUK</h4>
                               </div>
                               <div class="modal-body">
                                 <form role="form" action="<?= base_url('Master_admin/block_produk/' . $gidp->id . '/' . $up . '/p') ?>" method="post">
                                   <div class="form-group">
                                     <label for="exampleInputEmail1">Karena :</label>
                                     <textarea class="form-control" name="alasan" rows="3"></textarea>
                                   </div>
                                   <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                                 </form>
                               </div>
                               <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                               </div>
                             </div>
                           </div>
                         </div>

                         <!-- Modal -->
                         <div class="modal fade" id="myModal<?= $gidp->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 <h4 class="modal-title" id="myModalLabel">Pindah Kategori</h4>
                               </div>
                               <div class="modal-body">
                                 <form class="form-horizontal" action="<?= base_url('Master_admin/proses_simpan_save_data_pindah/' . $gidp->id) ?>" method="post" enctype="multipart/form-data">
                                   <div class="box-body">
                                     <?php
                                      $gidp->id_k
                                      ?>
                                     <div class="form-group">
                                       <label for="inputEmail3" class="col-sm-3 control-label">Pilih kategori</label>

                                       <div class="col-sm-8">
                                         <?= form_dropdown('id_k', $kategori, $gidp->id_k, 'class="form-control" style="border-radius: 6px" style=" width: 100%;"') ?>

                                       </div>
                                     </div>

                                     <!-- /.box-footer -->
                                     <div class="box-footer">

                                       <button type="submit" class="btn btn-info pull-right btn-block btn-lg">Simpan</button>
                                     </div>
                                 </form>
                               </div>
                               <div class="modal-footer">
                                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                               </div>
                             </div>
                           </div>
                         </div>

                       </td>


                     </tr>
                 <?php  }
                  }
                  ?>

               </tbody>
             </table>
           </div>
           <!-- /.table-responsive -->
         </div>
       </div>

   <?php
        ///===============================================================================================
      } //poor kategori
    } //if kategori
    ?>

 </section>
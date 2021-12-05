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
   <div class="well" align="left">

     <form action="<?= base_url('Master_admin/daftar_produk_cari') ?>" method="post">
       <label for="" class="label-control">CARI PRODUK</label>
       <div class="input-group  col-md-5">

         <input type="text" name="cari" placeholder="Nama Produk..." class="form-control" required>

         <span class="input-group-btn">
           <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
         </span>
       </div><!-- /input-group -->
     </form>


   </div>


   <div class="box-body" style="background: #ffffff">
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
            $get_all_id_produk = $q;
            if ($get_all_id_produk->num_rows() > 0) {
              //echo 	$this->Madmin_master->get_all_produk($id_k)->num_rows();
              $no = 1;
              //echo 	$total_rows;
              //echo 	$get_all_id_produk->num_rows();
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
                 <td><a href="<?= base_url('C_user_admin/rinciproduk/' . $gidp->id) ?>"><?= $gidp->nama ?></a></td>

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
                   <?php
                    $gtjenid = $this->M_vparsel->get_jenis_voc_id($gidp->jen_voc);

                    print('<br/>');
                    if ($gtjenid->num_rows() > 0) {
                      echo $gtjenid->row()->nama_jvoc;
                    }

                    ?>

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
                   <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?= $gidp->id ?>"> <i class="fa fa-edita"></i>Edit
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
                           <form class="form-horizontal" action="<?= base_url('Master_admin/proses_simpan_save_data_pindah/' . $gidp->id . '/ep_a') ?>" method="post" enctype="multipart/form-data">
                             <?php
                              $gidp->id_k
                              ?>
                             <div class="form-group">
                               <label for="inputEmail3" class="col-sm-3 control-label">Jenis Voucher</label>

                               <div class="col-sm-8">
                                 <?= form_dropdown('jen_voc', $jenvoc, $gidp->jen_voc, 'class="form-control" style="border-radius: 6px" style=" width: 100%;"') ?>

                               </div>
                             </div>

                             <div class="form-group">
                               <label for="inputEmail3" class="col-sm-3 control-label">kategori</label>

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
     <div class="well">
       </p>
       <p align="left"><a class="text-lift" href="#">Back to top</a> <span class="pull-right"></span></p>
     </div>


   </div>
   </div>

 </section>
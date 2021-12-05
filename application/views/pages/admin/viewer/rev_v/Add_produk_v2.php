 <section class="content-header" style="background: #ecedee;">
   <h1 class="well">
     <b>DAFTAR PRODUK</b>
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
   <h3 class="box-title">Tambah Produk</h3>
   <div class="box box-info">
     <div class="box box-body">
       <div class="box-group" id="accordion">
         <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
         <div class="panel">
           <div class="box-header with-border">
             <h4 class="box-title">
               <a href="<?= base_url('C_user_admin/addproduk') ?>">
                 <i class="fa fa-plus"></i> Tambah Produk
               </a>
             </h4>
           </div>

         </div>

       </div>
     </div>
   </div>
   <!--ISI per kategori-->
   <h3 class="box-title">Daftar Produk</h3>
   <?php
    $get_all_id_produk_perkategori = $this->Madmin->get_all_id_produk_perkateggori($this->session->userdata('id_user'));
    if ($get_all_id_produk_perkategori->num_rows() > 0) {
      foreach ($get_all_id_produk_perkategori->result() as $kat) {
        $getnmakat = $this->Madmin->get_nama_kat_perid($kat->id_k);
        ///===============================================================================================

        $get_all_id_produk = $this->Madmin->get_all_id_produk($this->session->userdata('id_user'), $kat->id_k);

    ?>
       <div class="box box-info">
         <div class="box-header with-border">

           <button type="btn" class="btn btn-box-tool" style="font-size: 27px; color: #106710" data-widget="collapse"><i class="fa fa-minus"></i>
             Daftar Kategori <?= $getnmakat->row()->kategori ?> [ <?= $get_all_id_produk->NUM_ROWS() ?> ]
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
                   <th>Produk</th>
                   <th>Persedian</th>
                   <th>Terjual</th>
                   <th>Harga Satuan</th>
                   <th>Deskripsi</th>
                   <th>Gambar</th>
                   <th>Status</th>
                   <th>Menu</th>
                 </tr>
               </thead>
               <tbody>
                 <?php

                  if ($get_all_id_produk->num_rows() > 0) {
                    $no = 1;
                    foreach ($get_all_id_produk->result() as $gidp) {
                      ///=========================================================ILHAM------------------------
                      $qty = $this->Mtrans->get_produkqty($gidp->id);
                      if ($qty >= $gidp->stok) {
                        if ($gidp->id_k != 4) {
                          $c = 'bgcolor="#e8e8ea"';
                          $qtya = $qty;
                        } else {
                          $c = '';
                          $qtya = '';
                        }
                      } else {
                        $c = '';
                        $qtya = $qty;
                      }
                  ?>
                     <tr <?= $c ?>>
                       <td><?= $no++ ?></td>
                       <td><?= $gidp->nama ?></td>
                       <td><?= $gidp->stok ?></td>
                       <td><?= $qtya ?></td>
                       <td>
                         <?php
                          if (empty($gidp->hargak)) { ?>

                           <?= $gidp->harga ?>
                         <?php } else {
                          ?>
                           <?= $gidp->hargak ?>
                         <?php  }

                          ?>

                       </td>
                       <td>
                         <?= $gidp->deskripsi ?>
                       </td>
                       <td>
                         <?php
                          /* $string = read_file($this->M_setapp->static_bm().'/upload/barang/'.$gidp->gambar);
		if ($string == FALSE){
			$fotoproduk = $this->M_setapp->static_bm().'/dist/img/E-Retail.jpg';
			 
		}else{
			$fotoproduk = $this->M_setapp->static_bm().'/upload/barang/'.$gidp->gambar; 
			
			 } //*/
                          $fotoproduk = $this->M_setapp->static_bm() . '/upload/barang/' . $gidp->gambar;

                          ?>
                         <p align="center">
                           <img style="height: 100px; width: 100px" class="image img-responsive img-rounded gbrkecil lazy" width="100px" data-original="<?= $fotoproduk ?>" />
                         </p>
                         <p align="center">
                           <a data-toggle="modal" data-target="#myModalgambar<?= $gidp->id ?>">
                             <i class="fa fa-pencil"></i> edit
                           </a>
                         </p>
                         <!-- Modal POTO -->
                         <div class="modal fade" id="myModalgambar<?= $gidp->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 <h4 class="modal-title" id="myModalLabel">Edit Foto Produk</h4>
                               </div>
                               <div class="modal-body">
                                 <form class="form-horizontal" action="<?= base_url('User_admin/proses_simpan_editproduk_data/' . $gidp->id) ?>" method="post" enctype="multipart/form-data">
                                   <div class="box-body" align="center">

                                     <img style="height: 100px; width: 100px" class="image img-responsive img-rounded gbrkecil lazy" width="100px" data-original="<?= $fotoproduk ?>" />

                                     <div class="form-group">

                                       <label for="inputPassword3" class="col-sm-2 control-label">Gambar</label>

                                       <div class="col-sm-5">
                                         <input type="file" class="form-control" id="inputPassword3" style="border-radius: 6px" name="file" placeholder="Password">
                                       </div>
                                     </div>
                                   </div>
                                   <!-- /.box-body -->
                                   <div class="box-footer">

                                     <button type="submit" class="btn btn-info pull-right btn-block btn-lg">Simpan</button>
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
                       </td>
                       <!---->
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
                       <!---->
                       <td>
                         <button class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?= $gidp->id ?>"> <i class="fa fa-edit"></i> Edit
                         </button>

                         <!-- Modal -->
                         <div class="modal fade" id="myModal<?= $gidp->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                           <div class="modal-dialog">
                             <div class="modal-content">
                               <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 <h4 class="modal-title" id="myModalLabel">Edit Data</h4>
                               </div>
                               <div class="modal-body">
                                 <form class="form-horizontal" action="<?= base_url('User_admin/proses_simpan_save_data/' . $gidp->id) ?>" method="post" enctype="multipart/form-data">
                                   <div class="box-body">
                                     <?php
                                      $gidp->id_k
                                      ?>
                                     <div class="form-group">
                                       <label for="inputEmail3" class="col-sm-2 control-label">kategori</label>

                                       <div class="col-sm-10">
                                         <?= form_dropdown('id_k', $kategori, $gidp->id_k, 'class="form-control" style="border-radius: 6px" style=" width: 100%;"') ?>

                                       </div>
                                     </div>

                                     <div class="form-group">
                                       <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

                                       <div class="col-sm-10">
                                         <input type="text" class="form-control" value="<?= $gidp->nama ?>" style="border-radius: 6px" name="nama" id="inputEmail3" placeholder="Nama produk">
                                       </div>
                                     </div>
                                     <?php
                                      if ($gidp->id_k != 4) { ?>
                                       <div class="form-group">
                                         <label for="inputPassword3" class="col-sm-2 control-label">Stok</label>

                                         <div class="col-sm-6">
                                           <input type="number" min="<?= $gidp->stok ?>" class="form-control" id="inputPassword3" value="<?= $gidp->stok ?>" style="border-radius: 6px" name="stok" placeholder="Stok">
                                           <small class="text-danger">(*) Stok minimal <?= $gidp->stok ?></small>
                                         </div>
                                         <div class="col-sm-4">
                                           <input placeholder="satuan" value="<?= $gidp->satuan ?>" name="satuan" class="form-control" style="border-radius: 6px">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="inputPassword3" class="col-sm-4 control-label">Harga Satuan Normal</label>

                                         <div class="col-sm-8">
                                           <input type="text" class="form-control" id="inputPassword3" value="<?= $gidp->harga ?>" style="border-radius: 6px" name="harga" placeholder="Harga Normal">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                         <label for="inputPassword3" class="col-sm-4 control-label">Harga Satuan Khusus</label>

                                         <div class="col-sm-8">
                                           <input type="text" class="form-control" id="inputPassword3" value="<?= $gidp->hargak ?>" style="border-radius: 6px" name="hargak" placeholder="Harga Khusus">
                                         </div>
                                       </div>
                                     <?php }
                                      ?>


                                     <div class="form-group">
                                       <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi</label>

                                       <div class="col-sm-10">
                                         <textarea rows="10" class="form-control" style="border-radius: 6px" name="deskripsi"><?= $gidp->deskripsi ?></textarea>
                                       </div>
                                     </div>
                                     <!-- <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Upload Gambar</label>
                  <div class="col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>-->
                                   </div>
                                   <!-- /.box-body -->
                                   <div class="box-footer">

                                     <button type="submit" class="btn btn-info pull-right btn-block btn-lg">Simpan</button>
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
                         <!---->
                         &nbsp;
                         <a class="btn btn-block btn-danger btn-sm" href="<?= base_url('User_admin/proses_simpan_del_data/' . $gidp->id) ?>" onclick="return confirm('Anda Yakin akan Menghapus Foto ini !')"> <i class="fa fa-close"></i> Hapus</a>
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



   <!--ISI per kategori-->



 </section>
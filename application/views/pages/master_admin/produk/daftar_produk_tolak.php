 <section class="content-header" style="background: #ecedee;">

   <ol class="breadcrumb">
     <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
     <li class="active">Daftar Produk</li>
   </ol>
   <br />
   <h1>

     <b>DAFTAR PRODUK || DITOLAK</b>
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

   <form method="post" action="<?= base_url('C_akunproduk/hapuspilihan') ?>">
     <div class="well">
       <input class="btn btn-danger" onclick="return confirm('anda yakin!')" type="submit" value="Hapus Pilihan" />
     </div>
     <div class="box box-info">

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
                 <th>Kategori</th>
                 <th>Tanggal Input</th>
                 <th>action</th>
               </tr>
             </thead>
             <tbody>
               <?php
                $get_all_id_produk = $this->Madmin_master->get_all_produk_toalk();
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
                     <td>

                       <input name="id_pr[]" value="<?= $gidp->id ?>" type="checkbox" />

                       <?= $no++ ?>
                     </td>
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
                     <td><?= $gidp->harga ?></td>
                     <td><?= $gidp->deskripsi ?></td>
                     <td><?= $kateg ?></td>

                     <td><?= $gidp->tanggal ?></td>
                     <td><a href="<?= base_url('Master_admin/block_produk/' . $gidp->id . '/1/v') ?>" class="btn btn-success btn-sm">Terima</a>
                       <br />
                       <br />
                       <a href="<?= base_url('Master_admin/hapus_produk/' . $gidp->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('anda Yakin ?')">HAPUS</a>
                       <!---->

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
       <!-- /.box-body -->

       <!-- /.box-footer -->
     </div>

   </form>

 </section>
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

         <input type="text" name="cari" placeholder="Nama atau Id Produk..." class="form-control" required>

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
                 <td><?php echo $harga = $this->Mtrans->get_hargaproduk($gidp->id);
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
                   <?php
                    echo $tx;
                    $lapPro = $this->M_rProduk->viewLaporanProduk($gidp->id);
                    $nMendali = $this->M_rProduk->viewLaporanProduk($gidp->id);
                    $gtjenid = $this->M_rProduk->ketMendali($nMendali['kualitas']);

                    if ($nMendali['kualitas'] > 0) {
                      echo "</br>";
                      echo '<span class="label label-warning">' . $gtjenid->mendali . '</span>';
                    }

                    ?>

                 </td>
                 <td>
                   <!-- V201909 -->
                   <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(<?= $gidp->id ?>)"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
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


 <!-- Bootstrap modal -->
 <div class="modal fade" id="modal_form" role="dialog">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h3 class="modal-title">EDIT PRODUK</h3>
       </div>
       <form class="form-horizontal" id="form" action="<?= base_url('C_lapProduk/saveUpProduk') ?>" method="post" enctype="multipart/form-data">
         <div class="modal-body form">
           <input type="hidden" value="" name="id" />
           <div class="form-body">
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-3 control-label">Sertifikasi</label>

               <div class="col-sm-8">
                 <select name="mendali" class="form-control select2" style="border-radius: 6px ; width: 100%;">
                   <option selected="selected" disabled>--pilih mendali--</option>
                   <option value="0"> Kosong</option>
                   <option value="1"> Bronz</option>
                   <option value="2"> Silver</option>
                   <option value="3"> Emas</option>
                   <option value="4"> Platinum</option>
                 </select>

               </div>
             </div>

             <div class="form-group">
               <label for="inputEmail3" class="col-sm-3 control-label">kategori</label>

               <div class="col-sm-8">
                 <?= form_dropdown('id_k', $kategori, $gidp->id_k, 'class="form-control" style="border-radius: 6px" style=" width: 100%;"') ?>

               </div>
             </div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
           <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
         </div>
       </form>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
 <!-- End Bootstrap modal -->

 <script type="text/javascript">
   var id;

   function edit_person(id) {
     save_method = 'update';
     $('#form')[0].reset(); // reset form on modals
     $('.form-group').removeClass('has-error'); // clear error class
     $('.help-block').empty(); // clear error string

     //Ajax Load data from ajax
     $.ajax({
       url: "<?php echo site_url('C_lapProduk/viewProduk/') ?>" + id,
       type: "GET",
       dataType: "JSON",
       success: function(data) {

         $('[name="id"]').val(data.produk.idProduk);
         $('[name="mendali"]').val(data.produk.kualitas.bobot);
         $('[name="id_k"]').val(data.produk.kategori.idKat);
         $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
         $('.modal-title').text('EDIT PRODUK'); // Set title to Bootstrap modal title

       },
       error: function(jqXHR, textStatus, errorThrown) {
         alert('Error get data from ajax');
       }
     });
   }
 </script>
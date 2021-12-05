 <?php

  $id_pembeli = $this->session->userdata('id_pembeli');

  ?>

 <div class="panel panel-default">

   <!-- Default panel contents -->

   <div class="panel-heading">
     <h4><a href="<?= base_url('Welcome/allkategori') ?>"><?= $title2 ?></a> || <b><a href="<?= base_url('Welcome/publik/' . $produk->row()->id_k) ?>">Kategori <?= $produk->row()->kategori ?></a> / <?= $produk->row()->nama ?></b> </h4>
   </div>

   <div class="panel">

     <div class="row">



       <?php

        $gtog = $produk;

        foreach ($gtog->result() as $gt) { ?>

         <div class="col-md-6 col-sm-12">

           <?php

            $string = ($this->M_setapp->static_bm() . '/upload/barang/' . $gt->gambar);

            // $string=TRUE;

            $fotob = '';

            if ($string == FALSE) {


              // $fotob = $this->M_setapp->static_bm().'/upload/barang/'.$gt->gambar; 

              $fotob = base_url() . '/dist/img/E-Retail.jpg';
            } else {



              $fotob = $this->M_setapp->static_bm() . '/upload/barang/' . $gt->gambar;
            }



            ?>

           <div class="row">





             <div class="col-xs-12 col-md-12" align="center">



               <div class="thumbnail">



                 <p> <img srcset="<?= $fotob ?> 1024w, <?= $fotob ?> 2x" sizes="(min-width: 1024px) 50vw, 100vw" style="height: 400px; width: 400px" class="image img-responsive img-rounded gbrkecil">



                 </p>



               </div>



             </div>



             <div class="col-xs-12 col-md-12" align="center">



               <div class="btn-group btn-group-justified">

                 <div class="btn-group">

                   <img src="<?= $fotob ?>" style="height: 80px; width: 90px" class="image img-responsive img-rounded gbrkecil">

                 </div>

                 <div class="btn-group">

                   <img src="<?= $fotob ?>" style="height: 80px; width: 90px" class="image img-responsive img-rounded gbrkecil">

                 </div>

                 <div class="btn-group">

                   <img src="<?= $fotob ?>" style="height: 80px; width: 90px" class="image img-responsive img-rounded gbrkecil">

                 </div>

                 <div class="btn-group">

                   <img src="<?= $fotob ?>" style="height: 80px; width: 90px" class="image img-responsive img-rounded gbrkecil">

                 </div>

               </div><br />









             </div>



           </div>





           <div class="hidden-xs">

             <div class="thumbnail">

               <?php $guser = $this->Muser->get_user_by_id($gt->id_user)->row(); ?>

               <?php

                //          $string = file($this->M_setapp->static_bm().'/upload/profil/'.$guser->img);

                if ($string) {

                  if ($guser->jenis_kelamin == 'L') {

                    $fotorincibarang = $this->M_setapp->static_bm() . '/upload/profil/profil.png';
                  } else {

                    $fotorincibarang = $this->M_setapp->static_bm() . '/upload/profil/profil_m.png';
                  }
                } else {

                  $fotorincibarang = $this->M_setapp->static_bm() . '/upload/profil/' . $guser->img;
                } ///*/



                ?>

               <div class=" box-widget widget-user">

                 <!-- Add the bg color to the header using any of the bg-* classes -->

                 <div class="widget-user-header bg-aqua-active">

                   <h3 class="widget-user-username"><?= $guser->nama ?></h3>

                   <h5 class="widget-user-desc">Penjual</h5>

                   <br /><br />

                 </div>

                 <div class="widget-user-image">

                   <img src="<?= $fotorincibarang ?>" style="height: 100px;" class="img-circle">

                 </div>

                 <div class="box-footer">

                   <hr />

                   <!-- /.box-header -->

                   <div class="box-body">

                     <strong><i class="fa  fa-phone"></i> No. Kontak</strong>



                     <p class="text-muted"><?= $guser->no_kontak ?></p>



                     <hr>

                     <strong><i class="fa fa-envelope"></i> Email</strong>



                     <p class="text-muted"><?= $guser->username ?></p>



                     <hr>



                     <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>



                     <p class="text-muted"><?= $guser->alamat ?></p>









                   </div>

                   <!-- /.box-body -->

                   <!-- /.row -->

                 </div>

               </div>











             </div>

           </div>



         </div>

       <?php }



        //============================================================

        $qty = $this->Mtrans->get_produkqty($id_produk);  ///sudah di beli

        //============================================================

        $qty2pesan_id_user = $this->Mtrans->get_produkqty_dipesan_keranjang($id_produk, $id_s); ///masuk kekeranjang

        //============================================================

        $qty2pesan = $this->Mtrans->get_produkqty_dipesan($id_produk);  ///id_produk ///baru di pesan

        //============================================================

        $stoka = $gt->stok - $qty;

        //============================================================

        $stoka_input = $gt->stok - ($qty + $qty2pesan_id_user + $qty2pesan);

        //============================================================



        ?>







       <div class="col-md-6 col-sm-12">

         <div class="row">

           <div class="col-md-11">

             <div class="caption">



               <div class="page-header">

                 <h3><?= $gt->nama ?></h3>



                 <p style="font-size: 12px">Dijual Oleh : <a href="<?= base_url() ?>/Welcome/profil_publik/<?= $gt->id_user ?>/0/<?= $id_produk ?>"><?= $guser->nama ?></a></p>



                 <?php

                  $nlihat = $this->Muser->get_produk_by_id_view_rows($id_produk);

                  ?>

                 <p style="font-size: 12px">Dilihat : <?= $nlihat ?> kali</p>

                 <?php
                  $gtjenid = $this->M_vparsel->get_jenis_voc_id($gt->jen_voc);

                  if ($gtjenid->num_rows() > 0 and $gt->jen_voc == 1) {
                    echo '<span class="label label-warning">' . $gtjenid->row()->nama_jvoc . '</span>';
                  }

                  ?>

               </div>



               <?php

                if (($gt->hargak)) {

                  if ($gt->harga < $gt->hargak) {
                    echo ' <h6>Harga Normal <del>Rp ' . number_format($gt->hargak, 2, ',', '.') . '</del></h6>';
                  } else {
                    echo ' <h6>Harga Normal <del>Rp ' . number_format($gt->harga, 2, ',', '.') . '</del></h6>';
                  }
                }

                if ($gt->id_k != 4) {

                  if (empty($gt->hargak) or $gt->hargak == 0 or $gt->harga < $gt->hargak) {

                    if ($gt->harga != 0) {

                      echo ' <h4 class="text-danger"><b>Harga Rp ' . number_format($gt->harga, 2, ',', '.') . '</b></h4>';
                    } else {

                      echo number_format(0, 2, ',', '.');
                    }
                  } else {

                    echo ' <h4 class="text-danger"><b>Harga Khusus Rp ' . number_format($gt->hargak, 2, ',', '.') . '</b></h4>';
                  }
                } //idk != 4



                ?>



               <form method="post" id="theform" action="<?= base_url('welcome/proses_beli_produk') ?>">

                 <?php

                  if ($gt->id_k == 4) {
                    ///================================================idk = 4 [kategori jasa]
                  ?>
                 <?php } else {

                    ////=========================stok
                  ?>

                   <p>Tersedia : <?= $gt->stok ?> <?= $gt->satuan ?></p>

                   <h5>Dipesan &nbsp;: <?= $qty2pesan ?> <?= $gt->satuan ?></h5>

                   <h5>Terjual &nbsp;&nbsp;&nbsp;: <?= $qty ?> <?= $gt->satuan ?></h5>

                   <?php

                    if ($stoka > 0 and $guser->status == "1") {

                    ?>





                     <?php

                      if ($stoka > $qty2pesan or $stoka_input > 0) {



                      ?>

                       <hr />

                       <div class="row">



                         <div class="col-md-4">

                           <p>Jumlah produk yang di butuhkan: </p>



                           <select name="qty" class="form-control" style="border-radius: 5px">

                             <?php for ($x = 1; $x <= $stoka_input; $x++) { ?>

                               <option value="<?= $x ?>"><?= $x ?></option>

                             <?php } ?>

                           </select>

                           <br />

                           <input type="submit" id="btnsubmit" class="btn btn-success" value="Tambah ke Daftar Belanja" />



                         </div>

                       </div>



                     <?php

                      } else {

                        echo '<h2><span class="label label-danger">Persedian Kosong</span></h2>';
                      }



                      ?>

                     <input type="hidden" value="<?= $id_produk ?>" name="id_produk" />

               </form>

               <?php

                    } else {



                      if ($guser->status != "1") {
                ?>
                 <h2><span class="label label-danger">PENJUAL TIDAK AKTIF</span></h2>
               <?php
                      } else {
                ?>
                 <h2><span class="label label-danger">Persedian Kosong</span></h2>
             <?php
                      }
                    } ?>



           <?php  }

            ?>





             </div>

           </div>

         </div>





         <hr />

         <!--deskripsi-->

         <!-- Nav tabs -->

         <ul class="nav nav-tabs" role="tablist">

           <li class="active"><a href="#home" role="tab" data-toggle="tab">Deskripsi</a></li>

         </ul>



         <!-- Tab panes -->

         <div class="tab-content">

           <div class="tab-pane active" id="home"><br /><?= $produk->row()->deskripsi ?></div>

         </div>





         <!--deskripsi-->

       </div>

       <div class="hidden-lg col-sm-12">

         <hr />
         <hr />

         <div class="thumbnail">

           <?php $guser = $this->Muser->get_user_by_id($gt->id_user)->row(); ?>

           <?php

            /*$string = file_get_contents($this->M_setapp->static_bm().'/upload/profil/'.$guser->img);

		if ($string == FALSE){

			if($guser->jenis_kelamin=='L'){

				$fotorincibarang = $this->M_setapp->static_bm().'/upload/profil/profil.png'; 

			}else{

				$fotorincibarang = $this->M_setapp->static_bm().'/upload/profil/profil_m.png'; 

			}

		}else{

			

			 }

             //*/

            //$fotorincibarang = $this->M_setapp->static_bm().'/upload/profil/'.$guser->img; 



            ?>

           <div class="box box-widget widget-user">

             <!-- Add the bg color to the header using any of the bg-* classes -->

             <div class="widget-user-header bg-aqua-active">

               <h3 class="widget-user-username"><?= $guser->nama ?></h3>

               <h5 class="widget-user-desc">Penjual</h5>

               <br /><br />

             </div>

             <div class="widget-user-image">

               <img src="<?= $fotorincibarang ?>" style="height: 100px;" class="img-circle">

             </div>

             <div class="box-footer">

               <hr />

               <!-- /.box-header -->

               <div class="box-body">

                 <strong><i class="fa  fa-phone"></i> No. Kontak</strong>



                 <p class="text-muted"><?= $guser->no_kontak ?></p>



                 <hr>

                 <strong><i class="fa fa-envelope"></i> Email</strong>



                 <p class="text-muted"><?= $guser->username ?></p>



                 <hr>



                 <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>



                 <p class="text-muted"><?= $guser->alamat ?></p>









               </div>

               <!-- /.box-body -->

               <!-- /.row -->

             </div>

           </div>











         </div>

       </div>







     </div>

   </div>





 </div>



 <?php





  ?>
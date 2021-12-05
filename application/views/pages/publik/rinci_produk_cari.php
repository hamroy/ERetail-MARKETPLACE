 <style>
   .produk {
     position: relative;
   }

   .image {
     opacity: 1;
     display: block;
     width: 100%;
     height: auto;
     transition: .5s ease;
     backface-visibility: hidden;
   }

   .middle {
     transition: .5s ease;
     opacity: 0;
     position: absolute;
     top: 50%;
     left: 50%;
     transform: translate(-50%, -50%);
     -ms-transform: translate(-50%, -50%)
   }

   .produk:hover .image {
     opacity: 0.3;
   }

   .produk:hover .middle {
     opacity: 1;
   }
 </style>
 <div class="panel panel-default">
   <!-- Default panel contents -->
   <div class="panel-heading">
     <h4><a href="<?= base_url('Welcome/allkategori') ?>"><?= $title2 ?></a> || <b>Kategori '<?= $cari ?>'</b></h4>
   </div>
   <div class="panel-body">
     <div class="row">
       <?php
        $gtog = $this->Muser->get_produk_by_produkcari($cari);
        if ($gtog->num_rows() > 0) {
          foreach ($gtog->result() as $gt) { ?>
           <?php
            /*
          $string = read_file($this->M_setapp->static_bm().'/upload/barang/'.$gt->gambar);
		if ($string == FALSE){
			$fotob = $this->M_setapp->static_bm()..'/dist/img/E-Retail.jpg'; 
		}else{
			$fotob = $this->M_setapp->static_bm().'/upload/barang/'.$gt->gambar; 
			 }
             
             ///*/
            $fotob = $this->M_setapp->static_bm() . '/upload/barang/' . $gt->gambar;

            ?>
           <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">

             <div class="thumbnail">

               <div class="produk hidden-xs">

                 <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?= $gt->nama ?>"> <img src="<?= $fotob ?>" style="height: 210px; width: 200px" class="image img-responsive img-rounded gbrkecil"></a>

                 <div class="middle" align="center">
                   <a href="<?= base_url('Welcome/produk/' . $gt->id) ?>" class="btn btn-primary btn-md"> <i class="fa  fa-eye"></i> Lihat Rinci</a> <br /><br />

                   <?php $guser = $this->Muser->get_user_by_id($gt->id_user)->row(); ?>

                   <a type="button" href="<?= base_url() ?>/Welcome/profil_publik/<?= $gt->id_user ?>/0/0" class="btn btn-info btn-md" data-toggle="tooltip" data-placement="bottom" title="<?= $guser->nama ?>"><i class="fa  fa-fa-info-circle"></i> Penjual</a>
                 </div>

               </div>

               <div class="produk visible-xs"">
  
    <a href=" #" data-toggle="tooltip" data-placement="bottom" title="<?= $gt->nama ?>"> <img src="<?= $fotob ?>" style="height: 120px; width: 130px" class="image img-responsive img-rounded"></a>
                 <div class="middle" align="center">
                   <a href="<?= base_url('Welcome/produk/' . $gt->id) ?>" class="btn btn-primary btn-md"> <i class="fa  fa-eye"></i> Lihat Rinci</a> <br /><br />

                   <?php $guser = $this->Muser->get_user_by_id($gt->id_user)->row(); ?>

                   <a type="button" href="<?= base_url() ?>/Welcome/profil_publik/<?= $gt->id_user ?>/0/0" class="btn btn-info btn-md" data-toggle="tooltip" data-placement="bottom" title="<?= $guser->nama ?>"><i class="fa  fa-fa-info-circle"></i> Penjual</a>

                 </div>

               </div>
               <hr style="padding-bottom: 0px" />
               <!---->
               <div class="caption" style="padding-top: 00px ; height: 170px">
                 <h5><b><?= $gt->nama ?></b></h5>

                 <?php
                  if (($gt->hargak)) {
                    echo ' <h5 class="text-danger"><small><del>Rp ' . number_format($gt->harga, 2, ',', '.') . '</del></small><br/> ';
                  }
                  if ($gt->id_k != 4) {
                    echo '<b>Rp ';
                    if (empty($gt->hargak) or $gt->hargak == 0 or $gt->harga < $gt->hargak) {
                      if ($gt->harga != 0) {
                        echo number_format($gt->harga, 2, ',', '.');
                      } else {
                        echo number_format(0, 2, ',', '.');
                      }
                    } else {
                      echo number_format($gt->hargak, 2, ',', '.');
                    }

                    echo '</b></h5>';
                  } //idk

                  ?>


                 <?php

                  //============================================================
                  $qty = $this->Mtrans->get_produkqty($gt->id);
                  //============================================================
                  $qty2pesan_id_user = $this->Mtrans->get_produkqty_dipesan_keranjang($gt->id, $id_s);
                  //============================================================
                  $qty2pesan = $this->Mtrans->get_produkqty_dipesan($gt->id);  ///id_produk
                  //============================================================


                  //echo $qty;
                  //echo $qty2pesan;
                  //echo $id_s;
                  $stoka = $gt->stok - $qty;
                  if ($gt->id_k == 4) {
                    echo '<p>&nbsp;</p>';
                  } else {
                    if ($stoka > 0) {
                  ?>
                     <h6>Tersedia : <?= $stoka ?> <?= $gt->satuan ?></h6>
                     <h6>Dipesan &nbsp;: <?= $qty2pesan ?> <?= $gt->satuan ?></h6>
                     <h6>Terjual &nbsp;&nbsp;&nbsp;: <?= $qty ?> <?= $gt->satuan ?></h6>
                 <?php
                      ///jiaka yang di pesan > 0
                      if ($stoka <= $qty2pesan) {
                        echo '<h5 class="hidden-xs"><span class="label label-danger">Persedian Kosong</span></h5>';
                      }
                    } else {
                      echo (' <h6 >Terjual : ' . $qty . '&nbsp;&nbsp; ' . $gt->satuan . '</h6>');
                      echo '<h5 class="hidden-xs"><span class="label label-danger">Persedian Kosong</span></h5>';
                    }
                  }
                  ?>


               </div>
             </div>

           </div>

         <?php }
        } else { ?>
         <div class="alert alert-danger">Mohon Maaf, Produk yang anda cari Tidak Tersedia.</div>
       <?php }
        ?>


     </div>
   </div>


 </div>
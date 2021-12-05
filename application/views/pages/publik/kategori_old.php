 <div class="panel panel-default">

   <!-- Default panel contents -->

   <div class="panel-heading">
     <h4><b>Kategori</b> </h4>
   </div>

   <div class="panel-body">

     <!--AKATEGORI-->

     <div class="row">

       <?php



        $gtog = $this->Muser->get_kategori();

        foreach ($gtog->result() as $gt) { ?>

         <div class="col-lg-3">

           <div class="thumbnail">

             <a href="<?= base_url('Welcome/publik/' . $gt->id) ?>"> <img src="<?= base_url() ?>image/<?= $gt->img ?>"></a>



             <div class="caption">

               <h3 class="text-center"><?= $gt->kategori ?></h3>



             </div>

           </div>

         </div>

       <?php }



        ?>

     </div>

     <!--produkacak-->

     <div class="row">

       <div class="col-md-4">

         <div class="box box-solid">

           <div class="box-header with-border">

             <h3 class="box-title"><b>Populer <i class="fa   fa-star"></i></b></h3>

           </div>

           <!-- /.box-header -->

           <div class="box-body">

             <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



               <div class="carousel-inner" align="center">

                 <?php

                  $gtpropul = $this->Mtrans->getpropuler();

                  if ($gtpropul->num_rows() > 0)

                    foreach ($gtpropul->result() as $popid) {

                      $string = read_file('./upload/barang/' . $popid->gambar);

                      if ($string == TRUE) {

                        $idpop = $popid->id;
                      }
                    }

                  ///==============================================================POPULER

                  foreach ($gtpropul->result() as $pop) {

                    $string = read_file('./upload/barang/' . $pop->gambar);

                    if ($string == FALSE) {

                      $fotob = base_url() . '/dist/img/E-Retail.jpg';
                    } else {

                      $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                      if ($pop->id == $idpop) {

                        $a = 'active';
                      } else {

                        $a = '';
                      }



                  ?>

                     <div class="item <?= $a ?>">

                       <img src="<?= $fotob ?>" style="height: 190px; width: 200px">

                       <div class="carousel-caption">

                         <?= $pop->nama ?><br />

                         Rp : <?= $pop->harga ?>

                       </div>

                     </div>

                 <?php } //foto kosong

                  } // \loop

                  ?>



               </div>



             </div>

           </div>

         </div>



       </div>

       <div class="col-md-4">

         <div class="box box-solid">

           <div class="box-header with-border">

             <h3 class="box-title"><b>Terbaru <i class="fa  fa-sort-amount-desc"></i></b></h3>

           </div>

           <!-- /.box-header -->

           <div class="box-body">

             <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



               <div class="carousel-inner" align="center">

                 <?php

                  $gtpropulid = $this->Mtrans->getprobaruid();

                  $gtpropul = $this->Mtrans->getprobaru();

                  if ($gtpropulid->num_rows() > 0)

                    foreach ($gtpropulid->result() as $popid) {

                      $string = read_file('./upload/barang/' . $popid->gambar);

                      if ($string == TRUE) {

                        $idpop = $popid->id;
                      }
                    }

                  ///==============================================================TERBAR

                  foreach ($gtpropul->result() as $pop) {

                    $string = read_file('./upload/barang/' . $pop->gambar);

                    if ($string == FALSE) {

                      $fotob = base_url() . '/dist/img/E-Retail.jpg';
                    } else {

                      $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                      if ($pop->id == $idpop) {

                        $a = 'active';
                      } else {

                        $a = '';
                      }



                  ?>

                     <div class="item <?= $a ?>">

                       <img src="<?= $fotob ?>" style="height: 190px; width: 200px">

                       <div class="carousel-caption">

                         <?= $pop->nama ?><br />

                         Rp : <?= $pop->harga ?>

                       </div>

                     </div>

                 <?php } //foto kosong

                  } // \loop

                  ?>



               </div>



             </div>

           </div>

         </div>



       </div>

       <div class="col-md-4">

         <div class="box box-solid">

           <div class="box-header with-border">

             <h3 class="box-title"><b>Termurah <i class="fa  fa-bullhorn"></i></b></h3>

           </div>

           <!-- /.box-header -->

           <div class="box-body">

             <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



               <div class="carousel-inner" align="center">

                 <?php

                  $gtpropulid = $this->Mtrans->getpromrurruid();

                  $gtpropul = $this->Mtrans->getpromurah();

                  if ($gtpropulid->num_rows() > 0)

                    foreach ($gtpropulid->result() as $popid) {

                      $string = read_file('./upload/barang/' . $popid->gambar);

                      if ($string == TRUE) {

                        $idpop = $popid->id;
                      }
                    }

                  ///==============================================================TERBAR

                  foreach ($gtpropul->result() as $pop) {

                    $string = read_file('./upload/barang/' . $pop->gambar);

                    if ($string == FALSE) {

                      $fotob = base_url() . '/dist/img/E-Retail.jpg';
                    } else {

                      $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                      if ($pop->id == $idpop) {

                        $a = 'active';
                      } else {

                        $a = '';
                      }



                  ?>

                     <div class="item <?= $a ?>">

                       <img src="<?= $fotob ?>" style="height: 190px; width: 200px">

                       <div class="carousel-caption">

                         <?= $pop->nama ?><br />

                         Rp : <?= $pop->harga ?>

                       </div>

                     </div>

                 <?php } //foto kosong

                  } // \loop

                  ?>



               </div>



             </div>

           </div>

         </div>



       </div>





     </div>



     <?php if ($this->session->userdata('id_pembeli') == NULL) {



        //$this->Mtrans->insert_pembeli_new();	

        $tp = $this->Mtrans->show_pembeli_maxid();

        $pembeli = $tp;

        $this->session->set_userdata('id_pembeli', $pembeli);

        //$pembeli=$this->Mtrans->get_show_pembeli();

        //echo 'new'.$this->session->userdata('id_pembeli');



      } else {

        //echo 'uadah'.$this->session->userdata('id_pembeli');	

      }



      ?>
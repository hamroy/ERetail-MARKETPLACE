 <section class="content-header" style="background: #ecedee;">

   <h1>

     <b>DOMPET E-Retail</b>

     <small></small>

   </h1>



 </section>



 <!-- Main content -->

 <section class="content">

   <?php

    $message = $this->session->flashdata('pesan');

    echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

    ?>

   <?php

    $message0 = $this->session->flashdata('pesan0');

    echo $message0 == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message0 . '</p></div>';

    ?>

   <!--NAV-->





   <?php

    $gt_tblpesanvoucher = $this->Login_model->get_daftar_pesan_voucher($id_user);

    // echo 'ilham '.$gt_tblpesanvoucher->num_rows();

    if ($gt_tblpesanvoucher->num_rows() > 0) {

      if ($gt_tblpesanvoucher->row()->pesan_voucer == '1') {  //...sudah berhasil tahap 1 -->mulai ke tahap 2

    ?>

       <div class="row">

         <div class="col-md-6">

           <div class="callout callout-info">

             <h4>Selamat Berbelanja Menggunakan Dompet E-Retail





             </h4>

           </div>

         </div>

         <div class="col-md-6">



         </div>

       </div>





     <?php

      } elseif ($gt_tblpesanvoucher->row()->pesan_voucer == '99') { //...gagal tahap 1



      ?>

       <div class="callout callout-info">

         <p>Proses Kemarin Ditolak</p>

         <h4>Untuk Mendapatkan Voucher UMY sebesar Rp. 200.000 (Belaku s/d 31 januari 2018)



           <a data-toggle="modal" data-target="#myModalgambarvc" href="#">

             <i class="fa fa-hand-o-right"></i> klik disini

           </a> (Hanya Sekali)

         </h4>

       </div>









     <?php



      } else { //...menunggu tahap 1

      ?>



       <div class="callout callout-info">

         <h4>Voucher UMY sebesar Rp. 200.000 Sedang Diproses

         </h4>

       </div>









     <?php

      }
    } else {  //...belum merespon tahap 1

      ?>



     <div class="callout callout-info">

       <h4>Untuk Mendapatkan Voucher UMY sebesar Rp. 200.000 (Belaku s/d 31 januari 2018)



         <a data-toggle="modal" data-target="#myModalgambarvc" href="#">

           <i class="fa fa-hand-o-right"></i> klik disini

         </a> (Hanya Sekali)

       </h4>

     </div>









   <?php

    }



    ?>







   <div class="modal fade" id="myModalgambarvc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

     <div class="modal-dialog">

       <div class="modal-content">

         <div class="modal-header">

           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

           <h4 class="modal-title" id="myModalLabel">Form</h4>

         </div>

         <div class="modal-body">

           <form class="form-horizontal" action="<?= base_url('C_dompet/pesan_voucher/' . $id_user) ?>" method="post" enctype="multipart/form-data">

             <div class="box-body">







               <div class="form-group">

                 <label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000">NIK</label>



                 <div class="col-sm-9">

                   <input type="text" class="form-control" value="" style="border-radius: 6px" name="nik" id="inputEmail3" placeholder="NIK/NIP">

                   <small class="text-info">NIK/NIP 20 digit </small>

                 </div>

               </div>



               <div class="form-group">

                 <label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000">Unit Kerja</label>



                 <div class="col-sm-9">

                   <input type="text" class="form-control" value="" style="border-radius: 6px" name="unit" id="inputEmail3" placeholder="Unit Kerja">

                 </div>

               </div>











             </div>

             <!-- /.box-body -->

             <div class="box-footer">



               <button type="submit" class="btn btn-info pull-right btn-block btn-lg">Lanjut</button>

             </div>

             <!-- /.box-footer -->

           </form>

         </div>

         <div class="modal-footer">

           <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

         </div>

       </div>

     </div>

   </div>

   <!--ISI per kategori-->



   <div class="row">

     <div class="col-xs-12 col-md-6">

       <div class="panel panel-primary">

         <!-- Default panel contents -->

         <div class="panel-heading" align="center">
           <h3> #1 Dompet E-Retail - Deposit</h3>
         </div>

         <div class="panel-body">

           <h4 align="center">RP : <?= number_format($voucher_umy, 0, ',', '.') ?></h4>





         </div>





       </div>

     </div>

     <div class="col-xs-12 col-md-6">

       <div class="panel panel-danger">

         <!-- Default panel contents -->

         <div class="panel-heading" align="center">
           <h3>#2 Deposit Dibelanjakan</h3>
         </div>

         <div class="panel-body">

           <h4 align="center">RP : <?= number_format($voucher_dibelanjakan, 0, ',', '.') ?></h4>

         </div>





       </div>



     </div>

   </div>



   <div class="row">

     <div class="col-xs-12 col-md-6">



       <div class="panel panel-success">

         <!-- Default panel contents -->

         <div class="panel-heading" align="center">
           <h3>#3 Dompet E-Retail - Hasil Penjualan </h3>
         </div>

         <div class="panel-body">

           <h4 align="center">RP : <?= number_format($dompet, 0, ',', '.') ?></h4>

           <hr />

           <?php

            if ($dompet > 0) { ?>

             <a data-toggle="modal" type="button" class="btn btn-warning" data-target="#myModalgreedeem" href="#">

               <i class="fa fa-money"></i> Redeem

             </a>



           <?php

            } else {

            ?>

             <a data-toggle="modal" type="button" class="btn btn-warning">

               <i class="fa fa-money"></i> Redeem

             </a>



           <?php

            }



            ?>

           <div class="modal fade" id="myModalgreedeem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

             <div class="modal-dialog">

               <div class="modal-content">

                 <div class="modal-header">

                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                   <h4 class="modal-title" id="myModalLabel">Form</h4>

                 </div>

                 <div class="modal-body">

                   <form class="form-horizontal" action="<?= base_url('C_dompet/redeem_voucher/' . $id_user) ?>" method="post" enctype="multipart/form-data">

                     <div class="box-body">







                       <div class="form-group">

                         <label for="inputEmail3" class="col-sm-3 control-label " style="color: #000000">Redeem</label>



                         <div class="col-sm-9">

                           <input type="number" min="0" max="<?= $dompet ?>" class="form-control" value="" style="border-radius: 6px" name="redeem" id="inputEmail3" placeholder="Voucher yang Dicairkan">

                         </div>

                       </div>













                     </div>

                     <!-- /.box-body -->

                     <div class="box-footer">



                       <button type="submit" class="btn btn-info pull-right btn-block btn-lg prnt">Lanjut</button>

                     </div>

                     <!-- /.box-footer -->

                   </form>

                 </div>

                 <div class="modal-footer">

                   <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

                 </div>

               </div>

             </div>

           </div>

         </div>



       </div>

     </div>

     <div class="col-xs-12 col-md-6">



       <div class="panel panel-warning">

         <!-- Default panel contents -->

         <div class="panel-heading" style="background-color: #c6d22d" align="center">
           <h3>#4 Redeem E-Retail</h3>
         </div>

         <div class="panel-body" style="height: 133px">

           <h4 align="center">RP : <?= number_format($dompet_dicairkan, 0, ',', '.') ?></h4>

         </div>



       </div>





     </div>

   </div>













   <!--ISI per kategori-->







 </section>
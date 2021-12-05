 <section class="well content-header" style="background: #ecedee;">

   <h1>

     <b>DOMPET E-Retail</b>


   </h1>



 </section>

 <!-- Main content -->

 <section class="content">


   <?php
    ////20180501 v parsel
    $iduser = $id_user;
    $idjov; //4 == VG13 - VLL
    ///GALLVOC 201811
    $gP = $this->M_dompetKu->pendapatanDompet();  ///4 == VG13 - VLL

    $gv = $this->M_dompetKu->saldoDompet();  ///4 == VG13 - VLL

    /////
    $dibelanjakan_proses = $gv['saldo_dibelanjakanKu_proses'];
    $dibelanjakan = $gv['saldo_dibelanjakanKu'];
    $saldo = $gv['saldoKu'];
    //
    $dompet = $salpenvocpar = $gP['dompetKu']; ///hasil akhir pendapatan (cetak)
    $get_reedeem_tp = $gP['redeemKu'];
    $dompetKotor = $gP['dompetKotor'];
    $redeemTotal = $gP['redeemTotal'];
    $redeemTotal = $gP['redeemSelesaiKu'];
    //durasi
    $addDurasi = $this->M_dompetKu->getDataDompetPerakun($id_user)['addDurasi']; ///get durasi
    $durasi = $this->M_dompetKu->getDataDompetPerakun($id_user)['durasi']; ///get durasi
    $dur = $this->M_time->durasi_ymd($durasi, $addDurasi);







    ?>

   <!-- DOMPET SALDO -->

   <div class="row">
     <div class="col-xs-12 col-md-6">

       <div class="panel panel-primary">

         <!-- Default panel contents -->

         <div class="panel-heading" align="center">
           <h3> #1 Dompet E-Retail - Deposit</h3>
         </div>

         <div class="panel-body" align="center" style="padding: 17px">

           <h4 style="font-family: number; font-size: 29px;"><b>Rp : <?= number_format($saldo, 0, ',', '.') ?></b></h4>

           <h4 id="clockdiv">Durasi : <span class="days"><?= $dur ?></span> Hari
           </h4>
           <p class="text-info">
             (-) Saldo Dompet bisa dibelanjakan sebelum durasi habis.
           </p>


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

           <table class="table" align="center">
             <tr align="center">
               <td>DIPESAN</td>
               <td>DIPROSES</td>
             </tr>
             <tr>
               <td>
                 <h4 align="center">Rp : <?= number_format($dibelanjakan, 0, ',', '.') ?></h4>
               </td>
               <td>
                 <h4 align="center">Rp : <?= number_format($dibelanjakan_proses, 0, ',', '.') ?></h4>
               </td>
             </tr>
           </table>



         </div>

       </div>



     </div>

   </div>



   <!-- DOMPET SALDO -->

   <div class="row">

     <div class="col-xs-12 col-md-6">



       <div class="panel panel-success">

         <!-- Default panel contents -->

         <div class="panel-heading" align="center">
           <h3>#3 Dompet E-Retail - Hasil Penjualan </h3>
         </div>

         <div class="panel-body">

           <h4 align="center">Rp : <?= number_format($salpenvocpar, 0, ',', '.') ?></h4>

           <hr />

           <?PHP
            $MODRE = 0;
            $MENRE = '';

            if ($salpenvocpar > 0) {
              $MODRE = 1;
              $MENRE = '<a data-toggle="modal" type="button" class="btn btn-warning" data-target="#myModalgreedeem" href="#">

                      <i class="fa fa-money"></i>  Redeem

                      </a> ';
            }


            if ($this->M_dompetKu->cek_pendatanTrue() == 1) {
              $MODRE = 0;
              $MENRE = '';
              //send email ke admin
            }

            if ($salpenvocpar == 0) {
              $MODRE = 0;
              $MENRE = '';
            }

            echo $MENRE;
            ?>



           <p class="text-info"> <br /> (*)Proses redeem ini akan dibebani biaya fee pelayanan transaksi 2% </p>

           <?php

            $tanggal = $this->M_time->keBmt();
            ///*/
            ////*/
            ?>
           <h4 class="text-primary">(+) Pengambilan bisa dilakukan pada tanggal <?php echo $tanggal ?></h4>
           <?php
            if ($MODRE == 1) {
            ?>
             <div class="modal fade" id="myModalgreedeem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

               <div class="modal-dialog">

                 <div class="modal-content">

                   <div class="modal-header">

                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                     <h4 class="modal-title" id="myModalLabel">Form</h4>

                   </div>

                   <div class="modal-body">

                     <form class="form-horizontal" method="post" enctype="multipart/form-data" id="theform">

                       <div class="box-body">







                         <div class="form-group">

                           <label for="inputEmail3" class="col-sm-3 control-label " style="color: #000000">Redeem</label>



                           <div class="col-sm-9">

                             <input type="number" min="1" max="<?= $salpenvocpar ?>" class="form-control" value="<?= $salpenvocpar ?>" style="border-radius: 6px" name="redeem" id="inputEmail3" required placeholder="Voucher yang Dicairkan">
                             <input type="hidden" name="d3" value="1" />
                             <p class="text-info"> <br />(*)Proses redeem ini akan dibebani biaya fee pelayanan transaksi 2% </p>

                           </div>

                         </div>

                         <input type="hidden" name="jvoc" value="<?= $idjov ?>" />
                       </div>

                       <!-- /.box-body -->

                       <div class="box-footer">

                         <input id="btnsubmit" value="Lanjut" onclick="return konfirmasiredeem('<?= base_url('C_dompetp/redeem_voucher_v2/' . $id_user . '/4') ?>')" type="submit" class="btn btn-success pull-right btn-block btn-lg" />


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
           <?php
            }
            ?>


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

           <h4 align="center">Rp : <?= number_format($get_reedeem_tp, 0, ',', '.') ?></h4>

           <hr />



           <a href="<?= base_url('C_dompet/cetakan_beranda_riwayat/' . $idjov) ?>" class="btn btn-info">Riwayat Redeem</a>



         </div>



       </div>





     </div>

   </div>
   <script type="text/javascript">
     function konfirmasiredeem(action) {
       var r = confirm('Anda yakin?');

       if (r == true) {
         document.getElementById('theform').action = action;
       }
     }
   </script>




   <!--ISI per kategori-->







 </section>
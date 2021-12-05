 <section class="content-header" style="background: #ecedee;">

   <h1>

     <b>DOMPET E-Retail</b>

     <small></small>

   </h1>



 </section>



 <!-- Main content -->

 <section class="content">

   <?php



    $h = "7"; // Hour for time zone goes here e.g. +7 or -4, just remove the + or -

    $hm = $h * 60;

    $ms = $hm * 60;

    $tanggal = gmdate("d-m-Y ", time() + ($ms)); // 

    $bln = gmdate("n", time() + ($ms)); // 

    $thn = gmdate("Y", time() + ($ms)); // 

    //$bln='01';

    $nbln = array(

      '01' => 'Januari',

      '02' => 'Februari',

      '03' => 'Maret',

      '04' => 'April',

      '05' => 'Mei',

      '06' => 'Juni',

      '07' => 'Juli',

      '08' => 'Agustus',

      '09' => 'Oktober',

      '10' => 'November',

      '11' => 'September',

      '12' => 'Desember',

    );



    $waktu = gmdate("H:i:s", time() + ($ms));

    $kal = CAL_GREGORIAN;

    $nday = cal_days_in_month($kal, $bln, $thn);



    $id_voc = $thn . '' . $bln;



    $dvoc = array(

      '0' => '',

      '1' => '',

    );



    ////////////////

    $gtb = $this->M_voucher->get_edisi_bln($id_voc);

    $gtb_n = $gtb->num_rows();

    if ($gtb_n > 0) { ///cek tombol



      $gpv = $this->M_voucher->get_pesann_voc_id($id_user, $id_voc);



      if ($gpv->num_rows() == 0) {

        $dvoc = array(

          '0' => 'Untuk Mendapatkan Voucher UMY <br/>

                 Bulan ' . $nbln[$bln] . ' (Belaku s/d ' . $nday . ' ' . $nbln[$bln] . ' ' . $thn . ')',

          '1' => '<br/><a data-toggle="modal" data-target="#myModalgambarvc" href="#">

                      <i class="fa fa-hand-o-right"></i>  klik disini

                      </a> (Hanya Sekali)',

        );
      } elseif ($gpv->row()->proses == "0") {

        $dvoc = array(

          '0' => 'Voucher UMY <br/>

                 Bulan ' . $nbln[$bln] . ' (Belaku s/d ' . $nday . ' ' . $nbln[$bln] . ' ' . $thn . ') Dalam Proses',

          '1' => '',

        );
      } elseif ($gpv->row()->proses == "1") {

        $dvoc = array(

          '0' => 'Voucher UMY <br/>

                 Bulan ' . $nbln[$bln] . ' (Belaku s/d ' . $nday . ' ' . $nbln[$bln] . ' ' . $thn . ') sudah diterima',

          '1' => '',

        );
      } elseif ($gpv->row()->proses == "99") {

        $dvoc = array(

          '0' => 'Voucher UMY <br/>

                 Bulan ' . $nbln[$bln] . ' (Belaku s/d ' . $nday . ' ' . $nbln[$bln] . ' ' . $thn . ') di tolak',

          '1' => '',

        );
      }
    }









    ////////////////





    ?>







   <!--TAMPILKAN-->









   <div class="row">

     <div class="col-md-6">

       <div class="callout callout-warning">

         <h4>

           <?= $dvoc[0] ?>

           <?= $dvoc[1] ?>

         </h4>

       </div>

     </div>

   </div>





   <!--ISI per kategori-->







   <?php

    $this->load->view('pages/admin/viewer/dompet/saldo_voucher');

    ?>





   <!--ISI per kategori-->







 </section>



 <div class="modal fade" id="myModalgambarvc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

   <div class="modal-dialog">

     <div class="modal-content">

       <div class="modal-header">

         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

         <h4 class="modal-title" id="myModalLabel">Form</h4>

       </div>

       <div class="modal-body">

         <form class="form-horizontal" action="<?= base_url('C_dompet_2/pesan_voucher/' . $id_user) ?>" method="post" enctype="multipart/form-data">

           <div class="box-body">







             <div class="form-group">

               <label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000">NIK</label>



               <div class="col-sm-9">

                 <input type="text" class="form-control" value="" required="required" style="border-radius: 6px" name="nik" id="inputEmail3" placeholder="NIK/NIP">

                 <small class="text-info">NIK/NIP 20 digit </small>

               </div>

             </div>



             <div class="form-group">

               <label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000">Unit Kerja</label>



               <div class="col-sm-9">

                 <input type="text" class="form-control" value="" required="required" style="border-radius: 6px" name="unit" id="inputEmail3" placeholder="Unit Kerja">

               </div>

             </div>

             <div class="form-group">

               <label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000">SETUJU</label>



               <div class="col-sm-9">

                 <input type="checkbox" name="ya01" value="ya01" checked /> YA

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
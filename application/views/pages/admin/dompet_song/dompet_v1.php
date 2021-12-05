 <section class="well content-header" style="background: #ecedee;">

   <h1>

     <b>DOMPET E-Retail</b>


   </h1>



 </section>

 <div class="well well-sm">
   <h4>
     <b>VOUCHER RAMADHAN & THR</b>
   </h4>

 </div>



 <!-- Main content -->

 <section class="content">

   <?php



    //  echo $this->M_voucher->get_max_id_voc();    



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

      '0' => 'Voucher parsel tidak berlaku',

      '1' => '',
      '2' => '0',


    );

    $menmod = 0;



    ////////////////

    //echo

    $id_voc_s = $this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi SONGSONG
    $gpv = $this->M_vparsel->get_pesan_voc_song_id($id_user, $id_voc_s);
    //sett voc
    $get_setvoc = $this->Madmin_master->get_onoffvoc($id_user);     //set onoff
    $get_setvocall = $this->Madmin_master->get_onoffvoc_all($id_user);     //set onoff

    // echo $gpv->num_rows();

    if ($gpv->num_rows() == 0) {



      /////////////////SET VOC
      $menmod = 1;

      $dvoc = array(

        '0' => 'Untuk Mendapatkan Voucher RAMADHAN & THR <br/>

                      <a data-toggle="modal" data-target="#myModalgambarvc" href="#">

                      <i class="fa fa-hand-o-right"></i>  klik disini

                      </a> (Hanya Sekali)

                 ',

        '1' => '

                      <br/>

                      <br/>

                      <span style="color:#0d18f2">( Saldo Voucher akan hangus pada 31 Desember 2018 )</span>
                      <br>
                      <span style="color:#3438e9; font-size: 12px">( Bagi yang memiliki saldo voucher Ramadhan akan diakumulasi secara otomatis dengan voucher THR )</span>    

                      ',
        '2' => 1,

      );

      /////////////////SET VOC PE ID

      if ($get_setvoc->num_rows() > 0) {

        if ($get_setvoc->row()->vsong2 == '0') {

          $dvoc = array(

            '0' => 'Voucher RAMADHAN & THR

                     tidak aktif',

            '1' => '<br/>

                          <br/>

                          <span style="color:#0d18f2">( Saldo Voucher akan hangus pada 31 Desember 2018 )</span>
                          <br/>
                          <span style="color:#3438e9; font-size: 12px">( Bagi yang memiliki saldo voucher Ramadhan akan diakumulasi secara otomatis dengan voucher THR )</span>    
                          
                          ',


          );
        }
      }

      /////////////////SET VOC    





    } elseif ($gpv->row()->proses == "0") {

      $dvoc = array(

        '0' => 'Voucher RAMADHAN & THR 

                  dalam Proses',

        '1' => '',

      );
    } elseif ($gpv->row()->proses == "1") {

      $dvoc = array(

        '0' => 'Voucher RAMADHAN & THR 

                  sudah diterima',

        '1' => '<br/>

                      <br/>

                      <span style="color:#0d18f2">( Saldo Voucher akan hangus pada 31 Desember 2018 )</span>
                      <br/>
                          <span style="color:#3438e9; font-size: 12px">( Bagi yang memiliki saldo voucher Ramadhan akan diakumulasi secara otomatis dengan voucher THR )</span>    
                      ',

      );
    } elseif ($gpv->row()->proses == "99") {

      $dvoc = array(

        '0' => 'Voucher RAMADHAN & THR 

                  ditolak',

        '1' => '',

      );
    }







    //}

    /////////////20180418

    $tglnow = $this->M_time->tgl_now();

    //$tglnow=10;

    //echo $job=1;

    /*if($job == 3 ){

              $dvoc=array(

                 '0'=>'Voucher parsel tidak berlaku',

                 '1'=>'',

                ); 

        }
    //*/

    ////SET onoff voucher

    if ($get_setvocall->row()->vc3 == 0) { ///vc4 == songsong

      $dvoc = array(

        '0' => 'Voucher di non aktifkan',

        '1' => '',

      );
    }
    /*
        elseif(){
            
        }
        ///*/
    // terdaftar tidanya
    $cekmhsaktif = $this->M_adminvoc->cekniaktif($ni, 2);
    if ($cekmhsaktif->num_rows() == 0) {

      $dvoc = array(

        '0' => 'Voucher tidak tersedia',

        '1' => '',

      );
    }
    ///*/
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

    $this->load->view('pages/admin/dompet_song/saldo_voucher');

    ?>





   <!--ISI per kategori-->







 </section>



 <?php
  if ($menmod == 1) {
  ?>
   <div class="modal fade" id="myModalgambarvc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

     <div class="modal-dialog">

       <div class="modal-content">

         <div class="modal-header">

           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

           <h4 class="modal-title" id="myModalLabel">Form</h4>

         </div>

         <div class="modal-body">

           <form class="form-horizontal" action="<?= base_url('C_dompetsong/pesan_voucher_p/' . $id_user) ?>" method="post" enctype="multipart/form-data" id="theform2">

             <div class="box-body">



               <?php

                $nnim = 'NIK/NIP/NIM/Kode Sub Unit Kerja';
                $knim = '<small class="text-danger">(*) NIK/NIP/NIM/Kode Sub Unit Kerja wajib diisi  </small>';
                $vnim = $ni;
                $rnput2 = 'readonly';
                $rnput = '';
                $nuk = 'Unit Kerja';
                $kuk = '<small class="text-danger">(*) Unit Kerja wajib diisi  </small>';
                $vuk = '';

                ?>

               <div class="form-group">

                 <label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000"><?= $nnim ?></label>



                 <div class="col-sm-9">

                   <input type="text" class="form-control" value="<?= $vnim ?>" <?= $rnput2 ?> required="required" style="border-radius: 6px" name="nik" id="inputEmail3" placeholder="<?= $nnim ?>">

                   <?= $knim ?>

                 </div>

               </div>



               <div class="form-group">

                 <label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000"><?= $nuk ?></label>



                 <div class="col-sm-9">

                   <input type="text" class="form-control" required="required" <?= $rnput ?> value="<?= $vuk ?>" required="required" style="border-radius: 6px" name="unit" id="inputEmail3" placeholder="<?= $nuk ?>">

                   <?= $kuk ?>
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



               <input id="btnsubmit2" value="Lanjut" type="submit" class="btn btn-success pull-right btn-block btn-lg" />

             </div>

             <!-- /.box-footer -->

           </form>

         </div>

         <div class="modal-footer">

           <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

         </div>

       </div>

     </div>

   </div <?php
        }

          ?>
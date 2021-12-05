 <section class="content-header" style="background: #ecedee;">

     <h1>

         <b>DOMPET E-Retail</b>

         <small></small>

     </h1>



 </section>



 <!-- Main content -->

 <section class="content">

     <?php



        ////////////////

        $get_onof3 = $this->Madmin_master->get_onoffvoc_pervc($id_user, 3);

        $get_onof2 = $this->Madmin_master->get_onoffvoc_pervc($id_user, 2);

        $get_onof1 = $this->Madmin_master->get_onoffvoc_pervc($id_user, 1);

        ////////////////

        $get_onof2_all = $this->Madmin_master->get_onoffvoc_pervc_all(2);

        $get_onof1_all = $this->Madmin_master->get_onoffvoc_pervc_all(1);

        $get_onof3_all = $this->Madmin_master->get_onoffvoc_pervc_all(3);

        ////////////////



        ?>







     <!--NAV-->





     <?php

        ///////////////////INTI

        $gt_tblpesanvoucher = $this->Login_model->get_daftar_pesan_voucher($id_user); //tbl pesan voucher



        $no_edisi = $gt_tblinputpesanvoucher_select_tahap = $this->Login_model->get_daftar_input_voucher_st($id_user); //edisi terakhir



        $gt_tblinputpesanvoucher_tahap_no = $this->Login_model->get_daftar_input_voucher_st_no($id_user); //tahap terakhir

        $gt_tblinputpesanvoucher_tahap_no_m = $this->Login_model->get_daftar_input_voucher_st_no_m($id_user, 0); //tahapterakhir makan

        $gt_tblinputpesanvoucher_tahap_no_b = $this->Login_model->get_daftar_input_voucher_st_no_m($id_user, 1); //tahap terakhir BONUS



        $gt_tblinputpesanvoucher = $this->M_voucher->get_all_input_voc_id($id_user); //tbl pesan paucher

        $gt_inputvoucher2 = $this->M_voucher->cek_proses_blumacc($id_user, 1); //tbl pesan paucher



        ///////////////////INTI   













        ////REV 231017 ==========================================================================

        if ($gt_tblpesanvoucher->num_rows() > 0) {



            //...Sudah merespon tahap 1

            ////REV 011017

            //echo '<br/>pesan_voc ='.

            $s_aw0 = $gt_tblpesanvoucher->row()->pesan_voc;



            if ($s_aw0 == 0) {

                $idisi = $no_edisi + 1; ///lsnnjut data baru



            } else {

                $idisi = $no_edisi + 1; //lanjut bila data lama

                /*if($idisi==$no_edisi+1){

                            $idisi=$idisi;

                        }else{

                            $idisi=$no_edisi+1;

                        } ///*/
            }

            if ($idisi == 1) {

                $edisi_0 = 2;
            } else {

                $edisi_0 = $idisi;
            }



            /* if($s_aw0==$no_edisi+1){

                        $edisi=$edisi_0;

                    }else{

                        $edisi=$no_edisi+1;

                    } /// &*/

            $edisi = $edisi_0;





            //echo '</br>EDISI voucher lanjut='. $edisi; 



            //VOUCHER 2

            //proses voucher 

            $gt_cekproses = $this->M_voucher->cek_proses_voc($id_user);

            if ($gt_cekproses == true) { //proses

                $dpvoc = array(

                    '0' => '',

                    '1' => 'Voucher Sedang Diproses',

                    '2' => '#', //link

                    '3' => '',



                );
            } else { ///voucher 2 lanjut th=>th2

                $dpvoc = array(

                    '0' => '',

                    '1' => 'Untuk Mendapatkan Voucher Makan',

                    '2' => base_url('C_dompet/pesan_voucher_t2/' . $id_user . '/2/' . $edisi), //link

                    '3' => '<i class="fa fa-hand-o-right"></i>  klik disini',

                );
            }









            if ($gt_tblpesanvoucher->row()->pesan_voucer == '1') { //row 3 bagan



                //VOUCHER 1

                $dvoc = array(

                    '0' => 'Selamat Berbelanja Menggunakan Dompet E-Retail',

                    '1' => '',

                );
            } elseif ($gt_tblpesanvoucher->row()->pesan_voucer == '99') { //...gagal tahap 1

                $dvoc = array(

                    '0' => 'Voucher Saudara tidak di setujui.',

                    '1' => '',

                );
            } else { //row 2 bagan

                $dvoc = array(

                    '0' => 'Voucher UMY sebesar Rp. 200.000 Sedang Diproses',

                    '1' => '',

                );
            }
        } else { //row 2 bagan

            //...belum merespon tahap 1



            $dvoc = array(

                '0' => 'Untuk Mendapatkan Voucher UMY sebesar Rp. 200.000 (Belaku s/d 31 januari 2018)',

                '1' => '  <a data-toggle="modal" data-target="#myModalgambarvc" href="#">

                      <i class="fa fa-hand-o-right"></i>  klik disini

                      </a> (Hanya Sekali)',

            );
        }



        ////REV 231017 ==========================================================================



        //VOUCHER 3(BONUS)

        //proses voucher                        

        if ($gt_inputvoucher2->num_rows() > 0) { //proses

            $h4j = 'Sedang diProses';

            $urlh4j = '#';

            $llinksetuju = ' ';
        } else { ///voucher 3 lanjut th=>th2

            $h4j = 'Untuk Mendapatkan Bonus Voucher';

            $urlh4j = base_url('C_dompet/pesan_voucher_t2_bonus/' . $id_user . '/2/2');

            $llinksetuju = '<i class="fa fa-hand-o-right"></i>  klik disini';
        }





        ////REV 231017 ==========================================================================





        if ($gt_tblpesanvoucher->num_rows() > 0) {



            ////REV 011017 ==========================================================================









            if ($gt_tblpesanvoucher->row()->pesan_voucer == '1' or $gt_tblpesanvoucher->row()->pesan_voucer == '99') {

                //...sudah berhasil tahap 1 {antaraditerimadan tolak} -->mulai ke tahap 2



        ?>



             <div class="row">



                 <!--VOUCHER 1-->

                 <div class="col-md-4">

                     <div class="callout callout-info">

                         <h4>

                             <?= $dvoc[0] ?>

                             <?= $dvoc[1] ?>

                         </h4>

                     </div>

                 </div>



                 <?php



                    //echo$get_onof2;

                    $pec = explode('-', $get_onof2); ///masukkan ke array 

                    $pec2 = explode('-', $get_onof2_all); ///masukkan ke array 

                    // echo $pec2[1];

                    $noth = $edisi;

                    if ($pec[$noth - 1] != $noth and $pec2[$noth - 1] != $noth) {

                    ?>

                     <!--VOUCHER 2-->

                     <div class="col-md-4">

                         <div class="callout callout-success">

                             <?= $dpvoc[0] ?>

                             <h4>

                                 <?= $dpvoc[1] ?>

                                 <a onclick="return confirm('Anda Yakin !')" href="<?= $dpvoc[2] ?>">

                                     <?= $dpvoc[3] ?>

                                 </a>

                             </h4>

                         </div>



                     </div>

                 <?php

                    } else {

                        ////

                    }

                    ?>







                 <?php



                    if ($get_onof3_all == 0 and $get_onof3 == 0) {





                    ?>

                     <!--voucher bonus-->

                     <div class="col-md-4">

                         <div class="callout callout-warning">

                             <h4 style="color: #000000"><?= $h4j ?>



                                 <a onclick="return confirm('Anda Yakin !')" style="color: #000000" href="<?= $urlh4j ?>">

                                     <?= $llinksetuju ?>

                                 </a>



                             </h4>

                         </div>

                     </div>

                     <!--voucher bonus-->



                 <?php



                    }



                    ?>

                 <!--VOUCHER BONUS-->



             </div>



         <?php



            } else { //...menunggu tahap 1  // voucher sedang di proses



            ?>



             <div class="row">

                 <div class="col-md-6">

                     <div class="callout callout-info">

                         <h4>

                             <?= $dvoc[0] ?>

                             <?= $dvoc[1] ?>

                         </h4>

                     </div>

                 </div>

                 <?php



                    if ($get_onof3_all == 0 and $get_onof3 == 0) {





                    ?>

                     <!--voucher bonus-->

                     <div class="col-md-6">

                         <div class="callout callout-warning">

                             <h4 style="color: #000000"><?= $h4j ?>



                                 <a onclick="return confirm('Anda Yakin !')" style="color: #000000" href="<?= $urlh4j ?>">

                                     <?= $llinksetuju ?>

                                 </a>



                             </h4>

                         </div>

                     </div>

                     <!--voucher bonus-->



                 <?php



                    }



                    ?>

             </div>









         <?php

            }
        } else {  //...belum merespon tahap 1





            ?>



         <div class="row">



             <?php



                if ($get_onof1_all == 0 and $get_onof1 == 0) {





                ?>

                 <div class="col-md-6">

                     <div class="callout callout-info">

                         <h4>

                             <?= $dvoc[0] ?>

                             <?= $dvoc[1] ?>

                         </h4>

                     </div>

                 </div>



             <?php



                }



                ?>



             <?php



                if ($get_onof3_all == 0 and $get_onof3 == 0) {





                ?>

                 <!--voucher bonus-->

                 <div class="col-md-6">

                     <div class="callout callout-warning">

                         <h4 style="color: #000000"><?= $h4j ?>



                             <a onclick="return confirm('Anda Yakin !')" style="color: #000000" href="<?= $urlh4j ?>">

                                 <?= $llinksetuju ?>

                             </a>



                         </h4>

                     </div>

                 </div>

                 <!--voucher bonus-->



             <?php



                }



                ?>



         </div>







     <?php

        }



        ?>









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

                 <form class="form-horizontal" action="<?= base_url('C_dompet/pesan_voucher/' . $id_user) ?>" method="post" enctype="multipart/form-data">

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
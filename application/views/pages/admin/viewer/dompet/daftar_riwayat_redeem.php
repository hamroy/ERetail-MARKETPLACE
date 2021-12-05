 <section class="content-header" style="background: #ecedee;">

   <h1>

     <b><a href="<?= base_url('C_dompet/dompet') ?>"><i class="fa fa-briefcase"></i> DOMPET </a> || DAFTAR RIWAYAT REDEEM </b>

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





   <!--ISI per kategori-->



   <div class="row">

     <div class="col-xs-12 col-md-12">
       <div class="panel panel-primary">

         <!-- Default panel contents -->

         <div class="panel-heading" align="center">
           <h3>Riwayat redeem Dompet E-Retail </h3>
         </div>

         <div class="panel-body">

           <div class="table-responsive">

             <?php
              $linkback = base_url('C_dompet/dompet');
              if ($j_voc == 1) {
                $linkback = base_url('C_dompetp/dompet');
              } elseif ($j_voc == 2) {
                $linkback = base_url('C_dompetsong');
              } elseif ($j_voc == 4) {
                $linkback = base_url('C_dompetvoc');
              } elseif ($j_voc == 99) {
                $linkback = base_url('C_dompetKu');
              }
              ?>

             <a class="btn btn-default" href="<?= $linkback ?>"> <i class="fa fa-arrow-left"></i> KEMBALI </a> <br /><br />



             <table class="table no-margin">

               <thead>

                 <tr bgcolor="#d9d9dd">

                   <th>NO</th>



                   <th>Redeem</th>

                   <th>Tanggal</th>
                   <th>STATUS</th>

                   <th>MENU</th>

                 </tr>

               </thead>

               <?php
                if ($j_voc == 99) {
                  $g_id2 = $this->M_voucher->get_id_user_tblpesanvoc_all_99($id_user);
                } else {
                  $g_id2 = $this->M_voucher->get_id_user_tblpesanvoc_all($id_user, $j_voc); ///

                }


                $no = 1;
                $to = 0;
                if ($g_id2->num_rows() > 0) {



                  foreach ($g_id2->result() as $gur) {

                ?>

                   <tr>

                     <td><?= $no++ ?></td>

                     <td><?= $gur->redeem ?></td>

                     <td><?= $gur->tgl_trans ?></td>
                     <td>
                       <?php

                        switch ($gur->status) {
                          case '0':
                            echo 'REDEEM';
                            break;
                          case '1':
                            echo 'SELESAI';
                            break;
                          default:
                            echo 'SELESAI';
                            break;
                        }

                        ?>

                     </td>

                     <td> <a type="button" class="btn btn-success " id="" href="<?= base_url('C_dompet/cetak/pdf/2/' . $gur->id) ?>">

                         <i class="fa fa-file-pdf-o"></i> PDF

                       </a>

                       <a type="button" target="_blank" class="btn btn-warning " id="" href="<?= base_url('C_dompet/cetak/html/2/' . $gur->id) ?>">

                         <i class="fa fa-print"></i> Cetak

                       </a>



                     </td>

                   </tr>

               <?php

                    $to = $to + $gur->redeem;
                  }
                }

                ?>









             </table>





             <hr />

             <a class="btn btn-default" href="<?= base_url('C_dompet/dompet') ?>"> TOTAL = <?= $to ?></a>





           </div>



         </div>





       </div>





     </div>







   </div>













   <!--ISI per kategori-->







 </section>
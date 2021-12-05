 <section class="content-header" style="background: #ecedee;">
   <h1>
     <b>RIWAYAT PENCAIRAN DOMPET E-Retail</b>
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
     <div class="col-xs-12 col-md-6">
       <div class="panel panel-primary">
         <!-- Default panel contents -->
         <div class="panel-heading" align="center">
           <h3>Pencairan Dompet E-Retail - Penjual</h3>
         </div>
         <div class="panel-body">
           <div class="table-responsive">
             <table class="table no-margin">
               <thead>
                 <tr bgcolor="#d9d9dd">
                   <th>No</th>
                   <th>Nama</th>
                   <th>NIK/ NBM</th>
                   <th>Unit Kerja</th>
                   <th>Redeem</th>
                   <th>Tanggal</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $all = $this->Mbmt->get_tbl_redeem_all();
                  if ($all->num_rows() > 0) {
                    $no = 1;
                    foreach ($all->result() as $q) {
                      $g_id2 = $this->Muser->get_id_user_tblpesanvoc($q->idlog); ///get masing masing id user
                      if ($g_id2->num_rows() > 0) {
                        $nbm = $g_id2->row()->nik;
                        $unit = $g_id2->row()->unit;
                      } else {
                        $nbm = $q->nbm;
                        $unit = '';
                      }
                  ?>
                     <tr>
                       <td><?= $no++ ?></td>
                       <td><?= $q->nama ?></td>
                       <td><?= $nbm ?></td>
                       <td><?= $unit ?></td>
                       <td><?= $q->redeem ?></td>
                       <td><?= $q->tgl_trans ?></td>
                     </tr>

                 <?php
                    } //loop
                  } //if numrows
                  ?>

               </tbody>
             </table>
           </div>

         </div>


       </div>


     </div>


     <div class="col-xs-12 col-md-6">

       <div class="panel panel-warning">
         <!-- Default panel contents -->
         <div class="panel-heading" align="center">
           <h3>Pencairan Dompet E-Retail - Disetujui</h3>
         </div>
         <form class="form-horizontal" action="<?= base_url('C_bmt/cetak_pencairan/') ?>" method="post" enctype="multipart/form-data">
           <div class="panel-body">
             <div class="table-responsive">
               <table class="table no-margin">
                 <thead>
                   <tr bgcolor="#d9d9dd">
                     <th>No</th>
                     <th>Nama</th>
                     <th>NIK/ NBM</th>
                     <th>Unit Kerja</th>
                     <th>Redeem</th>
                     <th>Tanggal</th>
                     <th>Tanggal otorisasi</th>

                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    $all = $this->Mbmt->get_tbl_redeem_all_setuju();
                    if ($all->num_rows() > 0) {
                      $no = 1;
                      foreach ($all->result() as $q) {
                        $g_id2 = $this->Muser->get_id_user_tblpesanvoc($q->idlog); ///get masing masing id user
                        if ($g_id2->num_rows() > 0) {
                          $nbm = $g_id2->row()->nik;
                          $unit = $g_id2->row()->unit;
                        } else {
                          $nbm = $q->nbm;
                          $unit = '';
                        }
                    ?>
                       <tr>
                         <td><?= $no++ ?></td>
                         <td><?= $q->nama ?></td>
                         <td><?= $nbm ?></td>
                         <td><?= $unit ?></td>

                         <td><?= $q->redeem ?></td>
                         <td><?= $q->tgl_trans ?></td>
                         <td><?= $q->tgl_oto ?></td>
                       </tr>

                   <?php
                      } //loop
                    } //if numrows
                    ?>

                 </tbody>
               </table>
             </div>





           </div>
         </form>
       </div>




     </div>
   </div>
   <div class="row">
     <div class="col-xs-12 col-md-6">
       <div class="panel panel-info">
         <!-- Default panel contents -->
         <div class="panel-heading" align="center">
           <h3>Pencairan Dompet E-Retail - KEUANGAN</h3>
         </div>
         <div class="panel-body">
           <div class="table-responsive">
             <table class="table no-margin">
               <thead>
                 <tr bgcolor="#d9d9dd">
                   <th>No</th>
                   <th>Nama</th>
                   <th>NIK / NBM</th>
                   <th>Unit Kerja</th>
                   <th>Redeem</th>
                   <th>Tanggal</th>
                   <th>Tanggal Otorisasi</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $all = $this->Mbmt->get_tbl_redeem_all_cetak3();
                  if ($all->num_rows() > 0) {
                    $no = 1;
                    foreach ($all->result() as $q) {
                      $g_id2 = $this->Muser->get_id_user_tblpesanvoc($q->idlog); ///get masing masing id user
                      if ($g_id2->num_rows() > 0) {
                        $nbm = $g_id2->row()->nik;
                        $unit = $g_id2->row()->unit;
                      } else {
                        $nbm = $q->nbm;
                        $unit = '';
                      }
                  ?>
                     <tr>
                       <td><?= $no++ ?></td>
                       <td><?= $q->nama ?></td>
                       <td><?= $nbm ?></td>
                       <td><?= $unit ?></td>
                       <td><?= $q->redeem ?></td>
                       <td><?= $q->tgl_trans ?></td>
                       <td><?= $q->tgl_oto ?></td>

                     </tr>

                 <?php
                    } //loop
                  } //if numrows
                  ?>

               </tbody>
             </table>
           </div>

         </div>


       </div>


     </div>


     <div class="col-xs-12 col-md-6">

       <div class="panel panel-success">
         <!-- Default panel contents -->
         <div class="panel-heading" align="center">
           <h3>Pencairan Dompet E-Retail - Selesai</h3>
         </div>
         <div class="panel-body">
           <div class="table-responsive">
             <table class="table no-margin">
               <thead>
                 <tr bgcolor="#d9d9dd">
                   <th>No</th>
                   <th>Nama</th>
                   <th>NIK / NBM</th>
                   <th>Unit Kerja</th>
                   <th>Redeem</th>
                   <th>Tanggal</th>
                   <th>Tanggal Otorisasi</th>
                 </tr>
               </thead>
               <tbody>
                 <?php
                  $all = $this->Mbmt->get_tbl_redeem_all_selesai();
                  if ($all->num_rows() > 0) {
                    $no = 1;
                    foreach ($all->result() as $q) {
                      $g_id2 = $this->Muser->get_id_user_tblpesanvoc($q->idlog); ///get masing masing id user
                      if ($g_id2->num_rows() > 0) {
                        $nbm = $g_id2->row()->nik;
                        $unit = $g_id2->row()->unit;
                      } else {
                        $nbm = $q->nbm;
                        $unit = '';
                      }
                  ?>
                     <tr>
                       <td><?= $no++ ?></td>
                       <td><?= $q->nama ?></td>
                       <td><?= $nbm ?></td>
                       <td><?= $unit ?></td>
                       <td><?= $q->redeem ?></td>
                       <td><?= $q->tgl_trans ?></td>
                       <td><?= $q->tgl_oto ?></td>
                     </tr>

                 <?php
                    } //loop
                  } //if numrows
                  ?>

               </tbody>
             </table>
           </div>



         </div>
       </div>




     </div>
   </div>






   <!--ISI per kategori-->



 </section>
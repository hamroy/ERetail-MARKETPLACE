 <section class="content-header" style="background: #ecedee;">
   <h1>
     <b><a href="<?= base_url('C_dompet/dompet') ?>"><i class="fa fa-briefcase"></i> DOMPET </a> || Cetak</b>
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
           <h3>Cetak Dompet E-Retail </h3>
         </div>
         <div class="panel-body">
           <div class="table-responsive">


             <a type="button" class="btn btn-danger" href="<?= base_url('C_dompet') ?>">
               <i class="fa fa-arrow-left"></i> Kembali
             </a>
             <a type="button" target="_blank" class="btn btn-warning " id="" href="<?= base_url('C_dompet/cetak/') ?>">
               <i class="fa fa-print"></i> Cetak
             </a>
             <a type="button" class="btn btn-success " id="" href="<?= base_url('C_dompet/cetak/pdf') ?>">
               <i class="fa fa-file-pdf-o"></i> PDF
             </a>
             <br /><br />
             <table class="table no-margin">
               <table class="table" style="width: 100%">
                 <thead>
                   <tr bgcolor="#d9d9dd" align="center">
                     <th>Nama</th>
                     <th>NIK / NBM</th>
                     <th>Unit Kerja</th>

                     <th>Tanggal</th>
                     <th>Redeem</th>
                   </tr>

                 </thead>
                 <tbody>


                   <tr align="center">
                     <td><?= $nama ?></td>
                     <td><?= $nbm ?></td>
                     <td><?= $unit ?></td>

                     <td><?= $this->session->userdata('tgl_trans') ?></td>
                     <td align="right"><?= $this->session->userdata('redeem') ?></td>
                   </tr>
                   <tr align="center">
                     <td colspan="4" align="right">Biaya Administrasi</td>
                     <td align="right"><?= $this->session->userdata('kebmt') ?></td>
                   </tr>
                   <tr align="center">
                     <td colspan="4" align="right">Total</td>
                     <td align="right"><?= $this->session->userdata('kebmt') + $this->session->userdata('redeem') ?></td>
                   </tr>
                   <tr align="left" style="background-color: #b9bfc4">
                     <td colspan="5">
                       <h4>(*) Pengambilan bisa dilakukan pada tanggal <?= $this->session->userdata('tgl_kebmt') ?></h4>
                     </td>
                   </tr>




                 </tbody>
               </table>


               <hr />



           </div>

         </div>


       </div>


     </div>



   </div>






   <!--ISI per kategori-->



 </section>
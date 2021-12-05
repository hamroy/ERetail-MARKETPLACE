 <section class="content-header" style="background: #ecedee;">


   <br />
   <h1>
     <b>
       <a href="<?= base_url('C_dompet/dafatar_pemesan_voucher/?vo=4') ?>">
         <span class="glyphicon glyphicon-arrow-left"></span>
       </a> DAFTAR MAHASISWA</b>
     <small></small>
   </h1>
 </section>

 <!-- Main content -->
 <section class="content">
   <?php
    $message = $this->session->flashdata('pesan');
    echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
   <!--NAV-->
   <!-- Nav tabs -->


   <div class="box">

     <h3>DAFTAR MAHASISWA AKTIF

       <span class="pull-right">

         <a href="<?= base_url('C_upxls/hpusData') ?>" class="btn btn-danger">
           <span class="glyphicon glyphicon-trash"></span> Hapus Data</a>
         <a target="_blank" href="<?= base_url('C_upxls/?nprodi=') ?>" class="btn btn-warning">
           <span class="glyphicon glyphicon-cloud-upload"></span> Upload Excel</a>

       </span>

     </h3>

     <div class="tab-content">
       <div class="tab-pane active" id="home">

         <table id="employee-grid" class="table no-margin js-basic-example">
           <thead>
             <tr bgcolor="#d9d9dd">
               <th>No</th>
               <th>Nama</th>
               <th width="20%">NIM</th>
               <!-- <th>Email</th> -->
               <th>PRODI</th>
               <th>VOUCHER</th>
               <th>STATUS</th>
             </tr>
           </thead>
           <tfoot>
             <tr bgcolor="#d9d9dd">
               <th>No</th>
               <th>Nama</th>
               <th width="20%">NIM</th>
               <!-- <th>Email</th> -->
               <th>PRODI</th>
               <th>VOUCHER</th>
               <th>STATUS</th>
             </tr>
           </tfoot>
           <?php

            //$all_newvoucer2=$this->M_vparsel->get_Pesan_voucher_mhs(3,$id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA
            // $all_newvoucer2=$this->M_vparsel->get_mhs_ex_aktif(3,$id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA


            $get_all_id_produk = $all_newvoucer2;
            //echo $_GET['vo'];
            if ($get_all_id_produk->num_rows() > 0) {
              $no = 1;
              $tbdaf = 0;
              $tsdaf = 0;
              $smen = 0;
              foreach ($get_all_id_produk->result() as $gidp) {

                $getnama = $this->M_vparsel->get_email_by_nim($gidp->nim);

                $getnama0 = "($gidp->nama_mhs)";
                $getprodi = "($gidp->prodi)";
                $email_m = "($gidp->email_mhs)";
                $vou_mhs = "$gidp->saldo_vou";
                if ($getnama['code'] == 1) {
                  # code...
                  $getnama0 = $getnama['nama'];
                  $getprodi = $getnama['prodi'];
                  $vou_mhs = "$gidp->saldo_vou";
                }

                $cek_diterima = $this->M_vparsel->cek_ambilVoucher($gidp->nim);     // MAHASISWA 


            ?>


               <tr>
                 <td><?= $no++ ?></td>
                 <td><a><?= $getnama0 ?></a></td>

                 <td><?= $gidp->nim ?></td>
                 <!-- <td><?= $email_m ?></td>                  -->
                 <td><?= $getprodi ?></td>
                 <td align="right"><?= $vou_mhs ?></td>
                 <td align="right" bgcolor="<?= $cek_diterima['warna'] ?>">
                   <?= $cek_diterima['status'] ?>
                 </td>


               </tr>
           <?php  }
            }
            ?>
         </table>

       </div>


       <table class="table no-margin">

         <?php
          ///hitpenermavoc_peg
          ?>

         <tr bgcolor="#d9d9dd">
           <th>Total : <?php //$penvoc['num']
                        ?></th>
         </tr>
         <tr bgcolor="#d9d9dd">
           <th>Sudah Mendaftar (belum menerima voucher) : <?php //$penvoc['terdaftar']
                                                          ?></th>

         </tr>
         <tr bgcolor="#d9d9dd">
           <th>Sudah Menerima Voucher : <?php //$penvoc['menerima']
                                        ?></th>

         </tr>

         <tr bgcolor="#d9d9dd">
           <th>Belum Mendaftar :
             <?php //$penvoc['belumDaftar']
              ?>

           </th>




       </table>

     </div>
   </div>

 </section>

 <script>
   $(document).ready(function() {
     $('#view_mt').click(function(e) {
       var la = $(this).attr('href') + '/<?= $penvoc['num'] ?>';
       // $("#home").load(event.target); //http://localhost/E-Retail/C_upxls/get_pesvoc/40

       // $("#home").load('<?= base_url() ?>/C_upxls/get_pesvoc/'); //
       // e.preventDefault();

       // $('#home').load(la);
       $('#view').html('loading . . .');
       $("#home").load(la, function() {
         alert("Sukses");
         $('#view').html('Sukses');
       });

     });
   });
 </script>
 <script type="text/javascript" language="javascript">
   $(document).ready(function() {
     var dataTable = $('#employee-grid').DataTable({
       "processing": true,
       "serverSide": true,
       "ajax": {
         url: base_url('C_upxls/mhsExelJson'), // json datasource
         type: "post", // method  , by default get
         error: function() { // error handling
           $(".employee-grid-error").html("");
           $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
           $("#employee-grid_processing").css("display", "none");

         }
       }
     });
   });
 </script>
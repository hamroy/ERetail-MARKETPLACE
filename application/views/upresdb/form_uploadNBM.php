 <section class="content-header" style="background: #ecedee;">

   <h1>

     <b>INFO E-Retail</b>

     <small></small>

   </h1>
   <hr />



 </section>



 <!-- Main content -->

 <section class="content">



   <div class="well">

     <h3><b>FORM PENGISIAN ULANG</b></h3>

   </div>



   <?php

    $message = $this->session->flashdata('pesan');

    echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

    ?>

   <?php

    $message0 = $this->session->flashdata('pesan0');

    echo $message0 == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message0 . '</p></div>';

    ?>

   <!--NAV-->















   <div class="modal-body">

     <!--upload-->

     <form class="form-horizontal" action="<?= base_url('Login/update_bio_file/' . $this->session->userdata('id_user')) ?>" method="post" enctype="multipart/form-data">






       <div class="form-group">

         <div class="col-sm-offset-2 col-sm-10">

           <label for="inputName" class="control-label">No. NBM : <?= $nbm ?></label>

         </div>

       </div>
       <?php

        $string = read_file('./upload/nbm/' . $file_nbm);

        ?>

       <div class="form-group">

         <div class="col-sm-offset-2 col-sm-10">

           <label>File NBM :



           </label>
           <?php

            if ($string == TRUE) { ?>

             <p for="inputName">
               <img src="<?= base_url() ?>/upload/nbm/<?= $file_nbm ?>"><br />
               <a href="<?= base_url() ?>/upload/nbm/<?= $file_nbm ?>" target="_blank">Lihat file</a>
             </p>

             <h3 class="text-danger">(*) Untuk keamanan sistem, mohon untuk upload ulang NBM, KTP, dan Paspor/SIM/BPJS/ Kartu Identitas lainnya dalam satu foto. (format: gif, jpg, png, jpeg, bmp)
             </h3><BR />




           <?php } ?>

         </div>

       </div>
       <div class="form-group">

         <div class="col-sm-offset-2 col-sm-10">

           <input type="file" class="form-control br" id="inputName" value="<?= $nbm ?>" name="file" placeholder="NBM">

         </div>

       </div>
       <div class="form-group">

         <div class="col-sm-offset-2 col-sm-10">

           <button type="submit" class="btn btn-primary">Simpan file</button>

         </div>

       </div>


     </form>

     <!--upload-->

   </div>

















   <!--ISI per kategori-->







 </section>
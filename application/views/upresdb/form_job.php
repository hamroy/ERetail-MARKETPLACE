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

     <h3><b>FORM PENGISIAN ULANG NIK/NIM</b></h3>

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

     <form class="form-horizontal" action="<?= base_url('C_uprevdb/rubah_data_profil/' . $id_user) ?>" method="post" enctype="multipart/form-data">

       <div class="box-body">


         <div class="form-group">

           <label for="inputEmail3" class="col-sm-2 control-label" style="color: #000000">NIK/NIM</label>



           <div class="col-sm-10">

             <input type="text" class="form-control" value="<?= $ni ?>" style="border-radius: 6px" name="ni" id="inputEmail3" placeholder="NIK/NIM">


             <small class="text-danger">* NIK/NIM harus angka semua tanpa spasi</small>
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

















   <!--ISI per kategori-->







 </section>
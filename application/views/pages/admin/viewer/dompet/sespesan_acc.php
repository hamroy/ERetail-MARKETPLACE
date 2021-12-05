 <section class="content-header" style="background: #ecedee;">

   <h1>

     <b>DOMPET E-Retail</b>

     <small></small>

   </h1>



 </section>



 <!-- Main content -->

 <section class="content">



   <div class="well">

     <h3><b><?php

            $message = $this->session->flashdata('pesan');
            $tcc = $this->session->userdata('t_acc');

            echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

            ?>

         <?php

          $message0 = $this->session->flashdata('pesan0');

          echo $message0 == '' ? '' : '<div class="alert alert-danger" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message0 . '</p></div>';

          ?></b></h3>

   </div>





   <!--NAV-->














   <?php
    // $tcc=1;
    if ($tcc == '1') { ?>

     <a href="<?= $link_acc ?>" class="btn btn-success pull-right btn-block btn-lg" onclick="return confirm('anda yakin')"><span class="glyphicon glyphicon-ok"></span> TERIMA</a>
   <?php
    }

    ?>

   <a href="<?= $link ?>" class="btn btn-default pull-right btn-block btn-lg">KEMBALI</a>

















   <!--ISI per kategori-->







 </section>
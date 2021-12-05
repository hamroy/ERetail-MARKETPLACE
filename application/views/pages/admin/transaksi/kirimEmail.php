 <section class="content-header" style="background: #ecedee;">

      <h1>

         <b>KIRIM BUKTI PEMBAYARAN</b>

        <small></small>

      </h1>

      

    </section>



    <!-- Main content -->

    <section class="content">

    

    <div class="well">

    	<h3><b><?php

    	$message = $this->session->flashdata('pesan');

        	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

        ?>
    </b></h3>

    <p class="">
      Kirim bukti pembayaran dengan klik tombol KIRIM dibawah ini. 
    </p>

    <div>
      <a href="<?=$link?>" class="btn btn-warning pull-right btn-block btn-lg"> <span class="glyphicon glyphicon-send "></span> KIRIM</a>
    </div>

    </div>

    



    <!--NAV-->

    

     

    

				

				

			

			  

		 <a href="<?=$linkBack?>" class="btn btn-default pull-right btn-block btn-lg">KEMBALI</a>

              

     

     

     

   

		



    

     <!--ISI per kategori-->

     

  

	

    </section>

    


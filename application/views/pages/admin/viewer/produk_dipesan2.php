 <section class="content-header" style="background: #ecedee;">

    

      <h1>

         <b>PRODUK DIPESAN</b>

        <small></small>

      </h1>

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>

        <li class="active">Produk dipesan</li>

      </ol>

    </section>

 

    <!-- Main content -->

    <section class="content">

    <!-- Nav tabs -->
    <?php

    
    $pilM=1;
    if (!empty($_GET['p'])) {
      $pilM=$_GET['p'];
    }


    ?>
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="<?=$pilM==1?'active':''?>"><a href="<?=base_url('User_admin/barang_dipesan?p=1')?>" >DIPESAN</a></li>
      <li role="presentation" class="<?=$pilM==2?'active':''?>"><a href="<?=base_url('User_admin/barang_dipesan?p=2')?>" >PROSES</a></li>
      <li role="presentation" class=""><a href="<?=base_url('User_admin/transaksi_selesai')?>" >SELESAI</a></li>

    </ul>

<hr/>



  <?php

	$message = $this->session->flashdata('pesan');

    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

    ?>

    <!--NAV-->

	
    <?php

    if ($pilM==2) {
      # code...
      $this->load->view('pages/admin/viewer/produkDipesan/PDiproses');
    } else {
      # code...
      $this->load->view('pages/admin/viewer/produkDipesan/PDipesan');
    }
    

    

    ?>

	

    </section>

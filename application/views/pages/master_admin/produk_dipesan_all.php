 <section class="well content-header" style="background: #ecedee;">
      <h1>
         <b>SEMUA PRODUK DIPESAN</b>
        <small></small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>
        <li class="active">Produk dipesan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php
    $num1=$this->Madmin->get_Produk_dipesan_all('TUNAI')->num_rows();
    $num2=$this->Madmin->get_Produk_dipesan_all('VOUCHER')->num_rows();
    
    ?>
    
    
    <div class="btn-group">
    
  <a type="button" href="<?=base_url('Master_admin/produkdipesan_all/1')?>" class="btn btn-default btn-lg" <?=$act1?> >TUNAI <span class="badge"><?=$num1?></span></a>
  <a type="button" href="<?=base_url('Master_admin/produkdipesan_all/2')?>" class="btn btn-default btn-lg"<?=$act2?> >VOUCHER <span class="badge"><?=$num2?></span></a>
  <a type="button" href="<?=base_url('Master_admin/produkdipesan_all/3')?>" class="btn btn-default btn-lg" <?=$act3?>  >TRANSFER</a>
  
</div>
<br />

<br />


    
    <?php
    $message = $this->session->flashdata('pesan');
  	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
	
	<?php
    
    $this->load->view('pages/master_admin/produk/'.$isi);
    ?>

    </section>
    
   
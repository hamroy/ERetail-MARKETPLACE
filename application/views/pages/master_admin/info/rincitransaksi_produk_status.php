 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b><a href="<?=base_url('Master_admin/daf_transaksi')?>">DAFTAR TRANSAKSI</a></b>
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
      <?php
                    ///20180125
                    $hst=0;
                    ///20180125
                 
                  	?>
<section class="content">
    
    <div class="well" align="center">
        <h3><b>Bulan <?=$blnaray[$bln]?> <?=$thn?></b> <br/> [Rp <?=number_format($totbln,0,',','.')?>]</h3>
        
    </div>
    <div class="well">
<form class="form-inline" role="form">
  
  <div class="form-group">
    <label for="exampleInputPassword2">Urutkan I</label>
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/b1/1')?>" <?php if($sort2==1){ echo 'selected';}?> >TRANSAKSI</option>
   <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/a1/2')?>" <?php if($sort2==2){ echo 'selected';}?> >STATUS</option>
 
</select>

  </div>
  <span class="pull-right"><a class="btn btn-default" target="_blank" href="<?=base_url('C_cetak/cetak_trans_admin/'.$bln.'/'.$thn.'/'.$sort.'/'.$sort2)?>">CETAK</a></span>
  
</form>
<hr/>
<form class="form-inline" role="form">
  
  <div class="form-group">
    <label for="exampleInputPassword2">Pilih Status</label>
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
 
   <option value="?st=" <?php if($stget==''){ echo 'selected';}?> >STATUS</option>
   
   <option value="?st=all" <?php if($stget=='all'){ echo 'selected';}?> >SEMUA</option>
   <option value="?st=nologin" <?php if($stget=='nologin'){ echo 'selected';}?> >TIDAK LOGIN</option>
   <?php
  $gt_stjob=$this->M_voucher->get_stjob();
  foreach($gt_stjob->result_array() as $va){
      $sl='';
      if($stget==$va['id_job']){ 
      $sl='selected';
      $stnam=$va['nama_job'];
      }
      ?>
      
        <option value="?st=<?=$va['id_job']?>"  <?=$sl?> ><?=$va['nama_job']?></option>
      
      <?php

      
  }
  ?>
 
</select>

  </div>
  
</form>
<hr/>
<?php
if(!empty($stget) or $stget!=''){
?>
<form class="form-inline" role="form">
  
  <div class="form-group">
    <label for="exampleInputPassword2">Urutkan II</label>
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
  
  <?php
  $var2='b1';
  $var2_1='b2';
  $var2_2='b3';
  if($sort2==2){
      $var2_1='a1';
      $var2_2='a2';
  }
  //b=transaksi,a=subunut
  
  ?>
  <?php
  if($sort2==1){
      
  ?>
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/'.$var2.'/'.$sort2.'?st='.$stget)?>" <?php if($sort==$var2){ echo 'selected';}?> >Terbaru</option>
  <?php
  }
  ?>
  
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/'.$var2_1.'/'.$sort2.'?st='.$stget)?>" <?php if($sort==$var2_1){ echo 'selected';}?> >Jumlah Barang Dijual Terbanyak</option>
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/'.$var2_2.'/'.$sort2.'?st='.$stget)?>" <?php if($sort==$var2_2){ echo 'selected';}?>>Jumlah Rupiah Transaksi Terbanyak</option>
  
</select>
  </div>
  
</form>
<?php
}
?>
</div>

<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
    <!--
    TAMPILKAN
    -->
    <?php
    //echo 'asdas'.$stget;
    if($stget=='all'){
       $this->load->view('pages/master_admin/info/transaksi_perstatus/rincitransaksi_allstatus.php');
    }elseif($stget!='' and is_numeric($stget)){
       $this->load->view('pages/master_admin/info/transaksi_perstatus/rincitransaksi_perstatus.php'); 
    }elseif($stget=='nologin'){
       $this->load->view('pages/master_admin/info/transaksi_perstatus/rincitransaksi_statusnologin.php'); 
    }
    ?>
  
</section>
    
   
   
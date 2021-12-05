 <section class="content-header" style="background: #ecedee;">
    
    
      <br/>
        <h1>
         <b>DAFTAR PEMESAN VOUCHER</b>
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
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#home" role="tab" data-toggle="tab"><b>Baru</b>
  <?php
  $all_newvoucer=$this->Madmin_master->get_pemesan_vo('0')->num_rows();
  if($all_newvoucer > 0){ ?>
  	<span class="badge pull-right" style="background: #5a9afa; margin-left: 10px"><?=$all_newvoucer?></span> 	  	
  	<?php
  }
  ?>
  
  
  </a></li>
  <li ><a href="#home0" role="tab" data-toggle="tab"><b>Pesan Voucher</b>
  
  <?php
  $all_newvoucer2=$this->Madmin_master->get_pemesan_vo_2('0')->num_rows();
  if($all_newvoucer2 > 0){ ?>
  <span class="badge pull-right" style="background: #e2dd1d; color: #000000; margin-left: 10px"><?=$all_newvoucer2?></span> 		  	
  	<?php
  }
  ?>
  
  
  </a></li>
  <li ><a href="#home1" role="tab" data-toggle="tab"><b>Pesan Bonus</b>
  
  <?php
  $all_newvoucer2=$this->Madmin_master->get_pemesan_vo_2_bonus('0')->num_rows();
  if($all_newvoucer2 > 0){ ?>
  <span class="badge pull-right" style="background: #e2dd1d; color: #000000; margin-left: 10px"><?=$all_newvoucer2?></span> 		  	
  	<?php
  }
  ?>
  
  
  </a></li>
  <li ><a href="<?=base_url('Master_admin/list_penerima_voucher/')?>" ><b>Daftar Penerima</b></a></li>
  <li ><a href="<?=base_url('Master_admin/list_penerima_voucher_tolak/')?>"><b>Daftar Ditolak</b></a></li>
  <li role="presentation" class="dropdownilham"> <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="true">Menu Tab <span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-menuilham" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
      </ul>
    </li>
</ul>

<!-- Tab panes -->
<div class="box">
<div class="tab-content">
  <div class="tab-pane active" id="home"><?php $this->load->view('pages/master_admin/dompet/baru') ;?>
  </div>
  <div class="tab-pane " id="home0"><?php $this->load->view('pages/master_admin/dompet/pesan') ;?></div>
  <div class="tab-pane " id="home1"><?php $this->load->view('pages/master_admin/dompet/pesan_bon') ;?></div>
 

</div>
</div>	
	
	
    </section>
    
   
 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar Penjual</li>
      </ol>
      <br/>
        <h1>
         <b>DAFTAR PENJUAL / AKUN</b>
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
  <li class="active"><a href="#home" role="tab" data-toggle="tab"><b>Active</b></a></li>
  <li><a href="#profile" role="tab" data-toggle="tab"><b>Non Active</b></a></li>
</ul>

<!-- Tab panes -->
<div class="box">
<div class="tab-content">
  <div class="tab-pane active" id="home"><?php $this->load->view('pages/master_admin/penjual/active') ;?></div>
  <div class="tab-pane" id="profile"><?php $this->load->view('pages/master_admin/penjual/non') ;?></div>
</div>
</div>	
	
	
    </section>
    
   
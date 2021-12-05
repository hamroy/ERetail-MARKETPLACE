 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b><a href="<?=base_url('Master_admin/list_penjual/')?>">DAFTAR PENJUAL </a> // PENGATURAN VOUCHER</b>
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
<?php
    /////==========================================================================GET
    $g_id=$this->Muser->get_id_pass_nos($id_user);
    /////==========================================================================GET
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <?php
	$message0 = $this->session->flashdata('pesan0');
    	echo $message0 == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message0 . '</p></div>';
    ?>
    <!--NAV-->
    
    
     <!--ISI per kategori-->
     
     <div class="row">
  <div class="col-xs-12 col-md-12"><div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading" align="center"><h3><?=$g_id->row()->nama?></h3></div>
  <div class="panel-body">
    
    <div class="nav-tabs-custom">
      
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_2" data-toggle="tab"><b>PROFIL &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
               <li class=""><a href="#tab_3" data-toggle="tab"><b>VOUCHER &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              <li class=""><a href="#tab_1" data-toggle="tab"><b>ON-OFF VOUCHER &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              <li class=""><a href="<?=base_url('Master_admin/daftar_produk_penjual/'.$id_user)?>"><b>PRODUK &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              </li>
              <li class=""><a href="<?=base_url('Master_admin/daftar_produk_penjual/'.$id_user)?>"><b>TRANSAKSI &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              
              
               <li role="presentation" class="dropdownilham"> <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="true">Menu Tab <span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-menuilham" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
      </ul>
    </li>
            </ul>
           
            <div class="tab-content">
              <div class="tab-pane " id="tab_1">
              
               <?php $this->load->view('pages/master_admin/dompet/on_off.php'); ?>

              </div>
               <div class="tab-pane active" id="tab_2">
              
               <?php $this->load->view('pages/master_admin/info/profol_penjual.php'); ?>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
              
               <?php $this->load->view('pages/master_admin/info/akun/dafvoucher.php'); ?>
                
              </div>
              
            
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
       
  </div>

 
</div>


</div>
  
  
  
</div>
     
     
   
		

    
     <!--ISI per kategori-->
     
  
	
    </section>


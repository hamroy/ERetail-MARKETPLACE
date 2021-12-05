 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b><a href="<?=base_url('C_dompet/sett_voc/'.$id_user)?>#tab_2">PROFIL </a> // VOUCHER</b>
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
              <li class=""><a href="<?=base_url('C_dompet/sett_voc/'.$id_user)?>#tab_2"><b>PROFIL &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
               <li class="active"><a href="<?=base_url('C_dompet/sett_voc/'.$id_user)?>#tab_3" ><b>VOUCHER || RINCI&nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              <li class=""><a href="<?=base_url('C_dompet/sett_voc/'.$id_user)?>#tab_1"><b>ON-OFF VOUCHER &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              <li class=""><a href="<?=base_url('Master_admin/daftar_produk_penjual/'.$id_user)?>"><b>PRODUK &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              <li class=""><a href="<?=base_url('Master_admin/daftar_produk_penjual/'.$id_user)?>"><b>TRANSAKSI &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              
              
               <li role="presentation" class="dropdownilham"> <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="true"><b>MENU TAB <span class="caret"></span></b></a>
      <ul class="dropdown-menu dropdown-menuilham" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
      </ul>
    </li>
            </ul>
           
            <div class="tab-content">
              <div class="tab-pane active">
              
              <?php
              $this->load->view('madmin/mvoc/dafvoucherrinci');
              ?>

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


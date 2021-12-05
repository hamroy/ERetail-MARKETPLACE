 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b>OTORISASI PENDAFTARAN</b>
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
     <!---->
        <?php
       // $get_all_user_new=$this->Madmin_master->get_all_usernew();
        $get_all_user_new=$this->Madmin_master->get_all_newsbm();
     //$get_all_id_produk=$this->Madmin_master->get_all_produk_new();
     	$get_all_id_produk=$this->Madmin_master->get_all_produk_new();
        $akun=$get_all_user_new->num_rows();
        $prod=$get_all_id_produk->num_rows();
       ?>
      
        
        <!---->
    <section class="content">
      <div class="nav-tabs-custom">
      
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab"><b>Pendaftar Baru &nbsp;&nbsp;&nbsp;</b>  
              <?php if($akun > 0){ ?>
         <span class="badge pull-right" style="background: #5a9afa"><?=$akun?></span> 	
			  <?php
			  }
              ?>
              	
              </a></li>
             
               <li><a href="#tab_3" data-toggle="tab"><b>Ditolak</b> </a></li>
               <li role="presentation" class="dropdownilham"> <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="true">Menu Tab <span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-menuilham" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
      </ul>
    </li>
            </ul>
            <?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
               <?php $this->load->view('pages/sbm/akun'); ?>

              </div>
              <!-- /.tab-pane -->
            
               <div class="tab-pane" id="tab_3">
                <?php $this->load->view('pages/sbm/akun_tolak'); ?>
              </div>
           
            
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    <!--NAV-->
	
	
	
		</div>
    </section>
    
   
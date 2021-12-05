 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b>VERIFIKASI AKUN dan PRODUK</b>
        <small></small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-cube"></i> Akun</a></li>
        <li class="active">VERIFIKASI</li>
      </ol>
    </section>

    <!-- Main content -->
     <!---->
        <?php
        $get_all_user_new=$this->Madmin_master->get_all_usernew();
         $get_all_id_produk=$this->Madmin_master->get_all_produk_new();
        $akun=$get_all_user_new->num_rows();
        $prod=$get_all_id_produk->num_rows();
       ?>
       <?php
       $nav=1;
       if(isset($_GET['nav'])){
           $nav=$_GET['nav'];
       }
       $anav=array(
       '0'=>'active',
       '1'=>''
       );
       if($nav==2){
           $anav[0]='';
           $anav[1]='active';
       }
       
       ?>
      
        
        <!---->
    <section class="content">
      <div class="nav-tabs-custom">
      
      
            <ul class="nav nav-tabs">
              <li class="<?=$anav[0]?>"><a href="#tab_1" data-toggle="tab"><b>Akun Penjual Baru &nbsp;&nbsp;&nbsp;</b>  
              <?php if($akun > 0){ ?>
         <span class="badge pull-right" style="background: #5a9afa"><?=$akun?></span> 	
			  <?php
			  }
              ?>
              	
              </a></li>
              <li class="<?=$anav[1]?>"><a href="#tab_2" data-toggle="tab"><b>Produk Baru &nbsp;&nbsp;&nbsp;</b>
              <?php if($prod > 0){ ?>
         <span class="badge pull-right" style="background: #5a9afa"><?=$prod?></span> 	
			  <?php
			  }
              ?>
              </a></li>
               <li><a href="<?=base_url('Master_admin/list_penjual_tolak/')?>"><b>Akun Ditolak</b> </a></li>
               <li><a href="<?=base_url('Master_admin/daftar_produk_tolak/')?>"><b>Produk Ditolak</b> </a></li>
               <li><a href="<?=base_url('Master_admin/daftar_produk_blok/')?>"><b>Produk Diblock</b> </a></li>
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
              <div class="tab-pane <?=$anav[0]?>" id="tab_1">
               <?php $this->load->view('pages/master_admin/verifiaksi/akun'); ?>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?=$anav[1]?>" id="tab_2">
                <?php $this->load->view('pages/master_admin/verifiaksi/produk'); ?>
              </div>
              
            
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    <!--NAV-->
	
	
	
    </section>
    
   
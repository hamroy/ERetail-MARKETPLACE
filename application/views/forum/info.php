 <section class="content-header" style="background: #ecedee;">
      <h1>
         <a href="<?=base_url('Welcome/allkategori')?>"><?=$title2?></a> || <b>INFO STATISTIK</b>
        <small></small>
      </h1>
     
    </section>

    <!-- Main content -->
     <!---->
       
      
        
        <!---->
    <section class="content">
      <div class="nav-tabs-custom">
      <?php
      $ac1='';
      $ac2='';
      $ac3='';
       switch($tab){
            case '1':
                   $viewtab='forum/statistik/terlaris';
                   $ac1='active';
                   break;
                   case '2':
                   
                  /* if($bln==0){
                   $viewtab='forum/statistik/daftar_transaksi';     
                   }else{
                   $viewtab='forum/statistik/daftar_transaksi_bln';     
                   } //
                   $ac2='active';
                   */
                   break;
                   case '3':
                   $ac3='active';
                   $viewtab='forum/statistik/daftar_penerima_voucher';
                   break;
                   
                   
           
           }
      
      ?>
            <ul class="nav nav-tabs">
              <li class="<?=$ac1?>">
              <a href="<?=base_url('C_kom/info/1')?>"><b>Top Charts (Terlaris)</b>  
              </a>
              </li>
              
              <li class="<?=$ac3?>"><a href="<?=base_url('C_kom/info/3')?>"><b>Penerima Voucher</b>
              
              </a></li>
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
              
              <!-- /.tab-pane -->
            
            <div class="tab-pane active" id="tab_1">
               
               <?php $this->load->view($viewtab);?>

            </div>
             
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>

    <!--NAV-->
	
	
	
    </section>
    
   
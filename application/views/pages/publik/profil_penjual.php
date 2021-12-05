 <section class="content-header">
       <?php $guser=$this->Muser->get_user_by_id($id_user)->row(); ?>
      
      <h1>
         <b><a href="<?=base_url('Welcome/produk/'.$id_produk)?>"><i class="fa  fa-arrow-left"></i> KEMBALI</a> || PROFILE ' <?=$guser->nama?> <?=$guser->img?>'</b>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
         
            <?php
          $string = read_file('./upload/profil/'.$guser->img);
		if ($string == FALSE){
			if($guser->jenis_kelamin=='L'){
				$fotorincibarang = $this->M_setapp->static_bm().'/upload/profil/profil.png'; 
			}else{
				$fotorincibarang = $this->M_setapp->static_bm().'/upload/profil/profil_m.png'; 
			}
		}else{
			$fotorincibarang = $this->M_setapp->static_bm().'/upload/profil/'.$guser->img; 
			 } ?>
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?=$fotorincibarang?>" style="height: 100px; width: 100px" alt="User profile picture">
<p align="center"> </p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
          <div class="box box-default">
         
            <div class="box-header with-border">
              <h3 class="box-title">Biodata</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa  fa-user"></i> Nama Penjual</strong>

             <p class="text-muted"><?=$guser->nama?></p>

              <hr>
               <strong><i class="fa  fa-circle"></i> NBM</strong>

             <p class="text-muted"><?=$guser->nbm?></p>

              <hr>
              
               <strong><i class="fa fa-envelope"></i> Email</strong>

             <p class="text-muted"><?=$guser->username?></p>

              <hr>
              
              <strong><i class="fa  fa-phone"></i> No. Kontak</strong>

             <p class="text-muted"><?=$guser->no_kontak?></p>

             

              <hr>
               <strong><i class="fa  fa-credit-card"></i> No. REK / BANK</strong>

             <p class="text-muted"><?=$guser->rek?>/<?=$guser->bank?></p>

              <hr>
              

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?=$guser->alamat?></p>

              <hr>


              <strong><i class="fa fa-file-text-o margin-r-5"></i> Ranting</strong>

              <p>Ranting :<?=$guser->ranting?> <br/> Cabang :<?=$guser->cabang?> <br/> Daerah :<?=$guser->daerah?></p>
              
                <strong><i class="fa fa-map-marker margin-r-5"></i> Status</strong>

              <p class="text-muted">
              	<?php
              	if($guser->status==1){
					echo ' AKTIF';
				}else{
					echo ' NON AKTIF';
				}
              	?>
              	
              </p>

              <hr>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
        
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
             
              <li class="active"><a href="#settings" data-toggle="tab">Semua Produk </a></li>
            <!--  <li ><a href="#activity"  data-toggle="tab">aktivitas</a></li>-->
              <li ><a href="#pass"  data-toggle="tab"> Produk Terlaris</a></li>
            </ul>
            <div class="tab-content">
             
              <!-- /.tab-pane -->
            
              <!-- /.tab-pane -->

              <div class="active tab-pane" id="settings">
               
               <?php
               if($id_k==0){
			   	$this->load->view('pages/publik/profil/semua_produk_awal');
			   }else{
			   $this->load->view('pages/publik/profil/semua_produk');	
			   }
               
               ?>
				
              </div>
              <!-- /.tab-pane -->
            
			
			  <div class="tab-pane" id="pass">
                <!-- Post ,..pengaturan user -->
               
                  <!-- /.user-block -->
               
                </div>
               
                <!-- /.post -->
                  
                <!-- /.post -->
                
              </div>
              <!-- /.tab-pane -->
              
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      <!-- /.row -->

    </section>	
     <!-- Modal POTO -->

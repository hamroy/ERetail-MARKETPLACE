
 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b><a href="#"> </a> PENGATURAN VOUCHER</b>
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
    <?php
    /////==========================================================================GET
    //$g_id=$this->Muser->get_id_pass_nos($id_user);
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
  <div class="panel-heading" align="center"><h3>BERLAKU UNTUK SEMUA AKUN</h3></div>
  <div class="panel-body">
    
    <div class="nav-tabs-custom">
      
            <ul class="nav nav-tabs">
              <li><a href="#tab_1" data-toggle="tab"><b>ON-OFF VOUCHER &nbsp;&nbsp;&nbsp;</b>  
              
              	
              </a></li>
              <li class="active">
              <a href="#tab_3" data-toggle="tab"><b> RESET VOUCHER</b>
              </a>
              </li>
            
              
               <li role="presentation" class="dropdownilham"> <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="true">Menu Tab <span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-menuilham" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
      </ul>
    </li>
            </ul>
           
            <div class="tab-content">
              <div class="tab-pane " id="tab_1">
               <?php
                $this->load->view('pages/master_admin/dompet/on_off_all');
                ?>

              </div>
              <!-- /.tab-pane -->
              
               
               <!--20180418-->
               <div class="tab-pane active" id="tab_3">
                <form class="form-horizontal" action="<?=base_url('C_setvoc/')?>" method="post">

                <div class="row">

        <div class="col-xs-12">
        <h3>PILIH JENIS VOUCHER YANG AKAN DIRESET</h3>
        <hr/>

        <label class="form">Pilih Proses </label>
        <br/>
        
        
        <br/>
        
     <label class="form">Pilih Jenis Vocher </label>
        <br/>
        
        <select name="jvoc" class="form-control sta selectpicker">
         <option value="0" >Voucher Makan</option>
         <option value="1" >Voucher Parsel Lebaran</option>
         <option value="2" >Voucher Ramadhan & THR</option>       
         <option value="3" >Voucher Mahasiswa</option>
         <option value="4" >Voucher Gaji 13</option>
        </select>
        <small class="text-info">- Wajib dipilih</small>
        <br/>
        <br/>
        
        <label class="form">Pilih Status yang tidak di reset</label>

         <br/>

        <select name="job[]" class="form-control sta selectpicker" multiple>
        <?php

        $gjob=$this->M_setapp->get_tbl_st_job();
        $disabled='';
        foreach($gjob->result() as $jb){
                
                if($jb->id_job==0){
                    $disabled='disabled';
                }else{
                    $disabled='';
                }
            ?>

             <option value="<?=$jb->id_job?>" <?=$disabled?>><?=$jb->nama_job?></option>

            <?php

        }

        ?>

        

        </select>

        <small class="text-info">- Pilih status yang tidak di Reset </small>        
        <small class="text-info">- Boleh tidak memilih </small>        
    
        </div>

        <!-- /.col -->

       

        <!-- /.col -->

      </div> 


                  

                 <hr />

                  <div class="form-group">

                    <div class="col-sm-10">

                      <button type="submit" class="btn btn-primary">Simpan</button>

                    </div>

                  </div>

                </form>
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


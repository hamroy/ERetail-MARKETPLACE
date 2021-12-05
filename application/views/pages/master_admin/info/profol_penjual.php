    <!-- Main content -->

    <section class="content">



      <div class="row">

        <div class="col-md-3">



          <!-- Profile Image -->

          <?php
          /////==========================================================================GET
           	 $g_id=$this->Muser->get_id_pass_nos($id_user);
            /////==========================================================================GET

          $string = read_file('./upload/profil/'.$g_id->row()->img);

		if ($string == FALSE){

			if($sex=='L'){

				$foto = $this->M_setapp->static_bm().'/upload/profil/profil.png'; 

			}else{

				$foto = $this->M_setapp->static_bm().'/upload/profil/profil_m.png'; 

			}

			

		}else{

			$foto = $this->M_setapp->static_bm().'/upload/profil/'.$g_id->row()->img; 

		} 
        ?>

          <div class="box box-primary">

            <div class="box-body box-profile">

              <img class="profile-user-img img-responsive img-circle" src="<?=$foto?>" style="height: 100px; width: 100px" alt="User profile picture">



              <h3 class="profile-username text-center"><?=$g_id->row()->nama?></h3>



              <p class="text-muted text-center"><?=$g_id->row()->username?></p>
              <p class="text-muted text-center">Pass : <?=$g_id->row()->password?></p>



             



            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->



          <!-- About Me Box -->

          

          <!-- /.box -->

        </div>

        <!-- /.col -->

        <div class="col-md-9">

          <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">
            
            </ul>

            <div class="tab-content">


              <!-- /.tab-pane -->



              <div class="active tab-pane" id="settings">

                <form class="form-horizontal" action="<?=base_url('C_ramadhan/update_bio_o_admin/'.$id_user)?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Nama</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" value="<?=$g_id->row()->nama?>" id="inputName" name="nama" placeholder="Name" >

                      

                    </div>

                  </div>
                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Username/Email</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" value="<?=$g_id->row()->username?>" id="inputName" name="user" placeholder="Name" >

                      

                    </div>

                  </div>
                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Password</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" value="<?=$g_id->row()->password?>" id="inputName" name="pass" placeholder="Name" >

                      

                    </div>

                  </div>
                 

                  <hr/>

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">No. Rek</label>



                    <div class="row">

      	 <div class="col-xs-4">

      	 <input type="text" class="form-control br" name="rek" value="<?=$g_id->row()->rek?>" placeholder="No. Rek" required>

      	 </div>

      	 <label for="inputName" class="col-sm-2 control-label">Bank</label>

      	  <div class="col-xs-3">

      	 <input type="text" class="form-control br" name="bank" value="<?=$g_id->row()->bank?>" placeholder="Bank" required>

      	 </div>

      </div>

                  </div>

					<div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">No. Kontak</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" id="inputName" value="<?=$g_id->row()->no_kontak?>" name="no" placeholder="No. Kontak">

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">NBM</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" id="inputName" value="<?=$g_id->row()->nbm?>" name="nbm" placeholder="NBM">

                    </div>

                  </div>

                


                  <div class="form-group">

                    <label for="inputExperience " class="col-sm-2 control-label">Alamat</label>



                    <div class="col-sm-10">

                      <textarea class="form-control br" id="inputExperience" name="alamat" placeholder="Alamat"> <?=$g_id->row()->alamat?></textarea>

                    </div>

                  </div>
                  <hr/>
                  
                   <div class="form-group">

                    <label for="inputExperience " class="col-sm-2 control-label">Status</label>



                    <div class="col-sm-10">

        <select name="job" class="sta form-control">
        <option hidden value="0">Wajib diisi </option>
        <?php
        
        $gjob=$this->M_setapp->get_tbl_st_job();
        $job=$g_id->row()->job;
        foreach($gjob->result() as $jb){
                if($jb->id_job==$job){
                    $selj= 'selected';
                }else{
                    $selj='';
                }
                
                
            ?>

             <option value="<?=$jb->id_job?>" <?=$selj?>><?=$jb->nama_job?></option>

            <?php

        }
      

        ?>

        

        </select>


                    </div>

                  </div>
                  <div class="form-group">

                    <label for="inputExperience" class="col-sm-2 control-label">NIK/NIS/NIM/Kode Subunit Kerja</label>



                    <div class="col-sm-10">
                    

                    <input type="text" class="form-control br" id="inputName" value="<?=$g_id->row()->ni?>" name="ni" placeholder="NIK/NIS/NIM/Kode Subunit Kerja">


                    </div>

                  </div>
            <div class="form-group stlab" style="display: <?=$job!=3?'none':''?>">

    <label for="inputExperience " class="col-sm-2 control-label">Prodi  </label>



                    <div class="col-sm-10">

            <select class="form-control " name="prodi">
           
           <option value="0" hidden>-- Pilih Prodi -- </option>
        <?php

        $gjob=$this->M_setapp->get_tbl_fak_prodi();
        $kode_prodi=$g_id->row()->kode_prodi;
        foreach($gjob->result() as $jb){
            if($jb->kode_nim==$kode_prodi){
                    $selj= 'selected';
                }else{
                    $selj='';
                }
            if($selj==NULL){
                 if($jb->kode_prodi==$kode_prodi){
                    $selj= 'selected';
                }else{
                    $selj='';
                }
                }
               
            ?>

             <option value="<?=$jb->kode_nim?>" <?=$selj?>><?=$jb->nama_prodi?></option>

            <?php

        }

        ?>

        

        </select>

                    </div>

        </div>
                  <hr/><hr/>

                  <div class="form-group">

                    <div class="col-sm-offset-2 col-sm-10">

                      <button type="submit" class="btn btn-primary btn-block">Simpan</button>

                    </div>

                  </div>

                </form>


<hr/><hr/><hr/>
				

				

				

              </div>

             

              

            </div>

            <!-- /.tab-content -->

          </div>

          <!-- /.nav-tabs-custom -->

        </div>

        <!-- /.col -->

      </div>

      <!-- /.row -->



    </section>	

    

<script src="<?=$this->M_setapp->static_bm()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
    $(document).ready(function(){
    $('.sta').change(function(){
        if($('.sta option:selected').text() == "Mahasisiwa UMY"){ //
        $('.stlab').show();
        document.getElementById("stlab").innerHTML = "NIM";
        }
        else{
        $('.stlab').hide();
        document.getElementById("stlab").innerHTML = "NIK/NIM";
        }
    });
});
</script>
 <section class="content-header">

      <h1>

         <b>PROFILE</b>

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>

        

        <li class="active">Profile</li>

      </ol>

    </section>



    <!-- Main content -->

    <section class="content">



      <div class="row">

        <div class="col-md-3">



          <!-- Profile Image -->

          <?php

          $string = read_file('./upload/profil/'.$img);

		if ($string == FALSE){

			if($sex=='L'){

				$foto = $this->M_setapp->static_bm().'/upload/profil/profil.png'; 

			}else{

				$foto = $this->M_setapp->static_bm().'/upload/profil/profil_m.png'; 

			}

			

		}else{

			$foto = $this->M_setapp->static_bm().'/upload/profil/'.$img; 

			 } ?>

          <div class="box box-primary">

            <div class="box-body box-profile">

              <img class="profile-user-img img-responsive img-circle" src="<?=$foto?>" style="height: 100px; width: 100px" alt="User profile picture">

<p align="center"> <a data-toggle="modal" data-target="#myModalgambar">

                      <i class="fa fa-pencil"></i>  edit

                      </a></p>

              <h3 class="profile-username text-center"><?=$nama?></h3>



              <p class="text-muted text-center"><?=$username?></p>



             



            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->



          <!-- About Me Box -->

          

          <div class="box box-primary">

         

            <div class="box-header with-border">

              <h3 class="box-title">Tentang Saya</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

              <strong><i class="fa  fa-phone"></i> No. Kontak</strong>



             <p class="text-muted"><?=$kontak?></p>



              <hr>

               <strong><i class="fa fa-envelope"></i>Email</strong>



             <p class="text-muted"><?=$username?></p>



              <hr>



              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>



              <p class="text-muted"><?=$alamat?></p>



              <hr>





              <strong><i class="fa fa-file-text-o margin-r-5"></i> Ranting</strong>



              <p>Ranting :<?=$ranting?> <br/> Cabang :<?=$cabang?> <br/> Daerah :<?=$daerah?></p>

            </div>

            <!-- /.box-body -->

          </div>

          <!-- /.box -->

        </div>

        <!-- /.col -->

        <div class="col-md-9">

         <?php

	$message = $this->session->flashdata('pesan');

    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

    ?>

          <div class="nav-tabs-custom">

            <ul class="nav nav-tabs">

              

             

              <li class="active"><a href="#settings" data-toggle="tab">Akun</a></li>

            <!--  <li ><a href="#activity"  data-toggle="tab">aktivitas</a></li>-->
            <?php 
            echo  ($job==3) ? '<li ><a href="#pstatus"  data-toggle="tab">Pindah Status</a></li>' : '' ;
            ?>

              <li ><a href="#pass"  data-toggle="tab">Ganti Password</a></li>


              <?php

               if($this->session->userdata('wewenang')=='admin'){

                   

               ?>

              <li ><a href="#info"  data-toggle="tab">Pengumuman</a></li>

              

              <?php

              

              } 

              ?>

            </ul>

            <div class="tab-content">

             

              <!-- /.tab-pane -->

            

              <!-- /.tab-pane -->



              <div class="active tab-pane" id="settings">

                <form class="form-horizontal" action="<?=base_url('Login/update_bio/'.$this->session->userdata('id_user'))?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Nama</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" value="<?=$nama?>" id="inputName" name="nama" placeholder="Name" >

                      

                    </div>

                  </div>

                  

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">No. Rek</label>



                    <div class="row">

      	 <div class="col-xs-4">

      	 <input type="text" class="form-control br" name="rek" value="<?=$rek?>" placeholder="No. Rek" required>

      	 </div>

      	 <label for="inputName" class="col-sm-2 control-label">Bank</label>

      	  <div class="col-xs-3">

      	 <input type="text" class="form-control br" name="bank" value="<?=$bank?>" placeholder="Bank" required>

      	 </div>

      </div>

                  </div>

					<div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">No. Kontak</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" id="inputName" value="<?=$kontak?>" name="no" placeholder="No. Kontak">

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">NBM</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" id="inputName" value="<?=$nbm?>" name="nbm" placeholder="NBM">

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Ranting Muhammaditah</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" id="inputName" value="<?=$ranting?>" name="ranting" placeholder="Ranting Muhammaditah">

                    </div>

                  </div>

				   <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Cabang</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" id="inputName" value="<?=$cabang?>" name="cabang" placeholder="Cabang">

                    </div>

                  </div>

                   <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Daerah</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" id="inputName" value="<?=$daerah?>" name="daerah" placeholder="Daerah">

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="inputExperience " class="col-sm-2 control-label">Jenis Kelamin </label>



        <div class="col-sm-10">

          <div class="radio dckdesain">

          

            <label>

              <input type="radio" name="jenis" value="L" <?php if($sex=='L'){ echo 'checked'; }  ?> > Laki-laki

            </label>

            &nbsp;

             <label>

              <input type="radio"  name="jenis" value="P" <?php if($sex=='P'){ echo 'checked'; }  ?>> Perempuan

            </label>

          </div>

        <!-- /.col -->

       

        <!-- /.col -->

      </div>
      
                  </div>

                  <div class="form-group">

                    <label for="inputExperience " class="col-sm-2 control-label">Alamat</label>



                    <div class="col-sm-10">

                      <textarea class="form-control br" id="inputExperience" name="alamat" placeholder="Alamat"> <?=$alamat?></textarea>

                    </div>

                  </div>
                  <hr/>
                  
                   <div class="form-group">

                    <label for="inputExperience " class="col-sm-2 control-label">Status</label>



                    <div class="col-sm-10">
        <?php
        $dsjb='';
        if($job==3){
        $dsjb='disabled';
        ?>
        <input type="hidden" value="<?=$job?>" name="job" />

        <?php
        }
        ?>
         


        <select <?=$dsjb?> name="job"   class="sta form-control">
        <option hidden value="0">Wajib diisi </option>
        <?php
        
        $gjob=$this->M_setapp->get_tbl_st_job();

        foreach($gjob->result() as $jb){
                
                if($jb->id_job==$job){
                    $selj= 'selected';
                }else{
                    $selj='';
                }
                
                if($jb->id_job > 3 and $job<3){
                    break;
                }
                if($jb->id_job < 3 and $job>3){
                    continue;
                }

                
                if($jb->id_job!=3 and $job==3){
                    continue;
                }
               
                if($jb->id_job==3 and $job!=3){
                    if($job!=null and $job!=3){
                        continue;
                    }
                }
                
                
                
                
            ?>
             <option <?=$selj?>  value="<?=$jb->id_job?>"><?=$jb->nama_job?></option>

            <?php

        }

        ?>

        

        </select>
       


                    </div>

                  </div>
                  <div class="form-group">

                    <label for="inputExperience" class="col-sm-2 control-label">NIK/NIS/NIM/Kode Subunit Kerja</label>



                    <div class="col-sm-10">



                    <input type="text" disabled class="form-control br" id="inputName" value="<?=$ni?>" name="ni" placeholder="NIK/NIS/NIM/Kode Subunit Kerja">

                    <input type="hidden" value="<?=$ni?>" name="ni" />



                    </div>

                  </div>
<div class="form-group stlab" style="display: <?=$job!=3?'none':''?>">

    <label for="inputExperience " class="col-sm-2 control-label">Prodi  </label>



                    <div class="col-sm-10">



            <select class="form-control " disabled name="prodi">
           
           <option value="0" hidden>-- Pilih Prodi -- </option>
        <?php

        $gjob=$this->M_setapp->get_tbl_fak_prodi();

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

        <input type="hidden" value="<?=$kode_prodi?>" name="prodi" />

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
                   
                    <p for="inputName" >
                      <label >File NBM :  </label><br/>
                      <img src="<?=base_url()?>/upload/nbm/<?=$file_nbm?>"><br/>
                    </p>
				

				

              </div>

              <!-- /.tab-pane -->

               <div class="tab-pane" id="info">

               <?php

               if($this->session->userdata('wewenang')=='admin'){

                   

               ?>

                <form method="post" action="<?=base_url('controllernya_prayudi/simpan_set_info')?>">

                <textarea class="form-control" rows="3" name="informasi">

                  <?php

                  

                  $info = $this->Modelnya_prayudi->tampilkan_info();

                  echo $info->row()->isi_info;

                  ?>

                </textarea>

                <input type="submit" class="btn btn-primary" value="SET INFO">

                </form>

                <?php

                }

                ?>

              </div>

			

			  <div class="tab-pane" id="pass">

                <!-- Post ,..pengaturan user -->

               <div class="post clearfix">

                  <div class="user-block">

                    <div class="active tab-pane" id="pass">

                <form class="form-horizontal" action="<?=base_url('Login/update_pass/'.$this->session->userdata('id_user'))?>" method="post">

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Username</label>



                    <div class="col-sm-10">

                      <input type="text" readonly class="form-control br" value="<?=$username?>" id="inputName" name="username" placeholder="Name">

                      

                    </div>

                  </div>

                  <div class="form-group">

                    <label for="inputName" class="col-sm-2 control-label">Password</label>



                    <div class="col-sm-10">

                      <input type="text" class="form-control br" value="<?=$k?>" id="inputName" name="password" placeholder="Name">

                      

                    </div>

                  </div>

                  

                 

                  <div class="form-group">

                    <div class="col-sm-offset-2 col-sm-10">

                      <button type="submit" class="btn btn-primary">Simpan</button>

                    </div>

                  </div>

                </form>

              </div>

                </div>
                  <!-- /.user-block -->
                </div>
                <!-- /.post -->

              </div>



              <!-- /.tab-pane -->

              <!-- PINDAH STATUS -->

               <div class="tab-pane" id="pstatus">

                <!-- Post ,..pengaturan user -->

               <div class="post clearfix">

                  <div class="user-block">

                <div class="active tab-pane" id="pass">

                <div class="well">

                  <blockquote>
                    <p>Untuk pindah status Mahasiswa menjadi status Alumni <u>klik tombol PINDAH</u>  dibawah ini.</p>
                    
                  </blockquote>


               </div>

                <a href="<?=base_url('C_mahasiswa/pindahstatus/4/'.$this->session->userdata('id_user'))?>" class="btn btn-success btn-block" onclick="return confirm('Anda yakin.')" >PINDAH</a>


              </div>

                </div>
                  <!-- /.user-block -->
                </div>
                <!-- /.post -->

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

     <!-- Modal POTO -->

<div class="modal fade" id="myModalgambar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel">Edit Foto Profil</h4>

      </div>

      <div class="modal-body">

          <form class="form-horizontal" action="<?=base_url('User_admin/proses_simpan_editfoto_data/')?>" method="post" enctype="multipart/form-data">

          <img class="profile-user-img img-responsive img-circle" src="<?=$foto?>"  style="height: 100px; width: 100px" alt="User profile picture">

              <div class="box-body">

			

             <div class="form-group">

             

                  <label for="inputPassword3" class="col-sm-2 control-label">Gambar</label>



                  <div class="col-sm-5">

                    <input type="file" class="form-control" id="inputPassword3" style="border-radius: 6px" name="file" placeholder="Password">

                  </div>

                </div>

              </div>

              <!-- /.box-body -->

              <div class="box-footer">

                

                <button type="submit" class="btn btn-info pull-right btn-block btn-lg">Simpan</button>

              </div>

              <!-- /.box-footer -->

            </form>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>

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
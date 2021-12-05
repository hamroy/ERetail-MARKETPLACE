 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b>Pengaturan Pemateri</b>
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
     
     <!--ISI per kategori-->
     <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      <i class="fa fa-plus"></i>  Input Pemateri
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="box-body">
            
              <form class="form-horizontal" id="form1" action="<?=base_url('C_sbm/simpan_pemateri/')?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Pemateri</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" style="border-radius: 6px" name="nama" id="inputEmail3" placeholder="Nama" required>
                     <small class="text-danger">(*) Nama wajib diisi.</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Foto</label>

                  <div class="col-sm-5">
                    <input type="file" class="form-control" id="inputPassword3" style="border-radius: 6px" name="file" placeholder="Password">
                     <small class="text-danger">(*) Foto wajib diisi (format: gif, jpg, png, jpeg, bmp)</small>
                  </div>
                </div>
               
						
						
				
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi</label>

                  <div class="col-sm-5">
                    <textarea rows="10"  class="form-control"style="border-radius: 6px" name="deskripsi"></textarea>
                  </div>
                </div>
             
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right btn-block btn-lg">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
              <!-- /.table-responsive -->
            </div>
                  </div>
                </div>
              
              </div>

    
     <!--ISI per kategori-->
     
  
	
    </section>
    

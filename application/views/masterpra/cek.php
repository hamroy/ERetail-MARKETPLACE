<!DOCTYPE html>
<html>
<head>
  <title>CEK OLEH MASTERPRA</title>
</head>
<body>
  <?=$this->session->userdata('login')?>
   <form class="form-horizontal" id="form1" action="<?=base_url('Controllernya_prayudi/coba_upload')?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                
        
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Gambar</label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="inputPassword3" style="border-radius: 6px" name="file" placeholder="Password">
                     <small class="text-danger">(*) Gambar wajib diisi (format: gif, jpg, png, jpeg, bmp, pdf)</small>
                  </div>
                </div>
               
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-success pull-right btn-block btn-lg">Simpan</button>
            
              </div>
              <!-- /.box-footer -->
              
              
              
            </form>
</body>
</html>
 <section class="content-header" style="background: #ecedee;">
      
      <h3 class="well box-title"><a href="<?=base_url('User_admin/beranda')?>">Daftar Produk</a> // Tambah Produk </h3>
      
    </section>

    <!-- Main content -->
    <section class="content">
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <?php
	$message0 = $this->session->flashdata('pesan0');
    	echo $message0 == '' ? '' : '<div class="alert alert-danger" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message0 . '</p></div>';
    ?>
    <!--NAV-->
    
    <div id="collapseOne" class="panel-collapse collapse in" style="background-color: #ffffff; margin-top: 0px">
  <h3 class="well box-title">Tambah Produk</h3>  
    
    
                      <div class="box-body">
            
              <form class="form-horizontal" id="form1" action="<?=base_url('User_admin/proses_simpan_pluss_data/'.$id_k)?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">kategori</label>

                  <div class="col-sm-10">
                  
                <select name="id_k" class="form-control select2"  onchange="loadPage(this.form.elements[0])" style="border-radius: 6px ; width: 100%;">
                  <option selected="selected" disabled>--pilih kategori--</option>
                 <?php
                 $gtog=$this->Muser->get_kategori();
                 foreach($gtog->result() as $gt){
                 	if($id_k==$gt->id){
						$s='selected';
					}else{
						$s='';
					}
                    if($gt->id==20 and $status_job!='8' ){
                        
                        if($id_k==20){
                            redirect('User_admin/beranda');
                        }
                        continue;
                        
                        
                    }
                 	 ?>
				 	<option value="<?=base_url('C_user_admin/addproduk/')?><?=$gt->id?>"  <?=$s?>> <?=$gt->kategori?></option>
				 <?php }                
                  ?>
                </select>
                
                  </div>
                  
                </div>
                
                <?php
                
                if($id_k!=NULL)
                {
                    
                ?>
                
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" style="border-radius: 6px" name="nama" id="inputEmail3" placeholder="Nama produk" required>
                     <small class="text-danger">(*) Nama wajib diisi.</small>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Gambar</label>

                  <div class="col-sm-10">
                    <input type="file" class="form-control" id="inputPassword3" style="border-radius: 6px" name="file" placeholder="Password">
                     <small class="text-danger">(*) Gambar wajib diisi (format: gif, jpg, png, jpeg)</small>
                  </div>
                </div>
                <?php
                if($id_k!=4){
                	 ?>
                 <div class="form-group bj">
                  <label for="inputPassword3" class="col-sm-2 control-label">Stok</label>

                  <div class="col-sm-5">
                    <input type="number" min="0" class="form-control" id="inputPassword3" style="border-radius: 6px" name="stok" placeholder="Stok" required>
                     <small class="text-danger">(*) Stok wajib di isi.</small>
                  </div>
                  <div class="col-sm-5">
                    <input placeholder="satuan" name="satuan" class="form-control" style="border-radius: 6px" required>
                     <small class="text-danger">(*) Satuan wajib di isi.</small>
                  </div>
                </div>
                <div class="form-group bj">
                  <label for="inputPassword3" class="col-sm-2 control-label">Harga Satuan Normal</label>

                  <div class="col-sm-10">
                    <input type="number" min="0" class="form-control" id="inputPassword3" style="border-radius: 6px" name="harga" placeholder="Harga Normal" required>
                     <small class="text-danger">(*) Harga Satuan wajib di isi.</small>
                  </div>
                </div>
                <div class="form-group bj">
                  <label for="inputPassword3" class="col-sm-2 control-label">Harga Satuan Khusus</label>

                  <div class="col-sm-10">
                    <input type="number" min="0" class="form-control" id="inputPassword3" style="border-radius: 6px" name="hargak" placeholder="Harga Khusus">
                    
                    <small class="text-info">(-) jika Harga Khusus Diisi, maka Harus Lebih kecil dari Harga Satuan</small>
                    
                  </div>
                </div>
				<?php } 	?>
						
						
				
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Deskripsi</label>

                  <div class="col-sm-10">
                    <textarea rows="10"  class="form-control"style="border-radius: 6px" name="deskripsi"></textarea>
                  </div>
                </div>

         
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-success pull-right btn-block btn-lg">Simpan</button>
                <a class="btn btn-info pull-right btn-block btn-lg"  href="<?=base_url('User_admin/beranda')?>">Kembali</a>
              </div>
              <!-- /.box-footer -->
              
              <?php
              
              } //pilih kategori
              
              ?>
              
            </form>
              <!-- /.table-responsive -->
            </div>
                  </div>
    
    
		

    
     <!--ISI per kategori-->
     <br />
  
	
    </section>
    

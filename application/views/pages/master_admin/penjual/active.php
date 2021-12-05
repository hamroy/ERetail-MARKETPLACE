
            <div class="box-header with-border">
             

              <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>No. NBM</th>
                    <th>No. Telp/ HP</th>
                    <th>Username / password</th>
                    <th>Status Pekerjaan</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><a href="<?=base_url('Master_admin/daftar_produk_penjual/'.$gidp->idlog)?>"><?=$gidp->nama?></a></td>
                    <td>
                    <?php
       	  	$string = read_file('./upload/nbm/'.$gidp->file_nbm);
                    ?>
                   
                    <?php 
                    if ($string == TRUE){ ?>
			<span class="pull-left"><a href="<?=base_url()?>/upload/nbm/<?=$gidp->file_nbm?>" target="_blank"> <?=$gidp->nbm?></a></span>
		<?php			} ?>
                    
                    </td>
                    <td><?=$gidp->no_kontak?></td>
                    <td><?=$gidp->username?></td>
                    <td><?=$gidp->password?></td>
                    <td><?=$gidp->tanggal?></td>
                    <?php
                    if($gidp->status==1){
                    	$wr='success';
                    	$tx='active';
                    	$up=2;
                    	$bt='block';
					}else{
						$wr='danger';
                    	$tx='non active';
                    	$bt='active';
                    		
                    	$up=1;
					}
                      ?>
                    <td class="<?=$wr?>">
                    	<?=$tx?>
                    </td>
                    <td>
                    
                    <?php
                    if($gidp->status==1){ 
                    ?>
							<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModaltbl<?=$gidp->idlog?>"> <i class="fa fa-edita"></i>Block
</button>


					<?php
					}else{ 
					?>
					<a class="btn btn-success btn-sm" href="<?=base_url('Master_admin/block_penjual/'.$gidp->idlog.'/'.$up)?>"><?=$bt?></a>
			
					<?php
					}
                    ?>
<!-- Modal -->
<div class="modal fade" id="myModaltbl<?=$gidp->idlog?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">BLOCK PRODUK</h4>
      </div>
      <div class="modal-body">
      <form role="form" action="<?=base_url('Master_admin/block_penjual/'.$gidp->idlog.'/'.$up)?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Karena :</label>
    <textarea class="form-control" name="alasan"rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary btn-block">Kirim</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                    
                    
                    </td>
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                                
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
	
		
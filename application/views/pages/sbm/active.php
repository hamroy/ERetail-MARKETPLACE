
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
                    <th>Nama</th>
                    <th>Email</th>
                    
                    <th>Tempat, tanggal lahir</th>
                    <th>Alamat</th>
                    
                    
                    <th>No. Telp/ HP</th>
                    <th>No. NBM</th>
                    <th>Usaha</th>
                    <th>Tanggal Daftar</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  //$get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  $get_all_id_produk=$this->Madmin_master->get_all_sbm(1);
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><a href="#"><?=$gidp->nama?></a></td>
                    <td><?=$gidp->username?></td>
                    <td><?=$gidp->tempat_l?>, <?=$gidp->tgl_l?></td>
                    <td><?=$gidp->alamat?></td>
                    <td><?=$gidp->no_kontak?></td>
                    
                    
                    <td>
                    <?php
       	  	$string = read_file('./upload/nbm/'.$gidp->file_nbm);
                    ?>
                   
                    <?php 
                    if ($string == TRUE){ ?>
			<span class="pull-left"><a href="<?=base_url()?>/upload/nbm/<?=$gidp->file_nbm?>" target="_blank"> <?=$gidp->nbm?></a></span>
		<?php			} ?>
                    
                    </td>
                    
                    
                    <td><?=$gidp->usaha?></td>
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
	
		
<div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>Username</th>
                    <!--<th>Password</th>-->
                      <th>Tempat, Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>No. Hp</th>
                    <th>Jenis Kelamin</th>
                    <th>No. NBM</th>
                     <th>Usaha</th>
                    <th>Tanggal Daftar</th>
                    <th>action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  //$get_all_user_tolak=$this->Madmin_master->get_all_usertolak();
                  $get_all_user_tolak=$this->Madmin_master->get_all_sbmtolak();
                  if($get_all_user_tolak->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_user_tolak->result() as $gidp){ 
				  	
				  ?>	
					<tr >
                    <td><?=$no++?></td>
                    <td><?=$gidp->nama?></td>
                    <td><?=$gidp->username?></td>
                    <!--<td><?=$gidp->password?></td>-->
                    <td><?=$gidp->tempat_l?>, <?=$gidp->tgl_l?></td>
                    <td><?=$gidp->alamat?></td>
                    <td><?=$gidp->no_kontak?></td>
                    <td><?=$gidp->jenis_kelamin?></td>
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
                    
                    <td>
                    	<a href="<?=base_url('C_sbm/terima_penjual/'.$gidp->idlog)?>" class="btn btn-success btn-sm" onclick="return confirm('anda Yakin ?')">TERIMA</a><br/>
                    	<!--<a onclick="return confirm('anda Yakin ?')" href="<?=base_url('Master_admin/tolak_penjual/'.$gidp->idlog)?>" class="btn btn-danger">TOLAK</a>-->
                    	
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
<div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                   <!-- <th>Password</th>-->
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
                  //$get_all_user_new=$this->Madmin_master->get_all_usernew();
                  $get_all_user_new=$this->Madmin_master->get_all_newsbm();
                  if($get_all_user_new->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_user_new->result() as $gidp){ 
				  	
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
<a href="<?=base_url('C_sbm/terima_penjual/'.$gidp->idlog)?>" class="btn btn-success btn-sm" onclick="return confirm('anda Yakin ?')">TERIMA</a><br/><br/>
                    	<!--<a onclick="return confirm('anda Yakin ?')" href="<?=base_url('Master_admin/tolak_penjual/'.$gidp->idlog)?>" class="btn btn-danger">TOLAK</a>-->
                    	
<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModalto<?=$gidp->idlog?>"> <i class="fa fa-edita"></i>TOLAK&nbsp;
</button>
<br/>

<div class="modal fade" id="myModalto<?=$gidp->idlog?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">PENOLAKAN AKUN PENJUAL BARU</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('C_sbm/tolak_penjual/'.$gidp->idlog)?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
      
        
          <div class="form-group">
    <label for="exampleInputEmail1">Karena :</label>
     <textarea class="form-control" rows="3" name="teks"> </textarea>
  </div>     
              <!-- /.box-footer -->
               <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right btn-block btn-lg">KIRIM</button>
              </div>
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
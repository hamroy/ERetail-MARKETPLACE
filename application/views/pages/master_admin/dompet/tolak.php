
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
                    <th>NIK</th>
                    <th>UNIT KERJA</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Acc</th>
                    <th>Alasan Ditolak</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                 // $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  $get_all_id_produk=$this->Madmin_master->get_pemesan_vo('99');
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				
				$getnama=$this->Muser->get_id_pass_nos($gidp->id_user);
				if($getnama->num_rows() > 0){
					$getnama0=$getnama->row()->nama;
				}else{
					$getnama0='nama kosong';
				}
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><a ><?=$getnama0?></a></td>
                   
                    <td><?=$gidp->nik?></td>
                    <td><?=$gidp->unit?></td>
                    <td><?=$gidp->tanggal?> <?=$gidp->waktu?></td>
                    <td><?=$gidp->tanggal_acc?></td>
                    <td><?=$gidp->alasan_tolak?></td>
                    
                 
                    <td>
                    
                    	<a class="btn btn-success btn-sm" href="<?=base_url('C_dompet/terima_pesan_voc/t/'.$gidp->id_user.'/'.$gidp->id)?>">Terima</a>
					<br/>
					<br/>
                    	<a href="<?=base_url('Master_admin/hapus_pesan_vou/'.$gidp->id)?>" class="btn btn-danger btn-sm" onclick="return confirm('anda Yakin ?')">HAPUS</a>
                    
                    
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
	
		
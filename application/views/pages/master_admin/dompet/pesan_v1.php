
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
                    <th>TAHAP</th>
                    <th>Tanggal</th>
                    <th>MENU</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                 // $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  //$get_all_id_produk=$this->Madmin_master->get_pemesan_vo('1');
                  $get_all_id_produk=$this->Madmin_master->get_pemesan_vo_2('0');
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
                    <td><?=$gidp->tahap?></td>
                    <td><?=$gidp->tgl_trans?></td>
                    
                    <td>
                    
                    
                    	
					<a class="btn btn-success btn-sm kla" data-toggle="modal" data-target="#myModaltblsfeok<?=$gidp->id?>"> <i class="fa fa-clear"></i>Terima
</a>

<a class="btn btn-danger btn-sm kla" data-toggle="modal" data-target="#myModaltblsfe<?=$gidp->id?>"> <i class="fa fa-edita"></i>Tolak
</a>
 <script>
function ilham(){
alert("Anda Yakin !");
$('.kla').attr('disabled', 'disabled');

}
</script>                 
<!-- Modal -->
<div class="modal fade" id="myModaltblsfeok<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">TERIMA VOUCHER</h4>
      </div>
      <div class="modal-body">
      <form role="form" action="<?=base_url('C_dompet/terima_pesan_voc_2/t/'.$gidp->id_user.'/'.$gidp->id)?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">NAMA Voucher :</label>
    <input class="form-control" type="text" placeholder="Nama Voucher" name="nama" />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Saldo :</label>
    <input class="form-control" type="number" min="0" placeholder="Saldo" name="saldo" />
  </div>
  <button type="submit" onclick="return confirm('Anda Yakin !!')" class="btn btn-primary btn-block">Kirim</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModaltblsfe<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">BLOCK PRODUK</h4>
      </div>
      <div class="modal-body">
      <form role="form" action="<?=base_url('C_dompet/terima_pesan_voc_2/b/'.$gidp->id_user.'/'.$gidp->id)?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Karena :</label>
    <textarea class="form-control" name="alasan"rows="3"></textarea>
  </div>
  <button type="submit" onclick="return confirm('Anda Yakin !!')" class="btn btn-primary btn-block">Kirim</button>
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
	
		
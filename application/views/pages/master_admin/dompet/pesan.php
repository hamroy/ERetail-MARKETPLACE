
            <div class="box-header with-border">
             

              <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table class="table no-margin">
	 <tr bgcolor="#b7bdb8">
        <th>Tahap</th>
        <th>Total</th>
	</tr>
	
	<!--2-->
	<?php
	$gt_tblinputpesanvoucher_select_tahap=$this->Login_model->get_daftar_input_voucher_st_all();
	$th=$gt_tblinputpesanvoucher_select_tahap;
	for($x=2;$x <= $th;$x++){
	$get_all_input=$this->Madmin_master->get_input_pemesan_vo($x);	
	?>
	  <?php
  $get_juduledisi=$this->Madmin_master->get_judul_edisi($x);
  if($get_juduledisi->num_rows() > 0){
  	$get_edisi=$this->Madmin_master->get_judul_edisi($x)->row()->ket;
  }else{
  	$get_edisi='';
  }
  			?>
	<tr>
		 <th><a data-toggle="collapse" data-parent="#accordion<?=$x?>" href="#collapseOne<?=$x?>">
         Ed. <?=$x.' '.$get_edisi?> 
         
        </a>
        
        
        
        </th>
        <th><?php
       $td_tot= $this->Madmin_master->get_total_peredisi($x);	
       //echo number_format($td_tot,0,',','.')
       $get_all_id_produk=$this->Madmin_master->get_pemesan_vo_2_id_edisi('0',$x);
       echo $get_all_id_produk->num_rows();
         ?>
         	
         </th>
	</tr>
	<tr>
		<td colspan="2">
	<div id="collapseOne<?=$x?>" class="panel-collapse collapse">
	<table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>UNIT KERJA</th>
                    <th>EDISI</th>
                    <th>Tanggal</th>
                    <th>MENU</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  
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
                    <td><?=$gidp->edisi?></td>
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
      <form role="form" action="<?=base_url('C_dompet/terima_pesan_voc_2/mak/t/'.$gidp->id_user.'/'.$gidp->id.'/')?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">NAMA Voucher :</label>
    <input class="form-control" type="text" placeholder="Nama Voucher" value="<?=$get_edisi?>" name="nama" />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Saldo :</label>
    <input class="form-control" type="number" min="0" placeholder="Saldo" name="saldo" required />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">EDISI :</label>
    <input class="form-control" type="number" min="0" placeholder="Edisi " value="<?=$gidp->edisi?>" name="edisi" readonly/>
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
      <form role="form" action="<?=base_url('C_dompet/terima_pesan_voc_2/mak/b/'.$gidp->id_user.'/'.$gidp->id)?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Karena :</label>
    <textarea class="form-control" name="alasan"rows="3"></textarea>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">EDISI :</label>
    <input class="form-control" type="number" min="0" placeholder="Edisi " value="<?=$gidp->edisi?>" name="edisi" required/>
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
	</td>
	</tr>
	<?php
	}
	?>
	
	</table>
               
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
	
		
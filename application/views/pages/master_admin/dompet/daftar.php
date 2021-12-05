
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
	<tr>
	
		 <th>
		  <?php
  $get_juduledisi=$this->Madmin_master->get_judul_edisi(1)->row();
  			?>
		 <a data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
         Ed. 1 <?=$get_juduledisi->ket?>
        </a>
         <form class="form-inline" role="form"method="post" action="<?=base_url('Master_admin/ganti_judul_edisi/1')?>">
  <div class="form-group">
 
    <input type="text" name="ket" value="<?=$get_juduledisi->ket?>"  class="form-control" id="exampleInputEmail2" placeholder="Keterangan">
  </div>
  <button type="submit" class="btn btn-default">Simpan</button>
</form>
        </th>
        <th>
        <?php
        $get_all_id_produk=$this->Madmin_master->get_pemesan_vo('1');
        ?>
        <?=number_format($get_all_id_produk->num_rows()*200000,0,',','.')?>
        	
        </th>
	</tr>
	<tr>
		<td colspan="2">
	<div id="collapseOne1" class="panel-collapse collapse">
	 <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>UNIT KERJA</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal ACC</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                 // $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  
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
                    
                 
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                                
                  </tbody>
                </table>
	</div>
	</td>
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
		 <th><a data-toggle="collapse" data-parent="#collapseOnedaftar<?=$x?>" href="#collapseOnedaftar<?=$x?>">
         Ed. <?=$x.' '.$get_edisi?> 
         
        </a>
        <form class="form-inline" role="form"method="post" action="<?=base_url('Master_admin/ganti_judul_edisi/'.$x)?>">
  <div class="form-group">
    <input type="text"  class="form-control" value="<?=$get_edisi?>" name="ket" id="exampleInputEmail2" placeholder="Keterangan">
  </div>
  <button type="submit" class="btn btn-default">Simpan</button>
</form>
        
        
        
        </th>
        <th><?php
       $td_tot= $this->Madmin_master->get_total_peredisi($x);	
       echo number_format($td_tot,0,',','.')
         ?>
         	
         </th>
	</tr>
	<tr>
		<td colspan="2">
	<div id="collapseOnedaftar<?=$x?>" class="panel-collapse collapse">
	<table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>UNIT KERJA</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal ACC</th>
                    <th>Jenis Voucher</th>
                    <th>SALDO</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                 // $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  
                  if($get_all_input->num_rows() > 0){
                  	$no=1;
                  	$tot_ed=0;
				  	foreach($get_all_input->result() as $gidp){ 
				
				$getnama=$this->Muser->get_id_pass_nos($gidp->id_user);
				if($getnama->num_rows() > 0){
					$getnama0=$getnama->row()->nama;
				}else{
					$getnama0='nama kosong';
				}
				$tot_ed=$tot_ed+$gidp->saldo;
				$this->session->set_userdata('total_ed'.$x,$tot_ed);
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><a ><?=$getnama0?></a></td>
					<td><?=$gidp->nik?></td>
                    <td><?=$gidp->unit?></td>                   
                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_oto?></td>
                    <td><?=$gidp->jenis?></td>
                    <td><?=number_format($gidp->saldo,0,',','.')?></td>
                    
                 
                   
                  </tr>  
				<?php	
					}
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
	
		
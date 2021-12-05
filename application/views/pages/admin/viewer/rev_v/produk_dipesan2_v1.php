 <section class="content-header" style="background: #ecedee;">
    
      <h1>
         <b>PRODUK DIPESAN</b>
        <small></small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>
        <li class="active">Produk dipesan</li>
      </ol>
    </section>
 
    <!-- Main content -->
    <section class="content">
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
	
	<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Pembeli</h3>

              <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Email</th>
                    <th>No.hp</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Sub total</th>
                    <th>Pembayaran</th>
                    <th>Tanggal Transaksi</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  ////di grup produk dan id tgl
                  
                  $get_all_id_produk=$this->Madmin->get_Produk_dipesan($this->session->userdata('id_user'));
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				  	$sgetuser=$this->Madmin->getidpembeli($gidp->id_pembeli);
				  	
				
				if($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0){
					$getpembeli=$this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;	
					
					if(empty($getpembeli)){
						$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli='(penjual)'.$getuser->row()->nama;
						}else{
							$getpembeli='user kosong';
						}
					}else{
					$getpembeli=$getpembeli;	
					}
					
						
					}else{
						
					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli='(penjual)'.$getuser->row()->nama;
						}else{
							$getpembeli='pembeli kosong';
						}	
					
					
					}
				   
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><?=$getpembeli?></td>
                      <td><?=$sgetuser->row()->email?></td>
                     <td><?=$sgetuser->row()->hp?></td>
                    <td><?=$gidp->nama?></td>
                    <td><?=$gidp->qty?></td>
                     <td><?=number_format($gidp->harga_satuan,2,',','.')?></td>
                    <td><?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?></td>
                    <td><?=$gidp->metode?></td>
                    <td><?=$gidp->tgl_trans?></td>
                    <td>Proses</td>
                  	<?php
                    $getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
						if($getuser->num_rows() > 0){
							$getpembeli_akun=$getuser->row()->nama;
							$voucerbelanjakan=$getuser->row()->voucher_dibelanjakan;
						}else{
							$getpembeli_akun='';
							$voucerbelanjakan='0';
						}	
                  if($gidp->metode == 'VOUCHER'){
				  	 if($voucerbelanjakan < $gidp->harga_satuan*$gidp->qty)
					 	{
					 		echo $voucerbelanjakan;
						?>
						
						<td class="text-red">MOHON HUB. Admin</td>
						<?php
						}else{
							?>
							 <td>
                  <?php
                  if($gidp->harga_satuan*$gidp->qty != 0){
				  	?>
                     <a class="btn btn-xs btn-success kla" data-toggle="modal" data-target="#myModalgambar<?=$gidp->id?>">
                     Transaksi Selesai
                      </a>
                      <!-- Modal POTO -->
<div class="modal fade" id="myModalgambar<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Transaksi Selesai</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('User_admin/otorisasi/'.$gidp->id.'/ok/user')?>" method="post" enctype="multipart/form-data">
              <div class="box-body" align="left">
             <div class="form-group">
				Nama Pembeli :  <?=$getpembeli?> <br/>
                  Email Pembeli :  <?=$sgetuser->row()->email?> <br/>
		          Produk         : <?=$gidp->nama?><br/>
                  Jumlah Produk : <?=$gidp->qty?><br/>
                  Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>
                Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>
                 
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit"  onclick="return confirm('anda Yakin!')"  class="btn btn-success pull-right btn-block btn-lg">Transaksi Selesai</button>
              </div>
              <!-- /.box-footer -->
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	
                  
				  	<?php
				  }
                  
                  ?>
                  
               

<a class="btn btn-xs btn-danger kla" data-toggle="modal" data-target="#myModalgambarbtl<?=$gidp->id?>">Transaksi Batal</a>
 
 <div class="modal fade" id="myModalgambarbtl<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Transaksi Batal</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('User_admin/otorisasi/'.$gidp->id.'/btl/user')?>" method="post" enctype="multipart/form-data">
              <div class="box-body" align="left">
             <div class="form-group">
					Nama Pembeli :  <?=$getpembeli?> <br/>
                  Email Pembeli :  <?=$sgetuser->row()->email?> <br/>
		          Produk         : <?=$gidp->nama?><br/>
                  Jumlah Produk : <?=$gidp->qty?><br/>
                  Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>
                   Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>
                 
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" onclick="return confirm('anda Yakin!')" class="btn btn-danger pull-right btn-block btn-lg btn_wala">Transaksi Batal</button>
              </div>
              <!-- /.box-footer -->
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>   
         
                   </td>
							<?php
						}
					 }else{
					 	
					 	?>
					 	 <td>
                  <?php
                  if($gidp->harga_satuan*$gidp->qty != 0){
				  	?>
                     <a class="btn btn-xs btn-success kla" data-toggle="modal" data-target="#myModalgambar<?=$gidp->id?>">
                     Transaksi Selesai
                      </a>
                      <!-- Modal POTO -->
<div class="modal fade" id="myModalgambar<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Transaksi Selesai</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('User_admin/otorisasi/'.$gidp->id.'/ok/user')?>" method="post" enctype="multipart/form-data">
              <div class="box-body" align="left">
             <div class="form-group">
					Nama Pembeli :  <?=$getpembeli?> <br/>
                  Email Pembeli :  <?=$sgetuser->row()->email?> <br/>
		          Produk         : <?=$gidp->nama?><br/>
                  Jumlah Produk : <?=$gidp->qty?><br/>
                  Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>
                   Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>
                 
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit"  onclick="return confirm('anda Yakin!')"  class="btn btn-success pull-right btn-block btn-lg">Transaksi Selesai</button>
              </div>
              <!-- /.box-footer -->
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	
                  
				  	<?php
				  }
                  
                  ?>
                  
               

<a class="btn btn-xs btn-danger kla" data-toggle="modal" data-target="#myModalgambarbtl<?=$gidp->id?>">Transaksi Batal</a>
 
 <div class="modal fade" id="myModalgambarbtl<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Transaksi Batal</h4>
      </div>
      <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('User_admin/otorisasi/'.$gidp->id.'/btl/user')?>" method="post" enctype="multipart/form-data">
              <div class="box-body" align="left">
             <div class="form-group">
					Nama Pembeli :  <?=$getpembeli?> <br/>
                  Email Pembeli :  <?=$sgetuser->row()->email?> <br/>
		          Produk         : <?=$gidp->nama?><br/>
                  Jumlah Produk : <?=$gidp->qty?><br/>
                  Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>
                   Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>
                 
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" onclick="return confirm('anda Yakin!')" class="btn btn-danger pull-right btn-block btn-lg btn_wala">Transaksi Batal</button>
              </div>
              <!-- /.box-footer -->
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>   
         
                   </td>
					 	<?php
					 	
					 }
                    ?>
                    <!--<td><a href="<?=base_url('User_admin/before_otorisasi/'.$gidp->id)?>">Otorisasi</a></td>-->
                   
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
	
		</div>
    </section>
    
    
    

             <?php

             ?>
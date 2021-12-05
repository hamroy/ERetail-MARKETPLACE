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
				}else{
					$getpembeli='';
				}
				   
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><?=$getpembeli?></td>
                      <td><?=$sgetuser->row()->email?></td>
                     <td><?=$sgetuser->row()->hp?></td>
                    <td><?=$gidp->nama?></td>
                    <td><?=$gidp->qty?></td>
                    <td><?=number_format($gidp->harga_satuan,2,',','.')?>qsq</td>
                    <td><?=number_format($gidp->total,2,',','.')?>qsq</td>
                    <td><?=$gidp->metode?></td>
                    <td><?=$gidp->tgl_trans?></td>
                    <td>Proses</td>
                   <td><a class="btn btn-xs btn-success" href="<?=base_url('User_admin/otorisasi/ok/'.$gidp->id)?>">Transaksi Selesai</a>
                   <br/>
                   <a class="btn btn-xs btn-warning" href="<?=base_url('User_admin/otorisasi/btl/'.$gidp->id)?>">Transaksi Batal</a></td>
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
    
   
 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b><a href="<?=base_url('User_admin/transaksi')?>">TRANSAKSI</a></b>
        <small></small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>
        <li class="active">Transaksi</li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    
     <div class="well" align="center">
        <h3><span class="pull-left">
        <?php
        	$blnaray=array(
					'1'=>'Januari',
					'2'=>'Februari',
					'3'=>'Maret',
					'4'=>'April',
					'5'=>'Mei',
					'6'=>'Juni',
					'7'=>'Juli',
					'8'=>'Agustus',
					'9'=>'September',
					'10'=>'Oktober',
					'11'=>'November',
					'12'=>'Desember',
					);
                    
                    ///
                    if($bln >= 12){
                        $jdbln=$blnaray[1];
                        $urlbln=1;
                        $urlthn=$thn+1;
                    }else{
                        $jdbln=$blnaray[$bln+1];
                        $urlbln=$bln+1;
                        $urlthn=$thn;
                    }
                    
                    if($bln <= 1){
                        $jdbln0=$blnaray[12];
                        $urlbln0=12;
                        $urlthn0=$thn-1;
                    }else{
                        $jdbln0=$blnaray[$bln-1];
                        $urlbln0=$bln-1;
                        $urlthn0=$thn;
                    }
                    
        ?>
        
        <a href="<?=base_url('User_admin/transaksi_rinci/'.$urlthn0.'/'.($urlbln0))?>"><span class="glyphicon glyphicon-chevron-left"></span>
         <?=$jdbln0?></a></span>
        <b>
        
        <?=$blnaray[$bln]?> <?=$thn?>
        
        
        </b><span class="pull-right">
        <a href="<?=base_url('User_admin/transaksi_rinci/'.$urlthn.'/'.($urlbln))?>"> <?=$jdbln?> 
        <span class="glyphicon glyphicon-chevron-right"></span></a></span></h3>
        
    </div>
    
    <!--NAV-->
	
	<div class="box box-info">
            <div class="box-header with-border">

             
            <!-- /.box-header -->
            <div class="box-body">
            
              	
<br/>            
              <div class="table-responsive">
              <table class="table no-margin table-striped table-hover js-basic-example dataTable">
                  <thead>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai Transaksi</th>
                    <th>Pembayaran</th>
                  </tr>
                  </thead>
                  <tfoot>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai Transaksi</th>
                    <th>Pembayaran</th>
                  </tr>
                  </tfoot>
                  <tbody>
                  <?php 
                  $get_id_produk=$this->Madmin->get_all_transaksi_perbln($bln,$this->session->userdata('id_user'),$thn);
                  if($get_id_produk->num_rows() == 0){
                      redirect('User_admin/transaksi');
                  }
                  
                
				  	
				 
				   $totperbln=0;
				   $no=1;
                  	foreach($get_id_produk->result() as $gidp){
						
					
				  	
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
					
					if($this->Madmin_master->get_user_produk($gidp->id_pelapak)->num_rows() > 0){
					$getpenjual=$this->Madmin_master->get_user_produk($gidp->id_pelapak)->row()->nama;	
						
					}else{
					$getpenjual='';
					}
					if($this->Madmin_master->get_produk_produkid($gidp->id_produk)->num_rows() > 0){
					$getproduk=$this->Madmin_master->get_produk_produkid($gidp->id_produk)->row()->nama;	
						
					}else{
					$getproduk='';
					}
					  
				  	?>
					<tr >
                    <td><?=$no++?></td>
                     <td><?=$getpembeli?></td>
                    <td><?=$getproduk?></td>
                    <td><?=$gidp->qty?></td>
                    <td align="right">
                    <?php
            $hrgasatuan=0;
            $gprod=$this->Madmin->get_produk_by_id($gidp->id_produk);
            if($gprod->num_rows() > 0){
            if(empty($gprod->row()->hargak)){
			$hrgasatuan= $gprod->row()->harga;	
			}else{
			$hrgasatuan= $gprod->row()->hargak;	
			}  
            }
            
			
            if($gidp->harga_satuan!=0){
				$akhirsat=$gidp->harga_satuan;
			}else{
				$akhirsat=$hrgasatuan;
			}
                    ?>
                    <?=number_format($akhirsat,0,',','.')?></td>
                    <td align="right"><?=number_format($akhirsat*$gidp->qty,0,',','.')?></td>
                   
                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>
                    <td><?=$gidp->metode?></td>
                   
                  </tr>  
				<?php	
					$totperbln=$totperbln+$akhirsat*$gidp->qty;
					}
                  ////di susun perbulan
                  ?>
                  
                  
                  <?php
					
                  ?>
                                
                  </tbody>
                </table>
                <table class="table">
                <tr style="background-color: #b3b3b9">
                  	<td align="left">
                  
                  			<b>Total Bulan <?=$blnaray[$bln]?> <?=$thn?></b>
                              <br/>
                            <b><?=number_format($totperbln,0,',','.')?> </b>                 
                  	</td>
                  </tr>
                </table>
               
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
	
		</div>
    </section>
    
   
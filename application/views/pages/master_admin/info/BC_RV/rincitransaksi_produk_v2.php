 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b><a href="<?=base_url('Master_admin/daf_transaksi')?>">DAFTAR TRANSAKSI</a></b>
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
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
                  if($sort==NULL){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($bln,$thn);
				  	
				  }elseif($sort=='b1'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($bln,$thn);
                  }elseif($sort=='b2'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_qty($bln,$thn);
				  }elseif($sort=='b3'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_harga($bln,$thn);
				  }elseif($sort=='a1'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_sort_job($bln,$thn);
				  }elseif($sort=='a2'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_sort_job_harga($bln,$thn);
				  }
				  ///16/5/17
				  
                  //$totbln=$this->Madmin_master->total_transaksiperbln($bln,$sort);
                  $totbln=0;
                  	
                  	?>
    <section class="content">
    
    <div class="well" align="center">
        <h3><b>BULAN <?=$blnaray[$bln]?> <?=$thn?></b></h3>
        
    </div>
    <div class="well">
    <form class="form-inline" role="form">
  
  <div class="form-group">
    <label for="exampleInputPassword2">Urutkan I</label>
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/b1/1')?>" <?php if($sort2==1){ echo 'selected';}?> >TRANSAKSI</option>
   <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/a1/2')?>" <?php if($sort2==2){ echo 'selected';}?> >STATUS</option>
 
</select>

  </div>
  <span class="pull-right"><a class="btn btn-default" target="_blank" href="<?=base_url('C_cetak/cetak_trans_admin/'.$bln.'/'.$thn.'/'.$sort.'/'.$sort2)?>">CETAK</a></span>
  
</form>
<hr/>
<form class="form-inline" role="form">
  
  <div class="form-group">
    <label for="exampleInputPassword2">Urutkan II</label>
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
  
  <?php
  $var2='b1';
  $var2_1='b2';
  $var2_2='b3';
  if($sort2==2){
      $var2_1='a1';
      $var2_2='a2';
  }
  //b=transaksi,a=subunut
  
  ?>
  <?php
  if($sort2==1){
      
  ?>
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/'.$var2.'/'.$sort2)?>" <?php if($sort==$var2){ echo 'selected';}?> >Terbaru</option>
  <?php
  }
  ?>
  
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/'.$var2_1.'/'.$sort2)?>" <?php if($sort==$var2_1){ echo 'selected';}?> >Jumlah Barang Dijual Terbanyak</option>
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/'.$var2_2.'/'.$sort2)?>" <?php if($sort==$var2_2){ echo 'selected';}?>>Jumlah Rupiah Transaksi Terbanyak</option>
  
</select>
  </div>
  
</form>

</div>
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
	
	<div class="box box-info">
            <div class="box-header with-border">

             
            <!-- /.box-header -->
            <div class="box-body">
            
              	
<br/>            
              <div class="table-responsive">
             
              
              <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Nama Penjual</th>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai Transaksi</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  
                  
                  
                
				  	
				 
				   $no=1;
				   $totperbln=0;
                  	foreach($get_id_produk->result() as $gidp){
						
					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
				  	
				  	if($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0){
					$getpembeli=$this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;	
					}else{
                        if($getuser->num_rows() > 0){
							$getpembeli='(akun)'.$getuser->row()->nama;
						}else{
							$getpembeli='pembeli kosong';
						}
                    }
                    
                     if($getuser->num_rows() > 0){
							$getstjob= $this->M_setapp->get_tbl_st_job_id($getuser->row()->job)->row()->nama_job;
						}else{
							$getstjob='';
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
                     <td><?=$getpenjual?></td>
                    <td><?=$getproduk?></td>
                    <td><?=$gidp->qty?></td>
                    <td align="right">
                    <?php
                    if(empty($this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak)){
			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->harga;	
			}else{
			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak;	
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
                     <td>
                    <?php
                    
                    
                    echo $getstjob;
        
                    
                    ?></td>
                   
                  </tr>  
				<?php	
					$totperbln=$totperbln+($akhirsat*$gidp->qty);
					}
                  ////di susun perbulan
                  ?>
                  <tr style="background-color: #b3b3b9">
                  	<td colspan="6" align="right">
                  
                  			<b>Total Bulan <?=$blnaray[$gidp0->bln]?> <?=$gidp->thn?></b>
                  	</td>
                  	<td colspan="5"  align="center">
                  			<b><?=number_format($totperbln,0,',','.')?> </b>                 	</td>
                  </tr>
                  
                  <?php
					
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
    
   
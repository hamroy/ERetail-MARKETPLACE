<div class="container">
  <div class="panel panel-default">
  <!-- Default panel contents -->
  <?php
  
 /// echo $this->session->userdata('id_pembeli');
    	//$list = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart($this->session->userdata('id_pembeli'));
    	/*  if($this->session->userdata('login')==FALSE){
			$list = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart($id_pembeli);	
			$tothbar=$this->Mtrans->total_belanja_by_pembeli($id_pembeli);
			}else{
			//$list = $this->Mtrans->lihat_keranjang_by_pelapak_tanpa_cart($this->session->userdata('id_user')); ///bila user
			$list = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart($id_pembeli);	
			$tothbar=$this->Mtrans->total_belanja_by_penjual($id_pembeli);
			} ////*/
			$list = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart($id_pembeli);	
			$tothbar=$this->Mtrans->total_belanja_by_pembeli($id_pembeli);
			 ?>
			
  <div class="panel-heading"><h4><a href="<?=base_url('Welcome/allkategori')?>"><?=$title2?></a> || Data Pembelian</h4>  </div>
  <div class="panel-body">
  
     <div class="container-fluid">
     <div class="row">
  	<div class="col-md-8">
  		<h3><span class="label label-default">Ringkasan Belanja</span></h3>
     	<table class="table" >
     		<tr>
     			<td>Total Harga Barang</td>
     			<td>Rp <?=number_format($tothbar,2,',','.')?></td>
     		</tr>
     		<tr>
     			<td>Biaya Kirim</td>
     			<?php
     			$listpenjual = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart_penjual($id_pembeli);	
     			?>
     			<td>Rp <?=number_format($listpenjual->num_rows()*0,2,',','.')?></td>
     		</tr>
     		<tr>
     			<td><b>Total Belanja</b></td>
     			<td><b>Rp <?=number_format(0+$tothbar,2,',','.')?></b></td>
     		</tr>
     	</table>
     	<hr />
     	<h3><span class="label label-default">Rinci Belanja</span> </h3>
     	<div class="table-responsive">
     	<table class="table table-bordered">
    	<tr>
    		<td>Penjual</td>
    		<td>Barang</td>
    		<td>Qty.</td>
    		<td>Harga Satuan</td>
    		<td>Sub Total</td>
    	</tr>
    	<?php
            $subtot = 0;
    	$subtot = 0;
    	$hal = '-';
    	if ($list->num_rows()>0){
    		
    		foreach($list->result() as $t){
    			
    			/////NUMROWS()
    			$numqty=$this->Mtrans->m_numrowsqty($t->id_produk,$id_pembeli);
    			/////NUMROWS()
    			
    			
    			$barang = $this->Muser->get_produk_by_id($t->id_produk);
    			$namapelapak = $this->Muser->get_user_by_id($barang->row()->id_user)->row()->nama;
    				///========================STOK ==QTY
    				$qty=$this->Mtrans->get_produkqty($t->id_produk); ///barng yang sudah di beli
    				/////hapus bila barang kosong
    				$qty2pesan=$this->Mtrans->get_produkqty_dipesan($t->id_produk,$id_s); ///qty yang udah di pesan
    				$qty2ketranjang=$this->Mtrans->get_produkqty_dikeranjang($t->id_produk,$id_s); ///qty yang udah di pesan
    				//$stoka=$barang->row()->stok-$qty-$qty2pesan;
    				$stokall=$barang->row()->stok -($qty+$qty2pesan);
    				if($qty2ketranjang>$stokall){
    					
    					?>
    					<div class="alert alert-danger">Maaf . Produk <?=$barang->row()->nama?> Tedak tersedia .<br/> Mohon Tekan <kbd>F5</kbd></div>
    					<?php
    					$this->Mtrans->del_id_produk($t->id_produk,$id_pembeli);
    					//$hal='no';
    					$hal=$hal.'ya';
					} else{
						//$hal='ya';
						$hal=$hal.'no';
					}
						
                 	// echo $qty;
                  //		echo $qty2pesan;
              	/*	echo $barang->row()->stok .'stok<br/> '; ///stok di penjual
                  	echo $qty2ketranjang.'dipesan olehnya<br/>'; ///barng yang baru di pesanolehnecya
                  	echo $qty2pesan.'dipesan semua<br/>'; ///barng yang pesan 
                  	echo $qty.'Sudah terjual semua<br/>'; ///barng yang sudah di beli 
                  	echo $stokall.'hasil sisia<br/>'; ///barng yang sudah di beli 
                  	echo '-----------------<br/>'; ///barng yang sudah di beli dan di pesanolehnecya
    				if($qty2ketranjang>$stokall){
    					echo 'ya';
    					
    					}else{
							echo 'no';
						} ////*/
    			?>
		<tr>
    		<td><?=$namapelapak?></td>
    		<td><?=$barang->row()->nama?>
    		<span class="pull-right"><a href="<?=base_url('Welcome/hapus_idtransaksi/'.$t->id)?>" onclick="return confirm('Anda Yakin !')"><i class="fa fa-fw fa-close"></i></a></span>
    		</td>
    		<td align="center"><?=$numqty?>
    		<?php 
				///===========================================================================SELECT STOK
				?> 
    		<?php
    		///============================================================NATARA HARGA NPORMAL DAN KHUSUS
    		if(empty( $barang->row()->hargak)){
					$harga= $barang->row()->harga;
				}else{
					$harga= $barang->row()->hargak;
				}
    		
    		?>
           
    		</td>
    		<td align="right">Rp <?=number_format($harga,2,',','.')?></td>    	
    		<td align="right">Rp <?=number_format($numqty * $harga,2,',','.')?></td>    	
    	</tr>
    		<?php
    		$subtot = $subtot + ($numqty * $harga);
    		?>

			<?php }			
}
    	?>
    	    	<tr>
    		<td colspan="4" align="right"><b>Total</b></td>
    		<td align="right"><b>Rp <?=number_format($subtot,2,',','.')?></b></td>
    	</tr>

    	</table>
    	</div>
     	<hr />	
     	<h4><a href="<?=base_url('Welcome/allkategori')?>"><?=$title2?></a></h4>
  	</div>
  	<div class="col-md-4">
  	<div class="table-responsive">
  		<h3><span class="label label-default">Rinci Pembeli</span></h3>
     	<form method="post" action="<?=base_url('welcome/bayar/')?>">
     	<table class="table">
     	<?php 
     	 if($this->session->userdata('login')==FALSE){
     	 	$inama='';
     	 	$nohp='';
     	 	$alamt='';
     	 	$email='';
     	 	$nik='';
     	 	$inbm='';
     	 	$iranting='';
     	 	$icabang='';
     	 	$idaerah='';
     	 	}else{
			$inama='value="'.$nama.'" readonly';
     	 	$nohp=' value="'.$kontak.'" readonly';
     	 	$alamt=$alamat;
     	 	$email='value="'.$username.'" readonly';
     	 	$nik='value="'.$noik.'" readonly';
     	 	$inbm='value="'.$nbm.'" readonly';
     	 	$iranting='value="'.$ranting.'" readonly';
     	 	$icabang='value="'.$cabang.'" readonly';
     	 	$idaerah='value="'.$daerah.'" readonly';
			}
     	?>
     		<tr>
     			<td>
     			<label for="">Nama Pembeli<small class="text-danger">(*)</small></label>
     			<input name="namapembeli" <?=$inama?> placeholder="Nama" class="form-control br"required/ ></td>
     		</tr>

			<tr>
     			
     			<td>
     			<label for="">NBM</label>
     			<input name="nbm" <?=$inbm?> placeholder="NBM"  class="form-control br"/></td>
     		</tr>
     		
     		<tr>
     			<td>
     			<label for="">Email<small class="text-danger">(*)</small></label>
     			<input name="email" <?=$email?> class="form-control br"  placeholder="Email" required/>
     			<small class="text-warning">(-) Gunakan email <b>umy.ac.id</b> agar bukti transaksi dapat digunakan sebagai dokumen SKP.</small>
     			</td>
     			<small class="text-success">(-) Pastikan Email terdaftar. untuk melakukan notifikasi</small>
     		</tr>
     		<tr>
     			<td>
     			<label for="">Telepon/Handphone<small class="text-danger">(*)</small></label>
     			<input name="hppembeli" <?=$nohp?> class="form-control br" placeholder="No. Hp" required/></td>
     		</tr>
			<tr>
     			<td>
     			<label for="">Ranting</label>
     			<input name="ranting"  class="form-control br" placeholder="Ranting" <?=$iranting?> /></td>
     		</tr>
     		<tr>
     			<td>
     			<label for="">Cabang</label>
     			<input name="cabang" class="form-control br" placeholder="Cabang" <?=$icabang?>/></td>
     		</tr>
     		<tr>
     			<td>
     			<label for="">Daerah</label>
     			<input name="daerah" class="form-control br" placeholder="Daerah" <?=$idaerah?>/></td>
     		</tr>
     		<tr>
     			<td>
     			<label for="">Alamat Lengkap<small class="text-danger">(*)</small></label>
     			
     			<textarea name="alamatpembeli"  class="form-control br" cols="5" required><?=$alamt?></textarea>
     			</td>
     		</tr>
     		<tr>
     			<td colspan="2">
     <small class="text-danger">(*) Wajib diisi.</small>
     			</td>
     		</tr>
     	</table>
     	<hr />
     	<h3><span class="label label-default">Pembayaran Melalui</span></h3>
     	<div class="form-group">
     	<label class="radio-inline">
		  <input type="radio"  name="metode" id="inlineRadio1" value="TUNAI"> TUNAI
		</label><br/>
		<label class="radio-inline">
		  <input type="radio"  name="metode" id="inlineRadio1" value="VIA TRANSFER" disabled> <span class="text-muted">VIA TRANSFER</span>
		</label><br/>
		<label class="radio-inline">
		  <input type="radio"  name="metode" id="inlineRadio1" value="BMT" disabled> <span class="text-muted">BMT UMY</span>
		</label><br/>
		<label class="radio-inline">
		  <input type="radio"  name="metode" id="inlineRadio2" value="UMY" disabled><span class="text-muted"> BIRO KEUANGAN UMY</span>
		</label>
		</div>
		<?php // pada PHP 4.0b3 dan terbaru:
	
$pos = strpos ($hal, "ya");
if ($pos === false) { // perhatikan jumlah tanda = ada 3
//echo " tdk";
}else{
//	echo 'yaa';
}
 ?>
		<?php
		if ($list->num_rows()>0 and $pos === false){ ?>
     	<input type="submit" value="PROSES PEMESANAN" class="btn btn-success btn-block" onclick="return confirm('Anda yakin?')">
     	<a type="button" class="btn btn-warning btn-block" href="<?=base_url('Welcome/batalpesan/'.$id_pembeli)?>" onclick="return confirm('Anda yakin?')">BATAL
     	</a>
     	
     	<?php }else{ ?>
     	<input type="submit" value="PESAN" class="btn btn-danger btn-block" onclick="return confirm('Anda yakin?')" disabled>
     	<?php } ?>
     	
     	</form>
	</div>	
  	</div>
  </div>
	
     
     </div>
  </div>

 
</div>

</div>
<?php

//echo 'as'.$this->session->userdata('id_pembeli_id_pembeli');
//echo 'as2'.$this->session->userdata('id_pembeli');

?>
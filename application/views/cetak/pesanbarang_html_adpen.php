<html>
<link  rel="stylesheet" href="<?=base_url()?>bootstrap/css/bootstrap.min.css">
<style type="text/css">

body {
    margin: 0.1in;
}
#kiri {
    width: 20%;
    float: left;
    padding: 10px;
}
#kanan {
    width: 100%;
}

h1, h2, h3, h4, h5, h6, li, blockquote, p, th, td {
    font-family: Helvetica, Arial, Verdana, sans-serif; /*Trebuchet MS,*/
}
h1, h2, h3, h4 {
    color: #000000;
    font-weight: normal;
}
h4, h5, h6 {
    color: #000000;
}
h2 {
    margin: 0 auto auto auto;
    font-size: x-large;
}
li, blockquote, p, th, td {
    font-size: 80%;
}
ul {
    list-style: url(/img/bullet.gif) none;
}

#footer {
    border-top: 1px solid #000000;
    text-align: right;
}

table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    font-family: "Trebuchet MS", Arial, sans-serif;
    color: black;    
}
#ss {
	padding: 9px;
	border-top: 1px;
	border-left-style: double;
}
td, th {
    padding: 4px;
}

P.breakhere {page-break-after: always}
</style>
 <?php
if($cetak=='html'){
    $bo='onload="print()"';
}else{
    $bo='';
}
?>
<body style="padding: 10px;" <?=$bo?>>
     <a href="<?=base_url('C_cetak/cetak_pesan_barang_admin/html/'.$id)?>" class="btn btn-default hidden-print" ><span class="glyphicon glyphicon-print"></span> Cetak </a>
<a href="<?=base_url('C_cetak/cetak_pesan_barang_admin/pdf/'.$id)?>" class="btn btn-danger hidden-print" ><span class="glyphicon glyphicon-file"></span> PDF </a>
<hr  class="hidden-print"/>   
   <div id="kanan" class="page-header">
   <br/>
        <h3 align="center"><?=$title1?></h3>
        <h4 align="center"> BUKTI PEMESANAN BARANG </h4>
        </div>
	
	<tr>
		<th colspan="8" align="left">
			   <?php
     $get_transak=$this->Mtrans->get_qty_tbl_transaksi($id);
     $id_pembeli=$get_transak->row()->id_pembeli;
      $getprobembeli=$this->Mtrans->getprofilpembeli($id_pembeli);
      if($getprobembeli->num_rows() > 0){
	  	$nma=$getprobembeli->row()->nama;
	  	$alamat=$getprobembeli->row()->alamat;
	  	$email=$getprobembeli->row()->email;
	  	$hp=$getprobembeli->row()->hp;
          
        ///get
        $list = $get_transak;	
                     
                    $idtagihan=$get_transak->row()->id_tgl;
                    $list_kd = $this->Mbank->cek_transaksi_pembeli($id_pembeli,$get_transak->row()->id_tgl);	//tbltransaksi
        
                    if($list_kd->num_rows() > 0){
                        $idtagihan=$list_kd->row()->notagihan;
                    }
	  ?>
        
           <strong style="font-size: 25px">No. <?=$idtagihan?></strong><br>
          <address>
            
            <strong>Nama :<?=$nma?></strong><br>
            Alamat :<?=$alamat?><br>
            Phone: <?=$hp?><br>
            Email: <?=$email?>
          </address>
       <?php }
      ?>
			
		</th>
	</tr>
	
	
	<h3>Rinci Belanja </h3>
	<table class="table" width="100%">
    	<tr>
    		<td>Penjual</td>
    		<td>Barang</td>
    		<td>Qty.</td>
    		<td>Harga Satuan</td>
    		<td>Sub Total</td>
    	</tr>
    	<?php
    	//$tothbar=$this->Mtrans->total_belanja_by_pembeli_pesan($id_pembeli);
        $subtot = 0;
    	$subtot = 0;
    	if ($list->num_rows()>0){
    		
    		foreach($list->result() as $t){
    			$barang = $this->Muser->get_produk_by_id($t->id_produk);
    			$getDataPenjual=$this->Muser->get_user_by_id($barang->row()->id_user);
                $namapelapak = $getDataPenjual->row()->nama;
    				///========================STOK ==QTY
    				$qty=$this->Mtrans->get_produkqty($t->id_produk); ///barng yang sudah di beli
    				/////hapus bila barang kosong
    				$qty2pesan=$this->Mtrans->get_produkqty_dipesan($t->id_produk,$id_pembeli);
    				$stoka=$barang->row()->stok-$qty-$qty2pesan;
    				$stokall=$barang->row()->stok-$qty;
    				/////NUMROWS()
    			$numqty=$this->Mtrans->m_numrowsqty_pesan_dahlama($t->id_produk,$id_pembeli,$id_tgl);
    			/////NUMROWS()
                  	
                 	// echo $qty;
                  //		echo $qty2pesan;
                  	$stoka=$barang->row()->stok-$qty-$qty2pesan; ///barng yang sudah di beli dan di pesanolehnya
    			
    			?>
		<tr>
    		<td><?=$namapelapak?> (<?=$getDataPenjual->row()->no_kontak?>)
            </td>
    		<td><?=$barang->row()->nama?> </td>
    		<td align="center"><?=$t->qty?>
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
    		<td align="right">Rp <?=number_format($t->harga_satuan,2,',','.')?></td>    	
    		<td align="right">Rp <?=number_format($t->qty*$t->harga_satuan,2,',','.')?></td>    	
    	</tr>
    		<?php
    		$subtot = $subtot + ($t->qty*$t->harga_satuan);
    		?>

			<?php }			
        }else{
            redirect('User_admin/transaksi_belanja');
        }
    	?>
    	    	<tr>
    		<td colspan="4" align="right"><b>Total</b></td>
    		<td align="right"><b>Rp <?=number_format($subtot,2,',','.')?></b></td>
    	</tr>

    </table>
	 <h3>Ringkasan Belanja</h3>
	 <table width="50%" id="ss">
     		<tr>
     			<td>Total Harga Barang</td>
     			<td>Rp <?=number_format($subtot,2,',','.')?></td>
     		</tr>
     		<tr>
     			<td>Biaya Kirim</td>
     			<?php
     			$listpenjual = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart_penjual_id_tgl($id_pembeli,$id_tgl);
     			$nmpenj=$listpenjual->num_rows()*0	;
     			?>
     			<td>Rp <?=number_format($nmpenj,2,',','.')?></td>
     		</tr>
     		<tr>
     			<td><b>Total Belanja</b></td>
     			<td><b>Rp <?=number_format($nmpenj+$subtot,2,',','.')?></b></td>
     		</tr>
     	</table>
<br/>
<p align="center" class="visible-print-" ><img src="<?=base_url()?>/dist/img/ccopy.png" alt="" style="height: 50px; width: 200px" /></p>
<br/>
  
</body>
</html>
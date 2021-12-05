<html>
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
 <body onload="print()">
        
   <div id="kanan" class="page-header">
   <br/>
        <h3 align="center">TRANSAKSI</h3>
        <h4 align="center"> Bulan <?=$blnaray[$bln]?> <?=$thn?> </h4>
        </div>
<hr/>        
	
	
	
<table width="100%">
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
                    <th>Status Pekerjaan</th>
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
							$getpembeli='(*)'.$getuser->row()->nama;
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
					$getproduk=$gidp->nama_produk;
					}
                    
                    ////20180316
                    $rptra=$this->M_tranumat->get_rinciproduk_transaksi($gidp->id); ///jika r_produk ==1 mak mengunkan ini [tbl_transaksirinciproduk]
					  
				  	?>
					<tr >
                    <td><?=$no++?></td>
                     <td><?=$getpembeli?></td>
                     <td><?=$getpenjual?></td>
                    <td>
                     <?php
                    //echo $gidp->r_produk;
                    if($gidp->r_produk == 1)
                    {
                    if($rptra->num_rows() > 0){
                      foreach($rptra->result() as $vhas){
                          echo $vhas->n_produk  ;  
                          echo '<br/>';
                        }
                    }
                    
                    }else{
                    echo $getproduk;    
                    }
                    ?>
                    </td>
                    <td>
                    <?php
                    //echo $gidp->r_produk;
                    if($gidp->r_produk == 1)
                    {
                    if($rptra->num_rows() > 0){
                      foreach($rptra->result() as $vhas){
                          echo $vhas->j_produk  ;  
                          echo '<br/>';
                        }
                    }
                    
                    }else{
                    echo $gidp->qty;    
                    }
                    ?>
                    </td>
                    <td align="right">
                    <?php
                    /*if(empty($this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak)){
        			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->harga;	
        			}else{
        			$hrgasatuan= $this->Madmin->get_produk_by_id($gidp->id_produk)->row()->hargak;	
        			}
                    //*/
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
                  
                  			<b>Total Bulan <?=$blnaray[$gidp->bln]?> <?=$gidp->thn?></b>
                  	</td>
                  	<td colspan="5"  align="center">
                  			<b><?=number_format($totperbln,0,',','.')?> </b>                 	</td>
                  </tr>
                  
                  <?php
					
                  ?>
                                
                  </tbody>
                </table> 	
<br/>

<br/>
  
</body>
</html>
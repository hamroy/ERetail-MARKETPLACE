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
                  </tr>
               <!--<tr bgcolor="#e9e9e7">
                            <th>No.</th>
                            <th align="center" colspan="9">Status</th>
                            
                          </tr>-->
              </thead>
              <tbody>
                    <?php
                    if($sort==NULL or $sort=='a1'){
				  	$get_id_produk2=$this->Madmin_master->get_transaksi_nosort_job($bln,$thn);
                    $hst=1;  
				   }else{ ///status
				  	$get_id_produk2=$this->Madmin_master->get_transaksi_nosort_job_harga($bln,$thn);
                    $hst=1;  
				   }
                    
//===========================================GRUP STATUS PEKERJAAN==============================================

                    $gjob=$this->M_setapp->get_tbl_st_job_All();
                    $nost='A';
                    $akhir2=0;
                    foreach($gjob->result() as $jb){

                        ?>

                          <tr bgcolor="#e9e9e7">
                            <th><?=$nost++?></th>
                            <th align="center" colspan="9"><?=$jb->nama_job?></th>
                          </tr>
                      
                        <tr>
                            
                            <td colspan="10">
                               
                 
                 <table width="100%">
                  
                  <tbody>
                  
                 
                  <?php 
				   $no=1;
				   $totperbln=0;
				   $totperbln2=0;
                 if($sort==NULL or $sort=='a1'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_sort_job($bln,$thn,$jb->id_job);
                    $hst=1;  
				  }else{ ///status
				  	$get_id_produk=$this->Madmin_master->get_transaksi_sort_job_harga($bln,$thn,$jb->id_job);
                    $hst=1;  
				  }
                
                foreach($get_id_produk->result() as $gidp){
					
                    ////////REVrinci grupidpembeli
                     if($sort==NULL or $sort=='a1'){
                   $get_id_produk_rinci=$this->Madmin_master->get_transaksi_sort_job_rinci($bln,$thn,$jb->id_job,$gidp->id_user);    }else{
                   $get_id_produk_rinci=$this->Madmin_master->get_transaksi_sort_job_harga_rinci($bln,$thn,$jb->id_job,$gidp->id_user); 
                   }
                    ////////REVrinci grupidpembeli
                    	
					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
				  	
				  	if($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0){
					$getpembeli=$this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;	
					}else{
                        if($getuser->num_rows() > 0){
							$getpembeli='*'.$getuser->row()->nama;
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
                    <td><?=$getpembeli?> 
                    
                    </td>
                    
                    
                    <!---->
                    <?php
                    $s_qt=$this->Madmin_master->subtot_qty_idp($bln,$thn,$jb->id_job,$gidp->id_user,'1');
                    ?>
                    <?php
                    $akhirsat=$this->Madmin_master->subtot_qty_idp($bln,$thn,$jb->id_job,$gidp->id_user,'2');
                    ?>
                    <!---->
                    
                    <?php
                    //RINCI
                    if($get_id_produk_rinci->num_rows() > 0){
                    ?>
                    <td colspan="6"><span class="pull-left">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree<?=$gidp->id_user?>" aria-expanded="false" aria-controls="collapseThree">
                     Lihat Rinci
                    </a>
                    </span>
                    </td>
                    
                    <td colspan="2" align="right">
                     <?=$s_qt?>  ||
                    <?=number_format($akhirsat,0,',','.')?></td>
                    <?php
                    }
                    ?> 
                   
                  </tr>
                    
                    
                    
                  
                    <?php
                    //RINCI
                     if($get_id_produk_rinci->num_rows() > 0){
                    ?>
                     <tr>
                      <td></td>
                     </tr> 
                      <tr>
                      <td colspan="10">
                     <div id="collapseThree<?=$gidp->id_user?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body">
                      <table width="100%">
                      <?php
                     $nor='a';
                     
                     foreach($get_id_produk_rinci->result() as $gidp_r){
                          	
					$getuser=$this->Madmin_master->get_user_produk($gidp_r->id_user);	
                        if($getuser->num_rows() > 0){
							$getstjob= $this->M_setapp->get_tbl_st_job_id($getuser->row()->job)->row()->nama_job;
						}else{
							$getstjob='';
						}
						
                   
					
					if($this->Madmin_master->get_user_produk($gidp_r->id_pelapak)->num_rows() > 0){
					$getpenjual=$this->Madmin_master->get_user_produk($gidp_r->id_pelapak)->row()->nama;	
						
					}else{
					$getpenjual='';
					}
					if($this->Madmin_master->get_produk_produkid($gidp_r->id_produk)->num_rows() > 0){
					$getproduk=$this->Madmin_master->get_produk_produkid($gidp_r->id_produk)->row()->nama;	
						
					}else{
					$getproduk=$gidp_r->nama_produk;
					}
                    
                    if($gidp_r->offline==0){
                        $wrtd='';
                    }else{
                        $wrtd='danger';
                    }
                    
                    ////20180316
                    $rptra=$this->M_tranumat->get_rinciproduk_transaksi($gidp_r->id); ///jika r_produk ==1 mak mengunkan ini [tbl_transaksirinciproduk]
                         
                         ?>
                       
                           
                          <tr> 
                         
                    <td></td>
                    <td align="center" class="<?=$wrtd?>">[<?=$gidp_r->id?>] <?=$nor++?></td>
                    <td><?=$getpenjual?></td>
                   <!-- <td><?=$getproduk?></td>
                    <td><?=$gidp_r->qty?></td>-->
                    <td>
                     <?php
                    //echo $gidp->r_produk;
                    if($gidp_r->r_produk == 1)
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
                    if($gidp_r->r_produk == 1)
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
                   /* if(empty($this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak)){
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->harga;	
        			}else{
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak;	
        			}
                    //*/
        			if($gidp_r->harga_satuan!=0){
        				$akhirsat_r=$gidp_r->harga_satuan;
        			}else{
        				$akhirsat_r=$hrgasatuan_r;
        			}    
                    ?>
                    <?=number_format($akhirsat_r,0,',','.')?></td>
                    <td align="right"><?=number_format($akhirsat_r*$gidp_r->qty,0,',','.')?></td>
                    <td><?=$gidp_r->tgl_trans?></td>
                    <td><?=$gidp_r->tgl_otorisasi?></td>
                    <td><?=$gidp_r->metode?></td> 
                        
                   
                        </tr>
                          
                 
                         <?php
                         }
                         }
                         
                    ///////////RINCI DARI GRUP ID PEMBELI     
                    
                    ?> 
                     </table>
                      </div>
                    </div>    
                        </td>
                               
                        
                        </tr>
                   
                  
				<?php	
					$totperbln=$totperbln+($akhirsat);
					}
                  ////di susun perbulan
                  ?>
 
<!--========================================================================================================-->                  
                  <!--JIKA STATUS MAKA SISANYA YANG TUNAI TANPA LOGIn DI BUAT PALING BAWAH-->
                  <?php 
                 
                  ////////////////
                  $akhir=$totperbln;
                  ////////////////
                  
                  ?>
                  
                  <!--JIKA STATUS MAKA SISANYA YANG TUNAI TANPA LOGIn DI BUAT PALING BAWAH-->
                  
                  
                  <!--TOATAL UNIT-->
                  <tr style="background-color: #b3b3b9">
                  	<td colspan="8" align="right">
                  
                  			<b>Total Status  <?=$jb->nama_job?></b>
                  	</td>
                  	<td colspan="2"  align="center">
                  			<b><?=number_format($akhir,0,',','.')?> </b>                 	</td>
                  </tr>
                  
                 
                 
                  
                  <!---->
                  
                                
                  </tbody>

                  </table>   
                    </td>
                            
                        </tr>
                        
                    <?php
                        
                    $akhir2=$akhir2+$akhir;
    
                    }
                        
                    ?>
                    <!--TRANSAKSI GA PAKE LOGIN-->
                    
                    <tr bgcolor="#e9e9e7">
                            <th><?=$nost?></th>
                            <th align="center" colspan="9">Kosong</th>
                          </tr>
                    
                     <tr>
                            <td colspan="10">
                               <table class="table no-margin">
                  
                  <tbody>
                  
                 
                  <?php 
///=============================================================================================================================================================================================================================================================================================================================================================================================================================================================				  
                ////////////////////TUNAI GA LOGIN
                foreach($get_id_produk2->result() as $gidp){
				    ////////REVrinci grupidpembeli
                     if($sort==NULL or $sort=='a1'){
                   $get_id_produk_rinci=$this->Madmin_master->get_transaksi_nosort_job_sr1_rinci($bln,$thn,$gidp->id_pembeli);    }else{
                   $get_id_produk_rinci=$this->Madmin_master->get_transaksi_nosort_job_sr1_rinci_hrg($bln,$thn,$gidp->id_pembeli); 
                   }
                    ////////REVrinci grupidpembeli
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
					$getproduk='';
					}
					  
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><?=$getpembeli?></td>
                    
                    
                    <!---->
                    <?php
                    $s_qt=$this->Madmin_master->subtot_qty_idp_nologin($bln,$thn,$gidp->id_pembeli,'1');
                    ?>
                    <?php
                    $akhirsat2=$this->Madmin_master->subtot_qty_idp_nologin($bln,$thn,$gidp->id_pembeli,'2');
                    ?>
                    <!---->
                    
                    <?php
                    //RINCI TUNAI NO LOGIn
                     if($get_id_produk_rinci->num_rows() > 0)
                    {
                    ?>
                    <td colspan="6"><span class="pull-left">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#nologin<?=$gidp->id_pembeli?>" aria-expanded="false" aria-controls="collapseThree">
                     Lihat Rinci
                    </a>
                    </span>
                    </td>
                    <td colspan="2" align="right">
                     <?=$s_qt?>  ||
                    <?=number_format($akhirsat2,0,',','.')?></td>
                    <?php
                    }
                    ?> 
                   
                  </tr>
                   
                   <?php
                    //RINCI
                     if($get_id_produk_rinci->num_rows() > 0){
                    ?>
                     <tr>
                      <td></td>
                     </tr> 
                     <tr>
                      <td colspan="10">
                     <div id="nologin<?=$gidp->id_pembeli?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                      <div class="panel-body">
                      <table width="100%">
                      <?php
                    $nor='a';
                     
                     foreach($get_id_produk_rinci->result() as $gidp_r){
                          	
					$getuser=$this->Madmin_master->get_user_produk($gidp_r->id_user);	
                        if($getuser->num_rows() > 0){
							$getstjob= $this->M_setapp->get_tbl_st_job_id($getuser->row()->job)->row()->nama_job;
						}else{
							$getstjob='';
						}
						
                   
					
					if($this->Madmin_master->get_user_produk($gidp_r->id_pelapak)->num_rows() > 0){
					$getpenjual=$this->Madmin_master->get_user_produk($gidp_r->id_pelapak)->row()->nama;	
						
					}else{
					$getpenjual='';
					}
					if($this->Madmin_master->get_produk_produkid($gidp_r->id_produk)->num_rows() > 0){
					$getproduk=$this->Madmin_master->get_produk_produkid($gidp_r->id_produk)->row()->nama;	
						
					}else{
					$getproduk='';
					}
                         
                         ?>
                        <tr> 
                        <td></td>
                    <td align="center">[<?=$gidp_r->id?>]<?=$nor++?></td>
                    <td><?=$getpenjual?></td>
                    <td><?=$getproduk?></td>
                    <td><?=$gidp_r->qty?></td>
                    <td align="right">
                    <?php
                    /*if(empty($this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak)){
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->harga;	
        			}else{
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak;	
        			}
                    ///*/
        			if($gidp_r->harga_satuan!=0){
        				$akhirsat_r=$gidp_r->harga_satuan;
        			}else{
        				$akhirsat_r=$hrgasatuan_r;
        			}    
                    ?>
                    <?=number_format($akhirsat_r,0,',','.')?></td>
                    <td align="right"><?=number_format($akhirsat_r*$gidp_r->qty,0,',','.')?></td>
                    <td><?=$gidp_r->tgl_trans?></td>
                    <td><?=$gidp_r->tgl_otorisasi?></td>
                    <td><?=$gidp_r->metode?></td> 
                        </tr>
                         <?php
                         }
                         }
                         
                         
                    ///////////RINCI DARI GRUP ID PEMBELI     
                    
                    ?> 
                     </table>
                      </div>
                    </div>    
                        </td>
                               
                        
                        </tr>
                    <?php
                     
                    ///////////RINCI DARI GRUP ID PEMBELI     
                    
                    ?>  
                   
				<?php	
					$totperbln2=$totperbln2+($akhirsat2);
					}
                  ////di susun perbulan
                  ?>
 
<!--========================================================================================================-->                  
                  <!--JIKA STATUS MAKA SISANYA YANG TUNAI TANPA LOGIn DI BUAT PALING BAWAH-->
                  <?php 
                 
                  ////////////////
                  $akhir=$totperbln2;
                  ////////////////
                  
                  ?>
                  
                  <!--JIKA STATUS MAKA SISANYA YANG TUNAI TANPA LOGIn DI BUAT PALING BAWAH-->
                  
                  
                  <!--TOATAL UNIT-->
                  <tr width="100%" style="background-color: #b3b3b9">
                  	<td colspan="8" align="right">
                  
                  			<b>Total Status  kosong</b>
                  	</td>
                  	<td colspan="2"  align="center">
                  			<b><?=number_format($akhir,0,',','.')?> </b>                 	</td>
                  </tr>
                  
                 
                 
                  
                  <!---->
                  
                                
                  </tbody>
                  </table>   
                            </td>
                        </tr>
                    <!--TRANSAKSI GA PAKE LOGIN-->
                    <!--TOATAL TTOTAL-->
                    <?php
                    $akhir3=$akhir2+$akhir;
                    ?>
                  <tr style="background-color: #b3b3b9">
                  	<td colspan="8" align="right">
                  
                  			<b>Total Bulan <?=$blnaray[$bln]?> <?=$gidp->thn?></b>
                  	</td>
                  	<td colspan="2"  align="center">
                  			<b><?=number_format($akhir3,0,',','.')?> </b>                 	
                              ||<?=$akhir2?>||<?=$akhir?>
                    </td>
                  </tr>
                  
              </tbody>
              </table>
<br/>

<br/>
  
</body>
</html>
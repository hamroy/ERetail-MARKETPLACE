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
                    
                    ///20180125
                    $hst=0;
                    ///20180125
                    
                    
                 
				  ///16/5/17
				  
                  $totbln=$this->Madmin_master->total_tanpa_sort($bln,$thn);
                  	
                  	?>
    <section class="content">
    
    <div class="well" align="center">
        <h3><b>Bulan <?=$blnaray[$bln]?> <?=$thn?></b> <br/> [Rp <?=number_format($totbln,0,',','.')?>]</h3>
        
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
                  </tr>
               <!--<tr bgcolor="#e9e9e7">
                            <th>No.</th>
                            <th align="center" colspan="9">Status</th>
                            
                          </tr>-->
              </thead>
              <tbody>
                    <?php
//===========================================GRUP STATUS PEKERJAAN================================================
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
                               <table class="table no-margin">
                  
                  <tbody>
                  
                 
                  <?php 
				   $no=1;
				   $totperbln=0;
				   $totperbln2=0;
                 if($sort==NULL or $sort=='a1'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_sort_job($bln,$thn,$jb->id_job);
				  	
				  	$get_id_produk2=$this->Madmin_master->get_transaksi_nosort_job($bln,$thn);
                    $hst=1;  
				  }else{ ///status
				  	$get_id_produk=$this->Madmin_master->get_transaksi_sort_job_harga($bln,$thn,$jb->id_job);
				  	$get_id_produk2=$this->Madmin_master->get_transaksi_nosort_job_harga($bln,$thn);
                    $hst=1;  
				  }
                
                foreach($get_id_produk->result() as $gidp){
					
                    ////////REVrinci grupidpembeli
                     if($sort==NULL or $sort=='a1'){
                   $get_id_produk_rinci=$this->Madmin_master->get_transaksi_sort_job_rinci($bln,$thn,$jb->id_job,$gidp->id_pembeli);    }else{
                   $get_id_produk_rinci=$this->Madmin_master->get_transaksi_sort_job_harga_rinci($bln,$thn,$jb->id_job,$gidp->id_pembeli); 
                   }
                    ////////REVrinci grupidpembeli
                    	
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
                    
                    
                    <!---->
                    <?php
                    $s_qt=$this->Madmin_master->subtot_qty_idp($bln,$thn,$jb->id_job,$gidp->id_pembeli,'1');
                    ?>
                    <?php
                    $akhirsat=$this->Madmin_master->subtot_qty_idp($bln,$thn,$jb->id_job,$gidp->id_pembeli,'2');
                    ?>
                    <!---->
                    
                    <?php
                    //RINCI
                     if($get_id_produk_rinci->num_rows() > 1){
                    ?>
                    <td colspan="6"></td>
                    <td colspan="2" align="right">
                     <?=$s_qt?>  ||
                    <?=number_format($akhirsat,0,',','.')?></td>
                    <?php
                    }else{
                    ?>
                    <td><?=$getpenjual?></td>
                    <td><?=$getproduk?></td>
                    <td><?=$s_qt?></td>
                    <td align="right">
                    <?=number_format($akhirsat,0,',','.')?></td>
                    <td align="right"><?=number_format($akhirsat,0,',','.')?></td>
                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>
                    <td><?=$gidp->metode?></td>
                    <?php
                    }
                    ?> 
                   
                  </tr>
                  
                  
                    <?php
                    //RINCI
                     if($get_id_produk_rinci->num_rows() > 1){
                    ?>
                     <tr>
                      <td></td>
                     </tr> 
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
                    <td align="center"><?=$nor++?></td>
                    <td><?=$getpenjual?></td>
                    <td><?=$getproduk?></td>
                    <td><?=$gidp_r->qty?></td>
                    <td align="right">
                    <?php
                    if(empty($this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak)){
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->harga;	
        			}else{
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak;	
        			}
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
                  
				<?php	
					$totperbln=$totperbln+($akhirsat);
					}
                  ////di susun perbulan
                  ?>
 
<!--========================================================================================================-->                  
                  <!--JIKA STATUS MAKA SISANYA YANG TUNAI TANPA LOGIn DI BUAT PALING BAWAH-->
                  <?php 
                 
                  ////////////////
                  $akhir=$totperbln+$totperbln2;
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
				  
                
                foreach($get_id_produk2->result() as $gidp){
						
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
                     
                   
                   </tr>  
                   
                   <?php
                    //RINCI
                     if($get_id_produk_rinci->num_rows() > 1){
                    ?>
                     <tr>
                      <td></td>
                     </tr> 
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
                    <td align="center"><?=$nor++?></td>
                    <td><?=$getpenjual?></td>
                    <td><?=$getproduk?></td>
                    <td><?=$gidp_r->qty?></td>
                    <td align="right">
                    <?php
                    if(empty($this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak)){
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->harga;	
        			}else{
        			$hrgasatuan_r= $this->Madmin->get_produk_by_id($gidp_r->id_produk)->row()->hargak;	
        			}
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
                   
				<?php	
					$totperbln2=$totperbln2+($akhirsat*$gidp->qty);
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
                  <tr style="background-color: #b3b3b9">
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
                    </td>
                  </tr>
                  
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
    
   
   
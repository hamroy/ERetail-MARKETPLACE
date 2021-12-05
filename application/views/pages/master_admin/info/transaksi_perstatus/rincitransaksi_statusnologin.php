<div class="box box-info">
            <div class="box-header with-border">

             
            <!-- /.box-header -->
            <div class="box-body">
            
              	
<br/>            
              <div class="table-responsive">
             
             
                  
                  
              <table class="table no-margin">
             

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

                    
                    $gjob=$this->M_setapp->get_tbl_st_job_id($stget); //perstatus
                    
                    ///
                    
                    $nost='A';
                    $no=1;
                    $akhir2=0;
                    $totperbln2=0;
                    ?>
                    
                    <!--TRANSAKSI GA PAKE LOGIN-->
                    
                    <tr bgcolor="#e9e9e7">
                            <th>STATUS</th>
                            <th align="right" colspan="9"><span class="pull-right"><b>Kosong/Tidak Login </b></span></th>
                          </tr>
                    
                     <tr>
                            <td colspan="10">
                            <table class="table no-margin">

                   <thead>
                   <tr bgcolor="#b7bdb8">
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        
                        
                        <th colspan="9" align="right"><span class="pull-right"><b>Total Kuantitas || Jumlah </b></span></th>
                        
                      </tr>
                 
                  </thead>
                  
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
                    <td><?=$no++?>. <?=$gidp->id?></td>
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
                      <table class="table">

                       <thead>
                     <tr bgcolor="#b7bdb8">
                          <th>No</th>
                          <th>Nama Penjual</th>
                          <th>Produk</th>
                          <th>Kuantitas</th>
                          <th>Harga Satuan</th>
                          <th>Jumlah</th>
                          <th>Tanggal Pesan</th>
                          <th>Tanggal Selesai</th>
                          <th>Pembayaran</th>
                          
                        </tr>
                   
                    </thead>


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
                     
                    <td align="center"><?=$nor++?></td>
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
                  <tr style="background-color: #b3b3b9">
                  	<td colspan="8" align="right">
                  
                  			<b>Total Status Kosong /Tidak Login</b>
                  	</td>
                  	<td colspan="2"  align="right">
                  			<b><?=number_format($akhir,0,',','.')?> </b>                 	</td>
                  </tr>
                  
                 
                 
                  
                  <!---->
                  
                                
                  </tbody>
                  </table>   
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
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
                    $akhir2=0;
                    foreach($gjob->result() as $jb){

                        ?>

                          <tr bgcolor="#e9e9e7">
                            <th><?=$nost++?>. STATUS</th>
                            <th align="center" colspan="9"><span class="pull-right"><b><?=$jb->nama_job?></b></span></th>
                          </tr>
                      
                        <tr>
                            
                            <td colspan="10">
                               
                 
                 <table class="table no-margin">

                  <thead>
               <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Nama Pembeli (NBM)</th>
                    
                    
                    <th colspan="9" align="right"><span class="pull-right"><b>Total Kuantitas || Jumlah </b></span></th>
                    
                  </tr>
             
              </thead>
                  
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
          $getpembeli='pembeli kosong';
          $getpnbm=0;
				  
          if($getuser->num_rows() > 0){
              $getpembeli='*'.$getuser->row()->nama;
              $getpnbm=$getuser->row()->nbm;
          }

				  if($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0){
					$getpembeli=$this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;	
		
          }
          
          $getstjob='';          
          if($getuser->num_rows() > 0){
							$getstjob= $this->M_setapp->get_tbl_st_job_id($getuser->row()->job)->row()->nama_job;
					}
						
                   
					$getpenjual='';
					if($this->Madmin_master->get_user_produk($gidp->id_pelapak)->num_rows() > 0){
					$getpenjual=$this->Madmin_master->get_user_produk($gidp->id_pelapak)->row()->nama;	
						
					}
					
          $getproduk='';
          if($this->Madmin_master->get_produk_produkid($gidp->id_produk)->num_rows() > 0){
					$getproduk=$this->Madmin_master->get_produk_produkid($gidp->id_produk)->row()->nama;	
						
					}


                    
					  
				  ?>

          
                  
					<tr >
                    <td><?=$no++?></td>
                    <td><?=$getpembeli?> (<?=$getpnbm?>) 
                    
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
                    <td colspan="6">
                    <span class="pull-left">
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
                      <td colspan="10">
                    <div id="collapseThree<?=$gidp->id_user?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
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
                          <?php

                          if ($stget <= 3 or $stget==1001) {
                            $macc="Status (NIP/NIM)";
                          } elseif ($stget==4) {
                            $macc="";
                          }
                          else {
                            $macc="ACC MEK";
                          }
                          

                          ?>

                          <th><?=$macc?></th>

                        </tr>
                   
                    </thead>


                      <?php
                     $nor='a';
                     
                    foreach($get_id_produk_rinci->result() as $gidp_r){
                          	
          					$getuser=$this->Madmin_master->get_user_produk($gidp_r->id_user);	
                      
                    $getstjob='';
                    if($getuser->num_rows() > 0){
          							$getstjob= $this->M_setapp->get_tbl_st_job_id($getuser->row()->job)->row()->nama_job;
          					}
                             
          					$getpenjual='';
                    $getpenjualjob='';
                    $getnipenjual='';
                    $getdtpenjual=$this->Madmin_master->get_user_produk($gidp_r->id_pelapak);
          					if($getdtpenjual->num_rows() > 0){
          					$getpenjual=$this->Madmin_master->get_user_produk($gidp_r->id_pelapak)->row()->nama;	
                    $getpenjualjob= $this->M_setapp->get_tbl_st_job_id($getdtpenjual->row()->job)->row()->nama_job;
                    $getnipenjual=$getdtpenjual->row()->ni;
          						
          					}
          					
                    $getproduk=$gidp_r->nama_produk;
                    if($this->Madmin_master->get_produk_produkid($gidp_r->id_produk)->num_rows() > 0){
          					$getproduk=$this->Madmin_master->get_produk_produkid($gidp_r->id_produk)->row()->nama;	
          						
          					}

                    $wrtd='danger';
                    if($gidp_r->offline==0){
                        $wrtd='';
                    }
                    
                    ////20180316
                    $rptra=$this->M_tranumat->get_rinciproduk_transaksi($gidp_r->id); ///jika r_produk ==1 mak mengunkan ini [tbl_transaksirinciproduk]
                    ///201812 get_rinciproduk_transaksi
                    $rctra=$this->M_tranumat->get_rinciproduk_idtra($gidp_r->id);
                         
                    ?>
                      
                   
                           
                    <tr> 
                         

                    <td align="center" class="<?=$wrtd?>"><?=$nor++?>.</td>
                    <td><?=$getpenjual?></td>
                   <!-- <td><?=$getproduk?></td>
                    <td><?=$gidp_r->qty?></td>-->
                    <td>
                     <?php
                    //echo $gidp->r_produk;
                    if($gidp_r->offline == 1)
                    {
                    if($rctra->num_rows() > 0){
                      echo $rctra->row()->n_produk  ;  
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
                    echo $gidp_r->qty;    
                    }
                    ?>
                    </td>
                    <!--HARGA SATUAN-->
                     <td align="right">
                    <?php
                    //echo $gidp->r_produk;
                    if($gidp_r->harga_satuan!=0){
        				$akhirsat_r=$gidp_r->harga_satuan;
        			}else{
        				$akhirsat_r=$hrgasatuan_r;
        			} 
                    
                    if($gidp_r->r_produk == 1)
                    {
                    if($rptra->num_rows() > 0){
                      foreach($rptra->result() as $vhas){
                          echo $vhas->h_produk  ;  
                          echo '<br/>';
                        }
                    }
                    
                    }else{
                   
                    echo number_format($akhirsat_r,0,',','.');    
                    }
                    ?>
                    </td>
                   
                    <td align="right"><?=number_format($akhirsat_r*$gidp_r->qty,0,',','.')?></td>
                    <td><?=$gidp_r->tgl_trans?></td>
                    <td><?=$gidp_r->tgl_otorisasi?></td>
                    <td><?=$gidp_r->metode?></td> 
                   
                    <td>
                      <?php
                      if ($stget <= 3 or $stget==1001) {
                            echo $getpenjualjob .'<BR />

                            ('.$getnipenjual.')

                            ';
                          } elseif ($stget==4) {
                           
                          }
                          else {
                            $getaccmek=$this->Madmin_master->get_tblaccmek($gidp_r->id);
                    
                              if($getaccmek->num_rows() >0){

                              echo ' <span style="color: #23e718" class="glyphicon glyphicon-ok"></span>';

                              }

                          }

                      
                      ?>

                    </td>

                        
                   
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
                  	<td colspan="2"  align="right">
                  			<b><?=number_format($akhir,0,',','.')?> </b>                 	</td>
                  </tr>
                  
                 
                 
                  
                  <!---->
                  
                                
                  </tbody>

                  </table>   
                    </td>
                            
                        </tr>
                        
                    <?php
                        
    
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
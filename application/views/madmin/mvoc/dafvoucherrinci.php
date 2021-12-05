    <!-- Main content -->
     <?php
          /////==========================================================================GET
           	 $g_id=$this->Muser->get_id_pass_nos($id_user);
          /////==========================================================================GET
      ?>


    <section class="content">
      <div class="row">
      
      <?php

    $jvoc=$this->db->get('tbl_jenis_voc');
    	
     foreach ($jvoc->result_array() as $key) {
      if($g_id->row()->job==3){
      if($key['id_jen_voc']!=3){
          continue;
          }
      }else{
          if($key['id_jen_voc']==3){
          continue;
          }
      }
      
      ////////////////
      $gvall=$this->M_gvocall->gvall($key['id_jen_voc'],$id_user);
      ///////////////
      
      ////////////////
      $gid_voc='id_voc';
      if($key['id_jen_voc']==1){
          $gid_voc='id_voc_p';
      }elseif($key['id_jen_voc']==2){
          $gid_voc='id_voc_song';
      }elseif($key['id_jen_voc']==3){
          $gid_voc='id_voc_mhs';
      }
      ///////////////
      
      $trinci=isset($gvall['t_rinci'])==NULL?'':$gvall['t_rinci'];
       
       ?>
      <div class="col-md-12">
         
          <div class="box box-primary">

            <div class="box-body">
              <h3 >VOUCHER <?=$key['nama_jvoc']?></h3>
              <div class="table-responsive">
              <table class="table table-striped">
            	<tr>
            		<td>SALDO</td>
            		<td>SALDO DIBELANJAKAN</td>
            		<td>PENDAPATAN</td>
            		<td>SISA PENDAPATAN</td>
            		<td>REDEEM</td>
            		<td>REDEEM SELESAI</td>
            	</tr>
            	<tr>
            		<td>
                     <a data-toggle="collapse" data-parent="#accordion" href="#s_<?=$key['id_jen_voc']?>">
                       <?=number_format($gvall['saldo'],0,',','.')?>
                    </a>
                   </td>
                   <td>
                     <a data-toggle="collapse" data-parent="#accordion" href="#sd_<?=$key['id_jen_voc']?>">
                       <?=number_format($gvall['saldo_dibelanjakan'],0,',','.')?>
                    </a>
                   </td>
                   <td>
                     <a data-toggle="collapse" data-parent="#accordion" href="#d_<?=$key['id_jen_voc']?>">
                      <?=number_format($gvall['dompet'],0,',','.')?>
                    </a>
                   </td>
                    <td>
                     <a data-toggle="collapse" data-parent="#accordion" href="#d_<?=$key['id_jen_voc']?>">
                      <?=number_format($gvall['dompet_selesai'],0,',','.')?>
                    </a>
                   </td>
                   <td>
                     <a data-toggle="collapse" data-parent="#accordion" href="#r_<?=$key['id_jen_voc']?>">
                      <?=number_format($gvall['redeem'],0,',','.')?>
                    </a>
                   </td>
                   <td>
                     <a data-toggle="collapse" data-parent="#accordion" href="#rs_<?=$key['id_jen_voc']?>">
                      <?=number_format($gvall['redeemSelesai'],0,',','.')?>
                    </a>
                   </td>
            	</tr>
                <tr>
                    <td colspan="6">
                        
                        <div class="panel-group" id="accordion">
                        <!--RINCI PESAN VOUCHER-->
                        <div class="panel panel-default">
                           <div id="s_<?=$key['id_jen_voc']?>" class="panel-collapse collapse">
                              <div class="panel-body">
                                
                                <table class="table table-striped">
                                	<tr>
                                		<td colspan="4">RINCI SALDO VOUCHER</td>
                                	</tr>
                                    <tr>
                                		<td>Edisi</td>
                                		<td>Tgl pesan</td>
                                		<td>Tgl terima</td>
                                		<td>Saldo</td>
                                	</tr>
                                    <?php
                                    ///get voucher 
                                    $gtpvoc=$this->M_gvocall->voucherPesan($key['id_jen_voc'],$id_user);
                                    if($gtpvoc->num_rows() > 0){
                                    foreach($gtpvoc->result_array() as $vp){
                                        ?>
                                        <tr>
                                		<td><?=$vp[$gid_voc]?></td>
                                		<td><?=$vp['tanggal_p']?></td>
                                		<td><?=$vp['tanggal_acc']?></td>
                                		<td><?=$vp['saldo_awal']?></td>
                                	</tr>
                                        <?php
                                        
                                    }
                                    }
                                    ?>
                                    
                                	
                                    
                                </table>
                                                                
                              </div>
                            </div>
                        </div>
                        <!--VOUCHER DIBELAJAKAN-->
                        <div class="panel panel-default">
                            <div id="sd_<?=$key['id_jen_voc']?>" class="panel-collapse collapse">
                              <div class="panel-body">
                                 <table class="table table-striped">
                                	<tr>
                                    <tr>
                                		<td colspan="5">RINCI SALDO DIBELANJAKAN VOUCHER</td>
                                	</tr>
                                		<td>No. </td>
                                		<td>Tgl pesan</td>
                                		<td>Id Produk</td>
                                		<td>Qty|harga</td>
                                		<td>Total</td>
                                	</tr>
                                    <?php
                                    /////get transaksi voucher dibelanjakan
                                    $tvbelaja=$this->M_gvocall->trans_pvoc($key['id_jen_voc'],$id_user,1); ///1=dipesan
                                    
                                    if($tvbelaja->num_rows() > 0){
                                        foreach($tvbelaja->result_array()as$vpb){
                                            ?>
                                            <tr>
                                        		<td><?=$vpb['id']?></td>
                                        		<td><?=$vpb['tgl_trans']?></td>
                                        		<td><a  target="_blank" href="<?=base_url('C_user_admin/rinciproduk/'.$vpb['id_produk'])?>"><?=$vpb['id_produk']?></a></td>
                                        		<td><?=$vpb['qty']?> | <?=$vpb['harga_satuan']?></td>
                                        		<td><?=$vpb['qty']*$vpb['harga_satuan']?></td>
                                        	</tr>
                                            <?php
                                        }
                                    }
                                    
                                    ?>
                                	
                                </table>
                              </div>
                            </div>
                        </div>
                        <!--RINCI PENDAPATAN-->
                        <div class="panel panel-default">
                            <div id="d_<?=$key['id_jen_voc']?>" class="panel-collapse collapse">
                            <div class="panel-body">
                               <table class="table table-striped">
                                	<tr>
                                    <tr>
                                		<td colspan="5">RINCI SALDO PENDAPATAN VOUCHER</td>
                                	</tr>
                                		<td>No. </td>
                                		<td>Pembeli</td>
                                		<td>Id Produk</td>
                                        <td>Tgl Transaksi</td>
                                		<td>Qty|harga</td>
                                		<td>Total</td>
                                	</tr>
                                     <?php
                                    /////get transaksi
                                    $tpendaptan=$this->M_gvocall->trans_pendapatanvoc($key['id_jen_voc'],$id_user,2); ///2=dibayar
                                    
                                    if($tpendaptan->num_rows() > 0){
                                        $totpjv=0;
                                        foreach($tpendaptan->result_array()as$vpend){
                                            ?>
                                            <tr>
                                        		<td><?=$vpend['id']?></td>
                                        		
                                        		<td>
                                                <?php
                                                $nm=$vpend['id_user'];
                                                if($vpend['nama_pembeli']!=NULL){
                                                    $nm=$vpend['nama_pembeli'];
                                                }
                                                ?>
                                                <a target="_blank" href="<?=base_url('C_dompet/sett_voc/'.$vpend['id_user'])?>"><?=$vpend['nama_pembeli']?></a></td>
                                        		<td><a target="_blank" href="<?=base_url('C_user_admin/rinciproduk/'.$vpend['id_produk'])?>"><?=$vpend['id_produk']?></a></td>
                                                <td><?=$vpend['tgl_trans']?></td>
                                        		<td><?=$vpend['qty']?> | <?=$vpend['harga_satuan']?></td>
                                        		<td><?=$vpend['qty']*$vpend['harga_satuan']?></td>
                                        	</tr>
                                            
                                            <?php
                                             $totpjv=$totpjv+($vpend['qty']*$vpend['harga_satuan']);
                                        }
                                        
                                    }
                                    
                                    ?>
                                	<tr>
                                		<td colspan="5" align="right">TOTAL</td>
                                		<td><?=$totpjv?></td>
                                	</tr>
                                </table>
                              </div>
                            </div>
                        </div>
                        <!--RINCI REDEEM-->
                        <div class="panel panel-default">
                            <div id="r_<?=$key['id_jen_voc']?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table table-striped">
                                	<tr>
                                    <tr>
                                		<td colspan="4">RINCI REDEEM VOUCHER</td>
                                	</tr>
                                		<td>No. </td>
                                		<td>Tgl redeem</td>
                                		<td>Redeem</td>
                                	</tr>
                                     <?php
                                    /////get transaksi voucher dibelanjakan
                                    $rvoucher=$this->M_gvocall->redeem_pvoc($key['id_jen_voc'],$id_user,0); ///0=redeem
                                    
                                    if($rvoucher->num_rows() > 0){
                                        $totredjvoc=0;
                                        foreach($rvoucher->result_array()as$rv){
                                            ?>
                                            <tr>
                                        		<td><?=$rv['id']?></td>
                                        		<td><?=$rv['tgl_trans']?></td>
                                        		<td><?=$rv['redeem']?> </td>
                                        	</tr>
                                            <?php
                                        $totredjvoc=$totredjvoc+($rv['redeem']);
                                        }
                                    }
                                    
                                    ?>
                                	<tr>
                                		<td colspan="3">TOTAL</td>
                                		<td><?=$totredjvoc?></td>
                                	</tr>
                                </table>
                              </div>
                            </div>
                        </div>
                        <!--RINCI REDEEM SELESAI-->
                        <div class="panel panel-default">
                            <div id="rs_<?=$key['id_jen_voc']?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table table-striped">
                                	<tr>
                                    <tr>
                                		<td colspan="5">REDEEM SELESAI VOUCHER MAKAN</td>
                                	</tr>
                                		<td>No. </td>
                                		<td>Tgl Redeem</td>
                                		<td>Tgl Otorisasi</td>
                                		<td>Redeem</td>
                                	</tr>
                                	  <?php
                                    /////get transaksi voucher dibelanjakan
                                    $rvouchers=$this->M_gvocall->redeem_pvoc($key['id_jen_voc'],$id_user,1); ///1=selesai
                                    
                                    if($rvouchers->num_rows() > 0){
                                        $totredjvocs=0;
                                        foreach($rvouchers->result_array()as$rv){
                                            ?>
                                            <tr>
                                        		<td><?=$rv['id']?></td>
                                        		<td><?=$rv['tgl_trans']?></td>
                                        		<td><?=$rv['tgl_oto']?></td>
                                        		<td><?=$rv['redeem']?> </td>
                                        	</tr>
                                            <?php
                                        $totredjvocs=$totredjvocs+($rv['redeem']);
                                        }
                                    }
                                    
                                    ?>
                                	<tr>
                                		<td colspan="3">TOTAL</td>
                                		<td><?=$totredjvocs?></td>
                                	</tr>
                                </table>
                              </div>
                            </div>
                        </div>
 
                        </div>
                            
                    </td>
                </tr>
            </table>
              </div>
            </div>
          </div>

        </div>
     
       <?php
     }
        
     ?>
    
       
        

      </div>


    </section>	

    

<?php
 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=download_rekapBelanja.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>        
   <div>
  
        <h3 align="center">REKAP TRANSAKSI PEMBELI</h3>
        <h4 align="center"><?=$d['statusP']?> <?=$d['statprodi']?></h4>
        <h5 align="center"><?=$d['thn']?> <?=$d['bln']?> <?=$d['tgl']?> </h5>
        </div>

<table width="100%" border="1">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>

                    <th>Nama Pembeli</th>
                    <th>NBM</th>
                    <th>Belanja Tunai</th>
                    <th>Belanja Voucher</th>
                    <th>Belanja Transfer</th>
                    <th>Total Belanja</th>


                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  // $get_all_id_produk=$this->M_belanja->get_listAkun();

                  $totalpAkun=0;

                  if($get_all_id_produk->num_rows() > 0){

                  $no=0;
                  

                  foreach($get_all_id_produk->result() as $gidp0){ 

                  $getpendapatanT=$this->M_belanja->get_BelanjaPembeli($gidp0->id_user,'TUNAI');
                  $getpendapatanV=$this->M_belanja->get_BelanjaPembeli($gidp0->id_user,'VOUCHER');
                  $getpendapatanF=$this->M_belanja->get_BelanjaPembeli($gidp0->id_user,'TRANSFER');

                  ?>

                    <tr>

                    <td><?=++$no?></td>

                    <td>
                     <?=$gidp0->nama?>
                    </td>
                    <td>
                     <?=$gidp0->nbm?>
                    </td>
                    <td align="right">
                     <?=$getpendapatanT?> 
                    </td>
                    <td align="right">
                     <?=$getpendapatanV?> 
                    </td>
                    <td align="right">
                     <?=$getpendapatanF?> 
                    </td>
                    <td align="right">
                     <?php $totpAkun=$getpendapatanF+$getpendapatanV+$getpendapatanT;
                      echo $totpAkun;
                      $totalpAkun=$totalpAkun+$totpAkun;
                     ?>
                    </td>

                  </tr>
                  
                  <?php 
                  
                      }
                      }

                  ?>

                </tbody>

                <div class="well" style="font-family: number">
                  <h4>
                    TOTAL : Rp <?=number_format($totalpAkun,0,',','.')?> 
                    
                  </h4>
                
                </div>

                </table>
	
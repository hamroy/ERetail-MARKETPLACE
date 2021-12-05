<?php
 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=download_rekapProdukKategori".$_GET['nkat'].".xls");

header("Pragma: no-cache");

header("Expires: 0");

?>        
   <div>
  
        <h3 align="center">REKAP PRODUK</h3>
        <h3 align="center">KATEGORI <?=strtoupper($_GET['nkat'])?></h3>
        <h5 align="center"><?=$d['thn']?> <?=$d['bln']?> <?=$d['tgl']?> </h5>
        </div>

<table width="100%" border="1">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Penjual</th>
                    <th>Total</th>
                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  
                  $totalpAkun=0;
                  $no=0;
                  $to=0;
                  if($get_all_id_produk->num_rows() > 0){
                  foreach($get_all_id_produk->result() as $gidp0){ 


                  ?>
                  <tr>
                    <td><?=++$no?></td>
                    <td>
                     <?=$gidp0->nama?>
                    </td>
                    
                    <td>
                     <?=$gidp0->sqty?>
                    </td>
                  </tr>
                  
                  <?php 
                  $to=$to+$gidp0->sqty;
                      }
                      }
                  ?>


                </tbody>

                <div class="well" style="font-family: number">
                  <h4>
                    TOTAL : <?=$no?> Penjual  <?=$to?> Qty
                    
                  </h4>
                
                </div>

                </table>
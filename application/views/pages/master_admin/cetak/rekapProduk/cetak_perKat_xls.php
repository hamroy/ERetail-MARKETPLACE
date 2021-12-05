<?php
 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=download_rekapProduk.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>        
   <div>
  
        <h3 align="center">REKAP PRODUK PER KATEGORI</h3>
        <h5 align="center"><?=$d['thn']?> <?=$d['bln']?> <?=$d['tgl']?> </h5>
        </div>

<table width="100%" border="1">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>

                    <th>Kategori</th>
                    <th>Total</th>


                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  // $get_all_id_produk=$this->M_belanja->get_listAkun();

                  $to=0;
                  $no=0;
                  if($get_all_id_produk->num_rows() > 0){
                  foreach($get_all_id_produk->result() as $gidp0){ 


                  ?>

                    <tr>

                    <td><?=++$no?></td>

                    <td>
                     <?=$gidp0->kategori?>
                    </td>
                    
                    <td>
                     <?php 

                      $TOT=$this->M_rekapProduk->getTotal_perKategori($gidp0->id);                     

                      echo $TOT;
                      $to+=$TOT;
                     
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
                    TOTAL : <?=$to?> Qty
                    
                  </h4>
                
                </div>

                </table>
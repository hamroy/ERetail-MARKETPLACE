<?php

 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=download_daftar_penjual.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
  <table border="1" class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>No. NBM</th>
                   <!-- <th>No. Telp/ HP</th>-->
                    <th>Username</th>
                    <th>Status</th>
                    <th>NIK / NIS / NIM</th>
                    <th>Tanggal Daftar</th>
                    <th>Aktif</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  //$get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  $get_all_id_produk=$q;
                  if($get_all_id_produk->num_rows() > 0){
                  //echo $dari;
                  $no=1;
                  foreach($get_all_id_produk->result() as $gidp){ 
              
                  ?>
                <tr >
                    <td><?=$no++?></td>
                    <td><a href="<?=base_url('Master_admin/daftar_produk_penjual/'.$gidp->idlog)?>"><?=$gidp->nama?></a></td>
                    <td>
                    
                    <span class="pull-left"><a href="<?=$this->M_setapp->static_bm()?>/upload/nbm/<?=$gidp->file_nbm?>" target="_blank"> <?=$gidp->nbm?></a></span>
                    </td>
                    <!--<td><?=$gidp->no_kontak?></td>-->
                    <td>
                    <?=$gidp->username?> / <?=$gidp->password?></td>
                    <td>
                    <?php
                    
                    
        echo $this->M_setapp->get_tbl_st_job_id($gidp->job)->row()->nama_job;
        
                    
                    ?></td>
                    <td><?=$gidp->ni?></td>
                    <td><?=$gidp->tanggal?></td>
                    <?php
                    if($gidp->status==1){ ///aktif 1
                      $wr='success';
                      $tx='active';
                      $up=2;
                      $bt='block';
          }else{
            $wr='danger';
                      $tx='non active';
                      $bt='active';
                        
                      $up=1;
          }
                      ?>
                    <td class="<?=$wr?>">
                      <?=$tx?>
                    </td>
                    
                   
                  </tr>  
        <?php }
          }
                  ?>
                                
                  </tbody>
                </table>
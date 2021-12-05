<?php

 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=download_".$_GET['nprodi'].".xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
  <table border="1" class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th width="10%">NIM</th>
                    <th>Nama</th>
                    <th>PRODI</th>
                    <th>Tanggal Daftar</th>
                    <th>Saldo</th>
                  </tr>
                  </thead>
                  <?php 
                 // $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  $jvoc=3;
                  $all_newvoucer2=$this->M_vparsel->get_Pesan_voucher_mhs_prodi($jvoc,$id_voc_mhs,0,$kd_prodi);     // MAHASISWA UNIT MHSISWA SAJA  
                  
                      $get_all_id_produk=$all_newvoucer2;
                      //echo $_GET['vo'];
                      if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				
    				$getnama=$this->Muser->get_id_pass_nos($gidp->id_user);
    				if($getnama->num_rows() > 0){
    					$getnama0=$getnama->row()->nama;
    					$getnim=$getnama->row()->ni;
    				}else{
    					$getnama0='nama kosong';
    					$getnim='NIM kosong';
    				}
                    
                    
                
				  	?>
					<tr >
                    <td><?=$no++?></td>
                     <td><?=$getnim?></td>
                    <td><a><?=$getnama0?></a></td>
                   
                   
                    <td><?=$gidp->unit?></td>
                    <td><?=$gidp->tanggal_p?> <?=$gidp->waktu?></td>
                    <td></td>
                 
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                </table>
 <section class="content-header" style="background: #ecedee;">
   
    
      <br/>
        <h1>
         <b>
         <a href="<?=base_url('C_dompet/dafatar_pemesan_voucher/1?vo='.$dvo)?>"> 
         <span class="glyphicon glyphicon-arrow-left"></span> 
         </a> PENERIMA VOUCHER <?=$gjvoc->row()->nama_jvoc?></b>
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
   	<!-- Nav tabs -->
   

<div class="box">

<h3>DAFTAR PENERIMA VOUCHER <?=$gjvoc->row()->nama_jvoc?>

  <span class="pull-right">
    
    <a target="_blank" href="<?=base_url('excel/download_format.xlsx')?>" class="btn btn-default">
    <span class="glyphicon glyphicon-cloud-download"></span> Download Format Excel</a>
    <a target="_blank" href="<?=base_url('C_upxls/C_uppeg/?jvoc='.$jvoc)?>" class="btn btn-warning">
    <span class="glyphicon glyphicon-cloud-upload"></span> Upload Excel</a>
        
    </span>
  
</h3>

<div class="tab-content">
  <div class="tab-pane active" id="home">
  
  <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th width="20%">NIK</th>
                    <th>Email</th>
                    <th>UNIT KERJA</th>
                    <th>VOUCHER</th>
                    <th>STATUS</th>
                  </tr>
                  </thead>
                   <tfoot>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th width="20%">NIK</th>
                    <th>Email</th>
                    <th>UNIT KERJA</th>
                    <th>VOUCHER</th>
                    <th>STATUS</th>
                  </tr>
                  </tfoot>
        <?php 
       
        //$all_newvoucer2=$this->M_vparsel->get_Pesan_voucher_mhs(3,$id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA
        //$all_newvoucer2=$this->M_vparsel->get_mhs_ex_aktif(3,$id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA
        // $all_newvoucer2=$this->M_adminvoc->get_peg_ex_aktif($jvoc);     // MAHASISWA UNIT MHSISWA SAJA
        $get_all_id_produk=$all_newvoucer2;
        //echo $_GET['vo'];
        if($get_all_id_produk->num_rows() > 0){
          	$no=$dari;
            $tbdaf=0;
            $tsdaf=0;
            $smen=0;
				foreach($get_all_id_produk->result() as $gidp){ 
                
                $getnama=$this->M_vparsel->get_nim_akun($gidp->ni);

                $getnama0="($gidp->nama_peg)";
                $getprodi="$gidp->unitkerja";
                $email_m="($gidp->email_peg)";
                $vou_mhs="$gidp->saldo_vou";
				
                if($getnama->num_rows() > 0){
					      $getnama0=$getnama->row()->nama;
                $email_m=$getnama->row()->username;
                }
                
                //$all_mhsaktif=$this->M_vparsel->mhs_aktif_($getnim);     // MAHASISWA UNIT MHSISWA SAJA
				
				
				  	?>
                     <?php
                        if($getnama->num_rows()== 0){
                        
                        $sb= 'BELUM DAFTAR';
                        $ctd='';
                        $tbdaf=$tbdaf+1;
                        
                            
                        }else{
                        /////CEK SUDAH NGAMBIL BELUM
                        	
                        $cek_diterima=$this->M_adminvoc->get_vou_pesan_perakun($getnama->row()->idlog,$jvoc);     // MAHASISWA UNIT MHSISWA SAJA
                        $sb ='TERDAFTAR';    
                        $ctd='#5969fb';
                        
                        
                          if($cek_diterima->num_rows() > 0){
                          
                          $sb ='DITERIMA';    
                          $ctd='#34d926';
                          $smen=$smen+1;
  							
  						            }else{
                          $tsdaf=$tsdaf+1;
                          }
                        
                        
                        }

                     // $sb='';
                     // $ctd='';
                        
                        ?>
					<tr >
                    <td><?=++$no?></td>
                    <td><a ><?=$getnama0?></a></td>
                   
                    <td><?=$gidp->ni?></td>
                    <td><?=$email_m?></td>                 
                    <td><?=$getprodi?></td>                 
                    <td align="right"><?=$vou_mhs?></td>                 
                    <td align="right" bgcolor="<?=$ctd?>">
                       <?=$sb?>
                    </td>                 
                 
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                </table>

                <table class="table no-margin">

                  <?php

                  ///hitpenermavoc_peg
                  

                  ?>

                  <tr bgcolor="#d9d9dd">
                    <th>Total  : <?php //$penvoc['num']?></th>
                  </tr>
                  <tr bgcolor="#d9d9dd">
                    <th>Sudah Mendaftar (belum menerima voucher) : <?php //$penvoc['terdaftar']?></th>
                   
                  </tr>
                  <tr bgcolor="#d9d9dd">
                    <th>Sudah Menerima Voucher : <?php //$penvoc['menerima']?></th>
                   
                  </tr>
                 
                  <tr bgcolor="#d9d9dd">
                    <th>Belum Mendaftar : 
                      <?php //$penvoc['belumDaftar']?>
                         
                    </th>
                    
                   
                  </tr>
                   
                   
                   
                  
                </table>

                <div class="well">
                  <?=$halaman?>
                </div>
  
  
  </div>
</div>
</div>	
	
    </section>
    
   
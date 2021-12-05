 <section class="content-header" style="background: #ecedee;">
   
    
      <br/>
        <h1>
         <b>
         <a href="<?=base_url('C_dompet/dafatar_pemesan_voucher/?vo=4')?>"> 
         <span class="glyphicon glyphicon-arrow-left"></span> 
         </a> VOUCHER MAHASISWA</b>
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
   <div class="well">
     
     <form class="form-inline" action="<?=base_url('C_upxls/acc_pesan_voc_mhs_all/')?>" method="post" role="form">
  <div class="form-group">
    <label class="" exampleInputEmail2">SALDO : </label>
    <input type="text" class="form-control" required name="saldo" id="exampleInputEmail2" placeholder="nominal">
  </div>
 
  
  <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin !!')">  <span class="glyphicon glyphicon-ok"></span> TERIMA</button>
  
  <span class="pull-right">
    
    <a target="_blank" href="<?=base_url('C_upxls/?nprodi=')?>" class="btn btn-warning">
    <span class="glyphicon glyphicon-cloud-upload"></span> Upload Excel</a>
        
    </span>
  
</form>
    
    
     
   </div>
	
	<!-- Nav tabs -->
   

<div class="box">

<h3>DAFTAR BELUM DITERIMA</h3>

<div class="tab-content">
  <div class="tab-pane active" id="home">
  
  <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th width="20%">NIM</th>
                    <th>PRODI</th>
                    <th>Tanggal Daftar</th>
                  </tr>
                  </thead>
                  <?php 
                 
                  //$all_newvoucer2=$this->M_vparsel->get_Pesan_voucher_mhs(3,$id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA
                  $all_newvoucer2=$this->M_vparsel->get_Pvoc_mhs_ex(3,$id_voc_mhs);     // MAHASISWA UNIT MHSISWA SAJA
                  
                  
                  $get_all_id_produk=$all_newvoucer2;
                  //echo $_GET['vo'];
                if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				foreach($get_all_id_produk->result() as $gidp){ 
                
                $getnama=$this->Muser->get_id_pass_nos($gidp->id_user);
				if($getnama->num_rows() > 0){
					$getnim=$getnama->row()->ni;
					$getnama0=$getnama->row()->nama;
                    
                    //PRODI
                    $gjob=$this->M_setapp->get_tbl_per_prodi_ok($getnama->row()->kode_prodi);
					$getprodi=$gjob->row()->nama_prodi;
				}else{
					$getnama0='nama kosong';
                    $getnim='kosong';
                    $getprodi='kosong';
				}
                
                //$all_mhsaktif=$this->M_vparsel->mhs_aktif_($getnim);     // MAHASISWA UNIT MHSISWA SAJA
				
				
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><a ><?=$getnama0?></a></td>
                   
                    <td><?=$getnim?></td>
                    <td><?=$getprodi?></td>
                    <td><?=$gidp->tanggal_p?> <?=$gidp->waktu?></td>
                    
                 
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                </table>
  
  
  </div>
</div>
</div>	
	
    </section>
    
   
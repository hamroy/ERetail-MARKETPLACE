 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b><a href="<?=base_url('Master_admin/daf_transaksi')?>">DAFTAR TRANSAKSI</a></b>
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
      <?php
                  	$blnaray=array(
					'1'=>'Januari',
					'2'=>'Februari',
					'3'=>'Maret',
					'4'=>'April',
					'5'=>'Mei',
					'6'=>'Juni',
					'7'=>'Juli',
					'8'=>'Agustus',
					'9'=>'September',
					'10'=>'Oktober',
					'11'=>'November',
					'12'=>'Desember',
					);
                    
                    ///20180125
                    $hst=0;
                    ///20180125
                    
                    
          if($sort==NULL){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($bln,$thn);
				  }elseif($sort=='b1'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln($bln,$thn);
                  }elseif($sort=='b2'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_qty($bln,$thn);
				  }elseif($sort=='b3'){
				  	$get_id_produk=$this->Madmin_master->get_transaksi_grupbln_harga($bln,$thn);
				  }elseif($sort=='a1'){ ///status
				  	$get_id_produk=$this->Madmin_master->get_transaksi_sort_job($bln,$thn);
				  	$get_id_produk2=$this->Madmin_master->get_transaksi_nosort_job($bln,$thn);
                    $hst=1;  
				  }elseif($sort=='a2'){ ///status
				  	$get_id_produk=$this->Madmin_master->get_transaksi_sort_job_harga($bln,$thn);
				  	$get_id_produk2=$this->Madmin_master->get_transaksi_nosort_job_harga($bln,$thn);
                    $hst=1;  
				  }
				  ///16/5/17
				  
                  $totbln=$this->Madmin_master->total_tanpa_sort($bln,$thn);
                  	
                  	?>
    <section class="content">
    
    <div class="well" align="center">
        <h3><b>Bulan <?=$blnaray[$bln]?> <?=$thn?></b> <br/> [Rp <?=number_format($totbln,0,',','.')?>]</h3>
        
    </div>
    <div class="well">
    <form class="form-inline" role="form">
  
  <div class="form-group">
    <label for="exampleInputPassword2">Urutkan I</label>
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
  <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/b1/1')?>" <?php if($sort2==1){ echo 'selected';}?> >TRANSAKSI</option>
   <option value="<?=base_url('Master_admin/transaksi/'.$bln.'/'.$thn.'/a1/2')?>" <?php if($sort2==2){ echo 'selected';}?> >STATUS</option>
 
</select>

  </div>
  <span class="pull-right"><a class="btn btn-default" target="_blank" href="<?=base_url('C_cetak/cetak_trans_admin/'.$bln.'/'.$thn.'/'.$sort.'/'.$sort2)?>">CETAK</a></span>
  
</form>
<hr/>


</div>
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
	
	<div class="box box-info">
            <div class="box-header with-border">

             
            <!-- /.box-header -->
            <div class="box-body">
            
              	
<br/>        

          
                
              <div class="table-responsive">
             
              
              <table class="table no-margin js-basic-example Datatable" >
                  <thead>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Nama Pembeli <br> (NBM)</th>
                    <th>Nama Penjual</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                  </tr>
                  </thead>

                  <tfoot>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>Nama Pembeli <br> (NBM)</th>
                    <th>Nama Penjual</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>

                  <tbody>
                  <?php 
				   $no=1;
				   $totperbln=0;
				   $totperbln2=0;
                   
          foreach($get_id_produk->result() as $gidp){
						
					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
				  	$getpnbm=0;
            $getpembeli='pembeli kosong';

            if($getuser->num_rows() > 0){
              $getpembeli='*'.$getuser->row()->nama;
              $getpnbm=$getuser->row()->nbm;
            }

				  	if($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0){
  					$getpembeli=$this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;	
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
					$getproduk=$gidp->nama_produk;
					}
                    
                    ////20180316
                    $rptra=$this->M_tranumat->get_rinciproduk_transaksi($gidp->id); ///jika r_produk ==1 mak mengunkan ini [tbl_transaksirinciproduk]
                    ///201812 get_rinciproduk_transaksi
                    $rctra=$this->M_tranumat->get_rinciproduk_idtra($gidp->id);
					  
				  	?>
					<tr >
                    <td><?=$no++?></td>
                     <td><?=$getpembeli?> <br> (<?=$getpnbm?>)</td>
                     <td><?=$getpenjual?></td>
                    <td>
                     <?php
                    //echo $gidp->r_produk;
                    if($gidp->offline == 1)
                    {
                    // echo $rctra->num_rows().''.$gidp->id_trasofline;
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
                    if($gidp->offline == 1)
                    {
                    if($rptra->num_rows() > 0){
                      foreach($rptra->result() as $vhas){
                          echo $vhas->j_produk  ;  
                          echo '<br/>';
                        }
                    }
                    
                    }else{
                    echo $gidp->qty;    
                    }
                    ?>
                    </td>
                    <td align="right">
                    <?php
                    if($gidp->harga_satuan!=0){
        				$akhirsat=$gidp->harga_satuan;
        			}else{
        				$akhirsat=$hrgasatuan;
        			}
                    //echo $gidp->r_produk;
                    if($gidp->offline == 1)
                    {
                    if($rptra->num_rows() > 0){
                      foreach($rptra->result() as $vhas){
                          echo $vhas->h_produk  ;  
                          echo '<br/>';
                        }
                    }
                    
                    }else{
                    echo ($akhirsat);    
                    }
                    ?>
                    </td>
                    
                    <td align="right"><?=($akhirsat*$gidp->qty)?></td>
                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>
                    <td><?=$gidp->metode?></td>
                     <td>
                    <?php
                    
                    
                    echo $getstjob;
        
                    
                    ?></td>
                   
                  </tr>  
				  <?php	
					$totperbln=$totperbln+($akhirsat*$gidp->qty);
					}
                  ////di susun perbulan
                  $akhir=$totperbln;
                  ?>
 

                  
                  <!---->
                  
                                
                  </tbody>
                </table> 

                <table class="table">
                  <!--TOATAL-->
                  <tr style="background-color: #b3b3b9">
                    <td colspan="1" align="right">
                  
                        <b>Total Bulan <?=$blnaray[$bln]?> <?=$gidp->thn?></b>
                    </td>
                    <td colspan="1"  align="right">
                        <b><?=number_format($akhir,0,',','.')?> </b>                  </td>
                  </tr>
                </table>
               
               
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
	
		</div>
    </section>
    
   
   
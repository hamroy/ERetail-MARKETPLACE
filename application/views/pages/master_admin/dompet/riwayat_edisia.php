 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar transaksi Belanja Member</li>
      </ol>
      <br/>
        <h1>
         <b>RIWAYAT EDISI VOUCHER</b>
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

  <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Pembeli</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp0){ 
				
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td>
                    <a data-toggle="collapse" data-parent="#accordion<?=$gidp0->idlog?>" href="#collapseOne<?=$gidp0->idlog?>">
         <?=$gidp0->nama?> 
        </a> ( <?=$gidp0->idlog?> )
                    </td>
                    <tr>
						<td colspan="2">
	<div id="collapseOne<?=$gidp0->idlog?>" class="panel-collapse collapse in">
	<div class="table-responsive">
                  <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>tahap</th>
                    <th>Edisi</th>
                    <th>SALDO</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal ACC</th>
                  </tr>
                  </thead>
                  <?php
                 $get_input_voucer=$this->Madmin_master->get_tbl_input_voucher_perid_user($gidp0->idlog);
                 if($get_input_voucer->num_rows() > 0){
                 	$vv1=0;
                 	$no2=1;
                 	$cekth=2;
                 	$totsaldo=0;                 
				 	foreach($get_input_voucer->result() as $vc){
                    ?>
                    <tr>
                    <td><?=$no2++?></td>
                    <td><?=$vc->tahap?>
                        
                        <?php
                        if($vc->tahap!=$cekth){
                            echo 'salah <br/>';
                            
                            echo' <a href="'.base_url('C_dompet/revedtah/'.$gidp0->idlog.'/'.$cekth.'/'.$vc->tahap).'">Perbaiki</a>';
                            
                        }
                        ?>
                        
                    </td>
                    <td>
                    <?php
                if($vc->bonus==1){ ///jika bonus
                   echo 'Bonus'; 
                }else{
                    
                     echo 'Ed '. $vc->edisi;
                }
                
                    ?>
                    
                </td>
                    <td><?=$vc->saldo?></td>
                    <td><?=$vc->tgl_trans?></td>
                    <td><?=$vc->tgl_oto?></td>
                    </tr>
                    <?php     
                    $cekth++;
                    }
                    
                    }     
                  
                  ?>
                  </table>
              </div>
    </div>

						
						
					</td>
					</tr>
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                                
                  </tbody>
                </table>
              </div>	
			
	
    </section>
    
   
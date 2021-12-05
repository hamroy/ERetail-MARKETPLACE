<div class="row">

  <div class="col-xs-9 profil_menu" >
  
  
  <div class="tab-content " >
  <div class="tab-pane active" id="home">
  <?php
  $getnmakatj=$this->Madmin->get_nama_kat_perid($id_k);
  ?>
  <h3>KATEGORI <?=$getnmakatj->row()->kategori?></h3>
  <br/>
 
  <!--mobile-->
  <div class="tab-content hidden-lg hidden-md hidden-sm" >
  <div class="tab-pane active" id="home">
  <br/>
  	<ul class="list-group">
  	<div class="panel-group" id="accordion">

      <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion_2" href="#accordion_2">
        <li class="list-group-item">Pilih Kategori</li>
        </a>
      </h4>
    </div>
    <div id="accordion_2" class="panel-collapse collapse ex">
      <div class="panel-body">
      <li class="list-group-item"><a href="<?=base_url('Welcome/profil_publik/'.$id_user.'/0/'.$id_produk)?>"><span>SEMUA</span></a></li>
		 	
        <?php
            $get_all_id_produk_perkategori=$this->Madmin->get_all_id_produk_perkateggori_master();
		 if($get_all_id_produk_perkategori->num_rows() > 0){
		 	foreach($get_all_id_produk_perkategori->result() as $kat){ 
		 	$getnmakat=$this->Madmin->get_nama_kat_perid($kat->id_k);
		 	$gtog_mn=$this->Muser->get_produk_by_kat_id_pe($kat->id_k,$id_user);
		 	?>
		 	<li class="list-group-item"><a href="<?=base_url('Welcome/profil_publik/'.$id_user.'/'.$kat->id_k.'/'.$id_produk)?>"><span>- <?=$getnmakat->row()->kategori?></span> <span class="badge pull-right"><?=$gtog_mn->num_rows()?></span></a></li>
		 	
		 	<?php
		 	
		 	
		 	}
		 	}
            
            ?>
      </div>
    </div>
  </div>
 
    </div>
  
    </ul>
  </div>
  <div class="tab-pane" id="profile">
  	
  </div>
  </div>
  
  <!--mobile-->
  
   <br/>
  
  	<ul class="list-group">
  
  <?php
  $gtog=$this->Muser->get_produk_by_kat_id_pe($id_k,$id_user);
                 if ($gtog->num_rows()>0){
				 	
				 $no=1;
                 foreach($gtog->result() as $gt){ ?>
                  <?php
           
             $fotob = $this->M_setapp->static_bm().'/upload/barang/'.$gt->gambar; 
                  ?>
                 <?php
			 if($no++ <= 6){
			 	$la='src="'.$fotob.'"';
			 }else{
			 	$la='';
			 }
			 
			     ?> 
      <li class="list-group-item">
  	
  
      	<table class="table table-striped">

	
	
	<tr>
		<td style="width: 100px"><img <?=$la?> data-original="<?=$fotob?>" style="width: 100px;height: 100px" class="img-rounded lazy"></td>
		
		<td align="left" width="50%">
		<b><?=$gt->nama?></b><br/>
		<?php
        
        if(($gt->hargak)){
        
         if($gt->harga < $gt->hargak){
		 echo ' <h5 class="text-danger"><small><del>Rp '.number_format($gt->hargak,2,',','.').'</del></small><br/> ';
		 }else{
		 echo ' <h5 class="text-danger"><small><del>Rp '.number_format($gt->harga,2,',','.').'</del></small><br/> ';	
		 }
        
        }else{
           echo  ' <h5>';
        }
        
        if($id_k!=4){
        echo '<b>Rp ';	
        if(empty($gt->hargak) or $gt->hargak==0 or $gt->harga < $gt->hargak){
		if($gt->harga!=0){
		echo number_format($gt->harga,2,',','.');	
		}else{
			echo number_format(0,2,',','.');
		}
		}else{
			echo number_format($gt->hargak,2,',','.');	
		}
       
		echo '</b></h5>';
		}//idk
        
        ?> <br/>
        
        <a href="<?=base_url('Welcome/produk/'.$gt->id)?>">	lihat Rinci</a>
        
        </td>
        <td align="left">
		   <?php 
                  	
            //============================================================
            $qty=$this->Mtrans->get_produkqty($gt->id);
            //============================================================
             $qty2pesan_id_user=$this->Mtrans->get_produkqty_dipesan_keranjang($gt->id,$id_s);
            //============================================================
             $qty2pesan=$this->Mtrans->get_produkqty_dipesan($gt->id);  ///id_produk
            //============================================================
           
                  	
                  	//echo $qty;
                  	//echo $qty2pesan;
                  	//echo $id_s;
                  	$stoka=$gt->stok-$qty;
                  	if($id_k==4){
                  		echo'<p>&nbsp;</p>';	
                  	}else{
						if($stoka>0){
						?>
						 <?php
  	 $nlihat=$this->Muser->get_produk_by_id_view_rows($gt->id);
  	 ?>
					 <h6 >Dilihat &nbsp;&nbsp;&nbsp;&nbsp;: <?=$nlihat?> Kali</h6>
					 <h6>Tersedia : <?=$gt->stok?> <?=$gt->satuan?></h6>
					 <h6 >Dipesan &nbsp;: <?=$qty2pesan?> <?=$gt->satuan?></h6>
					 <h6 >Terjual &nbsp;&nbsp;&nbsp;: <?=$qty?> <?=$gt->satuan?></h6>
					
						<?php
					///jiaka yang di pesan > 0
					if($stoka <= $qty2pesan){
						echo'<h5 class="hidden-xs"><span class="label label-danger">Persedian Kosong</span></h5>';		 
					}
					
					
					}else{
						  echo(' <h6 >Terjual : '.$qty.'&nbsp;&nbsp; '.$gt->satuan.'</h6>');
							echo'<h5 class="hidden-xs"><span class="label label-danger">Persedian Kosong</span></h5>';		
					}						
						}
                  ?>   <br/>
	
		</td>
		
	</tr>
	
	</table>
  	
      </li>
                 
                 
                 <?php
                 } //for
                 
                 } //if
  ?>
  
  
  
    </ul>
  
  </div>
  
  <!--tab2-->
    <div class="tab-pane" id="ass">
  	
    </div>
    </div>
        </div>


  <div class="col-xs-3 hidden-xs">
  <div class="tab-content">
  <div class="tab-pane active" id="home">
  <br/>
  	<ul class="list-group">
  	<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
        <li class="list-group-item">Pilih Kategori</li>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse ex">
      <div class="panel-body">
      <li class="list-group-item"><a href="<?=base_url('Welcome/profil_publik/'.$id_user.'/0/'.$id_produk)?>"><span>SEMUA</span></a></li>
		 	
        <?php
            $get_all_id_produk_perkategori=$this->Madmin->get_all_id_produk_perkateggori_master();
		 if($get_all_id_produk_perkategori->num_rows() > 0){
		 	foreach($get_all_id_produk_perkategori->result() as $kat){ 
		 	$getnmakat=$this->Madmin->get_nama_kat_perid($kat->id_k);
		 	$gtog_mn=$this->Muser->get_produk_by_kat_id_pe($kat->id_k,$id_user);
		 	?>
		 	<li class="list-group-item"><a href="<?=base_url('Welcome/profil_publik/'.$id_user.'/'.$kat->id_k.'/'.$id_produk)?>"><span>- <?=$getnmakat->row()->kategori?></span> <span class="badge pull-right"><?=$gtog_mn->num_rows()?></span></a></li>
		 	
		 	<?php
		 	
		 	
		 	}
		 	}
            
            ?>
      </div>
    </div>
  </div>
 
</div>
  
</ul>
  </div>
  <div class="tab-pane" id="profile">
  	
  </div>
</div>
        </div>
      
        <!-- /.col -->
      </div>
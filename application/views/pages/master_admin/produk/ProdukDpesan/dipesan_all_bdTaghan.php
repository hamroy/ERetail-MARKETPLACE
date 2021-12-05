<div class="box-header with-border">
        <div class="box-tools pull-right">
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <form id="form1" class="form-horizontal" method="post" action="<?=base_url("C_transaksiBatal/allIdTransaksi/".$get_d."/".$stg)?>" enctype="multipart/form-data">
          <input type="submit" class="btn btn-primary"  value="BATALKAN">
          <hr/>
          <table class="table no-margin">
            <thead>
            <tr bgcolor="#d9d9dd">
              <th>No</th>
              <th>Nama Pembeli</th>
             <!-- <th>Nama akun pembeli</th>-->
              <th>Nama Penjual</th>
              <th>Email / No.hp</th>
              <th>Produk</th>
              <th>Kuantitas / Harga Satuan</th>
              <th>Tanggal Transaksi</th>
              <th>ket.</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            ////di grup produk dan id tgl
             // $get_all_id_produk=$this->M_produkDipesan->get_Pdipesan_all($get_d,$stg,$tgla,$bd);
            $get_all_id_produk=$this->M_produkDipesan->get_Pdipesan_all($get_d,$stg,$tgla,$bd);
            //$get_all_id_produk=$this->Madmin->get_Produk_dipesan($this->session->userdata('id_user'));
           // $get_all_id_produk=$this->Madmin->get_Produk_dipesan_all();
            $tot=0;
          if($get_all_id_produk->num_rows() > 0){
            $no=1;
            	
	foreach($get_all_id_produk->result() as $gidp){ 
	
          $sgetuser=$gt_id_pem=$this->Madmin->getidpembeli($gidp->id_pembeli);
	  	
	
	$g_id=$this->Madmin->getid_trnasaksi($gidp->id);
          
          $getuser=$this->Madmin_master->get_user_produk($gidp->id_user);	
	
          $getpembeli=$gidp->nama_pembeli;	
          
              if($getpembeli == NULL){
				
                  if($g_id->row()->id_user == 0)
                  {
                       $getpembeli=$sgetuser->row()->nama;
                  }else{
                       $getpembeli=$getuser->row()->nama;
                  }
                 
				
              }	
		
				
                  
      if($getuser->num_rows() > 0){
				$getpembeli_akun=$getuser->row()->nama;
				$voucerbelanjakan=$getuser->row()->voucher_dibelanjakan;
			}else{
				$getpembeli_akun='';
				$voucerbelanjakan='0';
			}	
	   	
	
	
	////GET penjual
	if($this->Madmin_master->get_user_produk($gidp->id_pelapak)->num_rows() > 0){
		$getpenjual=$this->Madmin_master->get_user_produk($gidp->id_pelapak)->row()->nama;	
			
		}else{
		$getpenjual='';
		}
          ////////    
	   $tot = $tot+$gidp->qty*$gidp->harga_satuan;
          ///////   
          
          
      
	  	?>
              <?php
              $e_mp='data kosong';
              $e_hp='data kosong';
              if($sgetuser->num_rows()>0){
                   $e_mp=$sgetuser->row()->email;
                   $e_hp=$sgetuser->row()->hp;
              }
              
              ?>
		<tr >
              <td><?=$no++?> 
              <label class="checkbox-inline">
                <input type="checkbox" name="ck_<?=$gidp->id?>" value="<?=$gidp->id?>">[<?=$gidp->id?>]
              </label>
              </td>
              <td><?=$getpembeli?> <?php echo '<br/> akun : '.$getpembeli_akun;
              ?></td>
              <td><?=$getpenjual?></td>
              <td><?=$e_mp?> / <br/><?=$e_hp?></td>
              <td><?=$gidp->nama?></td>
              <td><?=$gidp->qty?> / <br/><?=number_format($gidp->harga_satuan,2,',','.')?></td>
              <td><?=$gidp->tgl_trans?></td>
              <td><?php
              
              echo $gidp->buy;
              if ($gidp->buy=='diproses') {
                # code...
                $durasi=$this->Madmin->get_transpros_id($gidp->id)->row()->durasi;
                $tglnow=$this->M_time->thnblntgl();
                $hdur= $durasi-$tglnow;
                
                echo '<br/> Durasi '.$hdur.' hari';
              }

              ?></td>
             <td>
             <?php
             //
            $modv=1; //aktif
            $jevoc='T';
            if($gidp->metode=="VOUCHER"){

              $kolidvoc='id_voc_p';

              if ($gidp->j_voucher==0) {
                $kolidvoc='id_voc';
              }

              $nmjvoc=$this->M_gvocall->getNameVoc($gidp->j_voucher);


            if($gidp->harga_satuan*$gidp->qty != 0 and ! empty($getpembeli_akun)){ ///lolos karen harga tidak nol.
               $jevoc=$gidp->j_voucher;
               ?>
               <p>
               Voucher <?=$nmjvoc?><br/>
               Edisi : <?=$gidp->$kolidvoc?>
               </p>

               <a class="btn btn-xs btn-danger kla" data-toggle="modal" data-target="#myModalgambarbtl<?=$gidp->id?>">Transaksi Batal </a>
               
              <?php
              
              }else{
                    echo 'ERROR #1212';
                    $modv=0; //aktif

              }

            
           
              
            }elseif($gidp->metode=="TRANSFER"){
            $jevoc="F";
             ?>
                  <a class="btn btn-xs btn-danger kla" data-toggle="modal" data-target="#myModalgambarbtl<?=$gidp->id?>">Transaksi Batal</a> 
              <?php
            }else{
                  ?>
                  <a class="btn btn-xs btn-danger kla" data-toggle="modal" data-target="#myModalgambarbtl<?=$gidp->id?>">Transaksi Batal</a> 
              <?php
            }
              
              ?>
              <?php
              if($modv==1){
              ?>
               <div class="modal fade" id="myModalgambarbtl<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="myModalLabel">Transaksi Batal</h4>
</div>
<div class="modal-body">
    <form method="post" id="form1" action="<?=base_url('C_transaksiBatal/index/'.$gidp->id.'/btl/admin')?>">
        <div class="box-body" align="left">
       <div class="form-group">
	        	Nama Pembeli :  <?=$getpembeli?> <br/>
            Produk         : <?=$gidp->nama?><br/>
            Jumlah Produk : <?=$gidp->qty?><br/>
            Harga Satuan :  <?=number_format($gidp->harga_satuan,2,',','.')?><br/>
            Total : <?=number_format($gidp->harga_satuan*$gidp->qty,2,',','.')?><br/>
            <label>Keterangan : <?//=$jevoc?></label><br/>
           <textarea type="text" name="alasan" class="form-control"></textarea>

        </div>
          <input type="hidden" name="ck" value="ya" >
          <input type="hidden" name="jevoc" value="<?=$jevoc?>" >
          <input type="hidden"  name="id_user" value="<?=$this->session->userdata('id_user')?>">
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
          <button type="submit" onclick="submitForm('<?=base_url('C_transaksiBatal/index/'.$gidp->id.'/btl/admin')?>')" class="btn btn-danger pull-right btn-block btn-lg btn_wala">Transaksi Batal</button>
        </div>
        <!-- /.box-footer -->
      </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>  
              <?php
              }
              ?>
             
             </td>
            </tr>  
	<?php	
          
              
            }
	  }
            
            ?>
              <tr>
                  <td>
                      TOTAL
                  </td>
                  <td><?=number_format($tot,2,',','.')?> </td>
              </tr>            
            </tbody>
          </table>
          </form>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
    
      <!-- /.box-footer -->
    </div>

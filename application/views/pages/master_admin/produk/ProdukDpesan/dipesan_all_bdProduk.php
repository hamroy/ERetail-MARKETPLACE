<div class="box-header with-border">
        <div class="box-tools pull-right">
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
         
          <table class="table no-margin">
            <thead>
            <tr bgcolor="#d9d9dd">
              <th>No</th>
              <th>Nama Pembeli</th>
              <?php
              if ($bd==2) {
                echo "
                      <th>Nama Penjual</th>
                      <th>Nama Produk</th>
                      ";
              }

              ?>
              <th>Sub Kuantitas</th>
              <th>Sub Total</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
  <?php 
  ////di grup produk dan id tgl
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

  //
  if ($bd==3) {
    $idB=$gidp->id_user;
  }else{
    $idB=$gidp->id_produk;
  }



  $gstq=$this->M_produkDipesan->getQtyperAllPembeli($get_d,$stg,$idB,$bd,$tgla);
  ////////    
	$tot = $tot+($gstq['subtot']);
  //////   
          
          
      
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
              <td><?=$no++?> </td>
              <td><?=$getpembeli?> <?php echo '<br/> akun : '.$getpembeli_akun;
              ?></td>

              <?php
              if ($bd==2) {
                echo "
                      <td>$getpenjual</td>
                      <td>$gidp->nama</td>
                      ";
              }

              ?>
              

              <td><?=$gstq['subqty']?></td>
              <td><?=number_format($gstq['subtot'],2,',','.')?></td>
              
              
             
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

        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->
    
      <!-- /.box-footer -->
    </div>

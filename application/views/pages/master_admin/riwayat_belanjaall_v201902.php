 <section class="content-header" style="background: #ecedee;">

    

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>

        <li class="active">Daftar transaksi Belanja Member</li>

      </ol>

      <br/>

        <h1>

         <b>TRANSAKSI PEMBELIAN</b>

        <small></small>

      </h1>

    </section>



    <!-- Main content -->

    <section class="content">

      <?php

	    $message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>

    <div class="well">
     <form class="form-horizontal" method="post" action="<?=base_url('C_rekapPenjualan/PostTgl/0')?>" role="form">
      <div class="row">
      <div class="col-md-3">
      <div class="input-group" style="padding: 5px ;">
        <span class="input-group-addon" id="basic-addon1">TAHUN</span>
        <select name="T_thn" class="form-control" >
        
             <option value="S" >SEMUA </option>
             <?php
             $gthntran=$this->M_rekapPenjualan->G_gruopthntransaksi();
             foreach ($gthntran->result() as $keyttr) {
               # code...
              $gthn=$this->session->userdata('T_thn');
              if ($gthn==null) {
                $gthn=$this->M_time->thn();
              }
              $slct='';
              if ($gthn==$keyttr->thn) {
                # code...
                $slct='selected';
              }

              ?>

              <option value="<?=$keyttr->thn?>" <?=$slct?> ><?=$keyttr->thn?> </option>

              <?php

             }

             ?>
       
          </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-group" style="padding: 5px ;">
        <span class="input-group-addon" id="basic-addon1">BULAN</span>
        <select name="T_bln" class="form-control" >
          <option value="S" >SEMUA </option>

          <?php
          $gjob=$this->M_setapp->get_bln();

          foreach($gjob->result() as $jbln){

          $gbln=$this->session->userdata('T_bln');
          if ($gbln==null) {
                $gbln=$this->M_time->bln();
              }
              $slct='';
              if ($gbln==$jbln->nobln) {
                # code...
                $slct='selected';
              }
              ?>
              <option value="<?=$jbln->nobln?>" <?=$slct?> ><?=$jbln->bln?> </option>

              <?php

          }
          ?>
        
          </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-group" style="padding: 5px ;">
        <span class="input-group-addon" id="basic-addon1">TANGGAL</span>
        <select name="T_tgl" class="form-control" >

             <option value="S" >SEMUA </option>
             <?php

             for ($i=1; $i < 32 ; $i++) { 
               # code...
              $gtgl=$this->session->userdata('T_tgl');
              $slct='';

              if ($gtgl==null) {
                $gtgl=$this->M_time->tglnow();
              }

              if ($gtgl==$i) {
                # code...
                $slct='selected';
              }

              ?>

              <option value="<?=$i?>" <?=$slct?> > <?=$i?> </option>

             <?php
             }

             ?> 
             

       
          </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="input-group" style="padding: 5px ;">
      <button type="submit" class="btn btn-default btn-block">TAMPILKAN</button> 
      </div>
    </div>
    </form>
  </div>

<?php
$gtgl=$this->session->userdata('Tampil');
if ($gtgl==1) {
  
?>
  <div class="well">
     <form class="form-horizontal" role="form">
    
        <div class="input-group" style="padding: 5px">
        <span class="input-group-addon" id="basic-addon1">STATUS</span>
        <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
          <?php

           $statusP=$this->session->userdata('statusP');
         
          ?>
          <option value="#0">Pilih Status</option>
          <option value="<?=base_url('C_rekapPenjualan/sortStatus/0')?>"  <?php if($statusP=='0'){ echo 'selected';}?> >Semua</option>
          <?php
          
          $stnam='SEMUA';
          $gt_stjob=$this->M_voucher->get_stjob();
          foreach($gt_stjob->result_array() as $va){
            
              $sl='';
              
              
              if($statusP==$va['id_job']){ 
              $sl='selected';
              $stnam=$va['nama_job'];
              }
             // echo $va['id_job'];
              ?>
              
                <option value="<?=base_url('C_rekapPenjualan/sortStatus/'.$va['id_job'])?>"  <?=$sl?> ><?=$va['nama_job']?></option>
              
              <?php

              
          }
          ?>
             
         
            </select>
      </div>
      
      <?php
      if ($statusP==3) {

       $statprodi=$this->session->userdata('sProdiP');


      ?>
      <div class="input-group" style="padding: 5px">
        <span class="input-group-addon" id="basic-addon1">PRODI</span>
                    <select name="sortprodi" class="form-control"  onchange="loadPage(this.form.elements[1])">

                      <option value="#0">Pilih Prodi</option>
                
                      <option value="<?=base_url('C_rekapPenjualan/sortStatusProdi/0')?>" <?php if($statprodi=='0'){ echo 'selected';}?> >SEMUA</option>
                      <?php
                      
                      $gjob=$this->M_setapp->get_tbl_fak_prodi();

                      foreach($gjob->result() as $jb){
                        $slpro='';
                         if($statprodi==$jb->kode_nim){$slpro='selected';}
                        
                          ?>

                           <option value="<?=base_url('C_rekapPenjualan/sortStatusProdi/'.$jb->kode_nim)?>" <?=$slpro?>> <?=$jb->kode_nim?> - <?=$jb->nama_prodi?> </option>

                          <?php

                      }

                      ?>
                    </select>
                
                
      </div>

      <?php
      }
      ?>


     
    </form>
  </div>

<?php
}
?>


  <!--NAV-->
  <div class="table-responsive">
    <?php
    $totAllT=$this->M_belanja->get_pendapatanBM('TUNAI');
    $totAllV=$this->M_belanja->get_pendapatanBM('VOUCHER');
    $totAllF=$this->M_belanja->get_pendapatanBM('TRANSFER');

    ?>
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>TOTAL TUNAI</th>
                    <th><?=number_format($totAllT,0,',','.')?></th>
                   

                  </tr>
                  <tr bgcolor="#d9d9dd">
                   
                    <th>TOTAL VOUCHER</th>
                    <th><?=number_format($totAllV,0,',','.')?></th>
                   

                  </tr>
                  <tr bgcolor="#d9d9dd">
                   
                    <th>TOTAL TRANSFER</th>
                    <th><?=number_format($totAllF,0,',','.')?></th>

                  </tr>
                  <tr bgcolor="#d9d9dd">
                   
                    <th>TOTAL</th>
                    <th><?=number_format($totAllT+$totAllV+$totAllF,0,',','.')?></th>

                  </tr>

                  </thead>
                </table>
<!-- ----------------------------------------------------------------------------------------------- -->

  <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>

                    <th>Nama Pembeli</th>
                    <th>Belanja Tunai</th>
                    <th>Belanja Voucher</th>
                    <th>Belanja Transfer</th>
                    <th>Total Belanja</th>


                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  // $get_all_id_produk=$this->M_belanja->get_listAkun();

                  if($get_all_id_produk->num_rows() > 0){

                  $no=$dari;

				  	      foreach($get_all_id_produk->result() as $gidp0){ 

                  $getpendapatanT=$this->M_belanja->get_BelanjaPembeli($gidp0->id_pembeli,'TUNAI');
                  $getpendapatanV=$this->M_belanja->get_BelanjaPembeli($gidp0->id_pembeli,'VOUCHER');
                  $getpendapatanF=$this->M_belanja->get_BelanjaPembeli($gidp0->id_pembeli,'TRANSFER');

                  ?>

				          	<tr>

                    <td><?=++$no?></td>

                    <td>
                     <?=$gidp0->nama?> 
                    </td>
                    <td>
                     <?=$getpendapatanT?> 
                    </td>
                    <td>
                     <?=$getpendapatanV?> 
                    </td>
                    <td>
                     <?=$getpendapatanF?> 
                    </td>
                    <td>
                     <?=$getpendapatanF+$getpendapatanV+$getpendapatanT?> 
                    </td>

                  </tr>
                  
                  <?php	
                  
                      }
                      }

                  ?>

                </tbody>

                </table>

              </div>	
<!-- =============================================================================================== -->
              <hr/>

              <div class="well"><?=$halaman?></div>

			

	

    </section>

    

   
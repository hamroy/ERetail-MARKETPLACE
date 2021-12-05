 <section class="content-header" style="background: #ecedee;">

    

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>

        <li class="active">Daftar transaksi Penjualan Member</li>

      </ol>

      <br/>

        <h1>

         <b>TRANSAKSI PENJUALAN</b>

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
              $nmbln='S';  
              $stnam='';
              $stjobnam='';
              $statprodi='';
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
                $nmbln=$jbln->bln;
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
$gtam=$this->session->userdata('Tampil');
$statusP=$this->session->userdata('statusP');
if ($gtam==1) {
  
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
          <option value="<?=base_url('C_rekapPenjualan/sortStatus/R')?>"  <?php if($statusP=='R'){ echo 'selected';}?> >Rekap Semua Status</option>
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
                         if($statprodi==$jb->kode_nim){$slpro='selected';$stjobnam=$jb->nama_prodi;}
                          $toperprodi=$this->M_rekapPenjualan->get_TotPerProdi($jb->kode_nim);
                          ?>

                           <option value="<?=base_url('C_rekapPenjualan/sortStatusProdi/'.$jb->kode_nim.'/0')?>" <?=$slpro?>> <?=$jb->kode_nim?> - <?=$jb->nama_prodi?>  ( Rp <?=number_format($toperprodi,0,',','.')?> ) </option>

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
  
  <hr/>

  <!-- ----------------------------------------------------------------------------------------------- -->
  

  

              </div>  



<!-- =============================================================================================== -->
  
  <?php
  $d_cetak=[

                        'gthn'=>$gthn,
                        'nmbln'=>$nmbln,
                        'gtgl'=>$gtgl,
                        'stnam'=>$stnam,
                        'stjobnam'=>$stjobnam,

                      ];
  if ($statusP=='R') {
    $this->load->view('pages/master_admin/rekap/penjualan/listPerStatus',$d_cetak);  
  }else{
    
    $this->load->view('pages/master_admin/rekap/penjualan/listPerAkun',$d_cetak);  
  }

  

  ?>




    </section>

    

   
 <section class="content-header" style="background: #ecedee;">

    

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>

        <li class="active">Rekap Produk</li>

      </ol>

      <br/>

        <h1>

         <b>REKAP PRODUK</b>

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
     <form class="form-horizontal" method="post" action="<?=base_url('C_rekapPenjualan/PostTgl/2')?>" role="form">
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
                $gtgl=$this->M_time->tgl_now();
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

<!-- FORM -->
<div class="well">
     <form class="form-horizontal" role="form">
    
        <div class="input-group" style="padding: 5px">
        <span class="input-group-addon" id="basic-addon1">KATEGORI/STATUS</span>
        <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
          <?php
          $per=1;
            if (isset($_GET['per'])) {
              $per=$_GET['per'];
            }

          ?>
         
          <option value="<?=base_url('C_rekapProduk?per=1')?>"  <?php if($per==1){ echo 'selected';}?> >Kategori Produk</option>
          <option value="<?=base_url('C_rekapProduk?per=2')?>"  <?php if($per==2){ echo 'selected';}?> >Status Akun</option>
          
            </select>
      </div>

      </form>

    </div>

  <hr/>
</div>  

<!-- =============================================================================================== -->
  
  <?php
  $d_cetak=[

                        'gthn'=>$gthn,
                        'nmbln'=>$nmbln,
                        'gtgl'=>$gtgl,
                        'stnam'=>$stnam,
                        'stjobnam'=>$stjobnam,
                        'per'=>$per,
                        'id_k'=>$id_k,

                      ];
  
  if ($this->session->userdata('Tampil')==null) {
    
     
  }
  elseif ($per==1) {
    if ($id_k==null) {
     $this->load->view('pages/master_admin/rekapProduk/listPerKategori',$d_cetak); 
    }else{
      $this->load->view('pages/master_admin/rekapProduk/listPerProdukKat',$d_cetak); 
    }
  }
  else{
    if ($id_k==null) {
     $this->load->view('pages/master_admin/rekapProduk/listPerStatus',$d_cetak);   
    }else{
      $this->load->view('pages/master_admin/rekapProduk/listPerProdukStatusA',$d_cetak); 
    }

    
  }

  

  ?>




    </section>

    

   
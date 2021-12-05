 <?php
  
    $arvoc=['','','','','','','','','','','',''];
    
   $id_voc_s=$this->M_voucher->get_max_id_voc();  
	 $id_voc_par=$this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
	 $id_voc_song=$this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi parsel
   $id_voc_mhs=$this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS
     
   $idjov=4; ///j_voucher
	 $id_vocall=$this->M_vparsel->get_max_id_vocall($idjov); ///menuju edisi voucher
   //
   $gEdisiVoc=$this->M_voucher->gEdisiVoc($dvo);  
  
   $tAwal=1;
   
    switch ($dvo){
        case 1:
        $arvoc[0]="#2d5726";
        $arvoc[1]="MAKAN";
        $arvoc[2]="selected";
        break;
        case 2:
        $arvoc[0]="#fb1d04";
        $arvoc[1]="SONGSONG RAMADHAN";
        $arvoc[3]="selected";
        break;
        case 3:
        $arvoc[0]="#3d39c6";
        $arvoc[1]="PARSEL LEBARAN";
        $arvoc[4]="selected";
        break;
        case 4:
        $arvoc[0]="#6b9474";
        $arvoc[1]="MAHASISWA";
        $arvoc[5]="selected";
        break;
        case 5:
        $arvoc[0]="#6b9474";
        $arvoc[1]="GAJI 13";
        $arvoc[6]="selected";
        break;
        default:
        $tAwal=0;
        break;
    }

 
 ?>
 
 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar Produk</li>
      </ol>
      <br/>
        <h1>
       
         <b>DAFTAR PENERIMA VOUCHER <?=$arvoc[1]?></b>
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content" >
    <?php
  	$message = $this->session->flashdata('pesan');
    echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
    <!--NAV-->
   <div class="well">
       <form class="form-horizontal" role="form">
        <label for="inputEmail3" class="control-label">Pilih Voucher</label>
      
         <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
          <option disabled selected>PILIH VOUCHER <span class="pull-left"></span></option>
          <option value="?vo=1" <?=$arvoc[2]?>>VOUCHER Makan <span class="pull-left"></span></option>
          <option value="?vo=2" <?=$arvoc[3]?>>VOUCHER RMD & THR <span class="label"></span></option>
          <!-- <option value="?vo=3" <?=$arvoc[4]?>>VOUCHER Parsel Lebaran <span class="pull-left"></span></option> -->
          <option value="?vo=4" <?=$arvoc[5]?>>VOUCHER Mahasiswa <span class="pull-left"></span></option>
          <option value="?vo=5" <?=$arvoc[6]?>>VOUCHER GAJI 13 <span class="pull-left"></span></option>
        </select>
      </form>
   </div>

  <?php
  //
  if ($tAwal==1) {
    ?>
    <div class="well">
       <form class="form-horizontal" role="form">
        <div class="input-group" style="padding: 5px">
        <label for="inputEmail3" class="control-label">Pilih Status Unit</label>
          <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
          <option value="#0">Pilih Status</option>
          <?php
          $stnam='SEMUA';
          $gt_stjob=$this->M_voucher->get_stjob();
          foreach($gt_stjob->result_array() as $va){
          $sl='';
              if($statusP==$va['id_job']){ 
              $sl='selected';
              $stnam=$va['nama_job'];
              }
              ?>
              <option value="<?=base_url('Master_admin/list_penerima_voucher/?vo='.$dvo.'&job='.$va['id_job'])?>"  
                <?=$sl?> ><?=$va['nama_job']?>
              </option>

              <?php
              }
              ?>
          </select>
        </div>

      <?php
      
      if ($statusP==3) {

       $statprodi;


      ?>
      <div class="input-group" style="padding: 5px">
        <span class="input-group-addon" id="basic-addon1">PRODI</span>
                    <select name="sortprodi" class="form-control"  onchange="loadPage(this.form.elements[1])">

                      <option value="#0">Pilih Prodi</option>

                      <?php
                      
                      $gjob=$this->M_setapp->get_tbl_fak_prodi();

                      foreach($gjob->result() as $jb){
                         $slpro='';
                         if($statprodi==$jb->kode_nim){$slpro='selected';}
                          ?>

                           <option value="<?=base_url('Master_admin/list_penerima_voucher/?vo='.$dvo.'&job='.$statusP.'&prodi='.$jb->kode_nim)?>" 
                            <?=$slpro?>> <?=$jb->kode_nim?> - <?=$jb->nama_prodi?>  
                           </option>

                          <?php

                      }

                      ?>
                    </select>
                
                
      </div>

      <?php
      }
      ?>


        </form>
      <?php
      if ($statusP==null) {}elseif ($statusP==3&&$statprodi==null) {}else {
      ?>

      <div class="well">
       <form class="form-horizontal" role="form">
        <label for="inputEmail3" class="control-label">Pilih Edisi Voucher</label>
      
         <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
          <option disabled selected>PILIH EDISI VOUCHER </option>
          <?php
            if ($gEdisiVoc->num_rows() > 0) {
              foreach ($gEdisiVoc->result() as $evoc) {
                $slevoc='';
                if($Evoc==$evoc->id_voc){$slevoc='selected';}  
                  echo "<option value=\"?vo=$dvo&job=$statusP&prodi=$statprodi&Evoc=$evoc->id_voc\" $slevoc > Edisi $evoc->id_voc </option>";
              }
            }
          ?>
          
        </select>
      </form>
   </div>
   <?php 
    }
    ?>
   </div>



  <?php
    if ($Evoc!=null) {
    $dataN['get_all_id_produk']=$this->M_dompetall->pemesanVouEdisi($Evoc,$idjov,1,$statusP,$dvo,$statprodi); //
  
      ?>
      <a href="<?=base_url('C_cetak/penerimaVoc/'.$Evoc.'/'.$idjov.'/1/'.$statusP.'/'.$dvo.'/'.$statprodi)?>" class="btn btn-warning" target="_blank|_self|_parent|_top|framename">CETAK</a>
      <?php
    $this->load->view('pages/master_admin/dompet/List/penerima_voucher',$dataN);
    }
  }
  

  ?>	
</section>
 
 <section class="content-header" style="background: #ecedee;">
    <?php
    #2d5726 makan
    #fb1d04 songsong
    #3d39c6 parsel
    
    
    $arvoc=['','','','','',''];
    
    
    switch ($dvo){
        case 1:
        $arvoc[0]="#2d5726";
        $arvoc[1]="MAKAN";
        $arvoc[2]="selected";
        break;
        case 2:
        $arvoc[0]="#fb1d04";
        $arvoc[1]="RAMADHAN & THR";
        $arvoc[3]="selected";
        break;
        case 3:
        $arvoc[0]="#3d39c6";
        $arvoc[1]="PARSEL LEBARAN";
        $arvoc[4]="selected";
        break;
        case 4:
        $arvoc[0]="#a65974";
        $arvoc[1]="MAHASISWA";
        $arvoc[5]="selected";
        break;
        default:
        $arvoc[0]="#2d5726";
        $arvoc[1]="MAKAN";
        $arvoc[2]="selected";
        break;
    }
    ?>
    
      <br/>
        <h1>
         <b>DAFTAR PEMESAN VOUCHER <?=$arvoc[1]?></b>
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
  <form class="form-horizontal" role="form">
    <label for="inputEmail3" class="control-label">Pilih Voucher</label>
  
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
      <option value="<?=base_url('C_dompet/dafatar_pemesan_voucher/1')?>?vo=1" <?=$arvoc[2]?>>VOUCHER Makan <span class="pull-left"> [ <?=$notvar[0]?> ]</span></option>
      <option value="<?=base_url('C_dompet/dafatar_pemesan_voucher/1')?>?vo=2" <?=$arvoc[3]?>>VOUCHER Songsong Ramadhan <span class="label"> [ <?=$notvar[1]?> ]</span></option>
      <option value="<?=base_url('C_dompet/dafatar_pemesan_voucher/1')?>?vo=3" <?=$arvoc[4]?>>VOUCHER Parsel Lebaran <span class="pull-left"> [ <?=$notvar[2]?> ]</span></option>
      <option value="<?=base_url('C_dompet/dafatar_pemesan_voucher/3')?>?vo=4" <?=$arvoc[5]?>>VOUCHER Mahasiswa <span class="pull-left"> [ <?=$notvar[3]?> ]</span></option>
      <option value="<?=base_url('C_dompet/dafatar_pemesan_voucher/4')?>?vo=5" <?=$arvoc[5]?>>VOUCHER GAJI 13 <span class="pull-left"> [ <?=$notvar[3]?> ]</span></option>
    </select>
  
  </form>
   </div>
	
	<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  
  
  <?php
  
  foreach($gt_stjob->result() as $gj){
   if($id_job==$gj->id_job){
       $act="active";
   }else{
       $act="";
       
   }   
   
   if($dvo!=4 and $gj->id_job==3){
       continue;
       
       
   }
   
   if($dvo==4 and $gj->id_job!=3){
       continue;
   }
   
   ?>
   <li class="<?=$act?>">
  <a href="<?=base_url('C_dompet/dafatar_pemesan_voucher/'.$gj->id_job.'?vo='.$dvo)?>">
  <b style="color: <?=$arvoc[0]?>;"><?=$gj->nama_job?></b>
  
  <?php
 
  $notnav=['','','','',''];
   
  switch ($dvo){
        case 1:
        $notnav[0]=$this->M_voucher->get_Pesan_voucher_noed($gj->id_job,$id_voc_s)->num_rows();
        
        break;
        case 2:
        $notnav[0]=$this->M_vparsel->get_Pesan_voucher_songsong($gj->id_job,$id_voc_song)->num_rows();
        
        break;
        case 3:
        $notnav[0]=$this->M_vparsel->get_Pesan_voucher_parsel($gj->id_job,$id_voc_par)->num_rows();
        
        break;
        default:
        $notnav[0]=$this->M_voucher->get_Pesan_voucher_noed($gj->id_job,$id_voc_s)->num_rows();
        
        break;
       
    }
  if($notnav[0] > 0){ ?>
  <span class="badge pull-right" style="background: #e2dd1d; color: #000000; margin-left: 10px"><?=$notnav[0]?></span> 		  	
  <?php
  }
  ?>
  
  
  </a>
  </li>
   <?php   
  }
  ?>
  
  
  
  
  
 
    <li role="presentation" class="dropdownilham"> <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents" aria-expanded="true"><b>Menu Tab</b> <span class="caret"></span></a>
      <ul class="dropdown-menu dropdown-menuilham" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
      </ul>
    </li>
    
    <!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>

<!-- Single button -->
<div class="btn-group">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    Action <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li class="divider"></li>
    <li><a href="#">Separated link</a></li>
  </ul>
</div>
</ul>

<div class="box">
<div class="tab-content">
  <div class="tab-pane active" id="home"><?php $this->load->view($isi) ;?>
  </div>
</div>
</div>	
	
    </section>
    
   
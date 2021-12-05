
<link rel="stylesheet" href="<?=base_url('cssilham/gRinciKategori.css')?>">

 <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    <h4>
      <a href="<?=base_url('Welcome/allkategori')?>"><?=$title2?></a> || <b>Kategori <?=$kat->row()->kategori?></b>
    </h4>
  </div>

  <div class="panel-body">
     <div class="row">  

     <?php
     //echo $gtog->num_rows();
                 if ($gtog->num_rows()>0){
        				 $no=1;
                 foreach($gtog->result() as $gt){ ?>
                   <?php
                    $gtjenid=$this->M_vparsel->get_jenis_voc_id($gt->jen_voc);
                    $icpar = '';
                    if($gtjenid->num_rows() > 0 and $gt->jen_voc >= 1){
                    $icpar = '<span  class="label label-warning">'.$gtjenid->row()->nama_jvoc.'</span>';    
                    }
                 $fotob = $this->M_setapp->static_bm().'/upload/barang/'.$gt->gambar; 			
             ///*/
    //------------------------
    //$fotob = 'http://static.jualretail.com/upload/barang/'.$gt->gambar; 
			 if($no++ <= 6){
			 	$la='src="'.$fotob.'"';
			 }else{
			 	$la='';
			 }
		?>



	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
    <style type="text/css">
      .qproduk{
        position: absolute;
        z-index: 0;
        padding-left: 140px;
        padding-right: 0px;
      }
    </style>
    <div class="thumbnail" >
    <!-- GAMBAR PRODUK -->
    
    <div class="produk">
      
    <a href="#" data-toggle="tooltip" data-placement="bottom" title="<?=$gt->nama?>"> 
      <img src="<?=$fotob?>" style="height: 200px; width: 200px" class="image img-responsive img-rounded" >
    </a>
    <?=$icpar?>
     <div class="middle" align="center">
       <a href="<?=base_url('Welcome/produk/'.$gt->id)?>" class="btn btn-primary btn-md">
        <i class="fa  fa-eye"></i> Lihat Rinci
       </a> <br/><br/>

      <?php $guser=$this->Muser->get_user_by_id($gt->id_user)->row(); ?>

      <a type="button" href="<?=base_url()?>/Welcome/profil_publik/<?=$gt->id_user?>/<?=$kat->row()->id?>/0" class="btn btn-info btn-md" data-toggle="tooltip" data-placement="bottom" title="<?=$guser->nama?>">
        <i class="fa  fa-fa-info-circle"></i> Penjual
      </a>

     </div>
    </div>

   <hr style="padding-bottom: 0px" />
    <!--HARGA-->
      <div class="caption"  style="padding-top: 00px ; height: 170px" >
        <?php
        ///NAMA PRODUK
        //$naexc=substr($gt->nama, 0, 30);
        $naexc=$gt->nama;
       // echo $gt->nama;
        $jmlhktjd=str_word_count($naexc);

        if($jmlhktjd >= 3){
            ?>
            <marquee  scrolldelay="200"><h5 style="margin-top: -3px;margin-bottom: -3px"><b><a href="<?=base_url('Welcome/produk/'.$gt->id)?>"><?=$naexc?></a></b></h5></marquee>
            <?php
        }else{
            ?>
           <h5 style="margin-bottom: 0px"><b><a href="<?=base_url('Welcome/produk/'.$gt->id)?>"><?=$naexc?></a></b></h5>
            <?php
        }
        ?>

        <?php
         //HARGA
         if(($gt->hargak)){

         if($gt->harga <= $gt->hargak){

    		 echo ' <h4 class="text-danger">Rp '.number_format($gt->hargak,2,',','.').'<br/> ';
    		 }else{

    		 echo ' <h4 class="text-danger"><small><del>Rp '.number_format($gt->harga,2,',','.').'</del></small><br/> ';	
         echo ' <h4 class="text-danger">Rp '.number_format($gt->hargak,2,',','.').'<br/> '; 

    		 }


        }else{
         echo ' <h4 class="text-danger">Rp '.number_format($gt->harga,2,',','.').'<br/> '; 
        }

        echo "</h4>";

        ?>

         <?php 
          //PERSEDIAN
            //============================================================
             $qty=$this->Mtrans->get_produkqty($gt->id);
            //============================================================
             $qty2pesan_id_user=$this->Mtrans->get_produkqty_dipesan_keranjang($gt->id,$id_s);
            //============================================================
             $qty2pesan=$this->Mtrans->get_produkqty_dipesan($gt->id);  ///id_produk
            //============================================================
            	$stoka=$gt->stok-$qty;

            	if($id_k==4){
                //khusus kat jasa
            		echo'<p>&nbsp;</p>';	
            	}else{
						
                if($stoka>0){
          ?>
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
        
          ?>  

      </div>
	</div>
  </div>

				 <?php 

        }
        // print_r($this->M_rProduk->getProdukId($gt->id));
  }else{
  ///KATEGORI KOSONG
  ?>
 	<div class="alert alert-danger">Belum ada barang yang dijual dalam kategori ini.</div>
 <?php } ?>  

      </div>

    <div id="demo" align='center'  class="well"> 
      <p><?php echo $halaman; ?> </p>
      <p align="left">
        <a class="text-lift" href="#">Back to top</a>
        <span class="pull-right">Total <?=$total_rows;?></span>
      </p> 
    </div>



      </div>

</div>
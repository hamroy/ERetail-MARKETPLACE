<div class="row">

        <div class="col-md-5 col-xs-12">
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
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
      
        <?php
            $get_all_id_produk_perkategori=$this->Madmin->get_all_id_produk_perkateggori_master();
		 if($get_all_id_produk_perkategori->num_rows() > 0){
		 	foreach($get_all_id_produk_perkategori->result() as $kat){ 
		 	$getnmakat=$this->Madmin->get_nama_kat_perid($kat->id_k);
		 	$gtog_mn=$this->Muser->get_produk_by_kat_id_pe($kat->id_k,$id_user);

      if($getnmakat->num_rows()==0){

        continue;

      }

		 	?>
		 	<li class="list-group-item"><a href="<?=base_url('Welcome/profil_publik/'.$id_user.'/'.$kat->id_k.'/'.$id_produk)?>"><span>- <?=$getnmakat->row()->kategori?></span><span class="badge pull-right"><?=$gtog_mn->num_rows()?></span></a></li>
		 	
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
 <section class="content-header" style="background: #ecedee;">
      <h1 class="well">
         <b>DAFTAR PRODUK</b>
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
     <?php
    //cek batas produk baru=100

    $cek = $this->Modelnya_prayudi->jumlah_barang_baru_belum_acc();
    if ($cek->num_rows() < 101){
    ?> 
    <h3 class="box-title">Tambah Produk</h3>
     <div class="box box-info">
     <div class="box box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a  href="<?=base_url('C_user_admin/addproduk')?>">
                      <i class="fa fa-plus"></i>  Tambah Produk
                      </a>
                    </h4>
                  </div>
                 
                </div>
              
              </div>
            </div>
    </div>

<?php }
?>
     <!--ISI per kategori-->
    <h3 class="box-title">Daftar Produk</h3>
		 <?php
     //get_all_grupkat
		 $get_all_id_produk_perkategori=$this->M_produk->get_all_grupkat($this->session->userdata('id_user'));
  		 if($get_all_id_produk_perkategori->num_rows() > 0){
  		 foreach($get_all_id_produk_perkategori->result() as $kat){ 
		 	  $getnmakat=$this->Madmin->get_nama_kat_perid($kat->id_k);
		 	///===========================================================D====================================
             $nkat='kosong';
             if($getnmakat->num_rows()>0){
                $nkat=$getnmakat->row()->kategori;
             }
		 	///===========================================================D====================================
             
      $get_all_id_produk=$this->M_produk->get_dataproduk($this->session->userdata('id_user'),$kat->id_k);     
		 	?>
				 <div class="box box-info">
            <div class="box-header with-border">
      
                <a type="btn" class="btn btn-box-tool" style="font-size: 27px; color: #106710" 
                href="<?=base_url('User_admin/dafprd_kategori/'.$kat->id_k)?>"><i class="fa fa-cube"></i>
                Daftar Kategori <?=$nkat?>  [ <?=$get_all_id_produk['total_tdel']?> ]
                </a> 
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
	</div>
				
				
			<?php 
			///===============================================================================================
			} //poor kategori
		 } //if kategori
		 ?>
		

    
     <!--ISI per kategori-->
     
  
	
    </section>
    

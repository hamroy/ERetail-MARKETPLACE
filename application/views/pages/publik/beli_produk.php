<div class="container">
<br/>
<?php
	    $message = $this->session->flashdata('pesanvo');
    	echo $message == '' ? '' : '<div class="alert alert-danger" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
  <div class="panel panel-default">
  <!-- Default panel contents -->
      
			
  <div class="panel-heading"><h4><a href="<?=base_url('Welcome/allkategori')?>"><?=$title2?></a> || Data Pembelian</h4>  </div>
  <div class="panel-body">
  
     <div class="container-fluid">
     <div class="row">

     	<?php
     		
		$gs=$this->session->userdata();

			

		if(($this->session->userdata('login')==TRUE and $this->session->userdata('wewenang')=='user')){

			if($gs['status_job'] < 3){ //1000 == pwa
			  //produk kopkar
			  //
			$cproduk = $this->Mtrans->cekProdukDibeli($id_user);  
				if ($cproduk['p_kopkar']==0) {
					$this->load->view('beliproduk/beliproduk');
				}else{
				 	$this->load->view('beliproduk/beliproduk');
				}

			}elseif($gs['status_job']==1001 or $gs['status_job']==3){
				$this->load->view('beliproduk/beliproduk');
			}else{

				$this->load->view('beliproduk/beliproduk');	
			}

		}else{
			$this->load->view('beliproduk/beliproduk');	
		}


			
  
     	?>
    


     </div>
	
     
     </div>
  </div>

 
</div>
</div>

<?php

//echo 'as'.$this->session->userdata('id_pembeli_id_pembeli');
//echo 'as2'.$this->session->userdata('id_pembeli');
//echo $this->Mtrans->get_total_tbltransaksi($id_pembeli).'==<.><.>===';	
//echo $this->Mtrans->get_voucher_tbluser($id_pembeli);	

$gettotal = $this->Mtrans->get_total_tbltransaksi($id_pembeli);	//tbltransaksi
//$gettotal_parsel = $this->M_vparsel->get_total_tbltransaksi_vparsel($id_user,2);	//tbltransaksi
		$getvou = $this->Mtrans->get_voucher_tbluser($id_pembeli);	 //tblambil voucher di tbl user
		
		///if voucher lebih besar dari total belanja
		if($getvou >=$gettotal){ //lolos
		//	echo 'lolos';
			
		}else{ //gagal
		
	//	echo 'gagal';
		
		} //perbandingan vouchet dan total belanja
        
        
        

?>
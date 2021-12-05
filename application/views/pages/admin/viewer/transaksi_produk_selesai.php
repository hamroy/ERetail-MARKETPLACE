 <section class="content-header" style="background: #ecedee;">
      <h1>
         <b>TRANSAKSI SELESAI</b>
        <small></small>
      </h1>
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-cube"></i> Produk</a></li>
        <li class="active">Transaksi</li>
      </ol>
    </section>

    <!-- Main content -->
     <section class="content">
    <?php
	   $message = $this->session->flashdata('pesan');
     echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
	
	<div class="box box-info">
            <div class="box-header with-border">

             
            <!-- /.box-header -->
            <div class="box-body">
            
              	
<br/>            
              <div class="table-responsive">
               <table class="table no-margin table-striped table-hover js-basic-example dataTable">
                  <thead>
                  <tr bgcolor="#b7bdb8">
                    <th>No</th>
                    <th>No. Kuitansi</th>
                    <th>Nama Pembeli</th>
                    <th>Produk</th>
                    <th>Qty / Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai</th>
                    <th>Pembayaran</th>
                    <th>MENU</th>
                  </tr>
                  </thead>
                 
                  <tbody>
                  <?php 
                  
                  
                  
                
				  $get_id_produk=$this->Madmin->get_all_transaksi_selesai($this->session->userdata('id_user'));
				 
				   $no=1;
				   $totperbln=$this->M_transaksiAkun->totPendapatanAkunSelesai()['totalPendapatan'];
				   $totvoc=$this->M_transaksiAkun->totPendapatanAkunSelesai()['voucherSelesai'];
				   $tottunai=$this->M_transaksiAkun->totPendapatanAkunSelesai()['tunaiSelesai'];
           
          foreach($get_id_produk->result() as $gidp){

          $getpembeli=$this->M_transaksiAkun->getDataPembeli($gidp->id_pembeli,$gidp->id_user)['nama']; 
          $getpenjual=$this->M_transaksiAkun->getDataPembeli($gidp->id_pembeli,$gidp->id_pelapak)['nama']; 
          $getproduk=$this->M_transaksiAkun->getDataProduk($gidp->id_produk)['nama']; 

			  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><?=$gidp->id_kuitansi?></td>
                    <td><?=$getpembeli?></td>
                    <td><?=$getproduk?></td>
                    <td align="right">
                    <?php
            
                      $akhirsat=$gidp->harga_satuan;

                    ?>
                    <?=$gidp->qty?>/
                    <?=number_format($akhirsat,0,',','.')?></td>
                    <td align="right"><?=number_format($akhirsat*$gidp->qty,0,',','.')?></td>
                   
                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>
                    <td><?=$gidp->metode?></td>

                    <!--menu-->
                    <td><a href="<?=base_url('C_cetak/cetak_transaksi_selesai/awal/'.$gidp->id)?>" target="_blank"><i class="fa fa-print"> Cetak</i> </a></td>
                   
                  </tr>  
      			   	<?php	
      					
      					}
                        ////di susun perbulan
                  ?>
                  
                  </tr>
                  
                  <?php
					
                  ?>
                                
                     </tbody>
                     </table>
                     
       <!-- -==========================================================================================- -->
                     <table class="table">
                     
                 <tr style="background-color: #b3b3b9">
                  	<td colspan="1" align="left">
                  
                   <b>Total TUNAI</b>
                  	</td>
                  	<td colspan="2"  align="right">
                  	<b><?=number_format($tottunai,0,',','.')?> </b>                 	</td>
                  </tr>
                   <tr style="background-color: #b3b3b9">
                  	<td colspan="1" align="left">
                  
                   <b>Total VOUCHER </b>
                  	</td>
                  	<td colspan="2"  align="right">
                  	<b><?=number_format($totvoc,0,',','.')?> </b>                 	</td>
                  </tr>
                   <tr style="background-color: #b3b3b9">
                  	<td colspan="1" align="left">
                  
                   <b>Total PENDAPATAN</b>
                  	</td>
                  	<td colspan="2"  align="right">
                  	<b><?=number_format($totperbln,0,',','.')?> </b>                 	
                    </td>
                    </tr>
                    
                </table>
               
                 </div>
                  <!-- /.table-responsive -->
                 </div>
                 <!-- /.box-body -->
          
                  <!-- /.box-footer -->
                 </div>
	
		 </div>
    </section>
    
   
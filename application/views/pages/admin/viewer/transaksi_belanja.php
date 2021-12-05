 <section class="well content-header" style="background: #ecedee;">
      <h1>
         <b>RIWAYAT TRANSAKSI BELANJA</b>
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

              <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                 <table class="table table-striped table-hover js-basic-example dataTable">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>No. Tagihan</th>
                    <th>No. Kuitansi</th>
                   
                    <th>Nama Penjual</th>
                    <th>Produk</th>
                    <th>Kuantitas | Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai Transaksi</th>
                    <th>Pembayaran</th>
                    <th>PROSES</th>
                    <th>MENU</th>
                  </tr>
                  </thead>
                 
                  <tbody>
                  <?php 
                  
                  
                  
                
				  	
					//$get_id_produk=	$get_id_produk=$this->Madmin->get_all_transaksi($this->session->userdata('id_user'));
					$get_id_produk=	$get_id_produk=$this->Madmin->get_all_transaksi_id_user($this->session->userdata('id_user'));
				   $no=1;
           $totperbln=$this->M_transaksiAkun->totBelanjaAkunSelesai()['totalBelanja'];
           $totvoc=$this->M_transaksiAkun->totBelanjaAkunSelesai()['voucherSelesai'];
           $tottunai=$this->M_transaksiAkun->totBelanjaAkunSelesai()['tunaiSelesai'];
				   
				   $vpesan=$this->M_transaksiAkun->totBelanjaAkunSelesai()['voucherDipesan'];
           $vproses=$this->M_transaksiAkun->totBelanjaAkunSelesai()['voucherDiproses'];
           $totvoc_bacc=$vpesan+$vproses; 
           //
          foreach($get_id_produk->result() as $gidp){
					
          $getpenjual=$this->M_transaksiAkun->getDataPembeli($gidp->id_pembeli,$gidp->id_pelapak)['nama']; 
          $getproduk=$this->M_transaksiAkun->getDataProduk($gidp->id_produk)['nama']; 
          $statrans=$this->M_transaksiAkun->prosesTransaksi($gidp->buy); 
                    
					
          $list_kd = $this->Mbank->cek_transaksi_pembeli($gidp->id_pembeli,$gidp->id_tgl);	//tbltransaksi
          
          $idtagihan=$gidp->id_tgl;

          if($list_kd->num_rows() > 0){
              $idtagihan=$list_kd->row()->notagihan;
          }
                      
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><?=$idtagihan?> </td>
                    <td><?=$gidp->id_kuitansi?></td>
                     <td><?=$getpenjual?></td>
                    <td><?=$getproduk?></td>
                    <td align="right">
                    
                    <?=$gidp->qty?> |
                    
                    <?=number_format($gidp->harga_satuan,0,',','.')?>
                      
                    </td>
                    <td align="right"><?=number_format($gidp->harga_satuan*$gidp->qty,0,',','.')?></td>
                   
                    <td><?=$gidp->tgl_trans?></td>
                    <td><?=$gidp->tgl_otorisasi?></td>
                    <td><?=$gidp->metode?>
                    
                    </td>
                    <td><?=$statrans?></td>
                    
                    <!--MENU-->
                    <td>
                    <?php
                    if($gidp->buy=='dibayar'){
                    ?>
                        <a href="<?=base_url('C_cetak/cetak_transaksi_selesai/awal/'.$gidp->id)?>" target="_blank"><i class="fa fa-print"> Cetak selesai</i> </a>
                    <?php
                    }
                    ?>    
                    <a href="<?=base_url('C_cetak/cetak_pesan_barang_admin/awal/'.$gidp->id)?>" target="_blank"><i class="fa fa-print"> Cetak Pesan</i> </a>    
                    </td>
                   
                  </tr>  
				<?php	
					//echo $totperbln=$totperbln+$akhirsat*$gidp->qty;
					}
                  ////di susun perbulan
                  ?>
                  
                  <?php
					
                  ?>
                   
                  </tbody>
                </table>
                <!-- ///==============================================================\\\\ -->
                <table class="table">
                 <tr>
                  <td></td>
                  	<th>A. TOTAL TUNAI</th>
                  	<td><?=number_format($tottunai,0,',','.')?></td>
                  </tr>
                   <tr>
                                     <td></td>

                  	<th>B. TOTAL VOUCHER BELUM DIACC <small>(PESAN)</small></th>
                  	<td><?=number_format($totvoc_bacc,0,',','.')?></td>
                  </tr> 
                  <tr>
                                     <td></td>

                  	<th>C. TOTAL VOUCHER SUDAH DIACC <small>(SELESAI)</small></th>
                  	<td><?=number_format($totvoc,0,',','.')?></td>
                  </tr>
                  <tr>
                                    <td></td>

                  	<th>D.TOTAL PENGELUARAN <small>(D=A+C)</small></th>
                  <td><?=number_format($tottunai+$totvoc,0,',','.')?></td>
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
    
   
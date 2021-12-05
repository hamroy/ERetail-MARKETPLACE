<div class="container-fluid">
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Keranjang Belanja</h3>
  </div>
  <div class="panel-body">
  <form method="post" action="<?=base_url('Welcome/proses_keranjang/')?>">
    <table class="table table-bordered">
    	<tr>
    		<td>No. </td>
    		<td>Pelapak</td>
    		<td>Barang</td>
    		<td>Qty.</td>
    		<td>Harga Satuan</td>
    		<td>Sub Total</td>
    	</tr>
<?php
            if($this->session->userdata('login')==FALSE){
			$list = $this->Mtrans->lihat_keranjang_by_pembeli($this->session->userdata('id_pembeli'));	
			}else{
			$list = $this->Mtrans->lihat_keranjang_by_pelapak($this->session->userdata('id_user')); ///bila user
			}
            $subtot = 0;
            ?>    	
            
            
    	<?php
    	
    	if ($list->num_rows()>0){
    		$no = 1;
    		foreach($list->result() as $t){
    			$barang = $this->Muser->get_produk_by_id($t->id_produk);
    			$namapelapak = $this->Muser->get_user_by_id($barang->row()->id_user)->row()->nama;
    			?>
		<tr>
    		<td><?=$no++?><a href="#"><span class="pull-right"><input type="checkbox" name="k_<?=$t->id?>" value="<?=$t->id?>"  class="flat-red" checked></span></a></td>
    		<td><?=$namapelapak?></td>
    		<td><?=$barang->row()->nama?></td>
    		<td><?=$t->qty?></td>
    		<td align="right">Rp <?=number_format($barang->row()->harga,2,',','.')?></td>    	
    		<td align="right">Rp <?=number_format($t->qty * $barang->row()->harga,2,',','.')?></td>    	
    	</tr>
    		<?php
    		$subtot = $subtot + ($t->qty * $barang->row()->harga);
    		?>

			<?php }			
}
    	?>
    	    	<tr>
    		<td colspan="5" align="right"><b>Total</b></td>
    		<td align="right"><b>Rp <?php
    		if($subtot !=0 ){
			echo number_format($subtot,2,',','.');	
			}
    		?></b></td>
    	</tr>

    </table>
    <input type="submit" value="PROSES PEMBAYARAN" class="btn btn-danger" onclick="return confirm('Anda yakin?')">
    </form>
  </div>
</div>
</div>
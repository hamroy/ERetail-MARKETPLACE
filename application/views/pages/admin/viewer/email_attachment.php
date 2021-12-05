<html>

<body>

	<?php
	if (substr($idtblpembeli->row()->email, -9) == 'umy.ac.id') { ?>


		<table>
			<tr>
				<td><img src="<?base_url()?>umy.png" alt="" style="height: 100px; width: 120px" /></td>
				<td>

					<h3>BUKTI PEMBAYARAN BARANG / KUITANSI (E-Retail)</h3>
					<h4>Bukti Kuitansi Bisa Digunakan Sebagai Dokumen SKP</h4>
				</td>
			</tr>
			<tr>
				<td colspan="2">

				</td>
			</tr>

		</table>



	<?php		} else { ?>


		<table>
			<tr>
				<td>
					<h3>BUKTI PEMBAYARAN BARANG / KUITANSI (E-Retail)</h3>
				</td>
			</tr>
			<tr>
				<td colspan="2">

				</td>
			</tr>

		</table>


	<?php
	} ?>

	<hr />
	<table border="0" width="70%">
		<tr>
			<td>No. Kuitansi</td>

			<td>: <?= $getidt->id_kuitansi ?></td>
		</tr>
		<tr>
			<td>Telah terima dari</td>
			<td>: <?= $idtblpembeli->row()->nama ?></td>
		</tr>
		<tr>

			<td>Tanggal transaksi</td>

			<td>: <?= $getidt->tgl_otorisasi ?></td>

		</tr>
		<tr>
			<td>Uang sejumlah </td>
			<td>: <i><?= $satuantot ?> Rupiah </i></td>
		</tr>

		<tr>
			<td>Untuk pembayaran </td>
			<td> :
			</td>
		</tr>
	</table>
	<table width="100%" style=" border: 1px solid black; border-collapse: collapse;">
		<tr style=" border: 1px solid black; background: #bbbcbd" align="center">
			<td style=" border: 1px solid black;">Nama Produk</td>
			<td style=" border: 1px solid black;">Qty</td>
			<td style=" border: 1px solid black;">Harga</td>
			<td style=" border: 1px solid black;">Sub Total</td>
		</tr>
		<tr style=" border: 1px solid black;">
			<td align="center" style=" border: 1px solid black;"><?= $idtblproduk->row()->nama ?></td>
			<td align="center" style=" border: 1px solid black;"><?= $getidt->qty ?></td>
			<td align="right" style=" border: 1px solid black;"><?= number_format($getidt->harga_satuan, 2, ',', '.') ?></td>
			<td align="right" style=" border: 1px solid black;"><?= number_format($getidt->qty * $getidt->harga_satuan, 2, ',', '.') ?></td>
		</tr>
		<tr style=" border: 1px solid black;">
			<td colspan="3" align="right" style=" border: 1px solid black;">Ongkos Kirim</td>
			<td colspan="1" align="right" style=" border: 1px solid black;"><?= number_format(0, 2, ',', '.') ?></td>
		</tr>
		<tr style=" border: 1px solid black;">
			<td colspan="3" align="right" style=" border: 1px solid black;">TOTAL</td>
			<td colspan="1" align="right" style=" border: 1px solid black;"><?= number_format(($getidt->qty * $getidt->harga_satuan) + 0, 2, ',', '.') ?></td>
		</tr>
	</table>
	<br /><br />
	<table border="0" width="100%">

		<tr>
			<td width="70%"></td>
			<td align="center">Surakarta, <?= $tanggal ?></td>
		</tr>
		<tr>
			<td align="left">Terbilang : Rp <?= number_format(($getidt->qty * $getidt->harga_satuan) + 0, 2, ',', '.') ?></td>
		</tr>
		<tr>
			<td width="70%"></td>
			<td align="center">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%"></td>
			<td align="center">&nbsp;</td>
		</tr>
		<tr>
			<td width="70%"></td>
			<td align="center"><?= $idtblpelapak->row()->nama ?></td>
		</tr>
	</table>


	<p align="center"><img src="<?base_url()?>dist/img/lunas.png" alt="" style="height: 50px; width: 200px" /></p>

</body>

</html>
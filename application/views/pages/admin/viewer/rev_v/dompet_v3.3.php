 <section class="content-header" style="background: #ecedee;">

 	<h1>

 		<b>DOMPET E-Retail</b>

 		<small></small>

 	</h1>



 </section>



 <!-- Main content -->

 <section class="content">

 	<?php

		$message = $this->session->flashdata('pesan');

		echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

		?>

 	<?php

		$message0 = $this->session->flashdata('pesan0');

		echo $message0 == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message0 . '</p></div>';

		?>

 	<!--NAV-->





 	<?php

		$gt_tblpesanvoucher = $this->Login_model->get_daftar_pesan_voucher($id_user);



		$gt_tblinputpesanvoucher_select_tahap = $this->Login_model->get_daftar_input_voucher_st($id_user);

		$gt_tblinputpesanvoucher_tahap_no = $this->Login_model->get_daftar_input_voucher_st_no($id_user);

		// echo $th=$gt_tblinputpesanvoucher_select_tahap;

		$th = $gt_tblinputpesanvoucher_tahap_no; ///tahap tahap [paten]

		$no_edisi = $gt_tblinputpesanvoucher_select_tahap;   /// edisi 

		$th2 = $th + 1; ///lanjut disi





		$gt_tblinputpesanvoucher = $this->Login_model->get_daftar_input_voucher($id_user, $th);

		// echo 'ilham '.$gt_tblpesanvoucher->num_rows();

		if ($gt_tblpesanvoucher->num_rows() > 0) {



			////REV 011017

			$s_aw0 = $gt_tblpesanvoucher->row()->pesan_voc;

			if ($s_aw0 == 0) {

				$s_aw = 2;  ///awal TETAP

				$idisi = $no_edisi + 1; ///lsnnjut data baru

			} else {

				$s_aw = $s_aw0; ////TEAP DATA LAMA //baru

				$idisi = $s_aw0; //lanjut bila data lama

			}

			//echo 'tAHAP voucher awal'. $s_aw; 

			//echo '</br>EDISI voucher lanjut'. $idisi; 

			////REV 011017



			if ($gt_tblpesanvoucher->row()->pesan_voucer == '1') {

				//...sudah berhasil tahap 1 -->mulai ke tahap 2

		?>

 			<div class="row">

 				<div class="col-md-4">

 					<div class="callout callout-info">

 						<h4>Selamat Berbelanja Menggunakan Dompet E-Retail





 						</h4>

 					</div>

 				</div>

 				<!--voucher 2-->

 				<!--voucher 2-->

 				<div class="col-md-4">

 					<?php

						if ($gt_tblinputpesanvoucher->num_rows() > 0) { //tbl input vocher sudah ada

							if ($gt_tblinputpesanvoucher->row()->status == 0) { ?>

 							<div class="callout callout-success">

 								<h4>Voucher Sedang Diproses</h4>

 							</div>



 						<?php



							} elseif ($gt_tblinputpesanvoucher->row()->status == 99) {

								////buat setelah di tolak

							?>

 							<div class="callout callout-success">

 								<h4>Untuk Mendapatkan Voucher Makan



 									<a onclick="return confirm('Anda Yakin !')" href="<?= base_url('C_dompet/pesan_voucher_t2/' . $id_user . '/' . $th . '/' . $s_aw) ?>">

 										<i class="fa fa-hand-o-right"></i> klik disini

 									</a>

 								</h4>

 							</div>



 						<?php

							} else {



								/////LANJUT voucher makan selanjutnuya



							?>

 							<div class="callout callout-success">

 								<h4>Untuk Mendapatkan Voucher Makan



 									<a onclick="return confirm('Anda Yakin !')" href="<?= base_url('C_dompet/pesan_voucher_t2/' . $id_user . '/' . $th2 . '/' . $idisi) ?>">

 										<i class="fa fa-hand-o-right"></i> klik disini

 									</a>

 								</h4>

 							</div>

 						<?php



							}

							?>

 					<?php

						} else {

							///new input pesan voucher

						?>



 						<div class="callout callout-success">

 							<h4>Untuk Mendapatkan Voucher Makan



 								<a onclick="return confirm('Anda Yakin !')" href="<?= base_url('C_dompet/pesan_voucher_t2/' . $id_user . '/2/' . $s_aw) ?>">

 									<i class="fa fa-hand-o-right"></i> klik disini

 								</a>

 							</h4>

 						</div>



 					<?php



						}



						?>



 				</div>

 				<!--voucher bonus-->

 				<div class="col-md-4">

 					<div class="callout callout-warning">

 						<h4 style="color: #000000">Untuk Mendapatkan Bonus Voucher



 							<a onclick="return confirm('Anda Yakin !')" style="color: #000000" href="<?= base_url('C_dompet/pesan_voucher_t2_bonus/' . $id_user . '/' . $th2 . '/' . $idisi) ?>">

 								<i class="fa fa-hand-o-right"></i> klik disini

 							</a>

 						</h4>

 					</div>

 				</div>

 				<!--voucher bonus-->





 			</div>





 		<?php

			} elseif ($gt_tblpesanvoucher->row()->pesan_voucer == '99') { //...gagal tahap 1



			?>



 			<div class="row">

 				<div class="col-md-4">

 					<div class="callout callout-info">

 						<h4>Voucher Saudara tidak di setujui.

 						</h4>

 					</div>

 				</div>

 				<div class="col-md-4">

 					<?php

						if ($gt_tblinputpesanvoucher->num_rows() > 0) {

							if ($gt_tblinputpesanvoucher->row()->status == 0) { ?>

 							<div class="callout callout-success">

 								<h4>Voucher Sedang Diproses</h4>

 							</div>



 						<?php



							} elseif ($gt_tblinputpesanvoucher->row()->status == 99) {

							?>

 							<div class="callout callout-success">

 								<p>Permintaan voucher tidak di acc</p>

 								<h4>Untuk Mendapatkan Voucher Makan



 									<a onclick="return confirm('Anda Yakin !')" href="<?= base_url('C_dompet/pesan_voucher_t2/' . $id_user . '/' . $th) ?>">

 										<i class="fa fa-hand-o-right"></i> klik disini

 									</a>

 								</h4>

 							</div>



 						<?php

							} else { ?>

 							<div class="callout callout-success">

 								<p>Selamat belanja.</p>

 								<h4>Untuk Mendapatkan Voucher Makan



 									<a onclick="return confirm('Anda Yakin !')" href="<?= base_url('C_dompet/pesan_voucher_t2/' . $id_user . '/' . $th2) ?>">

 										<i class="fa fa-hand-o-right"></i> klik disini

 									</a>

 								</h4>

 							</div>

 						<?php



							}

							?>

 					<?php

						} else { ?>



 						<div class="callout callout-success">

 							<h4>Untuk Mendapatkan Voucher Makan



 								<a onclick="return confirm('Anda Yakin !')" href="<?= base_url('C_dompet/pesan_voucher_t2/' . $id_user . '/2') ?>">

 									<i class="fa fa-hand-o-right"></i> klik disini

 								</a>

 							</h4>

 						</div>



 					<?php



						}



						?>



 				</div>

 				<!--voucher bonus-->

 				<div class="col-md-4">

 					<div class="callout callout-warning">

 						<h4 style="color: #000000">Untuk Mendapatkan Bonus Voucher



 							<a onclick="return confirm('Anda Yakin !')" style="color: #000000" href="<?= base_url('C_dompet/pesan_voucher_t2_bonus/' . $id_user . '/' . $th2 . '/' . $idisi) ?>">

 								<i class="fa fa-hand-o-right"></i> klik disini

 							</a>

 						</h4>

 					</div>

 				</div>

 				<!--voucher bonus-->

 			</div>







 		<?php



			} else { //...menunggu tahap 1

			?>





 			<div class="row">

 				<div class="col-md-6">



 					<div class="callout callout-info">

 						<h4>Voucher UMY sebesar Rp. 200.000 Sedang Diproses

 						</h4>

 					</div>

 				</div>

 				<!--voucher bonus-->

 				<div class="col-md-6">

 					<div class="callout callout-warning">

 						<h4 style="color: #000000">Untuk Mendapatkan Bonus Voucher



 							<a onclick="return confirm('Anda Yakin !')" style="color: #000000" href="<?= base_url('C_dompet/pesan_voucher_t2_bonus/' . $id_user . '/2/2') ?>">

 								<i class="fa fa-hand-o-right"></i> klik disini

 							</a>

 						</h4>

 					</div>

 				</div>

 				<!--voucher bonus-->

 			</div>









 		<?php

			}
		} else {  //...belum merespon tahap 1

			?>



 		<div class="row">

 			<div class="col-md-6">



 				<div class="callout callout-info">

 					<h4>Untuk Mendapatkan Voucher UMY sebesar Rp. 200.000 (Belaku s/d 31 januari 2018)



 						<a data-toggle="modal" data-target="#myModalgambarvc" href="#">

 							<i class="fa fa-hand-o-right"></i> klik disini

 						</a> (Hanya Sekali)

 					</h4>

 				</div>

 				<div class="modal fade" id="myModalgambarvc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

 					<div class="modal-dialog">

 						<div class="modal-content">

 							<div class="modal-header">

 								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

 								<h4 class="modal-title" id="myModalLabel">Form</h4>

 							</div>

 							<div class="modal-body">

 								<form class="form-horizontal" action="<?= base_url('C_dompet/pesan_voucher/' . $id_user) ?>" method="post" enctype="multipart/form-data">

 									<div class="box-body">







 										<div class="form-group">

 											<label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000">NIK</label>



 											<div class="col-sm-9">

 												<input type="text" class="form-control" value="" style="border-radius: 6px" name="nik" id="inputEmail3" placeholder="NIK/NIP">

 												<small class="text-info">NIK/NIP 20 digit </small>

 											</div>

 										</div>



 										<div class="form-group">

 											<label for="inputEmail3" class="col-sm-3 control-label" style="color: #000000">Unit Kerja</label>



 											<div class="col-sm-9">

 												<input type="text" class="form-control" value="" style="border-radius: 6px" name="unit" id="inputEmail3" placeholder="Unit Kerja">

 											</div>

 										</div>











 									</div>

 									<!-- /.box-body -->

 									<div class="box-footer">



 										<button type="submit" class="btn btn-info pull-right btn-block btn-lg">Lanjut</button>

 									</div>

 									<!-- /.box-footer -->

 								</form>

 							</div>

 							<div class="modal-footer">

 								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

 							</div>

 						</div>

 					</div>

 				</div>

 			</div>

 			<!--voucher bonus-->

 			<div class="col-md-6">

 				<div class="callout callout-warning">

 					<h4 style="color: #000000">Untuk Mendapatkan Bonus Voucher



 						<a onclick="return confirm('Anda Yakin !')" style="color: #000000" href="<?= base_url('C_dompet/pesan_voucher_t2_bonus/' . $id_user . '/2/2') ?>">

 							<i class="fa fa-hand-o-right"></i> klik disini

 						</a>

 					</h4>

 				</div>

 			</div>

 			<!--voucher bonus-->

 		</div>









 	<?php

		}



		?>









 	<!--ISI per kategori-->









 	<div class="row">

 		<div class="col-xs-12 col-md-6">

 			<div class="panel panel-primary">

 				<!-- Default panel contents -->

 				<div class="panel-heading" align="center">
 					<h3> #1 Dompet E-Retail - Deposit</h3>
 				</div>

 				<div class="panel-body">

 					<table class="table no-margin">

 						<thead>

 							<tr bgcolor="#b7bdb8">

 								<th>Jenis Voucher</th>

 								<th>Saldo</th>

 							</tr>

 							<?php

								if ($gt_tblpesanvoucher->num_rows() > 0) {

									if ($gt_tblpesanvoucher->row()->pesan_voucer == '1') {

										$s1 = $gt_tblpesanvoucher->row()->saldo_awal; ////rev : 010917

									} else {

										$s1 = 0;
									}
								} else {

									$s1 = 0;
								}

								$a = 1;

								$b = $this->Madmin_master->get_riwayat_belanja_voucerdipake($id_user); //sudah di acc penjual

								$v11 = $b; // voucer sudah di pake

								//echo $b;

								$va[1] = $s1 - $v11; ///voucer awal

								if ($va[1] > 0) {

									$v0 = $va[1];
								} else {

									$v0 = 0;
								}

								?>

 						</thead>



 						<?php

							//?REV AAGUSTUS 2017

							$nm = $this->Madmin_master->get_tbl_input_voucher_perid_user($id_user); //sejajar dg yang di bawah

							$y = 2; //

							$totsaldo = 0;

							for ($x = 1; $x <= $nm->num_rows(); $x++) { ///num_rows

								if ($va[$x] < 0) { ///masih minus



									$va[$y] = $this->Madmin_master->get_tbl_input_voucher_perid_user_v($id_user, $y)->row()->saldo + ($va[$x]); ///get saldo tiap user dan tahap		

								} else {

									$va[$y] = $this->Madmin_master->get_tbl_input_voucher_perid_user_v($id_user, $y)->row()->saldo;
								}





								//  $totsaldo=$totsaldo+$va[$y]; 

								$y++;
							}







							?>

 						<!--VOUCER tahap 1-->

 						<tr>

 							<td>Ed 1. Voucher UMY</td>



 							<td title="Voucher UMY 200000">RP : <?= number_format($v0, 0, ',', '.') ?></td>

 						</tr>

 						<!--VOUCER tahap 2-->

 						<?php

							$get_input_voucer = $this->Madmin_master->get_tbl_input_voucher_perid_user($id_user);

							if ($get_input_voucer->num_rows() > 0) {

								$vv1 = 0;

								$totsaldo = 0;

								foreach ($get_input_voucer->result() as $vc) {







							?>

 								<tr>

 									<td>Ed <?= $vc->edisi ?>. <?= $vc->jenis ?></td>



 									<td title="<?= $vc->jenis ?>">RP :



 										<?php

											if ($va[$vc->tahap] > 0) {

												echo number_format($va[$vc->tahap], 0, ',', '.');

												$tot = $va[$vc->tahap];
											} else {

												echo 0;

												$tot = 0;
											}



											?>







 									</td>

 								</tr>



 						<?php

									$totsaldo = $totsaldo + $tot;
								}
							} //*/

							?>



 						<tr>

 							<td>TOTAL</td>

 							<td title="TOTAL">RP : <?= number_format($v0 + $totsaldo, 0, ',', '.') ?>



 								<?php

									if ($v0 + $totsaldo != $voucher_umy) {

										echo '<span class="glyphicon glyphicon-remove"></span>';
									}

									?>



 							</td>

 						</tr>

 					</table>





 				</div>





 			</div>

 		</div>

 		<div class="col-xs-12 col-md-6">

 			<div class="panel panel-danger">

 				<!-- Default panel contents -->

 				<div class="panel-heading" align="center">
 					<h3>#2 Deposit Dibelanjakan</h3>
 				</div>

 				<div class="panel-body">

 					<h4 align="center">RP : <?= number_format($voucher_dibelanjakan, 0, ',', '.') ?></h4>

 				</div>





 			</div>



 		</div>

 	</div>



 	<div class="row">

 		<div class="col-xs-12 col-md-6">



 			<div class="panel panel-success">

 				<!-- Default panel contents -->

 				<div class="panel-heading" align="center">
 					<h3>#3 Dompet E-Retail - Hasil Penjualan </h3>
 				</div>

 				<div class="panel-body">

 					<h4 align="center">RP : <?= number_format($dompet, 0, ',', '.') ?></h4>

 					<hr />

 					<?php

						if ($dompet > 0) { ?>

 						<a data-toggle="modal" type="button" class="btn btn-warning" data-target="#myModalgreedeem" href="#">

 							<i class="fa fa-money"></i> Redeem

 						</a>



 					<?php

						} else {

						?>

 						<a data-toggle="modal" type="button" class="btn btn-warning">

 							<i class="fa fa-money"></i> Redeem

 						</a>



 					<?php

						}



						?>

 					<div class="modal fade" id="myModalgreedeem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

 						<div class="modal-dialog">

 							<div class="modal-content">

 								<div class="modal-header">

 									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

 									<h4 class="modal-title" id="myModalLabel">Form</h4>

 								</div>

 								<div class="modal-body">

 									<form class="form-horizontal" action="<?= base_url('C_dompet/redeem_voucher/' . $id_user) ?>" method="post" enctype="multipart/form-data">

 										<div class="box-body">







 											<div class="form-group">

 												<label for="inputEmail3" class="col-sm-3 control-label " style="color: #000000">Redeem</label>



 												<div class="col-sm-9">

 													<input type="number" min="0" max="<?= $dompet ?>" class="form-control" value="" style="border-radius: 6px" name="redeem" id="inputEmail3" placeholder="Voucher yang Dicairkan">

 												</div>

 											</div>













 										</div>

 										<!-- /.box-body -->

 										<div class="box-footer">



 											<button type="submit" class="btn btn-info pull-right btn-block btn-lg prnt">Lanjut</button>

 										</div>

 										<!-- /.box-footer -->

 									</form>

 								</div>

 								<div class="modal-footer">

 									<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

 								</div>

 							</div>

 						</div>

 					</div>

 				</div>



 			</div>

 		</div>

 		<div class="col-xs-12 col-md-6">



 			<div class="panel panel-warning">

 				<!-- Default panel contents -->

 				<div class="panel-heading" style="background-color: #c6d22d" align="center">
 					<h3>#4 Redeem E-Retail</h3>
 				</div>

 				<div class="panel-body" style="height: 133px">

 					<h4 align="center">RP : <?= number_format($dompet_dicairkan, 0, ',', '.') ?></h4>

 				</div>



 			</div>





 		</div>

 	</div>













 	<!--ISI per kategori-->







 </section>
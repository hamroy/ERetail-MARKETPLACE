<!DOCTYPE html>
<html>

<head>
	<!--Tag head ini gunanya untuk penamaan tab pada browser.-->
	<meta charset="utf-8">
	<?php
	$title0 = "E-Retail";
	?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title0 ?></title>
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>image/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>image/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>image/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?= base_url() ?>image/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?= base_url() ?>image/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		#myProgress {
			width: 100%;
			height: 30px;
			position: relative;
			background-color: #ddd;
		}

		#myBar {
			background-color: #4CAF50;
			width: 100px;
			height: 30px;
			position: absolute;
		}
	</style>
</head>

<body>
	<!-- Tag body ini gunanya untuk mengisikan semua konten yang ada di dalam web-->
	<h1 align="center">DATA SEDANG DIPROSES</h1>
	<!--Judul Halaman Web-->
	<hr align="center" width="100%" color="#3a3634" size="2">
	<!--Untuk Membuat Garis-->
	<div id="myProgress">
		<div id="myBar"></div>

	</div>
	<hr />
	<a href="<?= base_url('Master_admin/verifikasi?nav=2') ?>" class="btn btn-primary showak hidden">KEMBALI</a>
	<hr />
	<br />


	<!--  -->
	<div class="list-group">
	</div>

	<?php
	$jsdata = json_encode($dpost);
	?>

	<!--  -->

	<script src="<?= $this->M_setapp->static_bm() ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			var dpost = <?= $jsdata ?>;
			var i = 0;
			var text = "";
			var bar = $('#myBar');
			var showak = $('.showak');
			var percentVal = 1;
			var numrows = dpost.length;

			function datarerima(i) {
				$.ajax({
					type: 'POST',
					data: {
						"idproduk": i,
					},
					url: "<?= base_url('C_verifikasi/savedataterimaProduk') ?>",
					success: function(hdata) {
						$('.list-group').append(hdata);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						hdata = '<button type="button" class="list-group-item">Not respon ' + errorThrown + '</button>'
						$('.list-group').append(hdata);
					}
				});



			}

			while (dpost[i]) {
				datarerima(dpost[i]);
				i++;
				var nrpwe = ((i / numrows) * 100).toFixed(0);
				percentVal = nrpwe;
				bar.width(percentVal + '%');
				if (percentVal == 100) {

					// return
					showak.removeClass("hidden");
					console.log(percentVal);
				}
			}

		});
	</script>

</body>

</html>
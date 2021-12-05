<!DOCTYPE html>
<html>

<?php
$warna1 = "#66bc50";
$warna2 = "#f4ee05";
$url_kontak = "http://sediakoding.com/#contact";
?>

<head>
	<meta charset="utf-8">
	<?php
	$title0 = "E-Retail";
	?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $title0 ?></title>
	<meta name="description" content=" <?=$title0?> || apliksi retail berbasis web">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta name="author" content="hamroy">
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>image/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>image/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>image/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?= base_url() ?>image/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?= base_url() ?>image/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>dist/css/AdminLTE.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skin  folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>dist/css/skins/_all-skins.min.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>/plugins/iCheck/all.css">

	<style>
		#loading {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			/*background: url(../../image/looding.gif) 50% 50% no-repeat #ffffff; */
		}

		body {
			position: relative;
			font-family: calibri;
		}

		.backTop {
			display: inline-block;
			padding: 6px 10px;
			position: fixed;
			right: 10px;
			color: #fff;
			cursor: pointer;
			bottom: 10px;
			font-weight: bold;
		}

		.backTop:hover {
			cursor: pointer;
		}
	</style>

	<style>
		.dropdown-submenu {
			position: relative;
		}

		.dropdown-submenu>.dropdown-menu {
			top: 0;
			left: 100%;
			margin-top: -6px;
			margin-left: -1px;
			-webkit-border-radius: 0 6px 6px 6px;
			-moz-border-radius: 0 6px 6px;
			border-radius: 0 6px 6px 6px;
		}

		.dropdown-submenu:hover>.dropdown-menu {
			display: block;
		}

		.dropdown-submenu>a:after {
			display: block;
			content: " ";
			float: right;
			width: 0;
			height: 0;
			border-color: transparent;
			border-style: solid;
			border-width: 5px 0 5px 5px;
			border-left-color: #ccc;
			margin-top: 5px;
			margin-right: -10px;
		}

		.dropdown-submenu:hover>a:after {
			border-left-color: #fff;
		}

		.dropdown-submenu.pull-left {
			float: none;
		}

		.dropdown-submenu.pull-left>.dropdown-menu {
			left: -100%;
			margin-left: 10px;
			-webkit-border-radius: 6px 0 6px 6px;
			-moz-border-radius: 6px 0 6px 6px;
			border-radius: 6px 0 6px 6px;
		}
	</style>
	<script>
		function loadPage(list) {

			location.href = list.options[list.selectedIndex].value

		}
	</script>

	<style>
		.br {
			border-radius: 6px;
		}
	</style>
	<style>
		@media (max-width: 900px) {
			.ilhamslm {
				font-size: 20px;
			}

			.profil_menu {
				width: 100%;
			}

		}



		@media (max-width: 900px) {
			.ilhamslmbgatas {
				margin-top: 100px;
			}
		}
	</style>

	<style>
		.dropbtn {
			background-color: #4CAF50;
			color: white;
			padding: 16px;
			font-size: 16px;
			border: none;
			cursor: pointer;
		}

		.dropdown {
			position: relative;
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}

		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
		}

		.dropdown-content a:hover {
			background-color: #f1f1f1
		}

		.dropdown:hover .dropdown-content {
			display: block;
		}

		.dropdown:hover .dropbtn {
			background-color: #3e8e41;
		}

		.cari-resp {
			width: 200%;
			font-family: arial;
		}

		@media (max-width: 1300px) {
			.cari-resp {
				width: 180%;
			}
		}

		@media (max-width: 1100px) {
			.cari-resp {
				width: 160%;
			}
		}



		@media (max-width: 1000px) {
			.cari-resp {
				width: 150%;
			}
		}
	</style>
	<SCRIPT type="text/javascript">
		//window.history.forward();
		function noBack() {
			//window.history.forward(); 
		}
	</SCRIPT>

	<style>
		/*BOX*/
		.box {
			position: relative;
			border-radius: 5px;
			background: #ffffff;
			border-top: 13px solid #d2d6de;
			margin-bottom: 20px;
			width: 100%;
			box-shadow: 1 20px 1px rgba(0, 0, 0, 0.1);
		}

		.box.box-danger {
			border-top-color: #a93235;
		}

		/* Popover */
		.popover {
			border: 2px dashed #a93235;
		}

		/* Popover Header */
		.popover-title {
			background-color: #2d5726;
			color: #FFFFFF;
			font-size: 28px;
			text-align: center;
		}

		/* Popover Body */
		.popover-content {
			color: #FFFFFF;
			padding: 5px;
			width: 1000px;
			margin-top: 0px;
			font-size: 12px;
			color: #ffffff;
			height: auto;
			overflow-x: hidden;
			overflow-y: hidden;
		}

		/* Popover Arrow */

		.dropdown-menu {
			border: 2px dashed #2d5726;
			width: 100%;
			height: auto;
			overflow-x: hidden;
			overflow-y: hidden;
			display: hide;
			position: absolute;
			font-size: 16px;

			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}
	</style>
	<style type="text/css">
		input#search {
			height: 34px;
			background: #ffffff;
			border: none;
			font-size: 17pt;
			float: left;
			color: #262626;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
		}

		.skin-blue .main-header li.user-header {
			background-color: <?= $warna1 ?>;
		}

		.skin-blue .main-header .navbar .nav>li>a {
			color: #fff;
		}

		.skin-blue .main-header .navbar {
			background-color: #fff;
		}

		nav .container {
			width: 100%;
		}

		nav .c2 {
			background-color: <?= $warna1 ?>;
			color: #fff;
		}
	</style>

</head>

<body class="hold-transition skin-blue layout-top-nav">

	<!--<div id="loading"></div>-->
	<!---->
	<header class="main-header">

		<nav class="navbar navbar-fixed-top" style="margin-top: 0px;">
			<div class="container">
				<div class="navbar-header ">
					<a href="<?= base_url() ?>" class="navbar-brand">
						<img src="<?= base_url('image/logo.png') ?>" width="9%" alt="logo">
					</a>

				</div>

				<div class="collapse navbar-collapse pull-right" id="navbar-collapse2">
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li>
								<a style="color: <?= $warna1 ?>;" href="<?= $url_kontak ?>" target="blank">
									<span class="hidden-xs hidden-sm">Hubungi Kami</span>
								</a>
							</li>
							<!---->
						</ul>
					</div>
				</div>

				<!-- /.navbar-custom-menu -->
			</div>
			<!-- /.container-fluid -->
			<div class="container c2">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse1">
						<i class="fa fa-bars"></i>
					</button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="navbar-collapse1">


					<ul class="nav navbar-nav" style="scrollbar-arrow-color: #ff0000">

						<?php
						$l = !empty($l) ? $l : '';
						$a = !empty($a) ? $a : '';
						$b = !empty($a) ? $b : '';
						$d = !empty($a) ? $d : '';
						?>

						<!--revilahm..SUPERALLL DAERAH-->
						<?php
						$gs_status_job = $this->session->userdata('status_job');
						?>
						<?php
						$market = $this->session->userdata('id_supermarket');
						if (!empty($market) and $market != 0) {
							$namamarket = $this->Msupermarket->get_supermarket_by_id($market)->row()->kecamatan;
						} else {
							$namamarket = "SUPERMARKET";
						}
						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">E-Retail <?= strtoupper($namamarket) ?><b class="caret"></b></a>
							<ul class="dropdown-menu">
								<?php
								$smarket = $this->Msupermarket->get_supermarket();
								if ($smarket->num_rows() > 0) {
									foreach ($smarket->result() as $key) { ?>
										<li><a href="<?= base_url('welcome/supermarket/' . $key->id_supermarket) ?>"><?= $key->kecamatan ?> <?= $key->kabupaten ?></a></li>
									<?php }
								} else { ?>
									<li><a href="#">-------------------</a></li>
								<?php }
								?>
							</ul>
						</li>
						<!--REV201810-->
						<?php
						if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
						?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">MENU<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li class="<?= $b ?>"><a href="<?= base_url('User_admin/beranda') ?>"><i class="cube"></i><span>Produk</span></a></li>
									<li class="<?= $b ?>"><a href="<?= base_url('User_admin/transaksi_belanja') ?>"><i class="tran"></i><span>Transaksi Belanja</span></a></li>
									<li class="<?= $d ?> treeview">
										<a href="<?= base_url('User_admin/barang_dipesan') ?>"><i class=" envelope-o"></i><span>Barang Dipesan</span>
										</a>
									</li>
								</ul>
							</li>
						<?php
						}
						?>


					</ul>
					<!--REV MENU 04012018-->
					<ul class="nav navbar-nav pull-right ">
						<div class="navbar-custom-menu">
							<ul class="nav navbar-nav">
								<!-- KERANJANG BELANJA-->
								<?php
								$id_s = $this->session->userdata('id_user');
								$list = $this->Mtrans->lihat_keranjang_id_user($id_s);
								?>
								<?php
								if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
								?>
									<!---->
									<li class="dropdown notifications-menu">
										<!-- Menu toggle button -->
										<?php
										$get_all_id_produk = $this->Madmin->get_Produk_dipesan($this->session->userdata('id_user'));

										?>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<i class="fa fa-bell-o"></i>
											<?php
											///numrows() di pesan
											$nmp = $get_all_id_produk->num_rows();
											if ($nmp > 0) { ?>

												<span class="label label-info"><?= $get_all_id_produk->num_rows() ?></span>
											<?php
											}
											?>

										</a>
										<ul class="dropdown-menu">
											<li class="header"><?= $get_all_id_produk->num_rows() ?> notivikasi </li>
											<li>
												<ul class="menu">
													<?php
													if ($get_all_id_produk->num_rows() > 0) {
														foreach ($get_all_id_produk->result() as $gidp) {
															if ($this->Madmin->getidpembeli($gidp->id_pembeli)->num_rows() > 0) {
																$getpembeli = $this->Madmin->getidpembeli($gidp->id_pembeli)->row()->nama;
															} else {
																$getpembeli = '';
															}


													?>

															<li>
																<a href="<?= base_url('User_admin/barang_dipesan') ?>">
																	<i class="fa fa-envelope-o"></i> <?= $getpembeli ?> Pesan Produk <?= $gidp->nama ?>
																</a>
															</li>

													<?php

														}
													}
													?>

													<!-- end notification -->
												</ul>
											</li>
											<li class="footer"><a href="<?= base_url('User_admin/barang_dipesan') ?>">Lihat semua</a></li>
										</ul>
									</li>
									<!---->


									<li class="dropdown messages-menu">
										<!-- Menu toggle button -->

										<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-placement="top" title="Daftar Belanja">
											<i class="fa fa-shopping-cart"></i>
											<?php
											///numrows() di pesan
											$nmnot = $list->num_rows();
											if ($nmnot > 0) { ?>

												<span class="label label-warning"><?= $list->num_rows() ?></span>
											<?php
											}
											?>
										</a>
										<ul class="dropdown-menu">
											<li class="header"><?= $list->num_rows() ?> Daftar Belanja :</li>
											<li>
												<!-- inner menu: contains the messages -->
												<ul class="menu">
													<?php
													foreach ($list->result() as $kj) {
														$barang = $this->Muser->get_produk_by_id($kj->id_produk);
														$string = read_file('./upload/barang/' . $barang->row()->gambar);
														if ($string == FALSE) {
															$fotorj = $this->M_setapp->static_bm() . '/dist/img/bm.jpg';
														} else {
															$fotorj = $this->M_setapp->static_bm() . '/upload/barang/' . $barang->row()->gambar;
														}
													?>
														<li>
															<!-- start message -->
															<a href="<?= base_url('welcome/beli_produk/') ?>">
																<div class="pull-left">
																	<!-- User Image -->
																	<img src="<?= $fotorj ?>" class="img-circle" alt="User Image">
																</div>
																<!-- Message title and timestamp -->

																<p style="color: #000000; font-size: 13px"><?= $barang->row()->nama ?> </p>
																<!-- The message -->
																<p><?= $kj->qty ?> <?= $barang->row()->satuan ?></p>
															</a>
														</li>

													<?php }
													?>

													<!-- end message -->
												</ul>
												<!-- /.menu -->
											</li>
											<li class="footer"><a href="<?= base_url('welcome/beli_produk/') ?>">Lihat semua</a></li>
										</ul>
									</li>
									<!-- /.messages-menu -->
								<?php } ?>


								<?php
								if ($this->session->userdata('login') == FALSE or $this->session->userdata('wewenang') != 'user') {
								?>
									<li class="dropdown notifications-menu">
										<!-- Menu toggle button -->
										<a href="<?= base_url('Login/daftar') ?>" data-toggle="tooltip" data-placement="bottom" title="Daftar Akun Baru">
											<i class="fa fa-fw fa-user-plus"></i>
											<span class="hidden-xs hidden-sm">DAFTAR</span>

										</a>
									</li>
									<!-- Tasks Menu -->
									<li class="dropdown tasks-menu">
										<!-- Menu Toggle Button -->
										<a href="<?= base_url('Login') ?>" data-toggle="tooltip" data-placement="left" title="Login">
											<i class="fa fa-fw fa-user"></i>
											<span class="hidden-xs hidden-sm">LOGIN</span>
											<!--<span class="label label-danger">9</span>-->
										</a>
									</li>
								<?php } ?>
								<!---->
								<!-- User Account Menu -->
								<?php
								if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {
								?>
									<?php
									$string = read_file('./upload/profil/' . $img);
									if ($string == FALSE) {
										if ($sex == 'L') {
											$foto = $this->M_setapp->static_bm() . '/upload/profil/profil.png';
										} else {
											$foto = $this->M_setapp->static_bm() . '/upload/profil/profil_m.png';
										}
									} else {
										$foto = $this->M_setapp->static_bm() . '/upload/profil/' . $img;
									} ?>
									<li class="dropdown user user-menu">
										<!-- Menu Toggle Button -->
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<!-- The user image in the navbar-->
											<img src="<?= $foto ?>" class="user-image" alt="User Image">
											<!-- hidden-xs hides the username on small devices so only the image appears. -->

										</a>
										<ul class="dropdown-menu">
											<!-- The user image in the menu -->
											<li class="user-header">
												<img src="<?= $foto ?>" class="img-circle" alt="User Image">

												<p>
													<?= $nama ?>
												</p>
												<small style="color: #fff"><?= $username ?></small>
											</li>


											<!-- Menu Footer-->
											<li class="user-footer">
												<div class="pull-left">
													<a href="<?= base_url('User_admin') ?>" class="btn btn-default">Profile</a>
												</div>
												<div class="pull-right">
													<a onclick="return confirm('Anda Yakin akan KELUAR !')" href="<?= base_url('Login/logout') ?>" class="btn btn-default">Sign out</a>
												</div>
											</li>
										</ul>
									</li>
								<?php } ?>

							</ul>
						</div>
					</ul>

					<form class="navbar-form navbar-left" action="<?= base_url('welcome/cari_produk/') ?>" method="post" role="search">
						<div class="input-group cari-resp">
							<input type="search" id="search" class="form-control container-3" title="cari produk . . . " required name="cari" placeholder=" . . .">
							<span class="input-group-btn">
								<button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-search"></span> Cari</button>
							</span>
						</div><!-- /input-group -->


					</form>










				</div>
				<!-- /.navbar-collapse -->
				<!-- Navbar Right Menu -->
				<!-- /.navbar-custom-menu -->

			</div>


		</nav>
		<!---->


	</header>

	<!---->

	<!-- Full Width Column -->

	<!-- Content Header (Page header) -->

	<!-- Main content -->

	<section class="content" style="margin-top: 85px">


		<!-- /.col -->
		<div class="box box-danger">



			<!-- /.box-header -->

			<!--ISI TAMPILAN BARANG-->
			<?php
			if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') != 'user') {
				redirect('Login/reset_l0gin');
			}

			?>

			<?php
			$this->load->view($view)
			?>




			<!---->

			<?php
			$this->load->view('pages/layout/bawahmenu')
			?>



		</div>
		<!-- /. box -->
		<!-- /.col -->



	</section>
	<!--BAWAH-->

	<div class="backTop"><a href="" type="button" class="btn btn-primary"> <span class="glyphicon glyphicon-refresh"></span></a></div>
	<footer class="main-footer img lazyku" data-original='<?= $this->M_setapp->static_bm() ?>/dist/img/footermasjid.png' style="background: url(); background-size:cover;">
		<!-- To the right -->


		<!-- Default to the left -->

		<!-- Histats.com  START  (aync)-->


		<!-- Histats.com  START (html only)-->
		<!-- Histats.com  END  -->
		<marquee>
			<p style="font-size: 30px; padding-top: 20px; color: #ffffff">Bersama menuju Kemandirian Ekonomi Umat</p>
		</marquee>
		<marquee></marquee>
		<marquee></marquee>
		<p align="center"><strong><a class="btn btn-link" data-toggle="modal" data-target=".bs-example-modal-sm">Copyright &copy;</a> 2017 - <?= date('Y') ?> || <a href="<?= base_url() ?>" target="_blank"><?= $title1 ?></a></strong></p>


		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<center>
							<img src="<?= $this->M_setapp->static_bm() ?>image/hakibm.jpeg" style="width: 80%; ">
						</center>
					</div>
				</div>
			</div>
		</div>


	</footer>


	<!--BAWAH-->



	<!-- /.content -->

	<!-- /.content-wrapper -->

	<!-- ./wrapper -->

	<!-- jQuery 2.2.3 -->
	<script src="<?= $this->M_setapp->static_bm() ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script type="text/javascript" src="<?= $this->M_setapp->static_bm() ?>/plugins/jQuery/responsive-tab.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?= $this->M_setapp->static_bm() ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?= $this->M_setapp->static_bm() ?>plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= $this->M_setapp->static_bm() ?>/dist/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?= $this->M_setapp->static_bm() ?>dist/js/demo.js"></script>
	<script src="<?= $this->M_setapp->static_bm() ?>plugins/iCheck/icheck.min.js"></script>
	<!-- FastClick -->
	<script src="<?= $this->M_setapp->static_bm() ?>plugins/fastclick/fastclick.js"></script>

	<script src="<?= $this->M_setapp->static_bm() ?>/lazy/jquery.lazyload.min.js" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8">
		$(function() {
			$("img.lazy").lazyload({
				effect: "fadeIn"
			}); // untuk dipasang di <img src='xxxx'>
			$(".lazyku").lazyload({
				effect: "fadeIn"
			}); // untuk dipasang sebagai background / div
		});
		$(function() {
			$('#btnsubmit').on('click', function() {
				$(this).val('Sedang diproses ...')
					.attr('disabled', 'disabled');
				$('#theform').submit();
			});

		});
	</script>


	<script type="text/javascript">
		function submitForm(action) {
			document.getElementById('form1').action = action;
			document.getElementById('form1').submit();
		}
	</script>
	<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});

		$('[data-toggle="tooltip"]').tooltip({
			animated: 'fade',
			placement: 'bottom',
			html: true
		});

		$('[data-toggle="popover"]').popover({
			//data-content: 'sad',
			container: "body",
			placement: 'bottom',
			html: true,

		});
	</script>
	<script type="text/javascript">
		/*
	$(window).load(function() { 
	 $("#loading").fadeOut("fast"); 
		interval: 500;
	 })
	 ///*/
	</script>
	<script>
		$('#myModaliklan2').modal('show');
	</script>





	<script type="text/javascript">
		function konfirmasibayar(action) {
			var r = confirm('Anda yakin?');

			if (r == true) {
				document.getElementById('theform').action = action;
			} else {
				return alert("Pembayaran di batalkan .");
			}
		}
	</script>

	<script type="text/javascript">
		$('.fakprodi').select2({
			placeholder: '--- Pilih Prodi ---',
			ajax: {
				url: '<?= base_url() ?>C_select2',
				dataType: 'json',
				type: "GET",
				delay: 100,
				processResults: function(data) {
					return {
						results: data
					};
				},
				cache: true
			}
		});
	</script>

</body>

</html>
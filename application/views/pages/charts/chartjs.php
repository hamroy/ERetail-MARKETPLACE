<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | ChartJS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url() ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo" style="background: #2d5726">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>BM</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><?= $title1 ?></b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-fixed-top" role="navigation" style="background: #2d5726; ">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- /.messages-menu -->
            <li class="dropdown tasks-menu">

              <!-- Menu Toggle Button -->
              <?php
              if ($this->session->userdata('wewenang') == 'admin') { ?>
                <a href="<?= base_url('/Master_admin/forum') ?>" data-toggle="tooltip" data-placement="bottom" title="Forum">
                  <i class="fa  fa-comments-o"></i>
                  <span class="hidden-xs hidden-sm">FORUM</span>
                  <!--<span class="label label-danger">9</span>-->
                </a>

              <?php } elseif ($this->session->userdata('wewenang') == 'bmt' or $this->session->userdata('wewenang') == 'keu') {
                echo '';
              } else { ?>
                <a href="<?= base_url('C_kom') ?>" data-toggle="tooltip" data-placement="bottom" title="Forum">
                  <i class="fa  fa-comments-o"></i>
                  <span class="hidden-xs hidden-sm">FORUM</span>
                  <!--<span class="label label-danger">9</span>-->
                </a>
              <?php
              } ?>

            </li>
            <!-- Notifications Menu -->
            <?php
            if ($this->session->userdata('wewenang') != 'admin'  and $this->session->userdata('wewenang') != 'bmt' and $this->session->userdata('wewenang') != 'keu') { ?>
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
            <?php } ?>

            <!-- keranjang Menu -->
            <?php
            //$list = $this->Mtrans->lihat_keranjang_by_pelapak($this->session->userdata('id_user')); ///bila user
            $list = $this->Mtrans->lihat_keranjang_by_pembeli($this->session->userdata('id_user'));
            ?>
            <?php
            if ($this->session->userdata('wewenang') != 'admin' and $this->session->userdata('wewenang') != 'bmt' and $this->session->userdata('wewenang') != 'keu') { ?>
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->

                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-placement="top" title="Keranjang Belanja">
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
                  <li class="header"><?= $list->num_rows() ?> Daftar Belanja</li>
                  <li>
                    <!-- inner menu: contains the messages -->
                    <ul class="menu">
                      <?php
                      foreach ($list->result() as $kj) {
                        $barang = $this->Muser->get_produk_by_id($kj->id_produk);
                        $string = read_file('./upload/' . $barang->row()->gambar);
                        if ($string == FALSE) {
                          $fotorj = base_url() . '/dist/img/E-Retail.jpg';
                        } else {
                          $fotorj = base_url() . '/upload/' . $barang->row()->gambar;
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
                            <h4>
                              <?= $barang->row()->nama ?>
                            </h4>
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
            <?php } ?>
            <!-- User Account Menu -->
            <?php
            $string = read_file('./upload/profil/' . $img);
            if ($string == FALSE) {
              if ($sex == 'L') {
                $foto = base_url() . '/upload/profil/profil.png';
              } else {
                $foto = base_url() . '/upload/profil/profil_m.png';
              }
            } else {
              $foto = base_url() . '/upload/profil/' . $img;
            } ?>
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?= $foto ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?= $nama ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?= $foto ?>" style="height: 100px; width: 100px" class="img-circle" alt="User Image">

                  <p>
                    <?= $nama ?>
                  </p>
                  <small style="color: #000000"><?= $username ?></small>
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
            <!-- Control Sidebar Toggle Button -->
            <!--<li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>-->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel" style="height: 80px">
          <div class="pull-left image" style="padding: 0px">
            <img src="<?= $foto ?>" class="img-circle" style="height: 50px; width: 40px;" alt="User Image">
          </div>
          <div class="pull-left info">
            <p> <?= $nama ?></p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <?php
        if ($this->session->userdata('wewenang') != 'admin' and $this->session->userdata('wewenang') != 'bmt' and $this->session->userdata('wewenang') != 'keu') { ?>
          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Cari Produk. . .">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
        <?php } ?>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
          <li class="header">MENU</li>
          <!-- Optionally, you can add icons to the links -->
          <li class="<?= $a ?>"><a href="<?= base_url('User_admin') ?>"><i class="fa fa-fw fa-user"></i> <span>AKUN</span></a></li>
          <?php
          if ($this->session->userdata('wewenang') == 'user') { ?>
            <!--UNTUK PENJUAL-->

            <!--rev 130717-->
            <li class="<?= $l ?>"><a href="<?= base_url('C_dompet') ?>"><i class="fa fa-briefcase"></i><span>Dompet</span></a></li>


            <li class="<?= $b ?>"><a href="<?= base_url('User_admin/beranda') ?>"><i class="fa fa-cube"></i><span>Produk</span></a></li>
            <li class="<?= $d ?> treeview"><a href="<?= base_url('User_admin/barang_dipesan') ?>"><i class="fa  fa-envelope-o"></i><span>Barang Dipesan</span>

                <!---->
                <?php
                if ($nmp > 0) { ?>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"><?= $nmp ?></span>
                  </span>

                <?php
                }
                ?>

                <!---->
              </a>

            </li>
            <li class="<?= $c ?>"><a href="<?= base_url('User_admin/transaksi') ?>"><i class="fa fa-exchange"></i><span>Transaksi</span></a></li>
            <li><a href="<?= base_url('Welcome/allkategori') ?>"><i class="fa fa-cart-plus"></i><span>Belanja</span></a></li>

          <?php } elseif ($this->session->userdata('wewenang') == 'sbm') { ?>
            <li class="<?= $j ?>"><a href="<?= base_url('C_sbm/otorisasi') ?>"><i class="fa fa-shield"></i><span>Otorisasi Pendaftaran</span></a></li>
            <li class="<?= $f ?>"><a href="<?= base_url('C_sbm/daftar_peserta') ?>"><i class="fa fa-list"></i><span>Daftar Peserta SBM</span></a></li>
            <li class="<?= $b ?>"><a href="<?= base_url('C_sbm/pemateri') ?>"><i class="fa fa-cog"></i><span>Pengaturan Pemateri</span></a></li>
          <?php
          } elseif ($this->session->userdata('wewenang') == 'bmt') { ?>
            <!--rev 240717-->
            <li class="<?= $l ?>"><a href="<?= base_url('C_bmt') ?>"><i class="fa fa-list"></i><span>Daftar</span></a></li>
          <?php
          } elseif ($this->session->userdata('wewenang') == 'keu') { ?>
            <!--rev 240717-->
            <li class="<?= $l ?>"><a href="<?= base_url('C_keu') ?>"><i class="fa fa-list"></i><span>Daftar</span></a></li><?php
                                                                                                                      } else { ?>
            <li class="<?= $j ?>"><a href="<?= base_url('Master_admin/verifikasi') ?>"><i class="fa  fa-shield"></i><span>Verifikasi </span>
                <!---->
                <?php
                                                                                                                        $get_all_user_new = $this->Madmin_master->get_all_usernew();
                                                                                                                        $get_all_id_produk = $this->Madmin_master->get_all_produk_new();
                                                                                                                        $akun = $get_all_user_new->num_rows();
                                                                                                                        $prod = $get_all_id_produk->num_rows();
                                                                                                                        if ($akun + $prod > 0) { ?>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"><?= $akun + $prod ?></span>
                  </span>

                <?php
                                                                                                                        }
                ?>

                <!---->

              </a></li>

            <li class="<?= $m ?>">
              <?php
                                                                                                                        $all_newvoucer = $this->Madmin_master->get_pemesan_vo('0')->num_rows();
                                                                                                                        if ($all_newvoucer > 0) {
                                                                                                                          $vcnew = ' <span class="pull-right-container"><span class="label label-primary pull-right">' . $all_newvoucer . '</span></span>';
                                                                                                                        } else {
                                                                                                                          $vcnew = '';
                                                                                                                        }
              ?>

              <a href="<?= base_url('C_dompet/dafatar_pemesan_voucher') ?>"><i class="fa fa-shield"></i><span>Verifikasi Voucher</span>
                <?= $vcnew ?>
              </a>
            </li>

            <li class="<?= $f ?>"><a href="<?= base_url('Master_admin') ?>"><i class="fa fa-list"></i><span>Daftar Penjual</span></a></li>

            <li class="<?= $g ?>"><a href="<?= base_url('Master_admin/daftar_pembeli') ?>"><i class="fa fa-list"></i><span>Daftar Pembeli</span></a></li>
            <li class="<?= $h ?>"><a href="<?= base_url('Master_admin/daftar_produk') ?>"><i class="fa fa-cubes"></i><span>Daftar Produk</span></a></li>
            <li class="<?= $i ?>"><a href="<?= base_url('Master_admin/transaksi') ?>"><i class="fa fa-exchange"></i><span>Daftar Transaksi</span></a></li>
            <li class="<?= $n ?>"><a href="<?= base_url('Master_admin/produkdipesan_all') ?>"><i class="fa fa-exchange"></i><span>Produk Dipesan</span></a></li>
            <hr />

            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>INFO</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= base_url('C_dompet/riwayat_vcer') ?>"><i class="fa fa-circle-o"></i>RIWAYAT DOMPET</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> STATISTIK
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?= base_url('C_statistik') ?>"><i class="fa fa-circle-o"></i> STATISTIK PENJUALAN</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> STATISTIK PRODUK</a></li>

                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Penjual Online</a></li>
              </ul>
            </li>
            <li class="<?= $k ?>"><a href="<?= base_url('Master_admin/saran') ?>"><i class="fa fa-commenting"></i><span>Saran Masuk</span></a></li>

          <?php  } ?>
          <!--<li class="treeview">n
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>-->
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="margin-top: 45px">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          STATISTIK PENJUALAN
        </h1>

      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <div class="chart">
              <canvas id="barChart" style="height:230px"></canvas>
            </div>
            <!-- /.box -->

          </div>
          <!-- /.col (LEFT) -->
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.3.11
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 2.2.3 -->
  <script src="<?= base_url() ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?= base_url() ?>bootstrap/js/bootstrap.min.js"></script>
  <!-- ChartJS 1.0.1 -->
  <script src="<?= base_url() ?>plugins/chartjs/Chart.min.js"></script>
  <!-- FastClick -->
  <script src="<?= base_url() ?>plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    $(function() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //- BAR CHART -
      //-------------
      var barChartCanvas = $("#barChart").get(0).getContext("2d");
      var barChart = new Chart(barChartCanvas);
      var barChartData = areaChartData;
      barChartData.datasets[1].fillColor = "#00a65a";
      barChartData.datasets[1].strokeColor = "#00a65a";
      barChartData.datasets[1].pointColor = "#00a65a";
      var barChartOptions = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: true,
        //String - Colour of the grid lines
        scaleGridLineColor: "rgba(0,0,0,.05)",
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - If there is a stroke on each bar
        barShowStroke: true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth: 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing: 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing: 1,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
        //Boolean - whether to make the chart responsive
        responsive: true,
        maintainAspectRatio: true
      };

      barChartOptions.datasetFill = false;
      barChart.Bar(barChartData, barChartOptions);
    });
  </script>
</body>

</html>
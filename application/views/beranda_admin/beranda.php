<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title0 ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content=" - E-Retail">
  <meta name="author" content=" - E-Retail">
  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>image/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>image/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>image/favicon/favicon-16x16.png">
  <link rel="manifest" href="<?= base_url() ?>image/favicon/site.webmanifest">
  <link rel="mask-icon" href="<?= base_url() ?>image/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!--   <link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!--select-->
  <link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>dist/css/AdminLTE.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">

  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take efect.  
  -->



  <link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>dist/css/skins/skin-blue.min.css">



  <script src="<?= $this->M_setapp->static_bm() ?>plugins/jQuery/jquery-2.2.3.min.js"></script>



  <style>
    .br {



      border-radius: 6px;



    }
  </style>







  <style>
    #loading {



      position: fixed;



      left: 0px;



      top: 0px;



      width: 100%;



      height: 100%;



      z-index: 9999;



      /*background: url(../../image/looding.gif) 50% 50% no-repeat  #ffffff;//*/



    }

    .skin-blue .main-header li.user-header {
      background-color: #66bc50;
    }
  </style>



  <script type="text/javascript">
    setInterval(function() {
      $("#load").load("");
    }, 6000);
  </script>




  <link href="<?= base_url() ?>/dist/css/bootstrap.datatable.css" rel="stylesheet">



</head>



<!--



BODY TAG OPTIONS:



-->



<body class="hold-transition skin-blue sidebar-mini">



  <div id="loading"></div>







  <div class="wrapper">







    <!-- Main Header -->



    <?php



    $m = !empty($m) ? $m : '';

    $n = !empty($n) ? $n : '';

    $f = !empty($f) ? $f : '';

    $g = !empty($g) ? $g : '';

    $h = !empty($h) ? $h : '';

    $i = !empty($i) ? $i : '';

    $k = !empty($k) ? $k : '';

    $j = !empty($j) ? $j : '';

    $f = !empty($f) ? $f : '';

    $l2 = !empty($l2) ? $l2 : '';

    $l1 = !empty($l1) ? $l1 : '';

    $l3 = !empty($l3) ? $l3 : '';

    $l4 = !empty($l4) ? $l4 : '';

    $vp = !empty($vp) ? $vp : '';

    $vsong = !empty($vsong) ? $vsong : '';
    //l_dom
    $l_dom = !empty($l_dom) ? $l_dom : '';



    ?>



    <header class="main-header" style="position: fixed;">







      <!-- Logo -->



      <a href="#" class="logo" style="background: #66bc50">



        <!-- mini logo for sidebar mini 50x50 pixels -->



        <span class="logo-mini"><b>SK</b></span>



        <!-- logo for regular state and mobile devices -->



        <span class="logo-lg"><b><?= $title1 ?></b></span>



      </a>







      <!-- Header Navbar -->



      <nav class="navbar navbar-fixed-top" role="navigation" style="background: #66bc50; ">



        <!-- Sidebar toggle button-->



        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">



          <span class="sr-only">Toggle navigation</span>



        </a>



        <!-- Navbar Right Menu -->



        <div class="navbar-custom-menu">



          <ul class="nav navbar-nav">



            <!-- Messages: style can be found in dropdown.less-->







            <!-- /.messages-menu -->



            <!--  <li class="dropdown tasks-menu">

                

                <a href="<?= base_url('/Master_admin/forum') ?>" data-toggle="tooltip" data-placement="bottom" title="Forum">



               <i class="fa  fa-comments-o"></i>



              <span class="hidden-xs hidden-sm">FORUM</span>



                <!--<span class="label label-danger">9</span>-- 



              </a>

			  

              <!-- Menu Toggle Button --



            </li>-->



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



            $list = $this->Mtrans->lihat_keranjang_id_user($this->session->userdata('id_user'));



            ?>



            <?php



            if ($this->session->userdata('wewenang') != 'admin' and $this->session->userdata('wewenang') != 'bmt' and $this->session->userdata('wewenang') != 'keu') { ?>



              <li class="dropdown messages-menu">



                <!-- Menu toggle button -->

                <?php

                $c1 = !empty($c1) ? $c1 : '';

                $c2 = !empty($c2) ? $c2 : '';

                $c = !empty($c) ? $c : '';

                $l = !empty($l) ? $l : '';

                ?>





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



                          $fotorj = $this->M_setapp->static_bm() . '/dist/img/E-Retail.jpg';
                        } else {



                          $fotorj = $this->M_setapp->static_bm() . '/upload/' . $barang->row()->gambar;
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



                $foto = $this->M_setapp->static_bm() . '/upload/profil/profil.png';
              } else {

                $foto = $this->M_setapp->static_bm() . '/upload/profil/profil_m.png';
              }
            } else {



              $foto = $this->M_setapp->static_bm() . '/upload/profil/' . $img;
              // $foto = $this->M_setapp->static_bm().'/upload/profil/profil.png'; 



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



                  <small style="color: #fffefe"><?= $username ?></small>



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



















    <aside class="fixed main-sidebar sidebar" style="margin-bottom: 0px;">



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



        if ($this->session->userdata('wewenang') == 'user') { ?>



          <!-- search form (Optional) -->



          <ul class="sidebar-menu sidebar">
            <li>
              <a style="font-size: 20px;" href="<?= base_url('Welcome/allkategori') ?>" class="btn btn-primary btn-block"><i class="fa fa-cart-plus"></i><span> Belanja</span></a>

            </li>
          </ul>


          <!-- /.search form -->



        <?php } ?>



        <!-- Sidebar Menu -->



        <ul class="sidebar-menu sidebar">



          <li class="header">MENU</li>



          <!-- Optionally, you can add icons to the links -->



          <li class="<?= $a ?>"><a href="<?= base_url('User_admin') ?>"><i class="fa fa-fw fa-user"></i> <span>AKUN</span></a></li>











          <?php



          if ($this->session->userdata('wewenang') == 'user') { ?>


            <!--UNTUK PENJUAL-->



            <!--rev 130717-->



            <!--20180501-->

            <li class="<?= $b ?>"><a href="<?= base_url('User_admin/beranda') ?>"><i class="fa fa-cube"></i><span>Produk</span></a></li>



            <li class="<?= $d ?> treeview">



              <a href="<?= base_url('User_admin/barang_dipesan') ?>"><i class="fa  fa-envelope-o"></i><span>Barang Dipesan</span>







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



            <li class="<?= $c2 ?>"><a href="<?= base_url('User_admin/transaksi_selesai') ?>"><i class="fa fa-list-alt"></i><span>transaksi selesai</span></a></li>



            <li class="<?= $c ?>"><a href="<?= base_url('User_admin/transaksi') ?>"><i class="fa fa-exchange"></i><span>Transaksi</span></a></li>







            <li class="<?= $c1 ?>"><a href="<?= base_url('User_admin/transaksi_belanja') ?>"><i class="fa fa-exchange"></i><span>Transaksi Belanja </span></a></li>







          <?php } elseif ($this->session->userdata('wewenang') == 'sbm') { ?>



            <li class="<?= $j ?>"><a href="<?= base_url('C_sbm/otorisasi') ?>"><i class="fa fa-shield"></i><span>Otorisasi Pendaftaran</span></a></li>



            <li class="<?= $f ?>"><a href="<?= base_url('C_sbm/daftar_peserta') ?>"><i class="fa fa-list"></i><span>Daftar Peserta SBM</span></a></li>



            <li class="<?= $b ?>"><a href="<?= base_url('C_sbm/pemateri') ?>"><i class="fa fa-cog"></i><span>Pengaturan Pemateri</span></a></li>



          <?php



          } elseif ($this->session->userdata('wewenang') == 'bmt') { ?>



            <!--rev 240717-->



            <li class="<?= $l1 ?>"><a href="<?= base_url('C_bmt/dompet_bank') ?>"><i class="fa  fa-money"></i><span>Dompet</span></a></li>



            <li class="<?= $l2 ?>"><a href="<?= base_url('C_bmt/reedem_new') ?>"><i class="fa  fa-cc"></i><span>Redeem</span></a></li>



            <li class="<?= $l3 ?>"><a href="<?= base_url('C_bmt/reedem_disetujui') ?>"><i class="fa  fa-check-square-o"></i><span>Disetujui</span></a></li>



            <li class="<?= $l ?>"><a href="<?= base_url('C_bmt/beranda') ?>"><i class="fa fa-list"></i><span>Daftar Selesai</span></a></li>



          <?php



          } elseif ($this->session->userdata('wewenang') == 'keu') { ?>



            <!--rev 240717-->



            <li class="<?= $l ?>">php<a href="<?= base_url('C_keu') ?>"><i class="fa fa-list"></i><span>Daftar</span></a></li><?php



                                                                                                                            } elseif ($this->session->userdata('wewenang') == 'admin') { ?>



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















            <?php







                                                                                                                              if (empty($v)) {



                                                                                                                                $v1 = '';
                                                                                                                              } else {



                                                                                                                                $v1 = $v;
                                                                                                                              }



            ?>



            <!--KENDALI Transfer transfer-->

            <?php

                                                                                                                              //$C_t='active';

                                                                                                                              $C_t = isset($C_t) ? $C_t : '';

            ?>








            <li class="<?= $f ?>" class="treeview">



              <a href="<?= base_url('Master_admin') ?>">



                <i class="fa fa-share"></i> <span>Daftar Penjual</span>



                <span class="pull-right-container">



                  <i class="fa fa-angle-left pull-right"></i>



                </span>



              </a>



              <ul class="treeview-menu">



                <li><a href="<?= base_url('Master_admin/list_penjual/') ?>"><i class="fa fa-list"></i><span>Penjual Aktif</span></a></li>



                <li class=""><a href="<?= base_url('Master_admin/list_penjual/ga/2') ?>"><i class="fa fa-list"></i><span>Penjual Diblok</span></a></li>



                <li class=""><a href="<?= base_url('Master_admin/list_penjual_tolak/') ?>"><i class="fa fa-list"></i><span>Penjual Ditolak</span></a></li>







              </ul>



            </li>















            <li class="<?= $g ?>"><a href="<?= base_url('Master_admin/daftar_pembeli') ?>"><i class="fa fa-list"></i><span>Daftar Pembeli</span></a></li>



            <!--<li class="<?= $h ?>"><a href="<?= base_url('Master_admin/daftar_produk') ?>"><i class="fa fa-cubes"></i><span>Daftar Produk</span></a></li>-->







            <li class="<?= $h ?>" class="treeview">



              <a href="<?= base_url('Master_admin/daftar_produk') ?>">



                <i class="fa fa-cubes"></i> <span>Daftar Produk</span>



                <span class="pull-right-container">



                  <i class="fa fa-angle-left pull-right"></i>



                </span>



              </a>



              <ul class="treeview-menu">

                <li class="treeview">



                  <a href="<?= base_url('Master_admin/daftar_produk/') ?>"><i class="fa fa-cubes"></i> <span>Kategori</span>

                  </a>

                </li>



                <li><a href="<?= base_url('Master_admin/daftar_produk_cari/') ?>"><i class="fa fa-search"></i><span>Cari Produk</span></a></li>



                <li><a href="<?= base_url('Master_admin/daftar_produk_tolak/') ?>"><i class="fa fa-list"></i><span>Produk Ditolak</span></a></li>



                <li><a href="<?= base_url('Master_admin/daftar_produk_blok/') ?>"><i class="fa fa-list"></i><span>Produk Diblok</span></a></li>



                <li><a href="<?= base_url('C_kom/produk_terlaris') ?>"><i class="fa fa-circle-o"></i>STATISTIK PRODUK</a></li>



              </ul>







            </li>











            <li class="<?= $i ?>"><a href="<?= base_url('Master_admin/daf_transaksi') ?>"><i class="fa fa-exchange"></i><span>Daftar Transaksi</span></a></li>



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



                <li class=""><a href="<?= base_url('Master_admin/transaksi_belanja') ?>"><i class="fa fa-exchange"></i><span>Transaksi Pembelian</span></a></li>



                <li class=""><a href="<?= base_url('Master_admin/transaksi_penjualan') ?>"><i class="fa fa-exchange"></i><span>Transaksi Penjualan</span></a></li>

                <li class=""><a href="<?= base_url('C_rekapProduk') ?>"><i class="fa fa-list"></i><span>Rekap Produk</span></a></li>















                <!-- <li class=""><a href="<?= base_url('C_dompet/riwayat_edisi_voc') ?>"><i class="fa fa-list"></i><span>Riwayat Edisi Voucher</span></a></li> -->



                <li class=""><a href="<?= base_url('C_dompet_2/riwayat_vocAll') ?>"><i class="fa fa-list"></i><span>Riwayat Voucher</span></a></li>







                <!-- <li>



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



            <li><a href="#"><i class="fa fa-circle-o"></i>Penjual Online</a></li>-->



              </ul>



            </li>







          <?php  } else {
                                                                                                                            }

          ?>



          <!--<li class="treeview">



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



      <!-- sidebar: style can be found in sidebar.less -->







      <!-- /.sidebar -->



    </aside>







    <!-- Content Wrapper. Contains page content -->



    <div class="content-wrapper " style="padding-top: 40px;">



      <!-- Content Header (Page header) -->



      <noscript>

        Mohon javascript diaktifkan...<BR />

        terimakasih.

      </noscript>







      <?php

      $this->load->view($view);

      ?>







      <!-- /.content -->



    </div>



    <!-- /.content-wrapper -->







    <!-- Main Footer -->



    <footer class="main-footer" style="margin-bottom: 1px ">



      <!-- To the right -->



      <div class="pull-right hidden-xs">







      </div>



      <!-- Default to the left -->



      <strong>Copyright &copy; 2017 - <?= date('Y') ?> || <a href="#" target="_blank">E-Retail ITSPKU</a></strong>







    </footer>







    <!-- Control Sidebar -->







    <!-- /.control-sidebar -->



    <!-- Add the sidebar's background. This div must be placed



       immediately after the control sidebar -->



    <div class="control-sidebar-bg"></div>



  </div>



  <!-- ./wrapper -->







  <!-- REQUIRED JS SCRIPTS -->







  <!-- jQuery 2.2.3 -->











  <script type="text/javascript" src="<?= $this->M_setapp->static_bm() ?>/plugins/jQuery/responsive-tab.js"></script>



  <!-- Bootstrap 3.3.7 -->
  <!-- <script src="<?= $this->M_setapp->static_bm() ?>bootstrap/js/bootstrap.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!--SELECT-->
  <script src="<?= $this->M_setapp->static_bm() ?>plugins/select2/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= $this->M_setapp->static_bm() ?>dist/js/app.min.js"></script>
  <script src="<?= $this->M_setapp->static_bm() ?>/lazy/jquery.lazyload.min.js" type="text/javascript"></script>
  <link rel="stylesheet" href="<?= $this->M_setapp->static_bm() ?>plugins/iCheck/square/blue.css">
  <script type="text/javascript" charset="utf-8">
    $(function() {
      $("img.lazy").lazyload({
        effect: "fadeIn"
      }); // untuk dipasang di <img src='xxxx'>
    });
    $(function() {
      $('#btnsubmit').on('click', function() {

        $(this).val('Please wait ...')

          .attr('disabled', 'disabled');

        $('#theform').submit();

      });



    });

    $(function()

      {

        $('#btnsubmit2').on('click', function()

          {

            $(this).val('Please wait ...')

              .attr('disabled', 'disabled');

            $('#theform2').submit();

          });



      });
  </script>





  <!-- Optionally, you can add Slimscroll and FastClick plugins.



     Both of these plugins are recommended to enhance the



     user experience. Slimscroll is required when using the



     fixed layout. -->









  <script>
    function loadPage(list) {



      location.href = list.options[list.selectedIndex].value



      //alert(v);	



      //	$('.bj').hide();



    }







    $(function()

      {

        $('#klikbtnform').on('click', function()

          {

            $(this).val('Sedang diproses ...')

              .attr('disabled', 'disabled');

          });



      });

    $(function()

      {

        $('#klikbtnformbat').on('click', function()

          {

            $(this).val('Sedang diproses ...')

              .attr('disabled', 'disabled');

          });



      });



    function konfirmasi(action)

    {

      var r = confirm('Anda yakin?');



      if (r == true) {

        document.getElementById('theform').action = action;

      } else {

        return alert("Proses di batalkan .");

      }

    }

    function konfirmasi2(action)

    {

      var r = confirm('Anda yakin?');



      if (r == true) {

        document.getElementById('theform2').action = action;

      } else {

        return alert("Proses di batalkan .");

      }

    }









    //Ketika elemen class sembunyi di klik maka elemen class gambar sembunyi
  </script>



  <script>
    $(document).ready(function() {



      $('[data-toggle="tooltip"]').tooltip();



    });
  </script>



  <script type="text/javascript">
    $(window).load(function() {
      $("#loading").fadeOut("slow");
    })
  </script>



  <script type="text/javascript">
    $('#something').click(function() {



      location.reload();



      $('.prnt').attr('disabled', 'disabled');



    });
  </script>



  <script>
    $(".btn_wala").click(function() {



      $('.kla').attr('disabled', 'disabled');



    })
  </script>



  <script>
    function checkAll(element) {



      var el = document.form1.elements["msg"];



      for (i = 0; i < el.length; i++) {



        el[i].checked = element.checked;



      }



    }
  </script>







  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>

  <script src="https://www.jqueryscript.net/demo/jQuery-Plugin-For-Number-Input-Formatting-Mask-Number/jquery.masknumber.js"></script>











  <script type="text/javascript">
    $(document).ready(function() {

      $('.nominal').maskNumber

      ({

        thousands: '.',

        integer: true

      });

    });
  </script>



  <script src="<?= base_url() ?>/dist/css/jquery.datatable.js"></script>

  <script src="<?= base_url() ?>/dist/css/bootstrap.datatable.js"></script>

  <script src="<?= base_url() ?>/dist/css/b.datatable.js"></script>

  <script type="text/javascript">
    $(function() {

      $('.js-basic-example').DataTable({

        responsive: true

      });



      //Exportable table

      $('.js-exportable').DataTable({

        dom: 'Bfrtip',

        responsive: true,

        buttons: [

          'copy', 'csv', 'excel', 'pdf', 'print'

        ]

      });

    });
  </script>





</body>



</html>
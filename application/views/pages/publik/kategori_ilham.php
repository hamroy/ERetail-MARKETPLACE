<style>
  .produk {

    position: relative;

  }



  .image {

    opacity: 1;

    display: block;

    width: 100%;

    height: auto;

    transition: .5s ease;

    backface-visibility: hidden;

  }



  .middle {

    transition: .5s ease;

    opacity: 0;

    position: absolute;

    top: 85%;

    left: 50%;

    transform: translate(-50%, -50%);

    -ms-transform: translate(-50%, -50%)
  }



  .produk:hover .image {

    opacity: 0.3;

  }



  .produk:hover .middle {

    opacity: 1;

  }



  @-webkit-keyframes blink {

    0% {

      opacity: 1;

    }

    50% {

      opacity: 0;

    }

    100% {

      opacity: 1;

    }

  }

  @-moz-keyframes blink {

    0% {

      opacity: 1;

    }

    50% {

      opacity: 0;

    }

    100% {

      opacity: 1;

    }

  }

  @-o-keyframes blink {

    0% {

      opacity: 1;

    }

    50% {

      opacity: 0;

    }

    100% {

      opacity: 1;

    }

  }

  #ilham {

    -webkit-animation: blink 2s;

    -webkit-animation-iteration-count: infinite;

    -moz-animation: blink 2s;

    -moz-animation-iteration-count: infinite;

    -o-animation: blink 2s;

    -o-animation-iteration-count: infinite;

  }

  #ilham2 {

    -webkit-animation: blink 6s;

    -webkit-animation-iteration-count: infinite;

    -moz-animation: blink 2s;

    -moz-animation-iteration-count: infinite;

    -o-animation: blink 2s;

    -o-animation-iteration-count: infinite;

  }
</style>

<style>
  .blink {

    animation: blink-animation 1s steps(50, start) infinite;

    -webkit-animation: blink-animation 1s steps(50, start) infinite;





  }

  @keyframes blink-animation {

    to {

      visibility: hidden;

    }

  }

  @-webkit-keyframes blink-animation {

    to {

      visibility: hidden;

    }

  }
</style>

<div class="panel panel-default">

  <!-- Default panel contents -->

  <!--<div class="panel-heading"><h4><b>Kategori</b> </h4>  </div>-->

  <div class="panel-body">

    <!--AKATEGORI-->

    <div class="row">



      <!--

    	-->

      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

        <div class="row">

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



            <!--     <a href="#" class="thumbnail">

      <img  src="<?= base_url() ?>/dist/img/bg2.png" align="top" width="100%" class="image img-responsive img-rounded lazy blink">

    </a>

 -->

            <div class="panel panel-default">

              <div class="panel-heading">

                <h3 class="panel-title"><strong><span class="text-primary blink_me">INFORMASI</span></strong></h3>

              </div>

              <div class="panel-body">

                <?php

                $info = $this->Modelnya_prayudi->tampilkan_info();

                echo $info->row(0)->isi_info;

                ?>

                <br><br>

                TERIMA KASIH<br>

                ADMIN E-Retail

              </div>

            </div>

          </div>



          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



            <a href="<?= base_url() ?>image/kokominda1.jpeg" class="thumbnail" target="_blank">

              <img src="<?= base_url() ?>/image/kokominda1.jpeg" align="top" width="100%" class="image img-responsive img-rounded ">

            </a>

          </div>



          <script type="text/javascript">
            setTimeout(function() {

              window.location.reload(1);

            }, 30000);
          </script>

          <!-- Modal -->

          <div class="modal fade" id="myModaliklan2" role="dialog">

            <div class="modal-dialog" role="document">

              <div class="modal-content">

                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                </div>

                <div class="modal-body">

                  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->

                    <ol class="carousel-indicators">

                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>

                      <li data-target="#carousel-example-generic" data-slide-to="1"></li>

                      <li data-target="#carousel-example-generic" data-slide-to="2"></li>

                      <li data-target="#carousel-example-generic" data-slide-to="3"></li>

                      <li data-target="#carousel-example-generic" data-slide-to="4"></li>

                      <li data-target="#carousel-example-generic" data-slide-to="5"></li>

                      <li data-target="#carousel-example-generic" data-slide-to="6"></li>

                    </ol>



                    <!-- Wrapper for slides -->

                    <div class="carousel-inner" align="center">



                      <div class="item active" id="ikl">



                        <a href="<?= base_url() ?>image/BrosurGriyaUMY.pdf" target="_blank">

                          <img src="<?= base_url() ?>/image/BrosurGriyaUMY.png" width="100%" class="image img-responsive img-rounded">

                        </a>

                      </div>

                      <div class="item ">

                        <a href="<?= base_url() ?>image/BrosurUMYFinal.pdf" target="_blank">

                          <img src="<?= base_url() ?>/image/BrosurUMYFinal.png" width="100%" class="image img-responsive img-rounded"> </a>

                      </div>



                      <div class="item">

                        <a href="<?= base_url() ?>image/BROSUROTO.pdf" target="_blank">

                          <img src="<?= base_url() ?>/image/BROSUROTO.png" width="100%" class="image img-responsive img-rounded" alt="First slide">

                        </a>



                      </div>

                      <div class="item">

                        <a href="<?= base_url() ?>image/BrosurCicilEmas.pdf" target="_blank">

                          <img src="<?= base_url() ?>/image/BrosurCicilEmas.png" alt="Second slide" width="100%" alt="Second slide" class="image img-responsive img-rounded">

                      </div>

                      </a>





                    </div>



                    <!-- Controls -->

                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">

                      <span class="glyphicon glyphicon-chevron-left"></span>

                    </a>

                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">

                      <span class="glyphicon glyphicon-chevron-right"></span>

                    </a>

                  </div>





                </div>



              </div>

            </div>

          </div>





        </div>

      </div>

      <!--iklan-->

      <!--kategori-->

      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

        <?php





        $gtog = $this->Muser->get_kategori();

        foreach ($gtog->result() as $gt) { ?>





          <div class="col-lg-2 col-sm-3 col-xs-6">

            <div class="thumbnail">

              <a href="<?= base_url('Welcome/publik/' . $gt->id) ?>" data-toggle="tooltip" data-placement="bottom" title="<?= $gt->kategori ?>">

                <img src="<?= base_url() ?>image/<?= $gt->img ?>" data-original="<?= base_url() ?>image/<?= $gt->img ?>" style="height: 100px; width: 150px" class="image img-responsive img-rounded lazy">



              </a>







              <div class="caption" style="height: 70px">

                <h4 class="text-center"><?= $gt->kategori ?></h4>



              </div>

            </div>

          </div>

        <?php }



        ?>

      </div>

      <!--kategori-->







    </div>

    <!--produkacak-->

    <div class="row">

      <div class="col-lg-12">

        <div class="box box-solid">

          <div class="box-header with-border">

            <h3 class="box-title"><b>Produk siap di jual <i class="fa   fa-star"></i></b></h3>

          </div>

          <!-- /.box-header -->

          <div class="box-body">

            <div class="row">

              <div class="col-lg-2 col-md-4 col-xs-6">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



                  <div class="carousel-inner" align="center">

                    <?php

                    $gtpropul = $this->Mtrans->getpropuler1();

                    if ($gtpropul->num_rows() > 0)

                      foreach ($gtpropul->result() as $popid) {

                        $string = read_file('./upload/barang/' . $popid->gambar);

                        if ($string == TRUE) {

                          $idpop = $popid->id;
                        }
                      }

                    ///==============================================================POPULER

                    foreach ($gtpropul->result() as $pop) {

                      $string = read_file('./upload/barang/' . $pop->gambar);

                      if ($string == FALSE) {

                        $fotob = base_url() . '/dist/img/E-Retail.jpg';
                      } else {

                        $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                        if ($pop->id == $idpop) {

                          $a = 'active';
                        } else {

                          $a = '';
                        }



                    ?>

                        <div class="item <?= $a ?> produk">





                          <a href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-link">

                            <img data-original="<?= $fotob ?>" style="height: 150px; width: 150px" class="image img-responsive img-rounded lazy">



                          </a>



                          <div class="carousel-caption">

                            <?= $pop->nama ?><br />

                            <?php

                            if (empty($pop->hargak)) { ?>



                              Rp : <?= number_format($pop->harga, 0, ',', '.') ?>

                            <?php } else { ?>

                              Rp : <?= number_format($pop->hargak, 0, ',', '.') ?>

                            <?php  }



                            ?>



                          </div>

                          <div class="middle">

                            <a type="button" href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-primary"> Lihat Rinci</a>



                          </div>



                        </div>





                    <?php } //foto kosong

                    } // \loop

                    ?>



                  </div>



                </div>

              </div>

              <div class="col-lg-2 col-md-4 col-xs-6">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



                  <div class="carousel-inner" align="center">

                    <?php

                    $gtpropul = $this->Mtrans->getpropuler2();

                    if ($gtpropul->num_rows() > 0)

                      foreach ($gtpropul->result() as $popid) {

                        $string = read_file('./upload/barang/' . $popid->gambar);

                        if ($string == TRUE) {

                          $idpop = $popid->id;
                        }
                      }

                    ///==============================================================POPULER

                    foreach ($gtpropul->result() as $pop) {

                      $string = read_file('./upload/barang/' . $pop->gambar);

                      if ($string == FALSE) {

                        $fotob = base_url() . '/dist/img/E-Retail.jpg';
                      } else {

                        $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                        if ($pop->id == $idpop) {

                          $a = 'active';
                        } else {

                          $a = '';
                        }



                    ?>

                        <div class="item <?= $a ?> produk">





                          <a href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-link">

                            <img class="image img-responsive img-rounded lazy" data-original="<?= $fotob ?>" style="height: 150px; width: 150px"></a>



                          <div class="carousel-caption">

                            <?= $pop->nama ?><br />

                            <?php

                            if (empty($pop->hargak)) { ?>



                              Rp : <?= number_format($pop->harga, 0, ',', '.') ?>

                            <?php } else { ?>

                              Rp : <?= number_format($pop->hargak, 0, ',', '.') ?>

                            <?php  }



                            ?>

                          </div>

                          <div class="middle">

                            <a type="button" href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-primary"> Lihat Rinci</a>



                          </div>



                        </div>

                    <?php } //foto kosong

                    } // \loop

                    ?>



                  </div>



                </div>

              </div>

              <div class="col-lg-2 col-md-4 col-xs-6">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



                  <div class="carousel-inner" align="center">

                    <?php

                    $gtpropul = $this->Mtrans->getpropuler3();

                    if ($gtpropul->num_rows() > 0)

                      foreach ($gtpropul->result() as $popid) {

                        $string = read_file('./upload/barang/' . $popid->gambar);

                        if ($string == TRUE) {

                          $idpop = $popid->id;
                        }
                      }

                    ///==============================================================POPULER

                    foreach ($gtpropul->result() as $pop) {

                      $string = read_file('./upload/barang/' . $pop->gambar);

                      if ($string == FALSE) {

                        $fotob = base_url() . '/dist/img/E-Retail.jpg';
                      } else {

                        $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                        if ($pop->id == $idpop) {

                          $a = 'active';
                        } else {

                          $a = '';
                        }



                    ?>

                        <div class="item <?= $a ?> produk">





                          <a href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-link">

                            <img class="image img-responsive img-rounded lazy" data-original="<?= $fotob ?>" style="height: 150px; width: 150px"></a>



                          <div class="carousel-caption">

                            <?= $pop->nama ?><br />

                            <?php

                            if (empty($pop->hargak)) { ?>



                              Rp : <?= number_format($pop->harga, 0, ',', '.') ?>

                            <?php } else { ?>

                              Rp : <?= number_format($pop->hargak, 0, ',', '.') ?>

                            <?php  }



                            ?>

                          </div>

                          <div class="middle">

                            <a type="button" href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-primary"> Lihat Rinci</a>



                          </div>



                        </div>

                    <?php } //foto kosong

                    } // \loop

                    ?>



                  </div>



                </div>

              </div>



              <div class="col-lg-2 col-md-4 col-xs-6">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



                  <div class="carousel-inner" align="center">

                    <?php

                    $gtpropul = $this->Mtrans->getpropuler4();

                    if ($gtpropul->num_rows() > 0)

                      foreach ($gtpropul->result() as $popid) {

                        $string = read_file('./upload/barang/' . $popid->gambar);

                        if ($string == TRUE) {

                          $idpop = $popid->id;
                        }
                      }

                    ///==============================================================POPULER

                    foreach ($gtpropul->result() as $pop) {

                      $string = read_file('./upload/barang/' . $pop->gambar);

                      if ($string == FALSE) {

                        $fotob = base_url() . '/dist/img/E-Retail.jpg';
                      } else {

                        $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                        if ($pop->id == $idpop) {

                          $a = 'active';
                        } else {

                          $a = '';
                        }



                    ?>

                        <div class="item <?= $a ?> produk">





                          <a href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-link">

                            <img class="image img-responsive img-rounded lazy" data-original="<?= $fotob ?>" style="height: 150px; width: 150px"></a>



                          <div class="carousel-caption">

                            <?= $pop->nama ?><br />

                            <?php

                            if (empty($pop->hargak)) { ?>



                              Rp : <?= number_format($pop->harga, 0, ',', '.') ?>

                            <?php } else { ?>

                              Rp : <?= number_format($pop->hargak, 0, ',', '.') ?>

                            <?php  }



                            ?>

                          </div>

                          <div class="middle">

                            <a type="button" href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-primary"> Lihat Rinci</a>



                          </div>



                        </div>

                    <?php } //foto kosong

                    } // \loop

                    ?>



                  </div>



                </div>

              </div>



              <div class="col-lg-2 col-md-4 col-xs-6">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



                  <div class="carousel-inner" align="center">

                    <?php

                    $gtpropul = $this->Mtrans->getpropuler5();

                    if ($gtpropul->num_rows() > 0)

                      foreach ($gtpropul->result() as $popid) {

                        $string = read_file('./upload/barang/' . $popid->gambar);

                        if ($string == TRUE) {

                          $idpop = $popid->id;
                        }
                      }

                    ///==============================================================POPULER

                    foreach ($gtpropul->result() as $pop) {

                      $string = read_file('./upload/barang/' . $pop->gambar);

                      if ($string == FALSE) {

                        $fotob = base_url() . '/dist/img/E-Retail.jpg';
                      } else {

                        $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                        if ($pop->id == $idpop) {

                          $a = 'active';
                        } else {

                          $a = '';
                        }



                    ?>

                        <div class="item <?= $a ?> produk">





                          <a href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-link">

                            <img class="image img-responsive img-rounded lazy" data-original="<?= $fotob ?>" style="height: 150px; width: 150px"></a>



                          <div class="carousel-caption">

                            <?= $pop->nama ?><br />

                            <?php

                            if (empty($pop->hargak)) { ?>



                              Rp : <?= number_format($pop->harga, 0, ',', '.') ?>

                            <?php } else { ?>

                              Rp : <?= number_format($pop->hargak, 0, ',', '.') ?>

                            <?php  }



                            ?>

                          </div>

                          <div class="middle">

                            <a type="button" href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-primary"> Lihat Rinci</a>



                          </div>



                        </div>

                    <?php } //foto kosong

                    } // \loop

                    ?>



                  </div>



                </div>

              </div>

              <div class="col-lg-2 col-md-4 col-xs-6">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">



                  <div class="carousel-inner" align="center">

                    <?php

                    $gtpropula = $this->Mtrans->getpropuler6();

                    if ($gtpropula->num_rows() > 0)

                      foreach ($gtpropula->result() as $popida) {

                        $string = read_file('./upload/barang/' . $popida->gambar);

                        if ($string == TRUE) {

                          $idpop = $popida->id;
                        }
                      }

                    ///==============================================================POPULER

                    foreach ($gtpropula->result() as $pop) {

                      $string = read_file('./upload/barang/' . $pop->gambar);

                      if ($string == FALSE) {

                        $fotob = base_url() . '/dist/img/E-Retail.jpg';
                      } else {

                        $fotob = base_url() . '/upload/barang/' . $pop->gambar;

                        if ($pop->id == $idpop) {

                          $a = 'active';
                        } else {

                          $a = '';
                        }



                    ?>

                        <div class="item <?= $a ?> produk">





                          <a href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-link">

                            <img class="image img-responsive img-rounded lazy" data-original="<?= $fotob ?>" style="height: 150px; width: 150px"></a>



                          <div class="carousel-caption">

                            <?= $pop->nama ?><br />

                            <?php

                            if (empty($pop->hargak)) { ?>



                              Rp : <?= number_format($pop->harga, 0, ',', '.') ?>

                            <?php } else { ?>

                              Rp : <?= number_format($pop->hargak, 0, ',', '.') ?>

                            <?php  }



                            ?>

                          </div>

                          <div class="middle">

                            <a type="button" href="<?= base_url('Welcome/produk/' . $pop->id) ?>" class="btn btn-primary"> Lihat Rinci</a>



                          </div>



                        </div>

                    <?php } //foto kosong

                    } // \loop

                    ?>



                  </div>



                </div>

              </div>

            </div>



          </div>

        </div>



      </div>





    </div>



    <?php



    ?>



    <?php



    $getidtm = 'tunai';

    $getidtuser = 'tunai';

    $gettotal = 100;

    if (!empty($getidtm) and !empty($getidtuser) and  $gettotal != 0) {

      //echo 'lolos';	

    } else {

      //echo 'tolak';	

    }

    $waktu = gmdate("H:i:s");

    $tanggal = gmdate('d-m-Y', time() + 3600 * ($timezone + date('I')));



    ?>



  </div>

  <!-- /.container -->

</div>
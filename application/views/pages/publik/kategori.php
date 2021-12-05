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

  #myModaliklan2 {
    top: 15%;
    left: 35%;
    outline: none;
  }

  @media screen and (min-width: 768px) {
    #myModaliklan2 .modal-dialog {
      width: 900px;
    }
  }

  #myModaliklan2 .modal-dialog {
    width: 85%;
  }
</style>

<div class="panel panel-default">
  <div class="panel-body">
    <!--AKATEGORI-->
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                <div class="item active">
                  <a href="<?= base_url() ?>image/blank.jpg" class="thumbnail" target="_blank">
                    <img src="<?= base_url() ?>image/blank.jpg" align="top" width="100%" class="image img-responsive img-rounded ">
                  </a>
                  <div class="carousel-caption">
                    ...

                  </div>
                </div>
              </div>

              <!-- Controls -->
              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
          <!-- Modal -->

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
                <img src="<?= $this->M_setapp->static_bm() ?>image/<?= $gt->img ?>" data-original="<?= $this->M_setapp->static_bm() ?>image/<?= $gt->img ?>" style="height: 100px; width: 150px" class="image img-responsive img-rounded lazy"></a>
              <div class="caption" style="height: 70px">
                <h4 class="text-center"><?= $gt->kategori ?></h4>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
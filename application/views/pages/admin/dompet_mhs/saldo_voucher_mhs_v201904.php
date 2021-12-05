<div class="row">
  <?php
  ////20180501 v parsel
  $iduser = $id_user;
  $idjov = 3; //3=VMHS
  ///GALLVOC 201811
  $gv = $this->M_gvocall->gvall($idjov, $id_user);  ///

  /////
  $gettotal_parsel_pesan = $data['gettotal_parsel_pesan'] = $gv['saldo_dibelanjakan'];
  $tosaldopar = $data['tosaldopar'] = $gv['saldo'];
  $redvocpar = 0;  //redeem par voc

  $dompet = $salpenvocpar = $gv['dompet_selesai']; ///hasil akhir pendapatan (cetak)
  $get_reedeem_tp = $gv['redeem'];
  ?>
  <div class="col-xs-12 col-md-6">

    <div class="panel panel-primary">

      <!-- Default panel contents -->

      <div class="panel-heading" align="center">
        <h3> #1 Dompet E-Retail - Deposit</h3>
      </div>

      <div class="panel-body">

        <h4 align="center"><b>Rp : <?= number_format($tosaldopar, 0, ',', '.') ?></b></h4>



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

        <h4 align="center">Rp : <?= number_format($gettotal_parsel_pesan, 0, ',', '.') ?></h4>

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

        <h4 align="center">Rp : <?= number_format($salpenvocpar, 0, ',', '.') ?></h4>

        <hr />

        <?PHP
        $MODRE = 0;
        $MENRE = '';
        if ($salpenvocpar > 0) {
          $MODRE = 1;
          $MENRE = '<a data-toggle="modal" type="button" class="btn btn-warning" data-target="#myModalgreedeem" href="#">

                      <i class="fa fa-money"></i>  Redeem

                      </a> ';
        }
        echo $MENRE;
        ?>



        <p class="text-info"> <br /> (*)Proses redeem ini akan dibebani biaya fee pelayanan transaksi 2% </p>

        <?php

        $tanggal = $this->M_time->keBmt();
        ///*/
        ////*/
        ?>
        <h4 class="text-primary">(+) Pengambilan bisa dilakukan pada tanggal <?php echo $tanggal ?></h4>
        <?php
        if ($MODRE == 1) {
        ?>
          <div class="modal fade" id="myModalgreedeem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog">

              <div class="modal-content">

                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                  <h4 class="modal-title" id="myModalLabel">Form</h4>

                </div>

                <div class="modal-body">

                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="theform">

                    <div class="box-body">







                      <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label " style="color: #000000">Redeem</label>



                        <div class="col-sm-9">

                          <input type="number" min="1" max="<?= $salpenvocpar ?>" class="form-control" value="<?= $salpenvocpar ?>" style="border-radius: 6px" name="redeem" id="inputEmail3" required placeholder="Voucher yang Dicairkan">
                          <input type="hidden" name="d3" value="1" />
                          <p class="text-info"> <br />(*)Proses redeem ini akan dibebani biaya fee pelayanan transaksi 2% </p>

                        </div>

                      </div>

                      <input type="hidden" name="jvoc" value="3" />
                    </div>

                    <!-- /.box-body -->

                    <div class="box-footer">

                      <input id="btnsubmit" value="Lanjut" onclick="return konfirmasiredeem('<?= base_url('C_dompetp/redeem_voucher_v2/' . $id_user . '/3') ?>')" type="submit" class="btn btn-success pull-right btn-block btn-lg" />


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
        <?php
        }
        ?>


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

        <h4 align="center">Rp : <?= number_format($get_reedeem_tp, 0, ',', '.') ?></h4>
        <?php
        $get_reedeem_st = $this->Mbmt->getreedeem_perid_user_st($id_user, 0); ///0==redeem

        //echo '( TRUE: '.$get_reedeem_st.')';
        ?>
        <hr />



        <a href="<?= base_url('C_dompet/cetakan_beranda_riwayat/3') ?>" class="btn btn-info">Riwayat Redeem</a>



      </div>



    </div>





  </div>

</div>
<script type="text/javascript">
  function konfirmasiredeem(action) {
    var r = confirm('Anda yakin?');

    if (r == true) {
      document.getElementById('theform').action = action;
    }
  }
</script>
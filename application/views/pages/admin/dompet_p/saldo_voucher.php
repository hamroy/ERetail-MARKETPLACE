<div class="row">
  <?php
  ////20180501 v parsel
  $iduser = $id_user;
  $id_voc_s = $this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel

  $gpv = $this->M_vparsel->get_saldo_voc_parsel_iduser($iduser, $id_voc_s);
  $gettotal_parsel = $this->M_vparsel->get_total_tbltransaksi_vparsel($iduser, $id_voc_s);  //tbltransaksi 1=[parsel]
  $gettotal_parsel_pesan = $this->M_vparsel->get_total_tbltransaksi_vparsel_pesan($iduser, $id_voc_s);  //tbltransaksi
  $gettotal_parsel_dapat = $this->M_vparsel->get_total_tbltransaksi_vparsel_didapat($iduser, $id_voc_s);  //tbltransaksi
  $hparsel = 0;

  if ($gpv->num_rows() > 0) {
    $hparsel = $gpv->row()->saldo_awal;
  }

  ///update sisa saldo
  $gsvoc = $this->M_vparsel->get_sisa_voc($id_user, $id_voc_s, 1);     ///0=makan,2=song2,1=parsel

  if ($gsvoc->num_rows() > 0) {
    $hparsel = $hparsel + $gsvoc->row()->saldo_awal;
  }
  ///update sisa saldo

  $tranpesanbaayar = ($gettotal_parsel + $gettotal_parsel_pesan);
  $tosaldopar = $hparsel - $tranpesanbaayar;

  ////pendapatan voc parsel 
  $get_reedeem = $this->Mbmt->get_tbl_reedeem_perid_user($id_user, 1);
  $get_reedeem_tp = $this->Mbmt->get_tbl_reedeem_perid_user_perstatus($id_user, 1, 0);
  //$get_voch=$this->Madmin->get_all_transaksi_id_user_obatal_dibeli_voucher($id_user,1);
  $redvocpar = 0;  //redeem par voc
  $salpenvocpar = $gettotal_parsel_dapat - $get_reedeem;





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

        $tanggal = $this->M_time->tglnow_slas();
        $tanggal_waknow = $this->M_time->harinow();
        //$tanggal= '01/02/2018'; 
        $pectgl = explode('/', $tanggal);

        $cektgl = $this->M_time->get_tbl_ttgl($pectgl[0]);
        $ttgl = $cektgl->row()->t_tgl;
        $b_bln = date('m', strtotime('+1 month', strtotime($tanggal_waknow)));
        $t_thn = $pectgl[2];
        if ($pectgl[1] == 12 and $pectgl[0] > 10) {
          $b_bln = '01';
          $t_thn = $pectgl[2] + 1;
        }

        if ($pectgl[0] < 11) {
          $b_bln = $pectgl[1];
          $t_thn = $pectgl[2];
        } ///*/



        ////*/
        ?>
        <h4 class="text-primary">(+) Pengambilan bisa dilakukan pada tanggal <?php echo $ttgl . '-';
                                                                              echo $b_bln . '-';
                                                                              echo $t_thn;      ?></h4>
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

                      <input type="hidden" name="jvoc" value="1" />
                    </div>

                    <!-- /.box-body -->

                    <div class="box-footer">

                      <input id="btnsubmit" value="Lanjut" onclick="return konfirmasiredeem('<?= base_url('C_dompetp/redeem_voucher_v2/' . $id_user . '/1') ?>')" type="submit" class="btn btn-success pull-right btn-block btn-lg" />


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



        <a href="<?= base_url('C_dompet/cetakan_beranda_riwayat/1') ?>" class="btn btn-info">Riwayat Redeem</a>



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
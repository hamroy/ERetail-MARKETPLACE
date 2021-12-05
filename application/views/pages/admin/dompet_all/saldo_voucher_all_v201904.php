<?php

////20180501 v parsel

$iduser = $id_user;

$idjov; //4 == VG13 - VLL

///GALLVOC 201811

$gv = $this->M_gvocall->gvall($idjov, $id_user);  ///4 == VG13 - VLL



/////

$data['gettotal_parsel_pesan'] = $gv['saldo_dibelanjakan'];

$data['tosaldopar'] = $gv['saldo'];

$redvocpar = 0;  //redeem par voc



$dompet = $salpenvocpar = $gv['dompet_selesai']; ///hasil akhir pendapatan (cetak)

$get_reedeem_tp = $gv['redeem'];



?>



<!-- DOMPET SALDO -->



<?php

if ($this->M_setapp->real_status() < 3) {

  $this->load->view('pages/admin/dompet_all/saldo_voucher_all_dompet', $data);
}

?>



<!-- DOMPET SALDO -->



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



                      <input type="hidden" name="jvoc" value="<?= $idjov ?>" />

                    </div>



                    <!-- /.box-body -->



                    <div class="box-footer">



                      <input id="btnsubmit" value="Lanjut" onclick="return konfirmasiredeem('<?= base_url('C_dompetp/redeem_voucher_v2/' . $id_user . '/4') ?>')" type="submit" class="btn btn-success pull-right btn-block btn-lg" />





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







        <a href="<?= base_url('C_dompet/cetakan_beranda_riwayat/' . $idjov) ?>" class="btn btn-info">Riwayat Redeem</a>







      </div>







    </div>











  </div>



</div>

<script type="text/javascript">
  function konfirmasiredeem(action)

  {

    var r = confirm('Anda yakin?');



    if (r == true) {

      document.getElementById('theform').action = action;

    }

  }
</script>
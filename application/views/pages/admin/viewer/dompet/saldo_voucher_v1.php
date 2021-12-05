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

            $gt_tblpesanvoucher = $this->Login_model->get_daftar_pesan_voucher($id_user); //tbl pesan voucher

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

                <?php

                if ($vc->bonus == 1) { ///jika bonus

                  $edisjud = 'Bonus';
                } else {



                  $edisjud = 'Ed ' . $vc->edisi;
                }



                ?>

                <td><?= $edisjud ?>. <?= $vc->jenis ?></td>



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

                $this->Login_model->problem_app($id_user, $v0 + $totsaldo);
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

        if ($dompet > 0) {

          $get_reedeem = $this->Mbmt->get_tbl_reedeem_perid_user($id_user);

          //echo '( R: '.$get_reedeem.')';

          $get_voch = $this->Madmin->get_all_transaksi_id_user_obatal_dibeli_voucher($id_user);



          //echo '( T: ' .$get_voch .' ) ';



          if ($get_voch == $get_reedeem + $dompet) {

        ?>

            <a data-toggle="modal" type="button" class="btn btn-warning" data-target="#myModalgreedeem" href="#">

              <i class="fa fa-money"></i> Redeem

            </a>

            <p class="text-info"> <br /> (*)Proses redeem ini akan dibebani biaya fee pelayanan transaksi bmt umy sebesar Rp. 2000 </p>



          <?php

          } else {

          ?>

            <p class="text-danger">Mohon maaf, <br />Untuk keamanan , Anda tidak bisa <b><i><u>Redeem</u></i></b>, Mohon Untuk Menghubungi Pihak admin E-Retail .<br /> Terima Kasih. </p>

          <?php

          }

          ?>





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

                        <input type="number" min="2001" max="<?= $dompet ?>" class="form-control" value="" style="border-radius: 6px" name="redeem" id="inputEmail3" placeholder="Voucher yang Dicairkan">

                        <p class="text-info"> <br />(*)Proses redeem ini akan dibebani biaya fee pelayanan transaksi bmt umy sebesar Rp. 2000 </p>

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
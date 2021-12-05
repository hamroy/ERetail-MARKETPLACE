<div class="row">



  <div class="col-xs-12 col-md-12">

    <?php

    $message = $this->session->flashdata('pesan');

    echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

    ?>


    <div class="panel panel-primary">

      <!-- Default panel contents -->

      <div class="panel-heading" align="center">
        <h3> #1 VOUCHER E-Retail - Deposit </h3>
      </div>

      <div class="panel-body">

        <div align="center">
          <p><b style="font-size:60px ; font-family: number">Rp : <?= number_format($tosaldopar, 0, ',', '.') ?>

            </b>
            <br>
            <?php

            $dur = $this->M_time->durasi_ymd($durasi);
            // echo $idjov;

            ?>
            <label id="clockdiv">Durasi : <span class="days"><?= $dur ?></span> Hari
            </label>
            <br>
            <?php
            // echo $gsaldoall->num_rows();
            if ($gsaldoall->num_rows() == 0 and ($dur != 0 and $tosaldopar > 0)) {
            ?>
          <form method="POST" action="<?= base_url('C_dompetKu/pindahKeDompet/' . $id_user) ?>">
            <input type="hidden" name="jvoc" value="<?= $idjov ?>" />

            <input type="submit" class="btn btn-success" onclick="return confirm('Anda Yakin ?')" value="PINDAH KE DOMPET" />
          </form>
        <?php
            }
        ?>

        </p>

        </div>
        <hr />
        <p class="text-info">
          (-) Voucher tidak dapat di gunakan untuk belanja sebelum di pindahkan ke DOMPET.
        </p>
        <p class="text-info">
          (-) Saldo Voucher bisa di pindah DOMPET sebelum durasi habis.
        </p>





      </div>





    </div>

  </div>
</div>
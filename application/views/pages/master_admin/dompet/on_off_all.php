<div class="box-header with-border">


  <div class="box-tools pull-right">
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">

      <br />

      <table class="table no-margin">
        <?php
        $get = $this->Madmin_master->get_onoffvoc_all();
        $gt_tblinputpesanvoucher_select_tahap = $this->Login_model->get_daftar_input_voucher_st_all();
        $th = $gt_tblinputpesanvoucher_select_tahap;




        $status_v1 = 'Aktif';
        $status_v2 = ' Aktif';
        $status_v3 = ' Aktif';
        $status_v4 = ' Aktif';
        $status_v5 = ' Aktif';
        $status_v6 = ' Aktif';
        $link_v1 = 'Non Aktif';
        $link_v2 = 'Non Aktif';
        $link_v3 = 'Non Aktif';
        $link_v4 = 'Non Aktif';
        $link_v5 = 'Non Aktif';
        $link_v6 = 'Non Aktif';
        $ak_v1 = '1';
        $ak_v2 = '1';
        $ak_v3 = '1';
        $ak_v4 = '1';
        $ak_v5 = '1';
        $ak_v6 = '1';
        $ceked_v1 = '';
        $ceked_v3 = '';
        $ceked_v4 = '';
        $ceked_v5 = '';
        $ceked_v6 = '';

        $kolom_ = '';
        if ($get->num_rows() > 0) {
          //$get_0->row()->id;
          //$get=$this->Madmin_master->get_onoffvoc_all($get_0);    
          if ($get->row()->vc1 == '1') {
            $status_v1 = 'Non Aktif';
            $link_v1 = 'Aktif';
            $ak_v1 = '0';
            $ceked_v1 = 'checked';
          }
          if ($get->row()->vc2 == '1') {
            $status_v2 = 'Non Aktif';
            $link_v2 = 'Aktif';
            $ak_v2 = '0';
          }
          if ($get->row()->vc3 == '1') {
            $status_v3 = 'Non Aktif';
            $link_v3 = 'Aktif';
            $ak_v3 = '0';
            $ceked_v3 = 'checked';
          }
          if ($get->row()->vc4 == '1') {
            $status_v4 = 'Non Aktif';
            $link_v4 = 'Aktif';
            $ak_v4 = '0';
            $ceked_v4 = 'checked';
          }
          if ($get->row()->vc5 == '1') {
            $status_v5 = 'Non Aktif';
            $link_v5 = 'Aktif';
            $ak_v5 = '0';
            $ceked_v5 = 'checked';
          }
          if ($get->row()->vc6 == '1') {
            $status_v6 = 'Non Aktif';
            $link_v6 = 'Aktif';
            $ak_v6 = '0';
            $ceked_v6 = 'checked';
          }
          $kolom_ = $get->row()->vc2;

          //echo $get->row()->id;
        }

        ?>
        <?php
        $fasDompet = [
          'st' => 'Aktif',
          //
          'st-' => 'Non Aktif',
          'vst' => 1,
        ];

        $fasReDompet = [
          'stredeem' => 'Aktif',
          //
          'stsredeem-' => 'Non Aktif',
          'vstredeem' => 1,
        ];


        $fas = $this->M_setapp->setFasiltasApp();

        if ($fas['dompet'] > 0) {
          $fasDompet = [
            'st' => 'Non Aktif',
            //
            'st-' => 'Aktif',
            'vst' => 0,
          ];
        }

        if ($fas['redeem'] > 0) {
          $fasReDompet = [
            'stredeem' => 'Non Aktif',
            //
            'stsredeem-' => 'Aktif',
            'vstredeem' => 0,
          ];
        }

        ?>

        <form name="form1" method="post" action="<?= base_url('C_setvoc/simpan_SetDompet') ?>">
          <tr bgcolor="#d9d9dd">
            <th>DOMPET E-Retail</th>

            <th><?= $fasDompet['st'] ?></th>
            <th>
              <span class="pull-right">
                <input name="fas" value="1" type="hidden" />
                <input name="stFas" value="<?= $fasDompet['vst'] ?>" type="hidden" />
                <input value="<?= $fasDompet['st-'] ?>" class="btn btn-success" type="submit" />
              </span>
            </th>

          </tr>

        </form>
        <form name="form1" method="post" action="<?= base_url('C_setvoc/simpan_SetDompet') ?>">
          <tr bgcolor="#d9d9dd">
            <th>REDEEM DOMPET E-Retail</th>

            <th><?= $fasReDompet['stredeem'] ?></th>
            <th>
              <span class="pull-right">
                <input name="fas" value="2" type="hidden" />
                <input name="stFas" value="<?= $fasReDompet['vstredeem'] ?>" type="hidden" />
                <input value="<?= $fasReDompet['stsredeem-'] ?>" class="btn btn-success" type="submit" />
              </span>
            </th>

          </tr>

        </form>
        <tr>
          <td colspan="3">
            <hr />
          </td>
        </tr>
        <form name="form1" method="post" action="<?= base_url('C_dompet/simpan_Set_voc_all/2') ?>">
          <tr bgcolor="#d9d9dd">
            <th>VOUCHER REGULER</th>

            <th><?= $link_v1 ?></th>
            <th>
              <span class="pull-right">

                <a><input name="reguler" id="msg" value="1" type="checkbox" <?= $ceked_v1 ?> /> <?= $link_v1 ?> </a>

              </span>
            </th>

          </tr>

          <tr bgcolor="#d9d9dd">
            <th>VOUCHER SONGSONG</th>

            <th><?= $link_v3 ?></th>
            <th>
              <span class="pull-right">

                <a><input name="song" id="msg" value="1" type="checkbox" <?= $ceked_v3 ?> /> <?= $link_v3 ?> </a>

              </span>
            </th>

          </tr>
          <tr bgcolor="#d9d9dd">
            <th>VOUCHER PARSEL</th>

            <th><?= $link_v4 ?></th>
            <th>
              <span class="pull-right">

                <a><input name="parsel" id="msg" value="1" type="checkbox" <?= $ceked_v4 ?> /> <?= $link_v4 ?> </a>

              </span>
            </th>

          </tr>

          <tr bgcolor="#d9d9dd">
            <th>VOUCHER MAHASISWA</th>

            <th><?= $link_v5 ?></th>
            <th>
              <span class="pull-right">

                <a><input name="mhs" id="msg" value="1" type="checkbox" <?= $ceked_v5 ?> /> <?= $link_v5 ?> </a>

              </span>
            </th>

          </tr>

          <tr bgcolor="#d9d9dd">
            <th>VOUCHER GAJI 13</th>

            <th><?= $link_v6 ?></th>
            <th>
              <span class="pull-right">

                <a><input name="gaji13" id="msg" value="1" type="checkbox" <?= $ceked_v6 ?> /> <?= $link_v6 ?> </a>

              </span>
            </th>

          </tr>







          <tr>
            <td colspan="3" align="right">
              <input onclick="checkAll(this)" type="checkbox" /> Pilih semua edisi
              <input type="submit" class="btn btn-success btn-ex" value=" Simpan" onclick="return confirm('Anda YAkin !!')" />
              <p class="text-info">(*) Pilih semua / salah satu untuk di Aktifkan</p>
            </td>
          </tr>
        </form>



      </table>
    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.box-body -->

  <!-- /.box-footer -->
</div>
    <div class="box-header with-border">


      <div class="box-tools pull-right">
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <?php
            $get = $this->Madmin_master->get_onoffvoc($id_user);
            $status_v1 = 'Aktif';
            $link_v1 = 'Non Aktifkan';
            $ak_v1 = '0';
            $status_v2 = 'Aktif';
            $link_v2 = 'Non Aktifkan';
            $ak_v2 = '0';
            $status_v3 = 'Aktif';
            $link_v3 = 'Non Aktifkan';
            $ak_v3 = '0';
            $status_v4 = 'Aktif';
            $link_v4 = 'Non Aktifkan';
            $ak_v4 = '0';
            $status_v5 = 'Aktif';
            $link_v5 = 'Non Aktifkan';
            $ak_v5 = '0';
            if ($get->num_rows() > 0) {
              if ($get->row()->vc1 == '0') {
                $status_v1 = 'Non Aktif';
                $link_v1 = 'Aktifkan';
                $ak_v1 = '1';
              }
              if ($get->row()->vsong2 == '0') {
                $status_v2 = 'Non Aktif';
                $link_v2 = 'Aktifkan';
                $ak_v2 = '1';
              }
              if ($get->row()->vparsel == '0') {
                $status_v3 = 'Non Aktif';
                $link_v3 = 'Aktifkan';
                $ak_v3 = '1';
              }
              if ($get->row()->vmhs == '0') {
                $status_v4 = 'Non Aktif';
                $link_v4 = 'Aktifkan';
                $ak_v4 = '1';
              }
              if ($get->row()->v_gaji13 == '0') {
                $status_v5 = 'Non Aktif';
                $link_v5 = 'Aktifkan';
                $ak_v5 = '1';
              }
            }
            ?>
            <?php
            $fasDompet = [
              'st' => 'Aktif',
              //
              'st-' => 'Non Aktif',
              'vst' => 0,
            ];

            $fasReDompet = [
              'stredeem' => 'Aktif',
              //
              'stsredeem-' => 'Non Aktif',
              'vstredeem' => 0,
            ];

            $x = $this->M_dompetKu->getDataDompetPerakun($id_user);
            if ($x['status'] == 0) {
              $fasDompet = [
                'st' => 'Non Aktif',
                //
                'st-' => 'Aktif',
                'vst' => 1,
              ];
            }

            if ($x['fasRedeem'] == 0) {
              $fasReDompet = [
                'stredeem' => 'Non Aktif',
                //
                'stsredeem-' => 'Aktif',
                'vstredeem' => 1,
              ];
            }
            ?>

            <form name="form1" method="post" action="<?= base_url('C_setvoc/simpan_SetDompetAkun') ?>">
              <tr bgcolor="#d9d9dd">
                <th>DOMPET E-Retail</th>

                <th><?= $fasDompet['st'] ?></th>
                <th>
                  <span class="pull-right">
                    <input name="akun" value="<?= $id_user ?>" type="hidden" />
                    <input name="fas" value="1" type="hidden" />
                    <input name="stFas" value="<?= $fasDompet['vst'] ?>" type="hidden" />
                    <input value="<?= $fasDompet['st-'] ?>" class="btn btn-success" type="submit" />
                  </span>
                </th>

              </tr>

            </form>
            <form name="form1" method="post" action="<?= base_url('C_setvoc/simpan_SetDompetAkun') ?>">
              <tr bgcolor="#d9d9dd">
                <th>REDEEM DOMPET E-Retail</th>

                <th><?= $fasReDompet['stredeem'] ?></th>
                <th>
                  <span class="pull-right">
                    <input name="akun" value="<?= $id_user ?>" type="hidden" />
                    <input name="fas" value="2" type="hidden" />
                    <input name="stFas" value="<?= $fasReDompet['vstredeem'] ?>" type="hidden" />
                    <input value="<?= $fasReDompet['stsredeem-'] ?>" class="btn btn-success" type="submit" />
                  </span>
                </th>

              </tr>

            </form>
            <tr>
              <th colspan="3">
                <hr />
              </th>

            </tr>
            <!-- voucher -->
            <tr bgcolor="#d9d9dd">
              <th>VOUCHER MAKAN</th>

              <th><?= $status_v1 ?></th>
              <th>
                <span class="pull-right">
                  <a onclick="return(confirm('anda yakin')) " href="<?= base_url('C_dompet/simpan_Set_voc_nodsi/' . $id_user . '/1/' . $ak_v1) ?>"><?= $link_v1 ?></a>
                </span>
              </th>

            </tr>
            <tr bgcolor="#d9d9dd">
              <th>VOUCHER SONGSONG RAMADHAN</th>

              <th><?= $status_v2 ?></th>
              <th>
                <span class="pull-right">
                  <a onclick="return(confirm('anda yakin')) " href="<?= base_url('C_dompet/simpan_Set_voc_nodsi/' . $id_user . '/2/' . $ak_v2) ?>"><?= $link_v2 ?></a>
                </span>
              </th>
            </tr>
            <tr bgcolor="#d9d9dd">
              <th>VOUCHER PARSEL</th>

              <th><?= $status_v3 ?></th>
              <th>
                <span class="pull-right">
                  <a onclick="return(confirm('anda yakin')) " href="<?= base_url('C_dompet/simpan_Set_voc_nodsi/' . $id_user . '/3/' . $ak_v3) ?>"><?= $link_v3 ?></a>
                </span>
              </th>

            </tr>
            <tr bgcolor="#d9d9dd">
              <th>VOUCHER MAHASISWA</th>

              <th><?= $status_v4 ?></th>
              <th>
                <span class="pull-right">
                  <a onclick="return(confirm('anda yakin')) " href="<?= base_url('C_dompet/simpan_Set_voc_nodsi/' . $id_user . '/4/' . $ak_v4) ?>"><?= $link_v4 ?></a>
                </span>
              </th>

            </tr>
            <tr bgcolor="#d9d9dd">
              <th>VOUCHER GAJI 13</th>

              <th><?= $status_v5 ?></th>
              <th>
                <span class="pull-right">
                  <a onclick="return(confirm('anda yakin')) " href="<?= base_url('C_dompet/simpan_Set_voc_nodsi/' . $id_user . '/5/' . $ak_v5) ?>"><?= $link_v5 ?></a>
                </span>
              </th>

            </tr>


          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.box-body -->

      <!-- /.box-footer -->
    </div>

    <div class="modal fade" id="myModaltblsfe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">TAMBAH EDISI</h4>
          </div>
          <div class="modal-body">
            <form role="form" action="<?= base_url('C_dompet/terima_pesan_voc/b/') ?>" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Tambah Edisi :</label>
                <input class="form-control" name="ed" type="number" min="0" />
              </div>
              <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
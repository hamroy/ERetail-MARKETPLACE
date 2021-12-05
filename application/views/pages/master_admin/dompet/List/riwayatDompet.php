  <?php
  $pro = 0;
  if (isset($_GET['pro'])) {
    $pro = $_GET['pro'];
  }
  ?>
  <div class="col-xs-12">

    <div class="well">
      <form class="form-horizontal" role="form">
        <div class="input-group" style="padding: 5px">
          <label for="inputEmail3" class="control-label">Pilih Status Redeem</label>
          <select name="sort" class="form-control" onchange="loadPage(this.form.elements[0])">
            <option value="#0">Pilih Status</option>
            <option value="<?= base_url('C_dompet/riwayat_vcer?pil=' . $dvo . '&pro=0') ?>" <?= $pro == 0 ? "selected" : "" ?>>
              Proses
            </option>
            <option value="<?= base_url('C_dompet/riwayat_vcer?pil=' . $dvo . '&pro=1') ?>" <?= $pro == 1 ? "selected" : "" ?>>
              Selesai
            </option>
            <option value="<?= base_url('C_dompet/riwayat_vcer?pil=' . $dvo . '&pro=2') ?>" <?= $pro == 2 ? "selected" : "" ?>>
              Ditolak
            </option>
            <option value="<?= base_url('C_dompet/riwayat_vcer?pil=' . $dvo . '&pro=3') ?>" <?= $pro == 3 ? "selected" : "" ?>>
              Di BMT
            </option>
            <option value="<?= base_url('C_dompet/riwayat_vcer?pil=' . $dvo . '&pro=4') ?>" <?= $pro == 4 ? "selected" : "" ?>>
              Di KEU
            </option>

          </select>
        </div>
      </form>
    </div>

    <!-- REVIEW  -->
    <div class="panel panel-primary">
      <!-- Default panel contents -->
      <div class="panel-heading" align="center">
        <h3>Pencairan Dompet E-Retail - DOMPET</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
              <tr bgcolor="#d9d9dd">
                <th>No</th>
                <th>Nama</th>
                <th>NIK/ NBM</th>
                <th>Unit Kerja</th>
                <th>Redeem</th>
                <?php
                if ($pro <= 2) {
                  echo "<th>Redeem Akhir</th>";
                  echo "<th>Tanggal ke BMT</th>";
                  echo "<th>Tanggal</th>";
                } else {
                  echo "<th>Redeem Akhir</th>";
                  echo "<th>Tanggal ke BMT</th>";
                  echo "<th>Tanggal</th>";
                  echo "<th>Tanggal Acc BMT</th>";
                  echo "<th>Tanggal Redeem Keu</th>";
                  echo "<th>Tanggal Redeem Acc Keu</th>";
                }
                ?>

                <th>Ket</th>



              </tr>
            </thead>
            <tbody>
              <?php
              $all = $this->Mbmt->get_tbl_redeem_all($pro);

              if ($all->num_rows() > 0) {
                $no = 1;
                foreach ($all->result() as $q) {
                  $g_id2 = $this->Muser->get_id_user_tblpesanvoc($q->idlog); ///get masing masing id user
                  if ($g_id2->num_rows() > 0) {
                    $nbm = $g_id2->row()->nik;
                    $unit = $g_id2->row()->unit;
                  } else {
                    $nbm = $q->nbm;
                    $unit = '';
                  }
              ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $q->nama ?></td>
                    <td><?= $nbm ?></td>
                    <td><?= $unit ?></td>
                    <td><?= $q->redeem ?></td>

                    <?php
                    if ($pro <= 2) {
                      echo "<td>$q->redeem_akhir</td>";
                      echo "<td>$q->tgl_kebmt</td>";
                      echo "<td>$q->tgl_trans</td>";
                    } else {
                      echo "<td>$q->redeem_akhir</td>";
                      echo "<td>$q->tgl_kebmt</td>";
                      echo "<td>$q->tgl_trans</td>";
                      echo "<td>$q->tgl_oto</td>";
                      echo "<td>$q->tgl_redeem_keu</td>";
                      echo "<td>$q->tgl_redeem_keu_acc</td>";
                    }

                    ?>
                    <td><?= $q->alasan_tolak ?></td>
                  </tr>

              <?php
                } //loop
              } //if numrows
              ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
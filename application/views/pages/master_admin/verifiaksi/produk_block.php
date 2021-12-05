<div class="box box-info">

  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
          <tr bgcolor="#d9d9dd">
            <th>No</th>
            <th>gambar</th>
            <th>Nama Produk</th>

            <th>Penjual</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Tanggal Input</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get_all_id_produk = $this->Madmin_master->get_all_produk_block();
          if ($get_all_id_produk->num_rows() > 0) {
            $no = 1;
            foreach ($get_all_id_produk->result() as $gidp) {

              /////////
              //GET TBL USER
              $getuser = $this->Madmin_master->get_user_produk($gidp->id_user);
              //GET TBL KATEGORI
              $getkat = $this->Madmin_master->get_kategori_produk($gidp->id_k);
              ////
              if ($getuser->num_rows() > 0) {
                $user = $getuser->row()->nama;
              } else {
                $user = '';
              }
              ////
              if ($getkat->num_rows() > 0) {
                $kateg = $getkat->row()->kategori;
              } else {
                $kateg = '';
              }

          ?>
              <tr>
                <td><?= $no++ ?></td>
                <td>
                  <?php
                  // $string = read_file('./upload/barang/'.$gidp->gambar);
                  $string = TRUE;
                  if ($string == FALSE) {
                    $fotoproduk = $this->M_setapp->static_bm() . '/dist/img/E-Retail.jpg';
                  } else {
                    $fotoproduk = $this->M_setapp->static_bm() . '/upload/barang/' . $gidp->gambar;
                  } ?>
                  <p align="center"> <img src="<?= $fotoproduk ?>" class="margin" width="100px" /></p>
                </td>
                <td><?= $gidp->nama ?></td>

                <td><?= $user ?></td>

                <td><?= $gidp->stok ?> <?= $gidp->satuan ?></td>
                <td><?= $gidp->harga ?></td>
                <td><?= $gidp->deskripsi ?></td>
                <td><?= $kateg ?></td>

                <td><?= $gidp->tanggal ?></td>
                <td>
                  <a href="<?= base_url('Master_admin/block_produk/' . $gidp->id . '/1/v') ?>" class="btn btn-success btn-sm">Aktifkan</a>
                  <br />

                  <!---->

                </td>


              </tr>
          <?php  }
          }
          ?>

        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.box-body -->

  <!-- /.box-footer -->
</div>
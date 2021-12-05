<form method="post" id="theform">
  <?php

  // $list=$this->Madmin->get_Produk_dipesan($id_user);
  $list = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart($id_user);
  $tothbar = $this->Mtrans->total_belanja_by_pembeli($id_user);

  ?>
  <div class="col-md-8">
    <h3><span class="label label-default">Ringkasan Belanja</span></h3>
    <table class="table">
      <tr>
        <td>Total Harga Barang</td>
        <td>Rp <?= number_format($tothbar, 2, ',', '.') ?></td>
      </tr>
      <tr>
        <td>Biaya Kirim</td>
        <?php
        $listpenjual = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart_penjual($id_pembeli);
        ?>
        <td>Rp <?= number_format($listpenjual->num_rows() * 0, 2, ',', '.') ?></td>
      </tr>
      <tr>
        <td><b>Total Belanja</b></td>
        <td><b>Rp <?= number_format(0 + $tothbar, 2, ',', '.') ?></b></td>
      </tr>
    </table>
    <hr />
    <h3><span class="label label-default">Rinci Belanja</span> </h3>
    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <td></td>
          <td>Penjual</td>
          <td>Barang</td>
          <td>Kategori</td>
          <td>Qty.</td>
          <td>Harga Satuan</td>
          <td>Sub Total</td>
        </tr>
        <?php
        $subtot = 0;
        $subtot_kali = 1;
        $hal = '-';
        $bar_no = 0;
        $katpar = 0;

        $kat_par = 1;

        if ($list->num_rows() > 0) {

          foreach ($list->result() as $t) {



            /////NUMROWS()
            $numqty = $this->Mtrans->m_numrowsqty($t->id_produk, $id_user);
            /////NUMROWS()
            $qty2pesan = $this->Mtrans->get_produkqty_dipesan($t->id_produk, $id_user); ///qty yang udah di pesan
            $qty2ketranjang = $this->Mtrans->get_produkqty_dikeranjang($t->id_produk, $id_user); ///qty yang udah 

            //


            $barang = $this->Muser->get_produk_by_id($t->id_produk);
            $namapelapak = $this->Muser->get_user_by_id($barang->row()->id_user)->row()->nama;
            ///========================STOK ==QTY
            $qty = $this->Mtrans->get_produkqty($t->id_produk); ///barng yang sudah di beli
            /////hapus bila barang kosong di pesan
            //$stoka=$barang->row()->stok-$qty-$qty2pesan;
            $stokall = $barang->row()->stok - ($qty + $qty2pesan);
            if ($qty2ketranjang > $stokall) {

        ?>
              <div class="alert alert-danger">Maaf . Produk <?= $barang->row()->nama ?> Tedak tersedia .<br /> Mohon Tekan <kbd>F5</kbd></div>
            <?php
              $this->Mtrans->del_id_produk($t->id_produk, $id_pembeli);
              //$hal='no';
              redirect('welcome/beli_produk');
              $hal = $hal . 'ya';
            } else {
              //$hal='ya';
              $hal = $hal . 'no';
            }

            ////20180501
            if ($barang->row()->id_k == 20) { ///jika id 20= parsel maka dikali 1
              $kat_par = $kat_par * 1;
              $katpar = $katpar + 0;    ///nambah
            } else {
              $kat_par = $kat_par * 0;
              $katpar = $katpar + 1;
            }
            $bar_no++;

            ////20180501  

            ?>
            <tr>
              <td>
                <a href="<?= base_url('Welcome/hapus_idtransaksi/' . $t->id) ?>" title="Hapus Produk" onclick="return confirm('Anda Yakin !')">
                  <i class="fa fa-fw fa-close"></i>
                </a>
                <a href="<?= base_url('Welcome/produk_rinci_akhir/' . $t->id_produk) ?>" target="_blank" title="Lihat rinci Produk">
                  <i class="fa fa-fw fa-eye"></i>
                </a>


              </td>
              <td><?= $namapelapak ?></td>
              <td><?= $barang->row()->nama ?>

              </td>
              <td><u><?= $barang->row()->kategori ?></u>
              </td>
              <td align="center"><?= $numqty ?>
                <?php
                ///===========================================================================SELECT STOK
                ?>
                <?php
                ///============================================================NATARA HARGA NPORMAL DAN KHUSUS
                if (empty($barang->row()->hargak)) {
                  $harga = $barang->row()->harga;
                } else {
                  $harga = $barang->row()->hargak;
                }
                /////REV agustu 2017
                ?>

              </td>

              <td align="right">Rp <?= number_format($t->harga_satuan, 2, ',', '.') ?></td>
              <td align="right">Rp <?= number_format($t->qty * $t->harga_satuan, 2, ',', '.') ?></td>
            </tr>
            <?php
            $subtot = $subtot + ($t->qty * $t->harga_satuan);
            $subtot_kali = ($subtot_kali * $t->harga_satuan * $t->qty);
            ?>

        <?php }
        }
        ?>
        <tr>
          <td colspan="6" align="right"><b>Total</b></td>
          <td align="right"><b>Rp <?= number_format($subtot, 2, ',', '.') ?></b></td>
        </tr>

      </table>
    </div>
    <hr />
    <h4><a href="<?= base_url('Welcome/allkategori') ?>"><?= $title2 ?></a></h4>
  </div>
  <div class="col-md-4">
    <div class="table-responsive">
      <h3><span class="label label-default">Rinci Pembeli</span></h3>
      <!--C_pesanproduk-->

      <table class="table">
        <?php
        if ($this->session->userdata('login') == FALSE or $this->session->userdata('wewenang') != 'user') {
          $inama = '';
          $nohp = '';
          $alamt = '';
          $email = '';
          $nik = '';
          $inbm = '';
          $iranting = '';
          $icabang = '';
          $idaerah = '';
        } else {
          $inama = 'value="' . $nama . '" readonly';
          $nohp = ' value="' . $kontak . '" readonly';
          $alamt = $alamat;
          $email = 'value="' . $username . '" readonly';
          $nik = 'value="' . $nik . '" readonly';
          $inbm = 'value="' . $nbm . '" readonly';
          $iranting = 'value="' . $ranting . '" readonly';
          $icabang = 'value="' . $cabang . '" readonly';
          $idaerah = 'value="' . $daerah . '" readonly';
        }
        ?>
        <?php
        $input1 = ['', ''];
        if ($this->session->userdata('login') == FALSE or $this->session->userdata('wewenang') != 'user') {

          $input1[0] = "
            <tr>
          <td>
          <label for=''>Nama Pembeli<small class='text-danger'>(*)</small></label>
          <input name='namapembeli' placeholder='Nama' class='form-control br' required/ ></td>
        </tr>

      <tr>
          
          <td>
          <label>NBM</label>
          <input name='nbm' placeholder='NBM'  class='form-control br'/></td>
        </tr>
            ";

          $input1[1] = "
            <tr>
          <td>
          <label >Ranting</label>
          <input name='ranting'  class='form-control br' placeholder='Ranting' /></td>
        </tr>
        <tr>
          <td>
          <label >Cabang</label>
          <input name='cabang' class='form-control br' placeholder='Cabang' /></td>
        </tr>
        <tr>
          <td>
          <label >Daerah</label>
          <input name='daerah' class='form-control br' placeholder='Daerah'/></td>
        </tr>
            ";
        } else {
        ?>
          <input type="hidden" name="namapembeli" <?= $inama ?> />
          <input type="hidden" name="nbm" <?= $inbm ?> />
          <input type="hidden" name="ranting" <?= $iranting ?> />
          <input type="hidden" name="cabang" <?= $icabang ?> />
          <input type="hidden" name="daerah" <?= $idaerah ?> />
        <?php
        }
        ?>

        <?= $input1[0] ?>

        <tr>
          <td>
            <label for="">Email<small class="text-danger">(*)</small></label>
            <input name="email" <?= $email ?> class="form-control br" placeholder="Email" required />
          </td>
          <small class="text-success">(-) Pastikan Email terdaftar. untuk melakukan notifikasi</small>
        </tr>
        <tr>
          <td>
            <label for="">Telepon/Handphone<small class="text-danger">(*)</small></label>
            <input name="hppembeli" <?= $nohp ?> class="form-control br" placeholder="No. Hp" required />
          </td>
        </tr>

        <?= $input1[1] ?>

        <tr>
          <td>
            <label for="">Alamat Lengkap<small class="text-danger">(*)</small></label>

            <textarea name="alamatpembeli" class="form-control br" cols="5" required><?= $alamt ?></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <small class="text-danger">(*) Wajib diisi.</small>
          </td>
        </tr>
      </table>
      <hr />

      <h3><span class="label label-default">Pembayaran Melalui</span></h3>
      <div class="form-group">
        <div class="panel-group" id="accordion">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">

                <label class="radio-inline icheck dckdesain">
                  <input type="radio" name="metode" id="inlineRadio1" value="TUNAI"> TUNAI (COD)
                </label>

              </h4>
            </div>
          </div>






        </div>
      </div>

    </div>
  </div>

  <?php
  $pos = strpos($hal, "ya");
  if ($list->num_rows() > 0 and $pos == false and $subtot_kali != 0) { ?>
    <input type="submit" id="btnsubmit" value="PROSES PEMESANAN" class="btn btn-success btn-block" onclick="konfirmasibayar('<?= base_url('C_pesanproduk/bayar/' . $id_pembeli) ?>')">
    <a id="btnsubmit" value="BATAL" type="button" class="btn btn-warning btn-block" href="<?= base_url('Welcome/batalpesan/' . $id_pembeli) ?>" onclick="return confirm('Anda yakin?')">BATAL</a>


  <?php } else { ?>
    <input type="submit" value="PROSES PEMESANAN" class="btn btn-danger btn-block" onclick="return confirm('Anda yakin?')" disabled>
    <a type="button" id="btnsubmit" value="BATAL" class="btn btn-warning btn-block" href="<?= base_url('Welcome/batalpesan/' . $id_pembeli) ?>" onclick="return confirm('Anda yakin?')">BATAL</a>
  <?php } ?>

</form>
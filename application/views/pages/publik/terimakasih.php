      <?php

      $getprobembeli = $this->Mtrans->getprofilpembeli($id_pembeli);



      if ($getprobembeli->num_rows() > 0) {

        $nma = $getprobembeli->row()->nama;

        $alamat = $getprobembeli->row()->alamat;

        $email = $getprobembeli->row()->email;

        $hp = $getprobembeli->row()->hp;

        $tglPesan = '';

        $via = '';

        ////KODE

        ////CEK IDTRANSAKSI

        if ($this->session->userdata('login') == TRUE and $this->session->userdata('wewenang') == 'user') {

          $id_user = $this->session->userdata('id_user');

          $list_kd = $this->Mbank->cek_transaksi_user($id_user, $id_tgl);  //tbltransaksi



          if ($list_kd->num_rows() > 0) {

            $kd = $list_kd->row()->kodepembayaran;

            $idtagihan = $list_kd->row()->notagihan;

            //201906

            $tglPesan = $list_kd->row()->tgl_trans;

            $via = $list_kd->row()->metode;
          } else { //cek idtgl dan user

            //kembalikan awal

            $this->session->set_userdata('idtgluntukerror', $id_tgl);

            redirect('C_bugapp/d/' . $id_tgl);
          }
        } else { //cek login

          $list_kd = $this->Mbank->cek_transaksi_pembeli($id_pembeli, $id_tgl);  //tbltransaksi



          if ($list_kd->num_rows() > 0) {

            $kd = $list_kd->row()->kodepembayaran;

            $idtagihan = $list_kd->row()->notagihan;

            //

            $tglPesan = $list_kd->row()->tgl_trans;

            $via = $list_kd->row()->metode;
          } else { //cek idtgl dan user

            //kembalikan awal

            $this->session->set_userdata('idtgluntukerror', $id_tgl);

            redirect('C_bugapp/d/' . $id_tgl);
          }
        }



        ////----------------------------------------------------------------

      ?>

        <!-- Content Header (Page header) -->

        <div class="container">

          <!-- Main content -->

          <section class="invoice">

            <!-- title row -->

            <div class="row">

              <div class="col-xs-12">

                <h2 class="page-header">

                  BUKTI PEMESANAN BARANG [<?= $title1 ?>]

                  </br>

                  PEMBAYARAN VIA <?= $via ?>

                </h2>

              </div>

              <!-- /.col -->

            </div>



            <!-- info row -->

            <div class="row invoice-info">

              <div class="col-sm-4 invoice-col">



                <strong style="font-size: 25px">No. <?= $idtagihan ?></strong><br>

                <address>

                  <strong>Nama :<?= $nma ?></strong><br>

                  Alamat :<?= $alamat ?><br>

                  Phone : <?= $hp ?><br>

                  Email : <?= $email ?>

                  <br>

                  Tanggal Pesan : <?= $tglPesan ?>



                </address>

              </div>



              <!-- /.col -->



            </div>



          <?php

        } ///PALING ATATAS

          ?>

          <!-- /.row -->



          <!-- Table row -->

          <div class="row">

            <div class="col-xs-12 table-responsive">

              <h3><span class="label label-default">Rinci Belanja</span> </h3>



              <table class="table table-bordered">

                <tr>

                  <td>Penjual</td>

                  <td>Barang</td>

                  <td>Qty.</td>

                  <td>Harga Satuan</td>

                  <td>Sub Total</td>

                </tr>

                <?php

                $list = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart_pesan($id_pembeli, $id_tgl);

                //$tothbar=$this->Mtrans->total_belanja_by_pembeli_pesan($id_pembeli);

                $subtot = 0;

                $subtot = 0;

                if ($list->num_rows() > 0) {



                  foreach ($list->result() as $t) {

                    $barang = $this->Muser->get_produk_by_id($t->id_produk);

                    $getDataPenjual = $this->Muser->get_user_by_id($barang->row()->id_user);
                    $namapelapak = $getDataPenjual->row()->nama;

                    ///========================STOK ==QTY

                    /////NUMROWS()

                    //$numqty=$this->Mtrans->m_numrowsqty_pesan($t->id_produk,$id_pembeli,$id_tgl);

                    $numqty = $this->Mtrans->m_numrowsqty_pesan_dahlama($t->id_produk, $id_pembeli, $id_tgl);

                    /////NUMROWS()

                    $qty = $this->Mtrans->get_produkqty($t->id_produk); ///barng yang sudah di beli

                    /////hapus bila barang kosong

                    $qty2pesan = $this->Mtrans->get_produkqty_dipesan($t->id_produk, $id_pembeli);

                    $stoka = $barang->row()->stok - $qty - $qty2pesan;

                    $stokall = $barang->row()->stok - $qty;





                    // echo $qty;

                    //		echo $qty2pesan;

                    $stoka = $barang->row()->stok - $qty - $qty2pesan; ///barng yang sudah di beli dan di pesanolehnya



                ?>

                    <tr>

                      <td><?= $namapelapak ?> (<?= $getDataPenjual->row()->no_kontak ?>)</td>

                      <td><?= $barang->row()->nama ?></td>

                      <td align="center"><?= $t->qty ?>

                        <?php

                        ///===========================================================================SELECT STOK

                        ?>

                        <?php

                        ///======================================= =====================NATARA HARGA NPORMAL DAN KHUSUS

                        if (empty($barang->row()->hargak) or $barang->row()->hargak == 0 or $barang->row()->harga < $barang->row()->hargak) {

                          $harga = $barang->row()->harga;
                        } else {

                          $harga = $barang->row()->hargak;
                        }



                        ?>



                      </td>

                      <td align="right">Rp <?= number_format($t->harga_satuan, 2, ',', '.') ?></td>

                      <td align="right">Rp <?= number_format($t->qty * $t->harga_satuan, 2, ',', '.') ?></td>

                    </tr>

                    <?php

                    $subtot = $subtot + ($t->qty * $t->harga_satuan);

                    ?>



                <?php }
                }

                ?>

                <tr>

                  <td colspan="4" align="right"><b>Total</b></td>

                  <td align="right"><b>Rp <?= number_format($subtot, 2, ',', '.') ?></b></td>

                </tr>



              </table>

            </div>

            <!-- /.col -->

          </div>

          <!-- /.row -->



          <div class="row">

            <!-- accepted payments column -->



            <!-- /.col -->

            <div class="col-xs-6">

              <h3><span class="label label-default">Ringkasan Belanja</span></h3>

              <table class="table">

                <tr>

                  <td>Total Harga Barang</td>

                  <td>Rp <?= number_format($subtot, 2, ',', '.') ?></td>

                </tr>

                <tr>

                  <td>Biaya Kirim</td>

                  <?php

                  //$listpenjual = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart_pesan($id_pembeli,$id_tgl);

                  $listpenjual = $this->Mtrans->lihat_keranjang_by_pembeli_tanpa_cart_penjual_id_tgl($id_pembeli, $id_tgl);

                  $nmpenj = $listpenjual->num_rows() * 0;

                  ?>

                  <td>Rp <?= number_format($nmpenj, 2, ',', '.') ?></td>

                </tr>

                <tr>

                  <td><b>Total Belanja</b></td>

                  <td><b>Rp <?= number_format($nmpenj + $subtot, 2, ',', '.') ?></b></td>

                </tr>

              </table>

            </div>

          </div>

          <!-- /.col -->



          <!-- /.row -->

          <hr />
          <hr />

          <!-- this row will not appear when printing -->

          <div class="row no-print">

            <div class="col-xs-12">

              <a href="<?= base_url('C_cetak/cetak_pesan_barang/html/' . $id_pembeli . '/' . $id_tgl) ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>



              <a class="btn btn-primary pull-right" href="<?= base_url('C_cetak/cetak_pesan_barang/pdf/' . $id_pembeli . '/' . $id_tgl) ?>" style="margin-right: 5px;">

                <i class="fa fa-download"></i> PDF

              </a>

            </div>

          </div>

          </section>

          <!-- /.content -->

        </div>

        <?php

        $message = $this->session->flashdata('modses');

        if ($message == 1) {

        ?>

          <!-- Small modal notif -->

          <div class="modal fade bs-example-modal-sm" id="myModaliklan2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

            <div class="modal-dialog modal-sm">

              <div class="alert alert-success alert-dismissible">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="hiden">&times;</button>

                <h4><i class="icon fa fa-check"></i> Sukses</h4>

                Terima kasih sudah berbelanja di E-Retail.<br />



              </div>

            </div>

          </div>

        <?php

        }

        ?>
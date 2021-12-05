<html>
<style type="text/css">
    body {
        margin: 0.1in;
    }

    #kiri {
        width: 20%;
        float: left;
        padding: 10px;
    }

    #kanan {
        width: 100%;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    li,
    blockquote,
    p,
    th,
    td {
        font-family: Helvetica, Arial, Verdana, sans-serif;
        /*Trebuchet MS,*/
    }

    h1,
    h2,
    h3,
    h4 {
        color: #000000;
        font-weight: normal;
    }

    h4,
    h5,
    h6 {
        color: #000000;
    }

    h2 {
        margin: 0 auto auto auto;
        font-size: x-large;
    }

    li,
    blockquote,
    p,
    th,
    td {
        font-size: 80%;
    }

    ul {
        list-style: url(/img/bullet.gif) none;
    }

    #footer {
        border-top: 1px solid #000000;
        text-align: right;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        font-family: "Trebuchet MS", Arial, sans-serif;
        color: black;
    }

    #ss {
        padding: 9px;
        border-top: 1px;
        border-left-style: double;
    }

    td,
    th {
        padding: 4px;
    }

    P.breakhere {
        page-break-after: always
    }
</style>

<body onload="print()">


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
    ?>
        <div id="kanan" class="page-header">
            <br />
            <h3 align="center"><?= $title1 ?></h3>
            <h2 class="page-header">
                BUKTI PEMESANAN BARANG [<?= $title1 ?>]
                </br>
                PEMBAYARAN VIA <?= $via ?>
            </h2>
        </div>
        <hr />

        <tr>
            <th colspan="8" align="left">

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
            <?php }
            ?>

            </th>
        </tr>


        <h3><span class="label label-default">Rinci Belanja</span> </h3>
        <table class="table" width="100%">
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
                    $qty = $this->Mtrans->get_produkqty($t->id_produk); ///barng yang sudah di beli
                    /////hapus bila barang kosong
                    $qty2pesan = $this->Mtrans->get_produkqty_dipesan($t->id_produk, $id_pembeli);
                    $stoka = $barang->row()->stok - $qty - $qty2pesan;
                    $stokall = $barang->row()->stok - $qty;
                    /////NUMROWS()
                    $numqty = $this->Mtrans->m_numrowsqty_pesan_dahlama($t->id_produk, $id_pembeli, $id_tgl);
                    /////NUMROWS()

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
                            ///============================================================NATARA HARGA NPORMAL DAN KHUSUS
                            if (empty($barang->row()->hargak)) {
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
        <h3><span class="label label-default">Ringkasan Belanja</span></h3>
        <table width="50%" id="ss">
            <tr>
                <td>Total Harga Barang</td>
                <td>Rp <?= number_format($subtot, 2, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Biaya Kirim</td>
                <?php
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
        <br />

        <br />

</body>

</html>
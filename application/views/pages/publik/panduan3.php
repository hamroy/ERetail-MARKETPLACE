<style>
  .produk {
    position: relative;
  }

  .image {
    opacity: 1;
    display: block;
    width: 100%;
    height: auto;
    transition: .5s ease;
    backface-visibility: hidden;
  }

  .middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 85%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%)
  }

  .produk:hover .image {
    opacity: 0.3;
  }

  .produk:hover .middle {
    opacity: 1;
  }
</style>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">
    <h2><a href="<?= base_url('Welcome/allkategori') ?>"><?= $title2 ?></a> || <b>PANDUAN TRANSAKSI BAGI PENJUAL</b> </h2>
  </div>
  <div class="panel-body">
    <p class="page-header">
      Assalamu'alaikum warahmatullohi wa barokatuh, Sugeng Rawuh di E-Retail.
    </p>
    <p class="page-header">Berikut adalah Panduan Singkat Melakukan Transaksi di E-Retail bagi PENJUAL:</p>

    <ol class="page-header">
      <li>PENJUAL akan dikirim email notifikasi pemesanan PRODUK dari PEMBELI.</li>
      <li>Secara fisik, PENJUAL dapat memastikan produk yang dipesan dengan melakukan KOMUNIKASI dengan PEMBELI melalui nomor kontak atau alamat email.</li>
      <li>PENJUAL akan melakukan pengemasan PRODUK serta pengiriman PRODUK kepada PEMBELI sesuai dengan kesepakatan.</li>
      <li>Transaksi dinyatakan SELESAI/BATAL atas kesepakatan antara PENJUAL dan PEMBELI.</li>
      <li>Bila transaksi SELESAI, PENJUAL masuk kembali ke E-Retail sebagai akun PENJUAL.</li>

      <li>Pada kolom sebelah kanan, pilih menu 'Barang Dipesan'. Muncul halaman 'Produk Dipesan'.</li>
      <li>Pada tabel produk, arahkan ke kolom Action paling kanan, pilih tombol 'Transaksi Selesai', jika TRANSAKSI dinyatakan selesai. Sistem akan mengirim 'BUKTI TRANSAKSI' melalui notifikasi email kepada PEMBELI.</li>

    </ol>

  </div>
</div>
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
    <h2> <a href="<?= base_url('Welcome/allkategori') ?>"><?= $title2 ?></a> || <b>PANDUAN TRANSAKSI BAGI PEMBELI</b> </h2>
  </div>
  <div class="panel-body">
    <p class="page-header">
      Assalamu'alaikum warahmatullohi wa barokatuh, Sugeng Rawuh di E-Retail.
    </p>
    <p class="page-header">Berikut adalah Panduan Singkat Melakukan Transaksi di E-Retail bagi PEMBELI:</p>

    <ol class="page-header">
      <li>Pada halaman beranda, di bawah tulisan 'Kategori', silahkan klik tombol gambar kategori produk yang diinginkan. Misal: Pembeli ingin melihat atau mencari produk 'Beras', klik tombol kategori 'Sembako'.</li>
      <li>Berikutnya muncul halaman dengan judul Kategori yang diinginkan. Klik pada produk yang diinginkan, jika belum ada, mungkin harus melakukan penggeseran halaman ke bawah.</li>
      <li>Klik tombol produk yang diinginkan, untuk memunculkan rincian PRODUK yang akan dibeli.</li>
      <li>Pada halaman rinci Produk, dimunculkan nama, harga normal, harga khusus, ketersediaan dan deskripsi dari PRODUK yang dijual. Juga dimunculkan informasi PENJUAL dari PRODUK yang diinginkan.</li>
      <li>Untuk melakukan PEMBELIAN PRODUK, klik pada pilihan item 'Jumlah Produk yang dibutuhkan:'. Pilih sesuai keinginan Anda.</li>
      <li>Klik 'Tambah ke Daftar Belanja', untuk proses belanja PRODUK.</li>

      <li>PEMBELI akan dimunculkan halaman 'DATA PEMBELIAN' dilengkapi dengan Informasi Ringkasan Belanja, Rinci Belanja, Form untuk Pembeli yang harus diisi, serta Proses Pembayaran.</li>
      <li>Isi Form pada label Rinci Pembeli.</li>

      <li>Pada label Nama Pembeli, isi dengan nama PEMBELI.</li>
      <li>Pada label Email, isi dengan alamat email PEMBELI. Khusus email dengan akhiran umy.ac.id, bukti transaksi dapat digunakan sebagai dokumen SKP.</li>
      <li>Pada label Telepon/Handphone, diisi dengan nomor kontak PEMBELI.</li>
      <li>Pada label Alamat Lengkap, diisi dengan alamat lengkap PEMBELI.</li>
      <li>Pada label 'Pembayaran Melalui', pilih jenis pembayaran yang diinginkan. Saat ini, PEMBELI hanya diijinkan melalui 'TUNAI'</li>
      <li>Klik tombol 'PESAN' untuk melakukan pemesanan produk kepada PENJUAL.</li>
      <li>Klik tombol 'BATAL' untuk melakukan pembatalan pesanan produk.</li>
      <li>Jika Anda sudah yakin melakukan PESAN PRODUK, sistem akan mengirim notifikasi Rinci pemesanan produk melalui email kepada PEMBELI dan PENJUAL.</li>
      <li>Untuk meyakinkan secara fisik, PEMBELI dapat menghubungi langsung nomor kontak PENJUAL bahwa sudah melakukan PEMESANAN PRODUK hingga terjadi TRANSAKSI yang diinginkan.</li>
      <li>Jika TRANSAKSI selesai, PEMBELI akan dikirim melalui email notifikasi BUKTI TRANSAKSI berikut lampirannya (attachment) dalam format PDF.</li>
      <li>Bagi PEMBELI dengan alamat email akhiran umy.ac.id, bukti transaksi dapat digunakan sebagai dokumen SKP.</li>
    </ol>

  </div>
</div>
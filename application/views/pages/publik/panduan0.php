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
    <h2><a href="<?= base_url('Welcome/allkategori') ?>"><?= $title2 ?></a> || <b>PANDUAN REGISTRASI BAGI PENJUAL</b> </h2>
  </div>
  <div class="panel-body">
    <p class="page-header">
      Assalamu'alaikum warahmatullohi wa barokatuh, Sugeng Rawuh di E-Retail.
    </p>
    <p class="page-header">Berikut adalah Panduan Singkat Melakukan REGISTRASI bagi PENJUAL:</p>

    <ol class="page-header">
      <li>Pada halaman beranda, klik tombol 'DAFTAR' di sebelah kanan atas.</li>
      <li>Berikutnya muncul form registrasi bagi CALON PENJUAL. Mohon diisi sesuai dengan data yang diminta. Isian dengan tanda bintang, (*), mengharuskan CALON PEMBELI untuk mengisi. Form registrasi yang tidak lengkap tidak akan diproses oleh sistem.</li>
      <li>Klik tombol SIMPAN di bawah, bila CALON PENJUAL sudah yakin dengan isian data yang diberikan.</li>
      <li>Sistem akan mengirimkan email notifikasi kepada CALON PENJUAL dan ADMIN E-Retail.</li>
      <li>CALON PENJUAL akan menerima email notifikasi bahwa sudah mendaftar sebagai PENJUAL dan diberikan waktu kurang dari 1x24 jam untuk menunggu verifikasi dari ADMIN E-Retail.</li>
      <li>Admin akan menerima email notifikasi dari CALON PENJUAL untuk melakukan verifikasi</li>
      <li>Jika lolos verifikasi, sistem akan mengirim email notifikasi kepada CALON PENJUAL bahwa CALON PENJUAL sudah dinyatakan sebagai PENJUAL di E-Retail.</li>
      <li>Jika gagal verifikasi, sistem akan mengirim email notifikasi kepada CALON PENJUAL bahwa CALON PENJUAL belum dapat dinyatakan sebagai PENJUAL di E-Retail dengan alasan yang diberikan oleh ADMIN E-Retail.</li>
    </ol>

  </div>
</div>
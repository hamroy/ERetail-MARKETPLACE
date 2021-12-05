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
    <h2><a href="<?= base_url('Welcome/allkategori') ?>"><?= $title2 ?></a> || <b>PANDUAN MENGUNGGAH PRODUK BAGI PENJUAL</b> </h2>
  </div>
  <div class="panel-body">
    <p class="page-header">
      Assalamu'alaikum warahmatullohi wa barokatuh, Sugeng Rawuh di E-Retail.
    </p>
    <p class="page-header">Berikut adalah Panduan Singkat Melakukan Unggah (Upload) Produk bagi PENJUAL:</p>

    <ol class="page-header">
      <li>Pada halaman beranda, klik tombol 'LOGIN' di sebelah kanan atas.</li>
      <li>Berikutnya muncul form login bagi PENJUAL. Masukkan email serta password yang sesuai saat melakukan REGISTRASI.</li>
      <li>Klik tombol SIGN IN (biru) untuk masuk ke beranda PENJUAL.</li>
      <li>Pada halaman beranda PENJUAL, sudah dimunculkan halaman PRODUK.</li>
      <li>Untuk menambahkan PRODUK yang akan dijual, klik '+ Tambah Produk'.</li>
      <li>Pada halaman Tambah Produk, PENJUAL disajikan Form Isian Nama dan Rinci Barang yang dijual di E-Retail.</li>
      <li>Pada item Kategori, Pilih jenis KATEGORI Produk yang akan dijual. Contoh: Produk 'Beras' berkategori 'Sembako'.</li>
      <li>Pada item Nama, isi nama produk. Wajib diisi. Contoh: 'Beras C4 Super'</li>
      <li>Pada item Gambar, klik 'Browse' untuk memilih gambar sesuai produk yang akan diunggah. Wajib diisi. Produk yang tidak dilengkapi gambar TIDAK AKAN ditampilkan di BERANDA E-Retail.</li>
      <li>Pada item Stok, isi stok/ketersediaan produk yang akan dijual. Wajib diisi.</li>
      <li>Pada item Satuan, di samping item Stok, isi dengan satuan produk yang akan dijual. Contoh: 'Beras C4 Super 5kg', satuannya 'paket'.</li>
      <li>Pada item Harga Satuan Normal, diisi harga normal produk tanpa titik. Contoh: Harga Normal Produk Rp 10.000, cukup ditulis '10000'. Wajib diisi.</li>
      <li>Pada item Harga Satuan Khusus, diisi harga khusus produk tanpa titik jika ada.</li>
      <li>Pada item deskripsi, diisi keterangan lengkap dari produk yang akan dijual.</li>
      <li>Klik 'Simpan', jika PENJUAL sudah yakin dengan isian produk yang akan dijual.</li>
      <li>Sistem tidak akan memproses, jika item yang wajib diisi dibiarkan KOSONG atau TIDAK DIISI.</li>
      <li>Produk yang ditambahkan oleh PENJUAL akan ditampilkan pada halaman PRODUK PENJUAL.</li>
      <li>Produk yang baru ditambahkan oleh PENJUAL, akan diverifikasi oleh ADMIN E-Retail.</li>
      <li>Jika produk lolos verifikasi, maka akan ditampilkan di beranda E-Retail.</li>
      <li>Jika produk gagal verifikasi, maka TIDAK akan ditampilkan di beranda E-Retail.</li>
      <li>Informasi status produk, LOLOS/GAGAL VERIFIKASI akan dikirim melalui notifikasi email PENJUAL.</li>
      <li>Bila Persedian Produk habis, atau informasi produk kurang sesuai, PENJUAL diijinkan untuk melakukan EDIT PRODUK dengan klik tombol 'Edit' di kolom paling kanan.</li>
      <li>Bila produk sudah tidak ingin ditampilkan di beranda E-Retail, PENJUAL dapat melakukan HAPUS PRODUK dengan klik tombol 'Hapus' di kolom paling kanan.</li>
    </ol>

  </div>
</div>
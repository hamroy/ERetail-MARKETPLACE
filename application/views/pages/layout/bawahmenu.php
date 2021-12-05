<nav class="navbar navbar-default" style="padding: 10px">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->

    <!-- Collect the nav links, forms, and other content for toggling -->
    <ul class="nav navbar-nav">


      <li class="dropdown" style="margin-right: 10px">
        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Panduan Penggunaan Kedai (penjual dan pembeli)<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="<?= base_url('panduan') ?>">Registrasi Bagi Penjual</a></li>
          <li><a href="<?= base_url('panduan/a') ?>">Mengunggah Produk Bagi Penjual</a></li>
          <li><a href="<?= base_url('panduan/b') ?>">Transaksi Bagi Pembeli</a></li>
          <li><a href="<?= base_url('panduan/c') ?>">Transaksi Bagi Penjual</a></li>
        </ul>
      </li>

    </ul>
    <ul class="nav navbar-nav pull-right">
      <form class="navbar-form navbar-left" action="<?= base_url('welcome/cari_produk/') ?>" method="post" role="search">
        <div class="input-group">
          <input type="search" class="form-control" title="cari produk . . . " required name="cari" id="navbar-search-input" placeholder="Cari Produk . . .">
          <span class="input-group-btn">
            <button class="btn btn-success" type="submit"> <span class="glyphicon glyphicon-search"></span></button>
          </span>
        </div><!-- /input-group -->
      </form>

    </ul>


  </div><!-- /.navbar-collapse -->
</nav>
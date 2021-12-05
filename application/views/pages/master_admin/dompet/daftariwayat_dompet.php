<?php

if ($dvo == 'Dompet') {
  $isi = 'pages/master_admin/dompet/list/riwayatDompet';
  $selpil1 = '';
  $selpil2 = 'class="active"';
} else {
  $selpil1 = 'class="active"';
  $selpil2 = '';
  $isi = 'pages/master_admin/dompet/list/riwayatRedeem';
}
?>


<section class="content-header well" style="background: #ecedee;">
  <h1>
    <b>PENCAIRAN DOMPET E-Retail</b>
    <small></small>
  </h1>

</section>

<!-- Main content -->
<section class="content">
  <?php
  $message = $this->session->flashdata('pesan');
  echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
  ?>
  <?php
  $message0 = $this->session->flashdata('pesan0');
  echo $message0 == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message0 . '</p></div>';
  ?>
  <!--NAV-->


  <!--ISI per kategori-->

  <div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs h3" role="tablist">
      <li <?= $selpil1 ?>>
        <a href="?pil=Redeem">
          Redeem
        </a>
      </li>
      <li <?= $selpil2 ?>>
        <a href="?pil=Dompet">
          Transaksi Dompet
        </a>
      </li>
    </ul>

  </div>

  <hr />


  <div class="row">

    <?php
    $this->load->view($isi);
    ?>

  </div>

</section>
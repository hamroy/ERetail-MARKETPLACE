<?php
$gt[]=empty($_GET['date'])?'':$_GET['date'];
$gt[]=empty($_GET['bd'])?'':$_GET['bd'];


$gt[]=$this->M_time->pecah_tgl($gt[0]);
$dskip['tgla']=$gt[2];

?>
<div class="well">
  <form class="form-inline">
  <div class="form-group">
    <label for="exampleInputName2">Tanggal</label>
    <input type="date" name="date" value="<?=$gt[0]?>" class="form-control">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">Berdasarkan</label>
    <select class="form-control" name="bd">
    <option value="1" <?=$gt[1]==1?'selected':''?> >No. Tagihan</option>
    <option value="2" <?=$gt[1]==2?'selected':''?>>Produk</option>
    <option value="3" <?=$gt[1]==3?'selected':''?>>Pembeli</option>
    </select>
  </div>
  <button type="submit" class="btn btn-success">Proses</button>
</form>

</div>

<?php

switch ($gt[1]) {
  case 1:
    $this->load->view('pages/admin/viewer/produkDipesan/PDipesan/pDipesanTagihan',$dskip);
    break;
  case 2:
    $this->load->view('pages/admin/viewer/produkDipesan/PDipesan/pDipesanProduk',$dskip);
    break;
  case 3:
    $this->load->view('pages/admin/viewer/produkDipesan/PDipesan/pDipesanPembeli',$dskip);
    break;
  
  default:
    
    break;
}
  
?>

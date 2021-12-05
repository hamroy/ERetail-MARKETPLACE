
<?php
$url4=$this->uri->segment('3');
$st=1;
$stg='dipesan';
if (!empty($_GET['st'])) {
  # code...
  $st=$_GET['st'];
}
if ($st==2) {
  # code...
  $stg='diproses';
}

//201906
$gt[]=empty($_GET['date'])?'':$_GET['date'];
$gt[]=empty($_GET['bd'])?'':$_GET['bd'];


$gt[]=$this->M_time->pecah_tgl($gt[0]);


$bwd=[
  'st'=>$st,
  'stg'=>$stg,
  'tgla'=>$gt[2],
  'bd'=>$gt[1],
];

?>
<div class="box box-info">
<div class="well"><h4>Pembayaran melalui "<b>VIA <?=$get_d?></b> " Status <?=$stg?></h4>
<dir class="row">
<div class="col-xs-12">
<form class="form-horizontal" role="form">

  <div class="input-group">
  <span class="input-group-addon" id="basic-addon1">STATUS</span>
  <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
  
       <option value="<?=base_url('Master_admin/produkdipesan_all/'.$url4.'?st=1')?>"  <?php if($st==1){ echo 'selected';}?> >DIPESAN</option>
       <option value="<?=base_url('Master_admin/produkdipesan_all/'.$url4.'?st=2')?>"  <?php if($st==2){ echo 'selected';}?>  >DIPROSES</option>
 
  </select>
  </div>
</form>
<hr/>
</div>
<div class="col-xs-6">
<form class="form-horizontal" role="form" method="GET" action="?st=2">
  <input type="hidden" name="st" value="<?=$st?>">
  <div class="input-group">
  <span class="input-group-addon" id="basic-addon1">TANGGAL</span>
  <input type="date" class="form-control" name="date" value="<?=$gt[0]?>">
  </div>

  <div class="input-group">
  <span class="input-group-addon" id="basic-addon1">BERDASARKAN</span>
  <select name="bd" class="form-control">
  
       <option value="1"  <?php if($gt[1]==1){ echo 'selected';}?>>Transaksi</option>
       <option value="2"  <?php if($gt[1]==2){ echo 'selected';}?>>Produk</option>
       <option value="3"  <?php if($gt[1]==3){ echo 'selected';}?>>Pembeli</option>\
 
  </select>

  </div>
  
  <input type="submit" class="form-control btn btn-warning" value="Proses">

  

  </form>
  </div>
</div>

<!-- VIEW -->
<?php 

if ($gt[1]==2) {
  $this->load->view('pages/master_admin/produk/ProdukDpesan/dipesan_all_bdProduk',$bwd);
}elseif ($gt[1]==3) {
  $this->load->view('pages/master_admin/produk/ProdukDpesan/dipesan_all_bdProduk',$bwd);
}
else{
  $this->load->view('pages/master_admin/produk/ProdukDpesan/dipesan_all_bdTaghan',$bwd);
}

?>

<!-- VIEW -->
            
</div>

<script type="text/javascript">
   function submitForm(action)
   {
      confirm('Anda Yakin');
      document.getElementById('form1').action = action;
      document.getElementById('form1').submit();
   }
</script>
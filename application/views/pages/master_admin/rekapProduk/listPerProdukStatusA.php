<h3>

  <a href="<?=base_url('C_rekapProduk?per=2')?>">Kembali</a> || <?=empty($_GET['nkat'])?'':'Status '.$_GET['nkat']?>
</h3>
<div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Penjual</th>
                    <th>Total</th>
                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  $gtog=$this->M_rekapProduk->get_perStatusAkun($id_k);
                  $totalpAkun=0;
                  $no=0;
                  $to=0;
                  if($gtog->num_rows() > 0){
                  foreach($gtog->result() as $gidp0){ 


                  ?>

                    <tr>

                    <td><?=++$no?></td>

                    <td>
                     <a href="#">
                     <?=$gidp0->nama?>
                     </a>
                    </td>
                    
                    <td>
                     <?=$gidp0->sqty?>
                    </td>

                  </tr>
                  
                  <?php 
                  $to=$to+$gidp0->sqty;
                      }
                      }

                       $d_cetak=[

                        'thn'=>$gthn,
                        'bln'=>$nmbln,
                        'tgl'=>$gtgl,
                        'per'=>$per,
                        'id_k'=>$id_k,

                      ];

                  ?>


                </tbody>

                <div class="well" style="font-family: number">
                  <h4>
                    TOTAL : <?=$no?> Penjual  <?=$to?> Qty
                     <span class="pull-right">
                      <a target="_blank" href="<?=base_url('C_cetak/cetak_rekapProduk_admin/?thn='.$d_cetak['thn'].'&bln='.$d_cetak['bln'].'&tgl='.$d_cetak['tgl'].'&per='.$d_cetak['per'].'&id_k='.$d_cetak['id_k'].'&nkat='.$_GET['nkat'])?>" class="btn btn-default">CETAK</a>
                      <a target="_blank" href="<?=base_url('C_cetak/cetak_rekapProduk_admin/xls?thn='.$d_cetak['thn'].'&bln='.$d_cetak['bln'].'&tgl='.$d_cetak['tgl'].'&per='.$d_cetak['per'].'&id_k='.$d_cetak['id_k'].'&nkat='.$_GET['nkat'])?>" class="btn btn-warning">CETAK XLS</a>
                    </span>
                  </h4>
                
                </div>

                </table>
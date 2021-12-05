<div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Total</th>
                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  $gtog=$this->Muser->get_kategori();
                  $totalpAkun=0;
                  $no=0;
                  $to=0;
                  if($gtog->num_rows() > 0){

                  
                  

                  foreach($gtog->result() as $gidp0){ 


                  ?>

                    <tr>

                    <td><?=++$no?></td>

                    <td>
                     <a href="<?=base_url('C_rekapProduk/rinciKat/'.$gidp0->id.'/?nkat='.$gidp0->kategori)?>">
                     <?=$gidp0->kategori?>
                     </a>
                    </td>
                    
                    <td>
                     <?php 

                      $TOT=$this->M_rekapProduk->getTotal_perKategori($gidp0->id);                     

                      echo $TOT;
                      $to+=$TOT;
                     
                     ?> 
                    </td>

                  </tr>
                  
                  <?php 
                  
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
                    TOTAL : <?=$to?> Qty
                    <span class="pull-right">
                      <a target="_blank" href="<?=base_url('C_cetak/cetak_rekapProduk_admin/?thn='.$d_cetak['thn'].'&bln='.$d_cetak['bln'].'&tgl='.$d_cetak['tgl'].'&per='.$d_cetak['per'].'&id_k='.$d_cetak['id_k'])?>" class="btn btn-default">CETAK</a>
                      <a target="_blank" href="<?=base_url('C_cetak/cetak_rekapProduk_admin/xls?thn='.$d_cetak['thn'].'&bln='.$d_cetak['bln'].'&tgl='.$d_cetak['tgl'].'&per='.$d_cetak['per'].'&id_k='.$d_cetak['id_k'])?>" class="btn btn-warning">CETAK XLS</a>
                    </span>
                  </h4>
                
                </div>

                </table>
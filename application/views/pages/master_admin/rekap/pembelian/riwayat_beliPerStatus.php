    <hr />
  <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>

                    <th>Nama Pembeli (NBM)</th>
                    <th>Belanja Tunai</th>
                    <th>Belanja Voucher</th>
                    <th>Belanja Transfer</th>
                    <th>Total Belanja</th>


                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  $get_all_id_produk=$this->M_voucher->get_stjob();

                  $totalpAkun=0;


                  if($get_all_id_produk->num_rows() > 0){

                  $no=$dari;
                  $buy='dibayar';
                  $t='b'; //pembelian

                  foreach($get_all_id_produk->result() as $gidp0){ 

                  $getpendapatanT=$this->M_rekapPenjualan->get_pendapatanStatus($gidp0->id_job,'TUNAI',$buy,$t);
                  $getpendapatanV=$this->M_rekapPenjualan->get_pendapatanStatus($gidp0->id_job,'VOUCHER',$buy,$t);
                  $getpendapatanF=$this->M_rekapPenjualan->get_pendapatanStatus($gidp0->id_job,'TRANSFER',$buy,$t);

                  ?>

                    <tr>

                    <td><?=++$no?></td>

                    <td>
                     <?=$gidp0->nama_job?>
                    </td>
                    <td align="right">
                     <?=$getpendapatanT?> 
                    </td>
                    <td align="right">
                     <?=$getpendapatanV?> 
                    </td>
                    <td align="right">
                     <?=$getpendapatanF?> 
                    </td>
                    <td align="right">
                     <?php $totpAkun=$getpendapatanF+$getpendapatanV+$getpendapatanT;
                      echo number_format($totpAkun,'0',',','.');
                      $totalpAkun=$totalpAkun+$totpAkun;
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
                        'statusP'=>$stnam,
                        'statprodi'=>$stjobnam,

                      ];

                  ?>

                </tbody>

                <div class="well" style="font-family: number">
                  <h4>
                    TOTAL : Rp <?=number_format($totalpAkun,0,',','.')?> 
                    <span class="pull-right">
                      <a target="_blank" href="<?=base_url('C_cetak/cetak_rekapBelanja_admin/?thn='.$d_cetak['thn'].'&bln='.$d_cetak['bln'].'&tgl='.$d_cetak['tgl'].'&sP='.$d_cetak['statusP'].'&prodi='.$d_cetak['statprodi'].'&s=B')?>" class="btn btn-default">CETAK</a>
                      <a target="_blank" href="<?=base_url('C_cetak/cetak_rekapBelanja_admin/xls?thn='.$d_cetak['thn'].'&bln='.$d_cetak['bln'].'&tgl='.$d_cetak['tgl'].'&sP='.$d_cetak['statusP'].'&prodi='.$d_cetak['statprodi'].'&s=B')?>" class="btn btn-warning">CETAK XLS</a>
                    </span>
                  </h4>
                
                </div>

                </table>

              </div>  
<!-- =============================================================================================== -->
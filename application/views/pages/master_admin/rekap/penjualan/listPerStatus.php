<div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>

                    <th>Status</th>
                    <th>Pendapatan Tunai</th>
                    <th>Pendapatan Voucher</th>
                    <th>Pendapatan Transfer</th>
                    <th>Total Pendapatan</th>


                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                   // $get_all_id_produk=$this->M_rekapPenjualan->get_listAkun_rekap();
                  $get_all_id_produk=$this->M_voucher->get_stjob();
                   // echo 'nurows'.$get_all_id_produk->num_rows();
                   $totalpAkun=0;
                  if($get_all_id_produk->num_rows() > 0){

                  $no=0;
                  

                  foreach($get_all_id_produk->result() as $gidp0){ 

                  $getpendapatanT=$this->M_rekapPenjualan->get_pendapatanStatus($gidp0->id_job,'TUNAI');
                  $getpendapatanV=$this->M_rekapPenjualan->get_pendapatanStatus($gidp0->id_job,'VOUCHER');
                  $getpendapatanF=$this->M_rekapPenjualan->get_pendapatanStatus($gidp0->id_job,'TRANSFER');

                  ?>

                    <tr>

                    <td><?=++$no?></td>

                    <td>
                     <?=$gidp0->nama_job?>
                    </td>
                    
                    <td align="right">
                     <?=number_format($getpendapatanT,'0',',','.')?> 
                    </td >
                    <td align="right">
                     <?=number_format($getpendapatanV,'0',',','.')?> 
                    </td>
                    <td align="right">
                     <?=number_format($getpendapatanF,'0',',','.')?> 
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
                      <a target="_blank" href="<?=base_url('C_cetak/cetak_rekapBelanja_admin/?thn='.$d_cetak['thn'].'&bln='.$d_cetak['bln'].'&tgl='.$d_cetak['tgl'].'&sP='.$d_cetak['statusP'].'&prodi='.$d_cetak['statprodi'].'&s=P')?>" class="btn btn-default">CETAK</a>
                      <a target="_blank" href="<?=base_url('C_cetak/cetak_rekapBelanja_admin/xls?thn='.$d_cetak['thn'].'&bln='.$d_cetak['bln'].'&tgl='.$d_cetak['tgl'].'&sP='.$d_cetak['statusP'].'&prodi='.$d_cetak['statprodi'].'&s=P')?>" class="btn btn-warning">CETAK XLS</a>
                    </span>
                  </h4>
                
                </div>

                </table>
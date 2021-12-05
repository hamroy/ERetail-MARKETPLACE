  <div class="col-xs-12">

  <div class="well">
       <form class="form-horizontal" role="form">
        <div class="input-group" style="padding: 5px">
        <label for="inputEmail3" class="control-label">Pilih Status Unit</label>
          <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
          <option value="#0">Pilih Status</option>
          <?php
          $stnam='SEMUA';
          $gt_stjob=$this->M_voucher->get_stjob();
          foreach($gt_stjob->result_array() as $va){
          $sl='';
              if($statusP==$va['id_job']){ 
              $sl='selected';
              $stnam=$va['nama_job'];
              }
              ?>
              <option value="<?=base_url('C_dompet/riwayat_vcer?pil='.$dvo.'&job='.$va['id_job'])?>"  
                <?=$sl?> ><?=$va['nama_job']?>
              </option>

              <?php
              }
              ?>
          </select>
        </div>
      <?php
      if ($statusP==3) {
      ?>
        <div class="input-group" style="padding: 5px">
        <span class="input-group-addon" id="basic-addon1">PRODI</span>
                    <select name="sortprodi" class="form-control"  onchange="loadPage(this.form.elements[1])">

                      <option value="#0">Pilih Prodi</option>

                      <?php
                      
                      $gjob=$this->M_setapp->get_tbl_fak_prodi();

                      foreach($gjob->result() as $jb){
                         $slpro='';
                         if($statprodi==$jb->kode_nim){$slpro='selected';}
                          ?>

                           <option value="<?=base_url('C_dompet/riwayat_vcer?pil='.$dvo.'&job='.$statusP.'&prodi='.$jb->kode_nim)?>" 
                            <?=$slpro?>> <?=$jb->kode_nim?> - <?=$jb->nama_prodi?>  
                           </option>

                          <?php

                      }

                      ?>
                    </select>
                
                
      </div>

      <?php
      }
      ?>


      </form>

  </div>

  <!-- REVIEW  -->
  <div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading" align="center">
    <h3>DAFTAR REDEEM</h3>
  </div>
  <div class="panel-body">
      <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK/ NBM</th>
                    <th>Unit Kerja</th>
                    <th>Redeem</th>
                    <th>Dompet</th>
                  </tr>
                  </thead>
                  <tbody>
    <?php
    $all=$this->Mbmt->get_user_redeem($statusP,$statprodi);
    if($all->num_rows() > 0){
    $no=1;
    $totR=0;
    $totD=0;
    foreach($all->result() as $q){
    $g_id2=$this->Muser->get_id_user_tblpesanvoc($q->idlog); ///get masing masing id user
    if($g_id2->num_rows() > 0){
      $nbm=$g_id2->row()->nik;
      $unit=$g_id2->row()->unit;
    }else{
      $nbm=$q->nbm;
      $unit='';
    }

    ///
    $gP=$this->M_dompetKu->dompetMasukKu($q->idlog);  //pendapatan VOC
    ///


    $totR=$totR+$q->sRedeem;
            ?>
            <tr>
                        <td><?=$no++?></td>
                        <td><?=$q->nama?></td>
                        <td><?=$nbm?></td>
                        <td><?=$unit?></td>
                        <td><?=number_format($q->sRedeem,'0','.',',')?></td>
                        <td><?=number_format($gP['dompet_selesai'],'0','.',',')?> 
                        [ <?=number_format($gP['dompet'],'0','.',',')?> ]</td>
                        
                      </tr>   
            
            <?php
          } //loop
          } //if numrows
                  ?>
                  
               </tbody>
             </table>
          </div>
        </div>
      </div>
    </div>

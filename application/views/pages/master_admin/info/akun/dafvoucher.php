    <!-- Main content -->
     <?php
          /////==========================================================================GET
           	 $g_id=$this->Muser->get_id_pass_nos($id_user);
          /////==========================================================================GET
          
          
          
          

      ?>


    <section class="content">
      <div class="row">
      
      <?php

    $jvoc=$this->db->get('tbl_jenis_voc');
    	
     foreach ($jvoc->result_array() as $key) {
      if($g_id->row()->job==3){
      if($key['id_jen_voc']!=3){
          continue;
          }
      }else{
          if($key['id_jen_voc']==3){
          continue;
          }
      }
      
      ////////////////
      $gvall=$this->M_gvocall->gvall($key['id_jen_voc'],$id_user);
      ///////////////
      
      $trinci=isset($gvall['t_rinci'])==NULL?'':$gvall['t_rinci'];
       
       ?>
      <div class="col-md-3">
         
          <div class="box box-primary">

            <div class="box-body box-profile" align="center">
              <h3 class="text-center">VOUCHER <?=$key['nama_jvoc']?></h3>
              <h4><?=number_format($gvall['saldo'],0,',','.')?></h4>
              <a class="btn" href="<?=base_url($trinci)?>">RINCI</a><br>
              <a href="<?=base_url('C_dompet_2/riwayat_vocAll?iduser='.$id_user)?>">RIWAYAT</a>
            </div>
          </div>

        </div>
     
       <?php
     }
        
     ?>
    
       
        

      </div>


    </section>	

    


            <div class="box-header with-border">
             

              <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                <?php
                $get=$this->Madmin_master->get_onoffvoc($id_user);    
                $status_v1='Aktif';
                $status_v2=' Aktif';
                $status_v3=' Aktif';
                $link_v1='Non Aktivkan';
                $link_v2='Non Aktivkan';
                $link_v3='Non Aktivkan';
                $ak_v1='1';
                $ak_v2='1';
                $ak_v3='1';
                $kolom_='';
                if($get->num_rows() > 0){
                    if($get->row()->vc1 == '1'){
                      $status_v1='Non Aktif';  
                      $link_v1='Aktifkan';  
                      $ak_v1='0';  
                    }
                    if($get->row()->vc2 == '1'){
                      $status_v2='Non Aktif';
                      $link_v2='Aktifkan';    
                      $ak_v2='0';    
                     
                    }
                    if($get->row()->vc3 == '1'){
                      $status_v3='Non Aktif';  
                      $link_v3='Aktifkan'; 
                      $ak_v3='0';   
                      
                    }
                     $kolom_=$get->row()->vc2;   
                }
                
                ?>
                
                 
                   <tr bgcolor="#d9d9dd">
                    <th >VOUCHER BONUS / DLL</th>
                    
                    <th><?=$status_v3?></th>
                    <th>
                    <span class="pull-right">
                    <a onclick="return(confirm('anda yakin')) " href="<?=base_url('C_dompet/simpan_Set_voc/'.$id_user.'/3/'.$ak_v3)?>"><?=$link_v3?></a>
                    </span>
                    </th>
                    
                  </tr>
                  
<form name="form1" method="post" action="<?=base_url('C_dompet/simpan_Set_voc/'.$id_user.'/2/1')?>">

                  <tr bgcolor="#d9d9dd">
                    <th>VOUCHER REGULER</th>
                    <th></th>
                    <th><!--<button class="btn btn-primary btn-ex" data-toggle="modal" data-target="#myModaltblsfe">
  Tambah
</button>-->

</th>
                    
                  </tr>
                  
                   <?php
                  $no=1;
                  $get_juduledisi=$this->Madmin_master->get_judul_edisi($no)->row();
                  ?>
                  <tr >
                  
                    <td>Ed. 1 <?=$get_juduledisi->ket?></td>
                    <th colspan="2"><?=$status_v1?> 
                    <span class="pull-right">
                    <a  onclick="return(confirm('anda yakin')) " href="<?=base_url('C_dompet/simpan_Set_voc/'.$id_user.'/1/'.$ak_v1)?>"><?=$link_v1?></a>
                    </span>
                    </th>
                    
                 
                </tr>
               
                
                <?php
                $gt_tblinputpesanvoucher_select_tahap=$this->Login_model->get_daftar_input_voucher_st_all();
            	$th=$gt_tblinputpesanvoucher_select_tahap;
            	$y=1;
            	for($x=2;$x <= $th;$x++){
                    $jded=$this->Madmin_master->get_judul_edisi($x);
                    if($jded->num_rows() > 0){
                        
                    
                    $get_juduledisi=$jded->row()->ket;
                    
                    }else{
                    $get_juduledisi='BELUM RILIS';    
                    }
                ?>
                 <tr>
                  
                    <td>Ed. <?=$x?> <?=$get_juduledisi?></td>
                    
                    <th colspan="2"> 
                    <?php
                     if( !empty($kolom_) and $get->num_rows() > 0 ){
                       
                    $pec=explode('-',$get->row()->vc2); ///masukkan ke array 
                    echo ''.$pec[$y];
                   if($pec[$y]==NULL){
                    $this->M_voucher->add_oto_set_voc_perid_user($get->row()->vc2,$id_user);
                   redirect ('C_dompet/sett_voc/'.$id_user);     
                    }
                   
                    if($pec[$y++]==$x){ ///sedang non aktif
                        ?>
                        Non Aktif
                        <span class="pull-right">
                        
                          <a><input  name="ed_<?=$x?>" id="msg" value="<?=$x?>" type="checkbox" checked=""/> Aktif </a>
                        </span>
                        <?php
                        
                        }else{ ///sedang aktif
                            ?>
                         Aktif
                         <span class="pull-right">
                         
                        <a > <input  name="ed_<?=$x?>" id="msg" value="<?=$x?>" type="checkbox"/> Non Aktif</a>
                        </span>
                             
                            <?php
                        }
                       
                        }else{ ///sedang aktif
                            
                         ?> 
                         Aktif
                         <span class="pull-right">
           
                          <a ><input  name="ed_<?=$x?>" id="msg" value="<?=$x?>" type="checkbox" /> Non Aktif</a>
                        </span> 
                          <?php
                        }
                    
                    ?>
                   </th>
                 
                </tr>
                <?php    
                    
                }    
                
                ?>
                <tr>
                    <td colspan="3" align="right">
<input onclick="checkAll(this)" type="checkbox" /> Pilih semua edisi
<input type="submit" class="btn btn-success btn-ex" value=" Simpan" onclick="return confirm('Anda YAkin !!')" />
   <p class="text-info">(*) Pilih Semua untuk di Non Aktifkan</p>                 </td>
                </tr>
                </form>  
                 
                  
                  
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
	
		<div class="modal fade" id="myModaltblsfe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">TAMBAH EDISI</h4>
      </div>
      <div class="modal-body">
      <form role="form" action="<?=base_url('C_dompet/terima_pesan_voc/b/')?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Tambah Edisi :</label>
    <input  class="form-control" name="ed" type="number" min="0" />
  </div>
  <button type="submit" class="btn btn-primary btn-block">Simpan</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
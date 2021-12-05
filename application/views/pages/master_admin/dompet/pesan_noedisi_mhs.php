<script src="<?=$this->M_setapp->static_bm()?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
            <div class="box-header with-border">
             

              <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              <div class="table-responsive">
              
               <div class="well">
                  <form class="form-horizontal" role="form">
                    <label for="inputEmail3" class="control-label">Pilih Prodi</label>
                  
                     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
                      <option value="<?=base_url('C_dompet/dafatar_pemesan_voucher/3')?>?vo=4&&prodi=all">SEMUA PRODI</option>
                         <?php
                         
                        $nmaprodi='Semua Prodi';
                        $kd_prodi='all';
                        
                        if(isset($_GET['prodi'])){
                        $kd_prodi=$_GET['prodi'];
                        }

                        $gjob=$this->M_setapp->get_tbl_fak_prodi();

                        foreach($gjob->result() as $jb){
                        if($kd_prodi==$jb->kode_nim){
                               $slct="selected";
                               $nmaprodi=$jb->nama_prodi;
                           }else{
                               $slct="";
                               
                           }  
                        ?>
                        
                         <option value="<?=base_url('C_dompet/dafatar_pemesan_voucher/3')?>?vo=4&&prodi=<?=$jb->kode_nim?>" <?=$slct?>><?=$jb->nama_prodi?> </option>
                        
                        
                        <?php
                        }
                        ?>
                     
                    </select>
                  
                  </form>
               </div>
              <?php
              //echo $id_job;
              if($kd_prodi==$kd_prodi){
              ?>
              <div class="well">
                  <a href="<?=base_url('C_cetak/cetak_pes_vou/xls/'.$id_job.'/'.$kd_prodi.'/?nprodi='.$nmaprodi)?>" class="btn btn-warning">Download Excel</a>
                  
                  <a href="<?=base_url('C_upxls/proses1_exs?vo=4&prodi='.$nmaprodi)?>" class="btn btn-success">Setujui Semua</a>
                  <a href="<?=base_url('C_upxls/daftar_mhs?vo=4&prodi='.$nmaprodi)?>" class="btn btn-default">Daftar Mahasiswa</a>
                  <span class="pull-right">
    
                  <a href="<?=base_url('C_upxls/hpusData')?>" class="btn btn-danger">
                  <span class="glyphicon glyphicon-trash"></span> Hapus Data</a>
                  <a target="_blank" href="<?=base_url('C_upxls/?nprodi=')?>" class="btn btn-warning">
                  <span class="glyphicon glyphicon-cloud-upload"></span> Upload Excel</a>
                      
                  </span>
              </div>
              <?php    
              }
              ?>
              
              
              <h3>Prodi '<?=$nmaprodi?>'</h3>
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama</th>
                    <th width="20%">NIM</th>
                    
                    <th width="20%">Prodi</th>
                    
                    <th>Tanggal Daftar</th>
                    <th>Saldo</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <?php 
                 // $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  if($kd_prodi!='all'){
                    $all_newvoucer2=$this->M_vparsel->get_Pesan_voucher_mhs_prodi(3,$id_voc_mhs,0,$kd_prodi);     // MAHASISWA UNIT MHSISWA SAJA  
                  }
                  
                  $get_all_id_produk=$all_newvoucer2;
                  //echo $_GET['vo'];
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				
				$getnama=$this->Muser->get_id_pass_nos($gidp->id_user);
				if($getnama->num_rows() > 0){
					$getnama0=$getnama->row()->nama;
				}else{
					$getnama0='nama kosong';
				}
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><a ><?=$getnama0?></a></td>
                   
                    <td><?=$gidp->nik?></td>
                    <td><?=$gidp->unit?></td>
                    
                    <td><?=$gidp->tanggal_p?> <?=$gidp->waktu?></td>
                    <td>
                    <?php
                    $get_pes_xls=$this->M_vparsel->get_Pesan_voc_xls($gidp->id,$gidp->id_user,3);
                    $i_saldo=0;
                    if($get_pes_xls->num_rows() > 0){
                        $i_saldo=$get_pes_xls->row()->saldo;
                    }
                    
                    ?>
                    <?=$i_saldo?>
                    </td>
                 
                    <td>
                    
                    	
                    
                    <a class="btn btn-success btn-sm kla" data-toggle="modal" data-target="#myModaltblsfeok<?=$gidp->id?>"> <i class="fa fa-clear"></i>Terima
                    </a>
                                        	
                    <a class="btn btn-danger btn-sm kla" data-toggle="modal" data-target="#myModaltblsfe<?=$gidp->id?>"> <i class="fa fa-edita"></i>Tolak
                    </a>
   
                    <!-- Modal -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <div class="modal fade" id="myModaltblsfeok<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">TERIMA VOUCHER</h4>
      </div>
      <form id="csform<?=$gidp->id?>" role="form" action="<?=base_url($actform.'t/'.$gidp->id_user.'/'.$gidp->id.'/'.$id_job.'/'.$dvo)?>" method="post">
      <div class="modal-body">
      
 
  <div class="form-group">
    <label for="exampleInputEmail1">Saldo :</label>
    <input class="form-control" type="number" min="0" placeholder="Saldo" value="<?=$i_saldo?>" name="saldo" required />
  </div>
 
  

      </div>
      <div class="modal-footer">
          <input id="klikbtn<?=$gidp->id?>" value="Kirim" type="submit" class="btn btn-success btn-block" />
        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>            
                    <!-- Modal -->
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <div class="modal fade" id="myModaltblsfe<?=$gidp->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">PENOLAKAN</h4>
      </div>
       <form role="form" action="<?=base_url($actform2.'b/'.$gidp->id_user.'/'.$gidp->id.'/'.$id_job.'/'.$dvo)?>"  method="post" id="csform_<?=$gidp->id?>">
      <div class="modal-body">
     
  <div class="form-group">
    <label for="exampleInputEmail1">Karena :</label>
    <textarea class="form-control resizable"  name="alasan"rows="3"></textarea>
    <small class="text-danger">- Tidak boleh kosong</small>
    <input type="hidden" name="saldo" value="<?=$i_saldo?>" />
  </div>
 


      </div>
      <div class="modal-footer">
       <input id="klikbtn2_<?=$gidp->id?>" value="Kirim" type="submit" class="btn btn-success btn-block" />
        <button type="button" class="btn btn-default btn-block" data-dismiss="modal">Close</button>
      </div>
     </form>
    </div>
  </div>
</div>
                            
            <script type="text/javascript" charset="utf-8">
           
            $(function()
            {
              $('#klikbtn<?=$gidp->id?>').on('click',function()
              {
                $(this).val('Sedang diproses ...')
                  .attr('disabled','disabled');
                $('#csform<?=$gidp->id?>').submit();
                alert('Klik ok');
              });
              
            });
            
            $(function()
            {
              $('#klikbtn2_<?=$gidp->id?>').on('click',
              
             
              
              function()
              {
                $(this).val('Sedang diproses ...').attr('disabled','disabled');
                $('#csform_<?=$gidp->id?>').submit();
                
                alert('Klik OK');
                
              }); //*/
              
            });
            
            
            
            </script>        
                    
                    </td>
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
	
		
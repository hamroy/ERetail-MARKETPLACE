 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar Penjual</li>
      </ol>
      <br/>
        <h1>
        <?php
        if($ak==1){
			$jd='AKTIF';
			$as='2';
		}else{
			$jd='TIDAK AKTIF';
			$as='1';
		}
//        echo  'asasasasa'.$ak;
        ?>
         <b>DAFTAR PENJUAL / AKUN || <?=$jd?></b>
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
	

<!-- Tab panes -->
<div class="box">
<div class="tab-content">
		<div class="well" align="right">
		
		<form action="<?=base_url('Master_admin/list_penjual/cari/'.$ak)?>" method="post">
    <div class="input-group  col-md-5" >
      <input type="text" name="cari" placeholder="Nama Akun..." class="form-control" list="bawahnama" required>
       <datalist  id="bawahnama">
      <?php  
      $q1 = $this->Madmin_master->get_all_Penjual_all();
      foreach($q1->result() as $qqq){  ?>
      
       
    	<option class="form-control" label='<?=$qqq->nama?>' value="<?=$qqq->nama?>"/>
    
    <?php } ?>
    </datalist>
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
      </span>
    </div><!-- /input-group -->
    </form>
	
        
        </div>
 
				            
              </div>         
  
  <!--rev 230917-->
  
  
            <div class="box-header with-border">
             

              <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>No. NBM</th>
                    <th>No. Telp/ HP</th>
                    <th>Username / password</th>
                    <th>Status Pekerjaan</th>
                    <th>NIK / NIS / NIM</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  //$get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  $get_all_id_produk=$q;
        
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1+$dari;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><a href="<?=base_url('Master_admin/daftar_produk_penjual/'.$gidp->idlog)?>"><?=$gidp->nama?></a></td>
                    <td>
                    <?php
       	          	//$string = read_file($this->M_setapp->static_bm().'/upload/nbm/'.$gidp->file_nbm);
                    ?>
                   
                    <?php 
                //if ($string == TRUE){ 
                    ?>
			<span class="pull-left"><a href="<?=$this->M_setapp->static_bm()?>/upload/nbm/<?=$gidp->file_nbm?>" target="_blank"> <?=$gidp->nbm?></a></span>
		        <?php			
                //}
                 ?>
                    
                    </td>
                    <td><?=$gidp->no_kontak?></td>
                    <td>
                    <?=$gidp->username?> / <?=$gidp->password?></td>
                    <td>
                      <?php
                              //echo $this->M_setapp->get_tbl_st_job_id($gidp->job)->row()->nama_job;
        //echo $this->M_setapp->get_tbl_st_job_id($gidp->job)->num_rows();
                    ?>
                    </td>
                    <td><?=$gidp->ni?></td>
                    <td><?=$gidp->tanggal?></td>
                    <?php
                    if($gidp->status==1){ ///aktif 1
                    	$wr='success';
                    	$tx='active';
                    	$up=2;
                    	$bt='block';
					}else{
						$wr='danger';
                    	$tx='non active';
                    	$bt='active';
                    		
                    	$up=1;
					}
                      ?>
                    <td class="<?=$wr?>">
                    	<?=$tx?>
                    </td>
                    <td>
                    
                    <a class="btn btn-warning btn-sm" style="margin-bottom: 10px" href="<?=base_url('C_dompet/sett_voc/'.$gidp->idlog)?>">Voucher</a><br/>
                    <?php
                    if($gidp->status==1){ 
                    ?>
							<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModaltbl<?=$gidp->idlog?>"> <i class="fa fa-edita"></i>Block
</button>


					<?php
					}else{ 
					?>
					<a class="btn btn-success btn-sm" href="<?=base_url('Master_admin/block_penjual/'.$gidp->idlog.'/'.$up)?>"><?=$bt?></a>
			
					<?php
					}
                    ?>
<!-- Modal -->
<div class="modal fade" id="myModaltbl<?=$gidp->idlog?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">BLOCK PRODUK</h4>
      </div>
      <div class="modal-body">
      <form role="form" action="<?=base_url('Master_admin/block_penjual/'.$gidp->idlog.'/'.$up)?>" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Karena :</label>
    <textarea class="form-control" name="alasan"rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary btn-block">Kirim</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                    
                    
                    </td>
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                                
                  </tbody>
                </table>
                

              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
							<div class="well"> <?php
        echo $halaman; ?> </p><p align="left"><a class="text-lift" href="#">Back to top</a><span class="pull-right">Total <?=$total_rows;?></span></p> </div>
 
				            
              </div>          
            <!-- /.box-footer -->
          </div>
	
		
  
  <!--rev 230917-->
 
</div>
</div>	
	
	
    </section>
    
   
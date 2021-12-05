 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar Penjual</li>
      </ol>
      <br/>
        <h1>
        <?php
        $ak=2;
        if($ak==1){
			$jd='AKTIF';
			$as='2';
		}else{
			$jd='DITOLAK';
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
<form method="post" action="<?=base_url('C_akunproduk/hapuspilihanakun')?>"> 
    <div class="well">
        <input onclick="return confirm('anda yakin!')" class="btn btn-danger" type="submit" value="Hapus Pilihan" />
    </div>
<div class="box">
<div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Akun</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Alamat</th>
                    <th>No. Hp</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Daftar</th>
                    <th>No. NBM</th>
                    <th>action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $get_all_user_tolak=$this->Madmin_master->get_all_usertolak();
                  if($get_all_user_tolak->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_user_tolak->result() as $gidp){ 
				  	
				  ?>	
					<tr >
                    <td>
                    <input name="id_pr[]" value="<?=$gidp->idlog?>" type="checkbox" />
                    <?=$no++?></td>
                    <td><?=$gidp->nama?></td>
                    <td><?=$gidp->username?></td>
                    <td><?=$gidp->password?></td>
                    <td><?=$gidp->alamat?></td>
                    <td><?=$gidp->no_kontak?></td>
                    <td><?=$gidp->jenis_kelamin?></td>
                    <td><?=$gidp->tanggal?></td>
                   <td>
                    <?php
       	  	$string = read_file('./upload/nbm/'.$gidp->file_nbm);
                    ?>
                   
                    <?php 
                    if ($string == TRUE){ ?>
			<span class="pull-left"><a href="<?=base_url()?>/upload/nbm/<?=$gidp->file_nbm?>" target="_blank"> <?=$gidp->nbm?></a></span>
		<?php			} ?>
                    
                    </td>
                    <td>
                    	<a href="<?=base_url('Master_admin/terima_penjual/'.$gidp->idlog)?>" class="btn btn-success btn-sm" onclick="return confirm('anda Yakin ?')">TERIMA</a><br/><br/>
                    	<a href="<?=base_url('Master_admin/hapus_akun/'.$gidp->idlog)?>" class="btn btn-danger btn-sm" onclick="return confirm('anda Yakin ?')">HAPUS</a>
                    	<!--<a onclick="return confirm('anda Yakin ?')" href="<?=base_url('Master_admin/tolak_penjual/'.$gidp->idlog)?>" class="btn btn-danger">TOLAK</a>-->
                    	
                    </td>
                   
                  </tr>  
				<?php	}
				  }
                  ?>
                                
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
		
  
  <!--rev 230917-->
 
</div>

</form>
	
	
    </section>
    
   
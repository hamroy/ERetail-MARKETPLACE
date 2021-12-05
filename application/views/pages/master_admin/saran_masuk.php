 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar saran</li>
      </ol>
      <br/>
        <h1>
         <b>SARAN MASUK </b>
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
	
	<div class="box box-info">
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Saran</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $get_all_id_produk=$this->Madmin_master->get_all_saranmasuk();
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
				  	?>
					<tr >
                    <td><?=$no++?></td>
                    <td><?=$gidp->nama?></td>
                    <td><?=$gidp->username?></td>
                    <td><?=$gidp->no?></td>
                    <td><?=$gidp->saran?></td>
                    
                  
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
	
		</div>
    </section>
    
   
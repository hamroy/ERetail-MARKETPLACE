 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar Pembeli</li>
      </ol>
      <br/>
        <h1>
         <b>DAFTAR PEMBELI </b>
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
             	<form class="form-horizontal" role="form">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Urutkan</label>
    <div class="col-sm-10">
  
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
  <option value="<?=base_url('Master_admin/daftar_pembeli/0/'.$sortir)?>" <?php if($urut==0){ echo 'selected';}?> >Terbaru</option>
  <option value="<?=base_url('Master_admin/daftar_pembeli/1/'.$sortir)?>" <?php if($urut==1){ echo 'selected';}?> >Jumlah Produk yang Dibeli Terbanyak</option>
  <option value="<?=base_url('Master_admin/daftar_pembeli/3/'.$sortir)?>" <?php if($urut==3){ echo 'selected';}?> >Jumlah Nilai Produk Terbanyak</option>
  <option value="<?=base_url('Master_admin/daftar_pembeli/2/'.$sortir)?>" <?php if($urut==2){ echo 'selected';}?>>Nama A-Z</option>
</select>
    </div>
  </div>
  
  </form>
  <form class="form-horizontal" role="form">
  
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Sortir</label>
    <div class="col-sm-10">
  
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
  <option value="<?=base_url('Master_admin/daftar_pembeli/'.$urut.'/0')?>" <?php if($sortir==0){ echo 'selected';}?> >Semua</option>
  <option value="<?=base_url('Master_admin/daftar_pembeli/'.$urut.'/1')?>" <?php if($sortir==1){ echo 'selected';}?> >umy.ac.id</option>
  <option value="<?=base_url('Master_admin/daftar_pembeli/'.$urut.'/2')?>" <?php if($sortir==2){ echo 'selected';}?>>Selain umy.ac.id</option>
</select>
    </div>
  </div>
</form>
             		

					

              <div class="box-tools pull-right">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    
                    <th>Jumlah Produk Dibeli</th>
                    <th>Jumlah Nilai</th>
                    <th>Tanggal Terakhir</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  
                  if($get_all_id_produk->num_rows() > 0){
                    
                  	$no=1+$dari;
      				  	foreach($get_all_id_produk->result() as $gidp){ 
        				  	?>
        					<tr >
                    <td><?=$no++?></td>
                    <td>
                      <a href="<?=base_url('Master_admin/daftar_pembeli_produk/'.$gidp->id_pembeli)?>"><?=$gidp->nama?>
                      </a>
                    </td>
                    <td><?=$gidp->email?></td>
                    <td><?=$gidp->hp?></td>
                    
                    <td><?=$gidp->sqty?>	</td>
                    <td><?=number_format($gidp->total_beli,0,',','.')?>	</td>
                    <td><?=$gidp->tgl_t?>  </td>
                  
                  </tr>  
              				<?php	}
              				  }
                  ?>
                                
                  </tbody>
                </table>

                 <div>
                  <hr>

                  <?=$halaman?></div>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>
	
		</div>
    </section>
    
   
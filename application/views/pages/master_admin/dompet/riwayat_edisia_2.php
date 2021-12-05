 <section class="content-header" style="background: #ecedee;">

    

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>

        <li class="active">Daftar transaksi Belanja Member</li>

      </ol>

      <br/>

        <h1>

         <b>RIWAYAT VOUCHER </b>

        <small></small>

      </h1>

    </section>



    <!-- Main content -->
    <?php
    
    if (!isset($_GET['vo'])) {
      $_GET['vo']=0;
    } else {
      $_GET['vo'];
    }

    if (!isset($_GET['iduser'])) {
      $_GET['iduser']=null;
    } else {
      $_GET['iduser'];
    }
    ?>

    <section class="content">

    <div class="well">
       <form class="form-horizontal" role="form">
    <label for="inputEmail3" class="control-label">Pilih Voucher</label>
  
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
      <option value="?vo=0&iduser=<?=$_GET['iduser']?>" <?=$_GET['vo']==0?'selected':''?> >VOUCHER Makan <span class="pull-left"></span></option>
      <option value="?vo=1&iduser=<?=$_GET['iduser']?>" <?=$_GET['vo']==1?'selected':''?> >VOUCHER  Parsel Lebaran<span class="label"></span></option>
      <option value="?vo=2&iduser=<?=$_GET['iduser']?>" <?=$_GET['vo']==2?'selected':''?> >VOUCHER Ramadhan <span class="pull-left"></span></option>
      <option value="?vo=3&iduser=<?=$_GET['iduser']?>" <?=$_GET['vo']==3?'selected':''?> >VOUCHER Mahasiswa <span class="pull-left"></span></option>
      <option value="?vo=4&iduser=<?=$_GET['iduser']?>" <?=$_GET['vo']==4?'selected':''?> >VOUCHER GAJI 13 <span class="pull-left"></span></option>
    </select>
  
  </form>
   </div>

<?php

	$message = $this->session->flashdata('pesan');

    echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';

?>

    <!--NAV-->



  <div class="table-responsive">

                <table class="table no-margin">

                  <thead>

                  <tr bgcolor="#d9d9dd">

                    <th>No</th>

                    <th>Nama Pembeli</th>

                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  if($_GET['iduser']==null){

                    $get_all_id_produk=$this->Madmin_master->get_all_Penjual_all();

                  }else{

                    $get_all_id_produk=$this->Madmin_master->get_user_produk($_GET['iduser']);

                  }

                  

                  if($get_all_id_produk->num_rows() > 0){

                  	$no=1;

				  	     foreach($get_all_id_produk->result() as $gidp0){ 

				    

                    $get_input_voucer=$this->M_voucher->riwayatVoucherAll($jvoc=$_GET['vo'],$gidp0->idlog,$sta='all',$id_voc=null);
                    if($get_input_voucer->num_rows() == 0){

                        continue;

                    }    

                        

				  	?>

					<tr >

                    <td><?=$no++?></td>

                    <td>

                    <a data-toggle="collapse" data-parent="#accordion<?=$gidp0->idlog?>" href="#collapseOne<?=$gidp0->idlog?>">

         <?=$gidp0->nama?> 

        </a> ( <?=$gidp0->idlog?> )

                    </td>

                    <tr>

						<td colspan="2">

	<div id="collapseOne<?=$gidp0->idlog?>" class="panel-collapse collapse">

	<div class="table-responsive">

                  <table class="table no-margin">

                  <thead>

                  <tr bgcolor="#b7bdb8">

                    <th>No</th>

                    <th>No. Edisi</th>

                    <th>SALDO</th>

                    <th>Tanggal Pesan</th>

                    <th>Tanggal ACC</th>
                    <th>Status</th>


                  </tr>

                  </thead>

                  <?php

                

                 if($get_input_voucer->num_rows() > 0){

                 	$vv1=0;

                 	$no2=1;

                 	$cekth=2;

                 	$totsaldo=0;                 

				 	foreach($get_input_voucer->result() as $vc){

                    ?>

                    <tr>

                    <td><?=$no2++?></td>

                    <td><?=$vc->id_voc?>

                        

                    

                        

                    </td>

                   

                    <td><?=$vc->saldo_awal?></td>

                    <td><?=$vc->tanggal_p?></td>

                    <td><?=$vc->tanggal_acc?></td>
                    <td><?php

                    switch ($vc->proses) {
                      case '0':
                        # code...
                        echo "PESAN";
                        break;
                      case '1':
                        # code...
                        echo "SUDAH DITERIMA";
                        break;
                      case '2':
                        # code...
                        echo "DITOLAK";
                        break;
                      
                      default:
                        # code...
                        echo "PROSES";
                        break;
                    }

                    ?></td>

                    </tr>

                    <?php     

                    $cekth++;

                    }

                    

                    }     

                  

                  ?>

                  </table>

              </div>

    </div>



						

						

					</td>

					</tr>

                   

                  </tr>  

				<?php	}

				  }

                  ?>

                                

                  </tbody>

                </table>

              </div>	

			

	

    </section>

    

   
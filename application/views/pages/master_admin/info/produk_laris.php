 <section class="content-header" style="background: #ecedee;">

    

      <ol class="breadcrumb">

       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>

        <li class="active">Daftar</li>

      </ol>

      <br/>

        <h1>

         <b>DAFTAR PRODUK</b>

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



 <div class="box-body"  style="background: #ffffff">

              <div class="table-responsive">

                <table class="table no-margin">

                  <thead>

                  <tr bgcolor="#d9d9dd">

                    <th>id produk</th>

                    <th>Nama Produk</th>

                    <!--<th>Harga</th>-->

                     <th>terjual</th>

                     <th>Pembeli</th>

                     

                     <th>viewer</th>


                    

                  </tr>

                  </thead>

                  <tbody>

                  <?php 

                  $q=$this->Madmin_master->get_all_produk_all_laris();	

                  $get_all_id_produk=$q;

                  if($get_all_id_produk->num_rows() > 0){

                  //echo $this->Madmin_master->get_all_produk($id_k)->num_rows();

                  	$no=1;


                  //echo 	$get_all_id_produk->num_rows();

				  	foreach($get_all_id_produk->result() as $gidp){ 

					

					/////////

					//GET TBL USER

					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);

					//GET TBL KATEGORI

					$getkat=$this->Madmin_master->get_kategori_produk($gidp->id_k);

					

					if($getkat->num_rows() > 0){

						$kateg=$getkat->row()->kategori;

					}else{

						$kateg='';

					}
                    
                    $q_get_jumlah_qty=$this->Mtrans->get_produkqty_sumua($gidp->id);  ///terjual
                    $q_get_jumlah_pembeli=$this->Mtrans->get_produkpembeli_sumua($gidp->id);  ///jumlah pembeli
                    $get_viewer_produk=$this->Mtrans->get_viewer_produk($gidp->id);  ///viewer
                    
                    if($q_get_jumlah_qty==0 and $q_get_jumlah_pembeli->num_rows()==0){
                        continue;
                    }


                   

					

				  	?>

                    

                    

                    

					<tr >

                    <td><?=$gidp->id?></td>

                    <td><?=$gidp->nama?></td>

                    

                    

                    <td><?=$q_get_jumlah_qty?></td>
                    <td><?=$q_get_jumlah_pembeli->num_rows()?></td>
                    <td><?=$get_viewer_produk->num_rows()?></td>

                   

                    


                    

                    <?php

                    if($gidp->status==1){

                    	$wr='success';

                    	$wr1='danger';

                    	$tx='active';

                    	$up=2;

                    	$bt='block';

					}else{

						$wr='danger';

						$wr1='success';

                    	$tx='non active';

                    	$bt='active';

                    		

                    	$up=1;

					}

                      ?>

                   

                    

                    

                  

                  </tr>  

				<?php	}

				  }

                  ?>

                                

                  </tbody>

                </table>

              </div>

              <!-- /.table-responsive -->

              	

 

				            

              </div>          

			

	

    </section>

    

   
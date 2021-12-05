  <?php
  
    $arvoc=['','','','','','','','','','',''];
    
     $id_voc_s=$this->M_voucher->get_max_id_voc();  
	 $id_voc_par=$this->M_vparsel->get_max_id_v_parsel(); ///menuju edisi parsel
	 $id_voc_song=$this->M_vparsel->get_max_id_v_songsong(); ///menuju edisi parsel
     $id_voc_mhs=$this->M_vparsel->get_max_id_v_id_voc_mhs(); ///menuju edisi MHS
     
     $idjov=4; ///j_voucher
	 $id_vocall=$this->M_vparsel->get_max_id_vocall($idjov); ///menuju edisi voucher
    
    
    switch ($dvo){
        case 1:
        $arvoc[0]="#2d5726";
        $arvoc[1]="MAKAN";
        $arvoc[2]="selected";
        //$get_all_id_produk=$this->Madmin_master->get_pemesan_voc_all_list('1');
        $get_all_id_produk=$this->Madmin_master->get_pemesan_vo('99',$id_voc_s);
        break;
        case 2:
        $arvoc[0]="#fb1d04";
        $arvoc[1]="SONGSONG RAMADHAN";
        $arvoc[3]="selected";
        $get_all_id_produk=$this->M_vparsel->get_penerima_voc_song('99',$id_voc_song);
        break;
        case 3:
        $arvoc[0]="#3d39c6";
        $arvoc[1]="PARSEL LEBARAN";
        $arvoc[4]="selected";
        $get_all_id_produk=$this->M_vparsel->get_penerima_voc_par('99',$id_voc_par);
        break;
        case 4:
        $arvoc[0]="#6b9474";
        $arvoc[1]="MAHASISWA";
        $arvoc[5]="selected";
        $get_all_id_produk=$this->M_vparsel->get_Pesan_voucher_mhs(3,$id_voc_mhs,99);
        break;
        case 5:
        $arvoc[0]="#6b9474";
        $arvoc[1]="GAJI 13";
        $arvoc[6]="selected";
        //$get_all_id_produk=$this->M_vparsel->get_Pesan_voucher_mhs(3,$id_voc_mhs,1);
        $get_all_id_produk=$this->M_dompetall->get_pemesan_vocall_peredisi($id_vocall,$idjov,99);    // all songsog
        break;
        default:
        $arvoc[0]="#2d5726";
        $arvoc[1]="MAKAN";
        $arvoc[2]="selected";
        $get_all_id_produk=$this->Madmin_master->get_pemesan_vo('99',$id_voc_s);
        break;
    }
 
 ?>
 
 <section class="content-header" style="background: #ecedee;">
    
      <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-user"></i> Akun</a></li>
        <li class="active">Daftar Produk</li>
      </ol>
      <br/>
        <h1>
       
         <b>DAFTAR PENERIMA VOUCHER <?=$arvoc[1]?> DITOLAK</b>
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content" >
<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-success text-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <!--NAV-->
	 <!--NAV-->
   <div class="well">
       <form class="form-horizontal" role="form">
    <label for="inputEmail3" class="control-label">Pilih Voucher</label>
  
     <select name="sort" class="form-control"  onchange="loadPage(this.form.elements[0])">
      <option value="?vo=1" <?=$arvoc[2]?>>VOUCHER Makan <span class="pull-left"></span></option>
      <option value="?vo=2" <?=$arvoc[3]?>>VOUCHER Songsong Ramadhan <span class="label"></span></option>
      <option value="?vo=3" <?=$arvoc[4]?>>VOUCHER Parsel Lebaran <span class="pull-left"></span></option>
      <option value="?vo=4" <?=$arvoc[5]?>>VOUCHER Mahasiswa <span class="pull-left"></span></option>
      <option value="?vo=5" <?=$arvoc[6]?>>VOUCHER GAJI 13 <span class="pull-left"></span></option>
    </select>
  
  </form>
   </div>
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
                    <th>NIK</th>
                    <th>UNIT KERJA</th>
                    <th>Tanggal Daftar</th>
                    <th>Tanggal Acc</th>
                    <th>Alasan Ditolak</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                 // $get_all_id_produk=$this->Madmin_master->get_all_Penjual(1);
                  //$get_all_id_produk=$this->Madmin_master->get_pemesan_voc_all_list('99');
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
                    <td><?=$gidp->tanggal_acc?></td>
                    <td><?=$gidp->alasan_tolak?></td>
                    
                 
                    <td>
                    
                    <?php
                    
                    if($dvo==5){
                    $id=$gidp->idpvoc;    
                    }else{
                    $id=$gidp->id;    
                    }
                    ?>
                    	<a href="<?=base_url('Master_admin/hapus_pesan_vou/'.$id.'/'.$dvo)?>" class="btn btn-danger btn-sm" onclick="return confirm('anda Yakin ?')">HAPUS</a>
                    
                    
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
	
	
    </section>
 
<div class="box box-info">
            
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr bgcolor="#d9d9dd">
                    <th>No</th>
                    <th>gambar</th>
                    <th>Nama Produk</th>
                   
                    <th>Penjual</th>
                     <th>Stok</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Tanggal Input</th>
                    <th>action</th>
                  </tr>
                  </thead>
                  <form method="post" action="<?=base_url('C_verifikasi/terimaProdukPilihan?nav=2')?>">
                  <tbody>
                  <?php 
                  $get_all_id_produk=$this->Madmin_master->get_all_produk_new();
                  if($get_all_id_produk->num_rows() > 0){
                  	$no=1;
				  	foreach($get_all_id_produk->result() as $gidp){ 
					
					/////////
					//GET TBL USER
					$getuser=$this->Madmin_master->get_user_produk($gidp->id_user);
					//GET TBL KATEGORI
					$getkat=$this->Madmin_master->get_kategori_produk($gidp->id_k);
					////
					if($getuser->num_rows() > 0){
						$user=$getuser->row()->nama;
					}else{
						$user='';
					}
					////
					if($getkat->num_rows() > 0){
						$kateg=$getkat->row()->kategori;
					}else{
						$kateg='';
					}
					
				  	?>
					<tr >
                    <td>
                      <label class="container"><?=$no++?> 
                      <input name="id_produk[]" class="pilih" value="<?=$gidp->id?>" type="checkbox" />
                      <span class="checkmark"></span>
                      </label>

                    </td>
                     <td>
                      <?php
                      //  $string = read_file('./upload/barang/'.$gidp->gambar);
                        $string = TRUE;
                    		if ($string == FALSE){
                    			$fotoproduk = $this->M_setapp->static_bm().'/img/bm.jpg';
                    			 
                    		}else{
                    			$fotoproduk = $this->M_setapp->static_bm().'/upload/barang/'.$gidp->gambar; 
                    			
                			  } 

                      ?>
                    <p align="center"> <img src="<?=$fotoproduk?>" class="margin" width="100px" /></p>
                    </td>
                    <td><?=$gidp->nama?></td>
                    
                    <td><?=$user?></td>
                    
                    <td><?=$gidp->stok?> <?=$gidp->satuan?></td>
                    <td><?=$gidp->harga?></td>
                    <td><?=$gidp->deskripsi?></td>
                    <td><?=$kateg?></td>
                   
                    <td><?=$gidp->tanggal?></td>
                    <td><a href="<?=base_url('Master_admin/block_produk/'.$gidp->id.'/1/v/'.$gidp->id_k)?>" onclick="return confirm('anda yakin')" class="btn btn-success btn-sm">Terima</a>
                    <br/><br/>
                     <button class="btn btn-danger btn-sm" onclick="edit_person('<?=$gidp->id?>')" 
                      type="button"> 
                      <i class="fa fa-edita"></i>TOLAK&nbsp;
                    </button>
                    <br/>

                    </td>
                        
                  
                  </tr>  
        				<?php
                	}
        				  }
                  ?>
                                
                  </tbody>
                  <input type="button" id="pilihsemua" class="btn btn-default"  value="Select All" />
                  <input type="button" id="pilihsemua2" class="btn btn-default" value="Clear All" />
                  <input onclick="return confirm('anda yakin!')" class="btn btn-primary" type="submit" value="TERIMA PILIHAN" name="submit" /><br />
                  <br/>
                  </form>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
          
            <!-- /.box-footer -->
          </div>


                      <div class="modal fade" id="modal_form2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="myModalLabel">PENOLAKAN PRODUK BARU</h4>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" id="form2" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                            
                           <div class="form-group">
                          <label for="exampleInputEmail1">Karena :</label>
                            <textarea class="form-control" name="alasan" rows="3"> </textarea>
                        </div>   
                                     
                                    <!-- /.box-footer -->
                                     <div class="box-footer">
                                      
                                      <button type="submit" class="btn btn-info pull-right btn-block btn-lg">KIRIM</button>
                                    </div>
                                  </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                             <!---->
<style>
/* The container */
.container {
  display: block;
  width: 20px;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
 -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
}

/* On mouse-over, add a grey background color */
.container:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>

<script>
$("#pilihsemua").click(function () {
$('.pilih').prop('checked', true);
});

$("#pilihsemua2").click(function () {
$('.pilih').removeAttr('checked');
});

var id;
function edit_person(id)
{   
    save_method = 'update';
    $('#form2')[0].reset(); // reset form on modals
    $('#form2').attr('action',"<?=base_url('Master_admin/tolak_produk/')?>"+id);
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('C_lapProduk/viewProduk/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.produk.idProduk);
            $('#modal_form2').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('PENOLAKAN PRODUK BARU'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

</script>
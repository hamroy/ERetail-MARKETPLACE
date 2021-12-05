 
 <div class="container">
 <div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"><h4><b>Forum </b> </h4>  </div>
<!-- DIRECT CHAT PRIMARY -->
          <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
&nbsp;
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->
                <?php
                $getppeasn=$this->Mforum->get_semua_pesan();
                foreach($getppeasn->result() as $a){
                	$get_periduser=$this->Mforum->get_ditbl_user($a->id_user);
                	if($get_periduser->num_rows() > 0){
						$nama=$get_periduser->row()->nama;
		$string = read_file('./upload/profil/'.$get_periduser->row()->img);
		if ($string == FALSE){
			if($get_periduser->row()->jenis_kelamin=='L'){
				$foto = base_url().'/upload/profil/profil.png'; 
			}else{
				$foto = base_url().'/upload/profil/profil_m.png'; 
			}
		}else{
			$foto = base_url().'/upload/profil/'.$get_periduser->row()->img; 
			 } 
					}else{
						$nama='';
						$foto='';
					}
                	 ?>
<?php 
if($a->id_user==$id_user){
	?>
	<div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right"><?=$nama?></span>
                    <span class="direct-chat-timestamp pull-left"><?=$a->tanggal?> <?=$a->waktu?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <div class="direct-chat-text" style=" margin-right: 0px; padding: 10px">
                     <?=$a->pesan?>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
	<?php
}else{
	?>
<div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left" style="font-size: 18px"><?=$nama?></span>
                    <span class="direct-chat-timestamp pull-right"><?=$a->tanggal?> <?=$a->waktu?></span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="<?=$foto?>" width="100%" class="image img-responsive img-rounded"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text" style=" margin-left: 60px; padding: 10px">
                    <?=$a->pesan?>
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
<?php
}

?>			
			
				
				<?php
				
				}
                
                ?>
                
                
              
                <!-- /.direct-chat-msg -->
              </div>
              <!--/.direct-chat-messages-->

             
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <form action="<?=base_url('C_kom/kirimpesan/'.$id_user)?>" method="post">
                <div class="input-group">
                  <input type="text" name="pesan" placeholder="Ketik Disini..." class="form-control" required>
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Kirim <i class="fa fa-fw fa-paper-plane-o"></i></button>
                        <button type="button" class="btn btn-default"> <span class="glyphicon glyphicon-paperclip"></span></button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>
        <!-- /.col -->

 
</div>
















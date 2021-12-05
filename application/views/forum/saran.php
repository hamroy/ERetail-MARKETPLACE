 <div class="register-box" >
  

  <div class="register-box-body" style="border-radius: 10px; "  >
<h4><a href="<?=base_url('Welcome/allkategori')?>"><?=$title2?></a></h4>
  <div class="register-logo"  >
   <b>SARAN</b>
  </div>
    <p class="login-box-msg">Masukkan saran anda di bawah sini !!</p>
	<?php
	$messages = $this->session->flashdata('pesandaftar');
    	echo $messages == '' ? '' : '<div class="alert alert-danger" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $messages . '</p></div>';
    ?>
    <?php
	$messagess = $this->session->flashdata('pesandaftars');
    	echo $messagess == '' ? '' : '
    	<br/>
    	<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $messagess . '</p></div>
    	<br/>
    	<a href="'.base_url('Welcome/allkategori').'" class="btn btn-block btn-warning btn-sm">Kembali</a><br>
    	';
    ?>
     <form action="<?=base_url('C_kom/simpansaran')?>" method="post" enctype="multipart/form-data">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nama" placeholder="Nama" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
     
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="username" placeholder="Email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
       
		<div class="form-group has-feedback">
        <input type="text" class="form-control" name="no" placeholder="No. Kontak" required>
         <span class="glyphicon glyphicon glyphicon-earphone form-control-feedback"></span>
     	 </div>

		 <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nama_penjual" placeholder="Nama Penjual" required>
      </div>
		
		<div class="form-group has-feedback">
		<label class="form">Saran</label>
       <textarea rows="2"title="alamat" name="saran" placeholder="saran" class="form-control" required> </textarea>
      </div>
     
      <hr/>
       <div class="form-group has-feedback">
          <button type="submit" class="btn btn-primary btn-block">Kirim</button>
      </div>
    </form>


    
<hr/>
  <a href="<?=base_url('Welcome/allkategori')?>" class="btn btn-block btn-warning btn-sm">Kembali</a><br>

  </div>
  <!-- /.form-box -->
</div>

















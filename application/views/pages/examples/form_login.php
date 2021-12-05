<div class="login-box" style="margin-top: 10%;">
 
  <!-- /.login-logo -->
  <div class="login-box-body" style="margin: auto; padding: auto; width: 299px ; border-radius: 5px">
   <div class="login-logo" style="background: #a6a09b; color: #000000; border-radius: 5px" >
    <b>LOGIN</b>
  </div>
    <p class="login-box-msg">Silahkan masukkan email anda!!!</p>
	<?php
	$message = $this->session->flashdata('pesan');
    	echo $message == '' ? '' : '<div class="alert alert-error text-danger" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $message . '</p></div>';
    ?>
    <?php
	$messages = $this->session->flashdata('pesandaftar');
    	echo $messages == '' ? '' : '<div class="alert alert-success" ><button type="button" class="close" data-dismiss="alert">&times;</button><p class="text-center">' . $messages . '</p></div>';
    ?>
    <form action="<?=base_url('login/proses')?>" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="username" placeholder="Email" required="required">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-success btn-block">MASUK <span class="glyphicon glyphicon-log-in"></span> </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<hr/>
  
  
  <a href="<?=base_url('Login/daftar')?>" class="btn btn-block btn-warning"><span class="glyphicon glyphicon-user"></span> BUAT AKUN</a><br>

  </div>
  <!-- /.login-box-body -->
  
 
</div>
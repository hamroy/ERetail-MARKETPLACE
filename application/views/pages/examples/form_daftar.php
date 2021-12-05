
<div class="btn-group btn-group-justified">


<?php

switch ($pro){
    
    case '1':
    $thak1='primary';
    $thak2='default';
    $thak3='default';
    $isiform='pages/examples/tahap_daptar/form_1';
    break;
    case 2:
    $thak1='success';
    $thak2='primary';
    $thak3='default';
    $isiform='pages/examples/tahap_daptar/form_2';
    break;
    case 3:
    $thak1='success';
    $thak2='success';
    $thak3='primary';
    $isiform='pages/examples/tahap_daptar/form_3';
    break;
    case 4:
    $thak1='success';
    $thak2='success';
    $thak3='success';
    $isiform='pages/examples/tahap_daptar/form_4';
    break;
    default:
    $thak1='primary';
    $thak2='default';
    $thak3='default';
    $isiform='pages/examples/tahap_daptar/form_1';
    break;
}
?>
  <div class="btn-group">
    <button type="button" class="btn btn-<?=$thak1?>">TAHAP 1</button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-<?=$thak2?>">TAHAP 2</button>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-<?=$thak3?>">TAHAP 3</button>
  </div>
</div>

<div class="register-box" style="margin-top: 10px">

  



  <div class="register-box-body" style="border-radius: 10px; "  >

  

  <div class="register-logo" style="border: 12px">

   <b>PENDAFTARAN AKUN BARU</b>

  </div>

  <!--  <p class="login-box-msg">Isilah formulir berikut:</p>-->

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

    	';

    ?>
    
    <?php
    
    $this->load->view($isiform);
    
    ?>
    





    



  <a href="<?=base_url('Welcome/allkategori')?>" class="btn btn-block btn-warning">Kembali</a><br>

  

  <hr/>

  <hr/>

  <a href="<?=base_url('Login')?>" class="btn btn-block btn-success btn-sm">LOGIN</a><br>

  

  



  </div>

  <!-- /.form-box -->

</div>





<?php

/*$gettotal=10; ///

$transit0=$gettotal;

		$transit1=9-$gettotal;

		if($transit1 >= 0){

			echo $gettotal=$transit0;

			echo $transit=$transit1;

			$lolos='1';

		}else{

			echo $gettotal=0;

			 echo $transit=0;

			$lolos='0';

		}

		echo $lolos;

		

//*/		

		
		
?>

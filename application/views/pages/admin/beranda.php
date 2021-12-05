<?php
$gs=$this->session->userdata();
// print_r($gs);

//  die();

if($gs['status_job'] < 3){ //8 == kokar
  $this->M_setapp->supermarket();
  $this->load->view('beranda_admin/beranda');
}elseif($gs['status_job'] == 3){ //3 == mhs
   $this->M_setapp->supermarket();
   $this->load->view('beranda_admin/beranda');	
}
elseif($gs['status_job'] == 1001){ //1001 == alumni
   $this->M_setapp->supermarket();
   $this->load->view('beranda_admin/beranda');	
}else{
  $this->M_setapp->supermarket();
  $this->load->view('beranda_admin/beranda');
}
<?php

$id_job=$this->session->userdata('status_job');
$market = $this->session->userdata('id_supermarket');
// echo $market;
// die();
$jsta='';

        if ($market!=null) {
        	$jsta=$this->M_setapp->get_idjobmarket();            
        }         
 

$this->load->view('pages/layout/top-nav_publik'); //

/*
if(($jsta==3 and $market==3) ){
  $this->load->view('pages/layout/top-nav_mhs');

}elseif(($jsta==1001 and $market==4)){
  $this->load->view('pages/layout/top-nav_bedukseruni');
}
elseif(($jsta==1000 and $market==100)){
  $this->load->view('pages/layout/top-nav_bedukaistu');
}
else{

}

*/

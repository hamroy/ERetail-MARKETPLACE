<?php



class M_belanja extends CI_Model {



function __construct()

{

	parent::__construct();

}

function get_listAkun(){

		$this->db->from('ueu_tbl_user,tbl_transaksi');
		$this->db->where('ueu_tbl_user.idlog = tbl_transaksi.id_user');
		$this->db->where('ueu_tbl_user.wewenang','user');
		$this->db->group_by('tbl_transaksi.id_user');
		$this->db->order_by('ueu_tbl_user.idlog' ,'DESC');
		$this->db->where('ueu_tbl_user.status !=' ,0);

		return $this->db->get();

}
function get_listPembeli(){

		$day=$this->session->userdata('T_tgl');
        $thn=$this->session->userdata('T_thn');
        $bln=$this->session->userdata('T_bln');

        $job=$this->session->userdata('statusP');
        $kdP='';
        if ($job==3) {
            $kdP=$this->session->userdata('sProdiP');
        }

    	if ($day!="S") {
           $this->db->where('tbl_transaksi.day',$day);
        }

        if ($bln!="S") {
           $this->db->where('tbl_transaksi.bln',$bln);
        }

        if ($thn!="S") {
           $this->db->where('tbl_transaksi.thn',$thn);
        }
        if ($kdP!=0) {
           $this->db->where('ueu_tbl_user.kode_prodi',$kdP);
        }

        if ($job!=0) {
           $this->db->where('ueu_tbl_user.job',$job);
        }

        $this->db->where('ueu_tbl_user.status',1);

		$this->db->from('tbl_pembeli,tbl_transaksi');
		$this->db->where('tbl_pembeli.id = tbl_transaksi.id_pembeli');
		$this->db->join('ueu_tbl_user','ueu_tbl_user.idlog = tbl_pembeli.id_user','right');
		$this->db->group_by('tbl_transaksi.id_pembeli');
		
		return $this->db->get();

}
///get_listAkun_pag
function get_listAkun_pag($lim,$off){

		$this->db->from('tbl_pembeli,tbl_transaksi');
		$this->db->where('tbl_pembeli.id = tbl_transaksi.id_pembeli');
		$this->db->where('ueu_tbl_user.wewenang','user');
		$this->db->group_by('tbl_transaksi.id_user');
		$this->db->order_by('ueu_tbl_user.idlog' ,'DESC');
		$this->db->where('ueu_tbl_user.status !=' ,0);
 	
		return $this->db->get('',$lim,$off);

}
function get_listPembeli_pag($lim,$off){
		$day=$this->session->userdata('T_tgl');
        $thn=$this->session->userdata('T_thn');
        $bln=$this->session->userdata('T_bln');

        $job=$this->session->userdata('statusP');
        $kdP='';
        if ($job==3) {
            $kdP=$this->session->userdata('sProdiP');
        }

    	if ($day!="S") {
           $this->db->where('tbl_transaksi.day',$day);
        }

        if ($bln!="S") {
           $this->db->where('tbl_transaksi.bln',$bln);
        }

        if ($thn!="S") {
           $this->db->where('tbl_transaksi.thn',$thn);
        }
        if ($kdP!=0) {
           $this->db->where('ueu_tbl_user.kode_prodi',$kdP);
        }

        if ($job!=0) {
           $this->db->where('ueu_tbl_user.job',$job);
        }

        // $this->db->where('ueu_tbl_user.status',1);
        $this->db->where('tbl_transaksi.buy','dibayar');

		$this->db->from('tbl_transaksi,ueu_tbl_user');
        // $this->db->where('tbl_pembeli.id = tbl_transaksi.id_pembeli');
        $this->db->where('tbl_transaksi.id_user = ueu_tbl_user.idlog');
		// $this->db->where('tbl_pembeli.id_user = ueu_tbl_user.idlog');
		$this->db->group_by('tbl_transaksi.id_user');
		// $this->db->join('ueu_tbl_user','ueu_tbl_user.idlog = tbl_pembeli.id_user','right');
		// $this->db->order_by('tbl_transaksi.id_tgl');
	
        // return $this->db->get('',$lim,$off);
		return $this->db->get('');

}

function get_transaksiBelanjaAkun($id_user,$via,$buy){

$d=[

	'id_user'=>$id_user,
	'metode'=>$via,
	'buy'=>$buy,

];
$a=$this->db->where($d)
->get('tbl_transaksi');

return $a;
			

}

function get_transaksiBelanjaPembeli($id_user,$via,$buy){

		$day=$this->session->userdata('T_tgl');
        $thn=$this->session->userdata('T_thn');
        $bln=$this->session->userdata('T_bln');
        if ($day!="S") {
           $this->db->where('tbl_transaksi.day',$day);
        }

        if ($bln!="S") {
           $this->db->where('tbl_transaksi.bln',$bln);
        }

        if ($thn!="S") {
           $this->db->where('tbl_transaksi.thn',$thn);
        }
$d=[

	'id_user'=>$id_user,
	'metode'=>$via,
	'buy'=>$buy,

];
$a=$this->db->where($d)
->get('tbl_transaksi');

return $a;
			

}

function get_pendapatanAkun($id_user,$via,$buy='dibayar'){

	$a=$this->get_transaksiBelanjaAkun($id_user,$via,$buy);


	$tot=0;
	if ($a->num_rows()==0) {
		return $tot;
	}
	foreach ($a->result() as $key) {
		$tot=$tot+($key->qty*$key->harga_satuan);
	}

	return $tot;


}

///get_BelanjaPembeli
function get_BelanjaPembeli($id_p,$via,$buy='dibayar'){

	$a=$this->get_transaksiBelanjaPembeli($id_p,$via,$buy);


	$tot=0;
	if ($a->num_rows()==0) {
		return $tot;
	}
	foreach ($a->result() as $key) {
		$tot=$tot+($key->qty*$key->harga_satuan);
	}

	return $tot;


}

function get_transaksiBelanjaSemuaAkun($via,$buy){

$d=[

	'metode'=>$via,
	'buy'=>$buy,

];
$a=$this->db->where($d)
->get('tbl_transaksi');

return $a;
			

}
	
function get_pendapatanBM($via,$buy='dibayar'){
	$a=$this->get_transaksiBelanjaSemuaAkun($via,$buy);
	$tot=0;
	if ($a->num_rows()==0) {
		return $tot;
	}
	foreach ($a->result() as $key) {
		$tot=$tot+($key->qty*$key->harga_satuan);
	}

	return $tot;


}

function get_transPerProdiB($kode_prodi){

        $day=$this->session->userdata('T_tgl');
        $thn=$this->session->userdata('T_thn');
        $bln=$this->session->userdata('T_bln');

    if ($day!="S") {
           $this->db->where('tbl_transaksi.day',$day);
        }

        if ($bln!="S") {
           $this->db->where('tbl_transaksi.bln',$bln);
        }

        if ($thn!="S") {
           $this->db->where('tbl_transaksi.thn',$thn);
        }

    $d=[

        // 'id_pelapak'=>$id_user,
        // 'metode'=>$via,
        'tbl_transaksi.buy'=>'dibayar',
        'ueu_tbl_user.kode_prodi'=>$kode_prodi,
        'ueu_tbl_user.job'=>3,
        // 'ueu_tbl_user.status'=>1,



    ];
        $this->db->from('tbl_transaksi,ueu_tbl_user');
        $this->db->where('tbl_transaksi.id_user = ueu_tbl_user.idlog');
        $this->db->group_by('tbl_transaksi.id_user');

        $a=$this->db->where($d)
        //->from('ueu_tbl_user,tbl_transaksi')
        // ->where('ueu_tbl_user.idlog = tbl_transaksi.id_user')
        // ->group_by('tbl_transaksi.id_pelapak')
        // ->order_by('tbl_transaksi.id_tgl')
        ->get();

    return $a;
                

    }

    public function get_TotPerProdiB($kode_prodi)
    {
        $a=$this->get_transPerProdiB($kode_prodi);
        

        $tot=0;
        if ($a->num_rows()==0) {
            return $tot;
        }
        foreach ($a->result() as $key) {
            $tot=$tot+($key->qty*$key->harga_satuan);
        }

        return $tot;
    }

    


	

} //class
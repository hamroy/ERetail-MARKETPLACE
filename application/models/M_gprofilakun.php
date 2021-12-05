<?php



class M_gprofilakun extends CI_Model
{


	function __construct()
	{
		parent::__construct();
	}

	function gprofil()

	{

		$g_id = $this->Muser->get_id_pass();
		$data['img'] = $g_id->row()->img;
		$data['nama'] = $g_id->row()->nama;
		$data['alamat'] = $g_id->row()->alamat;
		$data['nbm'] = $g_id->row()->nbm;
		$data['kontak'] = $g_id->row()->no_kontak;
		$data['username'] = $g_id->row()->username;
		$data['password'] = $g_id->row()->password;
		$data['rek'] = $g_id->row()->rek;
		$data['bank'] = $g_id->row()->bank;
		$data['sex'] = $g_id->row()->jenis_kelamin;
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['idlog'] = $g_id->row()->idlog;





		return $data;
	}
	function navmenu()

	{

		$data['a'] = $data['b'] = $data['j'] = $data['k'] = '';
		$data['c'] = $data['d'] = $data['h'] = $data['g'] = $data['i'] = '';

		return $data;
	}
}///class
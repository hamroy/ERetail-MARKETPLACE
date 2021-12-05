<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Emailparsing extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['view'] = 'pages/examples/form_login';
		$this->load->view('pages/examples/login', $data);
	}
}

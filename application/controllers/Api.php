<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{ 

		//$this->load->view('api/blank');
		$this->load->view('api/test');
	}
}
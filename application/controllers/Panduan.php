<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panduan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan0';
		$this->load->view('pages/layout/top-nav', $data);
	}

	function a()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan1';
		$this->load->view('pages/layout/top-nav', $data);
	}

	function b()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan2';
		$this->load->view('pages/layout/top-nav', $data);
	}

	function c()
	{
		$data['title0'] = 'E-Retail';
		$data['title1'] = 'E-Retail';
		$data['title2'] = 'KE BERANDA';
		$data['view'] = 'pages/publik/panduan3';
		$this->load->view('pages/layout/top-nav', $data);
	}
}

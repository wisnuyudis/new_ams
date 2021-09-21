<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
	// function __construct() {
	// 	parent::__construct();
	// 	//validasi jika user belum login
	// 	if ($this->session->userdata('masuk') != TRUE) {
	// 		$url = base_url('login');
	// 		redirect($url);
	// 	}
	// }

	public function index()
	{
		$data['_view'] = 'v_home';
        $this->load->view('template', $data );
		// $this->load->view('v_home');
	}
}

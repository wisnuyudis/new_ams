<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_master extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_data');
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
        $data['u'] = $this->m_data->tampil_data_user();
        $data['js'] = $this->m_data->tampil_data_jenis_surat();
        $data['sas'] = $this->m_data->tampil_data_bidang();
        //$data['un'] = $this->m_data->tampil_data_un();
		$data['_view'] = 'v_master';
        $this->load->view('template', $data );
		// $this->load->view('v_home');
	}

	function tambah_js(){
		$jenis_surat = $this->input->post('jenis_surat');

		$data = array(
			'jenis_surat' => $jenis_surat
		);

		$this->m_data->input_data($data,'tb_jenis_surat');
		$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil ditambahkan !</div>');
			redirect(base_url('data_master'));
	}

	function tambah_sasaran(){
		$bidang = $this->input->post('bidang');

		$data = array(
			'bidang' => $bidang
		);

		$this->m_data->input_data($data,'tb_bidang');
			$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil ditambahkan !</div>');
			redirect(base_url('data_master'));
	}

	function tambah_user(){
		$nama = $this->input->post('nama');
		$unit = $this->input->post('unit');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');

		$data = array(
			'nama' => $nama,
			'unit' => $unit,
			'username' => $username,
			'password' => md5($password),
			'level' => $level
		);

			$sql = $this->db->query("SELECT username FROM user where username='$username'");
			$cek_no = $sql->num_rows();
			if ($cek_no > 0) {
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">Username sudah terdaftar !</div>');
				redirect(base_url('data_master'));
			}else{
				$this->m_data->input_data($data,'user');
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil ditambahkan !</div>');
				redirect(base_url('data_master'));
			}
	}

	function hapus_user($id){
		$where = array('id' => $id);
		$this->m_data->hapus_data($where,'user');
		$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">Data berhasil dihapus !</div>');
		redirect(base_url('data_master'));
	}

	function hapus_js($id){
		$where = array('id' => $id);
		$this->m_data->hapus_data($where,'tb_jenis_surat');
		$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">Data berhasil dihapus !</div>');
		redirect(base_url('data_master'));
	}

	function hapus_sasaran($id){
		$where = array('id' => $id);
		$this->m_data->hapus_data($where,'tb_bidang');
		$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">Data berhasil dihapus !</div>');
		redirect(base_url('data_master'));
	}

}

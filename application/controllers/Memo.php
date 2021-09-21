<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memo extends CI_Controller {

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
		$data['me'] = $this->m_data->tampil_data_memo();
		$data['_view'] = 'v_memo';

        $this->load->view('template', $data );
		// $this->load->view('v_home');
	}

	function tambah_aksi(){
		$nomor_memo = $this->input->post('nomor_memo');
		$ket = $this->input->post('ket');
		
		$tgl_publish = date('y-m-d');
		$publish = $this->session->userdata('nama');
		//$file_documen = $this->input->post('file_documen');
		//$kesan = $this->input->post('kesan');
		//$foto = $this->input->post('foto');

		$nama_file = $ket;

		$config['upload_path'] 		= 'upload/file_memo';
		$config['allowed_types'] 	= 'pdf';
		$config['file_name'] 		= $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file_memo')) {
				 $error = $this->upload->display_errors("","");
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">'.$error.'</div>');
				redirect(base_url("memo"));
		}
		$file_memo =  $this->upload->data('file_name');

		$data = array(
			'nomor_memo' => $nomor_memo,
			'ket' => $ket,
			
			'tgl_publish' => $tgl_publish,
			'publish' => $publish,
			'file_memo' => $file_memo
			);
			// if (!empty($_FILES['file_documen']['name'])) {
			// 	$file_documen = $this->_do_upload();
			// 	// $upload = $this->m_data->get_by_id($id);
			// 	// if (file_exists('upload/img/'.$upload->foto) && $upload->foto) {
			// 	// 	unlink('upload/img/'.$upload->foto);
			// 	// }
			// 	$data['file_documen'] = $file_documen;
			// }
		
			$sql = $this->db->query("SELECT nomor_memo FROM memo where nomor_memo='$nomor_memo'");
			$cek_no = $sql->num_rows();
			if ($cek_no > 0) {
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">Nomor Memo Sudah Terdaftar</div>');
				redirect(base_url('memo'));
			}else{
				$this->m_data->input_data($data,'memo');
				echo $this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil disimpan !</div>');
				redirect(base_url('memo'));
			}

				
	} 

	public function update_aksi()
    {
		$id = $this->input->post('id');
		$file_edit_memo = $this->input->post('file_edit_memo');
		$nomor_memo = $this->input->post('nomor_memo');
		$ket = $this->input->post('ket');
		
		$tgl_publish = date('y-m-d');
		$publish = $this->session->userdata('nama');

		$nama_file = $ket;

		$config['upload_path'] 		= 'upload/file_memo';
		$config['allowed_types'] 	= 'pdf';
		$config['file_name'] 		= $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file_memo')) {
				 $error = $this->upload->display_errors("","");
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">'.$error.'</div>');
				redirect(base_url("memo"));
		}
		
		unlink(base_url('upload/file_memo/'.$file_edit_memo));
		
		$file_memo =  $this->upload->data('file_name');

        $data = array(
			'id' => $id,
            'nomor_memo' => $nomor_memo,
			'ket' => $ket,
			
			'tgl_publish' => $tgl_publish,
			'publish' => $publish,
			'file_memo' => $file_memo
        );

        $this->m_data->update_data($data,'memo');
		echo $this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil diupdate !</div>');
		redirect(base_url('memo'));
    }

		// public function _do_upload()
	  //   {
		//
		// 	$nomor_dokumen = $this->input->post('nomor_dokumen');
		//
	  //       $nama_file = date('d-m-y');
		//
	  //       $config['upload_path'] 		= 'upload/file_doc/';
	  //       $config['allowed_types'] 	= 'gif|jpg|png';
	  //       $config['file_name'] 		= $nama_file;
		//
	  //       $this->load->library('upload', $config);
	  //       if (!$this->upload->do_upload('file_documen')) {
	  //           $this->session->set_flashdata('msg', $this->upload->display_errors('', ''));
		// 					return $this->upload->data('file_name');
	  //           // redirect(base_url("dokumen"));
	  //       }
	  //       return $this->upload->data('file_name');
		// }
}

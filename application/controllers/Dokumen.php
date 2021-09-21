<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

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
		$data['doc'] = $this->m_data->tampil_data();
		$data['jenis']=$this->m_data->get_jenis_dokumen();
		$data['sas']=$this->m_data->get_bidang();
		$data['_view'] = 'v_dokumen';
        $this->load->view('template', $data );
		// $this->load->view('v_home');
	}

	function tambah_aksi(){
		$nomor_dokumen = $this->input->post('nomor_dokumen');
		$bidang = $this->input->post('bidang');
		$jenis_dokumen = $this->input->post('jenis_dokumen');
		$judul_dokumen = $this->input->post('judul_dokumen');
		$tgl_upload = date('y-m-d');
		$author = $this->session->userdata('nama');
		//$file_documen = $this->input->post('file_documen');
		//$kesan = $this->input->post('kesan');
		//$foto = $this->input->post('foto');

		$nama_file = $judul_dokumen;

		$config['upload_path'] 		= 'upload/file_doc/'.$jenis_dokumen;
		$config['allowed_types'] 	= 'pdf';
		$config['file_name'] 		= $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file_documen')) {
			$error = $this->upload->display_errors("","");
			$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">'.$error.'</div>');
				redirect(base_url("dokumen"));
		}
		$file_documen =  $this->upload->data('file_name');

		$data = array(
			'nomor_dokumen' => $nomor_dokumen,
			'bidang' => $bidang,
			'jenis_dokumen' => $jenis_dokumen,
			'judul_dokumen' => $judul_dokumen,
			'tgl_upload' => $tgl_upload,
			'author' => $author,
			'file_documen' => $file_documen
			);
			// if (!empty($_FILES['file_documen']['name'])) {
			// 	$file_documen = $this->_do_upload();
			// 	// $upload = $this->m_data->get_by_id($id);
			// 	// if (file_exists('upload/img/'.$upload->foto) && $upload->foto) {
			// 	// 	unlink('upload/img/'.$upload->foto);
			// 	// }
			// 	$data['file_documen'] = $file_documen;
			// }

			$sql = $this->db->query("SELECT nomor_dokumen FROM dokumen where nomor_dokumen='$nomor_dokumen'");
			$cek_no = $sql->num_rows();
			if ($cek_no > 0) {
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">Nomor Dokumen Sudah Terdaftar</div>');
				redirect(base_url('dokumen'));
			}else{
				$this->m_data->input_data($data,'dokumen');
				echo $this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil disimpan !</div>');
				redirect(base_url('dokumen'));
			}




	}

	public function update_aksi()
    {
		$id = $this->input->post('id');
		$nomor_dokumen = $this->input->post('nomor_dokumen');
		$bidang = $this->input->post('bidang');
		$jenis_dokumen = $this->input->post('jenis_dokumen');
		$judul_dokumen = $this->input->post('judul_dokumen');
		$tgl_upload = date('y-m-d');
		$author = $this->session->userdata('nama');

		$nama_file = $judul_dokumen;

		$config['upload_path'] 		= 'upload/file_doc/'.$jenis_dokumen;
		$config['allowed_types'] 	= 'pdf';
		$config['file_name'] 		= $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file_documen')) {
			$error = $this->upload->display_errors("","");
			$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">'.$error.'</div>');
			redirect(base_url("dokumen"));

		}
		unlink(base_url().'upload/file_doc/'.$jenis_dokumen.'/'.$file_documen_edit);

		$file_documen =  $this->upload->data('file_name');

        $data = array(
			'id' => $id,
			'bidang' => $bidang,
      'nomor_dokumen' => $nomor_dokumen,
			'jenis_dokumen' => $jenis_dokumen,
			'judul_dokumen' => $judul_dokumen,
			'tgl_upload' => $tgl_upload,
			'author' => $author,
			'file_documen' => $file_documen
        );

        $this->m_data->update_data($data,'dokumen');
		echo $this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil diupdate !</div>');
		redirect(base_url('dokumen'));
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

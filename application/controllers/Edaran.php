<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edaran extends CI_Controller {

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
		$data['se'] = $this->m_data->tampil_data_edaran();
		$data['_view'] = 'v_edaran';
        $this->load->view('template', $data );
		// $this->load->view('v_home');
	}

	function tambah_aksi(){
		$nomor_surat = $this->input->post('nomor_surat');
		$isi_surat = $this->input->post('isi_surat');
		$tgl_publish = date('y-m-d');
		$publish = $this->session->userdata('nama');
		//$file_documen = $this->input->post('file_documen');
		//$kesan = $this->input->post('kesan');
		//$foto = $this->input->post('foto');

		$nama_file = $isi_surat;

		$config['upload_path'] 		= 'upload/file_surat';
		$config['allowed_types'] 	= 'pdf';
		$config['file_name'] 		= $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file_surat')) {
			$error = $this->upload->display_errors("","");
			$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">'.$error.'</div>');
				redirect(base_url("edaran"));
		}
		$file_surat =  $this->upload->data('file_name');

		$data = array(
			'nomor_surat' => $nomor_surat,
			'isi_surat' => $isi_surat,
			'tgl_publish' => $tgl_publish,
			'publish' => $publish,
			'file_surat' => $file_surat
			);
			// if (!empty($_FILES['file_documen']['name'])) {
			// 	$file_documen = $this->_do_upload();
			// 	// $upload = $this->m_data->get_by_id($id);
			// 	// if (file_exists('upload/img/'.$upload->foto) && $upload->foto) {
			// 	// 	unlink('upload/img/'.$upload->foto);
			// 	// }
			// 	$data['file_documen'] = $file_documen;
			// }
		
			$sql = $this->db->query("SELECT nomor_surat FROM edaran where nomor_surat='$nomor_surat'");
			$cek_no = $sql->num_rows();
			if ($cek_no > 0) {
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Nomor Surat Sudah Terdaftar</div>');
				redirect(base_url('edaran'));
			}else{
				$this->m_data->input_data($data,'edaran');
				echo $this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Data berhasil disimpan !</div>');
				redirect(base_url('edaran'));
			}

				
	}

	public function update_aksi()
    {
		$id = $this->input->post('id');
		$file_edit_surat = $this->input->post('file_edit_surat');
		$nomor_surat = $this->input->post('nomor_surat');
		$isi_surat = $this->input->post('isi_surat');
		$tgl_publish = date('y-m-d');
		$publish = $this->session->userdata('nama');

		$nama_file = $isi_surat;

		$config['upload_path'] 		= 'upload/file_surat';
		$config['allowed_types'] 	= 'pdf';
		$config['file_name'] 		= $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file_surat')) {
			$error = $this->upload->display_errors("","");
			$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">'.$error.'</div>');
				redirect(base_url("edaran"));
		}
		
		unlink(base_url('upload/file_memo/'.$file_edit_memo));
		
		$file_surat =  $this->upload->data('file_name');

        $data = array(
			'id' => $id,
            'nomor_surat' => $nomor_surat,
			'isi_surat' => $isi_surat,
			'tgl_publish' => $tgl_publish,
			'publish' => $publish,
			'file_surat' => $file_surat
        );

        $this->m_data->update_data($data,'edaran');
		echo $this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil diupdate !</div>');
		redirect(base_url('edaran'));
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

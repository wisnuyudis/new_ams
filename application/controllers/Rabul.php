<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rabul extends CI_Controller {

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
    $data['unit']=$this->m_data->get_unit();
    $data['bid']=$this->m_data->get_bidang();
		$data['me'] = $this->m_data->tampil_data_rabul();
		$data['_view'] = 'v_rabul';

        $this->load->view('template', $data );
		// $this->load->view('v_home');
	}

	function tambah_aksi(){
		$nama_unit = $this->input->post('nama_unit');
		$bidang = $this->input->post('bidang');
		$bulan = $this->input->post('bulan');
		$tgl_publish = date('y-m-d');
		$publish = $this->session->userdata('nama');
		//$file_documen = $this->input->post('file_documen');
		//$kesan = $this->input->post('kesan');
		//$foto = $this->input->post('foto');

		$nama_file = $ket;

		$config['upload_path'] 		= 'upload/file_rabul';
		$config['allowed_types'] 	= 'pdf|xls|xlsx|ppt|pptx|doc|docx|odt';
		$config['file_name'] 		= $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file_rabul')) {
				 $error = $this->upload->display_errors("","");
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">'.$error.'</div>');
				redirect(base_url("rabul"));
		}
		$file_rabul =  $this->upload->data('file_name');

		$data = array(
			'nama_unit' => $nama_unit,
			'bidang' => $bidang,
			'bulan' => $bulan,

			'tgl_publish' => $tgl_publish,
			'publish' => $publish,
			'file_rabul' => $file_rabul
			);

			$this->m_data->input_data($data,'rabul');
			echo $this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil disimpan !</div>');
			redirect(base_url('rabul'));

	}

	public function update_aksi()
    {
		$id = $this->input->post('id');
		$file_edit_rabul = $this->input->post('file_edit_rabul');
		$nama_unit = $this->input->post('nama_unit');
		$bidang = $this->input->post('bidang');
		$bulan = $this->input->post('bulan');

		$tgl_publish = date('y-m-d');
		$publish = $this->session->userdata('nama');

		$nama_file = $ket;

		$config['upload_path'] 		= 'upload/file_rabul';
		$config['allowed_types'] 	= 'pdf';
		$config['file_name'] 		= $nama_file;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('file_rabul')) {
				 $error = $this->upload->display_errors("","");
				$this->session->set_flashdata('msg', '<div id="msg" class="alert alert-danger alert-dismissible">'.$error.'</div>');
				redirect(base_url("rabul"));
		}

		unlink(base_url('upload/file_rabul/'.$file_edit_rabul));

		$file_rabul =  $this->upload->data('file_name');

        $data = array(
			'id' => $id,
      'nama_unit' => $nama_unit,
			'bidang' => $bidang,
			'bulan' => $bulan,
			'tgl_publish' => $tgl_publish,
			'publish' => $publish,
			'file_rabul' => $file_rabul
        );

    $this->m_data->update_data($data,'rabul');
		echo $this->session->set_flashdata('msg', '<div id="msg" class="alert alert-success alert-dismissible">Data berhasil diupdate !</div>');
		redirect(base_url('rabul'));
    }

}

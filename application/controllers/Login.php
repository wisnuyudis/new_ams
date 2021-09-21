<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_auth');
	}

	public function index()
	{
		$this->load->view('login');
	}

	function aksi_login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));

		$user = $this->m_auth->cek_login($username, $password);

        if ($user && isset($user['id'])) {
            $userdata = array(
                'id' => $user['id'],
                'nama' => $user['nama'],
                'level' => $user['level'],
                'status' => 'login',
                //'user_photo' => isset($user['user_photo']) ? site_url('resources/uploads/photo/') . $user['user_photo'] : site_url('assets/images/dashboard/user.png'),
                'last_login' => time(),
                'last_time' => time()
            );
            $this->session->set_userdata($userdata);

	//	$nama = $this->input->post('nama');
		// $where = array(
		// 	'username' => $username,
		// 	'password' => $password
		// 	);

		// $cek = $this->m_auth->cek_login("user",$where);
		// if($cek->num_rows() > 0){
		// 	 $data=$cek->row_array();

		// 	$data_session = array(
		// 		'username' => $username,
		// 		'status' => "login"

		// 		);

		// 	$this->session->set_userdata($data_session);
		// 	$this->session->set_userdata('nama',$data['nama']);
			redirect(base_url('home'));

		}else{
			$url = base_url('login');
      		$this->session->set_flashdata('msg_login', '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Username / Password Salah !!</div>');
			redirect($url);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

}


// <?php

// class Login extends CI_Controller

// {
//     public function __construct()
//     {
//         parent::__construct();
//         $this->load->model('auth');
//         $this->load->library('form_validation');
//         $this->load->library('session');
//     }

//     public function index()
//     {
//         $this->load->view('login');
//     }

//     public function auth()
//     {
//         $this->form_validation->set_rules('username', 'Username', 'required');
//         $this->form_validation->set_rules('password', 'Password', 'required');

//         if ($this->form_validation->run() == FALSE) {

//             $errors = $this->form_validation->error_array();
//             $this->session->set_flashdata('errors', $errors);
//             $this->session->set_flashdata('input', $this->input->post());
//             redirect('login');

//         } else {

//             $username = htmlspecialchars($this->input->post('username'));
//             $pass = htmlspecialchars($this->input->post('password'));
//             $cek_login = $this->auth_model->cek_login($username);

//             if($cek_login == FALSE)
//             {

//                 $this->session->set_flashdata('error_login', 'Username yang Anda masukan tidak terdaftar.');
//                 redirect('login');

//             } else {

//                 if(password_verify($pass, $cek_login->password)){
//                     $this->session->set_userdata('id', $cek_login->id);
//                     $this->session->set_userdata('nama', $cek_login->nama);
//                     $this->session->set_userdata('username', $cek_login->username);
// 					$this->session->set_userdata('level', $cek_login->level);
// 					$this->session->set_userdata('masuk', TRUE);


//                     redirect('home');

//                 } else {

//                     $this->session->set_flashdata('error_login', 'Username atau password yang Anda masukan salah.');
//                     redirect('auth');

//                 }
//             }
//         }
//     }

//     public function logout()
//     {
//         $this->session->sess_destroy();
//         echo '<script>
//             alert("Sukses! Anda berhasil logout.");
//             window.location.href="'.base_url('login').'";
//             </script>';
//     }
// }

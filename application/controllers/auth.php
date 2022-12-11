<?php 
class Auth extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}


	public function index()
	{
		if ($this->session->userdata('email')){
			switch($this->session->userdata('role_id')){
				case 1 : redirect('admin/home_admin');
				break;
				case 2 : redirect('home');
				break;
				default : break;
			}
		}else{
			$this->form_validation->set_rules('email','Email','required|trim|valid_email',
				[	'required' =>	'Email Wajib Diisi!']);
			$this->form_validation->set_rules('password','Passsword','required|trim',
				[	'required' => 'Password Harus Di isi']);

			if($this->form_validation->run() == false)
			{
				$data['title'] ='Login';
				$this->load->view('auth/header',$data);
				$this->load->view('auth/login');
				$this->load->view('auth/footer');
			}else{
				$this->_login();
			}
		}
	}


	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$where = array( 'email' => $email);
		$user = $this->model_user->cari($where,'tb_user')->row_array();
		if ($user != null){
			if (password_verify($password,$user['password']))
			{
				$data = [
					'id_user'	=>	$user['id_user'],
					'nama'		=>	$user['nama'],
					'email' 	=>	$user['email'],
					'role_id' 	=> 	$user['role_id']
				];
				$this->session->set_userdata($data);
				switch($this->session->userdata('role_id')){
					case 1 : redirect('admin/home_admin');
					break;
					case 2 : redirect('home');
					break;
					default : break;
				}
			}else{ 
				$this->session->set_flashdata('message',
					'<div class="alert alert-danger" role="alert">Password Anda Salah!</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message',
				'<div class="alert alert-danger" role="alert">Email tidak Terdaftar. Silahkan Registrasi!</div>');
			redirect('auth');
		}
	}


	public function registrasi()
	{
		$this->form_validation->set_rules('nama','Nama','required',
			[ 	'required' => 'Nama Lengkap Wajib Diisi']);
		$this->form_validation->set_rules('email','Email','required|trim|valid_email',
			[	'required' =>	'Email Wajib Diisi!']);
		$this->form_validation->set_rules('password1','Passsword','required|trim|min_length[5]|matches[password2]',[
			'required' => 'Password Harus Di isi',
			'matches' => 'Password Harus Sama',
			'min_length' => 'Password Terlalu Pendek']);
		$this->form_validation->set_rules('password2','Passsword','required|trim|matches[password1]',[
			'required' => 'Password Harus Di isi',
			'matches' => 'Password Harus Sama']);
		if ($this->form_validation->run() == false)
		{
			$data['title'] = 'User Registration';
			$this->load->view('auth/header',$data);
			$this->load->view('auth/registrasi');
			$this->load->view('auth/footer');
		}else{
			$data = [
				'nama'		=> htmlspecialchars($this->input->post('nama',true)),
				'email'		=> htmlspecialchars($this->input->post('email',true)),
				'password'	=> password_hash($this->input->post('password1'),(PASSWORD_DEFAULT)),
				'role_id'	=> 2,
			];

			$this->model_user->regis($data, 'tb_user');
			$this->session->set_flashdata('message',
				'<div class="alert alert-success" role="alert">Akun Berhasil Di Registrasi. Silahkan Login!</div>');

			redirect('auth');
		}	
	}


	public function logout()
	{
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->cart->destroy();
		$this->session->set_flashdata('message',
			'<div class="alert alert-success" role="alert">Anda Berhasil Logout!</div>');
		redirect('auth');

	}


	public function info_akun()
	{
		if(is_null($this->session->userdata('role_id'))){
			$this->session->set_flashdata('message',
				'<div class="alert alert-danger" role="alert">Akses Ditolak!</div>');
			redirect('auth');
		}else{
			if ($this->session->userdata('role_id') == 2){
				$data['title'] = 'Info User ';
				$this->load->view('templates/header',$data);
				$this->load->view('templates/navbar');
				$this->load->view('templates/sidebar');
				$this->load->view('auth/userdata');
				$this->load->view('templates/footer');	
			}elseif ($this->session->userdata('role_id') == 1){
				$data['title'] = 'Info Admin ';
				$this->load->view('templates_admin/header',$data);
				$this->load->view('templates_admin/sidebar');
				$this->load->view('templates_admin/navbar');
				$this->load->view('auth/userdata'); 
				$this->load->view('templates_admin/footer');
			}
		}
	}


	public function ganti_nama()
	{

		$where = array('email'=> $this->session->userdata('email'));
		$user = $this->model_user->cari($where,'tb_user')->row_array();
		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('password','Passsword','required|trim');
		if($this->form_validation->run()== false)
		{
			$this->session->set_flashdata('message',
				'<div class="alert alert-danger" role="alert">Data Yang Di Masukan Tidak Valid</div>');
			redirect('auth/info_akun');
		}else{
			$password_lama 	= $this->input->post('password');
			$nama_baru		= $this->input->post('nama');
			if(!password_verify($password_lama, $user['password']))
			{
				$this->session->set_flashdata('message',
					'<div class="alert alert-danger" role="alert">Password Anda Salah!</div>');
				redirect('auth/info_akun');
			}else{
				$id = $this->session->userdata('id_user');
				$update = array('nama' => $nama_baru);
				$where = array( 'id_user' => $id);
				$this->model_user->update_data($where,$update,'tb_user');
				$user = $this->model_user->cari($where,'tb_user')->row_array();
				$session = [
					'id_user'	=>	$user['id_user'],
					'nama'		=>	$user['nama'],
					'email' 	=>	$user['email'],
					'role_id' 	=> 	$user['role_id']
				];
				$this->session->set_userdata($session);
				$this->session->set_flashdata('message',
					'<div class="alert alert-success" role="alert">Nama Lengkap Anda Berhasil Di Ubah</div>');
				redirect('auth/info_akun');
			}
		}
	}


	public function ganti_email()
	{
		$where = array('email'=> $this->session->userdata('email'));
		$user = $this->model_user->cari($where,'tb_user')->row_array();
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		$this->form_validation->set_rules('password','Passsword','required|trim');
		if($this->form_validation->run()== false)
		{
			$this->session->set_flashdata('message',
				'<div class="alert alert-danger" role="alert">Data Yang Di Masukan Tidak Valid</div>');
			redirect('auth/info_akun');
		}else{
			$password_lama 	= $this->input->post('password');
			$email_baru		= $this->input->post('email');
			if(!password_verify($password_lama, $user['password']))
			{
				$this->session->set_flashdata('message',
					'<div class="alert alert-danger" role="alert">Password Anda Salah!</div>');
				redirect('auth/info_akun');
			}else{
				$id = $this->session->userdata('id_user');
				$update = array('email' => $email_baru);
				$where = array( 'id_user' => $id);
				$this->model_user->update_data($where,$update,'tb_user');
				$user = $this->model_user->cari($where,'tb_user')->row_array();
				$session = [
					'id_user'	=>	$user['id_user'],
					'nama'		=>	$user['nama'],
					'email' 	=>	$user['email'],
					'role_id' 	=> 	$user['role_id']
				];
				$this->session->set_userdata($session);
				$this->session->set_flashdata('message',
					'<div class="alert alert-success" role="alert">Email Anda Berhasil Di Ubah</div>');
				redirect('auth/info_akun');
			}
		}
	}


	public function ganti_password()
	{
		$where = array('email'=> $this->session->userdata('email'));
		$user = $this->model_user->cari($where,'tb_user')->row_array();
		$this->form_validation->set_rules('password','Passsword','required|trim');
		$this->form_validation->set_rules('password_baru','Passsword','required|trim|min_length[5]|matches[password_baru2]');
		$this->form_validation->set_rules('password_baru2','Passsword','required|trim|min_length[5]|matches[password_baru]');
		if($this->form_validation->run()== false)
		{
			$this->session->set_flashdata('message',
				'<div class="alert alert-danger" role="alert">Data Yang Di Masukan Tidak Valid</div>');
			redirect('auth/info_akun');
		}else{
			$password_lama 	= $this->input->post('password');
			$password_baru	= $this->input->post('password_baru');
			if(!password_verify($password_lama, $user['password']))
			{
				$this->session->set_flashdata('message',
					'<div class="alert alert-danger" role="alert">Password Anda Salah!</div>');
				redirect('auth/info_akun');
			}else{
				if($password_lama == $password_baru)
				{
					$this->session->set_flashdata('message',
						'<div class="alert alert-danger" role="alert">Password Baru Tidak Boleh Sama Dengan Password Lama!</div>');
					redirect('auth/info_akun');
				}else{
					$id = $this->session->userdata('id_user');
					$password_hash = password_hash($password_baru,(PASSWORD_DEFAULT));
					$update = array('password' => $password_hash);
					$where = array( 'id_user' => $id);
					$this->model_user->update_data($where,$update,'tb_user');
					$user = $this->model_user->cari($where,'tb_user')->row_array();
					$session = [
						'id_user'	=>	$user['id_user'],
						'nama'		=>	$user['nama'],
						'email' 	=>	$user['email'],
						'role_id' 	=> 	$user['role_id']
					];
					$this->session->set_userdata($session);
					$this->session->set_flashdata('message',
						'<div class="alert alert-success" role="alert">Password Anda Berhasil Di Ubah</div>');
					redirect('auth/info_akun');
				}		
			}
		}
	}


	public function reset_password()
	{
		$id 	= $this->input->post('id');
		$where = array('id_user'=> $id);
		$user = $this->model_user->cari($where,'tb_user')->row_array();
		$reset = 'userpassword';
		$password = password_hash($reset,(PASSWORD_DEFAULT));
		$update = array('password' => $password);
		$where = array( 'id_user' => $id);
		$this->model_user->update_data($where,$update,'tb_user');
		$this->session->set_flashdata('message',
			'<div class="alert alert-success" role="alert">Password User Berhasil Di Reset!</div>');
		redirect('admin/home_admin');
	}
}
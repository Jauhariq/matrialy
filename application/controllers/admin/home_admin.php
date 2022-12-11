<?php 
class Home_admin extends CI_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') !="1"){
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Anda belum login!!!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth/index');
		}
	}

	
	public function index()
	{
		$data['total_produk'] = $this->model_produk->hitungproduk();
		$data['total_pesanan'] = $this->model_produk->hitungpesanan();
		$data['total_user']		= $this->model_produk->hitunguser();
		$data['user'] = $this->model_user->tampiluser()->result();
		$data['title'] = 'Materialy - Admin';
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar',$data);
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/home',$data);
		$this->load->view('templates_admin/footer');
	}
}
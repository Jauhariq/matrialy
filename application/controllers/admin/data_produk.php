<?php 
class Data_produk extends CI_Controller{
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
		$data['title'] = 'Data Produk';
		$data['produk']= $this->model_produk->tampilDataAdmin()->result();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/data_produk',$data);
		$this->load->view('templates_admin/footer');
	}


	public function tambah()
	{
		$nama_produk 	= $this->input->post('nama_produk');
		$kategori 		= $this->input->post('kategori');
		$harga 			= $this->input->post('harga');
		$stok 			= $this->input->post('stok');
		$gambar 		= $_FILES['gambar']['name'];
		$config ['upload_path']='./assets/gambar/upload';
		$config ['allowed_types']='jpg|jpeg|png';
		$namaGambar = uniqid();
		$config ['file_name'] = $namaGambar ;
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('gambar'))
		{
			$this->session->set_flashdata('gambar',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Gambar Gagal Di Upload !</strong></div></div>');
		}else{
			$gambar=$this->upload->data('file_name');
		}
		$data = array (
			'nama_produk' 	=> $nama_produk,
			'kategori'		=> $kategori,
			'harga'			=> $harga,
			'stok'			=> $stok,
			'gambar'		=> $gambar
		);
		$this->model_produk->tambah($data, 'tb_produk');
		$this->session->set_flashdata('message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Produk Berhasil Ditambahkan !</strong></div></div>');
		redirect('admin/data_produk/index');
	}


	public function edit($id)
	{
		$data['title'] = 'Edit Produk';
		$where = array ('id_produk' => $id);
		$data['produk'] = $this->model_produk->edit_produk($where,'tb_produk')->result();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/edit_produk',$data);
		$this->load->view('templates_admin/footer');
	}


	public function update()
	{
		$id 			= $this->input->post('id_produk');
		$nama_produk 	= $this->input->post('nama_produk');
		$kategori 		= $this->input->post('kategori');
		$harga 			= $this->input->post('harga');
		$stok 			= $this->input->post('stok');
		$data = array(
			'nama_produk' 	=> $nama_produk,
			'kategori'		=> $kategori,
			'harga'			=> $harga,
			'stok'			=> $stok
		);
		$where = array(
			'id_produk'		=> $id
		);
		$this->model_produk->update_data($where,$data,'tb_produk');
		$this->session->set_flashdata('message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Produk Berhasil Diperbarui !</strong></div></div>');
		redirect('admin/data_produk/index');
	}


	public function hapus($id)
	{
		$where = array(
			'id_produk' => $id
		);
		$this->model_produk->hapus_data($where,'tb_produk');
		redirect('admin/data_produk/index');	
	}


	public function edit_gambar()
	{
		$id 	= $this->input->post('id_produk');
		$gambar = $_FILES['gambar']['name'];
		$config ['upload_path']='./assets/gambar/upload';
		$config ['allowed_types']='jpg|jpeg|png';
		$namaGambar = uniqid();
		$config ['file_name'] = $namaGambar ;
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('gambar'))
		{
			echo $this->upload->display_error();
		}else{
			$gambar=$this->upload->data('file_name');
		} 
		$data = array(
			'gambar'		=> $gambar
		);
		$where = array(
			'id_produk'		=> $id
		);
		$this->model_produk->update_data($where,$data,'tb_produk');
		$this->session->set_flashdata('message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Gambar Berhasil Diperbarui !</strong></div></div>');
		redirect('admin/data_produk/edit/'.$id);
	}
}
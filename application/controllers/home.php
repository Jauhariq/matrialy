<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') !="2"){
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
		$data['produk'] = $this->model_produk->tampilData()->result();
		$data['title'] = 'Matrialy Home';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('home', $data);
		$this->load->view('templates/footer');
	}


	public function tambah_ke_keranjang($id)
	{	

		$qty		= 	$this->input->post('qty');
		$produk = $this->model_produk->cari($id);
		$data = array(
			'id'      => $id,
			'qty'     => $qty,
			'price'   => $produk->harga,
			'name'    => $produk->nama_produk,
			'gambar'  => $produk->gambar,
			'stok'	  => $produk->stok
		);
		if ($qty > $produk->stok){
			$this->session->set_flashdata('message',
				'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Stok Tersisa hanya '.$produk->stok.'</strong></div></div>');
			redirect('home/index'); 
		}else{

			$this->cart->insert($data);
			$this->session->set_flashdata('message',
				'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Produk ditambahkan ke Keranjang</strong></div></div>');
			redirect('home/index'); 
		}
	}


	public function update_keranjang()
	{
		$row = $this->input->post('rowid');
		$qty = $this->input->post('qty');
		$stok = $this->input->post('stok');
		$data = array( 
			'rowid' => $row,
			'qty' => $qty);
		if ($qty > $stok){
			$this->session->set_flashdata('message',
				'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Stok Tersisa Hanya  '.$stok.' </strong></div></div>');
			redirect('home/detail_keranjang');
		}else{
			$this->cart->update($data);
			$this->session->set_flashdata('message',
				'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Jumlah Pembelian Berhasil Di ubah</strong></div></div>');
			redirect('home/detail_keranjang');
		}
	}


	public function detail_keranjang() 
	{
		$data['title'] = 'Keranjang';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('keranjang');
		$this->load->view('templates/footer');
	}


	public function hapus_keranjang()
	{
		$this->cart->destroy();
		$this->session->set_flashdata('message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Produk di hapus dari keranjang !</strong></div></div>');
		redirect('home/index');
	}


	public function pemesanan()
	{
		$data['title'] = 'Pembayaran';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('pemesanan');
		$this->load->view('templates/footer');
	}


	public function hapus_item_keranjang($rowid)
	{	
		$this->cart->remove($rowid);
		$this->session->set_flashdata('message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Produk di hapus dari keranjang !</strong></div></div>');
		redirect('home/detail_keranjang'); 
	}


	public function proses_pesanan()
	{	
		$is_processed = $this->model_invoice->index();
		if ($is_processed){
			$this->cart->destroy();
			$this->session->set_flashdata('message',
				'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert">Pesanan di Proses! Silahkan Lakukan Pembayaran Pada menu<strong>Pesanan Saya</strong></div></div>');
			redirect('home/pesanan_saya');
		}else{
			echo 'Maaf, Pesanan anda Gagal Diproses!';
		} 
	}


	public function pesanan_saya()
	{	
		$id_user = $this->session->userdata('id_user');
		$data['invoice'] = $this->model_invoice->pesananku($id_user);
		$this->session->set_flashdata('pesanan',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-info mx-auto" align="center" role="alert"><strong>Anda belum memesan produk!</strong></div></div>');
		$data['title'] = 'Pesanan Saya';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('pesanan',$data);
		$this->load->view('templates/footer');
	}


	public function detail_pesanan()
	{
		$id_invoice = $this->input->post('id');
		$data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
		$data['title'] = 'Detail Pesanan';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('detail_pesanan',$data);
		$this->load->view('templates/footer');
	}


	public function cari_barang()
	{
		$kata = $this->input->post('cari');
		$data['produk'] = $this->model_produk->cari_produk($kata);
		$data['title'] = 'Hasil Pencarian';
		$this->load->view('templates/header',$data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/sidebar');
		$this->load->view('home', $data);
		$this->load->view('templates/footer');
	}

	
	public function bayar()
	{
		$id_invoice = $this->input->post('id_invoice');
		$gambar 		= $_FILES['gambar']['name'];
		$config ['upload_path']='./assets/gambar/bayar';
		$config ['allowed_types']='jpg|jpeg|png';
		$namaGambar = uniqid();
		$config ['file_name'] = $namaGambar ;
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('gambar'))
		{
			$this->session->set_flashdata('info',
				'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-danger mx-auto" align="center" role="alert"><strong>Gambar Gagal Di Upload</strong></div></div>');
			redirect('home/pesanan_saya');
			die;
		}else{
			$gambar=$this->upload->data('file_name');

		}
		$data = array (
			'id_invoice' 	=> $id_invoice,
			'gambar'		=> $gambar
		);
		$where = array(
			'id_invoice' => $id_invoice);
		$update = array(
			'status' 	=> 'Sedang Diproses');
		$this->model_invoice->bayar($data, 'tb_buktibayar');
		$this->model_invoice->update_data($where,$update,'tb_invoice');
		redirect('home/pesanan_saya');
	}
}

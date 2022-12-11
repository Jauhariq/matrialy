<?php 
class Invoice extends CI_Controller{
	public function __construct(){
		parent::__construct();

		if($this->session->userdata('role_id') !="1"){
			$this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Akses Ditolak, Silahkan Login!!!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth/index');
		}
	}


	public function index()
	{
		$data['title']	 = 'Invoice';
		$data['invoice'] = $this->model_invoice->tampilData();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/invoice',$data);
		$this->load->view('templates_admin/footer');
	}


	public function detail($id_invoice)
	{
		$data['title']	 = 'Invoice';
		$data['invoice'] = $this->model_invoice->ambil_id_invoice($id_invoice);
		$data['pesanan'] = $this->model_invoice->ambil_id_pesanan($id_invoice);
		$data['bukti']	 = $this->model_invoice->ambil_bukti($id_invoice);
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/detail_invoice',$data);
		$this->load->view('templates_admin/footer');
	}


	public function konfirmasi($id_invoice)
	{
		$data = array(
			'keterangan' => 'Proses Pengiriman',
			'status' 	 =>	'Pembayaran Berhasil'
		);
		$where = array(
			'id_invoice' => $id_invoice
		);
		$this->model_invoice->update_data($where,$data,'tb_invoice');
		$this->session->set_flashdata('message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Pembayaran Dikonfirmasi !</strong></div></div>');
		redirect('admin/invoice');
	}


	public function selesai($id_invoice)
	{
		$data = array(
			'keterangan' => 'Barang Sampai'
		);
		$where = array(
			'id_invoice' => $id_invoice
		);
		$this->model_invoice->update_data($where,$data,'tb_invoice');
		$this->session->set_flashdata('message',
			'<div class= "pt-2 pl-3 pr-3"><div class="alert alert-success mx-auto" align="center" role="alert"><strong>Transaksi Selesai !</strong></div></div>');
		redirect('admin/invoice');
	}
	public function menunggu_pembayaran()
	{
		$data['title']	 = 'Invoice';
		$data['invoice'] = $this->model_invoice->menunggu_pembayaran();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/invoice',$data);
		$this->load->view('templates_admin/footer');
	}
	public function proses_pengiriman()
	{
		$data['title']	 = 'Invoice';
		$data['invoice'] = $this->model_invoice->proses_pengiriman();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/invoice',$data);
		$this->load->view('templates_admin/footer');
	}
	public function sukses()
	{
		$data['title']	 = 'Invoice';
		$data['invoice'] = $this->model_invoice->sukses();
		$this->load->view('templates_admin/header',$data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('templates_admin/navbar');
		$this->load->view('admin/invoice',$data);
		$this->load->view('templates_admin/footer');
	}
}
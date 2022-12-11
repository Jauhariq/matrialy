<?php 
class Model_invoice extends CI_Model{
	public function index()
	{
		date_default_timezone_set('Asia/Jakarta');
		$nama_pemesan		= $this->input->post('nama');
		$alamat				= $this->input->post('alamat');
		$no_tlp				= $this->input->post('no_tlp');
		$id_user 			= $this->session->userdata('id_user');
		$invoice 			= array(
			'nama_pemesan'		=> $nama_pemesan,
			'alamat'			=> $alamat,
			'no_tlp'			=> $no_tlp,
			'tgl_pesan'			=> date('y-m-d H:i:s'),
			'keterangan'		=> 'Menunggu Pembayaran',
			'status'			=> 'Belum Dibayar',
			'id_user'			=> $id_user
		);
		$this->db->insert('tb_invoice', $invoice);
		$id_invoice = $this->db->insert_id();
		foreach ( $this->cart->contents() as $items )
		{
			$data = array(
				'id_invoice'	=> $id_invoice,
				'id_produk'		=> $items['id'],
				'nama_produk'	=> $items['name'],
				'jumlah'		=> $items['qty'],
				'harga'			=> $items['price']
			);
			$this->db->insert('tb_pesanan',$data);
		}
		return TRUE;
	}
	public function tampilData()
	{
		$result = $this->db->from('tb_invoice')->order_by('id_invoice','desc')->get();
		return $result->result();
	}
	public function ambil_id_invoice($id_invoice)
	{
		$result = $this->db->where('id_invoice',$id_invoice)->limit(1)->get('tb_invoice');
		if ($result->num_rows() > 0 ){
			return $result->row();
		}else{
			return false;
		}
	} 
	public function ambil_id_pesanan($id_invoice)
	{
		// $result = $this->db->where('id_invoice',$id_invoice)->get('tb_pesanan');
		$result = $this->db->select('*')->from('tb_pesanan')->where('id_invoice',$id_invoice)->join('tb_produk','tb_produk.id_produk = tb_pesanan.id_produk')->get();
		if ($result->num_rows() > 0 ){
			return $result->result();
		}else{
			return false;
		}
	}
	public function pesananku($id_user)
	{
		$result = $this->db->where('id_user',$id_user)->order_by('id_invoice','desc')->get('tb_invoice');
		if ($result->num_rows() > 0 ){
			return $result->result();
		}else{
			return false;
		}
	}
	public function bayar($data,$table)
	{
		$this->db->insert($table,$data);
	}
	public function update_data($where,$update,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$update);
	}
	public function ambil_bukti($id_invoice)
	{
		$result = $this->db->where('id_invoice',$id_invoice)->get('tb_buktibayar');
		if ($result->num_rows() > 0 ){
			return $result->result();
		}else{
			return false;
		}
	}
	public function menunggu_pembayaran()
	{
		$ket = 'Menunggu Pembayaran';
		$result = $this->db->from('tb_invoice')->where('keterangan',$ket)->order_by('id_invoice','desc')->get();
		return $result->result();
	}
	public function proses_pengiriman()
	{
		$ket = 'Proses Pengiriman';
		$result = $this->db->from('tb_invoice')->where('keterangan',$ket)->order_by('id_invoice','desc')->get();
		return $result->result();
	}
	public function sukses()
	{
		$ket = 'Barang Sampai';
		$result = $this->db->from('tb_invoice')->where('keterangan',$ket)->order_by('id_invoice','desc')->get();
		return $result->result();
	}
}
<?php 
class Model_produk extends CI_Model{
	public function tampilData(){
		return $this->db->where(array('stok !=' => 0))->get('tb_produk');
	}
	public function tampilDataAdmin(){
		return $this->db->get('tb_produk');
	}
	public function tambah($data,$table){
		$this->db->insert($table,$data);
	}
	public function edit_produk($where,$table){
		return $this->db->get_where($table,$where);
	}
	public function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	public function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function cari($id)
	{
		$result = $this->db->where('id_produk',$id)->limit(1)->get('tb_produk');
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return array();
		}
	}
	public function cari_produk($kata)
	{
		$result = $this->db->like('nama_produk',$kata)->where(array('stok !=' => 0))->get('tb_produk');
		if($result->num_rows() > 0){
			return $result->result();
		}else{
			return false;
		}
	}
	public function hitungproduk()
	{
		return $this->db->get('tb_produk')->num_rows();
	}
	public function hitungpesanan()
	{
		return $this->db->get('tb_invoice')->num_rows();
	}
	public function hitunguser()
	{
		return $this->db->where('role_id','2')->get('tb_user')->num_rows();
	}
}



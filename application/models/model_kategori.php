<?php 
class Model_kategori extends CI_Model{
	public function data_peralatan()
	{
		return $this->db->get_where('tb_produk',array('kategori' => 'peralatan'));
	}
	public function data_cat()
	{
		return $this->db->get_where('tb_produk',array('kategori' => 'cat'));
	}
	public function data_kayubesi()
	{
		return $this->db->get_where('tb_produk',array('kategori' => 'kayu dan besi'));
	}
	public function data_lainnya()
	{
		return $this->db->get_where('tb_produk',array('kategori' => 'lainnya'));
	}
}
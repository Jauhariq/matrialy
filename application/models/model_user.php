<?php

class Model_user extends CI_Model{
	public function regis($data,$table){
		$this->db->insert($table,$data);
	}
	public function cari($where,$table){
		return $this->db->get_where($table,$where);
	}
	public function update_data($where,$update,$table){
		$this->db->where($where);
		$this->db->update($table,$update);
	}
	public function tampiluser(){
		return $this->db->get_where('tb_user',array('role_id' => 2));
	}
}
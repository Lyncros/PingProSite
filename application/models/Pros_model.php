<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pros_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->table = 'proveedor';
	}

	public function getpros()	{
		$this->db->select('*');
		$this->db->from($this->table);
		return $this->db->get()->result();
	}

	public function get_not_validated()	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('pago', 0);
		return $this->db->get()->result();
	}

	public function getpro($id)	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from($this->table);
		return $this->db->get()->result();
	}

	public function createpro($data) {
		if(!$data['pago']){$data['pago']="0";}
		if($this->db->insert($this->table, $data)) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function updatepro($data) {
		if($this->db->set($this->table, $data)) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function deletepro($id) {
		if($this->db->delete($this->table,$id)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file servicio_model.php */
/* Location: ./application/modules/home/models/servicio_model.php */
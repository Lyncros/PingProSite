<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->table = 'contacts';
	}

	public function getcontacts()	{
		$this->db->select('*');
		$this->db->from($this->table);
		return $this->db->get()->result();
	}

	public function getcontact($id)	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from($this->table); 
		return $this->db->get()->result();
	}

	public function createcontact($data) {
		$data['date_time']=date('Y-m-d h:i');
		if($this->db->insert($this->table, $data)) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function updatecontact($data) {
		if($this->db->set($this->table, $data)) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function deletecontact($id) {
		if($this->db->delete($this->table,$id)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file servicio_model.php */
/* Location: ./application/modules/home/models/servicio_model.php */
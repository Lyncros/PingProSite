<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->table = 'servicio';
		$this->pro_service_table = 'proveedor_servicio';
	}

	public function getservices()	{
		$this->db->select('id, nombre');
		$this->db->from($this->table);
		$this->db->where('estado', 1);
		$this->db->order_by('nombre', 'ASC');
		return $this->db->get()->result();
	}

	public function getallservices()	{
		$this->db->select('*');
		$this->db->from($this->table);
		return $this->db->get()->result();
	}

	public function getservice($id)	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from($this->table);
		return $this->db->get()->result();
	}

	public function getservices_by_pro($pro_id)	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join($this->proveedor_servicio, 'id = proveedorid');
		return $this->db->get()->result();
	}

	public function createservice($data) {
		$data['date_time']=date('Y-m-d h:i');
		if($this->db->insert($this->table, $data)) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function updateservice($data) {
		if($this->db->set($this->table, $data)) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function deleteservice($id) {
		if($this->db->delete($this->table,$id)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file servicio_model.php */
/* Location: ./application/modules/home/models/servicio_model.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pros extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

    function __construct() {
        parent::__construct();
        $this->load->model('contacts_model');
        $this->load->helper('form'); 
    }

	public function index()
	{
		$this->load->view('pros');
	}


	public function newcontact(){
		$data = $this->_put_args;
		$data['date_time'] = date('Y-m-d h:i');
		
		try {
			$id = $this->contacts_model->createcontact($data);
			print_r($id);
		} catch (Exception $e) {
			$this->response(array('error' => $e->getMessage()), $e->getCode());
		}
		if ($id) {
			$contact = $this->contacts_model->getcontact($id);
		} else {
			echo "error";
		}
	}
}
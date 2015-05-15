<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package	CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author	Adam Whitney
 * @link	http://outergalactic.org/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Contacts extends REST_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('contacts_model');
    }

    function index_get($id = '')
    {	
    	if (!$id) { $id = $this->get('id'); }
    	if (!$id)
    	{
    	$contacts = $this->contacts_model->getcontacts();	
    		if($contacts)
    			$this->response($contacts, 200); // 200 being the HTTP response code
    		else
    			$this->response(array('error' => 'Couldn\'t find any contacts!'), 404);
    	}

        $contact = $this->contacts_model->getcontact($id);

        if($contact)
            $this->response($contact, 200); // 200 being the HTTP response code
        else
            $this->response(array('error' => 'contact could not be found'), 404);
    }
    
    function index_post()
    {
		$data = $this->_post_args;

		try {
			$id = $this->contacts_model->createcontact($data);
			//throw new Exception('Invalid request data', 400); // test code
			//throw new Exception('contact already exists', 409); // test code
		} catch (Exception $e) {
			// Here the model can throw exceptions like the following:
			//new Exception('Invalid request data', 400)
			//new Exception('contact already exists', 409)
			$this->response(array('error' => $e->getMessage()), $e->getCode());
		}
		if ($id) {
			//$contact = array('id' => $id, 'name' => $data['name']); // test code
			$contact = $this->contacts_model->getcontact($id);
			$this->response($contact, 201); // 201 being the HTTP response code
		} else
			$this->response(array('error' => 'contact could not be created'), 404);
    }
    
    public function index_put()
    {
		$data = $this->_put_args;
		try {
			$id = $this->contacts_model->updatecontact($data);
			throw new Exception('Invalid request data', 400); // test code
		} catch (Exception $e) {
			// Here the model can throw exceptions like the following:
			// * For invalid input data: new Exception('Invalid request data', 400)
			// * For a conflict when attempting to create, like a resubmit: new Exception('contact already exists', 409)
			$this->response(array('error' => $e->getMessage()), $e->getCode());
		}
		if ($id) {
			//$contact = array('id' => $data['id'], 'name' => $data['name']); // test code
			$contact = $this->contacts_model->getcontact($id);
			$this->response($contact, 200); // 200 being the HTTP response code
		} else
			$this->response(array('error' => 'contact could not be found'), 404);
    }
        
    function index_delete($id = '')
    {
    	    	
    	if (!$id) { $id = $this->get('id'); }
    	if (!$id)
    	{
    		$this->response(array('error' => 'An ID must be supplied to delete a contact'), 400);
    	}

        $contact = $this->contacts_model->getcontact($id);

    	if($contact) {
    		try {
    			$this->contacts_model->deletecontact($id);
    			//throw new Exception('Forbidden', 403); // test code
    		} catch (Exception $e) {
    			// Here the model can throw exceptions like the following:
    			// * Client is not authorized: new Exception('Forbidden', 403)
    			$this->response(array('error' => $e->getMessage()), $e->getCode());
    		}
    		$this->response($contact, 200); // 200 being the HTTP response code
    	} else
    		$this->response(array('error' => 'contact could not be found'), 404);
    }
}

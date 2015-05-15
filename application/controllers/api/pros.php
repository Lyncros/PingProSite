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

class Pros extends REST_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model('pros_model');
    }

    function index_get($id = '')
    {	
    	if (!$id) { $id = $this->get('id'); }
    	if (!$id)
    	{
    	$pros = $this->pros_model->getpros();	
    		if($pros)
    			$this->response($pros, 200); // 200 being the HTTP response code
    		else
    			$this->response(array('error' => 'Couldn\'t find any pros!'), 404);
    	}

        $pro = $this->pros_model->getpro($id);

        if($pro)
            $this->response($pro, 200); // 200 being the HTTP response code
        else
            $this->response(array('error' => 'pro could not be found'), 404);
    }

    function notvalidated_get(){
        $pros = $this->pros_model->get_not_validated();   
            if($pros)
                $this->response($pros, 200); // 200 being the HTTP response code
            else
                $this->response(array('error' => 'Couldn\'t find any Not Validated Pros'), 404);
    }
    
    function index_post()
    {
		$data = $this->_post_args;

		try {
			$id = $this->pros_model->createpro($data);
			//throw new Exception('Invalid request data', 400); // test code
			//throw new Exception('pro already exists', 409); // test code
		} catch (Exception $e) {
			// Here the model can throw exceptions like the following:
			//new Exception('Invalid request data', 400)
			//new Exception('pro already exists', 409)
			$this->response(array('error' => $e->getMessage()), $e->getCode());
		}
		if ($id) {
			//$pro = array('id' => $id, 'name' => $data['name']); // test code
			$pro = $this->pros_model->getpro($id);
			$this->response($pro, 201); // 201 being the HTTP response code
		} else
			$this->response(array('error' => 'pro could not be created'), 404);
    }
    
    public function index_put()
    {
		$data = $this->_put_args;
		try {
			$id = $this->pros_model->updatepro($data);
			throw new Exception('Invalid request data', 400); // test code
		} catch (Exception $e) {
			// Here the model can throw exceptions like the following:
			// * For invalid input data: new Exception('Invalid request data', 400)
			// * For a conflict when attempting to create, like a resubmit: new Exception('pro already exists', 409)
			$this->response(array('error' => $e->getMessage()), $e->getCode());
		}
		if ($id) {
			//$pro = array('id' => $data['id'], 'name' => $data['name']); // test code
			$pro = $this->pros_model->getpro($id);
			$this->response($pro, 200); // 200 being the HTTP response code
		} else
			$this->response(array('error' => 'pro could not be found'), 404);
    }
        
    function index_delete($id = '')
    {
    	    	
    	if (!$id) { $id = $this->get('id'); }
    	if (!$id)
    	{
    		$this->response(array('error' => 'An ID must be supplied to delete a pro'), 400);
    	}

        $pro = $this->pros_model->getpro($id);

    	if($pro) {
    		try {
    			$this->pros_model->deletepro($id);
    			//throw new Exception('Forbidden', 403); // test code
    		} catch (Exception $e) {
    			// Here the model can throw exceptions like the following:
    			// * Client is not authorized: new Exception('Forbidden', 403)
    			$this->response(array('error' => $e->getMessage()), $e->getCode());
    		}
    		$this->response($pro, 200); // 200 being the HTTP response code
    	} else
    		$this->response(array('error' => 'pro could not be found'), 404);
    }
}

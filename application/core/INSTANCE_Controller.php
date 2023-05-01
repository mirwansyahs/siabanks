<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class INSTANCE_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_instance');

		$this->instance = $this->M_instance->select_all();
		
	}

}

/* End of file MY_Auth.php */
/* Location: ./application/core/MY_Auth.php */
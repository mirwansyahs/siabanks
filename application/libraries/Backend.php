<?php
	class Backend {
		protected $_ci;

		function __construct() {
			$this->_ci = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
		}

		function views($template = NULL, $data = NULL) {
			if ($template != NULL) {
				$data['_header'] 				= $this->_ci->load->view('_layout/_backend/_header', $data, TRUE);
				//Menu
				$data['_menu'] 					= $this->_ci->load->view('_layout/_backend/_menu', $data, TRUE);
				//Sidebar
				$data['_sidebar'] 				= $this->_ci->load->view('_layout/_backend/_sidebar', $data, TRUE);
				// //Content
				$data['_mainContent'] 			= $this->_ci->load->view($template, $data, TRUE);
				$data['_content'] 				= $this->_ci->load->view('_layout/_backend/_content', $data, TRUE);
				// //Footer
				$data['_footer'] 				= $this->_ci->load->view('_layout/_backend/_footer', $data, TRUE);

				echo $data['_template'] 		= $this->_ci->load->view('_layout/_backend/_template', $data, TRUE);
			}
		}
	}
	
?>
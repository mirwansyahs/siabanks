<?php
	class Frontend {
		protected $_ci;

		function __construct() {
			$this->_ci = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
		}

		function views($template = NULL, $data = NULL) {
			if ($template != NULL) {
				$data['_header'] 				= $this->_ci->load->view('_layout/_frontend/_header', $data, TRUE);
				//menu
				$data['_menu'] 				= $this->_ci->load->view('_layout/_frontend/_menu', $data, TRUE);
				//sidebar
				$data['_sidebar'] 				= $this->_ci->load->view('_layout/_frontend/_sidebar', $data, TRUE);
				//Content
				$data['_mainContent'] 			= $this->_ci->load->view($template, $data, TRUE);
				$data['_content'] 				= $this->_ci->load->view('_layout/_frontend/_content', $data, TRUE);
				//Footer
				$data['_footer1'] 				= $this->_ci->load->view('_layout/_frontend/_footer1', $data, TRUE);
				$data['_footer2'] 				= $this->_ci->load->view('_layout/_frontend/_footer2', $data, TRUE);

				echo $data['_template'] 		= $this->_ci->load->view('_layout/_frontend/_template', $data, TRUE);
			}
		}
	}
	
?>
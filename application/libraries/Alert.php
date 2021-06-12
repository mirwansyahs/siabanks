<?php
	class Alert {
		protected $_ci;

		function __construct() {
			$this->_ci = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
		}

		function success($content = NULL, $text = NULL, $size = '14px') {
			$flash = '	<div class="alert alert-block alert-success">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>

							<p>
						      	<div style="font-size:' .$size .'">
						      		<i class="fa fa-check-circle"></i>
					        		<b>Success!</b> '.$content.' data berhasil. '.$text.'
					      		</div>
				      		</p>
					  	</div>';
			return $flash;
		}

		function info($content = NULL, $text = NULL, $size = '14px') {
			$flash = '	<div class="alert alert-block alert-info">
							<button type="button" class="close" data-dismiss="alert">
								<!--<i class="ace-icon fa fa-times"></i>-->
							</button>

							<p>
						      	<div style="font-size:' .$size .'">
						      		<i class="fa fa-info-circle"></i>
					        		<b>Perhatian!</b> '.$content.' '.$text.'
					      		</div>
				      		</p>
					  	</div>';
			return $flash;
		}

		function error($content = NULL, $text = NULL, $size = '14px') {
			$flash = '	<div class="alert alert-block alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>

							<p>
						      	<div style="font-size:' .$size .'">
						      		<i class="fa fa-warning"></i>
					        		 <b>Failed!</b> '.$content.' data gagal. '.$text.'
					      		</div>
				      		</p>
					  	</div>';
			return $flash;
		}

		function failed($content = NULL, $text = NULL, $size = '12px') {
			$flash = '	<div class="alert alert-block alert-danger">
							<button type="button" class="close" data-dismiss="alert">
								<!--<i class="ace-icon fa fa-times"></i>-->
							</button>

							<p>
						      	<div style="font-size:' .$size .'">
						      		<i class="fa fa-warning"></i>
					        		 <b>Error!</b> '.$content.'. '.$text.'
					      		</div>
				      		</p>
					  	</div>';
			return $flash;
		}
	}

		
?>
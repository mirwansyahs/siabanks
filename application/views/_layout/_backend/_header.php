	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?=@$judul?> - SIABANKS</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="MobileOptimized" content="320"><meta content='SIABANKS - Adalah Sistem Informasi Aplikasi Bank Sampah, bertujuan agar dapat memberdayakan masyarakat dalam pengelolaan sampah.' name='description'/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="icon" href="<?=base_url()?>assets/images/resources/logo.png" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="<?=base_url()?>assets/images/resources/logo.png" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/fonts.googleapis.com.css" />

		<!-- page specific plugin styles form element 1 -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/chosen.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-colorpicker.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/select2.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-editable.min.css" />
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/colorbox.min.css" />
		
		<!-- ace styles -->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="<?=base_url()?>assets/css/ace-rtl.min.css" />


		<!-- <link rel="stylesheet" href="<?=base_url()?>assets/leaflet/leaflet.css" /> -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="<?=base_url()?>assets/js/ace-extra.min.js"></script>

  		<script src="<?php echo base_url('assets/ckeditor/ckeditor.js'); ?>"></script>

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="<?=base_url()?>assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="assets/js/jquery-1.11.3.min.js"></script>
		<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?=base_url()?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
		
		<!-- ace scripts -->
		<script src="<?=base_url()?>assets/js/ace-elements.min.js"></script>
		<script src="<?=base_url()?>assets/js/ace.min.js"></script>


		<!-- <script src="<?=base_url()?>assets/leaflet/leaflet.js"></script> -->
 <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>


<script src='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v1.11.1/mapbox-gl.css' rel='stylesheet' />


		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

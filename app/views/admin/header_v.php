<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Mudahurus.my | Sistem Pengurusan Pesanan Online</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico')?>" type="image/x-icon" />
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url()?>assets/dist/css/skins/skin-red.min.css" rel="stylesheet" type="text/css" />
	
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/blueimp-fileupload/css/jquery.fileupload.css');?>">
	
	<!-- jQuery Dynatable -->
	<link href="<?php echo base_url()?>assets/plugins/dynatable/jquery.dynatable.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<script type="text/javascript"> var base_url = '<?php echo base_url()?>'; </script>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/vendor/jquery.ui.widget.js');?>"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!-- jQuery Dynatable -->
	<script src="<?php echo base_url()?>assets/plugins/dynatable/jquery.dynatable.js" type="text/javascript"></script>
	
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/jquery.iframe-transport.js');?>"></script>
	<!-- The basic File Upload plugin -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/jquery.fileupload.js');?>"></script>
	<!-- The File Upload processing plugin -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/jquery.fileupload-process.js');?>"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/jquery.fileupload-image.js');?>"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/jquery.fileupload-audio.js');?>"></script>
	<!-- The File Upload video preview plugin -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/jquery.fileupload-video.js');?>"></script>
	<!-- The File Upload validation plugin -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/jquery.fileupload-validate.js');?>"></script>
	
	<!-- numeric field plugin -->
	<script src="<?php echo base_url('assets/js/jquery.numeric.js');?>"></script>
  </head>
  <body class="skin-red sidebar-mini">
    <div class="wrapper">
      <header class="main-header">

        <!-- Logo -->
        <a href="<?php echo base_url('dashboard')?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">&nbsp;</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">MUDAHURUS.MY</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			  <li>
				<a href="javascript:void(0);" onclick="editProfile()">Profile</a>
			  </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="user user-menu">
                <a href="<?php echo base_url()?>logout">Logout</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
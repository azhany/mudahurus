<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Mudahurus.my | Register</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico')?>" type="image/x-icon" />
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo base_url()?>assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<meta property="og:url"           content="<?php echo base_url()?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="MUDAHURUS.MY | Sistem Pengurusan Pesanan Online" />
	<meta property="og:description"   content="Sistem percuma untuk peniaga online menguruskan pesanan dan berpeluang mempunyai E-Store sendiri sebagai alternatif kepada E-Commerce." />
	<meta property="og:image"         content="<?php echo base_url('images/screenshot.jpg');?>" />

  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo base_url()?>"><b>MUDAHURUS.MY</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Fill in your info below</p>
		<div id="infoMessage" style="color: red;text-align: center;"><?php echo $message;?></div>
        <form action="<?php echo base_url()?>register" method="post">
		  <div class="form-group has-feedback">
            <input type="text" class="form-control" name="username" placeholder="Username" data-toggle="tooltip" data-placement="bottom auto" title="Perhatian! Username tidak boleh diedit selepas akaun ini didaftar! Maka, pilih dengan betul!"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
            <input type="text" class="form-control" name="company" placeholder="Store Name"/>
            <span class="glyphicon glyphicon-home form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">    
              <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="<?php echo base_url()?>login" class="text-center">Already registered? Login here</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
		$('[data-toggle="tooltip"]').tooltip();
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
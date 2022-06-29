<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sistem Pengurusan Tempahan Online - MudahUrus.my</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-responsive.min.css">
	<!-- Theme CSS -->
	<!--[if !IE]> -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css">
	<!-- <![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/style_ie.css">
	<![endif]-->

	<!-- jQuery -->
	<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>

	<!-- Just for demonstration -->
	<script src="<?php echo base_url()?>assets/js/demonstration.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo base_url()?>assets/js/application.min.js"></script>

</head>
<body class='login-body'>
	<div class="login-wrap">
		<h2>Sistem Pengurusan Tempahan Online <small>v1.0 Beta</small></h2>
		<div class="login">
			<form action="<?php echo base_url(ADMIN_FOLDER)?>login/verify/" method="post">
				<span><?php echo $info_result?></span>
				<div class="sep">&nbsp;</div>
				<div class="email"><input type="text" name="username" id="username" placeholder="Nama Pengguna" class='input-block-level'></div>
				<div class="pw">
					<input type="password" name="password" placeholder="Kata Laluan" class='input-block-level'>
				</div>
				<button type="submit" value="Sign In" class='button button-basic-darkblue btn-block'>Daftar Masuk</button>
			</form>
		</div>
	</div>
<script type="text/javascript">
username = document.getElementById('username');

if(username.value == '') {
	username.focus();
}
</script>
</body>

</html>
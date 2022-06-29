<!DOCTYPE html>
<html>
<head>
	<title>Sistem Pengurusan Pesanan Online | MUDAHURUS.MY</title>
	<!-- Theme stylesheet -->
	<link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/responsive.css" rel="stylesheet" type="text/css">
	<!-- Roboto Font stylesheet -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
	<!-- FontAwesome stylesheet -->
	<link href="<?php echo base_url()?>assets/css/font-awesome.min.css" rel="stylesheet">
	<!-- LayerSlider stylesheet -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/layerslider/css/layerslider.css" type="text/css">
	<link href="<?php echo base_url()?>assets/css/lightbox.css" rel="stylesheet" /> 
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<meta property="og:url"           content="<?php echo base_url()?>" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="MUDAHURUS.MY | Sistem Pengurusan Pesanan Online" />
	<meta property="og:description"   content="Sistem percuma untuk peniaga online menguruskan pesanan dan berpeluang mempunyai E-Store sendiri sebagai alternatif kepada E-Commerce." />
	<meta property="og:image"         content="<?php echo base_url('images/screenshot.jpg');?>" />
	<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico')?>" type="image/x-icon" />
	<style>
		@media only screen and (max-width: 650px) {
			#layerslider {
				height: 240px !important;
			}
			#sliderWraper {
				width: 270px !important;
			}
		}
	</style>
</head>
<body>
	<!--responsive menu placeholder-->
	<div id="followMenu">
		<div class="clear"></div>
	</div>
	<!--BEGIN TOP CONTAINER (slider&nav)-->
	<section id="topContainer">
		<div id="navigationWrap">
			<div id="head" class="row">
				<div class="three-col">
					<h2 style="color: white;margin-top: 25px;">MUDAHURUS.MY</h2>
				</div>
				<div class="nine-col last-col menuWrap">
					<ul class="mainMenu">
						<li>
							<a href="#aboutContainer">Ringkasan</a>
						</li>
						<li>
							<a href="#featureContainer">Ciri-ciri</a>
						</li>
						<li>
							<a href="#registerContainer">Daftar</a>
						</li>
					</ul>
					<div class="clear"></div>
				</div>
				<div class="clear"></div> 
			</div> 
		</div> 
		<!-- BEGIN SLIDER --> 
		<div id="sliderWraper" class="row"> 
			<div id="layerslider" style="width: 1170px;max-width: 1170px; height: 690px;"> 
				<!-- first slide --> 
				<div class="ls-slide"> 
					<p class="ls-l sliderText" style="top: 50px; left: 550px;" data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 50; durationin: 2000;"> 
						<span>Anda <i>Online Seller?</i></span><br/><font style="font-size: 38px;">Urusan jualan tidak teratur?</font>
					</p> 
				</div> 
				<!-- second slide --> 
				<div class="ls-slide"> 
					<p class="ls-l sliderText" style="top: 50px; left: 550px;" data-ls="offsetxin: 0; offsetxout : 0; offsetyin: 50; durationin: 2000;"> 
						<span>Memperkenalkan MUDAHURUS.MY</span><br/><font style="font-size: 38px;">Sistem Urus Pesanan Online</font>
					</p> 
				</div>
			</div> 
		</div> 
		<!-- END SLIDER --> 
		<div class="clear"></div>
	</section>
	<!--END TOP CONTAINER-->
	<!--BEGIN CONTENT WRAPPER-->
	<div id="contentWrapper">
	<!--add your own sections in this div-->
	<!--ABOUT CONTAINER-->
		<section id="aboutContainer" class="section-80-130 whiteBgSection">
			<img class="triangleTop" src="img/tri-white-top.png" alt="" />
			<div class="row">
				<div class="four-col">
					<div class="iconColWrap">
						<i class="fa fa-compass"></i>
						<h2>Mudah</h2>
						<p>Sistem yang sangat mudah digunakan oleh para Peniaga Atas Talian (<i>Online Seller</i>) tanpa ada fungsi-fungsi kompleks yang memeningkan dan juga sebagai <i>alternative</i> kepada penggunaan aplikasi web <i>e-commerce</i></p>
					</div>
				</div>
				<div class="four-col">
					<div class="iconColWrap">
						<i class="fa fa-columns"></i>
						<h2>Ringkas</h2>
						<p>Sistem ini menyediakan Antara Muka (<i>Interface</i>) yang ringkas dan <i>button</i> yang spesifik kepada fungsi yang diperlukan.</p>
					</div>
				</div>
				<div class="four-col last-col">
					<div class="iconColWrap">
						<i class="fa fa-check-square-o"></i>
						<h2>Berbaloi</h2>
						<p>Tiada yuran langganan untuk menggunakan sistem ini membuatkan semua Peniaga Atas Talian (<i>Online Seller</i>) mampu untuk menggunakan sistem ini.</p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</section>
		<!--END ABOUT CONTAINER-->
		<!--FEATURES CONTAINER-->
		<section id="featureContainer" class="section-80-80 grayBgSection">
			<h1 class="sectionTitle">Ciri-ciri</h1>
			<div class="titleSeparator"></div>
			<h3 class="sectionDescription">Ciri-ciri didalam aplikasi web ini</h3>
			<div class="separator80"></div>
			<div class="row">
				<!--desktop image-->
				<div class="twelve-col" style="text-align: center;margin-bottom: 40px;">
					<img src="<?php echo base_url()?>assets/img/demoimg/desktop.jpg" alt="Dashboard Image" />
				</div>
				<div class="twelve-col" style="text-align: center;margin-bottom: 40px;">
					<img src="<?php echo base_url()?>assets/img/demoimg/e-store.jpg" alt="E-Store Image" />
				</div>
				<!--left side icons-->
				<div class="six-col">
					<div class="iconRightColWrap">
						<i class="fa fa-users"></i>
						<div class="rightColTextWrap">
							<h2>Data Pelanggan</h2>
							<p><i>Create</i> data pelanggan baru dan menyimpan senarai data pelanggan.</p>
						</div>
						<div class="clear"></div>
					</div>
					<div class="iconRightColWrap">
						<i class="fa fa-tags"></i>
						<div class="rightColTextWrap">
							<h2>Data Produk</h2>
							<p><i>Create</i> data produk baru dan menyimpan senarai data produk.</p>
						</div>
						<div class="clear"></div>
					</div>
					<div class="iconRightColWrap">
						<i class="fa fa-th-list"></i>
						<div class="rightColTextWrap">
							<h2>Data Tempahan</h2>
							<p>Memaparkan tempahan terkini dan menyimpan senarai data tempahan.</p>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<!--right side icons-->
				<div class="six-col last-col">
					<div class="iconLeftColWrap">
						<i class="fa fa-shopping-cart"></i>
						<div class="leftColTextWrap">
							<h2>Simple E-Store</h2>
							<p>Anda boleh promosikan barang-barang jualan anda melalui E-Store yang disediakan secara <i>default</i>.</p>
						</div>
						<div class="clear"></div>
					</div>
					<div class="iconLeftColWrap">
						<i class="fa fa-truck"></i>
						<div class="leftColTextWrap">
							<h2>Tracking Barang POSLAJU</h2>
							<p>Pelanggan anda boleh semak status barang POSLAJU mereka secara terus di dalam E-Store anda.</p>
						</div>
						<div class="clear"></div>
					</div>
					<div class="iconLeftColWrap">
						<i class="fa fa fa-plus-circle"></i>
						<div class="leftColTextWrap">
							<h2>Dan banyak lagi!</h2>
							<p>Akan Datang!</p>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</section>
		<!--END FEATURES CONTAINER-->
		<section id="registerContainer" class="section-80-80 grayBgSection">
			<h1 class="sectionTitle">Daftar</h1>
			<div class="titleSeparator"></div>
			<p class="sectionDescription"><a href="<?php echo base_url()?>register">Daftar DISINI!</a></p>
			<p class="sectionDescription">PERCUMA!</p>
		</section>
		<!--BEGIN FOOTER WRAPPER-->
		<section id="footerContainer" class="section-160-30 footer">
			<div class="separator80"></div>
			<a href="http://mudahurus.my">
				<h2 style="color: white;">MUDAHURUS.MY</h2>
			</a>
			<div class="separator80"></div>
			<a href="mailto:bantuan@mudahurus.my" style="color: #FFFFFF;">
				<i class="fa del-fa fa-envelope"></i>
				bantuan@mudahurus.my
			</a>
			<div class="separator80"></div>
			<p>Copyright &copy; 2015<br/>FB : <a href="http://facebook.com/mudahurus.my" target="_blank">mudahurus.my</a> By <a href="http://azhany.com">Mohd Azhany</a></p>
		</section>
		<!--END FOOTER WRAPPER-->
	</div>
	<!--END CONTENT WRAPPER-->
	<!-- jQuery & GreenSock -->
	<script src="<?php echo base_url()?>assets/js/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/layerslider/js/greensock.js" type="text/javascript"></script> 
	<!-- LayerSlider script files -->
	<script src="<?php echo base_url()?>assets/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>assets/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
	<!-- Lightbox -->
	<script src="<?php echo base_url()?>assets/js/lightbox.min.js"></script>
	<!-- Shuffle.js (screens) -->
	<script src="<?php echo base_url()?>assets/js/jquery.shuffle.modernizr.js"></script>
	<!-- Layer Slider init -->
	<script type="text/javascript"> 
		$(document).ready(function(){ 
			$('#layerslider').layerSlider({ 
				thumbnailNavigation: 'disabled', 
				skinsPath: 'layerslider/skins/', 
				navPrevNext: false, 
				navStartStop: false, 
				showCircleTimer: false 
			}); 
		});
	</script>
	<!-- Theme JS -->
	<script src="<?php echo base_url()?>assets/js/delicioustheme.js" type="text/javascript"></script>
</body>
</html> 
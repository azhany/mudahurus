<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Borang - MudahUrus.my</title>

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
	
	<!-- button file upload plugin -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap-fileupload.min.css">

	<!-- jQuery -->
	<script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
	<!-- Old jquery functions -->
	<script src="<?php echo base_url()?>assets/js/jquery.migrate.min.js"></script>
	<!-- jQuery UI Core -->
	<script src="<?php echo base_url()?>assets/js/jquery.ui.core.min.js"></script>
	<!-- jQuery UI Widget -->
	<script src="<?php echo base_url()?>assets/js/jquery.ui.widget.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
	
	<!-- jQuery Iframe Transport -->
	<script src="<?php echo base_url()?>assets/js/jquery.iframe-transport.js"></script>

	<!-- Just for demonstration -->
	<script src="<?php echo base_url()?>assets/js/demonstration.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?php echo base_url()?>assets/js/application.min.js"></script>
	
	<!-- button file upload plugin -->
	<script src="<?php echo base_url()?>assets/js/bootstrap-fileupload.min.js"> </script>
	
	<!-- numeric field plugin -->
	<script src="<?php echo base_url()?>assets/js/jquery.numeric.js"></script>
	
	<!-- validation plugin -->
	<script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>

	<script>
		$(document).ready(function() {
			var navListItems = $('ul.setup-panel li a'),
		        allWells = $('.setup-content');
			
			allWells.hide();
			
			navListItems.click(function(e)
			{
				e.preventDefault();
				var $target = $($(this).attr('href')),
		            $item = $(this).closest('li');
		        
				if (!$item.hasClass('disabled')) {
					navListItems.closest('li').removeClass('active');
					$item.addClass('active');
					allWells.hide();
					$target.show();
				}
			});
			
			$('ul.setup-panel li.active a').trigger('click');
			
			$("#borang").validate({
				rules: {
					quantity : "required",
					full_name : "required",
					mailing_addr : "required",
					//mailing_addr2 : "required",
					postcode : "required",
					city : "required",
					state : "required",
					email : "required",
					contact_no : "required",
					userfile : "required"
				},
				messages: {
					quantity : "Kotak ini perlu diisi",
					full_name : "Kotak ini perlu diisi",
					mailing_addr : "Kotak ini perlu diisi",
					/*mailing_addr2 : "Kotak ini perlu diisi",*/
					postcode : "Kotak ini perlu diisi",
					city : "Kotak ini perlu diisi",
					state : "Kotak ini perlu diisi",
					email : "Kotak ini perlu diisi",
					contact_no : "Kotak ini perlu diisi",
					userfile : "Sila muat naik bukti pembayaran anda"
				},
				errorPlacement: function(error, element) {
					if (element.attr("name") == "userfile")
						{
						 error.appendTo(element.parent().parent().after());
						}
					else {
						error.appendTo(element.parent().after());
					}
				}
				
			});
			
			$("#activate-step-2").click(function(e) {
				if($("#borang").valid()) {
					$('ul.setup-panel li:eq(1)').removeClass('disabled');
					$('ul.setup-panel li a[href="#step-2"]').trigger('click');
					
					e.preventDefault();
				} else {
					alert("Sila isi kotak yang masih belum diisi");
				}
			});
			$("#activate-step-3").click(function(e) {
				if($("#borang").valid()) {
					$('ul.setup-panel li:eq(2)').removeClass('disabled');
					$('ul.setup-panel li a[href="#step-3"]').trigger('click');
					
					e.preventDefault();
				} else {
					alert("Sila isi kotak yang masih belum diisi");   
				}
			});
			$('#back-step-1').on('click', function(e) {
				$('ul.setup-panel li:eq(0)').removeClass('disabled');
				$('ul.setup-panel li a[href="#step-1"]').trigger('click');
				
				e.preventDefault();
			});
			$('#back-step-2').on('click', function(e) {
				$('ul.setup-panel li:eq(1)').removeClass('disabled');
				$('ul.setup-panel li a[href="#step-2"]').trigger('click');
				
				e.preventDefault();
			});
		});
	</script>
	
	<style>
		.error {
			color: red;
			display: block;
		}
		.nav-justified > li {
			display: table-cell;
			width: 1%;
		}
		.nav-justified > li {
			float: none !important;
		}
	</style>
</head>
<body>

<?php



?>
	<div class="container">
		
		<div class="page-header">
			<h1>Borang Pesanan</h1>
		</div>
		
		<form id="borang" action="<?php echo base_url()?>form/submitted/<?php echo $_GET['u']?>" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
			<div class="container">
					<div class="row form-group">
						<div class="col-xs-12">
							<ul class="nav nav-pills nav-justified thumbnail setup-panel">
								<li class="active"><a href="#step-1">
									<h4 class="list-group-item-heading">Langkah 1</h4>
									<p class="list-group-item-text">Isikan maklumat tempahan produk.</p>
								</a></li>
								<li class="disabled"><a href="#step-2">
									<h4 class="list-group-item-heading">Langkah 2</h4>
									<p class="list-group-item-text">Isikan maklumat diri.</p>
								</a></li>
							</ul>
						</div>
					</div>
					
					<div class="row setup-content" id="step-1">
						<div class="col-xs-12">
							<div class="col-md-12 well">
								<div class="control-group">
									<label for="product_name" class="control-label">Produk</label>
									<div class="controls">
										<div id="product_image" class="thumbnail" style="max-width: 200px; max-height: 150px;margin-bottom: 10px;">
											<?php if (!empty($option_arr) && $option_arr[0]->file_name !="") : ?>
												<?php if (file_exists('images/products/thumbs/'. $option_arr[0]->file_name)) : ?>
													<?php $imgurl = base_url() . 'images/products/thumbs/' . $option_arr[0]->file_name; ?>
													<img src="<?php baseImage($imgurl)?>">
												<?php else: ?>
													<img src="<?php echo base_url()?>assets/img/no_images.jpg">
												<?php endif; ?>
											<?php else: ?>
												<img src="<?php echo base_url()?>assets/img/no_images.jpg">
											<?php endif; ?>
										</div>
										<select id="product_name" name="product_name">
										<?php
											if(isset($product_name)) {
												echo '<option value="' . $product_name . '">' . $product_name . '</option>';
											} else if(!empty($option_arr)) {
												foreach($option_arr as $key => $val) {
													echo '<option value="' . $val->product_name . '">' . $val->product_name . '</option>';
												}
											} else {
												echo '<option value="">Tiada produk.</option>';
											}
										?>
										</select>
									</div>
								</div>
								
								<div class="control-group">
									<label for="description" class="control-label">Deskripsi</label>
									<div class="controls">
										<textarea id="description" readonly="readonly" class="input-xlarge" placeholder="" name="description" cols="50" rows="4"><?php echo (isset($description) AND $description != '') ? $description : (!empty($option_arr)) ? $option_arr[0]->description :''?></textarea>
									</div>
								</div>
								
								<div class="control-group">
									<label for="sku" class="control-label">SKU</label>
									<div class="controls">
										<input type="text" name="sku" id="sku" readonly="readonly" placeholder="" class="input-medium" value="<?php echo (isset($sku) AND $sku != '') ? $sku : (!empty($option_arr)) ? $option_arr[0]->sku :''?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="quantity" class="control-label">Kuantiti <sup><i style="color: red;font-size: 12px;">*perlu diisi</i></sup></label>
									<div class="controls">
										<input type="text" name="quantity" id="quantity" placeholder="" class="input-mini" value="<?php echo (isset($quantity) AND $quantity != '') ? $quantity : 1?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="unit_price" class="control-label">Harga Seunit</label>
									<div class="controls">
										<input type="text" name="unit_price" id="unit_price" readonly="readonly" placeholder="" class="input-mini" value="<?php echo (isset($unit_price) AND $unit_price != '') ? number_format($unit_price,2,'.','') : (!empty($option_arr)) ? number_format($option_arr[0]->unit_price,2,'.','') : ''?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="total_price" class="control-label">Jumlah</label>
									<div class="controls">
										<input type="text" name="total_price" id="total_price" readonly="readonly" placeholder="" class="input-mini" value="<?php echo (isset($total_price) AND $total_price != '') ? number_format($total_price,2,'.','') : (!empty($option_arr)) ? number_format($option_arr[0]->unit_price,2,'.','') : ''?>" />
									</div>
								</div>
								
								<div class="form-actions">
									<button id="activate-step-2" class="button button-basic-blue">Seterusnya</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row setup-content" id="step-2">
						<div class="col-xs-12">
							<div class="col-md-12 well">
								
								<div class="control-group">
									<label for="" class="control-label">&nbsp;</label>
									<div class="controls">
										<input type="radio" id="new_customer" name="new_customer" checked> Pelanggan baru
										&emsp;
										<input type="radio" id="exist_customer" name="exist_customer"> Pelanggan lama
									</div>
								</div>
								
								<div class="control-group" id="display_customer_code" style="display: none;">
									<label for="" class="control-label">Kod pelanggan tetap</label>
									<div class="controls">
										<input type="text" id="customer_code" name="customer_code" placeholder="" class="input-large">
									</div>
								</div>
								
								<div class="control-group">
									<label for="full_name" class="control-label">Nama Penuh <sup><i style="color: red;font-size: 12px;">*perlu diisi</i></sup></label>
									<div class="controls">
										<input type="text" name="full_name" id="full_name" placeholder="" class="input-large" value="<?php echo (isset($full_name) AND $full_name != '') ? $full_name : ''?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="mailing_addr" class="control-label">Alamat <sup><i style="color: red;font-size: 12px;">*perlu diisi</i></sup></label>
									<div class="controls">
										<input type="text" name="mailing_addr" id="mailing_addr" placeholder="" class="input-large" value="<?php echo (isset($mailing_addr) AND $mailing_addr != '') ? $mailing_addr : ''?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="mailing_addr2" class="control-label">&nbsp;</label>
									<div class="controls">
										<input type="text" name="mailing_addr2" id="mailing_addr2" placeholder="" class="input-large" value="<?php echo (isset($mailing_addr2) AND $mailing_addr2 != '') ? $mailing_addr2 : ''?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="postcode" class="control-label">Poskod <sup><i style="color: red;font-size: 12px;">*perlu diisi</i></sup></label>
									<div class="controls">
										<input type="text" name="postcode" id="postcode" placeholder="" class="input-large" value="<?php echo (isset($postcode) AND $postcode != '') ? $postcode : ''?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="city" class="control-label">Bandar <sup><i style="color: red;font-size: 12px;">*perlu diisi</i></sup></label>
									<div class="controls">
										<input type="text" name="city" id="city" placeholder="" class="input-large" value="<?php echo (isset($city) AND $city != '') ? $city : ''?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="state" class="control-label">Negeri</label>
									<div class="controls">
										<select id="state" name="state">
										<?php
											foreach($state_opt as $key => $val) {
												echo '<option value="' . $key . '">' . $val . '</option>';
											}
										?>
										</select>
									</div>
								</div>
								
								<div class="control-group">
									<label for="email" class="control-label">Emel <sup><i style="color: red;font-size: 12px;">*perlu diisi</i></sup></label>
									<div class="controls">
										<input type="text" name="email" id="email" placeholder="" class="input-large" value="<?php echo (isset($email) AND $email != '') ? $email : ''?>" />
									</div>
								</div>
								
								<div class="control-group">
									<label for="contact_no" class="control-label">Nombor Telefon <sup><i style="color: red;font-size: 12px;">*perlu diisi</i></sup></label>
									<div class="controls">
										<input type="text" name="contact_no" id="contact_no" placeholder="" class="input-large" value="<?php echo (isset($contact_no) AND $contact_no != '') ? $contact_no : ''?>" />
									</div>
								</div>
								
								<div class="form-actions">
									<button id="back-step-1" class="button button-basic-blue">Kembali sebelumnya</button>
									<button type="submit" class="button button-basic-blue">Hantar</button>
								</div>
							</div>
						</div>
					</div>
			</div>
		</form>
	</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#product_name").on('change', function() {
			$.ajax({
				url : "<?php echo base_url()?>ajax/get_product",
				data : { user : '<?php echo $_GET['u']?>', product_name : $(this).val() },
				success : function(result) {
					
					var tmp_obj = $.parseJSON(result);
					
					if(tmp_obj.file_name != '')
						$('#product_image').html('<img src="' + tmp_obj.file_name + '">');
					else
						$('#product_image').html('<img src="<?php echo base_url()?>assets/img/no_images.jpg">');
					
					$('#description').html(tmp_obj.description);
					$('#sku').val(tmp_obj.sku);
					$('#unit_price').val(tmp_obj.unit_price);
					
					$("#unit_price").val( parseFloat(Math.round($("#unit_price").val() * 100) / 100).toFixed(2) );
					var total = $("#quantity").val() * $("#unit_price").val();
					$("#total_price").val( parseFloat(Math.round(total * 100) / 100).toFixed(2) );
					
					return false;
				}
			});
		});
		
		$('#exist_customer').on('click', function() {
			$('#new_customer').attr('checked', false);
			$('#display_customer_code').css('display', 'block');
			$('#full_name').attr('readonly', true);
			$('#mailing_addr').attr('readonly', true);
			$('#mailing_addr2').attr('readonly', true);
			$('#postcode').attr('readonly', true);
			$('#city').attr('readonly', true);
			$('#state').attr('disabled', true);
			$('#email').attr('readonly', true);
			$('#contact_no').attr('readonly', true);
			
			$("#customer_code").blur(function() {
				var customer_code = $('#customer_code').val();
				
				if(customer_code != '') {
					$.ajax({
						url : "<?php echo base_url()?>ajax/get_customer_by_code",
						data : { user : '<?php echo $_GET['u']?>', customer_loyalty_code : customer_code },
						success : function(result) {
							
							var tmp_obj = $.parseJSON(result);
							
							if(tmp_obj.length != 0) {
								$('#full_name').val(tmp_obj.full_name);
								$('#mailing_addr').val(tmp_obj.mailing_addr);
								$('#mailing_addr2').val(tmp_obj.mailing_addr2);
								$('#postcode').val(tmp_obj.postcode);
								$('#city').val(tmp_obj.city);
								$('#state').val(tmp_obj.state).prop('selected', true);
								$('#state').after('<input type="hidden" id="hiddenstate" name="state" value="'+tmp_obj.state+'" />');
								$('#email').val(tmp_obj.email);
								$('#contact_no').val(tmp_obj.contact_no);
							}
							
							return false;
						}
					});
				} else {
					$('#full_name').val('');
					$('#mailing_addr').val('');
					$('#mailing_addr2').val('');
					$('#postcode').val('');
					$('#city').val('');
					$('#state option:eq(0)').prop('selected', true);
					$('#hiddenstate').remove();
					$('#email').val('');
					$('#contact_no').val('');
				}
			});
		});
		$('#new_customer').on('click', function() {
			$('#exist_customer').attr('checked', false);
			$('#display_customer_code').css('display', 'none');
			$('#full_name').attr('readonly', false);
			$('#mailing_addr').attr('readonly', false);
			$('#mailing_addr2').attr('readonly', false);
			$('#postcode').attr('readonly', false);
			$('#city').attr('readonly', false);
			$('#state').attr('disabled', false);
			$('#email').attr('readonly', false);
			$('#contact_no').attr('readonly', false);
		});
		
		$("#quantity").numeric();
		$("#quantity").blur(function() {
			$("#unit_price").val( parseFloat(Math.round($("#unit_price").val() * 100) / 100).toFixed(2) );
			var total = $("#quantity").val() * $("#unit_price").val();
			$("#total_price").val( parseFloat(Math.round(total * 100) / 100).toFixed(2) );
		});
	});
</script>

</body>
</html>
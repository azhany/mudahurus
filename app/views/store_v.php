<!DOCTYPE html>
<html>
	<head>
		<title>MUDAHURUS.MY | Product <?php echo $result['product_name'];?></title>
		<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico')?>" type="image/x-icon" />
		<link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<!--theme-style-->
		<link href="<?php echo base_url()?>assets/css/style2.css" rel="stylesheet" type="text/css" media="all" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/css/etalage.css" type="text/css" media="all" />
		<!--//theme-style-->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--fonts-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!--//fonts-->
		<script src="<?php echo base_url()?>assets/js/jquery-2.1.1.min.js"></script>
		<!-- Old jquery functions -->
		<script src="<?php echo base_url('assets/js/jquery.migrate.min.js');?>"></script>

		<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>

		<!-- Validation -->
		<script src="<?php echo base_url('assets/js/jquery.validate.min.js');?>"></script>
		<!-- numeric field plugin -->
		<script src="<?php echo base_url('assets/js/jquery.numeric.js');?>"></script>

		<script src="<?php echo base_url()?>assets/js/jquery.etalage.min.js"></script>
		<script>
			$(document).ready(function($){
				$('[data-toggle="tooltip"]').tooltip();
				
				$('#etalage').etalage({
					thumb_image_width: 300,
					thumb_image_height: 300,
				});
				
				$("#myOrderForm").validate({
					rules: {
						product_name : "required",
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
						product_name : "Kotak ini perlu diisi",
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
						if (element.attr("name") == "userfile") {
							 error.appendTo(element.parent().parent().after());
						} else {
							error.appendTo(element.parent().after());
						}
					}
					
				});
				
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
				
				// DEMO ONLY //
				
				$('#back-step-1').on('click', function(e) {
					$('ul.setup-panel li:eq(0)').removeClass('disabled');
					$('ul.setup-panel li a[href="#step-1"]').trigger('click');
					
					e.preventDefault();
				});

				$("#activate-step-2").click(function(){
					if($("#myOrderForm").valid()) {
						$('ul.setup-panel li:eq(1)').removeClass('disabled');
						$('ul.setup-panel li a[href="#step-2"]').trigger('click');
						
						e.preventDefault();
					} else { alert("Sila isi kotak yang masih belum diisi"); }
				});
				
				$("#quantity").numeric();
				$("#quantity").blur(function() {
					$("#unit_price").val( parseFloat(Math.round($("#unit_price").val() * 100) / 100).toFixed(2) );
					var total = $("#quantity").val() * $("#unit_price").val();
					$("#total_price").val( parseFloat(Math.round(total * 100) / 100).toFixed(2) );
				});
				
				$('#exist_customer').on('click', function() {
					$('#new_customer').attr('checked', false);
					$('#customer_code').css('display', 'block');
					$('#full_name').attr('readonly', true);
					$('#email').attr('readonly', true);
					$('#contact_no').attr('readonly', true);
					$("#customer_code").blur(function() {
						var customer_code = $('#customer_code').val();
						
						if(customer_code != '') {
							$.ajax({
								url : "<?php echo base_url()?>store/get_customer_by_code",
								data : { user : '<?php echo $this->uri->segment(2)?>', customer_loyalty_code : customer_code },
								success : function(result) {
									
									var tmp_obj = JSON.parse(result);
									
									if(tmp_obj.length != 0) {
										$('#full_name').val(tmp_obj.full_name);
										$('#mailing_addr').val(tmp_obj.mailing_addr);
										$('#mailing_addr2').val(tmp_obj.mailing_addr2);
										$('#postcode').val(tmp_obj.postcode);
										$('#city').val(tmp_obj.city);
										$('#state option[value="'+tmp_obj.state+'"]').prop('selected', true);
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
					$('#customer_code').css('display', 'none');
					$('#full_name').attr('readonly', false);
					$('#email').attr('readonly', false);
					$('#contact_no').attr('readonly', false);
					$('#full_name').val('');
					$('#mailing_addr').val('');
					$('#mailing_addr2').val('');
					$('#postcode').val('');
					$('#city').val('');
					$('#state').val('');
					$('#email').val('');
					$('#contact_no').val('');
				});
			});
		</script>

		<style>
			/* Icon that will apear at the left bottom of the large thumbnail (optional): */
			#etalage .etalage_icon{
				background: url(<?php echo base_url()?>images/zoom.png) no-repeat rgba(184, 183, 181, 0.32);
			}
			
			.error {
				color:red;
				display:block;
			}
			.nav-justified > li {
				display: table-cell;
				width: 1%;
			}
			.nav-justified > li {
				float: none !important;
			}
		</style>

		<!-- You can use open graph tags to customize link previews.
		Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
		<meta property="og:url"           content="<?php echo current_url()?>" />
		<meta property="og:type"          content="website" />
		<meta property="og:title"         content="MUDAHURUS.MY | Product <?php echo $result['product_name'];?>" />
		<meta property="og:description"   content="<?php echo $result['description'];?>" />
		<meta property="og:image"         content="<?php echo ($result['file_name'] != '') ? base_url('uploads/products/' . $this->uri->segment(2) . '/' . $result['file_name']) : base_url('images/no_images.jpg');?>" />

	</head>
	<body>
		<!-- Load Facebook SDK for JavaScript -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<div class="container" style="margin: 0px;"> 
			<div class="single_top">
				<div class="single_grid">
					<div class="grid images_3_of_2">
						<ul id="etalage">
							<li>
								<a href="javascript:void(0);">
									<img class="etalage_source_image" src="<?php echo ($result['file_name'] != '') ? base_url('uploads/products/' . $this->uri->segment(2) . '/' . $result['file_name']) : base_url('images/no_images.jpg');?>" class="img-responsive" title="" />
								</a>
							</li>
						</ul>
						<div class="clearfix"> </div>
					</div> 
					<div class="desc1 span_3_of_2">
						<h4><?php echo $result['product_name']; ?></h4>
						<div class="cart-b">
							<div class="left-n">RM <?php echo number_format($result['unit_price'], 2, '.', ' '); ?></div>
							<a class="now-get get-cart-in" href="javascript:void(0);" data-target="#orderForm" data-toggle="modal">ORDER</a> 
							<div class="clearfix"></div>
						</div>
						<h6>&nbsp;</h6>
						<p><?php echo $result['description']; ?></p>
						<div class="share">
							<h5>Share Product :</h5>
							<ul class="share_nav">
								<li><a href="https://www.facebook.com/sharer/sharer.php?app_id=248726465284797&sdk=Azhany&u=<?php echo current_url()?>&display=popup&ref=plugin&src=share_button" data-href="<?php echo current_url();?>" data-layout="box_count" onclick="window.open('https://www.facebook.com/sharer/sharer.php?app_id=248726465284797&sdk=Azhany&u=<?php echo current_url()?>&display=popup&ref=plugin&src=share_button', 'newwindow', 'width=400, height=350'); return false;"><img src="<?php echo base_url()?>images/facebook.png" title="Facebook"></a></li>
								<li><a href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(current_url());?>&text=<?php echo urlencode($result['product_name']);?>&url=<?php echo urlencode(current_url());?>"><img src="<?php echo base_url()?>images/twitter.png" title="Twitter" onclick="window.open('https://twitter.com/intent/tweet?original_referer=<?php echo urlencode(current_url());?>&text=<?php echo urlencode($result['product_name']);?>&url=<?php echo urlencode(current_url());?>', 'newwindow', 'width=400, height=350'); return false;"></a></li>
							</ul>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		
		<div role="dialog" class="modal fade" id="orderForm">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button data-dismiss="modal" class="close" type="button">×</button>
				<h4 class="modal-title">Order Form</h4>
			  </div>
			  <div class="modal-body">
				<form id="myOrderForm" method="post" action="<?php echo base_url('store/submit');?>">
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
							<div class="col-md-12">
								<input type="text" placeholder="SKU" name="sku" id="sku" class="form-control" value="<?php echo $result['sku']; ?>" readonly><br>
								<input type="text" placeholder="Product Name" name="product_name" id="product_name" class="form-control" value="<?php echo $result['product_name']; ?>" readonly><br>
								<input type="text" placeholder="Quantity" name="quantity" id="quantity" class="form-control" value="1"><br>
								<input type="text" placeholder="Unit Price" name="unit_price" id="unit_price" class="form-control" value="<?php echo number_format($result['unit_price'], 2, '.', ' '); ?>" readonly><br>
								<input type="text" placeholder="Total Price" name="total_price" id="total_price" class="form-control" value="<?php echo number_format($result['unit_price'], 2, '.', ' '); ?>" readonly><br>
								<textarea rows="6" class="form-control" name="additional_notes" id="additional_notes" placeholder="Additional Notes"></textarea><br>
								<button id="activate-step-2" class="btn btn-primary" type="button">Seterusnya</button>
							</div>
						</div>
					</div>
					
					<div class="row setup-content" id="step-2">
						<div class="col-xs-12">
							<div class="col-md-12 well">
								<div class="form-control">
									<input type="radio" id="new_customer" name="customer_type" value="new" checked> New customer
									&emsp;
									<input type="radio" id="exist_customer" name="customer_type" value="old"> Old customer
								</div>
								<br />
								<input type="text" id="customer_code" name="customer_code" placeholder="Customer Code" class="form-control" style="display: none;">
								<br />
								<input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" value="" />
								<br />
								<input type="text" name="mailing_addr" id="mailing_addr" placeholder="Address" class="form-control" value="" />
								<br />
								<input type="text" name="mailing_addr2" id="mailing_addr2" placeholder="Alternate Address" class="form-control" value="" />
								<br />
								<input type="text" name="postcode" id="postcode" placeholder="Postcode" class="form-control" value="" />
								<br />
								<input type="text" name="city" id="city" placeholder="City" class="form-control" value="" />
								<br />
								<select id="state" name="state" class="form-control">
									<option value="johor">Johor</option>
									<option value="kedah">Kedah</option>
									<option value="kelantan">Kelantan</option>
									<option value="kl">Kuala Lumpur</option>
									<option value="melaka">Melaka</option>
									<option value="n9">Negeri Sembilan</option>
									<option value="pahang">Pahang</option>
									<option value="penang">Pulau Pinang</option>
									<option value="perak">Perak</option>
									<option value="perlis">Perlis</option>
									<option value="sabah">Sabah</option>
									<option value="selangor">Selangor</option>
									<option value="serawak">Serawak</option>
									<option value="terengganu">Terengganu</option>
								</select>
								<br />
								<input type="text" name="email" id="email" placeholder="Email" class="form-control" value="" />
								<br />
								<input type="text" name="contact_no" id="contact_no" placeholder="Phone No" class="form-control" value="" />
								<br />
								<input type="hidden" name="user_id" value="<?php echo $user_id;?>">
								<input type="hidden" name="user" value="<?php echo $this->uri->segment(2);?>">
								<button id="back-step-1" class="btn btn-danger">Kembali sebelumnya</button>
								<button class="btn btn-primary" type="submit">Hantar</button>
							</div>
						</div>
					</div>
				</form>
			  </div>
			  <div class="modal-footer">
				<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
			  </div>
			</div>
		  </div>
		</div>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>MUDAHURUS.MY | Store <?php echo $store_name['company'];?></title>
		<meta name="author" content="<?php echo $store_name['username'];?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico')?>" type="image/x-icon" />
		<link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<style>
			body {
			 padding-top:70px;
			}

			.productsrow {
			 -moz-column-width: 18em;
			 -webkit-column-width: 18em;
			 -moz-column-gap: 1em;
			 -webkit-column-gap: 1em;
			}
			  
			.menu-category {
			 display: inline-block;
			 margin-bottom:  0.25rem;
			 padding:  1rem;
			 width:  100%; 
			}

			.product-image {
			 width: 100%;
			}

			.product {
			 padding-top:22px;  
			}

			.btn-product {
			 background-color:#222;
			 color:#eee;
			 border-radius:0;
			}

			.yellow {
			 color:yellow;
			 text-shadow:#ccc 1px 1px 0;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="col-md-12">
				<div class="center-block text-center">
					<h1><?php echo $store_name['company'];?></h1>
					<?php if(isset($message) && $message != '') { echo '<p>' . $message . '</p>'; } ?>
				</div>
				<div class="container">
					<div class="menu row">
						<div class="col-sm-12">
							<div class="productsrow">
								<?php if(isset($products) && !empty($products)) { ?>
								<?php foreach($products as $product) { ?>
								<div class="product menu-category">
									<div class="menu-category-name list-group-item active"><?php echo $product['category'];?></div>
									<div class="product-image">
										<a href="<?php echo base_url('store/' . $product['username'] . '/' . $product['id']);?>">
											<img class="product-image menu-item list-group-item" src="<?php echo ($product['file_name'] != '') ? base_url('uploads/products/' . $product['username'] . '/' . $product['file_name']) : base_url('images/no_images.jpg');?>">
										</a>
									</div> <a href="<?php echo base_url('store/' . $product['username'] . '/' . $product['id']);?>" class="menu-item list-group-item"><?php echo $product['product_name'];?><span class="badge">RM <?php echo number_format($product['unit_price'], 2, '.', ' ');?></span></a>

								</div>
								<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="menu row" style="margin-top: 20px;margin-bottom: 20px;">
						<div class="col-sm-12">
							<div class="input-group input-group-md">
								<input type="text" class="form-control" placeholder="Tracking No POS Laju Code" name="TrackNo" id="TrackNo" data-val-required="The Track No field is required." data-val="true">
								<span class="input-group-btn">
								  <button type="button" class="btn btn-info btn-flat" id="track" data-toggle="modal" data-target="#shippingStatus">Track!</button>
								</span>
								<div role="dialog" class="modal fade" id="shippingStatus">
								  <div class="modal-dialog">

									<!-- Modal content-->
									<div class="modal-content">
									  <div class="modal-header">
										<button data-dismiss="modal" class="close" type="button">×</button>
										<h4 class="modal-title">Shipping Status</h4>
									  </div>
									  <div class="modal-body">
									  
										<div id="loading" style="display: none;text-align: center;"><img src="<?php echo base_url()?>assets/img/loading.gif" width="100" height="100"></div>
										<div id="result"></div>
										
									  </div>
									  
									  <div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
									  </div>
									</div>
								  </div>
								</div>
							</div>
						</div>
					</div>
					<!--/row-->
				</div>
				<!--/container-->
			</div>
		</div>
		<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {
				$("#track").on('click', function(e) {
					e.preventDefault();
					
					var API_URL = "http://api.pos.com.my/TrackNTraceWebApi/api/";
					var API_URL_HEADER = API_URL + "Header/";
					var API_URL_DETAILS = API_URL + "Details/";
					
					var trackNo = $('#TrackNo').val();
					trackNo = trackNo.replace(/[\s+]/g, "");
					
					$('#result').children().remove();
					$('#loading').css('display', 'block');
					$.get(API_URL_HEADER + trackNo).done(function(header) {
						var html = '<table class="table table-nomargin table-hover table-bordered">';
						html += '<thead>';
						html += '<tr>';
						html += '<th>Date Time</th>';
						html += '<th>Office</th>';
						html += '<th>Process</th>';
						html += '</tr>';
						html += '</thead>';
						html += '<tbody>';
						html += '<tr>';
						html += '<td>' + header[0].date + '</td>';
						html += '<td>' + header[0].office + '</td>';
						html += '<td>' + header[0].process + '</td>';
						html += '</tr>';
						$.get(API_URL_DETAILS + trackNo).done(function(details) {
							for(i in details) {
								html += '<tr>';
								html += '<td>' + details[i].date + '</td>';
								html += '<td>' + details[i].office + '</td>';
								html += '<td>' + details[i].process + '</td>';
								html += '</tr>';
							}
							
							html += '</tbody>';
							html += '</table>';
							$('#loading').css('display', 'none');
							$('#result').html(html);
						});
					});
				});
			});
		</script>
	</body>
</html>
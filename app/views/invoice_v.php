<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>MUDAHURUS.MY | Order ID <?php echo $order['id'];?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>" rel="stylesheet" type="text/css" />
	
	<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/blueimp-fileupload/css/jquery.fileupload.css');?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="wrapper">
		<?php if($order['expired_date'] > date("Y-m-d H:i:s") && $order['status'] == "pending") { ?>
        <!-- Main content -->
        <section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-globe"></i> <?php echo $user['company'];?>
                <small class="pull-right">Tarikh: <?php echo date("d/m/Y");?></small>
              </h2>
            </div><!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
              Daripada
              <address>
                <strong><?php echo $user['company'];?></strong><br>
                Phone: <?php echo $user['phone'];?><br/>
                Email: <?php echo $user['email'];?>
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Kepada
              <address>
                <strong><?php echo $order['full_name'];?></strong><br>
                <?php echo $order['mailing_addr'];?><br>
                <?php echo $order['mailing_addr2'];?><br>
					<?php echo $order['city'];?><br>
					<?php echo $order['postcode'];?><br>
					<?php echo $order['state'];?><br>
                Phone: <?php echo $order['contact_no'];?><br/>
                Email: <?php echo $order['email'];?>
              </address>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <b>Order ID:</b> <?php echo $order['id'];?><br/>
              <b>Tarikh akhir bayaran:</b> <?php echo date("d/m/Y", strtotime("+3 days"));?><br/>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Additional Notes</th>
                    <th>Unit Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $order['sku'];?></td>
                    <td><?php echo $order['product_name'];?></td>
                    <td><?php echo $order['quantity'];?></td>
                    <td><?php echo $order['additional_notes'];?></td>
                    <td>RM <?php echo number_format($order['unit_price'], 2, '.', ' ');?></td>
                  </tr>
                </tbody>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
              <p class="lead">Cara bayaran:</p>
              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
			    <?php if($user['payment_info'] != "") { echo $user['payment_info'] . '<br />'; } ?>
				Upload screenshot <i>Online Transfer</i> atau resit <i>Bank In / Cash Deposit</i>. Terima kasih!
              </p>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <p class="lead">Bayar <strong style="color: red;">SEBELUM</strong> <?php echo date("d/m/Y", strtotime("+3 days"));?></p>
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Jumlah keseluruhan:</th>
                    <td>RM <?php echo number_format($order['total_price'], 2, '.', ' ');?></td>
                  </tr>
                </table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- this row will not appear when printing -->
          <div class="row no-print">
            <div class="col-xs-12">
              <span class="btn btn-success fileinput-button"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;<span>Upload Bayaran</span><input id="fileupload" type="file" name="files"></span>
            </div>
			<div class="col-xs-12">
				  <!-- The global progress bar -->
				  <div id="progress" class="progress" style="margin-top: 20px;">
					<div class="progress-bar progress-bar-info progress-bar-striped"></div>
				  </div>
				  <!-- The container for the uploaded files -->
				  <div id="files" class="files" accept="image/*"></div>
			</div>
			<!--<div class="cols-xs-12">
				<button class="btn btn-primary pull-right">Hantar</button>
			</div>-->
          </div>
        </section><!-- /.content -->
		<?php } else if($order['status'] == "payment_received") { ?>
		<div class="callout callout-success" style="margin-top: 20px;">
			<h4><i class="fa fa-success"></i> Makluman:</h4>
			Tempahan anda sudah berjaya dihantar. Tunggu pengesahan daripada seller. Terima kasih!
		</div>
		<?php } else { ?>
		<div class="callout callout-danger" style="margin-top: 20px;">
			<h4><i class="fa fa-danger"></i> Perhatian:</h4>
			Tempahan anda sudah tamat tempoh. Sila buat tempahan yang baru dan lakukan pembayaran sebelum tamat tempoh. Terima kasih!
		</div>
		<?php } ?>
        <div class="clearfix"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.4.min.js');?>"></script>
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="<?php echo base_url('assets/plugins/blueimp-fileupload/js/vendor/jquery.ui.widget.js');?>"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url('assets/plugins/fastclick/fastclick.min.js');?>'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/app.min.js');?>" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets/dist/js/demo.js');?>" type="text/javascript"></script>
	
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
	<script>
	/*jslint unparam: true, regexp: true */
	/*global window, $ */
	$(function () {
		'use strict';
		// Change this to the location of your server-side upload handler:
		var url = '<?php echo base_url('store/upload_payment/' . $user['username'] . '/' . $order['id']);?>',
			uploadButton = $('<button/>')
				.addClass('btn btn-primary')
				.prop('disabled', true)
				.text('Processing...')
				.on('click', function () {
					var $this = $(this),
						data = $this.data();
					$this
						.off('click')
						.text('Abort')
						.on('click', function () {
							$this.remove();
							data.abort();
						});
					data.submit().always(function () {
						$this.remove();
					});
				});
		
		$('#fileupload').fileupload({
			url: url,
			dataType: 'json',
			autoUpload: false,
			acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
			maxFileSize: 999000,
			// Enable image resizing, except for Android and Opera,
			// which actually support image resizing, but fail to
			// send Blob objects via XHR requests:
			disableImageResize: /Android(?!.*Chrome)|Opera/
				.test(window.navigator.userAgent),
			previewMaxWidth: 100,
			previewMaxHeight: 100,
			previewCrop: true
		}).on('fileuploadadd', function (e, data) {
			data.context = $('<div/>').appendTo('#files');
			$.each(data.files, function (index, file) {
				var node = $('<p/>')
						.append($('<span/>').text(file.name));
				if (!index) {
					node
						.append('<br>')
						.append(uploadButton.clone(true).data(data));
				}
				node.appendTo(data.context);
			});
		}).on('fileuploadprocessalways', function (e, data) {
			var index = data.index,
				file = data.files[index],
				node = $(data.context.children()[index]);
			if (file.preview) {
				node
					.prepend('<br>')
					.prepend(file.preview);
			}
			if (file.error) {
				node
					.append('<br>')
					.append($('<span class="text-danger"/>').text(file.error));
			}
			if (index + 1 === data.files.length) {
				data.context.find('button')
					.text('Upload')
					.prop('disabled', !!data.files.error);
			}
		}).on('fileuploadprogressall', function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('#progress .progress-bar').css(
				'width',
				progress + '%'
			);
		}).on('fileuploaddone', function (e, data) {
			$.each(data.result.files, function (index, file) {
				if (file.url) { console.log(file);
					/*var link = $('<a>')
						.attr('target', '_blank')
						.prop('href', file.url);
					$(data.context.children()[index])
						.wrap(link);*/
						
					$('div#files').after( '<form action="<?php echo base_url('store/submit_payment');?>" method="post"><input type="hidden" name="user_id" value="<?php echo $user['id'];?>"><input type="hidden" name="order_id" value="<?php echo $order['id'];?>"><input type="hidden" name="payment_image_proof" value="'+file.name+'"><input type="hidden" name="encoded" value="<?php echo $this->uri->segment(2);?>"><button type="submit" class="btn btn-primary">Hantar Bukti Pembayaran</button></form>' );
				} else if (file.error) {
					var error = $('<span class="text-danger"/>').text(file.error);
					$(data.context.children()[index])
						.append('<br>')
						.append(error);
				}
			});
		}).on('fileuploadfail', function (e, data) {
			$.each(data.files, function (index) {
				var error = $('<span class="text-danger"/>').text('File upload failed.');
				$(data.context.children()[index])
					.append('<br>')
					.append(error);
			});
		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
	</script>
  </body>
</html>
<?php $this->load->view('admin/header_v'); ?>

<?php $this->load->view('admin/sidemenu_v'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">This month orders</span>
                  <span class="info-box-number"><?php echo ($this_month_orders != "" ? $this_month_orders['counter'] : "&nbsp;")?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="ion ion-ios-cart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total orders</span>
                  <span class="info-box-number"><?php echo ($total_orders != "" ? $total_orders['counter'] : "&nbsp;")?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-social-usd-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">This month sales</span>
                  <span class="info-box-number"><?php echo ($this_month_sales != "" ? $this_month_sales['counter'] : "&nbsp;")?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-social-usd-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total sales</span>
                  <span class="info-box-number"><?php echo ($total_sales != "" ? $total_sales['counter'] : "&nbsp;")?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- Main row -->
          <div class="row">
			<div class="col-md-12">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Pending Orders</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="pending-orders-table">
                      <thead>
                        <tr>
							<th data-dynatable-column="id" data-dynatable-no-sort="true">Order ID</th>
							<th data-dynatable-column="sku"><span style="color: black;">SKU<span style="color: black;"></th>
							<th data-dynatable-column="quantity"><span style="color: black;">Quantity<span style="color: black;"></th>
							<th data-dynatable-column="total_price"><span style="color: black;">Total Price<span style="color: black;"></th>
							<th data-dynatable-column="status"><span style="color: black;">Status<span style="color: black;"></th>
							<th data-dynatable-column="btn" data-dynatable-no-sort="true">Action</th>
						  </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <?php /*<a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>*/ ?>
                  <a href="<?php echo base_url('orders');?>" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
			</div>
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
		<!-- Modal -->
		<div id="addOrder" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="onClose();">&times;</button>
				<h4 class="modal-title">Add New</h4>
			  </div>
			  <div class="modal-body">
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="onClose();">Close</button>
			  </div>
			</div>
		  </div>
		</div>
	  
	<script>
		function onClose() {
			$('.modal-body').remove();
			$('.modal-title').html( 'Add New' );
		}
		
		function getOrder( order_id ) {
			$.post('<?php echo base_url()?>admin/orders/get_order', { id: order_id }, function(response) {
				var r = JSON.parse(response);
				
				var form = '<form action="<?php echo base_url('admin/orders/edit')?>/'+order_id+'" method="post">';
					if(r.result.status == 'pending') {
						form += '<select id="status" name="status" class="form-control"><option value="pending" selected>Pending</option><option value="payment_received">Payment Received</option><option value="payment_accepted">Payment Accepted</option><option value="shipped">Package are Shipped</option></select><br />';
					} else if(r.result.status == 'payment_received') {
						form += '<select id="status" name="status" class="form-control"><option value="pending">Pending</option><option value="payment_received" selected>Payment Received</option><option value="payment_accepted">Payment Accepted</option><option value="shipped">Package are Shipped</option></select><br />';
					} else if(r.result.status == 'payment_accepted') {
						form += '<select id="status" name="status" class="form-control"><option value="pending">Pending</option><option value="payment_received">Payment Received</option><option value="payment_accepted" selected>Payment Accepted</option><option value="shipped">Package are Shipped</option></select><br />';
					} else {
						form += '<select id="status" name="status" class="form-control"><option value="pending">Pending</option><option value="payment_received">Payment Received</option><option value="payment_accepted">Payment Accepted</option><option value="shipped" selected>Package are Shipped</option></select><br />';
					}
					form += '<input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="'+r.result.sku+'" readonly><br />';
					form += '<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" value="'+r.result.product_name+'" readonly><br />';
					form += '<input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="'+r.result.quantity+'"><br />';
					form += '<input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="Unit Price" value="'+r.result.unit_price+'" readonly><br />';
					form += '<input type="text" class="form-control" id="total_price" name="total_price" placeholder="Total Price" value="'+r.result.total_price+'" readonly><br />';
					form += '<textarea rows="6" class="form-control" name="additional_notes" id="additional_notes" placeholder="Additional Notes">'+r.result.additional_notes+'</textarea><br />';
					form += '<div class="form-control"><input type="checkbox" id="show_customer"> Show customer details</div><br />';
					form += '<div id="customer_details" class="form-control" style="display:none;height:auto;"><br /><input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" value="'+r.result.full_name+'" /><br />';
					form += '<input type="text" name="mailing_addr" id="mailing_addr" placeholder="Address" class="form-control" value="'+r.result.mailing_addr+'" /><br />';
					form += '<input type="text" name="mailing_addr2" id="mailing_addr2" placeholder="Alternate Address" class="form-control" value="'+r.result.mailing_addr2+'" /><br />';
					form += '<input type="text" name="postcode" id="postcode" placeholder="Postcode" class="form-control" value="'+r.result.postcode+'" /><br />';
					form += '<input type="text" name="city" id="city" placeholder="City" class="form-control" value="'+r.result.city+'" /><br />';
					form += '<select id="state" name="state" class="form-control"><option value="johor">Johor</option><option value="kedah">Kedah</option><option value="kelantan">Kelantan</option><option value="kl">Kuala Lumpur</option><option value="melaka">Melaka</option><option value="n9">Negeri Sembilan</option><option value="pahang">Pahang</option><option value="penang">Pulau Pinang</option><option value="perak">Perak</option><option value="perlis">Perlis</option><option value="sabah">Sabah</option><option value="selangor">Selangor</option><option value="serawak">Serawak</option><option value="terengganu">Terengganu</option></select><br />';
					form += '<input type="text" name="email" id="email" placeholder="Email" class="form-control" value="'+r.result.email+'" /><br />';
					form += '<input type="text" name="contact_no" id="contact_no" placeholder="Phone No" class="form-control" value="'+r.result.contact_no+'" /><br /></div><br />';
					form += '<input type="submit" class="btn btn-primary" value="Submit">';
					form += '</form>';
					
				var readonly = '';
				if(r.result.status == 'pending')
					readonly = '<a href="<?php echo base_url('invoice');?>/'+r.result.encoded_key+'" target="_blank" class="btn btn-default">Invoice Page</a><br /><br />';
				else
					readonly = '<span id="payment_image">Payment Image : <a href="<?php echo base_url('uploads/payments/' . $this->session->userdata('username'));?>/'+r.result.payment_image_proof+'" target="_blank"><img src="<?php echo base_url('uploads/payments/' . $this->session->userdata('username') . '/thumbnail');?>/'+r.result.payment_image_proof+'"></a></span><br /><br />';
					
				$('.modal-title').html( 'Edit - Order ID '+order_id );
				$('.modal-body').html( readonly + form );
				$('#addOrder').modal('show');
				
				$("#quantity").numeric();
				$("#quantity").blur(function() {
					$("#unit_price").val( parseFloat(Math.round($("#unit_price").val() * 100) / 100).toFixed(2) );
					var total = $("#quantity").val() * $("#unit_price").val();
					$("#total_price").val( parseFloat(Math.round(total * 100) / 100).toFixed(2) );
				});
					
				$('#show_customer').on('change', function() {
					var display = this.checked ? 'block' : 'none';
					$('#customer_details').css('display', display);
				});
			});
		}
		
	  	$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
			
			var products_table = $('table#pending-orders-table').dynatable({
			  inputs: {
			    paginationClass: 'pagination',
			    paginationPrevClass: 'previous',
			    paginationNextClass: 'next',
			    paginationActiveClass: 'active',
			    paginationDisabledClass: 'disabled',
			  },
			  dataset: {
				ajax: true,
				ajaxUrl: base_url + 'api/pending_orders',
				ajaxOnLoad: true,
				records: []
			  },
			  features : {
				  search: true
			  }
			}).data('dynatable');
		});
    </script>
	  
<?php $this->load->view('admin/footer_v'); ?>
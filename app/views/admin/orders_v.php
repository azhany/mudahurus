<?php $this->load->view('admin/header_v'); ?>

<?php $this->load->view('admin/sidemenu_v'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Orders
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('orders');?>">Orders</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#addOrder">Add New</button></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="table-responsive">
					  <table id="orders-table" class="table table-bordered table-hover">
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
					</div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div>
		  </div>
		</section>
	  </div>
	  
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
				<form action="<?php echo base_url('admin/orders/add')?>" method="post">
					<input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" data-toggle="tooltip" data-placement="bottom auto" title="Masukkan produk SKU untuk sistem isikan produk details." onblur="get_product()"><br />
					<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name"><br />
					<input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity"><br />
					<input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="Unit Price"><br />
					<input type="text" class="form-control" id="total_price" name="total_price" placeholder="Total Price"><br />
					<textarea rows="6" class="form-control" name="additional_notes" id="additional_notes" placeholder="Additional Notes"></textarea><br />
					<select id="status" name="status" class="form-control">
						<option value="pending">Pending</option>
						<option value="payment_received">Payment Received</option>
						<option value="payment_accepted">Payment Accepted</option>
						<option value="shipped">Package are Shipped</option>
					</select><br />
					<div class="form-control">
						<input type="radio" id="new_customer" name="new_customer" checked> New customer
						&emsp;
						<input type="radio" id="exist_customer" name="exist_customer"> Old customer
					</div><br />
					<input type="text" id="customer_code" name="customer_code" placeholder="Customer Code" class="form-control" style="display: none;" data-toggle="tooltip" data-placement="bottom auto" title="Masukkan Customer Loyalty Code untuk sistem isikan maklumat pelanggan anda."><br />
					<input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" value="" /><br />
					<input type="text" name="mailing_addr" id="mailing_addr" placeholder="Address" class="form-control" value="" /><br />
					<input type="text" name="mailing_addr2" id="mailing_addr2" placeholder="Alternate Address" class="form-control" value="" /><br />
					<input type="text" name="postcode" id="postcode" placeholder="Postcode" class="form-control" value="" /><br />
					<input type="text" name="city" id="city" placeholder="City" class="form-control" value="" /><br />
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
					</select><br />
					<input type="text" name="email" id="email" placeholder="Email" class="form-control" value="" /><br />
					<input type="text" name="contact_no" id="contact_no" placeholder="Phone No" class="form-control" value="" /><br />
					<input type="submit" class="btn btn-primary" value="Submit">
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="onClose();">Close</button>
			  </div>
			</div>

		  </div>
		</div>
		
	<!-- Orders -->
	<script type="text/javascript">
		var addOrderHTML = $('#addOrder').html();
		function onClose() {
			$('#addOrder').html( addOrderHTML );
			
			$("#quantity").numeric();
			$("#quantity").blur(function() {
				$("#unit_price").val( parseFloat(Math.round($("#unit_price").val() * 100) / 100).toFixed(2) );
				var total = $("#quantity").val() * $("#unit_price").val();
				$("#total_price").val( parseFloat(Math.round(total * 100) / 100).toFixed(2) );
			});
			
			$('#exist_customer').on('click', function() {
				$('#new_customer').attr('checked', false);
				$('#customer_code').css('display', 'block');
				
				$("#customer_code").blur(function() {
					var customer_code = $('#customer_code').val();
					
					if(customer_code != '') {
						$.ajax({
							url : "<?php echo base_url()?>store/get_customer_by_code",
							data : { user : '<?php echo $this->session->userdata('username')?>', customer_loyalty_code : customer_code },
							success : function(result) {
								
								var tmp_obj = JSON.parse(result);
								
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
				$('#customer_code').css('display', 'none');
				$('#full_name').val('');
				$('#mailing_addr').val('');
				$('#mailing_addr2').val('');
				$('#postcode').val('');
				$('#city').val('');
				$('#state').val('');
				$('#email').val('');
				$('#contact_no').val('');
			});
			
			$('#addOrder').modal('hide');
		}
		
		function get_product() {
			var sku = $('#sku').val();
			var user_id = '<?php echo $_SESSION['user_id']?>';
			
			if(sku != '') {
				$.ajax({
					url : "<?php echo base_url()?>store/get_product_by_sku",
					data : { user_id : user_id, sku : sku },
					success : function(result) {
						
						var tmp_obj = JSON.parse(result);
						
						if(tmp_obj.length != 0) {
							$('#product_name').val(tmp_obj.product_name);
							$('#quantity').val(tmp_obj.quantity);
							$('#unit_price').val(tmp_obj.unit_price);
							
							$("#quantity").numeric();
							$("#quantity").blur(function() {
								$("#unit_price").val( parseFloat(Math.round($("#unit_price").val() * 100) / 100).toFixed(2) );
								var total = $("#quantity").val() * $("#unit_price").val();
								$("#total_price").val( parseFloat(Math.round(total * 100) / 100).toFixed(2) );
							});
						}
						
						return false;
					}
				});
			} else {
				$('#product_name').val('');
				$('#quantity').val('');
				$('#unit_price').val('');
				$('#total_price').val('');
			}
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
					var state = {johor:"Johor",kedah:"Kedah",kelantan:"Kelantan",kl:"Kuala Lumpur",melaka:"Melaka",n9:"Negeri Sembilan",pahang:"Pahang",penang:"Pulau Pinang",perak:"Perak",perlis:"Perlis",sabah:"Sabah",selangor:"Selangor",serawak:"Serawak",terengganu:"Terengganu"};
					var selected = '';
					form += '<select id="state" name="state" class="form-control">';
					for (s in state) {
						if(r.result.state == s)
							form += '<option value="'+s+'" selected>'+state[s]+'</option>';
						else
							form += '<option value="'+s+'">'+state[s]+'</option>';
					}
					form += '</select><br />';
					form += '<input type="text" name="email" id="email" placeholder="Email" class="form-control" value="'+r.result.email+'" /><br />';
					form += '<input type="text" name="contact_no" id="contact_no" placeholder="Phone No" class="form-control" value="'+r.result.contact_no+'" /><br /></div><br />';
					form += '<input type="submit" class="btn btn-primary" value="Submit">';
					form += '</form>';
						
				var readonly = '';
				if(r.result.status == 'pending')
					readonly = '<a href="<?php echo base_url('invoice');?>/'+r.result.encoded_key+'" target="_blank" class="btn btn-default">Invoice Page</a><br /><br />';
				else {
					readonly = '<span id="payment_image">Payment Image : <a href="<?php echo base_url('uploads/payments/' . $this->session->userdata('username'));?>/'+r.result.payment_image_proof+'" target="_blank"><img src="<?php echo base_url() . 'uploads/payments/' . $this->session->userdata('username') . '/thumbnail/'; ?>'+r.result.payment_image_proof+'"></a></span><br /><br />';
				}
					
				$('.modal-title').html( 'Edit - Order ID '+order_id );
				$('#addOrder').find('.modal-body').html( readonly + form );
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
			
			var products_table = $('table#orders-table').dynatable({
			  inputs: {
			    paginationClass: 'pagination',
			    paginationPrevClass: 'previous',
			    paginationNextClass: 'next',
			    paginationActiveClass: 'active',
			    paginationDisabledClass: 'disabled',
			  },
			  dataset: {
				ajax: true,
				ajaxUrl: base_url + 'api/orders',
				ajaxOnLoad: true,
				records: []
			  },
			  features : {
				  search: true
			  }
			}).data('dynatable');
			
			$("#quantity").numeric();
			$("#quantity").blur(function() {
				$("#unit_price").val( parseFloat(Math.round($("#unit_price").val() * 100) / 100).toFixed(2) );
				var total = $("#quantity").val() * $("#unit_price").val();
				$("#total_price").val( parseFloat(Math.round(total * 100) / 100).toFixed(2) );
			});
			
			$('#exist_customer').on('click', function() {
				$('#new_customer').attr('checked', false);
				$('#customer_code').css('display', 'block');
				
				$("#customer_code").blur(function() {
					var customer_code = $('#customer_code').val();
					
					if(customer_code != '') {
						$.ajax({
							url : "<?php echo base_url()?>store/get_customer_by_code",
							data : { user : '<?php echo $this->session->userdata('username')?>', customer_loyalty_code : customer_code },
							success : function(result) {
								
								var tmp_obj = JSON.parse(result);
								
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
				$('#customer_code').css('display', 'none');
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

<?php $this->load->view('admin/footer_v'); ?>
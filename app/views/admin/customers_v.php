<?php $this->load->view('admin/header_v'); ?>

<?php $this->load->view('admin/sidemenu_v'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Customers
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('customers');?>">Customers</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCustomer">Add New</button></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="table-responsive">
					  <table id="customers-table" class="table table-bordered table-hover">
						<thead>
						  <tr>
							<th data-dynatable-column="id" data-dynatable-no-sort="true">Customer ID</th>
							<th data-dynatable-column="full_name"><span style="color: black;">Full Name</span></th>
							<th data-dynatable-column="customer_loyalty_code"><span style="color: black;">Loyalty Code</span></th>
							<th data-dynatable-column="contact_no"><span style="color: black;">Contact_no</span></th>
							<th data-dynatable-column="email"><span style="color: black;">Email</span></th>
							<th data-dynatable-column="type"><span style="color: black;">Type</span></th>
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
		<div id="addCustomer" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="onClose();">&times;</button>
				<h4 class="modal-title">Add New</h4>
			  </div>
			  <div class="modal-body">
				<form action="<?php echo base_url('admin/customers/add')?>" method="post">
					<input type="text" class="form-control" id="customer_loyalty_code" name="customer_loyalty_code" placeholder="Customer Loyalty Code" readonly data-toggle="tooltip" data-placement="bottom auto" title="Sistem akan bantu createkan Customer Loyalty Code pelanggan anda. Tetapi anda boleh edit melalui button edit."><br />
					<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name"><br />
					<input type="text" class="form-control" id="ic_no" name="ic_no" placeholder="IC / Passport"><br />
					<input type="text" class="form-control" id="dob" name="dob" placeholder="Date of Birth (YYYY-MM-DD)"><br />
					<textarea id="mailing_addr" name="mailing_addr" class="form-control" rows="8"></textarea><br />
					<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Post Code"><br />
					<input type="text" class="form-control" id="city" name="city" placeholder="City"><br />
					<select id="state" name="state" class="form-control">
						<option value="johor">Johor</option>
						<option value="kedah">Kedah</option>
						<option value="kelantan">Kelantan</option>
						<option value="kl">Kuala Lumpur</option>
						<option value="melaka">Melaka</option>
						<option value="n9">Negeri Sembilan</option>
						<option value="pahang">Pahang</option>
						<option value="penang">Penang</option>
						<option value="perak">Perak</option>
						<option value="perlis">Perlis</option>
						<option value="sabah">Sabah</option>
						<option value="selangor">Selangor</option>
						<option value="serawak">Serawak</option>
						<option value="terengganu">Terengganu</option>
					</select><br />
					<input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No"><br />
					<input type="text" class="form-control" id="email" name="email" placeholder="Email"><br />
					<select name="type" class="form-control" id="type">
						<option value="prospect">Prospect</option>
						<option value="customer">Customer</option>
					</select>
					<br />
					<input type="submit" class="btn btn-primary" value="Submit">
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="onClose();">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
	<!-- Customers -->
	<script type="text/javascript">
		function onClose() {
			$('#customer_loyalty_code').attr('readonly', true);
			$('#customer_loyalty_code').attr('data-toggle', 'tooltip');
			$('#customer_loyalty_code').attr('data-placement', 'bottom auto');
			$('#customer_loyalty_code').attr('title', 'Sistem akan bantu createkan Customer Loyalty Code pelanggan anda. Tetapi anda boleh edit melalui button edit.');
			$('#customer_loyalty_code').val('');
			$('#full_name').val('');
			$('#ic_no').val('');
			$('#dob').val('');
			$('#mailing_addr').val('');
			$('#postcode').val('');
			$('#city').val('');
			$('#state option:eq(0)').prop('selected', true);
			$('#hiddenstate').remove();
			$('#contact_no').val('');
			$('#email').val('');
			
			$('#addCustomer').find('.modal-title').html( 'Add New' );
		}
		
		function getCustomer( customer_id ) {
			$.post('<?php echo base_url()?>admin/customers/get_customer', { id: customer_id }, function(response) {
				var r = JSON.parse(response);
				
					var form = '<form action="<?php echo base_url('admin/customers/edit')?>/'+customer_id+'" method="post">';
						form += '<input type="text" class="form-control" id="customer_loyalty_code" name="customer_loyalty_code" placeholder="Customer Loyalty Code" value="'+r.result.customer_loyalty_code+'"><br />';
						form += '<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="'+r.result.full_name+'"><br />';
						form += '<input type="text" class="form-control" id="ic_no" name="ic_no" placeholder="IC / Passport" value="'+r.result.ic_no+'"><br />';
						form += '<input type="text" class="form-control" id="dob" name="dob" placeholder="Date of Birth (YYYY-MM-DD)" value="'+r.result.dob+'"><br />';
						form += '<textarea id="mailing_addr" name="mailing_addr" class="form-control" rows="8">'+r.result.mailing_addr+'</textarea><br />';
						form += '<input type="text" class="form-control" id="postcode" name="postcode" placeholder="Post Code" value="'+r.result.postcode+'"><br />';
						form += '<input type="text" class="form-control" id="city" name="city" placeholder="City" value="'+r.result.city+'"><br />';
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
						form += '<input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Contact No" value="'+r.result.contact_no+'"><br />';
						form += '<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="'+r.result.email+'"><br />';
						if(r.result.type == 'prospect') {
							form += '<select name="type" class="form-control" id="type"><option value="prospect" selected>Prospect</option><option value="customer">Customer</option></select><br />';
						} else {
							form += '<select name="type" class="form-control" id="type"><option value="prospect">Prospect</option><option value="customer" selected>Customer</option></select><br />';
						}
						form += '<input type="submit" class="btn btn-primary" value="Submit">';
						form += '</form>';
						
					$('#addCustomer').find('.modal-title').html( 'Edit - Customer '+r.result.full_name );
					$('#addCustomer').find('.modal-body').html( form );
					$('#addCustomer').modal('show');
			});
		}
		
		$(document).ready(function(){
			$('[data-toggle="tooltip"]').tooltip();
			
			var products_table = $('table#customers-table').dynatable({
			  inputs: {
			    paginationClass: 'pagination',
			    paginationPrevClass: 'previous',
			    paginationNextClass: 'next',
			    paginationActiveClass: 'active',
			    paginationDisabledClass: 'disabled',
			  },
			  dataset: {
				ajax: true,
				ajaxUrl: base_url + 'api/customers',
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
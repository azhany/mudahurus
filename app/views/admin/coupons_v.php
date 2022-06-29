<?php $this->load->view('admin/header_v'); ?>

<?php $this->load->view('admin/sidemenu_v'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Coupons
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('coupons');?>">Coupons</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCoupon">Add New</button></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="table-responsive">
					  <table id="coupons-table" class="table table-bordered table-hover">
						<thead>
						  <tr>
							<th data-dynatable-column="id" data-dynatable-no-sort="true">Coupon ID</th>
							<th data-dynatable-column="campaign"><span style="color: black;">Campaign</span></th>
							<th data-dynatable-column="description"><span style="color: black;">Description</span></th>
							<th data-dynatable-column="expired_date"><span style="color: black;">Expired Date</span></th>
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
		<div id="addCoupon" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="onClose();">&times;</button>
				<h4 class="modal-title">Add New</h4>
			  </div>
			  <div class="modal-body">
				<form action="<?php echo base_url('admin/coupons/add')?>" method="post">
					<input type="text" class="form-control" id="campaign" name="campaign" placeholder="Campaign"><br />
					<textarea id="description" name="description" class="form-control" rows="8"></textarea><br />
					<input id="expired_date" type="text" class="form-control" name="expired_date" placeholder="Expired Date"><br />
					<input type="submit" class="btn btn-primary" value="Submit">
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="onClose();">Close</button>
			  </div>
			</div>

		  </div>
		</div>
		
	<!-- Coupons -->
	<script type="text/javascript">
		function onClose() {
			$('#campaign').val('');
			$('#description').val('');
			$('#expired_date').val('');
			
			$('#addCoupon').find('.modal-title').html( 'Add New' );
		}
		
		function getCoupon( coupon_id ) {
			$.post('<?php echo base_url()?>admin/coupons/get_coupon', { id: coupon_id }, function(response) {
				var r = JSON.parse(response);
				
					var form = '<form action="<?php echo base_url('admin/coupons/edit')?>/'+coupon_id+'" method="post">';
						form += '<input type="text" class="form-control" id="campaign" name="campaign" placeholder="Campaign" value="'+r.result.campaign+'"><br />';
						form += '<textarea id="description" name="description" class="form-control" rows="8">'+r.result.description+'</textarea><br />';
						form += '<input id="expired_date" type="text" class="form-control" name="expired_date" placeholder="Expired Date" value="'+r.result.expired_date+'"><br />';
						form += '<input type="submit" class="btn btn-primary" value="Submit">';
						form += '</form>';
						
					$('#addCoupon').find('.modal-title').html( 'Edit - Campaign '+r.result.campaign );
					$('#addCoupon').find('.modal-body').html( form );
					$('#addCoupon').modal('show');
			});
		}
		
		$(document).ready(function(){
			var products_table = $('table#coupons-table').dynatable({
			  inputs: {
			    paginationClass: 'pagination',
			    paginationPrevClass: 'previous',
			    paginationNextClass: 'next',
			    paginationActiveClass: 'active',
			    paginationDisabledClass: 'disabled',
			  },
			  dataset: {
				ajax: true,
				ajaxUrl: base_url + 'api/coupons',
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
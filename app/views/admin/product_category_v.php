<?php $this->load->view('admin/header_v'); ?>

<?php $this->load->view('admin/sidemenu_v'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Products Category
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('category');?>">Product Category</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#addProductCategory">Add New</button></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="table-responsive">
					  <table id="product-category-table" class="table table-bordered table-hover">
						<thead>
						  <tr>
							<th data-dynatable-column="id"><span style="color: black;">Category ID</span></th>
							<th data-dynatable-column="category"><span style="color: black;">Category</span></th>
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
		<div id="addProductCategory" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="onClose();">&times;</button>
				<h4 class="modal-title">Add New</h4>
			  </div>
			  <div class="modal-body">
				<form action="<?php echo base_url('admin/categories/category_add')?>" method="post">
					<input type="text" class="form-control" id="category" name="category" placeholder="Category"><br />
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
		
	<!-- Products -->
	<script type="text/javascript">
		function onClose() {
			$('#category').val('');
			
			$('#addProductCategory').find('.modal-title').html( 'Add New' );
		}
		
		function getProductCategory( category_id ) {
			$.post('<?php echo base_url()?>admin/categories/get_category', { id: category_id }, function(response) {
				var r = JSON.parse(response);
				
					var form = '<form action="<?php echo base_url('admin/categories/category_edit')?>/'+category_id+'" method="post">';
						form += '<input type="text" class="form-control" id="category" name="category" placeholder="Category" value="'+r.result.category+'"><br />';
						form += '<input type="submit" class="btn btn-primary" value="Submit">';
						form += '</form>';
						
					$('#addProductCategory').find('.modal-title').html( 'Edit - Category '+r.result.category );
					$('#addProductCategory').find('.modal-body').html( form );
					$('#addProductCategory').modal('show');
			});
		}
		
		$(document).ready(function(){
			var products_table = $('table#product-category-table').dynatable({
			  inputs: {
			    paginationClass: 'pagination',
			    paginationPrevClass: 'previous',
			    paginationNextClass: 'next',
			    paginationActiveClass: 'active',
			    paginationDisabledClass: 'disabled',
			  },
			  dataset: {
				ajax: true,
				ajaxUrl: base_url + 'api/category',
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
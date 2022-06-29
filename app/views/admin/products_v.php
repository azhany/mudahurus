<?php $this->load->view('admin/header_v'); ?>

<?php $this->load->view('admin/sidemenu_v'); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Products
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('products');?>">Products</a></li>
          </ol>
        </section>
		
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#addProduct">Add New</button></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
					<div class="table-responsive">
					  <table id="products-table" class="table table-bordered table-hover">
						<thead>
						  <tr>
							<th data-dynatable-column="id" data-dynatable-no-sort="true">Product ID</th>
							<th data-dynatable-column="sku"><span style="color: black;">SKU</span></th>
							<th data-dynatable-column="category"><span style="color: black;">Category</span></th>
							<th data-dynatable-column="product_name"><span style="color: black;">Product Name</span></th>
							<th data-dynatable-column="unit_price"><span style="color: black;">Unit Price</span></th>
							<th data-dynatable-column="status" data-dynatable-no-sort="true"><span style="color: black;">Status</span></th>
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
		<div id="addProduct" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="onClose();">&times;</button>
				<h4 class="modal-title">Add New</h4>
			  </div>
			  <div class="modal-body">
				<form action="<?php echo base_url('admin/products/add')?>" method="post" enctype="multipart/form-data">
					<input type="text" class="form-control" id="sku" name="sku" placeholder="SKU"><br />
					<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name"><br />
					<select id="category" name="category_id" class="form-control">
						<?php if(!empty($categories)) { foreach($categories as $cat) { ?>
						<option value="<?php echo $cat['id']?>"><?php echo $cat['category']?></option>
						<?php } } ?>
					</select>
					<br />
					<textarea id="description" name="description" class="form-control" placeholder="Description" rows="8"></textarea><br />
					<input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="Unit Price"><br />
					<select id="status" name="status" class="form-control">
						<option value="active">Active</option>
						<option value="inactive">Inactive</option>
					</select>
					<br />
					  <span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span>Upload Gambar</span><input id="fileupload" type="file" name="files"></span>
					<br />
					  <!-- The container for the uploaded files -->
					  <div id="files" class="files" accept="image/*"></div>
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
		
		<!-- Modal -->
		<div id="product-url-modal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Product URL</h4>
			  </div>
			  <div class="modal-body">
				<input type="text" id="product-url-input" class="form-control" value="" />
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
		
	<!-- Products -->
	<script type="text/javascript">
		
		function show_url(e) {
			var value = $(e).attr('data-value');
			
			$('#product-url-input').val( value );
			$('#product-url-modal').find('.modal-title').html( 'Product URL' );
			$('#product-url-modal').modal('show');
		}
		
		function onClose() {
			$('#sku').val('');
			$('#product_name').val('');
			$("#category option").prop("selected", false);
			$('#description').val('');
			$('#unit_price').val('');
			$("#status option").prop("selected", false);
			$("#fileupload").val('');
			$("#fileupload").prev().text('Upload Gambar');
			if($("img").length > 0) {
				$("img").next().remove();
				$("img").next().remove();
				$("img").remove();
			}
			$("#files").empty();
			//$("select").val([]);
			
			$('#addProduct').find('.modal-title').html( 'Add New' );
		}
		
		function getProduct( product_id ) {
			$.post('<?php echo base_url()?>admin/products/get_product', { id: product_id }, function(response) {
				var r = JSON.parse(response);
				
					var form = '<form action="<?php echo base_url('admin/products/edit')?>/'+product_id+'" method="post" enctype="multipart/form-data">';
						form += '<input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="'+r.result.sku+'"><br />';
						form += '<input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" value="'+r.result.product_name+'"><br />';
						form += '<select id="category" name="category_id" class="form-control">';
						
						<?php if(!empty($categories)) { foreach($categories as $cat) { ?>
						form += (r.result.category_id == <?php echo $cat['id']?>) ? '<option value="<?php echo $cat['id']?>" selected><?php echo $cat['category']?></option>' : '<option value="<?php echo $cat['id']?>"><?php echo $cat['category']?></option>';
						<?php } } ?>
						
						form += '</select><br />';
						form += '<textarea id="description" name="description" class="form-control" rows="8" placeholder="Description">'+r.result.description+'</textarea><br />';
						form += '<input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="Unit Price" value="'+r.result.unit_price+'"><br />';
						
						form += '<select id="status" name="status" class="form-control">';
						form += (r.result.status == 'active') ? '<option value="active" selected>Active</option><option value="inactive">Inactive</option>' : '<option value="active">Active</option><option value="inactive" selected>Inactive</option>';
						form += '</select><br />';
						
						if(r.result.file_name != '')
							form += '<img src="<?php echo base_url('uploads/products/' . $_SESSION['username'] . '/thumbnail')?>/'+r.result.file_name+'" /><br /><br />';
						
						form += '<span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i>&nbsp;&nbsp;<span>Upload Gambar Baru</span><input id="fileupload" type="file" name="files" accept="image/*"></span><br /><div id="files" class="files"></div><br />';
						
						form += '<input type="submit" class="btn btn-primary" value="Submit">';
						form += '</form>';
						
					$('#addProduct').find('.modal-title').html( 'Edit - Product '+r.result.product_name );
					$('#addProduct').find('.modal-body').html( form );
					
					$('#fileupload').on('change', function() {
						var filename = $(this).val();
						var lastIndex = filename.lastIndexOf("\\");
						if (lastIndex >= 0) {
							filename = filename.substring(lastIndex + 1);
						}
						$("#files").html('<br /><p>'+filename+'</p>');
					});
					
					$('#addProduct').modal('show');
			});
		}
		
		$(document).ready(function(){
			var products_table = $('table#products-table').dynatable({
			  inputs: {
			    paginationClass: 'pagination',
			    paginationPrevClass: 'previous',
			    paginationNextClass: 'next',
			    paginationActiveClass: 'active',
			    paginationDisabledClass: 'disabled',
			  },
			  dataset: {
				ajax: true,
				ajaxUrl: base_url + 'api/products',
				ajaxOnLoad: true,
				records: []
			  },
			  features : {
				  search: true
			  }
			}).data('dynatable');
			
			$('#product-url-input').on('focus', function() {
				$(this).select();
			});
			
			$('#fileupload').on('change', function() {
				var filename = $(this).val();
				var lastIndex = filename.lastIndexOf("\\");
				if (lastIndex >= 0) {
					filename = filename.substring(lastIndex + 1);
				}
				$("#files").html('<br /><p>'+filename+'</p>');
			});
		});

    </script>

<?php $this->load->view('admin/footer_v'); ?>
		<!-- Modal -->
		<div id="editProfile" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Profile</h4>
			  </div>
			  <div class="modal-body">
				<form action="<?php echo base_url('profile')?>" method="post">
					<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"><br />
					<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"><br />
					<input type="text" class="form-control" id="company" name="company" placeholder="Store Name"><br />
					<input type="text" class="form-control" id="email" name="email" placeholder="Email"><br />
					<input type="text" class="form-control" id="phone" name="phone" placeholder="Contact No"><br />
					<textarea id="payment_info" name="payment_info" rows="5" class="form-control" placeholder="Payment Info" data-toggle="tooltip" data-placement="bottom auto" title="Isikan maklumat bank akaun anda untuk dipaparkan kepada pelanggan anda selepas mereka membuat pesanan."></textarea><br />
					<span style="color: red;">* isikan jika anda mahu menukar password, jika tidak biarkan kosong.</span><br /><br />
					<input type="password" class="form-control" name="password" placeholder="Password"><br />
					<input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password"><br />
					<input type="submit" name="submit" class="btn btn-primary" value="Save" onsubmit="alert('Maklumat telah dihantar kepada sistem!');">
				</form>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
			</div>

		  </div>
		</div>
		
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2015 <a target="_blank" href="http://mudahurus.my">mudahurus.my</a> by <a href="http://azhany.com" target="_blank">Mohd Azhany</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->
	
    <!-- FastClick -->
    <script src='<?php echo base_url()?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url()?>assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url()?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url()?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url()?>assets/dist/js/demo.js" type="text/javascript"></script>
	
	<script>
		function editProfile() {
			var user_id = '<?php echo $_SESSION['user_id']?>';
			
			$.ajax({
				url : "<?php echo base_url('dashboard/profile')?>",
				data : { user_id : user_id },
				success : function(result) {
					
					var tmp_obj = JSON.parse(result);
					
					if(tmp_obj.length != 0) {
						$('#first_name').val(tmp_obj.first_name);
						$('#last_name').val(tmp_obj.last_name);
						$('#company').val(tmp_obj.company);
						$('#email').val(tmp_obj.email);
						$('#phone').val(tmp_obj.phone);
						$('#payment_info').html(tmp_obj.payment_info);
					}
					
					//$('#editProfile').find('.modal-body').html( form );
					$('#editProfile').modal('show');
					
					$('[data-toggle="tooltip"]').tooltip();
					
					return false;
				}
			});
		}
	</script>
  </body>
</html>
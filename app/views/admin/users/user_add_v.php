<?php $this->load->view(ADMIN_FOLDER . '/header')?>
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="box-head">
				<i class="icon-list-ul"></i>
				<span><?php echo $sub_title?></span>
			</div>
			<div class="box-body box-body-nopadding">
				<form action="" method="POST" class="form-horizontal form-bordered">
					<input type="hidden" value="<?php echo isset($id) ? $id : ''?>" name="id" />
					<div class="control-group">
						<label for="account_no" class="control-label">No Akaun</label>
						<div class="controls">
							<input type="text" name="account_no" id="account_no" placeholder="" class="input-xlarge" value="<?php echo (isset($account_no) AND $account_no != '') ? $account_no: ''?>" />
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Nama Penuh</label>
						<div class="controls">
							<input type="text" name="full_name" id="full_name" placeholder="" class="input-xlarge" value="<?php echo (isset($full_name) AND $full_name != '') ? $full_name: ''?>" />
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Nama Pengguna</label>
						<div class="controls">
							<input type="text" name="username" id="username" placeholder="" class="input-xlarge" value="<?php echo (isset($username) AND $username != '') ? $username: ''?>" />
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Kata Laluan</label>
						<div class="controls">
							<input type="password" name="password" id="password" placeholder="" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Taip semula Kata Laluan</label>
						<div class="controls">
							<input type="password" name="check" id="check" placeholder="" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Kebenaran Akses</label>
						<div class="controls">
							<select name="active_status">
        						<option value=""></option>
        						<?php
								$option_arr = array('1' => 'Yes', '0' => 'No');
								foreach($option_arr as $key => $val) {
								?>
									<option value="<?php echo $key?>" <?php echo (isset($active_status) AND $active_status == $key) ? 'selected="selected"' : (!isset($active_status) AND $key == '1') ? 'selected="selected"' : ''?>><?php echo $val?></option>
								<?php
									}
								?>
        					</select>
						</div>
					</div>
					
					<div class="control-group">
						<label for="email" class="control-label">Emel</label>
						<div class="controls">
							<input type="text" name="email" id="email" placeholder="" class="input-xlarge" value="<?php echo (isset($email) AND $email != '') ? $email: ''?>" />
						</div>
					</div>
					
					<div class="control-group">
						<label for="contact" class="control-label">No Telefon</label>
						<div class="controls">
							<input type="text" name="contact_no" id="contact_no" placeholder="" class="input-xlarge" value="<?php echo (isset($contact_no) AND $contact_no != '') ? $contact_no: ''?>" />
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="button button-basic-blue">Simpan perubahan</button>
						<button type="reset" class="button button-basic-grey">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view(ADMIN_FOLDER . '/footer')?>
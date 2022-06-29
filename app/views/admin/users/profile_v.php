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
				<input type="hidden" value="<?php echo isset($user_id) ? $user_id : ''?>" name="user_id" />
					<div class="control-group">
						<label for="account_no" class="control-label">No Akaun</label>
						<div class="controls">
							<input type="text" name="account_no" id="account_no" placeholder="" class="input-xlarge" value="<?php echo (isset($account_no) AND $account_no != '') ? $account_no: ''?>" disabled />
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Nama Penuh</label>
						<div class="controls">
							<input type="text" value="<?php echo isset($full_name) ? $full_name : ''?>" class="input-xlarge" size="40" readonly="readonly" disabled="disabled" />
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Nama Pengguna</label>
						<div class="controls">
							<input type="text" value="<?php echo isset($username) ? $username : ''?>" class="input-xlarge" size="40" readonly="readonly" disabled="disabled" />
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Kata Laluan Lama</label>
						<div class="controls">
							<input type="password" name="old_p" id="old_p" placeholder="" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Kata Laluan Baru</label>
						<div class="controls">
							<input type="password" name="new_p" id="new_p" placeholder="" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label for="password" class="control-label">Taip semula Kata Laluan Baru</label>
						<div class="controls">
							<input type="password" name="new_p2" id="new_p2" placeholder="" class="input-xlarge">
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
						<button type="reset" class="button button-basic">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php $this->load->view(ADMIN_FOLDER . '/footer')?>
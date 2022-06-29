<?php $this->load->view(ADMIN_FOLDER . '/header')?>

<script type="text/javascript">
function delete_user(user_id) {
	if(confirm("Are you sure to delete this user?")) {
		$('#remove_user_id').val(user_id);
		$('#remove_frm').submit();
	}
	
}
</script>

<form id="remove_frm" name="remove_frm" action="<?php echo base_url(ADMIN_FOLDER)?>users/remove/" method="post">
  <input type="hidden" name="remove_user_id" id="remove_user_id" value="" />
</form>

<div class="row-fluid">
<div class="span12">
	<div class="box">
		<div class="box-head">
			<i class="icon-table"></i>
			<span>Senarai Pengguna</span>
		</div>
		<div class="box-body box-body-nopadding">
			<div class="highlight-toolbar">
				<div class="pull-left">
				<div class="btn-toolbar">
					<div class="btn-group"><a href="<?php echo base_url(ADMIN_FOLDER)?>users" class="button button-basic button-icon" rel="tooltip" title="" data-original-title="Refresh hasil carian"><i class="icon-refresh"></i></a></div>
					<div class="btn-group">
						<a href="<?php echo base_url(ADMIN_FOLDER)?>users/add/" class="button button-basic button-icon" rel="tooltip" title="" data-original-title="Tambah Pengguna Baru"><i class="icon-plus"></i></a>
					</div>
				</div>
				</div>
				<form id="remove_frm" name="remove_frm" action="<?php echo base_url(ADMIN_FOLDER)?>users/search/" method="post">
				<div class="pull-right">
					<div class="dataTables_filter" id="DataTables_Table_0_filter"><label><span>Carian:</span> <input type="text" name="search" value="<?php echo (isset($search)) ? $search : ''?>" aria-controls="DataTables_Table_0" placeholder="Taip disini..."></label></div>
				</div>
				</form>
			</div>
			
			<table class="table table-nomargin table-bordered table-striped table-hover hidden-phone">
				<thead>
					<tr>
						<?php if($this->uri->segment(2) != "search"):?>
							<th>Nama Penuh</th>
							<th>Nama Pengguna</th>
							<th>Akses</th>
						<?php else: ?>
							<th>Nama Penuh</th>
							<th>Nama Pengguna</th>
							<th>Akses</th>
						<?php endif; ?> 
							<th width="1%">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					if($query->num_rows() > 0) {
						$alt = 0;
						$user_arr = array('superadmin' => 'Super Admin', 'senioradmin' => 'Senior Admin',  'admin' => 'Admin', 'groupmanager' => 'Group Manager (Agent)', 'leader' => 'Leader (Agent)', 'sales' => 'Normal (Agent)');
						
						foreach($query->result() as $row) {
							$alt++;
				?>
					<tr>
						<td><?php echo $row->full_name?></td>
						<td><?php echo $row->username?></td>
						<td><?php echo ($row->active_status == '1') ? 'Allowed' : 'Not Allowed'?></td>
						<td nowrap><a href="<?php echo base_url(ADMIN_FOLDER)?>users/edit/<?php echo $row->id?>">Ubah</a> | <a href="#" onclick="delete_user(<?php echo $row->id?>);">Padam</a></td>
					</tr>
				<?php	
						}
					} else {
				?>
					<tr>
						<td colspan="4">Tiada data.</td>
					</tr>
				<?php
					}
				?>
				</tbody>
				</table>
				
			<table class="table table-nomargin table-bordered table-striped table-hover visible-phone">
				<thead>
					<tr>
						<?php if($this->uri->segment(2) != "search"):?>
							<th>Nama Pengguna</th>
							<th>Akses</th>
						<?php else: ?>
							<th>Nama Pengguna</th>
							<th>Akses</th>
						<?php endif; ?> 
							<th width="1%">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					if($query->num_rows() > 0) {
						$alt = 0;
						$user_arr = array('superadmin' => 'Super Admin', 'senioradmin' => 'Senior Admin',  'admin' => 'Admin', 'groupmanager' => 'Group Manager (Agent)', 'leader' => 'Leader (Agent)', 'sales' => 'Normal (Agent)');
						
						foreach($query->result() as $row) {
							$alt++;
				?>
					<tr>
						<td><?php echo $row->username?></td>
						<td><?php echo ($row->active_status == '1') ? 'Allowed' : 'Not Allowed'?></td>
						<td nowrap><a href="<?php echo base_url(ADMIN_FOLDER)?>users/edit/<?php echo $row->id?>">Ubah</a> | <a href="#" onclick="delete_user(<?php echo $row->id?>);">Padam</a></td>
					</tr>
				<?php	
						}
					} else {
				?>
					<tr>
						<td colspan="4">Tiada data.</td>
					</tr>
				<?php
					}
				?>
				</tbody>
				</table>
			</div>
			<?php echo $pagination?>
		</div>
	</div>
</div>


<?php $this->load->view(ADMIN_FOLDER . '/footer')?>
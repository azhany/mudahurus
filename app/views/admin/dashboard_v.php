<?php $this->load->view('admin/header')?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#urlform').on('focus', function() {
			$(this).select();
			$(this).keypress(function(key) {
				if(key.charCode < 48 || key.charCode > 57)
					return false;
			});
		});
		
		$('#copy').zclip({
			path:'<?php echo base_url(); ?>assets/js/ZeroClipboard.swf',
			copy:$('#urlform').val()
		});
	});
</script>
<div class="box">
	<div class="box-head">
		<i class="icon-th-list"></i>
		<span>URL Borang Produk</span>
	</div>
	<div class="box-body" style="padding-bottom: 0px;">
		<input type="text" name="urlform" id="urlform" placeholder="" class="input-xxlarge" value="<?php echo base_url() . 'form/?u=' . urlencode(base64_encode($this->session->userdata('account_no')))?>" /> 
		<!--<a style="margin-bottom: 10px;" class="btn visible-phone" href="fb-messenger://share?text=<?php echo base_url() . 'form/?u=' . urlencode(base64_encode($this->session->userdata('account_no')))?> : Borang Online">Share via Facebook Messenger</a>-->
		<a style="margin-bottom: 10px;" class="btn visible-phone" href="whatsapp://send?text=<?php echo base_url() . 'form/?u=' . urlencode(base64_encode($this->session->userdata('account_no')))?> : Borang Online">Share via Whatsapp Messenger</a>
	</div>
</div>

<div class="box">
	<div class="box-head">
		<i class="icon-time"></i>
		<span>Semak Status POSLAJU</span>
	</div>
	<div class="box-body" style="padding-bottom: 0px;">
		<form role="form" name="myform" method="post" id="myform" enctype="multipart/form-data" class="control-group" action="http://www.pos.com.my/TrackAndTrace/TrackAndTrace/">
			<textarea style="overflow:hidden;width:180px;height:80px;resize:none;" rows="5" name="TrackNo" id="TrackNo" data-val-required="The Track No field is required." data-val="true" cols="20"></textarea>
			<br />
			<button type="submit" class="button button-basic-blue">Track</button>
		</form>
		<div id="loading" style="display: none;text-align: center;"><img src="<?php echo base_url()?>assets/img/loading.gif" width="100" height="100"></div>
		<div id="result">
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$("#myform").on('submit', function(e) {
			e.preventDefault();
			
			var API_URL = "http://api.pos.com.my/TrackNTraceWebApi/api/";
			var API_URL_HEADER = API_URL + "Header/";
			var API_URL_DETAILS = API_URL + "Details/";
			
			var trackNo = $('#TrackNo').val();
			trackNo = trackNo.replace(/[\s+]/g, "");
			
			$('#result').children().remove();
			$('#loading').css('display', 'block');
			$.get(API_URL_HEADER + trackNo).done(function(header) {
				var html = '<table class="table table-nomargin table-hover table-bordered">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>Date Time</th>';
				html += '<th>Office</th>';
				html += '<th>Process</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
				html += '<tr>';
				html += '<td>' + header[0].date + '</td>';
				html += '<td>' + header[0].office + '</td>';
				html += '<td>' + header[0].process + '</td>';
				html += '</tr>';
				$.get(API_URL_DETAILS + trackNo).done(function(details) {
					for(i in details) {
						html += '<tr>';
						html += '<td>' + details[i].date + '</td>';
						html += '<td>' + details[i].office + '</td>';
						html += '<td>' + details[i].process + '</td>';
						html += '</tr>';
					}
					
					html += '</tbody>';
					html += '</table>';
					$('#loading').css('display', 'none');
					$('#result').html(html);
				});
			});
		});
	});
</script>

<?php $this->load->view('admin/footer')?>
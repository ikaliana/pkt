<script type="text/javascript">
	$(document).ready(function (e) {
		$('#editPupuk').on('click', function () {
			var form_data = new FormData();
			form_data.append("namaPupuk",$("#namaPupuk").val());
			form_data.append("n",$("#pupuk_N").val());
			form_data.append("p",$("#pupuk_P").val());
			form_data.append("k",$("#pupuk_K").val());
			$.ajax({
				url: 'pupuk_edit_action.php', // point to server-side PHP script 
				dataType: 'text', // what to expect back from the PHP script
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function (response) {
					$('#hasil_edit_model').html(response); // display success response from the PHP script
				},
				error: function (response) {
					$('#hasil_edit_model').html(response); // display error response from the PHP script
				}
			});
		});
	});
</script>
<?php
include "../config.php";

$id = $_POST['id'];
$sql = pg_query($db_conn, "SELECT * FROM pkt_pupuk where kode_pupuk=".$id."");
$data = pg_fetch_assoc($sql);
?>

<form class="form-horizontal">
	<div class="row clearfix">
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
			<label for="area">Nama Pupuk</label>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
			<div class="form-group">
				<div class="form-line">
					<input type="text" id="namaPupuk" class="form-control" placeholder="masukkan nama pupuk" value="<?php echo $data['nama_pupuk'];?>">
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
			<label for="area">Komposisi</label>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
			<div class="form-group">
				<div class="form-inline">
					<div class="col-md-4">
						<div class="col-xs-2 form-control-label"><label for="area">N</label></div>
						<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
							<input type="text" id="pupuk_N" class="form-control" placeholder="0" value="<?php echo $data['komposisi_n'];?>"></div>
					</div>
					<div class="col-md-4">
						<div class="col-xs-2 form-control-label"><label for="area">P</label></div>
						<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
							<input type="text" id="pupuk_P" class="form-control" placeholder="0" value="<?php echo $data['komposisi_p'];?>"></div>
					</div>
					<div class="col-md-4">
						<div class="col-xs-2 form-control-label"><label for="area">K</label></div>
						<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
							<input type="text" id="pupuk_K" class="form-control" placeholder="0" value="<?php echo $data['komposisi_k'];?>"></div>
					</div>
					<!--div class="row">
					</div-->
				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal-footer">
	<button type="button" onclick="editPupuk()" class="btn btn-link waves-effect">SIMPAN</button>
	<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
</div>
	

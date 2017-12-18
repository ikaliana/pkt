<script type="text/javascript">
	$(document).ready(function (e) {
		$('#editModel').on('click', function () {
			var form_data = new FormData();
			form_data.append("model_name",$("#model_name").val());
			form_data.append("nutrisi",$("#nutrisi").val());
			form_data.append("b1",$("#b1").val());
			form_data.append("b2",$("#b2").val());
			form_data.append("b3",$("#b3").val());
			form_data.append("b4",$("#b4").val());
			form_data.append("b5",$("#b5").val());
			form_data.append("b6",$("#b6").val());
			form_data.append("b7",$("#b7").val());
			form_data.append("b8",$("#b8").val());
			form_data.append("b8a",$("#b8a").val());
			form_data.append("b9",$("#b9").val());
			form_data.append("b10",$("#b10").val());
			form_data.append("b11",$("#b11").val());
			form_data.append("b12",$("#b12").val());
			$.ajax({
				url: 'model_edit_action.php', // point to server-side PHP script 
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
$sql = pg_query($db_conn, "SELECT * FROM pkt_model where id_model=".$id."");
$data = pg_fetch_assoc($sql);
$nutrisi_selected = $data['nutrisi'];
?>
<form class="form-horizontal">
	<div class="row clearfix">
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
			<label for="area">Nama model</label>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
			<div class="form-group">
				<div class="form-line">
					<input type="text" class="form-control" id="model_name" required value="<?php echo $data['nama'];?>"></input>
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
			<label for="nutrisi">Nutrisi</label>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
			<div class="form-group">
				<div class="form-line">
					<select class="form-control show-tick" id="nutrisi" name="nutrisi">
						<option value="">-- pilih --</option>
						<option value="N" <?php if($nutrisi_selected == 'N'){echo "selected";} ?>>N</option>
						<option value="P" <?php if($nutrisi_selected == 'P'){echo "selected";} ?>>P</option>
						<option value="K" <?php if($nutrisi_selected == 'K'){echo "selected";} ?>>K</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
			<label for="resolusi_10">Resolusi 10 m</label>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
			<div class="form-group">
				<div class="col-sm-3">
					<div class="form-group">
						<div class="form-line">
							<label>Band 2</label> <input type="text" class="form-control" id="b2" required value="<?php echo $data['band2']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<div class="form-line">
							<label>Band 3</label> <input type="text" class="form-control" id="b3" required value="<?php echo $data['band3']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<div class="form-line">
							<label>Band 4</label> <input type="text" class="form-control" id="b4" required value="<?php echo $data['band4']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<div class="form-line">
							<label>Band 8</label> <input type="text" class="form-control" id="b8" required value="<?php echo $data['band8']; ?>"></input>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
			<label for="resolusi_20">Resolusi 20 m</label>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
			<div class="form-group">
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 5</label> <input type="text" class="form-control" id="b5" required value="<?php echo $data['band5']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 6</label> <input type="text" class="form-control" id="b6" required value="<?php echo $data['band6']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 7</label> <input type="text" class="form-control" id="b7" required value="<?php echo $data['band7']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 8a</label> <input type="text" class="form-control" id="b8a" required value="<?php echo $data['band8a']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 11</label> <input type="text" class="form-control" id="b11" required value="<?php echo $data['band11']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 12</label> <input type="text" class="form-control" id="b12" required value="<?php echo $data['band12']; ?>"></input>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
			<label for="resolusi_60">Resolusi 60 m</label>
		</div>
		<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
			<div class="form-group">
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 1</label> <input type="text" class="form-control" id="b1" required value="<?php echo $data['band1']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 9</label> <input type="text" class="form-control" id="b9" required value="<?php echo $data['band9']; ?>"></input>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<div class="form-line">
							<label>Band 10</label> <input type="text" class="form-control" id="b10" required value="<?php echo $data['band10']; ?>"></input>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
	<div class="modal-footer">
				<button type="button" onclick="editModel()" class="btn btn-link waves-effect">SIMPAN</button>
				<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
	</div>
<div id="hasil_edit_model">
</div>
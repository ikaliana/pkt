<?php
include('../config.php');
$id = strtoupper($_GET['id']);
$sql_model = pg_query($db_conn, "SELECT * FROM pkt_model where id_model='".$id."'");
$data = pg_fetch_assoc($sql_model);
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="largeModalLabel">Edit Model</h4>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
				<div class="row clearfix demo-masked-input">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Nama Model</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" name="nama" value="<?php echo $data['nama']?>">
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
							<div class="form-inline">
								<select class="form-control show-tick">
									<option value="">-- pilih --</option>
									<?php
									while($data){
									?>
									<option value="<?php echo $data['nutrisi']; ?>"><?php echo $data['nutrisi']; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-link waves-effect">SIMPAN</button>
			<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
		</div>
	</div>
</div>
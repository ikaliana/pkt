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
	<!--button type="button" id="btnEditSimpan" onclick="editPupuk()" class="btn btn-link waves-effect">SIMPAN</button-->
	<button type="button" id="btnEditSimpan" class="btn btn-link waves-effect">SIMPAN</button>
	<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
</div>
	

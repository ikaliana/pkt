<?php
include('../config.php');
$id = strtoupper($_GET['id']);
$sql_area = pg_query($db_conn, "SELECT * FROM pkt_area where kode_area='".$id."'");
$data = pg_fetch_assoc($sql_area);

if(isset($_POST['simpan'])){
	$nama 		= $_POST['nama'];
	$lokasi 	= $_POST['lokasi'];
	$deskripsi 	= $_POST['deskripsi'];
	
		
		$sql = pg_query($db_conn, "UPDATE pkt_area WHERE kode_area='".$id."'");
		if($sql){
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("Yes!","Data berhasil diperbarui!","success");';
			echo '});</script>';
		}else{
			echo '<script type="text/javascript">';
			echo 'setTimeout(function () { swal("Kesalahan!","Data gagal diperbarui!","warning");';
			echo '});</script>';
		}
}
?>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="largeModalLabel">Edit Area</h4>
		</div>
		<div class="modal-body">
			<form action="" method="POST" class="form-horizontal">
				<div class="row clearfix demo-masked-input">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Nama Area</label>
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
						<label for="area">Lokasi</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" name="lokasi" value="<?php echo $data['lokasi']?>">
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Deskripsi</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<textarea class="form-control docs-date" name="deskripsi"><?php echo $data['deskripsi']?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Area (*.shp, *.shx, and *.dbf file)</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input name="inputshp[]" id="inputshp" type="file" multiple class="file" data-show-preview="false">
								<script>
									$("#inputshp").fileinput({
										showUpload: false,
										allowedFileExtensions: ['shp', 'dbf', 'shx'],
										theme: "fa",
									});
								</script>
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="modal-footer">
			<input type="submit" name="simpan" class="btn btn-link waves-effect" value="SIMPAN"></input>
			<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
		</div>
		</form>
	</div>
</div>
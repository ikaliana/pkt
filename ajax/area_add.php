<script type="text/javascript">
function addArea()
{
	var htmlobjek;
    var area_id = +id;
    $.ajax({
        url: "ajax/area_add.php",
        data: "id="+area_id,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=dept>
            $("#tampil_detail").html(msg);
        }
    });
}
</script>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="largeModalLabel">Tambah Area Baru</h4>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
				<div class="row clearfix demo-masked-input">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Tanggal</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control docs-date" id="date" name="date" placeholder="Pick a date" data-toggle="datepicker" value="">
							</div>
						</div>
						<script>
						$(function() {
						  $('[data-toggle="datepicker"]').datepicker({
							autoHide: true,
							zIndex: 2048,
						  });
						});
					  </script>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Area</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" name="area_name"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Shapefile batas area (*.shp, *.shx, *.dbf file)</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input name="inputshp" id="inputshp" type="file" class="file" data-show-preview="false" multiple 
    data-show-upload="true" required>
								<script>
									$("#inputshp").fileinput({
										uploadUrl: "/shp",
										maxFileCount: 3
										showUpload: true,
										mainClass: "input-group-sm"
									});
								</script>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-link waves-effect">SIMPAN</button>
			<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">KELUAR</button>
		</div>
	</div>
</div>
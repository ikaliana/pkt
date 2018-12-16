<script type="text/javascript">
    $(document).ready(function (e) {
        $('#save').on('click', function () {

            var form_data = new FormData();
			var lokasi = $("#lokasi").val();
			var area_name = $("#area_name").val();
			var deskripsi = $("#deskripsi").val();

			if(area_name == "") { setTimeout(function () { swal("","Isikan nama area perkebunan","error")}); return; }

            var ins = document.getElementById('multiSHP').files.length;
            for (var x = 0; x < ins; x++) {
                form_data.append("shp[]", document.getElementById('multiSHP').files[x]);
            }
			form_data.append("lokasi", lokasi);
			form_data.append("area_name", area_name);
			form_data.append("deskripsi", deskripsi);

			swal({
		        title: "Konfirmasi",
		        text: "Simpan data dan unggah citra?",
		        type: "info",
		        showCancelButton: true,
		        closeOnConfirm: false,
		        showLoaderOnConfirm: true,
		    }, function () {
				//console.log(tanggal,area,files[0]);
	            $.ajax({
	                url: './ajax/area_add_action.php', // point to server-side PHP script 
	                dataType: 'text', // what to expect back from the PHP script
	                cache: false,
	                contentType: false,
	                processData: false,
	                data: form_data,
	                type: 'post',
	                success: function (response) {
	                    $('#hasil_add_area').html(response); // display success response from the PHP script
	                },
	                error: function (response) {
	                    $('#hasil_add_area').html(response); // display error response from the PHP script
	                }
	            });
		    });
        });
    });
</script>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<div class="media">
				<div class="media-left">
					<a href="#">
						<img class="media-object" src="images/icon/map.png" alt="Area Perkebunan" width="20">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading">Tambah Area</h4>
				</div>
			</div>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Area</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" id="area_name" required></input>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="lokasi">Lokasi</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" id="lokasi" required></input>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="dekskripsi">Deskripsi</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" id="deskripsi" required></input>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Shapefile batas area (*.shp, *.shx, *.dbf, & *.prj file)</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input name="shp[]" id="multiSHP" type="file" class="file" data-show-preview="false" multiple 
    data-show-upload="false" required>
								<script>
									$("#multiSHP").fileinput({
										maxFileCount: 4,
										mainClass: "input-group-sm",
										allowedFileExtensions: ["shp", "shx", "dbf", "prj"],
									});
								</script>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" id="save" class="btn btn-link waves-effect">SIMPAN</button>
			<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">KELUAR</button>
		</div>
		<div id="hasil_add_area">
		</div>
	</div>
</div>
<script type="text/javascript">
            $(document).ready(function (e) {
                $('#save2').on('click', function () {
                    var form_data = new FormData();
					var tanggal = $("#tanggal").val();
					var area = $("#area").val();
                    var tif = $('#tif').prop('files')[0];
					form_data.append("tanggal", tanggal);
					form_data.append("area", area);
					form_data.append("tif", tif);
                    $.ajax({
                        url: './ajax/citra_add_action.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            $('#hasil_add_citra').html(response); // display success response from the PHP script
                        },
                        error: function (response) {
                            $('#hasil_add_citra').html(response); // display error response from the PHP script
                        }
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
						<img class="media-object" src="images/icon/satellite.png" alt="Area Perkebunan" width="20">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading">Tambah Citra</h4>
				</div>
			</div>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
				<div class="row clearfix demo-masked-input">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Tanggal Akuisi</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control docs-date" id="tanggal" name="tanggal" placeholder="Pick a date" data-toggle="datepicker">
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
							<div class="form-inline">
								<select class="form-control show-tick" id="area" name="area">
									<option value="0" selected>-- pilih --</option>
									<?php
										$sql_area = pg_query($db_conn, "SELECT nama, kode_area FROM pkt_area");
										while($data = pg_fetch_assoc($sql_area)){
										echo "<option value='".$data['kode_area']."'>".$data['nama']."</option>";
										};
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Citra (*.tif file)</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input name="" id="tif" type="file" class="file" data-show-preview="false" data-show-upload="false" required>
								<script>
									$("#tif").fileinput({
										maxFileCount: 1
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
			<button type="button" id="save2" class="btn btn-link waves-effect">SIMPAN</button>
			<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">KELUAR</button>
		</div>
		<div id="progress-div"><div id="progress-bar"></div></div>
		<div id="targetLayer"></div>
		<div id="hasil_add_citra">
		</div>
	</div>
</div>
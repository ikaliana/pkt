<script type="text/javascript">
            $(document).ready(function (e) {
                $('#save').on('click', function () {
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
                        url: './ajax/model_add_action.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            $('#hasil_add_model').html(response); // display success response from the PHP script
                        },
                        error: function (response) {
                            $('#hasil_add_model').html(response); // display error response from the PHP script
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
						<img class="media-object" src="images/icon/model.png" alt="Model perhitungan" width="20">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading">Tambah Model</h4>
				</div>
			</div>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Nama model</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" id="model_name" required placeholder="masukkan nama model"></input>
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
								<select class="form-control show-tick" id="nutrisi" name="nutrisi">
									<option value="" selected>-- pilih --</option>
									<option value="N">N</option>
									<option value="P">P</option>
									<option value="K">K</option>
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
										<label>Band 2</label> <input type="text" class="form-control" id="b2" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<div class="form-line">
										<label>Band 3</label> <input type="text" class="form-control" id="b3" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<div class="form-line">
										<label>Band 4</label> <input type="text" class="form-control" id="b4" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<div class="form-line">
										<label>Band 8</label> <input type="text" class="form-control" id="b8" required placeholder="0"></input>
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
										<label>Band 5</label> <input type="text" class="form-control" id="b5" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<label>Band 6</label> <input type="text" class="form-control" id="b6" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<label>Band 7</label> <input type="text" class="form-control" id="b7" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<label>Band 8a</label> <input type="text" class="form-control" id="b8a" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<label>Band 11</label> <input type="text" class="form-control" id="b11" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<label>Band 12</label> <input type="text" class="form-control" id="b12" required placeholder="0"></input>
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
										<label>Band 1</label> <input type="text" class="form-control" id="b1" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<label>Band 9</label> <input type="text" class="form-control" id="b9" required placeholder="0"></input>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<div class="form-line">
										<label>Band 10</label> <input type="text" class="form-control" id="b10" required placeholder="0"></input>
									</div>
								</div>
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
		<div id="hasil_add_model">
		</div>
	</div>
</div>
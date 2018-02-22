<?php
	$id = $_GET['id'];
	$sql = pg_query($db_conn, "SELECT * FROM pkt_model where id_model='".$id."'");
	$data = pg_fetch_assoc($sql);
	$nutrisi_selected = $data['nutrisi'];
	$bands = array("1","2","3","4","5","6","7","8","8a","9","10","11","12");
?>
<script type="text/javascript">
            $(document).ready(function (e) {
                $('#save').on('click', function () {
                    var form_data = new FormData();
                    var bands = <?php echo json_encode($bands); ?>;

					form_data.append("id_model",$("#id_model").val());
					form_data.append("model_name",$("#model_name").val());
					form_data.append("nutrisi",$("#nutrisi").val());
					form_data.append("constant",$("#constant").val());

					for(var band of bands) {
						var id = "b" + band;
						var id2 = id + "_2";
						form_data.append(id,$("#" + id).val());
						form_data.append(id2,$("#" + id2).val());
					}

					// for (var pair of form_data.entries()) {
					//     console.log(pair[0]+ ', ' + pair[1]); 
					// }

                    $.ajax({
                        url: './ajax/model_edit_action.php', // point to server-side PHP script 
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
	<section class="content">
        <div class="container-fluid">
            
            <div class="block-header">
                <h2>MODEL PERHITUNGAN NUTRISI</h2>
            </div>

            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">

                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="media">
										<div class="media-left">
											<a href="#">
												<img class="media-object" src="images/icon/model.png" alt="Area Perkebunan" width="20">
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">Edit Model <?php echo $data['nama'];?></h4>
										</div>
									</div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li>
									<button class="btn btn-xs bg-deep-orange waves-effect" style="cursor: pointer;" onclick="window.location.replace('index.php?p=model_content'); "aria-expanded="false"><i class="material-icons">arrow_back</i> KEMBALI</button>
								</li>
                            </ul>
                        </div>

                        <div class="body">
                            <form class="form-horizontal">
								<div class="row clearfix">
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
										<label for="area">Nama model</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
										<div class="form-group">
											<div class="form-line">
												<input type="text" class="form-control" id="model_name" required value="<?php echo $data['nama'];?>"></input>
												<input type="text" style="display:none;" id="id_model" value="<?php echo $id; ?>"></input>
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
										<label for="nutrisi">Koefisien</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
										<div class="table-responsive">
											<table id="pupuk_table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
					                            <thead>
					                                <tr>
					                                    <th class="text-center" style="width:20%">Band</th>
														<th class="text-center" style="width:40%;padding-right:10px">X</th>
														<th class="text-center" style="width:40%;padding-right:10px">X^2</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            		foreach($bands as $band) {
					                            	?>
					                            	<tr>
					                            		<td class="text-center"><?php echo $band; ?></td>
					                            		<td>
					                            			<input type="text" class="form-control text-center" id="b<?php echo $band; ?>" required value="<?php echo $data['band'.$band]; ?>"></input>
					                            		</td>
					                            		<td>
					                            			<input type="text" class="form-control text-center" id="b<?php echo $band; ?>_2" required value="<?php echo $data['band'.$band.'_2']; ?>"></input>
					                            		</td>
					                            	</tr>
					                            	<?php } ?>
					                            </tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
										<label for="area">Konstanta</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
										<div class="form-group">
											<div class="form-line">
												<input type="text" class="form-control" id="constant" required value="<?php echo $data['constant']; ?>"></input>
											</div>
										</div>
									</div>
								</div>
							</form>
							<div class="modal-footer">
								<a type="button" id="save" class="btn btn-link waves-effect">SIMPAN</a>
							</div>
							<div id="hasil_edit_model"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

<div class="modal-dialog modal-lg" role="document" style="display:none">
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
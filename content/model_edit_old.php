<?php

$id = $_GET['id'];
$sql = pg_query($db_conn, "SELECT * FROM pkt_model where id_model='".$id."'");
$data = pg_fetch_assoc($sql);
$nutrisi_selected = $data['nutrisi'];
?>
<script type="text/javascript">
	function editModel() {
		var model_name 	= 	$("#model_name").val();
		var nutrisi 	= 	$("#nutrisi").val();
		var b1 			= 	$("#b1").val();
		var b2			=	$("#b2").val();
		var b3			=	$("#b3").val();
		var b4			=	$("#b4").val();
		var b5			=	$("#b5").val();
		var b6			=	$("#b6").val();
		var b7			=	$("#b7").val();
		var b8			=	$("#b8").val();
		var b8a			=	$("#b8a").val();
		var b9			=	$("#b9").val();
		var b10			=	$("#b10").val();
		var b11			=	$("#b11").val();
		var b12			=	$("#b12").val();
		if (model_name.length == 0 || nutrisi.length == 0 || b1.length == 0 || b2.length == 0 || b3.length == 0 ||b4.length == 0 || b5.length == 0 || b6.length == 0 || b7.length == 0 || b8.length == 0 || b8a.length == 0 ||	b9.length == 0 || b10.length == 0 || b11.length == 0 || b12.length == 0
		) 
		  {
			setTimeout(function () { swal("Oh tidak!","Semua isian wajib diisi!","error");
			});
			return false;
		  }else{
			if(isNaN(b1) || isNaN(b2) || isNaN(b3) || isNaN(b4) || isNaN(b5) || isNaN(b6) || isNaN(b7) || isNaN(b8) || isNaN(b8a) || isNaN(b9) || isNaN(b10) || isNaN(b11) || isNaN(b12)){
				setTimeout(function () { swal("Oh tidak!","Isian band harus dalam angka!","error");
				});
				return false;
			}else{
				var form_data = new FormData();
				form_data.append("id_model",$("#id_model").val());
				form_data.append("model_name",model_name);
				form_data.append("nutrisi",nutrisi);
				form_data.append("b1",b1);
				form_data.append("b2",b2);
				form_data.append("b3",b3);
				form_data.append("b4",b4);
				form_data.append("b5",b5);
				form_data.append("b6",b6);
				form_data.append("b7",b7);
				form_data.append("b8",b8);
				form_data.append("b8a",b8a);
				form_data.append("b9",b9);
				form_data.append("b10",b10);
				form_data.append("b11",b11);
				form_data.append("b12",b12);
				$.ajax({
					url: './ajax/model_edit_action.php', // point to server-side PHP script 
					dataType: 'text', // what to expect back from the PHP script
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function (response) {
						$('#hasil_edit_model').html(response); // display success response from the PHP script
						setTimeout(function () {
						   window.location.replace("index.php?p=model_content");
						}, 2000);
					},
					error: function (response) {
						$('#hasil_edit_model').html(response); // display error response from the PHP script
					}
				});
			}
		  }
}	
</script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>MODEL PERHITUNGAN NUTRISI</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
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
											<h4 class="media-heading">Edit <?php echo $data['nama'];?></h4>
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
								<a type="button" onclick="editModel()" class="btn btn-link waves-effect">SIMPAN</a>
								<a type="button" class="btn btn-link waves-effect" data-dismiss="modal">KELUAR</a>
							</div>
						<div id="hasil_edit_model"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
        </div>
    </section>
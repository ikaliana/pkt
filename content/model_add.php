<?php
	$bands = array("1","2","3","4","5","6","7","8","8a","9","10","11","12");
?>
<script type="text/javascript">
    $(document).ready(function (e) {
        $('#save').on('click', function () {
            var form_data = new FormData();
            var bands = <?php echo json_encode($bands); ?>;
			form_data.append("model_name",$("#model_name").val());
			form_data.append("nutrisi",$("#nutrisi").val());
			form_data.append("constant",$("#constant").val());

			for(var band of bands) {
				var id = "b" + band;
				var id2 = id + "_2";
				form_data.append(id,$("#" + id).val());
				form_data.append(id2,$("#" + id2).val());
			}

			for (var pair of form_data.entries()) {
			    console.log(pair[0]+ ', ' + pair[1]); 
			}
			// return;

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
											<h4 class="media-heading">Tambah Model</h4>
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
												<input type="text" class="form-control" id="model_name" required value=""></input>
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
										<label for="nutrisi">Koefisien</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
										<div class="table-responsive">
											<table id="pupuk_table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
					                            <thead>
					                                <tr>
					                                    <th class="text-center" style="width:20%">Band</th>
														<th class="text-center" style="width:40%;padding-right:10px">X</th>
														<th class="text-center" style="width:40%;padding-right:10px">X<sup>2</sup></th>  
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            		foreach($bands as $band) {
					                            	?>
					                            	<tr>
					                            		<td class="text-center"><?php echo $band; ?></td>
					                            		<td>
					                            			<input type="text" class="form-control text-center" id="b<?php echo $band; ?>" required value="0"></input>
					                            		</td>
					                            		<td>
					                            			<input type="text" class="form-control text-center" id="b<?php echo $band; ?>_2" required value="0"></input>
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
												<input type="text" class="form-control" id="constant" required value="0"></input>
											</div>
										</div>
									</div>
								</div>
							</form>
							<div class="modal-footer">
								<a type="button" id="save" class="btn btn-link waves-effect">SIMPAN</a>
							</div>
							<div id="hasil_add_model"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>


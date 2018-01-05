	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>HASIL PERHITUNGAN</h2>
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
                                    <h2>Daftar Hasil Perhitungan</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <!--
                                            <th width="25%" style="text-align:center;">Area</th>
                                            <th width="15%" style="text-align:center;">Tanggal Citra Sentinel</th>
                                            <th width="5%" style="text-align:center;">Model N</th>
											<th width="5%" style="text-align:center;">Model P</th>
											<th width="5%" style="text-align:center;">Model K</th>
											<th width="25%" style="text-align:center;">Tanggal Analisis</th>
											<th width="20%" style="text-align:center;">Action</th>	
											-->
                                            <th width="35%" style="text-align:center;">Area</th>
                                            <th width="20%" style="text-align:center;">Tanggal Citra Sentinel</th>
											<th width="25%" style="text-align:center;">Tanggal Analisis</th>
											<th width="20%" style="text-align:center;">Action</th>	
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <!--
                                            <th width="25%" style="text-align:center;">Area</th>
                                            <th width="15%" style="text-align:center;">Tanggal Citra Sentinel</th>
                                            <th width="5%" style="text-align:center;">Model N</th>
											<th width="5%" style="text-align:center;">Model P</th>
											<th width="5%" style="text-align:center;">Model K</th>
											<th width="25%" style="text-align:center;">Tanggal Analisis</th>
											<th width="20%" style="text-align:center;">Action</th>	
											-->
                                            <th width="35%" style="text-align:center;">Area</th>
                                            <th width="20%" style="text-align:center;">Tanggal Citra Sentinel</th>
											<th width="25%" style="text-align:center;">Tanggal Analisis</th>
											<th width="20%" style="text-align:center;">Action</th>	
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
											$query = "";
											$query .= "select a.kode_analisis,a.tanggal_analisis";
											$query .= ",c.kode_citra,c.nama_file as nama_file_citra,c.tanggal as tanggal_citra";
											$query .= ",a.kode_model_n,a.kode_model_n_tanah ";
											$query .= ",a.kode_model_p,a.kode_model_p_tanah ";
											$query .= ",a.kode_model_k,a.kode_model_k_tanah ";
											$query .= ",ar.kode_area,ar.nama as nama_area ";
											$query .= "from pkt_analisis a ";
											$query .= "left join pkt_citra c on a.kode_citra = c.kode_citra ";
											$query .= "left join pkt_area ar on c.kode_area = ar.kode_area";

											$sql_area = pg_query($db_conn, $query);
											while($data = pg_fetch_assoc($sql_area)){
                                        ?>
											<tr>
												<td><?php echo $data['nama_area']; ?></td>
	                                            <td align="center"><?php echo date('d F Y',strtotime($data['tanggal_citra'])); ?></td>
	                                            <td align="center"><?php echo date('d F Y H:i:s',strtotime($data['tanggal_analisis'])); ?></td>
												<td align="center">
													<a style="cursor: pointer;" id="editData"
														data-kode="<?php echo $data['kode_analisis']; ?>" 
														data-citra="<?php echo $data['kode_citra']; ?>" 
														data-n="<?php echo $data['kode_model_n']; ?>" 
														data-p="<?php echo $data['kode_model_p']; ?>" 
														data-k="<?php echo $data['kode_model_k']; ?>" 
														data-nt="<?php echo $data['kode_model_n_tanah']; ?>" 
														data-pt="<?php echo $data['kode_model_p_tanah']; ?>" 
														data-kt="<?php echo $data['kode_model_k_tanah']; ?>" 
														>Edit</a> 
													| <a href="">Delete</a> 
													| <a href="index.php?p=hasil_content_detail&kd=<?php echo $data['kode_analisis']; ?>">Lihat</a>
												</td>
	                                        </tr>
										<?php } ?>

                                    </tbody>
                                </table>
                            </div>
							<div class="collapse" id="editHasil">
								<input type="hidden" name="id_analisis" id="id_analisis">
								<h2 class="card-inside-title">Detail Hasil Analisis</h2>
								<form class="form-horizontal">
									<div class="form-group">
										<label for="area" class="col-sm-2 control-label">Citra Sentinel</label>
										<div class="col-sm-10">
											<select class="form-control show-tick" id="cmbCitra">
												<option value="">-- pilih --</option>
												<?php
													$sql_txt = "";
													$sql_txt .= "select c.kode_citra,c.kode_area,a.nama,c.tanggal";
													$sql_txt .= ", a.nama || ' (' || c.tanggal || ')' as nama_citra";
													$sql_txt .= " from pkt_citra c";
													$sql_txt .= " left join pkt_area a on c.kode_area = a.kode_area";
													$sql_area = pg_query($db_conn, $sql_txt);
													while($data = pg_fetch_assoc($sql_area)){
														echo "<option value='".$data['kode_citra']."'>".$data['nama_citra']."</option>";
													};
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="area" class="col-sm-2 control-label">Area</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="area_name" id="area_name" readonly></input>
										</div>
									</div>
									<div class="form-group">
										<label for="area" class="col-sm-2 control-label">Model Daun</label>
										<div class="col-sm-3">
											<select class="form-control show-tick" id="cmbNDaun">
												<option value="">-- pilih model N Daun --</option>
												<?php
													$sql_area = pg_query($db_conn, "select id_model,nama from pkt_model where nutrisi='N'");
													while($data = pg_fetch_assoc($sql_area)){
													echo "<option value='".$data['id_model']."'>".$data['nama']."</option>";
													};
												?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control show-tick" id="cmbPDaun">
												<option value="">-- pilih model P Daun --</option>
												<?php
													$sql_area = pg_query($db_conn, "select id_model,nama from pkt_model where nutrisi='P'");
													while($data = pg_fetch_assoc($sql_area)){
													echo "<option value='".$data['id_model']."'>".$data['nama']."</option>";
													};
												?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control show-tick" id="cmbKDaun">
												<option value="">-- pilih model K Daun --</option>
												<?php
													$sql_area = pg_query($db_conn, "select id_model,nama from pkt_model where nutrisi='K'");
													while($data = pg_fetch_assoc($sql_area)){
													echo "<option value='".$data['id_model']."'>".$data['nama']."</option>";
													};
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="area" class="col-sm-2 control-label">Model Tanah</label>
										<div class="col-sm-3">
											<select class="form-control show-tick" id="cmbNTanah">
												<option value="">-- pilih model N Tanah --</option>
												<?php
													$sql_area = pg_query($db_conn, "select id_model,nama from pkt_model where nutrisi='N-Tanah'");
													while($data = pg_fetch_assoc($sql_area)){
													echo "<option value='".$data['id_model']."'>".$data['nama']."</option>";
													};
												?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control show-tick" id="cmbPTanah">
												<option value="">-- pilih model P Tanah --</option>
												<?php
													$sql_area = pg_query($db_conn, "select id_model,nama from pkt_model where nutrisi='P-Tanah'");
													while($data = pg_fetch_assoc($sql_area)){
													echo "<option value='".$data['id_model']."'>".$data['nama']."</option>";
													};
												?>
											</select>
										</div>
										<div class="col-sm-3">
											<select class="form-control show-tick" id="cmbKTanah">
												<option value="">-- pilih model K Tanah --</option>
												<?php
													$sql_area = pg_query($db_conn, "select id_model,nama from pkt_model where nutrisi='K-Tanah'");
													while($data = pg_fetch_assoc($sql_area)){
													echo "<option value='".$data['id_model']."'>".$data['nama']."</option>";
													};
												?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-2">
											<button id="btnAnalisis" type="button" class="btn btn-primary m-t-15 waves-effect">ANALISIS ULANG</button>
										</div>
										<div id="hasil_add_area" class="col-sm-8"></div>
									</div>
								</form>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
        </div>
    </section>

    <script type="text/javascript">
  //   	$('#myCollapsible').collapse({
		//   toggle: false
		// });

    	$('#cmbCitra').on('change', function() {
    		var txt = "";
    		if($(this).val() != "") {
    			txt = $("#cmbCitra option:selected").text();
    			var txts = txt.split("(");
    			txt = txts[0];
    		}
    		$("#area_name").val(txt);
    	});

		$('#editData').on('click', function (e) {
			e.preventDefault();

			var uid = $(this).data('kode'); // get id of clicked row
			var citra = $(this).data('citra');
			var n = $(this).data('n');
			var p = $(this).data('p');
			var k = $(this).data('k');
			var nt = $(this).data('nt');
			var pt = $(this).data('pt');
			var kt = $(this).data('kt');
			console.log(uid,citra,n,p,k,nt,pt,kt);

			$("#id_analisis").val(uid);
			$("#cmbCitra").val(citra).trigger('change');
			$("#cmbNDaun").val(n).trigger('change');
			$("#cmbPDaun").val(p).trigger('change');
			$("#cmbKDaun").val(k).trigger('change');
			$("#cmbNTanah").val(nt).trigger('change');
			$("#cmbPTanah").val(pt).trigger('change');
			$("#cmbKTanah").val(kt).trigger('change');

			$('#editHasil').collapse('show');
    	});

		$('#btnAnalisis').on('click', function () {
			var uid = $("#id_analisis").val();
			var citra = $("#cmbCitra").val();
			var n_daun = $("#cmbNDaun").val();
			var p_daun = $("#cmbPDaun").val();
			var k_daun = $("#cmbKDaun").val();
			var n_tanah = $("#cmbNTanah").val();
			var p_tanah = $("#cmbPTanah").val();
			var k_tanah = $("#cmbKTanah").val();
			
			//alert("test");

			if(citra=="") { setTimeout(function () { swal("","Pilih Citra Sentinel yang akan dianalisis","error")}); return; }
			if(n_daun=="") { setTimeout(function () { swal("","Pilih salah satu model Nitrogen Daun","error")}); return; }
			if(p_daun=="") { setTimeout(function () { swal("","Pilih salah satu model Fosfor Daun","error")}); return; }
			if(k_daun=="") { setTimeout(function () { swal("","Pilih salah satu model Kalium Daun","error")}); return; }
			if(n_tanah=="") { setTimeout(function () { swal("","Pilih salah satu model Nitrogen Tanah","error")}); return; }
			if(p_tanah=="") { setTimeout(function () { swal("","Pilih salah satu model Fosfor Tanah","error")}); return; }
			if(k_tanah=="") { setTimeout(function () { swal("","Pilih salah satu model Kalium Tanah","error")}); return; }

            var form_data = new FormData();
			form_data.append("id", uid);
			form_data.append("citra", citra);
			form_data.append("n_daun", n_daun);
			form_data.append("p_daun", p_daun);
			form_data.append("k_daun", k_daun);
			form_data.append("n_tanah", n_tanah);
			form_data.append("p_tanah", p_tanah);
			form_data.append("k_tanah", k_tanah);
			// console.log(citra,n_daun,p_daun,k_daun,n_tanah,p_tanah,k_tanah,uid);
			// return;

	    	var swal_option = 	{
							        title: "Konfirmasi",
							        text: "Jalankan proses perhitungan ulang?",
							        type: "info",
							        showCancelButton: true,
							        closeOnConfirm: false,
							        showLoaderOnConfirm: true,
							    };

			swal(swal_option,
				function () {
					var request = new XMLHttpRequest();
					request.responseType = 'text';
					request.onload = function () {
					    if (request.readyState === request.DONE) {
					        if (request.status === 200) {
					            var res = JSON.parse(request.response);
					            if(res.type == "success") {
					            	// swal(res.title, res.text, res.type);
					            	location.href = './index.php?p=hasil_content_detail&kd=' + res.ID;
					            }
					            else swal(res.title, res.text, res.type);
					        }
					        else swal("Error!", request.response, "error");
					    }
					};

					request.open("POST", './ajax/analisis_edit_action.php');
					request.send(form_data);
				});
        });    	
    </script>
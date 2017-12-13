<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ANALISIS BARU</h2>
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
                                    <h2>Perhitungan Rekomendasi Pupuk</h2>
                                </div>
                            </div>
                            <!--ul class="header-dropdown m-r--5">
								<li>
									<button class="btn btn-xs bg-blue waves-effect" data-toggle="collapse" style="cursor: pointer;" data-target="#tambahCitra" aria-expanded="false" aria-controls="tambahCitra"><i class="material-icons">add_box</i> TAMBAH</button>
									
								</li>
                            </ul-->
                        </div>
                        <div class="body">
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
										<button id="btnAnalisis" type="button" class="btn btn-primary m-t-15 waves-effect">ANALISIS</button>
									</div>
									<div id="hasil_add_area" class="col-sm-8"></div>
								</div>
							</form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
        </div>
    </section>
    <script type="text/javascript">
    	$('#cmbCitra').on('change', function() {
    		var txt = "";
    		if($(this).val() != "") {
    			txt = $("#cmbCitra option:selected").text();
    			var txts = txt.split("(");
    			txt = txts[0];
    		}
    		$("#area_name").val(txt);
    	});

		$('#btnAnalisis').on('click', function () {
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
			form_data.append("citra", citra);
			form_data.append("n_daun", n_daun);
			form_data.append("p_daun", p_daun);
			form_data.append("k_daun", k_daun);
			form_data.append("n_tanah", n_tanah);
			form_data.append("p_tanah", p_tanah);
			form_data.append("k_tanah", k_tanah);

			var request = new XMLHttpRequest();
			request.responseType = 'text';
			request.onload = function () {
			    if (request.readyState === request.DONE) {
			        if (request.status === 200) {
			            //$('#hasil_add_area').html(request.response);
			            var res = request.response.split("|");
			            if (res.length > 1) {
			            	location.href = './index.php?p=hasil_content_detail&kd=' + res[0];
			            }
			            else {
			            	$('#hasil_add_area').html(request.response);
			            }
			        }
			    }
			};

			request.open("POST", './ajax/analisis_add_action.php');
			request.send(form_data);

            // $.ajax({
            //     url: './ajax/analisis_add_action.php', // point to server-side PHP script 
            //     dataType: 'text', // what to expect back from the PHP script
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     data: form_data,
            //     type: 'post',
            //     success: function (response) {
            //         $('#hasil_add_area').html(response); // display success response from the PHP script
            //     },
            //     error: function (response) {
            //         $('#hasil_add_area').html(response); // display error response from the PHP script
            //     }
            // });
        });    	
    </script>
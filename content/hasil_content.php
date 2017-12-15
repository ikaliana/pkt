<script type="text/javscript">
	function hapus() {
		swal({
			title: "Ajax request example",
			text: "Submit to run ajax request",
			type: "info",
			showCancelButton: true,
			closeOnConfirm: false,
			showLoaderOnConfirm: true,
		}, function () {
			setTimeout(function () {
				swal("Ajax request finished!");
			}, 2000);
		});
	}
</script>
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
													<a data-toggle="collapse" style="cursor: pointer;" data-target="#editHasil" aria-expanded="false" aria-controls="editHasil">Edit</a> 
													| <a href="">Delete</a> 
													| <a href="index.php?p=hasil_content_detail&kd=<?php echo $data['kode_analisis']; ?>">Lihat</a>
												</td>
	                                        </tr>
										<?php } ?>

                                    </tbody>
                                </table>
                            </div>
							<div class="collapse" id="editHasil">
									<h2 class="card-inside-title">Detail Hasil Analisis</h2>
									<form class="form-horizontal">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="citra_sentinel">Citra Sentinel</label>
											</div>
											<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control show-tick">
															<option value="">-- pilih --</option>
															<option value="10" selected>25 Mei 2017</option>
															<option value="20">22 Agustus 2017</option>
															<option value="30">22 Agustus 2017</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="area">Area</label>
											</div>
											<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="area" class="form-control" placeholder="masukkan area" value="Kebun Jonggol">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="citra_sentinel">Model N</label>
											</div>
											<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control show-tick">
															<option value="">-- pilih --</option>
															<option value="10" selected>Model Jonggol</option>
															<option value="10">Model Standard</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="citra_sentinels">Model P</label>
											</div>
											<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select id="select_model" class="form-control show-tick">
															<option value="">-- pilih --</option>
															<option value="10" selected>Model Jonggol</option>
															<option value="10">Model Standard</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="citra_sentinel">Model K</label>
											</div>
											<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control">
															<option value="">-- pilih --</option>
															<option value="10" selected>Model Jonggol</option>
															<option value="10">Model Standard</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
												<button type="button" class="btn btn-primary m-t-15 waves-effect">JALANKAN</button>								
												<button type="button" class="btn btn-success m-t-15 waves-effect">LIHAT HASIL</button>
											</div>
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
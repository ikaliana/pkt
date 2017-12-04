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
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th width="25%" style="text-align:center;">Area</th>
                                            <th width="15%" style="text-align:center;">Tanggal Citra Sentinel</th>
                                            <th width="5%" style="text-align:center;">Model N</th>
											<th width="5%" style="text-align:center;">Model P</th>
											<th width="5%" style="text-align:center;">Model K</th>
											<th width="25%" style="text-align:center;">Tanggal Analisis</th>
											<th width="20%" style="text-align:center;">Action</th>	
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th style="text-align:center;">Area</th>
                                            <th style="text-align:center;">Tanggal Citra Sentinel</th>
                                            <th style="text-align:center;">Model N</th>
											<th style="text-align:center;">Model P</th>
											<th style="text-align:center;">Model K</th>
											<th style="text-align:center;">Tanggal Analisis</th>
											<th style="text-align:center;">Action</th>	
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Kebun Jonggol</td>
                                            <td>25 Mei 2017</td>
                                            <td>Model Jonggol</td>
											<td>Model Jonggol</td>
											<td>Model Jonggol</td>
											<td>1 Agustus 2017 17:00</td>
											<td>
												<a data-toggle="collapse" style="cursor: pointer;" data-target="#editHasil" aria-expanded="false" aria-controls="editHasil">Edit</a> | <a href="">Delete</a> | <a href="">Lihat</a>
											</td>
                                        </tr>
										<tr>
                                            <td>PTPN VI Afd 3 Blok 320</td>
                                            <td>22 Agustus 2017</td>
                                            <td>Model Standard</td>
											<td>Model Standard</td>
											<td>Model Standard</td>
											<td>3 September 2017 13:45</td>
											<td>
												<a data-toggle="collapse" style="cursor: pointer;" data-target="#editHasil" aria-expanded="false" aria-controls="editHasil">Edit</a> | <a href="">Delete</a> | <a href="">Lihat</a>
											</td>
                                        </tr>
										<tr>
                                            <td>PTPN VI Afd 2 Blok 210</td>
                                            <td>22 Agustus 2017</td>
                                            <td>Model Standard</td>
											<td>Model Standard</td>
											<td>Model Standard</td>
											<td>3 September 2017 13:43</td>
											<td>
												<a data-toggle="collapse" style="cursor: pointer;" data-target="#editHasil" aria-expanded="false" aria-controls="editHasil">Edit</a> | <a href="">Delete</a> | <a href="">Lihat</a>
											</td>
                                        </tr>
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
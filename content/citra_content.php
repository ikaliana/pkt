<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>CITRA SENTINEL</h2>
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
                                    <h2>Daftar Citra</h2>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
								<li>
									<button class="btn btn-xs bg-blue waves-effect" data-toggle="collapse" style="cursor: pointer;" data-target="#tambahCitra" aria-expanded="false" aria-controls="tambahCitra"><i class="material-icons">add_box</i> TAMBAH</button>
									
								</li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="citra_table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Area</th>
                                            <th>Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Tanggal</th>
                                            <th>Area</th>
                                            <th>Action</th>   
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
										$sql_citra = pg_query($db_conn, "SELECT c.tanggal, a.nama FROM pkt_citra as c, pkt_area as a WHERE c.kode_area = a.kode_area");
										while($data = pg_fetch_assoc($sql_citra)){
											$date = strtotime( $data['tanggal'] );
											$tanggal = date( 'd M Y', $date );
                                        ?>
                                        <tr>
                                            <td><?php echo $tanggal;?></td>
                                            <td><?php echo $data['nama'];?></td>
                                            <td>
												<a data-toggle="collapse" style="cursor: pointer;" data-target="#editCitra" aria-expanded="false" aria-controls="editCitra">Edit</a> | <a href="">Delete</a>
											</td>
                                        </tr>
										<?php } ?>
                                    </tbody>
                                </table>
								<script type="text/javascript">
									$(document).ready(
									function() {
									  $('#citra_table').DataTable();
									  responsive: true
									});
								  
								</script>
                            </div>
							<div class="collapse" id="editCitra">
									<h2 class="card-inside-title">Tambah Data Citra</h2>
								<form class="form-horizontal">
									<div class="row clearfix demo-masked-input">
										<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
											<label for="area">Tanggal</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control docs-date" name="date" placeholder="Pick a date" data-toggle="datepicker" value="25/09/2017">
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
													<select class="form-control show-tick">
														<option value="">-- pilih --</option>
														<option value="10" selected>Kebun Jonggol</option>
														<option value="20">PTPN VI Afd 3 Blok 320</option>
														<option value="20">PTPN VI Afd 2 Blok 210</option>
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
												<div class="form-inline">
													<input name="ktm" id="inputKTM" type="file" class="file" data-preview-file-type="text" required>
													<script>
														$("#inputKTM").fileinput({
															showUpload: false,
															mainClass: "input-group-sm"
														});
													</script>
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
											<button type="button" class="btn btn-primary m-t-15 waves-effect">UBAH</button>								
										</div>
									</div>
								</form>
							</div>
							<div class="collapse" id="tambahCitra">
								<h2 class="card-inside-title">Tambah Data Citra</h2>
								<form class="form-horizontal">
									<div class="row clearfix demo-masked-input">
										<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
											<label for="area">Tanggal</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="text" class="form-control docs-date" name="date" placeholder="Pick a date" data-toggle="datepicker">
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
													<select class="form-control show-tick">
														<option value="" selected>-- pilih --</option>
														<option value="10">Kebun Jonggol</option>
														<option value="20">PTPN VI Afd 3 Blok 320</option>
														<option value="20">PTPN VI Afd 2 Blok 210</option>
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
												<div class="form-inline">
													<input name="ktm" id="inputKTM" type="file"  required>
													<script>
														$("#inputKTM").fileinput({
															showUpload: false,
															mainClass: "input-group-sm"
														});
													</script>
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
											<button type="button" class="btn btn-primary m-t-15 waves-effect">TAMBAH</button>								
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
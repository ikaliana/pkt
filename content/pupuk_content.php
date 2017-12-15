	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DAFTAR PUPUK</h2>
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
												<img class="media-object" src="images/icon/fertilizer.png" alt="Area Perkebunan" width="20">
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">Daftar Pupuk</h4>
										</div>
									</div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li>
									<button class="btn btn-xs bg-grey waves-effect" style="cursor: pointer;" onclick="window.location.reload(); "aria-expanded="false"><i class="material-icons">replay</i> REFRESH</button>
									
								</li>
                                <li>
									<button class="btn btn-xs bg-blue waves-effect" data-toggle="modal" style="cursor: pointer;" data-target="#tambahPupuk" aria-expanded="false" aria-controls="tambahPupuk"><i class="material-icons">add_box</i> TAMBAH</button>
									
								</li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="pupuk_table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th width="45%">Nama Pupuk</th>
                                            <th width="10%">N</th>
                                            <th width="10%">P</th>
											<th width="10%">K</th>
											<th width="25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Nama Pupuk</th>
                                            <th>N</th>
                                            <th>P</th>
											<th>K</th>
                                            <th>Action</th>   
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
										$sql_model = pg_query($db_conn, "SELECT * FROM pkt_pupuk");
										while($data = pg_fetch_assoc($sql_model)){
                                        ?>
										<tr>
                                            <td><?php echo $data['nama_pupuk']; ?></td>
                                            <td><?php echo $data['komposisi_n']; ?></td>
                                            <td><?php echo $data['komposisi_p']; ?></td>
                                            <td><?php echo $data['komposisi_k']; ?></td>
                                            <td>
												<a data-toggle="collapse" style="cursor: pointer;" data-target="#editPupuk" aria-expanded="false" aria-controls="editPupuk">Edit</a> | <a href="">Delete</a>
											</td>
                                        </tr>
										<?php 
										}?>
                                    </tbody>
                                </table>
								<script type="text/javascript">
									$(document).ready(
									function() {
									  $('#pupuk_table').DataTable();
									  responsive: true
									});
								  
								</script>
                            </div>
							<div class="collapse" id="editPupuk">
								<h2 class="card-inside-title">Detail Pupuk Urea</h2>
								<form class="form-horizontal">
									<div class="row clearfix">
										<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
											<label for="area">Nama Pupuk</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-line">
													<input type="text" id="namaPupukEdit" class="form-control" placeholder="masukkan nama pupuk" value="Urea">
												</div>
											</div>
										</div>
									</div>
									<div class="row clearfix">
										<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
											<label for="area">Komposisi</label>
										</div>
										<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
											<div class="form-group">
												<div class="form-inline">
													<div class="row">
														<div class="col-md-2 form-inline">
															<div class="col-xs-6">N</div><div class="col-xs-6"><input type="text" id="namaPupuk1" class="" placeholder="" value="45"></div>
														</div>
														<div class="col-md-2"></div>
														<div class="col-md-2">
															<div class="col-xs-6">P</div><div class="col-xs-6"><input type="text" id="namaPupuk2" class="" placeholder="" value="0"></div>
														</div>
														<div class="col-md-2"></div>
														<div class="col-md-2">
															<div class="col-xs-6">K</div><div class="col-xs-6"><input type="text" id="namaPupuk3" class="" placeholder="" value="0"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="row clearfix">
										<div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
											<button type="button" class="btn btn-primary m-t-15 waves-effect">SIMPAN</button>								
										</div>
									</div>
								</form>
							</div>
							<div class="modal fade" id="tambahPupuk">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title" id="largeModalLabel">Tambah Data Pupuk</h4>
										</div>
										<div class="modal-body">
											<form class="form-horizontal">
												<div class="row clearfix">
													<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
														<label for="area">Nama Pupuk</label>
													</div>
													<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
														<div class="form-group">
															<div class="form-line">
																<input type="text" id="namaPupuk" class="form-control" placeholder="masukkan nama pupuk" value="">
															</div>
														</div>
													</div>
												</div>
												<div class="row clearfix">
													<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
														<label for="area">Komposisi</label>
													</div>
													<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
														<div class="form-group">
															<div class="form-inline">
																<div class="col-md-4">
																	<div class="col-xs-2 form-control-label"><label for="area">N</label></div>
																	<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
																		<input type="text" id="pupuk_N" class="form-control" placeholder="0" value=""></div>
																</div>
																<div class="col-md-4">
																	<div class="col-xs-2 form-control-label"><label for="area">P</label></div>
																	<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
																		<input type="text" id="pupuk_P" class="form-control" placeholder="0" value=""></div>
																</div>
																<div class="col-md-4">
																	<div class="col-xs-2 form-control-label"><label for="area">K</label></div>
																	<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
																		<input type="text" id="pupuk_K" class="form-control" placeholder="0" value=""></div>
																</div>
																<!--div class="row">
																</div-->
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
										<div id="hasil_add_area">
										</div>

									</div>
								</div>
							</div>

                        </div>	
						
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->

        </div>
    </section>

<script type="text/javascript">
    $(document).ready(function (e) {
        $('#save').on('click', function () {
			var namaPupuk = $("#namaPupuk").val();
			var pupuk_N = $("#pupuk_N").val();
			var pupuk_P = $("#pupuk_P").val();
			var pupuk_K = $("#pupuk_K").val();

			if(namaPupuk=="") { setTimeout(function () { swal("","Isikan nama pupuk","error")}); return; }
			if(pupuk_N=="") { setTimeout(function () { swal("","Masukkan angka komposisi Nitrogen (N) dalam pupuk","error")}); return; }
			if(pupuk_P=="") { setTimeout(function () { swal("","Masukkan angka komposisi Fosfor (P) dalam pupuk","error")}); return; }
			if(pupuk_K=="") { setTimeout(function () { swal("","Masukkan angka komposisi Kalium (K) dalam pupuk","error")}); return; }

            var form_data = new FormData();
			form_data.append("nama_pupuk", namaPupuk);
			form_data.append("pupuk_n", pupuk_N);
			form_data.append("pupuk_p", pupuk_P);
			form_data.append("pupuk_k", pupuk_K);
            
            $.ajax({
                url: './ajax/pupuk_add_action.php', // point to server-side PHP script 
                dataType: 'text', // what to expect back from the PHP script
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('#hasil_add_area').html(response); // display success response from the PHP script
                },
                error: function (response) {
                    $('#hasil_add_area').html(response); // display error response from the PHP script
                }
            });
        });
    });
</script>
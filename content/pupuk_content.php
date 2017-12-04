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
                                    <h2>Daftar Pupuk</h2>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li>
									<button class="btn btn-xs bg-blue waves-effect" data-toggle="collapse" style="cursor: pointer;" data-target="#tambahPupuk" aria-expanded="false" aria-controls="tambahPupuk"><i class="material-icons">add_box</i> TAMBAH</button>
									
								</li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
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
                                        <tr>
                                            <td>Urea</td>
                                            <td>45</td>
											<td>0</td>
											<td>0</td>
                                            <td>
												<a data-toggle="collapse" style="cursor: pointer;" data-target="#editPupuk" aria-expanded="false" aria-controls="editPupuk">Edit</a> | <a href="">Delete</a>
											</td>
                                        </tr>
                                        <tr>
                                            <td>NPK</td>
                                            <td>15</td>
											<td>15</td>
											<td>15</td>
                                            <td>
												<a data-toggle="collapse" style="cursor: pointer;" data-target="#editPupuk" aria-expanded="false" aria-controls="editPupuk">Edit</a> | <a href="">Delete</a>
											</td>
                                        </tr>
										<tr>
                                            <td>NPK 2</td>
                                            <td>10</td>
											<td>10</td>
											<td>10</td>
                                            <td>
												<a data-toggle="collapse" style="cursor: pointer;" data-target="#editPupuk" aria-expanded="false" aria-controls="editPupuk">Edit</a> | <a href="">Delete</a>
											</td>
                                        </tr>
                                    </tbody>
                                </table>
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
													<input type="text" id="namaPupuk" class="form-control" placeholder="masukkan nama pupuk" value="Urea">
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
															<div class="col-xs-6">N</div><div class="col-xs-6"><input type="text" id="namaPupuk" class="" placeholder="" value="45"></div>
														</div>
														<div class="col-md-2"></div>
														<div class="col-md-2">
															<div class="col-xs-6">P</div><div class="col-xs-6"><input type="text" id="namaPupuk" class="" placeholder="" value="0"></div>
														</div>
														<div class="col-md-2"></div>
														<div class="col-md-2">
															<div class="col-xs-6">K</div><div class="col-xs-6"><input type="text" id="namaPupuk" class="" placeholder="" value="0"></div>
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
							<div class="collapse" id="tambahPupuk">
								<h2 class="card-inside-title">Tambah Data Pupuk</h2>
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
													<div class="row">
														<div class="col-md-2 form-inline">
															<div class="col-xs-6">N</div><div class="col-xs-6"><input type="text" id="namaPupuk" class="" placeholder="" value=""></div>
														</div>
														<div class="col-md-2"></div>
														<div class="col-md-2">
															<div class="col-xs-6">P</div><div class="col-xs-6"><input type="text" id="namaPupuk" class="" placeholder="" value=""></div>
														</div>
														<div class="col-md-2"></div>
														<div class="col-md-2">
															<div class="col-xs-6">K</div><div class="col-xs-6"><input type="text" id="namaPupuk" class="" placeholder="" value=""></div>
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
                        </div>	
                        </div>
						
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
        </div>
    </section>
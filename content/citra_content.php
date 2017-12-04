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
                                    <div class="media">
										<div class="media-left">
											<a href="#">
												<img class="media-object" src="images/icon/satellite.png" alt="Area Perkebunan" width="20">
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">Daftar Citra</h4>
										</div>
									</div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
								<li>
									<button class="btn btn-xs bg-grey waves-effect" style="cursor: pointer;" onclick="window.location.reload(); "aria-expanded="false"><i class="material-icons">replay</i> REFRESH</button>
									
								</li>
								<li>
									<button class="btn btn-xs bg-blue waves-effect" data-toggle="modal" style="cursor: pointer;" data-target="#tambah_citra" aria-expanded="false" aria-controls="tambah_citra"><i class="material-icons">add_box</i> TAMBAH</button>
									
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
										$sql_citra = pg_query($db_conn, "SELECT c.kode_citra as kode_citra, c.tanggal as tanggal, a.nama as nama FROM pkt_citra as c, pkt_area as a WHERE c.kode_area=a.kode_area");
										while($data = pg_fetch_assoc($sql_citra)){											
                                        ?>
                                        <tr>
                                            <td><?php echo $data['tanggal'];?></td>
                                            <td><?php echo $data['nama'];?></td>
                                            <td>
												<a data-toggle="modal" data-id="<?php echo $data['kode_citra']; ?>" id="getDetail" style="cursor: pointer;" data-color="grey" data-target="#tampil_detail" aria-expanded="false">Edit</a> | <a id="del_<?php echo $data['kode_citra']; ?>" style="cursor: pointer;" onclick="deleteArea('<?php echo $data['kode_citra'];?>', '<?php echo $data['nama'];?>')">Delete</a>
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
							<div class="modal fade" id="tambah_citra">
								<?php include('citra_add.php') ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
        </div>
    </section>
<script type="text/javascript">

function tampilArea(id)
{
	var htmlobjek;
    var area_id = +id;
    $.ajax({
        url: "ajax/area_edit.php",
        data: "id="+area_id,
        cache: false,
        success: function(msg){
            $("#tampil_detail").html(msg);
        }
    });
}


</script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>AREA LAHAN</h2>
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
                                    <h2>Daftar Area</h2>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li>
									<button class="btn btn-xs bg-blue waves-effect" data-toggle="modal" style="cursor: pointer;" data-target="#tambah_citra" aria-expanded="false" aria-controls="tambah_citra"><i class="material-icons">add_box</i> TAMBAH</button>
									
								</li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="area_table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th width="50%">Area</th>
                                            <th width="30%">Lokasi</th>
                                            <th width="20%">Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Area</th>
                                            <th>Lokasi</th>
                                            <th>Action</th>   
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
										$sql_area = pg_query($db_conn, "SELECT * FROM pkt_area");
										while($data = pg_fetch_assoc($sql_area)){
                                        ?>
										<tr>
                                            <td><?php echo $data['nama']; ?></td>
                                            <td><?php echo $data['lokasi']; ?></td>
                                            <td>
												<a data-toggle="modal" style="cursor: pointer;" onclick="tampilArea(<?php echo $data['kode_area'];?>)" data-color="grey" data-target="#tampil_detail" aria-expanded="false">Edit</a> | <a href="">Delete</a>
											</td>
                                        </tr>
										<?php 
										}?>
                                    </tbody>
                                </table>
								<script type="text/javascript">
									$(document).ready(
									function() {
									  $('#area_table').DataTable();
									  responsive: true
									});
								  
								</script>
                            </div>
							<div class="modal fade" id="tampil_detail"></div>
							<div class="modal fade" id="tambah_citra">
								<?php include('./ajax/area_add.php') ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
        </div>
    </section>
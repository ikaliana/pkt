<script type="text/javascript">

function editModel(id)
{
	var htmlobjek;
    var model_id = +id;
    $.ajax({
        url: "ajax/model_edit.php",
        data: "id="+model_id,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=dept>
            $("#tampil_detail2").html(msg);
        }
    });
}
</script>
<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>MODEL PERHITUNGAN NUTRISI</h2>
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
												<img class="media-object" src="images/icon/model.png" alt="Area Perkebunan" width="20">
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">Daftar Model</h4>
										</div>
									</div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li>
									<button class="btn btn-xs bg-grey waves-effect" style="cursor: pointer;" onclick="window.location.reload(); "aria-expanded="false"><i class="material-icons">replay</i> REFRESH</button>
									
								</li>
								<li>
									<button class="btn btn-xs bg-blue waves-effect" data-toggle="modal" style="cursor: pointer;" data-target="#tambah_area" aria-expanded="false" aria-controls="tambah_area"><i class="material-icons">add_box</i> TAMBAH</button>
									
								</li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="model_table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th width="50%">Nama Model</th>
                                            <th width="30%">Nutrisi</th>
                                            <th width="20%">Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Nama Model</th>
                                            <th>Nutrisi</th>
                                            <th>Action</th>   
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
										$sql_model = pg_query($db_conn, "SELECT * FROM pkt_model");
										while($data = pg_fetch_assoc($sql_model)){
                                        ?>
										<tr>
                                            <td><?php echo $data['nama']; ?></td>
                                            <td><?php echo $data['nutrisi']; ?></td>
                                            <td>
												<a data-toggle="modal" style="cursor: pointer;" onclick="editModel(<?php echo $data['id_model'];?>)" data-color="grey" data-target="#tampil_detail2" aria-expanded="false">Edit</a> | <a href="">Delete</a>
											</td>
                                        </tr>
										<?php 
										}?>
                                    </tbody>
                                </table>
								<script type="text/javascript">
									$(document).ready(
									function() {
									  $('#model_table').DataTable();
									  responsive: true
									});
								  
								</script>
                            </div>
							<div class="modal fade" id="tampil_detail2"></div>
							<div class="modal fade" id="tambah_model">
								<?php include('./ajax/model_add.php') ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
        </div>
    </section>
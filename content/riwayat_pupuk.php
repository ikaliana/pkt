	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>RIWAYAT PEMUPUKAN</h2>
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
												<img class="media-object" src="images/icon/fertilizer.png" alt="Riwayat Pemupukan" width="20">
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">Riwayat Pemupukan</h4>
										</div>
									</div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
								<li>
									<button class="btn btn-xs bg-grey waves-effect" style="cursor: pointer;" onclick="window.location.reload(); "aria-expanded="false"><i class="material-icons">replay</i> REFRESH</button>
									
								</li>
                                <li>
                                    <button class="btn btn-xs bg-blue waves-effect" data-toggle="modal" style="cursor: pointer;" data-target="#tambah_riwayat" aria-expanded="false" aria-controls="tambah_riwayat"><i class="material-icons">add_box</i> TAMBAH</button>
                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="pupuk_table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th width="35%">Area</th>
                                            <th width="30%">Nama Pupuk</th>
                                            <th width="10%">Tahun</th>
                                            <th width="10%">Dosis</th>
											<th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Area</th>
                                            <th>Nama Pupuk</th>
                                            <th>Tahun</th>
                                            <th>Dosis</th>
                                            <th>Action</th>   
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $sql_text = "";
                                        $sql_text .= "select a.nama as nama_area,p.nama_pupuk,r.tahun,r.dosis_pupuk";
                                        $sql_text .= ",r.kode_riwayat,r.kode_area,r.kode_pupuk ";
                                        $sql_text .= "from pkt_riwayat r ";
                                        $sql_text .= "left join pkt_area a on r.kode_area = a.kode_area ";
                                        $sql_text .= "left join pkt_pupuk p on r.kode_pupuk = p.kode_pupuk";
										$sql_model = pg_query($db_conn, $sql_text);
										while($data = pg_fetch_assoc($sql_model)){
                                        ?>
										<tr>
                                            <td><?php echo $data['nama_area']; ?></td>
                                            <td><?php echo $data['nama_pupuk']; ?></td>
                                            <td><?php echo $data['tahun']; ?></td>
                                            <td><?php echo $data['dosis_pupuk']; ?></td>
                                            <td>
												<a 	data-id="<?php echo $data['kode_riwayat']; ?>" 
													data-area="<?php echo $data['kode_area']; ?>"
                                                    data-pupuk="<?php echo $data['kode_pupuk']; ?>"
                                                    data-dosis="<?php echo $data['dosis_pupuk']; ?>"
                                                    data-tahun="<?php echo $data['tahun']; ?>"
													id="getDetail" style="cursor: pointer;" 
													data-toggle="modal" data-target="#tambah_riwayat" aria-expanded="false" aria-controls="tambah_riwayat">Edit</a> 
												| 
												<a id="del_<?php echo $data['kode_riwayat']; ?>" style="cursor: pointer;" 
                                                    onclick="deleteRiwayat('<?php echo $data['kode_riwayat'];?>',
                                                            '<?php echo $data['nama_area'];?>',
                                                            '<?php echo $data['nama_pupuk'];?>',
                                                            '<?php echo $data['tahun'];?>')">Delete</a>
											</td>
                                        </tr>
										<?php 
										}?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="tambah_riwayat">
                                <?php include('riwayat_pupuk_add.php') ?>
                            </div>
                        </div>	
						
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->

        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#pupuk_table').DataTable( { 
                responsive: true,
                "order": [[ 0, "asc" ],[ 1, "asc" ],[ 2, "asc" ]] 
            } );
        });

        function deleteRiwayat(id, area, pupuk, tahun) {
            event.preventDefault(); // prevent form submit
            var form = event.target.form; // storing the form
            swal({
              title: "Anda yakin?",
              text: "Riwayat pupuk " + pupuk + " di area " + area + " pada tahun " + tahun + " akan dihapus",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya, hapus saja",
              cancelButtonText: "Tidak, batalkan misi",
              closeOnConfirm: true,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                 // Delete 
                  var el = document.getElementById('del_'+id);

                  // Delete id
                  var deleteid = id;
                 
                  // AJAX Request
                  $.ajax({
                   url: './ajax/riwayat_remove_action.php',
                   type: 'POST',
                   data: 'id='+deleteid,
                   success: function(response){
                    // Removing row from HTML Table
                    $(el).closest('tr').css('background','tomato');
                    $(el).closest('tr').fadeOut(800, function(){ 
                     $(this).remove();
                    });
                   }
                  });
              } else {
                swal({
                    title: "Dibatalkan",
                    text: "Model " + nama + " batal dihapus :)",
                    type: "success",
                    timer: 1500
                });
              }
            });
        }
    </script>

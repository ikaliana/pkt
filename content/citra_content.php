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
                                            <th>Tanggal Akuisisi</th>
                                            <th>Area</th>
											<th>Status</th>
                                            <th>Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Tanggal Akuisisi</th>
                                            <th>Area</th>
											<th>Status</th>
                                            <th>Action</th>   
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
										//$sql_citra = pg_query($db_conn, "SELECT c.kode_citra as kode_citra, c.tanggal as tanggal, c.download_status as status, a.nama as nama FROM pkt_citra as c, pkt_area as a WHERE c.kode_area=a.kode_area");
										$sql_citra = pg_query($db_conn, "SELECT c.kode_citra as kode_citra, c.tanggal as tanggal, 1 as status, a.nama as nama FROM pkt_citra as c, pkt_area as a WHERE c.kode_area=a.kode_area");
										while($data = pg_fetch_assoc($sql_citra)){
											if($data['status'] == 1){
												$status = "READY";
												$label 	= "success"; 	
											}else{
												$status = "DOWNLOADING";
												$label 	= "info";
											}
                                        ?>
                                        <tr>
                                            <td><?php echo date("d M Y", strtotime($data['tanggal']));;?></td>
                                            <td><?php echo $data['nama'];?></td>
											<td><span class="label label-<?php echo $label; ?>"><?php echo $status;?></span></td>
                                            <td>
												<a id="del_<?php echo $data['kode_citra']; ?>" style="cursor: pointer;" onclick="deleteCitra('<?php echo $data['kode_citra'];?>', '<?php echo $data['nama'];?>', '<?php echo $data['tanggal'];?>')">Delete</a>
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
        </div>
    </section>
<script type="text/javascript">

$(document).ready(function(){

    $(document).on('click', '#getDetail', function(e){
  
     e.preventDefault();
  
     var uid = $(this).data('id'); // get id of clicked row
  
     $('#dynamic-content').html(''); // leave this div blank
 
     $.ajax({
          url: './ajax/area_getdetail_action.php',
          type: 'POST',
          data: 'id='+uid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#dynamic-content').html(''); // blank before load.
          $('#dynamic-content').html(data); // load here
     })
     .fail(function(){
          $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
     });

    });
});

function deleteCitra(id, nama, tanggal) {
	event.preventDefault(); // prevent form submit
	var form = event.target.form; // storing the form
	swal({
	  title: "Anda yakin?",
	  text: "Citra " + nama + ", tanggal akuisisi " +tanggal+ " akan dihapus",
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
		   url: './ajax/citra_remove_action.php',
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
			text: "Citra " + nama + " batal dihapus :)",
			type: "success",
			timer: 1500
		});
	  }
	});
}
</script>
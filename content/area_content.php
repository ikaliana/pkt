<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>AREA PERKEBUNAN</h2>
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
												<img class="media-object" src="images/icon/map.png" alt="Area Perkebunan" width="20">
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">Daftar Area Perkebunan</h4>
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
                                <table id="area_table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>                           
											<th width="20%">Area</th>
                                            <th width="30%">Lokasi</th>
											<th width="35%">Deskripsi</th>
                                            <th width="15%">Action</th>                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>Area</th>
                                            <th>Lokasi</th>
											<th>Deskripsi</th>
                                            <th>Action</th>   
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
										$sql_area = pg_query($db_conn, "SELECT * FROM pkt_area ORDER BY kode_area DESC");
										while($data = pg_fetch_assoc($sql_area)){
                                        ?>
										<tr>
											<td><?php echo $data['nama']; ?></td>
                                            <td><?php echo $data['lokasi']; ?></td>
											<td><?php echo $data['deskripsi']; ?></td>
                                            <td>
												<a href="index.php?p=area_edit&id=<?php echo $data['kode_area']; ?>" style="cursor: pointer;">Edit</a> | <a id="del_<?php echo $data['kode_area']; ?>" style="cursor: pointer;" onclick="deleteArea('<?php echo $data['kode_area'];?>', '<?php echo $data['nama'];?>')">Delete</a>
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
							<div class="modal fade" id="tampil_detail">
								<?php //include('area_edit.php') ?>
							</div>
							<div class="modal fade" id="tambah_area">
								<?php include('area_add.php') ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
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

function deleteArea(id, nama) {
	event.preventDefault(); // prevent form submit
	var form = event.target.form; // storing the form
	swal({
	  title: "Anda yakin?",
	  text: "Area " + nama + " akan dihapus",
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
		   url: './ajax/area_remove_action.php',
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
			text: "Area " + nama + " batal dihapus :)",
			type: "success",
			timer: 1500
		});
	  }
	});
}
</script>
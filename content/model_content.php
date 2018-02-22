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
									<button class="btn btn-xs bg-grey waves-effect" style="cursor: pointer;" onclick="window.location.reload();" aria-expanded="false"><i class="material-icons">replay</i> REFRESH</button>
									
								</li>
								<li>
									<button class="btn btn-xs bg-blue waves-effect" style="cursor: pointer;" onclick="tambahModel();" aria-expanded="false"><i class="material-icons">add_box</i> TAMBAH</button>
									
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
												<a href="index.php?p=model_edit&id=<?php echo $data['id_model']; ?>" style="cursor: pointer;">Edit</a> | <a id="del_<?php echo $data['id_model']; ?>" style="cursor: pointer;" onclick="deleteModel('<?php echo $data['id_model'];?>', '<?php echo $data['nama'];?>')">Delete</a>
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
							<div class="modal fade" id="tampil_detail">
								<?php include('model_edit.php') ?>
							</div>
							<div class="modal fade" id="tambah_model">
								<?php include('model_add.php') ?>
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
          url: 'model_edit.php',
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

function tambahModel() {
	location.href = "index.php?p=model_add";
}

function deleteModel(id, nama) {
	event.preventDefault(); // prevent form submit
	var form = event.target.form; // storing the form
	swal({
	  title: "Anda yakin?",
	  text: "Model " + nama + " akan dihapus",
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
		   url: './ajax/model_remove_action.php',
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
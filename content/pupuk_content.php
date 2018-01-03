<?php
$help_content = "Petunjuknya disini loh Petunjuknya disini loh Petunjuknya disini loh Petunjuknya disini loh Petunjuknya disini loh Petunjuknya disini loh ";
?>
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
									<button class="btn btn-xs bg-blue waves-effect" data-toggle="modal" style="cursor: pointer;" data-target="#tambah_pupuk" aria-expanded="false" aria-controls="tambah_pupuk"><i class="material-icons">add_box</i> TAMBAH</button>
									
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
												<a 	data-id="<?php echo $data['kode_pupuk']; ?>" 
													data-nama="<?php echo $data['nama_pupuk']; ?>"
													data-n="<?php echo $data['komposisi_n']; ?>"
													data-p="<?php echo $data['komposisi_p']; ?>"
													data-k="<?php echo $data['komposisi_k']; ?>"
													id="getDetail" style="cursor: pointer;" >Edit</a> 
												| 
												<a id="del_<?php echo $data['kode_pupuk']; ?>" style="cursor: pointer;" onclick="deletePupuk('<?php echo $data['kode_pupuk'];?>', '<?php echo $data['nama_pupuk'];?>')">Delete</a>
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
							<div class="modal fade" id="tampil_detail">
								<?php include('pupuk_edit.php') ?>
							</div>
							<div class="modal fade" id="tambah_pupuk">
								<?php include('pupuk_add.php') ?>
							</div>
							<div id="hasil_add_pupuk">
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
		var nama = $(this).data('nama');
		var n = $(this).data('n');
		var p = $(this).data('p');
		var k = $(this).data('k');

		$("#judul").html("Edit pupuk");
		$("#kodePupuk").val(uid);
		$("#namaPupuk").val(nama);
		$("#pupuk_N").val(n);
		$("#pupuk_P").val(p);
		$("#pupuk_K").val(k);

		$('#tambah_pupuk').modal('show');

		// $('#dynamic-content').html(''); // leave this div blank
		// $.ajax({
		//   url: './ajax/pupuk_getdetail_action.php',
		//   type: 'POST',
		//   data: 'id='+uid,
		//   dataType: 'html'
		// })
		// .done(function(data){
		//   //console.log(data); 
		//   $('#dynamic-content').html(''); // blank before load.
		//   $('#dynamic-content').html(data); // load here
		// })
		// .fail(function(){
		//   $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
		// });

    });
});

function deletePupuk(id, nama) {
	event.preventDefault(); // prevent form submit
	var form = event.target.form; // storing the form
	swal({
	  title: "Anda yakin?",
	  text: "Pupuk " + nama + " akan dihapus",
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
		   url: './ajax/pupuk_remove_action.php',
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

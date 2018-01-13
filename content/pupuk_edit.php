<?php

$id = $_GET['id'];
$sql = pg_query($db_conn, "SELECT * FROM pkt_pupuk where kode_pupuk='".$id."'");
$data = pg_fetch_assoc($sql);
?>
<script type="text/javascript">
	function editPupuk() {
		var nama = $("#nama_pupuk").val();
		var kom_n = $("#komposisi_n").val();
		var kom_p = $("#komposisi_p").val();
		var kom_k = $("#komposisi_k").val();
		if (nama.length == 0 || kom_n.length == 0 || kom_p.length == 0 || kom_k.length == 0) 
		  {
			setTimeout(function () { swal("Oh tidak!","Semua isian wajib diisi!","error");
			});
			return false;
		  }else{
			if(isNaN(kom_n) || isNaN(kom_p) || isNaN(kom_k)){
				setTimeout(function () { swal("Oh tidak!","Isian komposisi harus dalam angka!","error");
				});
				return false;
			}else{
				var form_data = new FormData();
				form_data.append("kode_pupuk",$("#kode_pupuk").val());
				form_data.append("nama_pupuk",nama);
				form_data.append("komposisi_n",kom_n);
				form_data.append("komposisi_p",kom_p);
				form_data.append("komposisi_k",kom_k);
				$.ajax({
					url: './ajax/pupuk_edit_action.php', // point to server-side PHP script 
					dataType: 'text', // what to expect back from the PHP script
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,
					type: 'post',
					success: function (response) {
						$('#hasil_edit_pupuk').html(response); // display success response from the PHP script
						setTimeout(function () {
						   window.location.replace("index.php?p=pupuk_content");
						}, 2000);
					},
					error: function (response) {
						$('#hasil_edit_pupuk').html(response); // display error response from the PHP script
					}
				});
				}
			}
	}	
</script>
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
												<img class="media-object" src="images/icon/fertilizer.png" alt="Pupuk" width="20">
											</a>
										</div>
										<div class="media-body">
											<h4 class="media-heading">Edit Pupuk <?php echo $data['nama_pupuk'];?></h4>
										</div>
									</div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li>
									<button class="btn btn-xs bg-deep-orange waves-effect" style="cursor: pointer;" onclick="window.location.replace('index.php?p=pupuk_content'); "aria-expanded="false"><i class="material-icons">arrow_back</i> KEMBALI</button>
								</li>
                            </ul>
                        </div>
                        <div class="body">
                            <form class="form-horizontal">
								<div class="row clearfix">
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
										<label for="area">Nama Pupuk</label>
									</div>
									<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
										<div class="form-group">
											<div class="form-line">
												<input type="text" id="nama_pupuk" class="form-control" placeholder="masukkan nama pupuk" value="<?php echo $data['nama_pupuk'];?>">
												<input type="text" style="display:none;" id="kode_pupuk" class="form-control" placeholder="masukkan nama pupuk" value="<?php echo $data['kode_pupuk'];?>">
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
														<input type="text" id="komposisi_n" class="form-control" value="<?php echo $data['komposisi_n'];?>"></div>
												</div>
												<div class="col-md-4">
													<div class="col-xs-2 form-control-label"><label for="area">P</label></div>
													<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
														<input type="text" id="komposisi_p" class="form-control" value="<?php echo $data['komposisi_p'];?>"></div>
												</div>
												<div class="col-md-4">
													<div class="col-xs-2 form-control-label"><label for="area">K</label></div>
													<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
														<input type="text" id="komposisi_k" class="form-control" value="<?php echo $data['komposisi_k'];?>"></div>
												</div>
												<!--div class="row">
												</div-->
											</div>
										</div>
									</div>
								</div>
							</form>
							<div class="modal-footer">
								<button type="button" onclick="editPupuk()" class="btn btn-link waves-effect">SIMPAN</button>
							</div>
						<div id="hasil_edit_pupuk"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
        </div>
    </section>
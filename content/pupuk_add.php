<script type="text/javascript">
    $(document).ready(function (e) {
        $('#save').on('click', function () {
			var mode = "tambah";
			var kodePupuk = $("#kodePupuk").val();
			if(kodePupuk != "") mode = "edit";
			var namaPupuk = $("#namaPupuk").val();
			var pupuk_N = $("#pupuk_N").val();
			var pupuk_P = $("#pupuk_P").val();
			var pupuk_K = $("#pupuk_K").val();
			var pupuk_Mg = $("#pupuk_Mg").val();

			if(namaPupuk=="") { setTimeout(function () { swal("","Isikan nama pupuk","error")}); return; }
			if(pupuk_N=="") { setTimeout(function () { swal("","Masukkan angka komposisi Nitrogen (N) dalam pupuk","error")}); return; }
			if(pupuk_P=="") { setTimeout(function () { swal("","Masukkan angka komposisi Fosfor (P) dalam pupuk","error")}); return; }
			if(pupuk_K=="") { setTimeout(function () { swal("","Masukkan angka komposisi Kalium (K) dalam pupuk","error")}); return; }
			if(pupuk_Mg=="") { setTimeout(function () { swal("","Masukkan angka komposisi Magnesium (Mg) dalam pupuk","error")}); return; }

            var form_data = new FormData();
			form_data.append("nama_pupuk", namaPupuk);
			form_data.append("pupuk_n", pupuk_N);
			form_data.append("pupuk_p", pupuk_P);
			form_data.append("pupuk_k", pupuk_K);
			form_data.append("pupuk_mg", pupuk_Mg);
			form_data.append("kode_pupuk",kodePupuk);
			form_data.append("mode",mode);
            
            $.ajax({
                url: './ajax/pupuk_add_action.php', // point to server-side PHP script 
                dataType: 'text', // what to expect back from the PHP script
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('#hasil_add_pupuk').html(response); // display success response from the PHP script
                    $("#judul").html("Tambah pupuk");
                },
                error: function (response) {
                    $('#hasil_add_pupuk').html(response); // display error response from the PHP script
                    $("#judul").html("Tambah pupuk");
                }
            });
        });
    });
</script>
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<div class="media">
				<div class="media-left">
					<a href="#">
						<img class="media-object" src="images/icon/fertilizer.png" alt="Pupuk" width="20">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading" id="judul">Tambah Pupuk</h4>
				</div>
			</div>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
				<div class="row clearfix">
					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Nama Pupuk</label>
					</div>
					<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="hidden" id="kodePupuk" />
								<input type="text" id="namaPupuk" class="form-control" placeholder="masukkan nama pupuk">
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
								<div class="col-md-3">
									<div class="col-xs-2 form-control-label" style="margin-bottom: 0"><label for="area">N</label></div>
									<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
										<input type="text" id="pupuk_N" class="form-control" placeholder=""></div>
								</div>
								<div class="col-md-3">
									<div class="col-xs-2 form-control-label" style="margin-bottom: 0"><label for="area">P</label></div>
									<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
										<input type="text" id="pupuk_P" class="form-control" placeholder=""></div>
								</div>
								<div class="col-md-3">
									<div class="col-xs-2 form-control-label" style="margin-bottom: 0"><label for="area">K</label></div>
									<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
										<input type="text" id="pupuk_K" class="form-control" placeholder=""></div>
								</div>
								<div class="col-md-3">
									<div class="col-xs-2 form-control-label" style="margin-bottom: 0"><label for="area">Mg</label></div>
									<div class="col-xs-10" style="border-bottom: 1px solid #ddd">
										<input type="text" id="pupuk_Mg" class="form-control" placeholder=""></div>
								</div>
								<!--div class="row">
								</div-->
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" id="save" class="btn btn-link waves-effect">SIMPAN</button>
			<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">KELUAR</button>
		</div>
		<div id="hasil_add_pupuk">
		</div>
	</div>
</div>
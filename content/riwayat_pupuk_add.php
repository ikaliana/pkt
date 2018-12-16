<script type="text/javascript">
    $(document).ready(function (e) {
		$('#tambah_riwayat').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget);
		  var id = button.data('id');
		  var area = button.data('area');
		  var pupuk = button.data('pupuk');
		  var dosis = button.data('dosis');
		  var tahun = button.data('tahun');
		  console.log(id,area,pupuk,dosis,tahun);
		  var modal = $(this);
		  modal.find('#id').val(id);
		  modal.find('#area').val(area).trigger('change');;
		  modal.find('#pupuk').val(pupuk).trigger('change');;
		  modal.find('#dosis').val(dosis);
		  modal.find('#tahun').val(tahun);
		});

        $('#save').on('click', function () {
            var form_data = new FormData();
			var id = $("#id").val();
			var area = $("#area").val();
			var pupuk = $("#pupuk").val();
			var tahun = $("#tahun").val();
			var dosis = $("#dosis").val();

			//alert(files.length);
			if(area == "") { setTimeout(function () { swal("","Pilih salah satu area perkebunan","error")}); return; }
			if(pupuk == "") { setTimeout(function () { swal("","Pilih salah satu pupuk terkait","error")}); return; }
			if(tahun == "") { setTimeout(function () { swal("","Isikan tahun pemupukan","error")}); return; }
			if(dosis == "") { setTimeout(function () { swal("","Isikan jumlah dosis pupuk","error")}); return; }
			if(tahun == "0") { setTimeout(function () { swal("","Tahun pemupukan harus lebih besar dari nol","error")}); return; }
			if(dosis == "0") { setTimeout(function () { swal("","Dosis harus lebih besar dari nol","error")}); return; }

			form_data.append("id", id);
			form_data.append("area", area);
			form_data.append("pupuk", pupuk);
			form_data.append("tahun", tahun);
			form_data.append("dosis", dosis);

            $.ajax({
                url: './ajax/riwayat_add_action.php', // point to server-side PHP script 
                dataType: 'text', // what to expect back from the PHP script
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    // console.log(response);
                    var msg = response.split("|");
                    if(msg.length == 3) {
                        //swal(msg[0], msg[1], msg[2]);
                        if(msg[2]=="success") {
						    swal({
						        title: msg[0],
						        text: msg[1],
						        type: msg[2],
						        closeOnConfirm: false
						    }, function () {
						        location.reload();
						    });		
                        } 
                        else swal(msg[0], msg[1], msg[2]);
                    }
                    //$('#hasil_add_citra').html(response); // display success response from the PHP script
                },
                error: function (response) {
                    swal("Error!",response,"error");
                    //$('#hasil_add_citra').html(response); // display error response from the PHP script
                }
            });
        });
    });
</script>

<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<div class="media">
				<div class="media-left">
					<a href="#">
						<img class="media-object" src="images/icon/fertilizer.png" alt="Riwayat Pemupukan" width="20">
					</a>
				</div>
				<div class="media-body">
					<h4 class="media-heading">Tambah Riwayat Pemupukan</h4>
				</div>
			</div>
		</div>
		<div class="modal-body">
			<form class="form-horizontal">
				<input type="hidden" id="id" name="id" value=""></input>
				<div class="row clearfix">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Area</label>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-inline">
								<select class="form-control show-tick" id="area" name="area">
									<option value="" selected>-- pilih --</option>
									<?php
										$sql_area = pg_query($db_conn, "SELECT nama, kode_area FROM pkt_area");
										while($data = pg_fetch_assoc($sql_area)){
										echo "<option value='".$data['kode_area']."'>".$data['nama']."</option>";
										};
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
						<label for="area">Nama Pupuk</label>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<select class="form-control show-tick" id="pupuk" name="pupuk" readonly>
									<option value="" selected>-- pilih --</option>
									<?php
										$kode_pupuk = "";
										if(isset($_GET['kp'])) $kode_pupuk=$_GET['kp'];

										$sql = pg_query($db_conn, "select kode_pupuk,nama_pupuk from pkt_pupuk");
										while($data = pg_fetch_assoc($sql)){
										echo "<option value='".$data['kode_pupuk']."'";
										if ($kode_pupuk == strval($data['kode_pupuk'])) echo " selected";
										echo ">".$data['nama_pupuk']."</option>";
										};
									?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
						<label for="tahun">Tahun</label>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="number" class="form-control" id="tahun" name="tahun" required aria-required="true" aria-invalid="false" value="0"></input>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
						<label for="dosis">Dosis per hektar (kg)</label>
					</div>
					<div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control" id="dosis" name="dosis" required aria-required="true" aria-invalid="false" value="0"></input>
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
		<div id="hasil_add_riwayat">
		</div>
	</div>
</div>
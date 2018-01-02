	<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>REKOMENDASI PUPUK PPKS</h2>
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
											<h4 class="media-heading">Input Rekomendasi Pupuk PPKS</h4>
										</div>
									</div>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
								<li>
									<button class="btn btn-xs bg-grey waves-effect" style="cursor: pointer;" onclick="window.location.reload(); "aria-expanded="false"><i class="material-icons">replay</i> REFRESH</button>
									
								</li>
                                <li>
									<button class="btn btn-xs bg-blue waves-effect" style="cursor: pointer;" id="btnSimpan"><i class="material-icons">add_box</i> SIMPAN</button>
									
								</li>
                            </ul>
                        </div>
                        <div class="body">
                        	<div class="table-responsive">
				<form class="form-horizontal">
					<div class="row clearfix">
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="area">Nama Pupuk</label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
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
					<input type="hidden" id="kode_pupuk" value="<?php echo $kode_pupuk ?>" />
					<div class="row clearfix" style="margin-left:0px;margin-right:0px;">
						<div class="table-responsive">
	                        <table id="pupuk_table" class="table table-bordered table-striped table-hover js-basic-example dataTable">
	                            <thead>
	                                <tr>
	                                    <th class="text-center">Umur (tahun)</th>
										<th class="text-center">Jumlah (kg/ha)</th>
	                                    <th class="text-center">Umur (tahun)</th>
										<th class="text-center">Jumlah (kg/ha)</th>
	                                    <th class="text-center">Umur (tahun)</th>
										<th class="text-center">Jumlah (kg/ha)</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	<?php 
	                            		if($kode_pupuk != "") {
		                            		$query = "select r1.kode_pupuk,r1.umur_tanaman umur1,r1.jumlah_pupuk jumlah1 ";
		                            		$query .= ",r2.umur_tanaman umur2,r2.jumlah_pupuk jumlah2,r3.umur_tanaman umur3,r3.jumlah_pupuk jumlah3 ";
		                            		$query .= "from ";
		                            		$query .= "(select kode_pupuk,umur_tanaman,jumlah_pupuk from pkt_rekomendasi ";
		                            		$query .= "where umur_tanaman between 1 and 10 and kode_pupuk=".$kode_pupuk.") r1 ";
		                            		$query .= "left join ";
		                            		$query .= "(select kode_pupuk,umur_tanaman,jumlah_pupuk from pkt_rekomendasi ";
		                            		$query .= "where umur_tanaman between 11 and 20 and kode_pupuk=".$kode_pupuk.") r2 ";
		                            		$query .= "on r1.kode_pupuk = r2.kode_pupuk and r1.umur_tanaman + 10 = r2.umur_tanaman ";
		                            		$query .= "left join ";
		                            		$query .= "(select kode_pupuk,umur_tanaman,jumlah_pupuk from pkt_rekomendasi ";
		                            		$query .= "where umur_tanaman between 21 and 25 and kode_pupuk=".$kode_pupuk.") r3 ";
		                            		$query .= "on r1.kode_pupuk = r2.kode_pupuk and r2.umur_tanaman + 10 = r3.umur_tanaman";

											$sql = pg_query($db_conn, $query);
											$counter = 1;
											while($data = pg_fetch_assoc($sql)){
	                            	?>
	                            	<tr>
	                            		<td style="padding:5px;vertical-align:middle" align="center"><?php echo $data['umur1']; ?></td>
	                            		<td style="padding:5px" align="center">
	                            			<input type="text" id="angka<?php echo $data['umur1']; ?>" class="form-control text-center" 
	                            				style="width:100px;" value="<?php echo $data['jumlah1']; ?>">
	                            		</td>
	                            		<td style="padding:5px;vertical-align:middle" align="center"><?php echo $data['umur2']; ?></td>
	                            		<td style="padding:5px" align="center">
	                            			<input type="text" id="angka<?php echo $data['umur2']; ?>" class="form-control text-center" 
	                            				style="width:100px;" value="<?php echo $data['jumlah2']; ?>">
	                            		</td>
	                            		<td style="padding:5px;vertical-align:middle" align="center">
	                            			<?php if( $counter <= 5 ) { echo $counter+20; } ?>
	                            		</td>
	                            		<td style="padding:5px" align="center">
	                            			<?php if( $counter <= 5 ) { ?>
	                            			<input type="text" id="angka<?php echo $counter+20; ?>" class="form-control text-center" 
	                            				style="width:100px;" value="<?php echo $data['jumlah3']; ?>">
	                            			<?php } ?>
	                            		</td>
	                            	</tr>
	                            	<?php 		 
												$counter++;
											}
	                            		}
	                            		else {
	                            			for($i=1;$i<=10;$i++) {
	                            	?>
	                            	<tr>
	                            		<td style="padding:5px;vertical-align:middle" align="center"><?php echo $i; ?></td>
	                            		<td style="padding:5px" align="center">
	                            			<input type="text" id="angka<?php echo $i; ?>" class="form-control text-center" style="width:100px;">
	                            		</td>
	                            		<td style="padding:5px;vertical-align:middle" align="center"><?php echo $i+10; ?></td>
	                            		<td style="padding:5px" align="center">
	                            			<input type="text" id="angka<?php echo $i+10; ?>" class="form-control text-center" style="width:100px;">
	                            		</td>
	                            		<td style="padding:5px;vertical-align:middle" align="center"><?php if( 20+$i <=25 ) echo 20+$i; ?></td>
	                            		<td style="padding:5px" align="center">
	                            			<?php if( 20+$i <=25 ) { ?>
	                            			<input type="text" id="angka<?php echo $i+20; ?>" class="form-control text-center" style="width:100px;">
	                            			<?php } ?>
	                            		</td>
	                            	</tr>
	                            	<?php 	}	 
	                            		} ?>
	                            </tbody>
	                        </table>
						</div>
					</div>
		<div id="hasil_add_ppks">
		</div>
				</form>
                        	</div>
                        </div>	
						
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->

        </div>
    </section>
<script type="text/javascript">
    $(document).ready(function (e) {
        $('#btnSimpan').on('click', function () {
            var form_data = new FormData();

            var kode_pupuk = $("#kode_pupuk").val();
            var mode = "new";
            if (kode_pupuk != "") mode = "edit";
            var id_pupuk = $("#pupuk").val();

            if(id_pupuk == "") { setTimeout(function () { swal("","Isikan nama pupuk","error")}); return; }

			form_data.append("kode_pupuk",id_pupuk);
			form_data.append("mode",mode);

			for(i=1;i<=25;i++) form_data.append("angka_" + i.toString(),$("#angka" + i.toString()).val())

			//for (var [key, value] of form_data.entries()) { 
	        //    console.log(key, value);
	        //}

            $.ajax({
                url: './ajax/ppks_update_action.php', // point to server-side PHP script 
                dataType: 'text', // what to expect back from the PHP script
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    $('#hasil_add_ppks').html(response); // display success response from the PHP script
                },
                error: function (response) {
                    $('#hasil_add_ppks').html(response); // display error response from the PHP script
                }
            });
        });
    });
</script>

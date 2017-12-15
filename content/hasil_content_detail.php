<?php
	$analisis_id = "";
	$nama_area = "";
	$tanggal_citra = "";
	$luas_area = "";

	if(isset($_GET['kd'])) {
		$analisis_id = $_GET['kd'];

		$query = "";
		$query .= "select ar.nama as nama_area,c.tanggal as tanggal_citra,s.luas_area ";
		$query .= "from pkt_analisis a ";
		$query .= "left join pkt_analisis_summary s on a.kode_analisis = s.kode_analisis ";
		$query .= "left join pkt_citra c on a.kode_citra = c.kode_citra ";
		$query .= "left join pkt_area ar on c.kode_area = ar.kode_area ";
		$query .= "where a.kode_analisis=" . $analisis_id;

		$sql = pg_query($db_conn, $query);
		$data = pg_fetch_array($sql);
		$nama_area = $data[0];
		$tanggal_citra = $data[1];
		$luas_area = $data[2];
	}
	
?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>HASIL PERHITUNGAN</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            
        </div>
        <!-- #END# Widgets -->
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12">
                                <h2>Informasi Area</h2>
                            </div>
                        </div>
                    </div>
                    <div class="body">
						<div class="row clearfix">
							<div class="col-md-4" style="margin-bottom: 0">
								<div class="media">
									<div class="media-left">
										<a href="#">
											<img class="media-object" src="images/icon/map.png" alt="Area Perkebunan" width="48">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Area Perkebunan</h4>
										<h5 style="font-weight:normal"><?php echo $nama_area; ?></h5>
									</div>
								</div>
							</div>
							<div class="col-md-4" style="margin-bottom: 0">
								<div class="media">
									<div class="media-left">
										<a href="#">
											<img class="media-object" src="images/icon/satellite.png" alt="Citra Sentinel" width="48">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Tanggal Citra Sentinel</h4>
										<h5 style="font-weight:normal"><?php echo date('d F Y',strtotime($tanggal_citra)); ?></h5>
										
									</div>
								</div>
							</div>
							<div class="col-md-4" style="margin-bottom: 0">
								<div class="media">
									<div class="media-left">
										<a href="#">
											<img class="media-object" src="images/icon/area.png" alt="Citra Sentinel" width="48">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Luas area</h4>
										<h5 style="font-weight:normal"><?php echo $luas_area; ?> ha</h5>
										
									</div>
								</div>
							</div>
						</div>
						<div class="row clearfix" style="display:none">
							<div class="col-md-4" style="margin-bottom: 0">
								<div class="media">
									<div class="media-left">
										<a href="#">
											<img class="media-object" src="images/icon/model.png" alt="Citra Sentinel" width="48">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Model Perhitungan N</h4>
										<h5 style="font-weight:normal">Jonggol N Daun Reloaded</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4" style="margin-bottom: 0">
								<div class="media">
									<div class="media-left">
										<a href="#">
											<img class="media-object" src="images/icon/model.png" alt="Citra Sentinel" width="48">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Model Perhitungan P</h4>
										<h5 style="font-weight:normal">Jonggol P Daun Reloaded</h5>
									</div>
								</div>
							</div>
							<div class="col-md-4" style="margin-bottom: 0">
								<div class="media">
									<div class="media-left">
										<a href="#">
											<img class="media-object" src="images/icon/model.png" alt="Citra Sentinel" width="48">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Model Perhitungan K</h4>
										<h5 style="font-weight:normal">Jonggol K Daun Reloaded</h5>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
                <div class="card">
            		<div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12">
                                <h2>Rekomendasi Pemupukan</h2>
                            </div>
                        </div>
                    </div>
        			<div class="body">
						<h4>Pupuk Tunggal</h4>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover text-center" style="margin-bottom: 6px;">
								<thead>
									<th class="text-left">Nama Pupuk</th>
									<th class="text-center">Total Kebutuhan<br>(kg)</th>
									<th class="text-center">Dosis per hektar<br>(kg/ha)</th>
									<th class="text-center">Dosis per pokok<br>(kg/btg)</th>
								</thead>
								<tbody>
                                <?php
									$query = "";
									$query .= "select * from pkt_analisis_detail ";
									$query .= "where jenis_pupuk='TUNGGAL' and dosis_total<>0 ";
									$query .= "and kode_analisis=".$analisis_id;
									$query .= " order by nama_pupuk";

									$sql_area = pg_query($db_conn, $query);
									while($data = pg_fetch_assoc($sql_area)){
                                ?>
									<tr>
										<td><?php echo $data['nama_pupuk']; ?></td>
                                        <td align="center"><?php echo number_format($data['dosis_total'], 0); ?></td>
                                        <td align="center"><?php echo number_format($data['dosis_hektar'], 0); ?></td>
										<td align="center"><?php echo number_format($data['dosis_pohon'], 2); ?></td>
                                    </tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
						<h4>Pupuk Majemuk</h4>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover text-center" style="margin-bottom: 6px;">
								<thead>
									<th class="text-left">Nama Pupuk</th>
									<th class="text-center">Total Kebutuhan<br>(kg)</th>
									<th class="text-center">Dosis per hektar<br>(kg/ha)</th>
									<th class="text-center">Dosis per pokok<br>(kg/btg)</th>
								</thead>
								<tr>
									<td class="text-left">NPK</td>
									<td>12826</td>
									<td>230</td>
									<td>1.70</td>
								</tr>
								<tr>
									<td class="text-right">+ TSP</td>
									<td>1710</td>
									<td>31</td>
									<td>0.23</td>
								</tr>
								<tr>
									<td class="text-right">+ KCL</td>
									<td>647</td>
									<td>12</td>
									<td>0.08</td>
								</tr>
							</table>
						</div>
                    </div>
                </div>
                <div class="card">
            		<div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12">
                                <h2>Peta</h2>
                            </div>
                        </div>
                    </div>
        			<div class="body">
						<div class="row clearfix">
							<div class="col-lg-6" style="margin-bottom:0">
								<div class="panel panel-success">
									<div class="panel-heading">
										<strong>Kandungan Unsur</strong> 
									</div>
									<div class="panel-body" style="padding:0">
										<label for="cbunsur" class="col-xs-2" style="margin:5px 0 10px">Unsur</label>
										<select id="cbunsur">
											<option value="N" selected>Nitrogen</option>
											<option value="P">Fosfor</option>
											<option value="K">Kalium</option>
										</select>
										<div id="mapid1" style="width: 100%; height: 350px;"></div>
									</div>
								</div>	
								<ul class="list-group" id="legend_N" style="border: 1px solid #ddd;margin-bottom:0;">
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#FF0000;margin-right:25px;">&nbsp;</span> &lt;= 1.9 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#FCFF2D;margin-right:25px;">&nbsp;</span> 1.9 % - 2.1 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#6AFE48;margin-right:25px;">&nbsp;</span> 2.1 % - 2.3 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#02C630;margin-right:25px;">&nbsp;</span> 2.3 % - 2.5 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#20E6DC;margin-right:25px;">&nbsp;</span> 2.5 % - 2.7 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#123A8F;margin-right:25px;">&nbsp;</span> &gt; 2.7 %</li>
								</ul>							
								<ul class="list-group" id="legend_P" style="border: 1px solid #ddd;margin-bottom:0;display:none;">
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#FF0000;margin-right:25px;">&nbsp;</span> &lt;= 0.09 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#FCFF2D;margin-right:25px;">&nbsp;</span> 0.09 % - 0.11 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#6AFE48;margin-right:25px;">&nbsp;</span> 0.11 % - 0.13 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#02C630;margin-right:25px;">&nbsp;</span> 0.13 % - 0.15 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#20E6DC;margin-right:25px;">&nbsp;</span> 0.15 % - 0.17 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#123A8F;margin-right:25px;">&nbsp;</span> &gt; 0.17 %</li>
								</ul>							
								<ul class="list-group" id="legend_K" style="border: 1px solid #ddd;margin-bottom:0;display:none;">
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#FF0000;margin-right:25px;">&nbsp;</span> &lt;= 0.4 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#FCFF2D;margin-right:25px;">&nbsp;</span> 0.4 % - 0.6 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#6AFE48;margin-right:25px;">&nbsp;</span> 0.6 % - 0.8 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#02C630;margin-right:25px;">&nbsp;</span> 0.8 % - 1.0 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#20E6DC;margin-right:25px;">&nbsp;</span> 1.0 % - 1.2 %</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#123A8F;margin-right:25px;">&nbsp;</span> &gt; 1.2 %</li>
								</ul>							
							</div>
							<div class="col-lg-6" style="margin-bottom:0">
								<div class="panel panel-success">
									<div class="panel-heading">
										<strong>Presentase penambahan dosis pupuk</strong> 
									</div>
									<div class="panel-body" style="padding:0">
										<label for="cbpupuk" class="col-xs-2" style="margin:5px 0 10px">Pupuk</label>
										<select id="cbpupuk">
											<?php
												$sql_area = pg_query($db_conn, "select * from pkt_pupuk order by nama_pupuk");
												while($data = pg_fetch_assoc($sql_area)){
												echo "<option value='".$data['nama_pupuk']."'>".$data['nama_pupuk']."</option>";
												};
											?>
										</select>
										<div id="mapid2" style="width: 100%; height: 350px;"></div>
									</div>
								</div>		
								<!--[0x00000000,0xFF1C19D7,0xFF5390F6,0xFF9ADFFF,0xFF9EF0DC,0xFF62CC8A,0xFF41961A]-->						
								<ul class="list-group" id="legend_pupuk" style="border: 1px solid #ddd;margin-bottom:0;">
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#D7191C;margin-right:25px;">&nbsp;</span> &gt;= 100%</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#F69053;margin-right:25px;">&nbsp;</span> 50% - 100%</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#FFDF9A;margin-right:25px;">&nbsp;</span> 0% - 50%</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#DCF09E;margin-right:25px;">&nbsp;</span> 0% - -50%</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#8ACC62;margin-right:25px;">&nbsp;</span> -50% - -100%</li>
									<li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#1A9641;margin-right:25px;">&nbsp;</span> &lt; -100%</li>
								</ul>							
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# CPU Usage -->
    </div>
	<script src="plugins/leaflet/L.Map.Sync.js"></script>
	<script>
		var imageUrl = 'result/<?php echo $analisis_id; ?>/';
		var imageBounds = [[-6.4765,107.018], [-6.46722,107.036]];
		var map1 = L.map('mapid1'); //.setView([107.018, -6.46722], 13);;
		var map2 = L.map('mapid2');
		var layer1 = L.imageOverlay(imageUrl + "Citra_Klasifikasi_N.png", imageBounds);
		var layer2 = L.imageOverlay(imageUrl + "Citra_Klasifikasi_Pupuk_urea.png", imageBounds);
		map1.addLayer(layer1);
		map2.addLayer(layer2);
		map1.fitBounds(imageBounds);
		map2.fitBounds(imageBounds);
		map1.sync(map2)
	   $("#cbunsur").on('change', function() {
	   		var unsur = $("#cbunsur").val();
	   		layer1.setUrl(imageUrl + "Citra_Klasifikasi_" + unsur + ".png");
	   		$("#legend_N").hide();
	   		$("#legend_P").hide();
	   		$("#legend_K").hide();
	   		$("#legend_" + unsur).show();
	   });
	   $("#cbpupuk").on('change', function() {
	   		var pupuk = $("#cbpupuk").val();
	   		layer2.setUrl(imageUrl + "Citra_Klasifikasi_Pupuk_" + pupuk + ".png");
	   });
	</script>
</section>
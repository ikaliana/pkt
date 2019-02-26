<?php
	$analisis_id = "";
	$nama_area = "";
	$tanggal_citra = "";
	$luas_area = "";

	if(isset($_GET['kd'])) {
		$analisis_id = $_GET['kd'];

		$query = "";
		$query .= "select ar.nama as nama_area,c.tanggal as tanggal_citra,s.luas_area,";
		$query .= "a.tanggal_pemupukan,a.persentase_dosis ";
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
		$tanggal_pemupukan = $data[3];
		$persentase_dosis = $data[4];
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
                <div class="card" style="margin-bottom:10px;">
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
						<div class="row clearfix">
							<div class="col-md-4" style="margin-bottom: 0">
								<div class="media">
									<div class="media-left">
										<a href="#">
											<img class="media-object" src="images/icon/tanggal.png" alt="Tanggal Pemupukan" width="48">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Tanggal Pemupukan</h4>
										<h5 style="font-weight:normal"><?php echo $tanggal_pemupukan; ?></h5>
									</div>
								</div>
							</div>
							<div class="col-md-4" style="margin-bottom: 0">
								<div class="media">
									<div class="media-left">
										<a href="#">
											<img class="media-object" src="images/icon/dosis.png" alt="Persentase dosis" width="48">
										</a>
									</div>
									<div class="media-body">
										<h4 class="media-heading">Persentase dosis</h4>
										<h5 style="font-weight:normal"><?php echo $persentase_dosis; ?> %</h5>
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
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-12">
				<ul class="nav nav-tabs">
                    <li class="active"><a href="#rekomendasi_total" data-toggle="tab" aria-expanded="true">Rekomendasi Total</a>
                    </li>
                    <li class=""><a href="#rekomendasi_hektar" data-toggle="tab" aria-expanded="false">Rekomendasi Hektar</a>
                    </li>
                    <li class=""><a href="#rekomendasi_blok" data-toggle="tab" aria-expanded="false">Rekomendasi Blok</a>
                    </li>
                    <li class=""><a href="#peta_nutrisi" data-toggle="tab" aria-expanded="false">Peta Kandungan Unsur</a>
                    </li>
                    <li class=""><a href="#peta_dosis" data-toggle="tab" aria-expanded="false">Peta Persentase Penambahan Dosis</a>
                    </li>
                </ul>
            </div>
        </div>
    	<div class="tab-content">
	        <div class="card tab-pane active" id="rekomendasi_total">
	    		<div class="header">
	                <div class="row clearfix">
	                    <div class="col-sm-12 col-md-6">
	                        <h2>Rekomendasi Pemupukan</h2>
	                    </div>
	                    <div class="col-sm-12 col-md-6" style="text-align:right">
	                        Jumlah pokok per ha: <span id="jum_pokok" style="font-weight:bold">136</span> &nbsp; 
	                        <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="120" data-slider-max="145" data-slider-step="1" data-slider-value="136"/>
	                    </div>
	                </div>
	            </div>
				<div class="body">
					<h4>Pupuk Tunggal</h4>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover text-center" style="margin-bottom: 6px;">
							<thead>
								<th class="text-center" style="vertical-align: middle">Nama Pupuk</th>
								<th class="text-center">Total Kebutuhan<br>(kg)</th>
								<th class="text-center">Dosis per hektar<br>(kg/ha)</th>
								<th class="text-center">Dosis per pokok<br>(kg/btg)</th>
							</thead>
							<tbody>
	                        <?php
								$query = "";
								$query .= "select * from pkt_analisis_detail d ";
								$query .= "inner join ( ";
								$query .= "select kode_analisis,nama_pupuk,min(dosis_total) as dosis_total ";
								$query .= "from pkt_analisis_detail where dosis_total<>0 ";
								$query .= "group by kode_analisis,nama_pupuk ) d2 ";
								$query .= "on d.kode_analisis=d2.kode_analisis and d.nama_pupuk=d2.nama_pupuk and d.dosis_total=d2.dosis_total ";
								$query .= "where jenis_pupuk='TUNGGAL' and d.dosis_total<>0 ";
								$query .= "and d.kode_analisis=".$analisis_id;
								$query .= " order by d.nama_pupuk";

								$row_counter = 0;
								$sql_area = pg_query($db_conn, $query);
								while($data = pg_fetch_assoc($sql_area)){
	                        ?>
								<tr>
									<td><?php echo $data['nama_pupuk']; ?></td>
	                                <td align="center"><?php echo number_format($data['dosis_total'], 0); ?></td>
	                                <td align="center" class="dosis_hektar" data-id="<?php echo $row_counter ?>"><?php echo number_format($data['dosis_hektar'], 0); ?></td>
									<td align="center" class="dosis_pohon_<?php echo $row_counter ?>"><?php echo number_format($data['dosis_pohon'], 2); ?></td>
	                            </tr>
							<?php 
									$row_counter++; 
								} 
							?>
							</tbody>
						</table>
					</div>
					<h4>Pupuk Majemuk</h4>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover text-center" style="margin-bottom: 6px;">
							<thead>
								<th class="text-center" style="vertical-align: middle">No.</th>
								<th class="text-center" style="vertical-align: middle">Nama Pupuk</th>
								<th class="text-center">Total Kebutuhan<br>(kg)</th>
								<th class="text-center">Dosis per hektar<br>(kg/ha)</th>
								<th class="text-center">Dosis per pokok<br>(kg/btg)</th>
							</thead>
							<tbody>
	                        <?php
								$query = "";
								$query .= "select * from pkt_analisis_detail d ";
								$query .= "left join pkt_pupuk p on d.kode_pupuk = p.kode_pupuk ";
								$query .= "inner join ( ";
								$query .= "select kode_analisis,kode_pupuk,left(nama_unsur,1) as nama_unsur, min(dosis_total) as dosis_total ";
								$query .= "from pkt_analisis_detail ";
								$query .= "where jenis_pupuk = 'MAJEMUK' and dosis_total<>0 ";
								$query .= "group by kode_analisis,kode_pupuk,left(nama_unsur,1) ";
								$query .= ") d2 on d.kode_analisis=d2.kode_analisis and d.kode_pupuk=d2.kode_pupuk ";
								$query .= "and left(d.nama_unsur,1)=d2.nama_unsur and d.dosis_total=d2.dosis_total ";
								// $query .= "where d.jenis_pupuk='MAJEMUK' and d.dosis_total<>0 ";
								$query .= "where d.jenis_pupuk='MAJEMUK' ";
								$query .= "and d.kode_analisis=".$analisis_id;
								$query .= " order by d.nama_pupuk ASC, d.dosis_total ASC";

								$counter = 0;
								$urut = 0;
								$prev_dosis = 0;
								$prev_pupuk = "";

								$sql_area = pg_query($db_conn, $query);
								while($data = pg_fetch_assoc($sql_area)){
									$cur_pupuk = $data['nama_pupuk'];
									if($cur_pupuk != $prev_pupuk) { $counter = 0; $urut++; }

									if(!$counter) {
										$prev_dosis = $data['dosis_total'];
										$prev_pupuk = $cur_pupuk;
	                        ?>
							<tr>
								<td align="center"><?php echo $urut; ?>.</td>
								<td class="text-left"><?php echo $data['nama_pupuk']; ?></td>
	                            <td align="center"><?php echo number_format($data['dosis_total'], 0); ?></td>
	                            <td align="center" class="dosis_hektar" data-id="<?php echo $row_counter ?>"><?php echo number_format($data['dosis_hektar'], 0); ?></td>
								<td align="center" class="dosis_pohon_<?php echo $row_counter ?>"><?php echo number_format($data['dosis_pohon'], 2); ?></td>
	                        </tr>
							<?php 
									}
									else {
										$curr_dosis = $data['dosis_total'] - $prev_dosis;
										$nama_unsur = $data['nama_unsur'];
										$komposisi_unsur = 0;
										$query2 = "select * from pkt_pupuk ";
										$col_index = 0;
										
										if($nama_unsur == "N") {
											$komposisi_unsur = $data['komposisi_n'];
											$query2 .= "where komposisi_n>0 and komposisi_p=0 and komposisi_k=0 and komposisi_mg=0 order by komposisi_n";
											$col_index = 2;
										}
										if($nama_unsur == "P") {
											$komposisi_unsur = $data['komposisi_p'];
											$query2 .= "where komposisi_n=0 and komposisi_p>0 and komposisi_k=0 and komposisi_mg=0 order by komposisi_p";
											$col_index = 3;
										}
										if($nama_unsur == "K") {
											$komposisi_unsur = $data['komposisi_k'];
											$query2 .= "where komposisi_n=0 and komposisi_p=0 and komposisi_k>0 and komposisi_mg=0 order by komposisi_k";
											$col_index = 4;
										}
										if($nama_unsur == "M") {
											$komposisi_unsur = $data['komposisi_mg'];
											$query2 .= "where komposisi_n=0 and komposisi_p=0 and komposisi_k=0 and komposisi_mg>0 order by komposisi_k";
											$col_index = 5;
										}

										$query2 .= " limit 1";
										$sql2 = pg_query($db_conn, $query2);
										$data2 = pg_fetch_array($sql2);
										$nama_pupuk_2 = $data2[1];
										$komposisi_unsur_2 = $data2[$col_index];

										$curr_dosis_molekul = ($komposisi_unsur/100) * $curr_dosis;
										$curr_dosis_2 = (100/$komposisi_unsur_2) * $curr_dosis_molekul;
										$curr_dosis_hektar = $curr_dosis_2 / $luas_area;
										$curr_dosis_pohon = $curr_dosis_hektar / 136;

	                        ?>
							<tr>
								<td align="center">&nbsp;</td>
								<td class="text-right">+ <?php echo $nama_pupuk_2; ?></td>
	                            <td align="center"><?php echo number_format($curr_dosis_2, 0); ?></td>
	                            <td align="center" class="dosis_hektar" data-id="<?php echo $row_counter ?>"><?php echo number_format($curr_dosis_hektar, 0); ?></td>
								<td align="center" class="dosis_pohon_<?php echo $row_counter ?>"><?php echo number_format($curr_dosis_pohon, 2); ?></td>
	                        </tr>
							<?php 
									}
									$counter++;
									//if($counter >= 4) { $counter = 0; $urut++; }
									$row_counter++;
								} 
							?>
							</tbody>
						</table>
					</div>
	            </div>
	        </div>
	        <div class="card tab-pane active" id="rekomendasi_hektar">
	        	<div class="header">
	                <div class="row clearfix">
	                    <div class="col-xs-12">
	                        <h2>Rekomendasi Pemupukan per hektar</h2>
	                    </div>
	                </div>
	            </div>
        		<div class="body">
					<label for="cbpupuk" class="col-xs-2" style="margin:5px 0 10px">Pupuk</label>
					<select id="cbpupuk2">
						<?php
							$nama_pupuk = "";
							$sql_area = pg_query($db_conn, "select * from pkt_pupuk where kode_pupuk in (select distinct kode_pupuk from pkt_rekomendasi)");
							while($data = pg_fetch_assoc($sql_area)){
								if ($nama_pupuk == "") $nama_pupuk = $data['nama_pupuk'];
								echo "<option value='".$data['nama_pupuk']."'>".$data['nama_pupuk']."</option>";
							};
						?>
					</select>
        			<div id="mapid3" style="width: 100%; height: 450px;"></div>
        			<div id="template_legend_rekomendasi" style="display:none">
						<li class="list-group-item" style="padding: 5px 15px; border: none;">
							<span style="width:25px;display:inline-block;background:{COLOR};margin-right:25px;">&nbsp;</span> {TEXT}</li>
        			</div>
					<!--ul class="list-group" id="legend_rekomendasi" style="border: 1px solid #ddd;margin-bottom:0;">
					</ul-->	
					<p>&nbsp;</p>						
					<table id="tabel_rekomendasi" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
				            <tr>
				                <th>Kode Area</th>
				                <th>Luas area (ha)</th>
				                <th>Kebutuhan Pupuk (kg)</th>
				                <th>Dosis per pohon</th>
				            </tr>
				        </thead>
				        <tbody>
				        </tbody>
				    </table>
	            </div>
	        </div>
	        <div class="card tab-pane active" id="rekomendasi_blok">
	        	<div class="header">
	                <div class="row clearfix">
	                    <div class="col-xs-12">
	                        <h2>Rekomendasi Pemupukan per Blok Area</h2>
	                    </div>
	                </div>
	            </div>
        		<div class="body">
					<label for="cbpupuk" class="col-xs-2" style="margin:5px 0 10px">Pupuk</label>
					<select id="cbpupuk3">
						<?php
							$nama_pupuk = "";
							$sql_area = pg_query($db_conn, "select * from pkt_pupuk where kode_pupuk in (select distinct kode_pupuk from pkt_rekomendasi)");
							while($data = pg_fetch_assoc($sql_area)){
								if ($nama_pupuk == "") $nama_pupuk = $data['nama_pupuk'];
								echo "<option value='".$data['nama_pupuk']."'>".$data['nama_pupuk']."</option>";
							};
						?>
					</select>
        			<div id="mapid4" style="width: 100%; height: 450px;"></div>
        			<div id="template_legend_rekomendasi_blok" style="display:none">
						<li class="list-group-item" style="padding: 5px 15px; border: none;">
							<span style="width:25px;display:inline-block;background:{COLOR};margin-right:25px;">&nbsp;</span> {TEXT}</li>
        			</div>
					<!--ul class="list-group" id="legend_rekomendasi" style="border: 1px solid #ddd;margin-bottom:0;">
					</ul-->	
					<p>&nbsp;</p>						
					<table id="tabel_rekomendasi_blok" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
				            <tr>
				                <th>Kode Area</th>
				                <th>Blok</th>
				                <th>Luas (ha)</th>
				                <th>Kebutuhan Pupuk (kg)</th>
				                <th>Dosis per pohon</th>
				            </tr>
				        </thead>
				        <tbody>
				        </tbody>
				    </table>
	            </div>
	        </div>
	        <div class="card tab-pane active" id="peta_nutrisi">
	    		<div class="header">
	                <div class="row clearfix">
	                    <div class="col-xs-12">
	                        <h2>Peta Kandungan Unsur</h2>
	                    </div>
	                </div>
	            </div>
				<div class="body">
					<div class="row clearfix">
						<div class="col-lg-12" style="margin-bottom:0">
							<label for="cbunsur" class="col-xs-2" style="margin:5px 0 10px">Unsur</label>
							<select id="cbunsur">
								<option value="N" selected>Nitrogen Daun</option>
								<option value="P">Fosfor Daun</option>
								<option value="K">Kalium Daun</option>
								<option value="Mg">Magnesium Daun</option>
								<!--option value="N-Tanah">Nitrogen Tanah</option>
								<option value="P-Tanah">Fosfor Tanah</option>
								<option value="K-Tanah">Kalium Tanah</option-->
							</select>
							<div id="mapid1" style="width: 100%; height: 450px;"></div>
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
							<ul class="list-group" id="legend_N-Tanah" style="border: 1px solid #ddd;margin-bottom:0;display:none">
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#FF0000;margin-right:25px;">&nbsp;</span> &lt;= 0.04 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#FCFF2D;margin-right:25px;">&nbsp;</span> 0.04 % - 0.08 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#6AFE48;margin-right:25px;">&nbsp;</span> 0.08 % - 0.12 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#02C630;margin-right:25px;">&nbsp;</span> 0.12 % - 0.15 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#20E6DC;margin-right:25px;">&nbsp;</span> 0.15 % - 0.25 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#123A8F;margin-right:25px;">&nbsp;</span> &gt; 0.25 %</li>
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
							<ul class="list-group" id="legend_P-Tanah" style="border: 1px solid #ddd;margin-bottom:0;display:none;">
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#FF0000;margin-right:25px;">&nbsp;</span> &lt;= 5 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#FCFF2D;margin-right:25px;">&nbsp;</span> 5 ppm - 10 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#6AFE48;margin-right:25px;">&nbsp;</span> 10 ppm - 25 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#02C630;margin-right:25px;">&nbsp;</span> 25 ppm - 40 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#20E6DC;margin-right:25px;">&nbsp;</span> 40 ppm - 60 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#123A8F;margin-right:25px;">&nbsp;</span> &gt; 60 ppm</li>
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
							<ul class="list-group" id="legend_K-Tanah" style="border: 1px solid #ddd;margin-bottom:0;display:none;">
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#FF0000;margin-right:25px;">&nbsp;</span> &lt;= 16 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#FCFF2D;margin-right:25px;">&nbsp;</span> 16 ppm - 31.2 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#6AFE48;margin-right:25px;">&nbsp;</span> 31.2 ppm - 78 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#02C630;margin-right:25px;">&nbsp;</span> 78 ppm - 97.5 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#20E6DC;margin-right:25px;">&nbsp;</span> 97.5 ppm - 117 ppm</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#123A8F;margin-right:25px;">&nbsp;</span> &gt; 117 ppm</li>
							</ul>							
							<ul class="list-group" id="legend_Mg" style="border: 1px solid #ddd;margin-bottom:0;display:none;">
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#FF0000;margin-right:25px;">&nbsp;</span> &lt;= 0.18 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#FCFF2D;margin-right:25px;">&nbsp;</span> 0.18 % - 0.20 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#6AFE48;margin-right:25px;">&nbsp;</span> 0.20 % - 0.22 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#02C630;margin-right:25px;">&nbsp;</span> 0.22 % - 0.24 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#20E6DC;margin-right:25px;">&nbsp;</span> 0.24 % - 0.26 %</li>
								<li class="list-group-item" style="padding: 5px 15px; border: none;">
									<span style="width:25px;display:inline-block;background:#123A8F;margin-right:25px;">&nbsp;</span> &gt; 0.26 %</li>
							</ul>							
						</div>
					</div>
	            </div>
	        </div>
	        <div class="card tab-pane active" id="peta_dosis">
	    		<div class="header">
	                <div class="row clearfix">
	                    <div class="col-xs-12">
	                        <h2>Peta Presentase penambahan dosis pupuk</h2>
	                    </div>
	                </div>
	            </div>
				<div class="body">
					<label for="cbpupuk" class="col-xs-2" style="margin:5px 0 10px">Pupuk</label>
					<select id="cbpupuk">
						<?php
							$nama_pupuk = "";
							$sql_area = pg_query($db_conn, "select * from pkt_pupuk where kode_pupuk in (select distinct kode_pupuk from pkt_rekomendasi)");
							while($data = pg_fetch_assoc($sql_area)){
								if ($nama_pupuk == "") $nama_pupuk = $data['nama_pupuk'];
								echo "<option value='".$data['nama_pupuk']."'>".$data['nama_pupuk']."</option>";
							};
						?>
					</select>
					<div id="mapid2" style="width: 100%; height: 450px;"></div>
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
						<!--li class="list-group-item" style="padding: 5px 15px; border: none;">
							<span style="width:25px;display:inline-block;background:#1A9641;margin-right:25px;">&nbsp;</span> &lt; -100%</li-->
					</ul>							
	            </div>
	        </div>
        </div>
    </div>
	<script src="plugins/leaflet/L.Map.Sync.js"></script>
	<script>
		var mapTable = $("#tabel_rekomendasi").DataTable({
			"columns" : [
	            { "data" : "KODE" },
	            { "data" : "count" },
	            { "data" : "sum" },
	            { "data" : "sum" }
	        ],
	        "columnDefs": [{
			    "targets": [1],
			    "sClass": 'text-center',
			    "orderable": true,
			    "render": function ( data, type, row ) {
	                var sum = row.count;
                    var sum = Math.round( (sum/100) * 100) / 100;
                    return sum;
                }
          	},{
			    "targets": [2],
			    "sClass": 'text-center dosis_hektar',
			    "orderable": true,
			    "render": function ( data, type, row ) {
	                var sum = row.sum;
                    var sum = Math.round(sum * 100) / 100;
                    return sum;
                }
                ,"createdCell":  function (td, cellData, rowData, row, col) {
		           $(td).attr("data-id", "grid" + rowData.KODE); 
		        }
          	},{
			    "targets": [3],
			    "sClass": 'text-center',
			    "orderable": true,
			    "render": function ( data, type, row ) {
	                var sum = row.sum;
	                var count = row.count;
                    var jum = $("#jum_pokok").html();
                    jum = jum * (count / 100);
                    var dosis = sum / jum;
                    var sum = Math.round(dosis * 100) / 100;
                    return sum;
                }
                ,"createdCell":  function (td, cellData, rowData, row, col) {
		           $(td).addClass("dosis_pohon_grid" + rowData.KODE); 
		        }
			}],
			"ordering": true
		});

		var mapTableBlok = $("#tabel_rekomendasi_blok").DataTable({
			"columns" : [
	            { "data" : "id" },
	            { "data" : "Blok" },
	            { "data" : "count" },
	            { "data" : "sum" },
	            { "data" : "sum" }
	        ],
	        "columnDefs": [{
			    "targets": [2],
			    "sClass": 'text-center',
			    "orderable": true,
			    "render": function ( data, type, row ) {
	                var sum = row.count;
                    var sum = Math.round( (sum/100) * 100) / 100;
                    return sum;
                }
          	},{
			    "targets": [3],
			    "sClass": 'text-center dosis_blok',
			    "orderable": true,
			    "render": function ( data, type, row ) {
	                var sum = row.sum;
                    var sum = Math.round(sum * 100) / 100;
                    return sum;
                }
                ,"createdCell":  function (td, cellData, rowData, row, col) {
		           $(td).attr("data-id", "blok" + rowData.id); 
		        }
          	},{
			    "targets": [4],
			    "sClass": 'text-center',
			    "orderable": true,
			    "render": function ( data, type, row ) {
	                var sum = row.sum;
	                var count = row.count;
                    var jum = $("#jum_pokok").html();
                    jum = jum * (count / 100);
                    var dosis = sum / jum;
                    var sum = Math.round(dosis * 100) / 100;
                    return sum;
                }
                ,"createdCell":  function (td, cellData, rowData, row, col) {
		           $(td).addClass("dosis_pohon_blok" + rowData.id); 
		        }
			}],
			"ordering": true
		});

	    var arrc = ["#fff7fb","#ece7f2","#d0d1e6","#a6bddb","#74a9cf","#3690c0","#0570b0","#045a8d","#023858"];
	    var i = 0;
	    // $.each(arrc, function(key, value) {
	    // 	var tmp = $("#template_legend_rekomendasi").html();
	    // 	var txt = (i*50).toString() + " - " + ((i+1)*50).toString() + " kg";
	    // 	tmp = tmp.replace("{COLOR}",value);
	    // 	tmp = tmp.replace("{TEXT}",txt);
	    // 	$("#legend_rekomendasi").append(tmp);
	    // 	i++;
	    // });

		var imageUrl = 'result/<?php echo $analisis_id; ?>/';
   		var data_raster = imageUrl + "raster_metadata.json";
        // var imageBounds = [[-6.47657430109,107.017566225], [-6.46718978318,107.03578647]];
		// var imageBounds = [[-6.4765,107.018], [-6.46722,107.036]];
		var map1 = L.map('mapid1');//.setView([107.018, -6.46722], 13);;
		var map2 = L.map('mapid2');
		var layer1;
		var layer2;

   		$.getJSON(data_raster).done(function (d) {
			var imgBounds = [[d.y1_4326,d.x1_4326], [d.y2_4326,d.x2_4326]];
			layer1 = L.imageOverlay(imageUrl + "Citra_Klasifikasi_N.png", imgBounds);
			layer2 = L.imageOverlay(imageUrl + "Citra_Dosis_Pupuk_<?php echo $nama_pupuk; ?>.png", imgBounds);
			map1.addLayer(layer1);
			map2.addLayer(layer2);
			map1.fitBounds(imgBounds);
			map2.fitBounds(imgBounds);
   		});


		var map3 = L.map('mapid3');
		var map4 = L.map('mapid4');

		//console.log(map1);
		//map1.sync(map2);

		function OnEachFeature(feature, layer) {
		    var sum = feature.properties.sum;
		    if(sum != null) {
				var kode = feature.properties.KODE;
				var center = layer.getBounds().getCenter();
				var label = L.marker(center, {
			      icon: L.divIcon({
			        className: 'map-label',
			        html: kode,
			        iconSize: [40, 40]
			      })
			    }).addTo(map3);
		    }
		}

		function filter(feature) {
			var sum = feature.properties.sum;
			var retval = (sum != null);
			return retval;
		}

		function style(feature) {
		    var sum = feature.properties.sum;
		    var opacity = (sum == null) ? 0 : 1;
		    var fill_opacity = 0;
		    // var fill_opacity = (sum == null) ? 0 : 0.2;
		    return {
		        fillColor: 'white', //getColor(feature.properties.sum),
		        weight: opacity,
		        opacity: opacity,
		        color: 'white',
		        dashArray: '3',
		        fillOpacity: fill_opacity
		    };
		}

		function getColor(d) {
		    var idx =  Math.floor(d / 50);
		    return arrc[idx];
		}

		$("#cbunsur").on('change', function() {
	   		var unsur = $("#cbunsur").val();
	   		layer1.setUrl(imageUrl + "Citra_Klasifikasi_" + unsur + ".png");
	   		$("#legend_N").hide();
	   		$("#legend_P").hide();
	   		$("#legend_K").hide();
	   		$("#legend_Mg").hide();
	   		$("#legend_N-Tanah").hide();
	   		$("#legend_P-Tanah").hide();
	   		$("#legend_K-Tanah").hide();
	   		$("#legend_" + unsur).show();
	   	});

	   	$("#cbpupuk").on('change', function() {
	   		var pupuk = $("#cbpupuk").val();
	   		layer2.setUrl(imageUrl + "Citra_Dosis_Pupuk_" + pupuk + ".png");
	   	});

	   	$("#cbpupuk2").on('change', function() {
	   		var pupuk = $("#cbpupuk2").val();

	   		var data_json = imageUrl + "Data_Grid_Pupuk_" + pupuk + ".geojson";
	   		// var data_json = imageUrl + "Data_Grid_Pupuk_UREA_4326.geojson";
	   		var data_img = imageUrl + "Citra_Klasifikasi_Pupuk_"  + pupuk + ".png";

	   		$.getJSON(data_raster).done(function (d) {

				//console.log(data_raster);
				var imgBounds = [[d.y1_4326,d.x1_4326], [d.y2_4326,d.x2_4326]];

				$.getJSON(data_json, function(data){
			        map3.eachLayer(function (layer) { map3.removeLayer(layer); });

			        var mapData = L.geoJson(data, { filter: filter, style: style, onEachFeature: OnEachFeature });
			        var mapBound = mapData.getBounds();
			        mapData.addTo(map3);

			        var img = L.imageOverlay(data_img,imgBounds);
			        img.addTo(map3);

			        map3.fitBounds(imgBounds);
			        // map3.fitBounds(mapBound);

					mapTable.clear().draw();
					table_data = [];
					$.each(data.features, function (key, val) {
						var sum = val.properties.sum;
						if (sum != null) table_data.push(val.properties);
			        });

			        mapTable.rows.add(table_data).draw();
			    });
	   		});

	   	});

		$("#cbpupuk3").on('change', function() {
	   		var pupuk = $("#cbpupuk3").val();

	   		var data_json = imageUrl + "Data_Blok_Pupuk_" + pupuk + ".geojson";
	   		// var data_json = imageUrl + "Data_Grid_Pupuk_UREA_4326.geojson";
	   		var data_img = imageUrl + "Citra_Klasifikasi_Pupuk_"  + pupuk + ".png";

	   		$.getJSON(data_raster).done(function (d) {

				//console.log(data_raster);
				var imgBounds = [[d.y1_4326,d.x1_4326], [d.y2_4326,d.x2_4326]];

				$.getJSON(data_json, function(data){
			        map4.eachLayer(function (layer) { map4.removeLayer(layer); });

			        var mapData = L.geoJson(data, { filter: filter, style: style, onEachFeature: OnEachFeature });
			        var mapBound = mapData.getBounds();
			        mapData.addTo(map4);

			        var img = L.imageOverlay(data_img,imgBounds);
			        img.addTo(map4);

			        map4.fitBounds(imgBounds);
			        // map4.fitBounds(mapBound);

					mapTableBlok.clear().draw();
					table_data = [];
					$.each(data.features, function (key, val) {
						var sum = val.properties.sum;
						if (sum != null) table_data.push(val.properties);
			        });

			        mapTableBlok.rows.add(table_data).draw();
			    });
	   		});

	   	});

	   	$('#ex1').slider();
	   	$("#ex1").on("slide", function(e) {
			var jum_pokok = e.value;
			$("#jum_pokok").html(jum_pokok);

			$( ".dosis_hektar" ).each(function() {
				var dosis_hektar = $(this).html();
				var data_id = $(this).data("id");
				var dosis_pohon = Math.round((dosis_hektar / jum_pokok) * 100) / 100;

				$(".dosis_pohon_" + data_id).html(dosis_pohon);
			});

			$( ".dosis_blok" ).each(function() {
				var dosis_blok = $(this).html();
				var luas_area = $(this).prev().html();
				var data_id = $(this).data("id");
				var dosis_pohon = Math.round(( (dosis_blok / luas_area) / jum_pokok) * 100) / 100;

				$(".dosis_pohon_" + data_id).html(dosis_pohon);
			});
		});

	 //   	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		// 	console.log(e.target); // newly activated tab
		// 	console.log(e.relatedTarget); // previous active tab
		// 	//alert("test");
		// 	map1.fitBounds(imageBounds);
		// });
	</script>
</section>
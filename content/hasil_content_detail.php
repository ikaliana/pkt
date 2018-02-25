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
									$query .= "where d.jenis_pupuk='MAJEMUK' and d.dosis_total<>0 ";
									$query .= "and d.kode_analisis=".$analisis_id;
									$query .= " order by d.nama_pupuk ASC, d.dosis_total ASC";

									$counter = 0;
									$urut = 1;
									$prev_dosis = 0;

									$sql_area = pg_query($db_conn, $query);
									while($data = pg_fetch_assoc($sql_area)){
										if(!$counter) {
											$prev_dosis = $data['dosis_total'];
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
												$query2 .= "where komposisi_n>0 and komposisi_p=0 and komposisi_k=0 order by komposisi_n";
												$col_index = 2;
											}
											if($nama_unsur == "P") {
												$komposisi_unsur = $data['komposisi_p'];
												$query2 .= "where komposisi_n=0 and komposisi_p>0 and komposisi_k=0 order by komposisi_p";
												$col_index = 3;
											}
											if($nama_unsur == "K") {
												$komposisi_unsur = $data['komposisi_k'];
												$query2 .= "where komposisi_n=0 and komposisi_p=0 and komposisi_k>0 order by komposisi_k";
												$col_index = 4;
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
										if($counter >= 3) { $counter = 0; $urut++; }
										$row_counter++;
									} 
								?>
								</tbody>
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
											<option value="N" selected>Nitrogen Daun</option>
											<option value="P">Fosfor Daun</option>
											<option value="K">Kalium Daun</option>
											<!--option value="N-Tanah">Nitrogen Tanah</option>
											<option value="P-Tanah">Fosfor Tanah</option>
											<option value="K-Tanah">Kalium Tanah</option-->
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
												$nama_pupuk = "";
												$sql_area = pg_query($db_conn, "select * from pkt_pupuk where kode_pupuk in (select distinct kode_pupuk from pkt_rekomendasi)");
												while($data = pg_fetch_assoc($sql_area)){
													if ($nama_pupuk == "") $nama_pupuk = $data['nama_pupuk'];
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
									<!--li class="list-group-item" style="padding: 5px 15px; border: none;">
										<span style="width:25px;display:inline-block;background:#1A9641;margin-right:25px;">&nbsp;</span> &lt; -100%</li-->
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
		var layer2 = L.imageOverlay(imageUrl + "Citra_Klasifikasi_Pupuk_<?php echo $nama_pupuk; ?>.png", imageBounds);
		map1.addLayer(layer1);
		map2.addLayer(layer2);
		map1.fitBounds(imageBounds);
		map2.fitBounds(imageBounds);
		map1.sync(map2);

	   $("#cbunsur").on('change', function() {
	   		var unsur = $("#cbunsur").val();
	   		layer1.setUrl(imageUrl + "Citra_Klasifikasi_" + unsur + ".png");
	   		$("#legend_N").hide();
	   		$("#legend_P").hide();
	   		$("#legend_K").hide();
	   		$("#legend_N-Tanah").hide();
	   		$("#legend_P-Tanah").hide();
	   		$("#legend_K-Tanah").hide();
	   		$("#legend_" + unsur).show();
	   });
	   $("#cbpupuk").on('change', function() {
	   		var pupuk = $("#cbpupuk").val();
	   		layer2.setUrl(imageUrl + "Citra_Klasifikasi_Pupuk_" + pupuk + ".png");
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
		});
	</script>
</section>
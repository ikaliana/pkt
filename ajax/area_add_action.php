<?php
include "../config.php";

$lokasi 		= $_POST['lokasi'];
$area_name 		= $_POST['area_name'];
$deskripsi 		= $_POST['deskripsi'];
$allowed_ext	= array('shp', 'shx', 'dbf','prj');

$sql = pg_query($db_conn, "SELECT * FROM pkt_area WHERE nama='".$area_name."'");
$area_exist = pg_fetch_array($sql);
if(empty($area_exist)){
	if(!empty($lokasi) && !empty($area_name) && !empty($deskripsi)){
		if (isset($_FILES['shp']) && !empty($_FILES['shp'])) {
			$no_files = count($_FILES["shp"]['name']);
			$filename = pathinfo($_FILES["shp"]["name"][0], PATHINFO_FILENAME);
			if($no_files == 4 ){
				for($i=0; $i < $no_files; $i++){
					$filename 		= $_FILES["shp"]["name"][$i];
					$value			= explode('.', $filename);
					$file_ext		= strtolower(array_pop($value));
					$file_exts[$i]	= $file_ext;
				}
				if(in_array($file_exts[0], $allowed_ext) && in_array($file_exts[1], $allowed_ext) && in_array($file_exts[2], $allowed_ext) && in_array($file_exts[3], $allowed_ext)){	
					$sql = pg_query($db_conn, "INSERT INTO pkt_area (nama, lokasi, deskripsi, nama_file) VALUES ('".$area_name."', '".$lokasi."', '".$deskripsi."', '".$filename."')");
					$sql = pg_query($db_conn, "SELECT kode_area FROM pkt_area WHERE nama='".$area_name."'");
					$kode_area = pg_fetch_array($sql);
					mkdir('../uploads/area/'.$kode_area[0].'');
					for ($i = 0; $i < $no_files; $i++) {
						if ($_FILES["shp"]["error"][$i] > 0) {
							?>
							<script type="text/javascript">
								setTimeout(function () { swal("No!","Error: " . $_FILES["area"]["error"][$i] . "<br>","error");
							});</script>	
							<?php
						} else {	
							move_uploaded_file($_FILES["shp"]["tmp_name"][$i], '../uploads/area/' .$kode_area[0] . '/' . $_FILES["shp"]["name"][$i]);
							?>
							<script type="text/javascript">
								setTimeout(function () { swal("Yes!","<?php echo $area_name; ?> berhasil ditambahkan!","success");
							});</script>		
							<?php
						}
					}
				}else{
					?>
					<script type="text/javascript">
						setTimeout(function () { swal("Oh tidak!","Anda mungkin mengupload file dengan ekstensi yang salah! Pastikan anda hanya mengupload file *.shp, *.shx, *.dbf, dan *.prj","error");
					});</script>		
					<?php
				}
			}else{
				?>
				<script type="text/javascript">
					setTimeout(function () { swal("Oh no!","File yang anda upload mungkin tidak lengkap! Pastikan anda mengupload file *.shp, *.shx, *.dbf, dan *.prj","error");
				});</script>		
				<?php
			}
		} else {
			?>
			<script type="text/javascript">
			setTimeout(function () { swal("No!","Pilih file untuk diupload!","error");
			});</script>	
			<?php	
		}
	}else{
	?>
		<script type="text/javascript">
		setTimeout(function () { swal("No!","Semua form harus diisi!","error");
		});</script>
	<?php 
	}
}else{
	?>
		<script type="text/javascript">
		setTimeout(function () { swal("Oh tidak!","Area <?php echo $area_name; ?> sudah tersedia! Buat nama lain!","error");
		});</script>
	<?php
}
?>